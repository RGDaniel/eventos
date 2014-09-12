<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');//Based in en Community Auth/** * Community Auth - Authentication Library * * Community Auth is an open source authentication application for CodeIgniter 2.1.3 * * @package     Community Auth * @author      Robert B Gottier * @copyright   Copyright (c) 2011 - 2013, Robert B Gottier. (http://brianswebdesign.com/) * @license     BSD - http://http://www.opensource.org/licenses/BSD-3-Clause * @link        http://community-auth.com */class Police {		/**	 * The logged-in user's authentication data,	 * which is their user table record, but could	 * be whatever you want it to be if you modify 	 * the queries in the auth model.	 *	 * @var object	 * @access private	 */	private $user_documents;			/**	 * Either 'https' or 'http' depending on the current environment	 *	 * @var string	 * @access public	 */	public $protocol = 'http';	/**	 * A large number holding the user ID, last login time, 	 * and last modified time for a logged-in user	 *	 * @var string encrypted	 * @access private	 */	private $auth_identifier;	/**	 * The hold status for the IP, posted username, or posted email address	 *	 * @var bool	 * @access public	 */	public $on_hold = FALSE;	/**	 * The status of a login attempt	 *	 * @var bool	 * @access public	 */	public $login_error = FALSE;	/**	 * Messag when user has been expelled because multy 	 * or banned from check_documents	 *	 * @var string	 * @access public	 */	public $check_documents_msg = array();	// --------------------------------------------------------------	/**	 * Class constructor	 */	function __construct()	{		$this->CI =& get_instance();		// Load Police model		$this->CI->load->model('Police_model');		// Get the auth identifier from the session if it exists		$this->auth_identifier = $this->CI->session->userdata('auth_identifier');	}	function force_ssl()	{		// Force SSL if available		if( config_item('use_ssl') !== FALSE && $this->protocol == 'http' )		{			// Allow redirect to the HTTPS page			if( config_item('redirect_to_https') !== FALSE)			{				//Funcuion Incimpleta ver mas delente cundo se tengan cocimientso de SSL y HTTPS				// Load string helper for trim_slashes function				$this->CI->load->helper('string');				// Load string Police for secure_site_url				$this->CI->load->helper('police_helper');				// 301 Redirect to the secure page				header("Location: " . secure_site_url( trim_slashes( $this->uri->uri_string() ) ), TRUE, 301);			}			// Show a 404 error			else			{				show_404();			}			exit;		}	}	/**	* Police Control	* it is a point that check if you have logged and has permission	*	**/	function police_control($to_login = TRUE)	{            // When the user has been login, check the authentication            if( ( $this->user_documents = $this->_check_documents() ) )            {                return $this->user_documents;            }		            // When user login for first time, receive strings from login form             else if( ( $this->user_documents = $this->_user_status() ) )            {                return $this->user_documents;            }            else if( $to_login )            {                $this->_send_login_form();            }else{                return NULL;            }	}	/**	* Police Control	* it is a point that check if you have logged and has permission	*	**/	function special_permission()        {            $args = func_get_args();            if ( array_intersect( $args, $this->user_documents->permissions ) )            {                //Destrurir seccion                return TRUE;            }                    $this->check_documents_msg['special_permission'] = TRUE;		            $this->_send_login_form();	}	/**	 * Verify if user already logged in. 	 * 	 * 1) Is the user banned?	 * 2) If a login attempt, does the password match the one in the user record?	 * 3) If a status check, does the user agent match when multiple logins disallowed?	 * 4) Is the user the appropriate level for the request?	 * 5) Is the user the appropriate role for the request?	 *	 *	 * @param   mixed  a user level (int) or an array of user roles	 * @return  mixed  either an object containing the user's data or FALSE	 */	public function _check_documents()	{		// Check that the auth identifier is not empty		if( ! $this->auth_identifier )		{			return FALSE;		}				// Decode aunth_identifier		$expose_user = explode( ",", $this->police_decrypt( $this->auth_identifier ) );		// Get objec from user documents		$user_documents = $this->CI->Police_model->get_user_documents( $expose_user[0], $expose_user[1], $expose_user[2] );		// check if auth_identifier is invalid		if( $user_documents === FALSE)		{			return FALSE;		}		// check if user is banned 		if ( $user_documents->user_banned === '1' ) 		{			//Destrurir seccion			$this->check_documents_msg['banned'] = TRUE;			return FALSE;		}		// check if is he who started session 		if( config_item('allow_multiple_logins') === FALSE )		{			if(				$user_documents->user_login_time !== $expose_user[2] OR				$user_documents->user_agent_string !== md5( $this->CI->input->user_agent() )  			)			{				$this->check_documents_msg['login_multi'] = TRUE;				return FALSE;			}		}		//Get a permission in an array		$permissions = $this->CI->Police_model->get_user_permissions( $user_documents->user_role );		//Addin permission in object auth docuements like permission propeti		$user_documents->permissions = $permissions;		return $user_documents;	}          	/**	 * to Do     * need to modify the token	 */	function _user_status(){		$string      = $this->CI->input->post('login_string');		$password    = $this->CI->input->post('login_pass');		//$form_token  = $this->CI->input->post('login_token');		//$flash_token = $this->CI->session->flashdata('login_token');		// If the request resembles a login attempt in any way		if(			$string      !== FALSE OR 			$password    !== FALSE /*OR 			$form_token  !== FALSE OR 			$flash_token !== FALSE */		)		{			// Log as long as error logging threshold allows for debugging			log_message(				'debug',				"\n string      = " . $string .				"\n password    = " . $password /*.				"\n form_token  = " . $form_token .				"\n flash_token = " . $flash_token*/			);		}		// Check to see if a user has ID		if( $this->auth_identifier )		{			// Check login, and return user's data or FALSE if not logged in			if( ( $user_documents = $this->_check_documents() ) )			{				// Return a array whit all documen from user				return $user_documents;			}		}		// If this is a login attempt, all values must not be empty		else if( 			$string      !== FALSE && 			$password    !== FALSE /*&& 			$form_token  !== FALSE && 			$flash_token !== FALSE */		)		{			// Verify that the form token and flash session token are the same			//if( $form_token == $flash_token )			//{				// Attempt login with posted values and return either the auth's data, or FALSE				if( $this->login( $string, $password ) )				{					if( ( $user_documents = $this->_check_documents() ) )					{						// Return a array whit all documen from user						return $user_documents;					}				}			//}		}		/**		 * If a login string and password were posted, and the form token 		 * and flash token were not set, then we treat this as a failed login		 * attempt.		 */		/* else if(			$string      !== FALSE && 			$password    !== FALSE		)		{			// Log the error			$this->log_error( $this->CI->security->xss_clean( $string ) );			$this->login_error = TRUE;		} */		return FALSE;	}	/**	 * Satr loging form     * Use if you have public and private pages     * when you need to login.     * 	 */	function login_form()	{		if( ( $this->user_documents = $this->_user_status() ) )		{			return TRUE;		}		else		{			$this->_send_login_form();		}	}/**	 * Test post of login form 	 * 	 * @param   string  the posted username or email address	 * @param   string  the posted password	 * @return  mixed  either an object containing the user's documents or FALSE	 */	private function login( $user_string, $user_pass )	{		/**		 * Validate the posted username / email address and password.		 * check_password_strength is a metod in My_Form_validation		 */        		$this->CI->load->library('form_validation');		$formrules = array(			array(				'field' => 'login_string',				'label' => 'USERNAME OR EMAIL ADDRESS',				'rules' => 'trim|required|max_length[100]|xss_clean'			),			array(				'field' => 'login_pass',				'label' => 'PASSWORD',				'rules' => 'trim|required|external_callbacks[library,police,check_password_strength,'.$this->CI->input->post('login_string').']'			)		);		$this->CI->form_validation->set_rules( $formrules );		if( $this->CI->form_validation->run() !== FALSE )		{			// Check if IP, username or email address is already on hold.			$this->on_hold = $this->check_hold_status();			if( ! $this->on_hold )			{				// Get user table data if username or email address matches a record				if( ( $auth_documents = $this->CI->Police_model->get_auth_documents( $user_string ) ) )				{                    					// Confirm inactivity lock					if( $this->_user_confirmed ( $auth_documents, $user_pass ) )					{                        // Confirm user if pass is ok                        if( $this->_check_inactivity( $auth_documents->user_last_login ) )                        {                                                    // Set session cookie and HTTP user data delete_cookie                            $this->_maintain_state( $auth_documents );                            return TRUE;                        }                        else                        {                            $this->check_documents_msg['inactivity'] = TRUE;                            return FALSE;                         }                    }					else					{						// Login failed ...						log_message(							'debug',"\n NO MATCH FOR PASS: ".$user_pass);					}				}				else				{					// Login failed ...					log_message(						'debug',						"\n NO MATCH FOR USERNAME OR EMAIL DURING LOGIN ATTEMPT"					);				}			}			else			{				// Login failed ...				log_message(					'debug',					"\n IP, USERNAME, OR EMAIL ADDRESS ON HOLD"				);			}		}		else		{			// Login failed ...			log_message(				'debug',				"\n LOGIN ATTEMPT DID NOT PASS FORM VALIDATION"			);		}				// Log the error		$this->_log_error( $this->CI->security->xss_clean( $user_string ) );		$this->login_error = TRUE;				return FALSE;	}	/**	 * Insert details of failed login attempt into database	 * 	 * @param   string  the username or email address used to attempt login	 * @return  void	 */	private function _log_error( $string )	{		// Clear up any expired rows in the login errors table		$this->CI->Police_model->clear_login_errors();		// Insert the error		$data = array(			'username_or_email' => $string,			'ip_address'        => $this->CI->input->ip_address(),			'time'              => time()		);		$this->CI->Police_model->create_login_error( $data );	}    	/**	 * Gets the hold status for the user's IP,	 * posted username or posted email address	 * Post variable for email address is different 	 * for login vs recovery, hence the lone bool parameter.	 * 	 * @param   bool   if check is from recovery (FALSE if from login)	 * @return  bool	 */	public function check_hold_status( $recovery = FALSE )	{		if (config_item('allow_hold'))		{			// Clear holds that have expired			$this->CI->Police_model->clear_login_errors();			// Check to see if the IP or posted username/email-address is now on hold			return $this->CI->Police_model->check_holds( $recovery );		}		else		{			// Hold is disabled don't do nothing			return TRUE;		}	}    /**	 * Check if to passed more than disable_inactivity_time 	 * from the last time who has logged	 * 	 * @param   time 	 * @return  bool	 */	function _check_inactivity( $user_last_login )	{		if ( config_item('allow_inactivity_lock') )		{            $time_limit = time() - config_item('disable_inactivity_time');            if ( $user_last_login >= $time_limit )            {                return TRUE;            }        }        else        {            return TRUE;        }        return FALSE;    }	/** 	* Password aboiled charset 	* 	* (?=.{' . MIN_CHARS_4_PASSWORD . ',}) means string should be at least length specified in site definitions hook	* (?=.*\d) means string should have at least one digit	* (?=.*[a-z]) means string should have at least one lower case letter	* (?=.*[A-Z]) means string should have at least one upper case letter	* (?!.*\s) means no space, tab, or other whitespace chars allowed	* (?!.*[\\\\\'"]) means no backslash, apostrophe or quote chars are allowed	* (?=.*[@#$%^&+=\*]) means there has to be at least one of these characters in the password @ # $ % ^ & + = *	*/	public function check_password_strength( $password, $arguments = array() )	{		        if( empty( $password ) )		{			// If the password is not required, and if it is empty, no reason to proceed			return TRUE;		}		else if(                 preg_match( '/^(?=.{' . MIN_CHARS_4_PASSWORD . ',' . MAX_CHARS_4_PASSWORD . '})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s)(?!.*[\\\\\'"]).*$/', $password )                 && $password != $arguments[0]                )		{			return $password;		}		else		{			$this->CI->form_validation->set_message(				'external_callbacks', 				'<span class="redfield">%s</span> must contain:					<ol>						<li>At least ' . MIN_CHARS_4_PASSWORD . ' characters</li>						<li>Not more than ' . MAX_CHARS_4_PASSWORD . ' characters</li>						<li>One number</li><li>One lower case letter</li>						<li>One upper case letter</li>						<li>No space characters</li>						<li>No backslash, apostrophe or quote characters</li>						<li>Username and password should be different</li>					</ol>				</span>'			);			return FALSE;		}	}	/**	 * Confirm the User During Login Attempt or Status Check	 *	 * @return  bool	 */	function _user_confirmed($auth_documents, $user_pass = FALSE) {        if ($user_pass) {            //lodad librery            $this->CI->load->library('PasswordHash');            // Check if the posted password matches the one in the user profile            $right_password = $this->CI->passwordhash->CheckPassword($user_pass, $auth_documents->user_pass);            if ($right_password) {                return TRUE;            }        }        return FALSE;    }    /**	 * Send login from 	 *	 */	function _send_login_form()	{		// This check for on hold is for normal login attempts        $on_hold = $this->check_hold_status();		        if( $on_hold )		{			$data['on_hold_mesg'] = 1;		}		        if( $this->login_error )		{			$data['login_error_mesg'] = 1;		}		// This check for on hold is for normal login attempts		if( isset( $this->check_documents_msg['banned'] ) )		{			$data['banned'] = 1;		}        // Has been locked for inactivity		if( isset( $this->check_documents_msg['inactivity'] ) )		{			$data['inactivity'] = 1;		}		// Display messag if you need special permission from a controller		if( isset( $this->check_documents_msg['special_permission'] ) )		{			$data['special_permission'] = 1;		}		// Display a login error message if there was a form post		if( isset( $this->check_documents_msg['login_multi'] ) )		{			$data['login_multi'] = 1;		}                		$this->CI->load->helper('form');		$data['main_content'] = 'police/login_form';		$this->CI->load->view( config_item('template').'main', $data);		$this->CI->output->_display();		exit();	}	/**	 * Setup session, HTTP user cookie, and remember me cookie 	 * during a successful login attempt.	 *	 * @param   obj  the user record	 * @return  void	 */	private function _maintain_state( $auth_documents )	{		// Store login time in database and cookie		$login_time = time();		// Update user record in database		$this->CI->Police_model->login_update( $auth_documents->user_id, $login_time );        log_message("error","estoy en _maintain_state actualize el login time 7 a".$login_time );		// Check if remember me requested, and set cookie if yes		if( config_item('allow_remember_me') && $this->CI->input->post('remember_me') )		{			// Make sure the CI session cookie doesn't expire on close			$this->CI->session->sess_expire_on_close = FALSE;			$this->CI->session->sess_expiration = config_item('remember_me_expiration');		}		// Create auth identification encode and set global var auth_identifier		$this->auth_identifier = $this->create_auth_identifier( 										$auth_documents->user_id,										$auth_documents->user_modified,										$login_time									);		// Set document for the session		$documents = array(				'auth_identifier' => $this->auth_identifier,				'status' => "Signed"        );				// Set cooki session				$this->CI->session->set_userdata($documents);	}	/**	* Creat a autenticate encripted code	*	* @return string encrypted	*/	function create_auth_identifier( $user_id, $user_modified, $login_time )	{		// Make a string comma separate		$string = $user_id.",".$user_modified.",".$login_time;		// Return an encode string		return $this->police_encrypt($string);	}	    /**     * Own Police encrypt     * use the same encryption_key from config.php     *      * @param String     * @return string encypted     */    function police_encrypt( $plaintext )    {        $key = config_item( 'encryption_key' );        $td = mcrypt_module_open( 'blowfish', '', 'cfb', '' );        $iv = mcrypt_create_iv ( mcrypt_enc_get_iv_size ($td ), MCRYPT_RAND );        mcrypt_generic_init( $td, $key, $iv );        $crypttext = mcrypt_generic( $td, $plaintext );        mcrypt_generic_deinit( $td );		mcrypt_module_close( $td );        		return base64_encode( $iv.$crypttext );    }        /**     * Own Police decrypt     * use the same encryption_key from config.php     *      * @param string encypted     * @return string     */    function police_decrypt( $crypttext )    {        $crypttext = base64_decode( $crypttext );        $key = config_item( 'encryption_key' );		$plaintext = "";        $td        = mcrypt_module_open( 'blowfish', '','cfb', '' );        $ivsize    = mcrypt_enc_get_iv_size ($td );        $iv        = substr( $crypttext, 0, $ivsize );        $crypttext = substr( $crypttext, $ivsize );        if ( $iv )        {            mcrypt_generic_init( $td, $key, $iv );            $plaintext = mdecrypt_generic( $td, $crypttext );        }		mcrypt_module_close( $td );        		return $plaintext;    }	/**	 * Destroy session, auth_identifier and user_documents     * 	 */	public function logout()	{        // Get the user ID from the session		//$user_id = $this->expose_user_id( $this->auth_identifier );		// Delete last login time from user record        //$this->CI->auth_model->logout( $user_id );            // Clear auth_identifier        $this->auth_identifier = FALSE;                // Clear user_documents        $this->user_documents = FALSE;        // Delete session		$this->CI->session->sess_destroy();	}}// END Policia CLASS/* End of file Policia.php *//* Location: ./application/libraries/Policia.php */