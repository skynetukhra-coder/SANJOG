<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        	OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          	OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         	OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   	OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  	OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') 	OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     	OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       	OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      	OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      	OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

defined('DATE_FORMAT')       	OR define('DATE_FORMAT', 'd/m/Y');
defined('DATETIME_FORMAT')   	OR define('DATETIME_FORMAT', 'd/m/Y H:i');

// EXTERNAL INTEGRATION CONFIGURATION (Environment overridable)
defined('NIC_SMTP_HOST')    	OR define('NIC_SMTP_HOST', getenv('NIC_SMTP_HOST') ?: 'smtp.nic.in');
defined('NIC_SMTP_USER')    	OR define('NIC_SMTP_USER', getenv('NIC_SMTP_USER') ?: 'itsc-agae-wb@nic.in');
defined('NIC_SMTP_PASS')    	OR define('NIC_SMTP_PASS', getenv('NIC_SMTP_PASS') ?: 'Itsc#2014$');
defined('NIC_SMTP_PORT')    	OR define('NIC_SMTP_PORT', getenv('NIC_SMTP_PORT') ?: 25);
defined('NIC_SMS_GATEWAY')  	OR define('NIC_SMS_GATEWAY', getenv('NIC_SMS_GATEWAY') ?: 'https://smsgw.sms.gov.in/failsafe/HttpLink?username=agwb.otp&pin=3mpxqh7p');
if (isset($_SERVER['HTTP_HOST'])) {
    $dynamic_protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https://' : 'http://';
    $dynamic_base_dir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
    if ($dynamic_base_dir !== '/') {
        $dynamic_base_dir = rtrim($dynamic_base_dir, '/') . '/';
    } else {
        $dynamic_base_dir = '/';
    }
    $dynamic_site_base = $dynamic_protocol . $_SERVER['HTTP_HOST'] . $dynamic_base_dir;
} else {
    $dynamic_site_base = 'http://localhost/SANJOG/';
}
defined('SITE_BASE_URL')       	OR define('SITE_BASE_URL', $dynamic_site_base);
defined('ADMIN_BASE')      	   	OR define('ADMIN_BASE', 'admin');
defined('AGAE_BASE')      	   	OR define('AGAE_BASE', 'agae');
defined('AGAE_BASE_URL')       	OR define('AGAE_BASE_URL', SITE_BASE_URL.AGAE_BASE.'/');
defined('AGGSSA_BASE')      	OR define('AGGSSA_BASE', 'gssa');
defined('AGGSSA_BASE_URL')      OR define('AGGSSA_BASE_URL', SITE_BASE_URL.AGGSSA_BASE.'/');
defined('AGERSA_BASE')      	OR define('AGERSA_BASE', 'ersa');
defined('AGERSA_BASE_URL')      OR define('AGERSA_BASE_URL', SITE_BASE_URL.AGERSA_BASE.'/');
defined('ADMIN_BASE_URL')      	OR define('ADMIN_BASE_URL', SITE_BASE_URL.ADMIN_BASE.'/');
defined('UPLOAD_FOLDER')   		OR define('UPLOAD_FOLDER', 'files/'); // this is from html browse {Secure path hidden from all}
defined('UPLOAD_FOLDER_DOCUMENT')   	OR define('UPLOAD_FOLDER_DOCUMENT', 'files/agae/documents/'); // this is from html browse {Secure path hidden from all}
defined('UPLOAD_FOLDER_APAR')   		OR define('UPLOAD_FOLDER_APAR', 'files/agae/apar/'); // this is from html browse {Secure path hidden from all}
defined('UPLOAD_FOLDER_TENDER')   		OR define('UPLOAD_FOLDER_TENDER', 'files/agae/tender_whatsnew/'); // this is from html browse {Secure path hidden from all}
defined('UPLOAD_FOLDER_LEAVE')   		OR define('UPLOAD_FOLDER_LEAVE', 'files/agae/leave_documents/'); // this is from html browse {Secure path hidden from all}
defined('UPLOAD_FOLDER_SERVICEBOOK')   	OR define('UPLOAD_FOLDER_SERVICEBOOK', 'files/agae/servicebook/'); // this is from html browse {Secure path hidden from all}
defined('UPLOAD_FOLDER_GPF')   			OR define('UPLOAD_FOLDER_GPF', 'files/agae/gpf_statement/'); // this is from html browse {Secure path hidden from all}
defined('UPLOAD_FORM_SIXTEEN')   		OR define('UPLOAD_FORM_SIXTEEN', 'files/agae/form_sixteen/'); // this is from html browse {Secure path hidden from all}
defined('UPLOAD_CIRCULAR_ORDER')   		OR define('UPLOAD_CIRCULAR_ORDER', 'files/agae/circular_order/'); // this is from html browse {Secure path hidden from all}
defined('UPLOAD_FOLDER_DEPT')  			OR define('UPLOAD_FOLDER_DEPT', 'files/agae/department/'); // this is from html browse {Secure path hidden from all}
defined('UPLOAD_PICTURE')  				OR define('UPLOAD_PICTURE', 'files/agae/picture/'); // this is from html browse {Secure path hidden from all}
defined('UPLOAD_OFFICE_ORDER')   		OR define('UPLOAD_OFFICE_ORDER', 'files/agae/office_order/'); // this is from html browse {Secure path hidden from all}
defined('UPLOAD_RESULT')   				OR define('UPLOAD_RESULT', 'files/agae/results/'); // this is from html browse {Secure path hidden from all}
defined('UPLOAD_SIGNATURE')   			OR define('UPLOAD_SIGNATURE', 'files/agae/signature/'); // this is from html browse {Secure path hidden from all}
defined('UPLOAD_PENSION_PAYT')   		OR define('UPLOAD_PENSION_PAYT', 'files/agae/pension/'); // this is from html browse {Secure path hidden from all}
defined('UPLOAD_PPOGPOCPO')   			OR define('UPLOAD_PPOGPOCPO', 'pension/ppo/'); // this is from html browse {Secure path hidden from all}

defined('UPLOAD_GSSA_FOLDER')   		OR define('UPLOAD_GSSA_FOLDER', 'files/gssa/'); // this is from html browse {Secure path hidden from all}
defined('UPLOAD_ERSA_FOLDER')   		OR define('UPLOAD_ERSA_FOLDER', 'files/ersa/'); // this is from html browse {Secure path hidden from all}

defined('UPLOAD_FILE_PATH')   	OR define('UPLOAD_FILE_PATH', '/agoffice/userfiles/files/');
defined('UPLOAD_IMAGE_PATH')   	OR define('UPLOAD_IMAGE_PATH', '/agoffice/userfiles/images/');
defined('UPLOAD_FILE_FOLDER')   OR define('UPLOAD_FILE_FOLDER', 'userfiles/files');
defined('UPLOAD_FILE_URL')     	OR define('UPLOAD_FILE_URL', SITE_BASE_URL.UPLOAD_FILE_FOLDER.'/');
defined('UPLOAD_IMAGE_FOLDER')  OR define('UPLOAD_IMAGE_FOLDER', 'userfiles/images');
defined('UPLOAD_IMAGE_URL')     OR define('UPLOAD_IMAGE_URL', SITE_BASE_URL.UPLOAD_IMAGE_FOLDER.'/');
defined('SITE_IMAGE_URL')		OR define('SITE_IMAGE_URL', SITE_BASE_URL.'assets/images/');
defined('PAGINATION_DATA_PER_PAGE')			OR define('PAGINATION_DATA_PER_PAGE',20);
defined('ADMIN_PAGINATION_DATA_PER_PAGE')	OR define('ADMIN_PAGINATION_DATA_PER_PAGE',50);
