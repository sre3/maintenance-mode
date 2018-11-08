<?php
/*
 * Plugin Name: IP Maintenance Mode
 * Version: 1.0.5
 * Description: Displays a maintenance mode page except when logged in as Admin or by the query /?versite=1
 * Author: Ivan Petermann
 * Author URI: https://ivanpetermann.com
 * Requires at least: 4.0
 * Tested up to: 4.8
 *
 * Text Domain: ip-maintenance-mode
 * Domain Path: /languages/
 *
 * @package WordPress
 * @author Ivan Petermann
 * @since 1.0.5
 */

/*
Copyright 2018 Ivan Petermann  (email : contato@ivanpetermann.com.br)

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
function ip_maintenance_mode() {
    global $pagenow;
    $_ip_get_name    = 'versite';
    $_ip_cookie_name = '_ip_view_site_';
    $_ip_view_site   = (isset($_COOKIE[$_ip_cookie_name]) AND $_COOKIE[$_ip_cookie_name] == 'yes') ? true : false;

    if (isset($_GET[$_ip_get_name]) AND $_GET[$_ip_get_name] == '0') {
        setcookie($_ip_cookie_name, '', time() - (15 * 60));
        wp_redirect(home_url());
        exit;
    } elseif (isset($_GET[$_ip_get_name]) AND $_GET[$_ip_get_name] == '1') {
        setcookie($_ip_cookie_name, 'yes', 30 * DAYS_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN);
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
