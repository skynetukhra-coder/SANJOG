<?php
/**
 * Form-16 Secure Viewer & Downloader
 * Integrates directly with CodeIgniter 3 session database storage.
 */

// 1. Boot Configuration
define('BASEPATH', true);
define('ENVIRONMENT', 'development');
require_once 'application/config/constants.php';
require_once 'application/config/config.php';
require_once 'application/config/database.php';

// 2. Helper function to unserialize CodeIgniter 3 session data stored in DB
function unserialize_session($session_data) {
    $data = [];
    $offset = 0;

    while ($offset < strlen($session_data)) {
        $delim_pos = strpos($session_data, '|', $offset);
        if ($delim_pos === false) break;

        $name = substr($session_data, $offset, $delim_pos - $offset);
        $offset = $delim_pos + 1;

        $value = @unserialize(substr($session_data, $offset));
        $data[$name] = $value;

        $offset += strlen(serialize($value));
    }

    return $data;
}

// 3. Database Connection
$active_group = isset($active_group) ? $active_group : 'default';
if (!isset($db[$active_group])) {
    die("Database configuration group '{$active_group}' not found.");
}
$db_config = $db[$active_group];

$conn = new mysqli($db_config['hostname'], $db_config['username'], $db_config['password'], $db_config['database']);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// 4. Retrieve & Parse Session
$cookie_prefix = isset($config['cookie_prefix']) ? $config['cookie_prefix'] : '';
$cookie_name = isset($config['sess_cookie_name']) ? $config['sess_cookie_name'] : 'ci_session';
$full_cookie_name = $cookie_prefix . $cookie_name;

$session_id = isset($_COOKIE[$full_cookie_name]) ? $_COOKIE[$full_cookie_name] : null;

$pan = '';
$emp_name = '';
$isLoggedIn = false;
$error = '';
$files = [];
$folder = "FORM_16__AY_2026-27_FINAL/";

if ($session_id) {
    $session_table = isset($config['sess_save_path']) ? $config['sess_save_path'] : 'sessions';
    $db_prefix = $db_config['dbprefix'];
    if ($db_prefix && strpos($session_table, $db_prefix) !== 0) {
        $session_table = $db_prefix . $session_table;
    }
    $stmt = $conn->prepare("SELECT data FROM `{$session_table}` WHERE id = ?");
    if ($stmt) {
        $stmt->bind_param("s", $session_id);
        $stmt->execute();
        $stmt->bind_result($session_data);
        if ($stmt->fetch()) {
            $session_vars = unserialize_session($session_data);
            if (isset($session_vars['emp_data']) && is_array($session_vars['emp_data'])) {
                $emp_data = $session_vars['emp_data'];
                if (isset($emp_data['empid'])) {
                    $pan = strtoupper(trim($emp_data['empid']));
                    $emp_name = isset($emp_data['empname']) ? $emp_data['empname'] : 'Employee';
                    $isLoggedIn = true;
                } else {
                    $error = "Session verified, but employee ID is missing.";
                }
            } else {
                $error = "Access denied. Active employee session not found. Please log in.";
            }
        } else {
            $error = "Session expired or invalid. Please log in again.";
        }
        $stmt->close();
    } else {
        $error = "System configuration error. Connection failed.";
    }
} else {
    $error = "Access denied. Active session cookie not found. Please log in.";
}

// 5. Handle File Scan & Security Validations
if ($isLoggedIn && empty($error)) {
    // Validate PAN Format (5 Letters, 4 Numbers, 1 Letter)
    if (preg_match('/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/', $pan)) {
        if (is_dir($folder)) {
            $allFiles = scandir($folder);
            foreach ($allFiles as $file) {
                if ($file == "." || $file == "..") {
                    continue;
                }
                // Check if file starts with the employee's PAN (case-insensitive prefix search)
                if (stripos($file, $pan) === 0) {
                    $files[] = $file;
                }
            }
        } else {
            $error = "Form-16 repository directory does not exist on the server.";
        }
    } else {
        $error = "The logged-in session ID format is invalid.";
    }
}

// 6. Handle Secure Download Action
if (isset($_GET['download']) && $isLoggedIn) {
    $download_file = basename($_GET['download']); // Prevent directory traversal
    $file_path = $folder . $download_file;

    // Securely check if the file belongs to this employee (starts with their PAN)
    if (stripos($download_file, $pan) === 0 && file_exists($file_path)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $download_file . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file_path));
        readfile($file_path);
        exit;
    } else {
        $error = "Access denied or file not found.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form 16 Portal - Employee Corner</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2563eb;
            --primary-hover: #1d4ed8;
            --bg: #f8fafc;
            --card-bg: #ffffff;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --border: #e2e8f0;
            --danger: #ef4444;
            --success: #22c55e;
            --warning: #f59e0b;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--bg);
            color: var(--text-main);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            width: 100%;
            max-width: 650px;
            padding: 20px;
        }

        .card {
            background-color: var(--card-bg);
            border-radius: 16px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border);
            overflow: hidden;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.08), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .header {
            background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);
            color: #ffffff;
            padding: 30px 25px;
            text-align: center;
            position: relative;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .header p {
            margin: 5px 0 0 0;
            font-size: 14px;
            opacity: 0.9;
        }

        .content {
            padding: 25px;
        }

        .user-badge {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #f1f5f9;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid var(--border);
        }

        .user-info {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-weight: 600;
            font-size: 16px;
        }

        .user-pan {
            font-size: 13px;
            color: var(--text-muted);
            font-family: monospace;
            background-color: #e2e8f0;
            padding: 2px 6px;
            border-radius: 4px;
            align-self: flex-start;
            margin-top: 3px;
            font-weight: bold;
        }

        .badge-status {
            font-size: 12px;
            font-weight: 600;
            padding: 4px 8px;
            border-radius: 12px;
            text-transform: uppercase;
        }

        .badge-status.active {
            background-color: #dcfce7;
            color: #15803d;
        }

        .badge-status.error {
            background-color: #fee2e2;
            color: #b91c1c;
        }

        .alert {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            line-height: 1.5;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .alert-error {
            background-color: #fee2e2;
            border: 1px solid #fca5a5;
            color: #991b1b;
        }

        .file-list {
            margin-top: 15px;
        }

        .file-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px;
            border: 1px solid var(--border);
            border-radius: 10px;
            margin-bottom: 12px;
            transition: background-color 0.2s ease, border-color 0.2s ease;
        }

        .file-item:hover {
            background-color: #f8fafc;
            border-color: #cbd5e1;
        }

        .file-details {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .file-icon {
            width: 40px;
            height: 40px;
            background-color: #ffe4e6;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--danger);
            font-weight: bold;
            font-size: 14px;
        }

        .file-name {
            font-weight: 500;
            font-size: 15px;
            color: var(--text-main);
            word-break: break-all;
        }

        .btn-download {
            background-color: var(--primary);
            color: #ffffff;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: background-color 0.2s ease;
        }

        .btn-download:hover {
            background-color: var(--primary-hover);
        }

        .btn-login {
            background-color: var(--primary);
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.2s ease;
            margin-top: 10px;
        }

        .btn-login:hover {
            background-color: var(--primary-hover);
        }

        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: var(--text-muted);
        }

        .empty-icon {
            font-size: 48px;
            margin-bottom: 10px;
            color: #cbd5e1;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
            color: var(--text-muted);
        }

        .footer a {
            color: var(--primary);
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <div class="header">
            <h1>Form 16 Portal</h1>
            <p>Assessment Year 2026-27 - Final Release</p>
        </div>

        <div class="content">
            <?php if ($isLoggedIn): ?>
                <div class="user-badge">
                    <div class="user-info">
                        <span class="user-name"><?php echo htmlspecialchars($emp_name); ?></span>
                        <span class="user-pan"><?php echo htmlspecialchars($pan); ?></span>
                    </div>
                    <span class="badge-status active">Logged In</span>
                </div>

                <?php if (!empty($error)): ?>
                    <div class="alert alert-error">
                        <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="flex-shrink: 0;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <span><?php echo htmlspecialchars($error); ?></span>
                    </div>
                <?php endif; ?>

                <div class="file-list">
                    <?php if (!empty($files)): ?>
                        <?php foreach ($files as $file): ?>
                            <div class="file-item">
                                <div class="file-details">
                                    <div class="file-icon">PDF</div>
                                    <span class="file-name"><?php echo htmlspecialchars($file); ?></span>
                                </div>
                                <a href="?download=<?php echo urlencode($file); ?>" class="btn-download">
                                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                    Download
                                </a>
                            </div>
                        <?php endforeach; ?>
                    <?php elseif (empty($error)): ?>
                        <div class="empty-state">
                            <div class="empty-icon">📂</div>
                            <h3>No files found</h3>
                            <p>No Form-16 documents matching PAN <?php echo htmlspecialchars($pan); ?> were found on the server.</p>
                        </div>
                    <?php endif; ?>
                </div>

            <?php else: ?>
                <div class="user-badge">
                    <div class="user-info">
                        <span class="user-name">Guest User</span>
                    </div>
                    <span class="badge-status error">Logged Out</span>
                </div>

                <div class="alert alert-error">
                    <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="flex-shrink: 0;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <span><?php echo htmlspecialchars($error); ?></span>
                </div>

                <div style="text-align: center;">
                    <a href="emp/login" class="btn-login">Go to Employee Login</a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="footer">
        <p>&copy; <?php echo date('Y'); ?> Principal Accountant General (A&E), West Bengal. All rights reserved.</p>
    </div>
</div>

</body>
</html>
