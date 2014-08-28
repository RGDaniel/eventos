<?php if( ! defined('BASEPATH') ) exit('No direct script access allowed');
/**
 * VISO Constucciones Software
 *
 * Daniel Victor Reyes Garza
 *
 */

class MY_Controller extends CI_Controller
{
	/**
	 * The location of the main template view which most other views get nested inside
	 *
	 * @var string
	 * @access public
	 * 
	 *public $template = 'templates/';
	 */

	/**
	 * The logged-in user's authentication data,
	 * which is their user table record, but could
	 * be whatever you want it to be if you modify 
	 * the queries in the auth model.
	 *
	 * @var object
	 * @access private
	 */
	private $auth_data;

	// --------------------------------------------------------------

	/**
	 * Class constructor
	 */
	public function __construct()
	{
		parent::__construct();
	}
}

/* End of file MY_Controller.php */
/* Location: /application/core/MY_Controller.php */