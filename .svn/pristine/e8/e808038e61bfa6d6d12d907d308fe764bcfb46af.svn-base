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
class User_model extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}

	/**
     * Get User Info
     * 
	 */
	public function get_user_profile( $user_id )
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
     * Cont how many user there are
     * 
	 */
	public function user_count( $search )
	{
		// Selected user table data
		$selected_columns = array(
            'user_id',
			'user_name',
			'user_email'

		);

		// User table query
		$this->db->select( $selected_columns );
		$this->db->from( 'sec_users' );
		$this->db->where( 'user_name', $search );

		$query = $this->db->get();

		if ( $query )
		{
			return  $query->num_rows();
		}

		return FALSE;
	}

    /**
     * Cont how many user there are
     * 
	 */
	public function user_table( $search, $number, $perpage )
	{
		// Selected user table data
		$selected_columns = array(
            'user_id',
			'user_name',
			'user_email'

		);

		// User table query
		$this->db->select( $selected_columns );
		$this->db->from( 'sec_users' );
		//$this->db->where( 'user_name', $search );
       // $this->db->limit($number, $perpage);

// Produces: LIMIT 20, 10 (in MySQL. Other databases have slightly different syntax)
		$query = $this->db->get();

		if ( $query )
		{
			return  $query;
		}

		return FALSE;
	}
	
}
// END User MODEL

/* End of file User_model.php */
/* Location: ./application/models/user_model.php */