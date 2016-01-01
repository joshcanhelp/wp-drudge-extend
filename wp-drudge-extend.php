<?php
/**
 * Plugin Name: WP-Drudge Extend
 * Plugin URI: http://wpdrudge.com/docs/extending-wp-drudge/hooks-and-filters
 * Description: examples for how to extend WP-Drudge
 * Version: 2.7.2
 * Author: PROPER Web Development
 * Author URI: http://theproperweb.com
 * License: GPLv2 or later
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

/*
 * Filters used to transform data during processing
 */

require_once( 'filters.php' );

/*
 * Actions used to do a certain thing at a certain time when loading WordPress
 */

require_once( 'actions.php' );

/**
 * Other miscellaneous fun stuff you can do!
 */

require_once( 'other.php' );

/*
 * Add your custom WP-CLI scripts in the file below
 */

if ( defined( 'WP_CLI' ) && WP_CLI ) {
	require_once( 'wp-cli.php' );
}
