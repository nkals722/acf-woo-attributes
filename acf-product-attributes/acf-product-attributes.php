<?php

/*
Plugin Name: Advanced Custom Fields: Woocommerce Attribute Picker
Plugin URI: PLUGIN_URL
Description: Adds a field to allow you to pick from a list of existing Woocommerce Attributes
Version: 1.0.0
Author: Nick Kalscheur
Author URI: https://www.kalscheur.info
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

// exit if accessed directly
if( ! defined( 'ABSPATH' ) ) exit;


// check if class already exists
if( !class_exists('pk_acf_plugin_product_attributes') ) :

class pk_acf_plugin_product_attributes {
	
	// vars
	var $settings;
	
	
	/*
	*  __construct
	*
	*  This function will setup the class functionality
	*
	*  @type	function
	*  @date	17/02/2016
	*  @since	1.0.0
	*
	*  @param	void
	*  @return	void
	*/
	
	function __construct() {
		
		// settings
		// - these will be passed into the field class.
		$this->settings = array(
			'version'	=> '1.0.0',
			'url'		=> plugin_dir_url( __FILE__ ),
			'path'		=> plugin_dir_path( __FILE__ )
		);
		
		
		// include field
		add_action('acf/include_field_types', 	array($this, 'include_field')); // v5
		add_action('acf/register_fields', 		array($this, 'include_field')); // v4
	}
	
	
	/*
	*  include_field
	*
	*  This function will include the field type class
	*
	*  @type	function
	*  @date	17/02/2016
	*  @since	1.0.0
	*
	*  @param	$version (int) major ACF version. Defaults to false
	*  @return	void
	*/
	
	function include_field( $version = false ) {
		
		// support empty $version
		if( !$version ) $version = 4;
		
		
		// load pk-product-attributes
		load_plugin_textdomain( 'pk-product-attributes', false, plugin_basename( dirname( __FILE__ ) ) . '/lang' ); 
		
		
		// include
		include_once('fields/class-pk-acf-field-product-attributes-v' . $version . '.php');
	}
	
}


// initialize
new pk_acf_plugin_product_attributes();


// class_exists check
endif;
	
?>