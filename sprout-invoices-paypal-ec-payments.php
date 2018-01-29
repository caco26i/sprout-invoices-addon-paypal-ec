<?php
/*
Plugin Name: Sprout Invoices Add-on - Paypal Express Checkout
Plugin URI: https://sproutapps.co/marketplace/paypal-express-checkout/
Description: Accept Paypal Payments with Sprout Invoices.
Author: Sprout Apps
Version: 1.5.1
Author URI: https://sproutapps.co
*/

/**
 * Plugin File
 */
define( 'SA_ADDON_PAYPAL_EC_VERSION', '1.5.1' );
define( 'SA_ADDON_PAYPAL_EC_DOWNLOAD_ID', 1287 );
define( 'SA_ADDON_PAYPAL_EC_FILE', __FILE__ );
define( 'SA_ADDON_PAYPAL_EC_NAME', 'Sprout Invoices Paypal EC Payments' );
define( 'SA_ADDON_PAYPAL_EC_URL', plugins_url( '', __FILE__ ) );


// Load up the processor before updates
add_action( 'si_payment_processors_loaded', 'sa_load_paypal_ec' );
function sa_load_paypal_ec() {
	if ( ! class_exists( 'SI_Paypal_EC' ) ) {
		require_once( 'SI_Paypal_EC.php' );
	} else {
		// deactivate plugin if the pro version is installed.
		require_once ABSPATH.'/wp-admin/includes/plugin.php';
		deactivate_plugins( __FILE__ );
	}
}

// Load up the updater after si is completely loaded
add_action( 'sprout_invoices_loaded', 'sa_load_paypal_ec_updates' );
function sa_load_paypal_ec_updates() {
	if ( class_exists( 'SI_Updates' ) ) {
		require_once( 'inc/sa-updates/SA_Updates.php' );
	}
}
