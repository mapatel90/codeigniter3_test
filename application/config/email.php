<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$config['useragent']    = 'phpmailer'; // phpmailer or codeigniter

$config['protocol']     =  SMTP_PROTOCOL;

$config['mailpath']     = "/usr/bin/sendmail"; // or "/usr/sbin/sendmail"

$config['smtp_host']    = SMTP_HOST;

$config['smtp_user']    = SMTP_USERNAME;

$config['smtp_pass']    = SMTP_PASS;

$config['smtp_port']    = SMTP_PORT;

$config['smtp_timeout'] = 30;

$config['smtp_crypto'] = "ssl";

$config['smtp_debug']       = 0;                        // PHPMailer's SMTP debug info level: 0 = off, 1 = commands, 2 = commands and data, 3 = as 2 plus connection status, 4 = low level data output.

$config['debug_output']     = 'html';                       // PHPMailer's SMTP debug output: 'html', 'echo', 'error_log' or user defined function with parameter $str and $level. NULL or '' means 'echo' on CLI, 'html' otherwise.

$config['smtp_auto_tls']    = false;                     // Whether to enable TLS encryption automatically if a server supports it, even if `smtp_crypto` is not set to 'tls'.

$config['smtp_conn_options'] = array();                 // SMTP connection options, an array passed to the function stream_context_create() when connecting via SMTP.

$config['wordwrap']     = true;

$config['mailtype']     = 'html';

$config['charset']      = 'utf-8';

$config['validate']         = false;

$config['priority']         = 3;                        // 1, 2, 3, 4, 5; on PHPMailer useragent NULL is a possible option, it means that X-priority header is not set at all, see https://github.com/PHPMailer/PHPMailer/issues/449

$config['newline']      = "\r\n";

$config['crlf']         = "\r\n";

$config['bcc_batch_mode']   = false;

$config['bcc_batch_size']   = 200;

$config['encoding']         = '8bit';                   // The body encoding. For CodeIgniter: '8bit' or '7bit'. For PHPMailer: '8bit', '7bit', 'binary', 'base64', or 'quoted-printable'.

$config['dkim_domain']      = '';                       // DKIM signing domain name, for exmple 'example.com'.

$config['dkim_private']     = '';                       // DKIM private key, set as a file path.

$config['dkim_private_string'] = '';                    // DKIM private key, set directly from a string.

$config['dkim_selector']    = '';                       // DKIM selector.

$config['dkim_passphrase']  = '';                       // DKIM passphrase, used if your key is encrypted.

$config['dkim_identity']    = '';                       // DKIM Identity, usually the email address used as the source of the email.
