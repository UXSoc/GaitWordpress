<?php

$labels = array(
    'name'                  => _x( 'Research Projects', 'Post Type General Name', 'text_domain' ),
    'singular_name'         => _x( 'Research Project', 'Post Type Singular Name', 'text_domain' ),
    'menu_name'             => __( 'Research Projects', 'text_domain' ),
    'name_admin_bar'        => __( 'Research Project', 'text_domain' ),
    'parent_item_colon'     => __( 'Parent Research Project:', 'text_domain' ),
    'all_items'             => __( 'All Research Project', 'text_domain' ),
    'add_new_item'          => __( 'Add New Research Project', 'text_domain' ),
    'add_new'               => __( 'Add New', 'text_domain' ),
    'new_item'              => __( 'New Research Project', 'text_domain' ),
    'edit_item'             => __( 'Edit Research Project', 'text_domain' ),
    'update_item'           => __( 'Update Research Project', 'text_domain' ),
    'view_item'             => __( 'View Research Project', 'text_domain' ),
    'search_items'          => __( 'Search Research Project', 'text_domain' ),
    'not_found'             => __( 'Not found', 'text_domain' ),
    'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
    'items_list'            => __( 'Items list', 'text_domain' ),
    'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
    'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
);
$args = array(
    'label'                 => __( 'Research Project', 'text_domain' ),
    'description'           => __( 'Research Project post type.', 'text_domain' ),
    'labels'                => $labels,
    'supports'              => array( 'title', 'editor', 'thumbnail', ),
    'taxonomies'            => array( 'category', 'post_tag'),
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 5,
    'menu_icon'             => 'dashicons-dashboard',
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => true,
    'exclude_from_search'   => false,
    'publicly_queryable'    => true,
    'capability_type'       => 'page'
);
register_post_type( 'research_project', $args );

function wporg_custom_box_html($post)
{
    ?>
    <label for="wporg_field">Description for this field</label>
    <select name="wporg_field" id="wporg_field" class="postbox">
        <option value="">Select something...</option>
        <option value="something">Something</option>
        <option value="else">Else</option>
    </select>
    <?php
}


function wporg_add_custom_box()
{
    add_meta_box(
        'project_post_relation',           // Unique ID
        'Releated Articles',  // Box title
        'wporg_custom_box_html',  // Content callback, must be of type callable
        'research_project'                   // Post type
    );
}
add_action('add_meta_boxes', 'wporg_add_custom_box');