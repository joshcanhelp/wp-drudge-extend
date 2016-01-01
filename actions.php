<?php

/**
 * Actions used in the WP-Drudge theme.
 * All of the below are commented out so your site doesn't go all crazy when this plugin is turned on.
 *
 * @see http://wpdrudge.com/docs/extending-wp-drudge/hooks-and-filters for instructions
 *
 * @package   WordPress
 * @subpackage: WP-Drudge
 */

/*
 * Do not allow this file to be loaded directly
 */

if ( ! function_exists( 'add_action' ) ) {
	die( 'Nothing to do...' );
}

/**
 * Output or action before main content is displayed
 */
function wpd_action_hook_before_content () {
	echo '<strong>Here I am!</strong>';
}

// Uncomment the line below to activate this action
// add_action( 'wpd_hook_before_content', 'wpd_action_hook_before_content' );


/**
 * Output or action after main content is displayed
 */
function wpd_action_hook_after_content () {
	echo '<strong>Here I am!</strong>';
}

// Uncomment the line below to activate this action
// add_action( 'wpd_hook_after_content', 'wpd_action_hook_after_content' );


/**
 * Output or action after mobile prompt display, before all other items
 */
function wpd_action_hook_site_top () {
	echo '<strong>Here I am!</strong>';
}

// Uncomment the line below to activate this action
// add_action( 'wpd_hook_site_top', 'wpd_action_hook_site_top' );


/**
 * Output or action at the start of the header
 */
function wpd_action_hook_header_top () {
	echo '<strong>Here I am!</strong>';
}

// Uncomment the line below to activate this action
// add_action( 'wpd_hook_header_top', '' );


/**
 * Output or action after the logo and tagline
 */
function wpd_action_hook_header_middle () {
	echo '<strong>Here I am!</strong>';
}

// Uncomment the line below to activate this action
// add_action( 'wpd_hook_header_middle', '' );


/**
 * Output or action at the end of the header
 */
function wpd_action_hook_header_bottom () {
	echo '<strong>Here I am!</strong>';
}

// Uncomment the line below to activate this action
// add_action( 'wpd_hook_header_bottom', 'wpd_action_hook_header_bottom' );


/**
 * Output or action at the top of the single post page
 */
function wpd_action_hook_single_post_top () {
	echo '<strong>Here I am!</strong>';
}

// Uncomment the line below to activate this action
// add_action( 'wpd_hook_single_post_top', 'wpd_action_hook_single_post_top' );


/**
 * Output or action at the bottom of the single post page, before the comments form
 */
function wpd_action_hook_single_post_bottom () {
	echo '<strong>Here I am!</strong>';
}

// Uncomment the line below to activate this action
// add_action( 'wpd_hook_single_post_bottom', 'wpd_action_hook_single_post_bottom' );


/**
 * Output or action before all featured items
 */
function wpd_action_hook_featured_before () {
	echo '<strong>Here I am!</strong>';
}

// Uncomment the line below to activate this action
// add_action( 'wpd_hook_featured_before', 'wpd_action_hook_featured_before' );


/**
 * Output or action after all featured items
 */
function wpd_action_hook_featured_after () {
	echo '<strong>Here I am!</strong>';
}

// Uncomment the line below to activate this action
// add_action( 'wpd_hook_featured_after', 'wpd_action_hook_featured_after' );


/**
 * Output or action in the posted link widget, before content is displayed
 */
function wpd_action_hook_before_posted_link_widget () {
	echo '<strong>Here I am!</strong>';
}

// Uncomment the line below to activate this action
// add_action( 'wpd_hook_before_posted_link_widget', 'wpd_action_hook_before_posted_link_widget' );


/**
 * Output or action in the posted link widget, after content is displayed
 */
function wpd_action_hook_after_posted_link_widget () {
	echo '<strong>Here I am!</strong>';
}

// Uncomment the line below to activate this action
// add_action( 'wpd_hook_after_posted_link_widget', 'wpd_action_hook_after_posted_link_widget' );


/**
 * Output or action before individual posted link widget items
 */
function wpd_action_hook_before_posted_link () {
	echo '<strong>Here I am!</strong>';
}

// Uncomment the line below to activate this action
// add_action( 'wpd_hook_before_posted_link', 'wpd_action_hook_before_posted_link' );


/**
 * Output or action after individual posted link widget items
 */
function wpd_action_hook_after_posted_link () {
	echo '<strong>Here I am!</strong>';
}

// Uncomment the line below to activate this action
// add_action( 'wpd_hook_after_posted_link', 'wpd_action_hook_after_posted_link' );