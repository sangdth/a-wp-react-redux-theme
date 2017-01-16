<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Theme_Enqueue' ) ) :

	class Theme_Enqueue {
		function __construct() {
		}

		function init() {
			add_action( 'wp_enqueue_scripts', [ $this, 'bootstrap' ] );
			add_action( 'wp_enqueue_scripts', [ $this, 'theme' ] );
		}

		function bootstrap() {
			wp_enqueue_style( 'bootstrap4-css', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css', [], '3.3.7' );
		}

		function theme() {
			wp_enqueue_script( 'ReactTheme-js', get_template_directory_uri() . '/bundle.js', [ 'jquery' ], date( 'YmdHis' ), true );
			wp_localize_script( 'ReactTheme-js', 'RT_API', array(
				'root'  => esc_url_raw( rest_url() ),
				'nonce' => wp_create_nonce( 'wp_rest' ),
				'siteName' => get_bloginfo('name')
			) );
			wp_enqueue_style(get_stylesheet(),get_template_directory_uri() . '/bundle.css');
		}
	}

endif;