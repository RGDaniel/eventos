<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|--------------------------------------------------------------------------
| Helper Police
|--------------------------------------------------------------------------
| Helper Based in Comunity Aunt 
|
| 
*/

// ------------------------------------------------------------------------
if ( ! function_exists('secure_site_url'))
{
	function secure_site_url( $uri = '' )
	{
		$CI =& get_instance();

		$url = $CI->config->site_url( $uri );

		if( config_item('use_ssl') === TRUE )
		{
			if( parse_url( $url, PHP_URL_SCHEME ) == 'http' )
			{
				$url = substr( $url, 0, 4 ) . 's' . substr( $url, 4 );
			}
		}
		return $url;
	}

}
// ------------------------------------------------------------------------


/**
 * Encrypt based on Police libraries .
 *
 *
 * @param string.
 * @return encrypted string.
 */
if ( ! function_exists('police_encrypt'))
{
	function police_encrypt( $string )
	{
		$CI =& get_instance();

		$string = $CI->police->police_encrypt( $string );

		return $string;
	}

}


// ------------------------------------------------------------------------
/**
 * Decrypt based on Police libraries .
 *
 *
 * @param encrypted string.
 * @return string.
 */
if ( ! function_exists('police_decrypt'))
{
	function police_decrypt( $string )
	{
		$CI =& get_instance();

		$string = $CI->police->police_encrypt( $string );

		return $string;
	}

}
// ------------------------------------------------------------------------



/* End of file police_helper.php */
/* Location: ./application/helpers/police_helper.php */