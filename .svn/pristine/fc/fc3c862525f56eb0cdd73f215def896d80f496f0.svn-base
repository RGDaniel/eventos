<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Police Constants and Config
|--------------------------------------------------------------------------
| Todas las definiciones para la libreria Police
|
|
*/
define('MAX_CHARS_4_NAME', "100");
define('MIN_CHARS_4_PASSWORD', "4");
define('MAX_CHARS_4_PASSWORD', "100");

/*
|--------------------------------------------------------------------------
| Police Seting
|--------------------------------------------------------------------------
| Setings
|
|
*/
$config['allow_show_passwords'] = FALSE;
$config['allow_remember_me'] = FALSE;
$config['remember_me_expiration'] = 36000 * 24 * 7;
$config['allow_multiple_logins'] = TRUE;

/*
|--------------------------------------------------------------------------
| Police Seting on hold
|--------------------------------------------------------------------------
|
| If you have enabled hold, you can set an hold threshold to
| determine what gets blocked. Threshold options are:
|
|	0 = Only IP
|	1 = Only user or email
|	2 = IP and user or email
|
| Setup default = 0
|
*/

$config['allow_hold'] = TRUE;
$config['max_allowed_attempts'] = 5;
$config['seconds_on_hold'] = 60 * 10; 
$config['hold_threshold'] = 2;

/*
|--------------------------------------------------------------------------
| Police Seting first step change password
|--------------------------------------------------------------------------
|
| Available change password the first login time
|
|
*/

$config['first_time_change_pass'] = TRUE;

/*
|--------------------------------------------------------------------------
| Police Seting inactivity time
|--------------------------------------------------------------------------
|
| Set time to block access from a long time of the last time
| on secons
|
|
*/

$config['allow_inactivity_lock'] = FALSE;
$config['disable_inactivity_time'] = 3600 * 24 * 30 ;

/*
|-------------------------------------------------------------------------
| Ploice seting recovery password
|-------------------------------------------------------------------------
| Time out fro recovery pasword
| remember_time in seconds 3 days = 3600 * 24 * 3
|
*/
$config['allow_recovery_passwords'] = FALSE;
$config['confirmation_email'] = FALSE;
$config['recovery_time'] = 3600 * 24 * 2; 

/*
|--------------------------------------------------------------------------
| Police CSRF
|--------------------------------------------------------------------------
| When csrf is abiable on config.php
| maybe you whant used a dynamic token
| change ever refresh
*/
$config['dynamic_token'] = FALSE;

/*
| -----------------------------------------------------------------
| USE_SSL
| -----------------------------------------------------------------
| Set to TRUE for standard SSL certificate.
| Set to FALSE for no SSL.
| 
*/
$config['use_ssl'] = FALSE;

/*
| -----------------------------------------------------------------
| REDIRECT_TO_HTTPS
| -----------------------------------------------------------------
| Set to TRUE to allow redirection to an HTTPS page when forcing SSL.
| Set to FALSE to show a 404 error if not HTTPS.
| 
*/

$config['redirect_to_https'] = FALSE;





/* End of file police.php */
/* Location: ./application/config/police.php */