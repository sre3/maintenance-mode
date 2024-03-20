<?php
/**
 * Plugin Name: Maintenance Mode
 * Version: 1.0.0
 * Description: Display a maintenance mode page, except when logged in as an administrator.
 * Author: sre3
 * Author URI: https://sre303.net
 * Requires at least: 4.0
 * Tested up to: 6.4.3
 *
 * Text Domain: maintenance-mode
 * Domain Path: /languages/
 *
 * @package WordPress
 * @author sre3
 * @copyright Copyright (c) 2023 Ivan Petermann, Copyright (c) 2024 sre3
 * @license   GPL-3.0-or-later
 */

/**
 * Copyright (c) 2023, Ivan Petermann, Copyright (c) 2024 sre3
 * Author: sre3
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, see <https://www.gnu.org/licenses/>.
 */

/**
 * Maintenance Mode
 *
 * Displays a maintenance page for visitors who are not logged in.
 * The login page is excluded, allowing you to log in if necessary.
 *
 * @return void
 */

// Check if the request is from a local address (e.g., '127.0.0.1') or via wp-cli, and if so, exit early
if ($_SERVER['REMOTE_ADDR'] == '127.0.0.1' || defined('WP_CLI') && WP_CLI) {
    return; // Local and wp-cli requests are handled differently; no further processing needed
}

// Check if it's a POST request to the wp-json endpoint
if ($_SERVER['REQUEST_METHOD'] === 'POST' && strpos($_SERVER['REQUEST_URI'], '/wp-json/') !== false) {
    // If it is, skip further processing for this case
    return; // No action needed for POST requests to wp-json
}

function sre3_maintenance_mode()
{
    global $pagenow;

    if ($pagenow !== 'wp-login.php' && !current_user_can('manage_options') && !is_admin() && !is_user_logged_in() && get_option('sre3_maintenance_mode_options')['sre3_maintenance_mode_field_toggle'] == 'enabled') {

        @header('HTTP/1.1 503 Service Temporarily Unavailable');
        @header('Status: 503 Service Temporarily Unavailable');
        @header('Retry-After: 300');
        @header('Content-Type: text/html; charset=utf-8');

        if (file_exists(plugin_dir_path(__FILE__) . 'views/maintenance-page.php')) {
            require_once plugin_dir_path(__FILE__) . 'views/maintenance-page.php';
        }
        exit();
    }
}

// Custom Settings Page

function sre3_maintenance_mode_settings_init() {
	register_setting( 'sre3_maintenance_mode', 'sre3_maintenance_mode_options' );

	add_settings_section(
		'sre3_maintenance_mode_main',
		__( '', 'sre3_maintenance_mode' ), 'sre3_maintenance_mode_main_callback',
		'sre3_maintenance_mode'
	);

	add_settings_field(
		'sre3_maintenance_mode_field_toggle',
			__( 'Maintenance mode is currently:', 'sre3_maintenance_mode' ),
		'sre3_maintenance_mode_field_toggle_cb',
		'sre3_maintenance_mode',
		'sre3_maintenance_mode_main',
		array(
			'label_for'         => 'sre3_maintenance_mode_field_toggle',
			'class'             => 'sre3_maintenance_mode_row',
			'sre3_maintenance_mode_custom_data' => 'custom',
		)
	);
}

add_action( 'admin_init', 'sre3_maintenance_mode_settings_init' );

function sre3_maintenance_mode_main_callback( $args ) {
	?>
	<p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'Use the box to toggle maintenance mode.', 'sre3_maintenance_mode' ); ?></p>
	<?php
}

function sre3_maintenance_mode_field_toggle_cb( $args ) {
	$options = get_option( 'sre3_maintenance_mode_options' );
	?>
	<select
			id="<?php echo esc_attr( $args['label_for'] ); ?>"
			data-custom="<?php echo esc_attr( $args['sre3_maintenance_mode_custom_data'] ); ?>"
			name="sre3_maintenance_mode_options[<?php echo esc_attr( $args['label_for'] ); ?>]">
		<option value="enabled" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'enabled', false ) ) : ( '' ); ?>>
			<?php esc_html_e( 'Enabled', 'sre3_maintenance_mode' ); ?>
		</option>
 		<option value="disabled" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'disabled', false ) ) : ( '' ); ?>>
			<?php esc_html_e( 'Disabled', 'sre3_maintenance_mode' ); ?>
		</option>
	</select>
	<?php
}

function sre3_maintenance_mode_options_page() {
	add_options_page(
		'Maintenance Mode',
		'Maintenance Mode',
		'manage_options',
		'sre3_maintenance_mode',
		'sre3_maintenance_mode_options_page_html'
	);
}

add_action( 'admin_menu', 'sre3_maintenance_mode_options_page' );

function sre3_maintenance_mode_options_page_html() {
	if ( !current_user_can( 'manage_options' ) ) {
		return;
	}

	settings_errors( 'sre3_maintenance_mode_messages' );
	
	?>
	<div class="wrap">
		<h1>Maintenance Mode Options</h1>
		<form action="options.php" method="post">
			<?php
			settings_fields( 'sre3_maintenance_mode' );
			do_settings_sections( 'sre3_maintenance_mode' );
			submit_button( 'Save Settings' );
			?>
		</form>
	</div>
	<?php
}

add_action('wp_loaded', 'sre3_maintenance_mode'); 

?>
