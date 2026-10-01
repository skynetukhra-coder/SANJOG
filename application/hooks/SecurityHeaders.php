<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * SecurityHeaders Hook
 *
 * Sets standard modern HTTP response security headers for all controller outputs.
 */
class SecurityHeaders
{
    public function initialize()
    {
        $ci =& get_instance();
        if (isset($ci->output)) {
            $ci->output->set_header('X-Frame-Options: SAMEORIGIN');
            $ci->output->set_header('X-Content-Type-Options: nosniff');
            $ci->output->set_header('X-XSS-Protection: 1; mode=block');
            $ci->output->set_header('Referrer-Policy: strict-origin-when-cross-origin');
        }
    }
}
