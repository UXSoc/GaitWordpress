<?php

function gait_admin_scripts()
{
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
    wp_enqueue_style('thickbox');
}
add_action( 'wp_enqueue_scripts', 'gait_admin_scripts' );
