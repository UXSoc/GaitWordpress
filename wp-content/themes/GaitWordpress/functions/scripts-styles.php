<?php
/**
 * Scripts & Styles
 *
 * @package Bulmapress
 */

/**
 * Enqueue scripts and styles.
 */
function bulmapress_scripts() {

    $json = file_get_contents(get_template_directory() . '/dist/manifest.json');
    $manifest = json_decode($json, true);

	wp_enqueue_style( 'bulmapress-style', get_stylesheet_uri() );

	wp_enqueue_style( 'bulmapress-bulma-style', get_template_directory_uri() . '/dist/' . $manifest['main.css']);

	wp_enqueue_script( 'bulmapress-javascript', get_template_directory_uri() . '/dist/' . $manifest['main.js'], array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'bulmapress_scripts' );
