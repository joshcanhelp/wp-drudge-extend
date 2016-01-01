<?php

/**
 * Filters used in the WP-Drudge theme.
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
 * Add theme settings to the WP-Drudge options page
 * To find existing settings field names, either use the name attribute on the Options field ...
 * ... or look in /wp-drudge-v2/inc/settings.php, array returned by wpdrudge_get_options_array()
 *
 * @param $settings
 *
 * @return mixed
 */
function wpd_add_some_theme_settings ( $settings ) {

	// Add a new setting field on a new tab
	$settings['your_setting_id'] = array(

		// Setting label
		'name'          => 'Setting Title',
		// Description text below the field
		'desc'          => 'Setting description',
		// Field type
		// Types: text, number, email, url, textarea, select, checkbox, color, callback,
		//      title, html, break, radio
		'type'          => 'text',
		// Initial value of the setting, used when no setting has been saved yet
		'default'       => '',
		// Asscoiative array of options for select, radio, and checkbox field types
		'options'       => array(),
		// Settings tab name
		'category'      => 'Your New Category',
		// Settings tab slug, numbers, letters, dashes, and underscores only
		'category-slug' => 'your-new-category-slug'
	);

	// Remove a settings field
	unset( $settings['existing_setting_id'] );

	// Change an existing settings field
	$settings['existing_setting_id']['default'] = 'A default';

	return $settings;
}

// Uncomment the line below to activate this filter
// add_filter( 'wpd_theme_settings', 'wpd_add_some_theme_settings' );


/**
 * Modifies the theme settings on output to force a certain value
 *
 * @param $settings
 *
 * @return mixed
 */
function wpd_filter_theme_settings_output ( $settings ) {

	// Change settings field values on output
	$settings['existing_setting_id'] = 'value';

	// Change settings on specific pages
	if ( is_page() ) {
		$settings['existing_setting_id'] = 'value';
	}

	return $settings;
}

// Uncomment the line below to activate this filter
// add_filter( 'wpd_theme_settings_output', 'wpd_filter_theme_settings_output' );


/**
 * Modifies the 404 page title text on sub-pages
 * This can be done on the Options page as of v2.7.1
 *
 * @param $text
 *
 * @return string
 */
function wpd_filter_404_text ( $text ) {

	$text .= ' ... so search for it!';

	return $text;
}

// Uncomment the line below to activate this filter
// add_filter( 'wpd_404_text', 'wpd_filter_404_text' );


/**
 * Modifies the page title text on archive pages
 * This can be done on the Options page as of v2.5.1
 *
 * @param $text
 *
 * @return string
 */
function wpd_filter_archive_page_title ( $text ) {

	if ( is_tag() ) {
		$text = 'We are on a Tag Archive page';
	}

	return $text;
}

// Uncomment the line below to activate this filter
// add_filter( 'wpdrudge_archive_page_title', 'wpd_filter_archive_page_title' );


/**
 * Modifies the home link text on sub-pages
 * This can be done on the Options page as of v2.4
 *
 * @param $text
 *
 * @return string
 */
function wpd_filter_home_link_text ( $text ) {

	$text .= ' ... adding a little more text here';

	return $text;
}

// Uncomment the line below to activate this filter
// add_filter( 'wpdrudge_home_link', 'wpd_filter_home_link_text' );


/**
 * Add new meta fields to save to the post
 *
 * @param $metas
 *
 * @return array
 */
function wpd_add_some_metas ( $metas ) {

	$metas['my_image_size'] = array(
		// Machine name for this meta
		'name'        => 'my_image_size',
		// Title displayed on the post edit page
		'title'       => 'Image size',
		// Description displayed on the post edit page
		'description' => '',
		// Field type, choose from text, textarea, editor, select, checkbox, color
		'type'        => 'number',
		// Default value for this meta field
		'default'     => ''
	);

	return $metas;
}

// Uncomment the line below to activate this filter
// add_filter( 'wpd_post_metas', 'wpd_add_some_metas' );


/**
 * Transforms the main link attribute for a posted link
 *
 * @param string $link - the link itself
 * @param int $pid - post ID for the posted link
 * @param bool $widget - whether this is being used in a widget or not
 *
 * @return string
 */
function wpd_filter_link_text ( $link, $pid, $widget ) {

	// Change the link if we're displaying in a widget
	if ( $widget ) {
		$link = get_permalink( $pid );
	}

	return $link;
}

// Uncomment the line below to activate this filter
//add_filter( 'wpd_link_text', 'wpd_filter_link_text', 10, 3 );


/**
 * Transforms the link out URL, pulled from the outbound link
 *
 * @param string $link - the outbound link
 * @param int $pid - post ID for the posted link
 * @param bool $widget - whether this is being used in a widget or not
 *
 * @return string
 */
function wpd_filter_link_out_text ( $link, $pid, $widget ) {

	// Add an affiliate code to outbound links
	if ( $link ) {
		$link = add_query_arg( 'aff', 1234, $link );
	}

	return $link;
}

// Uncomment the line below to activate this filter
//add_filter( 'wpd_link_out_text', 'wpd_filter_link_out_text', 10, 3 );


/**
 * Link title text for posts before any other transformations, straight from get_the_title()
 *
 * @param string $title - title text from get_the_title
 * @param int $pid - post ID
 *
 * @return string
 */
function wpd_filter_title_text_raw ( $title, $pid ) {

	if ( has_term( 'Breaking', 'category', $pid ) ) {
		$title = 'BREAKING: ' . $title;
	}

	return $title;
}

// Uncomment the line below to activate this filter
//add_filter( 'wpd_title_text_raw', 'wpd_filter_title_text_raw', 10, 2 );


/**
 * Link title text before display
 *
 * @param $title - title text before display
 * @param int $pid - post ID
 *
 * @return string
 */
function wpd_filter_title_text ( $title, $pid ) {

	$title .= ' - GO &rarr;';
	return $title;
}

// Uncomment the line below to activate this filter
//add_filter( 'wpd_title_text', 'wpd_filter_title_text', 10, 2 );


/**
 * Additional CSS added to the main link headline
 *
 * @param string $css
 * @param int $pid - post ID
 *
 * @return string
 */
function wpd_filter_link_css ( $css, $pid ) {

	// Make the link red if this is the breaking category
	if ( has_term( 'Breaking', 'category', $pid ) ) {

		// Make sure semicolons are correct
		$css = trim( $css );
		if ( isset( $css[ strlen( $css ) - 1 ] ) && $css[ strlen( $css ) - 1 ] != ';' ) {
			$css .= ';';
		}

		$css .= 'color: red;';
	}

	return $css;
}

// Uncomment the line below to activate this filter
//add_filter( 'wpd_link_css', 'wpd_filter_link_css', 10, 2 );


/**
 * Add attributes to the main headline link
 * Does not affect additional links
 *
 * @param string $insert
 * @param int $pid - post ID
 *
 * @return string
 */
function wpd_filter_link_insert ( $insert, $pid ) {

	// Add a nofollow attribute if we're on the archive page and this is a posted link
	if ( is_archive() && get_post_meta( $pid, 'link', TRUE ) ) {
		$insert .= ' rel="nofollow"';
	}

	return $insert;
}

// Uncomment the line below to activate this filter
// add_filter( 'wpd_link_insert', 'wpd_filter_link_insert', 10, 2 );


/**
 * Transforms blurb text
 *
 * @param string $blurb - raw blurb text
 * @param int $pid - post ID
 * @param bool $widget - are we displaying in a widget?
 *
 * @return string
 */
function wpd_filter_blurb_text ( $blurb, $pid, $widget ) {

	// Indicate posted links as offline in the blurb on widgets
	if ( $widget && get_post_meta( $pid, 'link', TRUE ) ) {
		$blurb .= ' [OFFSITE]';
	}

	return $blurb;
}

// Uncomment the line below to activate this filter
//add_filter( 'wpd_blurb_text', 'wpd_filter_blurb_text', 10, 3 );


/**
 * Transforms the date displayed on posted link widgets
 *
 * @param string $date - publish date text
 * @param int $pid - post ID
 *
 * @return string
 */
function wpd_filter_date_text ( $date, $pid ) {

	$timecode = get_the_time( 'U', $pid );
	$pub_date = date( 'm/d/Y', $timecode );

	if ( date( 'm/d/Y', current_time( 'timestamp' ) ) == $pub_date ) {
		$date = __( 'Today', 'wpdrudge' );
	}

	return $date;
}

// Uncomment the line below to activate this filter
//add_filter( 'wpd_date_text', 'wpd_filter_date_text', 10, 2 );


/**
 * Transforms the comment link text
 *
 * @param string $text - comment link text
 * @param int $pid - post ID
 *
 * @return string
 */
function wpd_filter_comment_text ( $text, $pid ) {

	if ( get_comments_number( $pid ) ) {

		// Post has comments already
		$text = 'Join the discussion!';
	} else {

		// Post has no comments
		$text = 'Be the first to comment!';
	}

	return $text;
}

// Uncomment the line below to activate this filter
//add_filter( 'wpd_comment_text', 'wpd_filter_comment_text', 10, 2 );


/**
 * Alter the image width for featured images
 *
 * @param int $width - image width from the options page
 * @param int $pid - post ID
 *
 * @return mixed
 */
function wpd_filter_imgsize_feat ( $width, $pid ) {

	//Posted in the "Breaking" category get a larger image
	if ( has_term( 'Breaking', 'category', $pid ) ) {
		$width = 800;
	}

	return $width;
}

// Uncomment the line below to activate this filter
//add_filter( 'wpd_imgsize_feat', 'wpd_filter_imgsize_feat', 10, 2 );


/**
 * Alter the image width for single post page images
 *
 * @param int $width - image width from the options page
 * @param int $pid   - post ID
 *
 * @return mixed
 */
function wpd_filter_imgsize_single ( $width, $pid ) {

	// Featured posts on single post pages get a larger image
	if ( get_post_meta( $pid, 'featured', TRUE ) ) {
		$width = 1000;
	}

	return $width;
}

// Uncomment the line below to activate this filter
//add_filter( 'wpd_imgsize_single', 'wpd_filter_imgsize_single', 10, 2 );


/**
 * Alter the image width for widget posted link images
 *
 * @param int $width - image width from the options page
 * @param int $pid   - post ID
 *
 * @return mixed
 */
function wpd_filter_imgsize_posted ( $width, $pid ) {

	// Non-featured posts in widgets get a smaller image
	if ( ! get_post_meta( $pid, 'featured', TRUE ) ) {
		$width = 100;
	}

	return $width;
}

// Uncomment the line below to activate this filter
//add_filter( 'wpd_imgsize_posted', 'wpd_filter_imgsize_posted', 10, 2 );


/**
 * Override or modify the default caption text
 *
 * @param string $content - existing caption
 * @param int $pid - post ID
 *
 * @return string
 */
function wpd_filter_caption_text ( $content, $pid ) {

	$content = 'Photos by <a href="#">PROPER Photography</a>';
	return $content;
}

// Uncomment the line below to activate this filter
// add_filter( 'wpd_caption_text', 'wpd_filter_caption_text', 10, 2 );


/**
 * Override or modify the posted link image
 *
 * @param string $image - image URL
 * @param int    $pid     - post ID
 *
 * @return string
 */
function wpd_filter_image ( $image, $pid ) {

	// Set a default image if none was addedbased on category
	if ( empty( $image ) ) {
		if ( has_term( 'Security', 'category', $pid ) ) {
			$image = 'http://mysite.com/wp-content/2015/02/default-security-image.jpg';
		} else if ( has_term( 'Safety', 'category', $pid ) ) {
			$image = 'http://mysite.com/wp-content/2015/02/default-safety-image.jpg';
		}
	}

	return $image;
}

// Uncomment the line below to activate this filter
//add_filter( 'wpd_image', 'wpd_filter_image', 10, 2 );


/**
 * Modify all link elements before returning for display
 *
 * @param $link
 * @param $pid
 *
 * @return array
 */
function wpd_filter_processed_link ( $link, $pid ) {

	$new_link = array(
		'link_insert'   => $link['link_insert'],
		'link_out'      => $link['link_out'],
		'link'          => $link['link'],
		'link_html'     => $link['link_html'],
		'add_link_html' => $link['add_link_html'],
		'link_css'      => $link['link_css'],
		'title'         => $link['title'],
		'blurb'         => $link['blurb'],
		'blurb_text'    => $link['blurb_text'],
		'date'          => $link['date'],
		'comment_url'   => $link['comment_url'],
		'comment_text'  => $link['comment_text'],
		'image_html'    => $link['image_html'],
		'image'         => $link['image'],
		'class_insert'  => $link['class_insert']
	);

	return $new_link;
}

// Uncomment the line below to activate this filter
// add_filter( 'wpd_processed_link', 'wpd_filter_processed_link', 10, 2 );
