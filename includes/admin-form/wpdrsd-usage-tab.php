<?php
/**
 * Display plugin's usage tab.
 *
 * @package    WP Document Revisions Simple Downloads
 * @subpackage Admin Settings
 * @author     David Decker - DECKERWEB
 * @copyright  Copyright 2012-2013, David Decker - DECKERWEB
 * @link       http://genesisthemes.de/en/wp-plugins/wpdr-simple-downloads/
 * @link       http://twitter.com/deckerweb
 *
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL-2.0+
 *
 * @since 1.0.0
 */

/** Action hook 'wpdrsd_usage_tab_before' */
do_action( 'wpdrsd_usage_tab_before' );

?>
<table class="form-table">
<tbody>
	<tr valign="top">
		<th scope="row"><strong><?php _e( 'Insert Downloads', 'wpdr-simple-downloads' ); ?><strong></th>
		<td>
			<fieldset>
				<legend class="screen-reader-text"><span><?php _e( 'Insert Downloads', 'wpdr-simple-downloads' ); ?></span></legend>
				<label for="wpdrsd_insert_downloads">
					<?php _e( 'To insert a download file link into a Post, Page or Custom Post Type, use the regular "Insert Link" feature, search for your Download/ Document file (searches for title!) and insert the actual link. Really simple, yeah!', 'wpdr-simple-downloads' ); ?>
				</label>
			</fieldset>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row"><strong><?php _e( 'Update Downloads', 'wpdr-simple-downloads' ); ?><strong></th>
		<td>
			<fieldset>
				<legend class="screen-reader-text"><span><?php _e( 'Update Downloads', 'wpdr-simple-downloads' ); ?></span></legend>
				<label for="wpdrsd_update_downloads">
					<?php echo sprintf( __( 'To update an existing file/ document just %sopen an existing item%s and upload a new version (revision). The file/ document peramlink will always point to the latest revision! Yes, it\'s so easy :)', 'wpdr-simple-downloads' ), '<a href="' . admin_url( 'edit.php?post_type=document' ) . '">', '</a>' ); ?>
				</label>
			</fieldset>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row"><strong><?php _e( 'Front End Display Options', 'wpdr-simple-downloads' ); ?><strong></th>
		<td>
			<fieldset>
				<legend class="screen-reader-text"><span><?php _e( 'Front End Display Options', 'wpdr-simple-downloads' ); ?></span></legend>
				<label for="wpdrsd_downloads_labels">
					<?php echo sprintf( __( 'You can also use %1$sthird-party plugins%2$s or %3$sWidgets%2$s that support custom post types to query, display or do anything you want with the %4$s post type, that we use for the download files. %5$sShortcodes%2$s from the base plugin are also available. Pretty simple again, yet very effective and WordPress standards compliant.', 'wpdr-simple-downloads' ), '<a href="' . esc_url_raw( WPDRSD_URL_WPORG_FAQ ) . '" target="_new">', '</a>', '<a href="' . admin_url( 'widgets.php' ) . '">', '<code>' . Document . '</code>', '<a href="https://github.com/benbalter/WP-Document-Revisions/wiki/Frequently-Asked-Questions" target="_new">' ); ?>
				</label>
			</fieldset>
		</td>
	</tr>
</tbody>
</table>
<?php

/** Action hook 'wpdrsd_usage_tab_after' */
do_action( 'wpdrsd_usage_tab_after' );
