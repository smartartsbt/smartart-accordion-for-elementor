<?php
/**
* Plugin Name: Smart Accordion for Elementor
* Plugin URI: https://github.com/smartartsbt/smartart-accordion-for-elementor
* Description: A custom widget for Elementor that allows you to easily create an accordion-style content block with toggle functionality in your Elementor-powered WordPress site.
* Version: 1.0.0
* Contributors: smartartsbt
* Author: Szucs Janos
* Author URI: http://smartart.hu
* License: GPL-2.0-or-later
* License URI: http://www.gnu.org/licenses/gpl-2.0.html
* Text Domain: smartart-accordion-for-elementor
* Domain Path: /languages
* Tags: accordion, elementor, widget, collapsible
* Requires at least: 5.0
* Tested up to: 6.0
* Stable tag: 1.0.0
* Requires Plugins: elementor
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Load plugin text domain for translation
function smart_accordion_load_textdomain() {
    // Check if the WordPress version is lower than 4.6
    if ( version_compare( get_bloginfo( 'version' ), '4.6', '<' ) ) {
        // If on older WordPress, load the text domain manually
        $lang_dir = plugin_dir_path( __FILE__ ) . 'languages';
        load_plugin_textdomain( 'smartart-accordion-for-elementor', false, $lang_dir );
        
        // Debug: Check if the language directory exists
        if ( is_dir( $lang_dir ) ) {
            //error_log( 'Language directory exists: ' . $lang_dir );
        } else {
            error_log( 'Language directory does not exist: ' . $lang_dir );
        }
    }
    // If WordPress is 4.6 or newer, WordPress will automatically load the text domain
}

add_action( 'init', 'smart_accordion_load_textdomain' );

/**
 * Register the widget with Elementor.
 */
function register_smartart_accordion_for_elementor_widget( $widgets_manager ) {
    require_once( __DIR__ . '/includes/smartart-accordion-for-elementor-widget.php' );
    $widgets_manager->register( new \Smart_Accordion_Widget() );
}
add_action( 'elementor/widgets/register', 'register_smartart_accordion_for_elementor_widget' );


// Show admin notice if Elementor is missing
function smart_elementor_admin_notice() {
    echo '<div class="error"><p><strong>' . esc_html__( 'Smart Elementor Accordion', 'smartart-accordion-for-elementor' ) . '</strong> ' . esc_html__( 'requires Elementor to be installed and activated.', 'smartart-accordion-for-elementor' ) . '</p></div>';
}

// Register widget assets (CSS and JS)
function smartart_accordion_for_elementor_widget_assets() {
    wp_register_style( 'smartart-accordion-for-elementor-css', plugin_dir_url( __FILE__ ) . 'assets/style.css' );
    wp_register_script( 'smartart-accordion-for-elementor-js', plugin_dir_url( __FILE__ ) . 'assets/script.js', array('jquery'), null, true );
}
add_action( 'wp_enqueue_scripts', 'smartart_accordion_for_elementor_widget_assets' );

// Enqueue frontend scripts and styles
function smartart_accordion_for_elementor_widget_enqueue() {
    wp_enqueue_style( 'smartart-accordion-for-elementor-css' );
    wp_enqueue_script( 'smartart-accordion-for-elementor-js' );
}
add_action( 'wp_enqueue_scripts', 'smartart_accordion_for_elementor_widget_enqueue' );

// Enqueue preview-specific scripts and styles
function smartart_accordion_for_elementor_widget_preview_scripts() {
    wp_enqueue_script( 'smartart-accordion-for-elementor-js' );
}
add_action( 'elementor/preview/enqueue_scripts', 'smartart_accordion_for_elementor_widget_preview_scripts' );

// Enqueue preview-specific styles
function smartart_accordion_for_elementor_widget_preview_styles() {
    wp_enqueue_style( 'smartart-accordion-for-elementor-css' );
}
add_action( 'elementor/preview/enqueue_styles', 'smartart_accordion_for_elementor_widget_preview_styles' );

// Enqueue editor-specific styles
function smartart_accordion_for_elementor_widget_editor_styles() {
    wp_enqueue_style( 'smartart-accordion-for-elementor-css' );
}
add_action( 'elementor/editor/before_enqueue_styles', 'smartart_accordion_for_elementor_widget_editor_styles' );

// Enqueue editor-specific scripts
function smartart_accordion_for_elementor_widget_editor_scripts() {
    wp_enqueue_script( 'smartart-accordion-for-elementor-js' );
}
add_action( 'elementor/editor/before_enqueue_scripts', 'smartart_accordion_for_elementor_widget_editor_scripts' );
