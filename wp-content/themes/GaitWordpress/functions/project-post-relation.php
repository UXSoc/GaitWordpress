<?php
if ( ! function_exists( 'create_table_relation' ) ) :
    function create_table_relation()
    {
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE `{$wpdb->base_prefix}post_research_project` (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            research_post_id bigint(20) unsigned NOT NULL,
            post_id bigint(20) unsigned NOT NULL UNIQUE,
            PRIMARY KEY  (id)
            ) $charset_collate;";


        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
endif;
add_action( 'after_switch_theme', 'create_table_relation' );


