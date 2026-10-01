<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function session_fingerprint_check()
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        return;
    }

    // Create a unique fingerprint based on IP and User-Agent
    $ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    $agent = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
    $fingerprint = hash('sha256', $ip . $agent);

    if (!isset($_SESSION['fingerprint'])) {
        $_SESSION['fingerprint'] = $fingerprint;
    } elseif ($_SESSION['fingerprint'] !== $fingerprint) {
        // Hijack detected
        session_unset();
        session_destroy();
        header("Location: /"); // or your login page
        exit("Session hijack attempt detected.");
    }
}