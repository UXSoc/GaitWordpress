<?php
/**
 * Bulmapress functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Bulmapress
 */

require_once get_template_directory() . '/functions/project-post-utility.php';
require get_template_directory() . '/functions/project-post-relation.php';
require get_template_directory() . '/functions/bulmapress_navwalker.php';
require get_template_directory() . '/functions/bulmapress_helpers.php';
require get_template_directory() . '/functions/bulmapress_custom_query.php';

if ( ! function_exists( 'gait_setup' ) ) :
function gait_setup() {
	require get_template_directory() . '/functions/base.php';
	require get_template_directory() . '/functions/post-thumbnails.php';
	require get_template_directory() . '/functions/navigation.php';
	require get_template_directory() . '/functions/content.php';
	require get_template_directory() . '/functions/pagination.php';
	require get_template_directory() . '/functions/widgets.php';
	require get_template_directory() . '/functions/search.php';
	require get_template_directory() . '/functions/scripts-styles.php';
}
endif;
add_action( 'after_setup_theme', 'gait_setup' );

if ( ! function_exists( 'gait_init' ) ) :
function gait_init() {
    require get_template_directory() . '/functions/admin/project-post-type.php';

}
endif;
add_action( 'init', 'gait_init', 0 );


if ( ! function_exists( 'gait_page_menu' ) ) :
function gait_page_menu(){
    require get_template_directory() . '/functions/admin/front-page-settings.php';
}
add_action('admin_menu','gait_page_menu');
endif;

require get_template_directory() . '/functions/template-tags.php';
require get_template_directory() . '/functions/extras.php';
require get_template_directory() . '/functions/customizer.php';
require get_template_directory() . '/functions/jetpack.php';




