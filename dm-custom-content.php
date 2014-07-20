<?php

/*
Plugin Name: DM Custom Content
Plugin URI: http://designmissoula.com/
Description: Used by millions to make WP better by adding custom content.
Author: Bradford Knowton
Version: 1.20.4
Author URI: http://bradknowlton.com/
License: GPLv2 or later
GitHub Plugin URI: https://github.com/DesignMissoula/DM-custom-content
GitHub Branch:     k12newsnetwork-subsites
*/

class WPSubsitePlugin {

	/*--------------------------------------------*
	 * Constants
	 *--------------------------------------------*/
	const name = 'WP Subsite Plugin';
	const slug = 'wp_subsite_plugin';

	/**
	 * Constructor
	 */
	function __construct() {
		//Hook up to the init action
		add_action( 'init', array( &$this, 'init_wp_subsite_plugin' ) );
		
		add_filter('widget_text', 'do_shortcode');
		
		add_filter( 'pre_get_posts', array( &$this, 'custom_get_posts' ) );
	}

	/**
	 * Runs when the plugin is initialized
	 */
	function init_wp_subsite_plugin() {
		// Load JavaScript and stylesheets
		// $this->register_scripts_and_styles();


		if ( is_admin() ) {
			//this will run when in the WordPress admin
		} else {
			//this will run when on the frontend
		}

		$labels = array(
			'name' => _x( 'Subsites', 'subsite' ),
			'singular_name' => _x( 'Subsite', 'subsite' ),
			'add_new' => _x( 'Add New', 'subsite' ),
			'add_new_item' => _x( 'Add New Subsite', 'subsite' ),
			'edit_item' => _x( 'Edit Subsite', 'subsite' ),
			'new_item' => _x( 'New Subsite', 'subsite' ),
			'view_item' => _x( 'View Subsite', 'subsite' ),
			'search_items' => _x( 'Search Subsites', 'subsite' ),
			'not_found' => _x( 'No subsite found', 'subsite' ),
			'not_found_in_trash' => _x( 'No subsite found in Trash', 'subsite' ),
			'parent_item_colon' => _x( 'Parent Subsite:', 'subsite' ),
			'menu_name' => _x( 'Subsites', 'subsite' ),
		);
		$args = array(
			'labels' => $labels,
			'hierarchical' => false,
			'supports' => array( 'title','editor',  'author', 'revisions', 'thumbnail' ), //  'custom-fields',
			'public' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'show_in_nav_menus' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'has_archive' => true,
			// 'taxonomies' => ,
			'query_var' => true,
			'can_export' => true,
			'rewrite' => true,
			'capability_type' => 'post',
			'menu_icon' => 'dashicons-networking'
		);
		register_post_type( 'subsite', $args );

	
		
	
	}

	function custom_get_posts( $query ) {

	  if( is_post_type_archive('subsite') ) { 
	    $query->query_vars['orderby'] = 'name';
	    $query->query_vars['order'] = 'ASC';
	  }
	
	  return $query;
	}

	/**
	 * Registers and enqueues stylesheets for the administration panel and the
	 * public facing site.
	 */
	private function register_scripts_and_styles() {
		if ( is_admin() ) {

		} else {

		} // end if/else
	} // end register_scripts_and_styles

} // end class

new WPSubsitePlugin();