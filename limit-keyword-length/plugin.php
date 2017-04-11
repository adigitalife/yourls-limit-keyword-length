<?php
/*
Plugin Name: Limit keyword length
Plugin URI: https://github.com/adigitalife/yourls-limit-keyword-length/
Description: This plugin limits the number of characters for the custom keyword. An error is then returned if the keyword is too long.
Version: 1.0
Author: Aylwin
Author URI: http://adigitalife.net/
*/

// Hook our custom function into the 'shunt_add_new_link' filter
yourls_add_filter( 'shunt_add_new_link', 'limit_keyword_length' );

// Check the keyword length and return an error if too long
function limit_keyword_length( $too_long = false, $url, $keyword ) {
	$max_keyword_length = 30;
	$keyword_length = strlen($keyword);

	if ( $keyword_length > $max_keyword_length ) {
		$return['status']   = 'fail';
		$return['code']     = 'error:keyword';
		$return['message']  = "Sorry, the keyword is too long. It can't be more than " . $max_keyword_length . " characters.";
		return yourls_apply_filter( 'add_new_link_keyword_too_long', $return, $url, $keyword, $title );
	}

	return false;
}
