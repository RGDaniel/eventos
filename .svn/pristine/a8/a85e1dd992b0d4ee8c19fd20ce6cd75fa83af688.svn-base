<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//Based in en Community Auth

/**
 * Community Auth - Authentication Library
 *
 * Community Auth is an open source authentication application for CodeIgniter 2.1.3
 *
 * @package     Community Auth
 * @author      Robert B Gottier
 * @copyright   Copyright (c) 2011 - 2013, Robert B Gottier. (http://brianswebdesign.com/)
 * @license     BSD - http://http://www.opensource.org/licenses/BSD-3-Clause
 * @link        http://community-auth.com
 */
class Police_model extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}

	/**
	 * Update the user's user table record when they login
	 * 
	 * @param  array  the user's user table data 
	 */
	public function login_update( $user_id, $login_time )
	{
		$data = array(
			'user_last_login'   => $login_time,
			'user_login_time'   => $login_time,
			'user_agent_string' => md5( $this->input->user_agent() )
		);

		$this->db->where( 'user_id' , $user_id )
			->update( 'sec_users' , $data );
	}

	/**
	 * Check the user table to see if a user exists by username or email address.
	 * If there was a matching record, combine with select profile data and 
	 * return merged object.
	 *
	 * While this query is rather limited, you could easily add specific user 
	 * profile data. Remember, however, that while encrypted by 
	 * default, the http user cookie is tranmitted via standard http requests.
	 * 
	 * @param   string  either the username or email address of a user
	 * @return  mixed   either query data as object or FALSE
	 */
	public function get_auth_documents( $user_string )
	{
		// Selected user table data
		$selected_columns = array(
			'user_id',
			'user_name',
			'user_email',
			'user_role',
			'user_pass',
			'user_modified',
			'user_banned',
            'user_last_login'
		);

		// User table query
		$query = $this->db->select( $selected_columns )
			->from( 'sec_users' )
			->where( 'user_name', $user_string )
			->or_where( 'user_email', $user_string )
			->limit(1)
			->get();

		if ( $query->num_rows() == 1 )
		{
			$documents = $query->row();
			return $documents;
		}

		return FALSE;
	}

	/**
	 * Check user table and confirm there is a record where:
	 *
	 * 1) The last user modification date matches
	 * 2) The user ID matches
	 * 3) The user login time matches ( if multiple logins are not allowed )
	 * 
	 * If there is a matching record, return a specified subset of the record.
	 *
	 * @param   int    the last modification date
	 * @param   int    the user ID
	 * @return  mixed  either query data as an object or FALSE
	 */
	public function get_user_documents( $user_id, $user_modified, $login_time )
	{
		// Selected user table data
		$selected_columns = array(
			'user_name',
			'user_email',
			'user_role',
			'user_modified',
			'user_banned',
			'user_login_time',
			'user_agent_string'
		);

		// User table query
		$this->db->select( $selected_columns );
		$this->db->from( 'sec_users' );
		$this->db->where( 'user_id', $user_id );

		$this->db->limit(1);
		$query = $this->db->get();

		if ( $query->num_rows() == 1 )
		{
			return  $query->row();
		}

		return FALSE;
	}

	/**
	 * Get a array permissions from a role:
	 *
	 * 
	 * If there is a matching record, return a specified array.
	 *
	 * @param   int    the user role
	 * @return  array  a array result full of permissions
	 */
	public function get_user_permissions( $user_role )
	{
		// User table query
		$query = $this->db->select( 'permission_id' )
					->from( 'sec_roles_permissions' )
					->where( 'role_id', $user_role )
					->get();

		if ( $query->num_rows() > 0 )
		{
			// Star array permissions
			$permissions = array();

			foreach ( $query->result() as $row )
	        {
            	//load ever permission ID in auto index
            	$permissions[] = intval($row->permission_id);
        	}
        	// return array for to late use in auth_document 
           	return $permissions;
		}

		return FALSE;
	}

	//---------------------------------------------------------------

	/**
	 * Clear login errors that have expired
	 */
	public function clear_login_errors()
	{
		$duration = time() - config_item('seconds_on_hold');

		$this->db->delete( 'sec_login_errors', array( 'time <' => $duration ) );
	}

	/**
	 * Insert a login error into the database
	 * 
	 * @param  array  the details of the login attempt 
	 */
	public function create_login_error( $data )
	{
		$this->db->set( $data )
			->insert( 'sec_login_errors' );
	}

	// --------------------------------------------------------------

	/**
	 * Check that the IP address, username, or email address is not on hold.
	 * 
	 * @param   bool   if check is from recovery (FALSE if from login)
	 * @return  bool
	 */
	public function check_holds( $recovery )
	{
		// Get item from Police config
		if( config_item('hold_threshold') != "" )
		{
			$hold_threshold = config_item('hold_threshold') ;
		}
		else
		{
			$hold_threshold = 2;
		}
		
		// Switch to setup where depend of hold threshold
		switch ($hold_threshold)
		{
		    case 0:
		        $this->db->where('IP_address', $this->input->ip_address());;
	        break;
		    case 1:
		        $this->db->where('username_or_email', $this->input->post( 'login_string' )  );
	        break;
		    case 2:
		    default:
		       	$this->db->where('IP_address', $this->input->ip_address());
		       	$this->db->where('username_or_email', $this->input->post( 'login_string' )  );
	       	break;
		}

		// Comparative of number of errors is bigger than setup
		if( $this->db->count_all_results('sec_login_errors') > config_item('max_allowed_attempts') - 1 )
		{
			return TRUE;
		}

		return FALSE;
	}
}
// END Policia MODEL

/* End of file Policia_model.php */
/* Location: ./application/models/Policia_model.php */