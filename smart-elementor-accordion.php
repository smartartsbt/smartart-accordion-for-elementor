<?php
/**
* Plugin Name: Smart Elementor Accordion
* Plugin URI: http://smartart.hu
* Description: A custom Elementor widget that allows you to easily create an accordion-style content block with toggle functionality in your Elementor-powered WordPress site.
* Version: 1.0.0
* Contributors: smartartsbt
* Author: Szucs Janos
* Author URI: http://smartart.hu
* License: GPL-2.0-or-later
* License URI: http://www.gnu.org/licenses/gpl-2.0.html
* Text Domain: smart-elementor-accordion
* Domain Path: /languages
* Tags: accordion, elementor, widget, collapsible
* Requires at least: 5.0
* Tested up to: 6.0
* Stable tag: 1.0.0
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Load plugin text domain for translation
function smart_accordion_load_textdomain() {
    $lang_dir = plugin_dir_path( __FILE__ ) . 'languages';
    load_plugin_textdomain( 'smart-elementor-accordion', false, $lang_dir );
    
    // Debug: Check if the language directory exists
    if ( is_dir( $lang_dir ) ) {
        //error_log( 'Language directory exists: ' . $lang_dir );
    } else {
        error_log( 'Language directory does not exist: ' . $lang_dir );
    }
    if ( ! load_plugin_textdomain( 'smart-elementor-accordion', false, $lang_dir ) ) {
        error_log( 'Failed to load Smart Accordion language files.' );
    } else {
        //error_log( 'Smart Accordion language files loaded successfully.' );
    }
}

add_action( 'plugins_loaded', 'smart_accordion_load_textdomain' );

/**
 * Register the widget with Elementor.
 */
function register_smart_accordion_widget( $widgets_manager ) {
    require_once( __DIR__ . '/includes/smart-accordion-widget.php' );
    $widgets_manager->register( new \Smart_Accordion_Widget() );
}
add_action( 'elementor/widgets/register', 'register_smart_accordion_widget' );


// Show admin notice if Elementor is missing
function smart_elementor_admin_notice() {
    echo '<div class="error"><p><strong>' . esc_html__( 'Smart Elementor Accordion', 'smart-elementor-accordion' ) . '</strong> ' . esc_html__( 'requires Elementor to be installed and activated.', 'smart-elementor-accordion' ) . '</p></div>';
}

// Register widget assets (CSS and JS)
function smart_accordion_widget_assets() {
    wp_register_style( 'smart-accordion-css', plugin_dir_url( __FILE__ ) . 'assets/style.css' );
    wp_register_script( 'smart-accordion-js', plugin_dir_url( __FILE__ ) . 'assets/script.js', array('jquery'), null, true );
}
add_action( 'wp_enqueue_scripts', 'smart_accordion_widget_assets' );

// Enqueue frontend scripts and styles
function smart_accordion_widget_enqueue() {
    wp_enqueue_style( 'smart-accordion-css' );
    wp_enqueue_script( 'smart-accordion-js' );
}
add_action( 'wp_enqueue_scripts', 'smart_accordion_widget_enqueue' );

// Enqueue preview-specific scripts and styles
function smart_accordion_widget_preview_scripts() {
    wp_enqueue_script( 'smart-accordion-js' );
}
add_action( 'elementor/preview/enqueue_scripts', 'smart_accordion_widget_preview_scripts' );

// Enqueue preview-specific styles
function smart_accordion_widget_preview_styles() {
    wp_enqueue_style( 'smart-accordion-css' );
}
add_action( 'elementor/preview/enqueue_styles', 'smart_accordion_widget_preview_styles' );

// Enqueue editor-specific styles
function smart_accordion_widget_editor_styles() {
    wp_enqueue_style( 'smart-accordion-css' );
}
add_action( 'elementor/editor/before_enqueue_styles', 'smart_accordion_widget_editor_styles' );

// Enqueue editor-specific scripts
function smart_accordion_widget_editor_scripts() {
    wp_enqueue_script( 'smart-accordion-js' );
}
add_action( 'elementor/editor/before_enqueue_scripts', 'smart_accordion_widget_editor_scripts' );
