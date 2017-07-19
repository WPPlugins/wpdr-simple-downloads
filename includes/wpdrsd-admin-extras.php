<?php
/**
 * Helper functions for the admin - plugin links.
 *
 * @package    WP Document Revisions Simple Downloads
 * @subpackage Admin
 * @author     David Decker - DECKERWEB
 * @copyright  Copyright 2012-2013, David Decker - DECKERWEB
 * @link       http://genesisthemes.de/en/wp-plugins/wpdr-simple-downloads/
 * @link       http://twitter.com/deckerweb
 *
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL-2.0+
 *
 * @since 1.0.0
 */

/**
 * Setting internal plugin helper links constants.
 *
 * @since 1.0.0
 */
define( 'WPDRSD_URL_TRANSLATE',		'http://translate.wpautobahn.com/projects/wordpress-plugins-deckerweb/wpdr-simple-downloads' );
define( 'WPDRSD_URL_WPORG_FAQ',		'http://wordpress.org/extend/plugins/wpdr-simple-downloads/faq/' );
define( 'WPDRSD_URL_WPORG_FORUM',	'http://wordpress.org/support/plugin/wpdr-simple-downloads' );
define( 'WPDRSD_URL_WPORG_PROFILE',	'http://profiles.wordpress.org/daveshine/' );
define( 'WPDRSD_URL_DOCS',		'https://gist.github.com/4395899' );
define( 'WPDRSD_URL_SNIPPETS',		'https://gist.github.com/4395899' );
define( 'WPDRSD_PLUGIN_LICENSE', 	'GPL-2.0+' );
if ( get_locale() == 'de_DE' || get_locale() == 'de_AT' || get_locale() == 'de_CH' || get_locale() == 'de_LU' ) {
	define( 'WPDRSD_URL_DONATE', 	'http://deckerweb.de/sprachdateien/spenden/' );
	define( 'WPDRSD_URL_PLUGIN',	'http://genesisthemes.de/plugins/wpdr-simple-downloads/' );
} else {
	define( 'WPDRSD_URL_DONATE', 	'http://genesisthemes.de/en/donate/' );
	define( 'WPDRSD_URL_PLUGIN',	'http://genesisthemes.de/en/wp-plugins/wpdr-simple-downloads/' );
}


/**
 * Add "Settings" link to plugin page
 *
 * @since 1.0.0
 *
 * @param  $wpdrsd_links
 * @param  $wpdrsd_settings_link
 *
 * @return strings settings link
 */
function ddw_wpdrsd_settings_page_link( $wpdrsd_links ) {

	/** WPDR Simple Downloads setting page link */
	$wpdrsd_settings_link = sprintf( '<a href="%s" title="%s">%s</a>' , admin_url( 'edit.php?post_type=document&page=wpdrsd-settings' ) , __( 'Go to the WP Document Revisions Simple Downloads settings page', 'wpdr-simple-downloads' ) , __( 'Settings', 'wpdr-simple-downloads' ) );

	/** Set the order of the links */
	array_unshift( $wpdrsd_links, $wpdrsd_settings_link );

	/** Display plugin settings links */
	return apply_filters( 'wpdrsd_filter_settings_page_link', $wpdrsd_links );

}  // end of function ddw_wpdrsd_settings_page_link


add_filter( 'plugin_row_meta', 'ddw_wpdrsd_plugin_links', 10, 2 );
/**
 * Add various support links to plugin page
 *
 * @since 1.0.0
 *
 * @param  $wpdrsd_links
 * @param  $wpdrsd_file
 *
 * @return strings Plugin links.
 */
function ddw_wpdrsd_plugin_links( $wpdrsd_links, $wpdrsd_file ) {

	/** Capability check */
	if ( ! current_user_can( 'install_plugins' ) ) {

		return $wpdrsd_links;

	}  // end-if cap check

	/** List additional links only for this plugin */
	if ( $wpdrsd_file == WPDRSD_PLUGIN_BASEDIR . '/wpdr-simple-downloads.php' ) {

		$wpdrsd_links[] = '<a href="' . esc_url_raw( WPDRSD_URL_WPORG_FAQ ) . '" target="_new" title="' . __( 'FAQ', 'wpdr-simple-downloads' ) . '">' . __( 'FAQ', 'wpdr-simple-downloads' ) . '</a>';
		$wpdrsd_links[] = '<a href="' . esc_url_raw( WPDRSD_URL_WPORG_FORUM ) . '" target="_new" title="' . __( 'Support', 'wpdr-simple-downloads' ) . '">' . __( 'Support', 'wpdr-simple-downloads' ) . '</a>';
		$wpdrsd_links[] = '<a href="' . esc_url_raw( WPDRSD_URL_TRANSLATE ) . '" target="_new" title="' . __( 'Translations', 'wpdr-simple-downloads' ) . '">' . __( 'Translations', 'wpdr-simple-downloads' ) . '</a>';
		$wpdrsd_links[] = '<a href="' . esc_url_raw( WPDRSD_URL_DONATE ) . '" target="_new" title="' . __( 'Donate', 'wpdr-simple-downloads' ) . '"><strong>' . __( 'Donate', 'wpdr-simple-downloads' ) . '</strong></a>';

	}  // end-if plugin links

	/** Output the links */
	return apply_filters( 'wpdrsd_filter_plugin_links', $wpdrsd_links );

}  // end of function ddw_wpdrsd_plugin_links


add_action( 'sidebar_admin_setup', 'ddw_wpdrsd_plugin_help' );
/**
 * Load plugin help tab after core help tabs on Widget admin page.
 *
 * @since 1.0.0
 *
 * @global mixed $pagenow
 */
function ddw_wpdrsd_plugin_help() {

	global $pagenow;

	add_action( 'admin_head-' . $pagenow, 'ddw_wpdrsd_help_tab' );

}  // end of function ddw_wpdrsd_plugin_help


add_action( 'load-edit.php', 'ddw_wpdrsd_documents_cpt_load_help', 100 );
add_action( 'load-post.php', 'ddw_wpdrsd_documents_cpt_load_help', 100 );
add_action( 'load-post-new.php', 'ddw_wpdrsd_documents_cpt_load_help', 100 );
/**
 * Load plugin help tab on WPDR's CPT pages.
 *
 * @since 1.0.0
 *
 * @global mixed $wpdrsd_screen, $post
 */
function ddw_wpdrsd_documents_cpt_load_help() {

	global $wpdrsd_screen, $post;

	$wpdrsd_screen = get_current_screen();

	/** Check for CPT screens */
	if ( ( 'edit' == $wpdrsd_screen->base || 'post' == $wpdrsd_screen->base || 'post-new' == $wpdrsd_screen->base ) && 'document' == $wpdrsd_screen->post_type ) {

		/** Add the help tab */
		$wpdrsd_screen->add_help_tab( array(
			'id'       => 'wpdrsd-documents-help',
			'title'    => __( 'WPDR', 'wpdr-simple-downloads' ) . ' ' . __( 'Simple Downloads', 'wpdr-simple-downloads' ),
			'callback' => 'ddw_wpdrsd_help_content',
		) );

		/** Add help sidebar */
		$wpdrsd_screen->set_help_sidebar( ddw_wpdrsd_help_sidebar_content_extra() . ddw_wpdrsd_help_sidebar_content() );

	}  // end-if screen check

}  // end of function ddw_wpdrsd_documents_cpt_load_help


/**
 * Create and display plugin help tab.
 *
 * @since 1.0.0
 *
 * @global mixed $wpdrsd_screen, $pagenow
 */
function ddw_wpdrsd_help_tab() {

	global $wpdrsd_screen, $pagenow;

	$wpdrsd_screen = get_current_screen();

	/** Display help tabs only for WordPress 3.3 or higher */
	if ( ! class_exists( 'WP_Screen' ) || ! $wpdrsd_screen ) {
		return;
	}

	/** Add the help tab */
	$wpdrsd_screen->add_help_tab( array(
		'id'       => 'wpdr-simple-downloads-help',
		'title'    => __( 'WPDR', 'wpdr-simple-downloads' ) . ' ' . __( 'Simple Downloads', 'wpdr-simple-downloads' ),
		'callback' => 'ddw_wpdrsd_help_content',
	) );

	/** Add help sidebar */
	if ( $pagenow != 'widgets.php' ) {

		$wpdrsd_screen->set_help_sidebar( ddw_wpdrsd_help_sidebar_content_extra() . ddw_wpdrsd_help_sidebar_content() );

	}  // end-if $pagehook check

}  // end of function ddw_wpdrsd_help_tab


/**
 * Create and display plugin help tab content.
 *
 * @since 1.0.0
 *
 * @global mixed $wpdrsd_screen, $pagenow
 */
function ddw_wpdrsd_help_content() {

	echo '<h3>' . __( 'Plugin', 'wpdr-simple-downloads' ) . ': ' . __( 'WP Document Revisions Simple Downloads', 'wpdr-simple-downloads' ) . ' <small>v' . esc_attr( ddw_wpdrsd_plugin_get_data( 'Version' ) ) . '</small></h3>';

	echo ddw_wpdrsd_plugin_help_content_widgets();

	echo ddw_wpdrsd_plugin_help_content_usage();

	echo ddw_wpdrsd_plugin_help_content_links_copyright();

}  // end of function ddw_wpdrsd_help_tab_content


/**
 * Create and display plugin help tab content for 'Usage' section.
 *
 * @since 1.0.0
 *
 * @param $wpdrsd_usage_content
 *
 * @return string HTML help content.
 */
function ddw_wpdrsd_plugin_help_content_usage() {

	$wpdrsd_usage_content = '<p><strong>' . __( 'Insert Downloads', 'wpdr-simple-downloads' ) . ':</strong>' .

		'<br /><blockquote>' . __( 'To insert a download file link into a Post, Page or Custom Post Type, use the regular "Insert Link" feature, search for your Download/ Document file (searches for title!) and insert the actual link. Really simple, yeah!', 'wpdr-simple-downloads' ) . '</blockquote></p>' .

		'<p><strong>' . __( 'Update Downloads', 'wpdr-simple-downloads' ) . ':</strong>' .

		'<br /><blockquote>' . sprintf( __( 'To update an existing file/ document just %sopen an existing item%s and upload a new version (revision). The file/ document peramlink will always point to the latest revision! Yes, it\'s so easy :)', 'wpdr-simple-downloads' ), '<a href="' . admin_url( 'edit.php?post_type=document' ) . '">', '</a>' ) . '</blockquote></p>' .

		'<p><strong>' . __( 'Front End Display Options', 'wpdr-simple-downloads' ) . ':</strong>' .

		'<br /><blockquote>' . sprintf( __( 'You can also use %1$sthird-party plugins%2$s or %3$sWidgets%2$s that support custom post types to query, display or do anything you want with the %4$s post type, that we use for the download files. %5$sShortcodes%2$s from the base plugin are also available. Pretty simple again, yet very effective and WordPress standards compliant.', 'wpdr-simple-downloads' ), '<a href="' . esc_url_raw( WPDRSD_URL_WPORG_FAQ ) . '" target="_new">', '</a>', '<a href="' . admin_url( 'widgets.php' ) . '">', '<code>' . Document . '</code>', '<a href="https://github.com/benbalter/WP-Document-Revisions/wiki/Frequently-Asked-Questions" target="_new">' ) . '</blockquote></p>';

	return apply_filters( 'wpdrsd_filter_help_usage_content', $wpdrsd_usage_content );

}  // end of function ddw_wpdrsd_plugin_help_content_usage


/**
 * Create and display plugin help tab content for 'Widgets' section.
 *
 * @since 1.0.0
 *
 * @param $wpdrsd_widgets_content
 *
 * @return string HTML help content.
 */
function ddw_wpdrsd_plugin_help_content_widgets() {

	$wpdrsd_widgets_content = '<p><strong>' . __( 'Included Widgets by the plugin', 'wpdr-simple-downloads' ) . ':</strong></p>' .
		'<ul>' .
			'<li><strong><em>' . __( 'WPDRSD: Popular Downloads', 'wpdr-simple-downloads' ) . '</em></strong> &ndash; ' . esc_html__( 'Displays the most popular/ accessed Downloads.', 'wpdr-simple-downloads' ) . '</li>' .

			'<li><strong><em>' . __( 'WPDRSD: Search Downloads', 'wpdr-simple-downloads' ) . '</em></strong> &ndash; ' . esc_html__( 'Search for Downloads/ Documents by the WP Documents Revision Simple Downloads plugin. Search in downloads only. (No mix up with regular WordPress search!)', 'wpdr-simple-downloads' ) . '</li>' .

			'<li><strong><em>' . __( 'WPDRSD: File Categories / Tags', 'wpdr-simple-downloads' ) . '</em></strong> &ndash; ' . esc_html__( 'Displays File Categories or File Tags for Downloads.', 'wpdr-simple-downloads' ) . '</li>' .
		'</ul>';

	return apply_filters( 'wpdrsd_filter_help_widgets_content', $wpdrsd_widgets_content );

}  // end of function ddw_wpdrsd_plugin_help_content_widgets


/**
 * Create and display plugin help tab content for 'Links' & 'Copyright' sections.
 *
 * @since 1.0.0
 *
 * @param $wpdrsd_links_copyright_content
 *
 * @return string HTML help content.
 */
function ddw_wpdrsd_plugin_help_content_links_copyright() {

	$wpdrsd_links_copyright_content = '<p><strong>' . __( 'Important plugin links:', 'wpdr-simple-downloads' ) . '</strong>' . 
		'<br /><a href="' . esc_url_raw( WPDRSD_URL_PLUGIN ) . '" target="_new" title="' . __( 'Plugin website', 'wpdr-simple-downloads' ) . '">' . __( 'Plugin website', 'wpdr-simple-downloads' ) . '</a> | <a href="' . esc_url_raw( WPDRSD_URL_WPORG_FAQ ) . '" target="_new" title="' . __( 'FAQ', 'wpdr-simple-downloads' ) . '">' . __( 'FAQ', 'wpdr-simple-downloads' ) . '</a> | <a href="' . esc_url_raw( WPDRSD_URL_WPORG_FORUM ) . '" target="_new" title="' . __( 'Support', 'wpdr-simple-downloads' ) . '">' . __( 'Support', 'wpdr-simple-downloads' ) . '</a> | <a href="' . esc_url_raw( WPDRSD_URL_TRANSLATE ) . '" target="_new" title="' . __( 'Translations', 'wpdr-simple-downloads' ) . '">' . __( 'Translations', 'wpdr-simple-downloads' ) . '</a> | <a href="' . esc_url_raw( WPDRSD_URL_DONATE ) . '" target="_new" title="' . __( 'Donate', 'wpdr-simple-downloads' ) . '"><strong ' . $wpdrsd_legal_style . '>' . __( 'Donate', 'wpdr-simple-downloads' ) . '</strong></a></p>' .

		'<p><a href="http://www.opensource.org/licenses/gpl-license.php" target="_new" title="' . esc_attr( WPDRSD_PLUGIN_LICENSE ). '">' . esc_attr( WPDRSD_PLUGIN_LICENSE ). '</a> &copy; 2012-' . date( 'Y' ) . ' <a href="' . esc_url_raw( ddw_wpdrsd_plugin_get_data( 'AuthorURI' ) ) . '" target="_new" title="' . esc_attr__( ddw_wpdrsd_plugin_get_data( 'Author' ) ) . '">' . esc_attr__( ddw_wpdrsd_plugin_get_data( 'Author' ) ) . '</a></p>';

	return apply_filters( 'wpdrsd_filter_help_links_copyright_content', $wpdrsd_links_copyright_content );

}  // end of function ddw_wpdrsd_plugin_help_content_links_copyright


/**
 * Helper function for returning the Help Sidebar content.
 *
 * @since 1.0.0
 *
 * @param $wpdrsd_help_sidebar
 *
 * @return string/HTML of help sidebar content.
 */
function ddw_wpdrsd_help_sidebar_content() {

	$wpdrsd_help_sidebar = '<p><strong>' . __( 'More about the plugin author', 'wpdr-simple-downloads' ) . '</strong></p>' .
				'<p>' . __( 'Social:', 'wpdr-simple-downloads' ) . '<br /><a href="http://twitter.com/deckerweb" target="_blank" title="@ Twitter">Twitter</a> | <a href="http://www.facebook.com/deckerweb.service" target="_blank" title="@ Facebook">Facebook</a> | <a href="http://deckerweb.de/gplus" target="_blank" title="@ Google+">Google+</a> | <a href="' . esc_url_raw( ddw_wpdrsd_plugin_get_data( 'AuthorURI' ) ) . '" target="_blank" title="@ deckerweb.de">deckerweb</a></p>' .
				'<p><a href="' . esc_url_raw( WPDRSD_URL_WPORG_PROFILE ) . '" target="_blank" title="@ WordPress.org">@ WordPress.org</a></p>';

	return apply_filters( 'wpdrsd_filter_help_sidebar_content', $wpdrsd_help_sidebar );

}  // end of function ddw_wpdrsd_help_sidebar_content


/**
 * Helper function for returning the Help Sidebar content - extra for plugin setting page.
 *
 * @since 1.0.0
 *
 * @param $wpdrsd_help_sidebar_content_extra
 *
 * @return string Extra HTML content for help sidebar.
 */
function ddw_wpdrsd_help_sidebar_content_extra() {

	$wpdrsd_help_sidebar_content_extra = '<p><strong>' . __( 'Actions', 'wpdr-simple-downloads' ) . ':</strong></p>' .
		'<p>&rarr; <a href="' . esc_url_raw( WPDRSD_URL_WPORG_FORUM ) . '" target="_new">' . __( 'Support Forum', 'wpdr-simple-downloads' ) . '</a></p>' .
		'<p style="margin-top: -5px;">&rarr; <a href="' . esc_url_raw( WPDRSD_URL_DONATE ) . '" target="_new">' . __( 'Donate', 'wpdr-simple-downloads' ) . '</a></p>';

	return apply_filters( 'wpdrsd_filter_help_sidebar_content_extra', $wpdrsd_help_sidebar_content_extra );

}  // end of function ddw_wpdrsd_help_sidebar_content_extra
