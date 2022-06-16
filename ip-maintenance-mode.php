<?php
/*
 * Plugin Name: IP Maintenance Mode
 * Version: 1.1.8
 * Description: Display a maintenance mode page, except when logged in as Admin or using the /?view=1 parameter in the URL.
 * Author: Ivan Petermann
 * Author URI: https://ivanpetermann.com
 * Requires at least: 4.0
 * Tested up to: 6.0
 *
 * Text Domain: ip-maintenance-mode
 * Domain Path: /languages/
 *
 * @package WordPress
 * @author Ivan Petermann
 * @since 1.1.8
 */

/*
Copyright 2018 Ivan Petermann  (email : contato@ivanpetermann.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

/**
 * Maintenance Page
 *
 * Displays the coming soon page for anyone who's not logged in.
 * The login page gets excluded so that you can login if necessary.
 *
 * @return void
 */

/**
 * For WP-CLI
 */
if ($_SERVER['REMOTE_ADDR'] == '127.0.0.1') return;

function ip_maintenance_mode() {
    // Start the session
    if ( ! session_id() )
	    @session_start();

    global $pagenow;
    $_ip_view_site   = (isset($_SESSION['_ipmp_view_site_']) AND $_SESSION['_ipmp_view_site_'] == 'true') ? true : false;

    if ((isset($_GET['view']) AND $_GET['view'] == '0') or (isset($_GET['versite']) AND $_GET['versite'] == '0')) {
        $_SESSION['_ipmp_view_site_'] = false;
        wp_redirect(home_url());
        exit;
    } elseif ((isset($_GET['view']) AND $_GET['view'] == '1') or (isset($_GET['versite']) AND $_GET['versite'] == '1')) {
        $_SESSION['_ipmp_view_site_'] = true;
        wp_redirect(home_url());
        exit;
    }

    if ($pagenow !== 'wp-login.php' && $_ip_view_site !== true && !current_user_can('manage_options') && !is_admin() && !is_user_logged_in()) {
        $_ip_previa_path = $_SERVER['DOCUMENT_ROOT'] . '/previa/';
        if (is_dir($_ip_previa_path)) {
            wp_redirect('/previa/');
            exit;
        } else {
            header('HTTP/1.1 503 Service Temporarily Unavailable');
            header('Status: 503 Service Temporarily Unavailable');
            header('Retry-After: 300');
            header('Content-Type: text/html; charset=utf-8');
            if (file_exists(plugin_dir_path(__FILE__) . 'views/maintenance.php')) {
                require_once plugin_dir_path(__FILE__) . 'views/maintenance.php';
            }
            die();
        }
    }
}

add_action('wp_loaded', 'ip_maintenance_mode');
