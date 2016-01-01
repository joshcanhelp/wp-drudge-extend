<?php
/**
 * Other misc fun stuff that's possible with the theme
 *
 * @package WordPress
 * @subpackage: WP-Drudge
 */

/*
 * Do not allow this file to be loaded directly
 */

if ( ! function_exists( 'add_action' ) ) {
	die( 'Nothing to do...' );
}

/**
 * Change theme settings on output based on a URL parameter
 * This is what I use on the demo site to show different styles on the same page
 */

function wpd_mod_theme_settings( $settings ) {

	if ( empty( $_GET['theme'] ) ) {
		return $settings;
	}

	if ( $_GET['theme'] == 'drudge' ) {
		$settings['wpd_display_logo']         = '';
		$settings['wpd_display_tagline']      = '';
		$settings['wpd_display_featured']     = 'above';
		$settings['wpd_display_featured_num'] = 1;
		$settings['wpd_display_featoncat']    = 'not displayed';
		$settings['wpd_display_catlisting']   = '';

		$settings['wpd_style_bgcolor']      = '#fff';
		$settings['wpd_style_wrapcolor']    = '#fff';
		$settings['wpd_style_menubgcolor']  = '#ddd';
		$settings['wpd_style_navlinkcolor'] = '#222';
		$settings['wpd_style_headcolor']    = '#000';
		$settings['wpd_style_linkcolor']    = '#000';
		$settings['wpd_style_vlinkcolor']   = '#000';
		$settings['wpd_style_textcolor']    = '#000';

		$settings['wpd_style_colborder']  = 'medium';
		$settings['wpd_style_boxborder']  = 'medium';
		$settings['wpd_style_linkborder'] = 'medium';

		$settings['wpd_display_postedlink_border'] = '';
		$settings['wpd_display_staticlink_border'] = '';

		$settings['wpd_style_featfont']  = 'Arial';
		$settings['wpd_style_feat_size'] = 48;
		$settings['wpd_style_navsize']   = 12;
		$settings['wpd_style_headfont']  = 'Arial';
		$settings['wpd_style_headsize']  = 32;
		$settings['wpd_style_headbold']  = 'yes';
		$settings['wpd_style_linkfont']  = 'Drudge';
		$settings['wpd_style_linksize']  = 13;
		$settings['wpd_style_descsize']  = 12;
		$settings['wpd_style_pagesize']  = 13;

		$settings['wpd_style_linkstyle'] = 'yes';
		$settings['wpd_style_linkbold']  = '';

		$settings['wpd_display_fimage']      = 'above';
		$settings['wpd_style_featimgsize']   = 450;
		$settings['wpd_display_image']       = 'top';
		$settings['wpd_style_postimgsize']   = 200;
		$settings['wpd_display_singleimage'] = 'no';

		$settings['wpd_display_layout']       = 'fluid (full)';
		$settings['wpd_display_spacing']      = 'tight';
		$settings['wpd_display_newtab']       = '';
		$settings['wpd_display_comlink']      = '';
		$settings['wpd_display_showdomain']   = '';
		$settings['wpd_display_interrupt']    = '';
		$settings['wpd_display_postinfo']     = '';
		$settings['wpd_display_linkcatheads'] = '';
		$settings['wpd_display_fbcomments']   = '';

		$settings['wpd_style_morecss'] = '
		#header #logo-or-name {font-family: impact; text-shadow: #ccc -1px 0, #ccc -2px 0, #ccc -3px 1px, #ccc -4px 1px, #ccc -5px 1px, #ccc -6px 2px, #ccc -7px 2px; font-size: 80px; font-weight: normal; font-style: italic; text-transform: uppercase; color: black; text-decoration: none}

		.link-col .widget-box .widget-head,
		.link-col .link-content,
		.featured-wrap .link-content { display: none; }
		';
	}

	if ( $_GET['theme'] == 'journalist' ) {
		$settings['wpd_display_logo']         = '';
		$settings['wpd_display_tagline']      = 'yes';
		$settings['wpd_display_featured']     = 'below';
		$settings['wpd_display_featured_num'] = 0;
		$settings['wpd_display_featoncat']    = 'not displayed';
		$settings['wpd_display_catlisting']   = '';

		$settings['wpd_style_bgcolor']      = '#fff';
		$settings['wpd_style_wrapcolor']    = '#fff';
		$settings['wpd_style_menubgcolor']  = '#ddd';
		$settings['wpd_style_navlinkcolor'] = '#222';
		$settings['wpd_style_headcolor']    = '#000';
		$settings['wpd_style_linkcolor']    = '#222';
		$settings['wpd_style_vlinkcolor']   = '#555';
		$settings['wpd_style_textcolor']    = '#000';

		$settings['wpd_style_colborder']  = 'light';
		$settings['wpd_style_boxborder']  = 'none';
		$settings['wpd_style_linkborder'] = 'light';

		$settings['wpd_display_postedlink_border'] = 'yes';
		$settings['wpd_display_staticlink_border'] = 'yes';

		$settings['wpd_style_featfont']  = 'Georgia';
		$settings['wpd_style_feat_size'] = 36;
		$settings['wpd_style_navsize']   = 12;
		$settings['wpd_style_headfont']  = 'Georgia';
		$settings['wpd_style_headsize']  = 32;
		$settings['wpd_style_headbold']  = '';
		$settings['wpd_style_linkfont']  = 'Georgia';
		$settings['wpd_style_linksize']  = 17;
		$settings['wpd_style_descsize']  = 14;
		$settings['wpd_style_pagesize']  = 14;

		$settings['wpd_style_linkstyle'] = 'yes';
		$settings['wpd_style_linkbold']  = '';

		$settings['wpd_display_fimage']      = 'above';
		$settings['wpd_style_featimgsize']   = 400;
		$settings['wpd_display_image']       = 'top';
		$settings['wpd_style_postimgsize']   = 400;
		$settings['wpd_display_singleimage'] = 'no';

		$settings['wpd_display_layout']       = 'fixed';
		$settings['wpd_display_spacing']      = 'spacious';
		$settings['wpd_display_newtab']       = '';
		$settings['wpd_display_comlink']      = '';
		$settings['wpd_display_showdomain']   = '';
		$settings['wpd_display_interrupt']    = 'yes';
		$settings['wpd_display_postinfo']     = '';
		$settings['wpd_display_linkcatheads'] = '';
		$settings['wpd_display_fbcomments']   = '';

		$settings['wpd_style_morecss'] = '
		body {background-color: #fff !important}

		#header {
			border-top: #aaa 1px solid;
			border-bottom: #aaa 1px solid;
		}

		#header #logo-or-name {
			font-size: 6em;
			text-decoration: none;
			color: #222;
		}
		';
	}

	return $settings;
}

// add_filter( 'wpd_theme_settings_output', 'wpd_mod_theme_settings' );
