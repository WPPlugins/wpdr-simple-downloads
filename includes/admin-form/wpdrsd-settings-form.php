<?php
/**
 * Plugin's admin settings form.
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

/** Set variables */
$current = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'settings';
$tabs = array(
	'settings' => __( 'Download Settings', 'wpdr-simple-downloads' ),
	'usage'    => __( 'Usage', 'wpdr-simple-downloads' )
);

?>
<div class="wrap">
	<h2><?php _e( 'WP Document Revisions', 'wpdr-simple-downloads' ); ?> &rsaquo; <?php _e( 'Simple Downloads', 'wpdr-simple-downloads' ); ?></h2>
	<div id="icon-downloads-settings" class="icon32"><br></div>
	<h2 class="nav-tab-wrapper">
	<?php

		foreach ( $tabs as $tab => $name ) {

			$class = ( $tab == $current ) ? ' nav-tab-active' : '';

			echo '<a class="nav-tab' . $class . '" href="' . admin_url( 'edit.php?post_type=document&page=wpdrsd-settings&tab=' . $tab . '' ) . '">' . $name . '</a>';

		}  // end foreach

	?>
	</h2>
	<div id="wpdrsd-panel" class="wpdrsd-panel-<?php echo $current; ?>">
		<?php include( WPDRSD_PLUGIN_DIR . '/includes/admin-form/wpdrsd-' . $current . '-tab.php' ); ?>
	</div><!-- end #wpdrsd-panel .wpdrsd-panel-$current -->
</div><!-- end .wrap -->
