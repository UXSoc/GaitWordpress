<?php

require_once get_template_directory() . '/functions/project-post-utility.php';


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

function post_list_custom_html($post)
{

    $nonce = wp_create_nonce( 'gait_query_research_post_' . get_the_ID() );
    $posts = get_posts_for_research_project(get_the_ID());
    ?>
    <div id="gait_research_posts" data-nonce="<?php echo $nonce; ?>" data-post_id="<?php echo get_the_ID(); ?>">

        <table class="linked-post">
            <?php if($posts != null): foreach ($posts as $p): ?>
                <tr>
                    <td><button class="button" post_id="<?php echo $p->ID; ?>">Remove</button></td>
                    <td><?php echo get_the_title($p->ID); ?></td>
                </tr>
            <?php endforeach; endif;?>
        </table>
        <input class="widefat" type="text" id="gait_post_search" >
        <table class="post-search-container">
        </table>

    </div>
    <?php
}



function gait_add_custom_post_list()
{
    add_meta_box(
        'project_post_relation',           // Unique ID
        'Releated Articles',  // Box title
        'post_list_custom_html',  // Content callback, must be of type callable
        'research_project'                   // Post type
    );
}
add_action('add_meta_boxes', 'gait_add_custom_post_list');


function gait_query_search_post()
{
    if (check_ajax_referer('gait_query_research_post_' . $_POST['research_post_id'], 'nonce', false) == false) {
        wp_send_json_error();
    }
    $s = '';

    if(isset($_POST['s']))
        $s = esc_sql($_POST['s']);


    global $wpdb;
    $sql = "SELECT p.ID as ID, p.post_title as post_title FROM `{$wpdb->base_prefix}posts` p WHERE p.post_title LIKE '%{$s}%'AND p.post_status='publish' AND p.post_type='post' AND p.ID NOT IN (SELECT post_id FROM `{$wpdb->base_prefix}post_research_project` as p_r WHERE p_r.post_id = p.ID) LIMIT 10";
    $posts = $wpdb->get_results($sql);

    $response = [];

    foreach ( (array) $posts as $p) {
        array_push($response, array('id' => $p->ID, 'title' => $p->post_title));
    }
    wp_send_json_success($response);

}

add_action( 'wp_ajax_gait_query_search_post', 'gait_query_search_post');


function gait_query_remove_post()
{

    if (check_ajax_referer('gait_query_research_post_' . $_POST['research_post_id'], 'nonce', false) == false) {
        wp_send_json_error();
    }
    if(!remove_post_from_research_project($_POST['research_post_id'],$_POST['post_id'])){
        wp_send_json_error();
    }
    wp_send_json_success(array());

}
add_action( 'wp_ajax_gait_query_remove_post', 'gait_query_remove_post' );


function gait_query_add_post()
{

    if (check_ajax_referer('gait_query_research_post_' . $_POST['research_post_id'], 'nonce', false) == false) {
        wp_send_json_error();
    }

    if(!add_post_to_research_project($_POST['research_post_id'],$_POST['post_id'])){
        wp_send_json_error();
    }
    wp_send_json_success(array('target_id' => $_POST['post_id']));

}
add_action( 'wp_ajax_gait_query_add_post', 'gait_query_add_post' );



add_action( 'before_delete_post', 'gait_delete_post' );
function gait_delete_post($postid){
    global $wpdb;
    $wpdb->delete($wpdb->prefix.'post_research_project', array( 'research_post_id' => $postid ) );
    $wpdb->delete($wpdb->prefix.'post_research_project', array( 'post_id' => $postid) );
}

