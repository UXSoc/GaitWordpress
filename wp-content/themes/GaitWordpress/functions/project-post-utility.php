<?php
/**
 * Created by IntelliJ IDEA.
 * User: michaelpollind
 * Date: 9/22/18
 * Time: 6:04 PM
 */

function get_posts_for_research_project($research_post_id){
    $research_post_id = (int)$research_post_id;
    global $wpdb;
    $post = get_post($research_post_id);
    if($post->post_type == 'research_project') {
        $sql = "SELECT p.ID FROM `{$wpdb->base_prefix}posts` p INNER JOIN  `{$wpdb->base_prefix}post_research_project` p_r ON p_r.post_id = p.ID WHERE p_r.research_post_id='{$research_post_id}' ";
        $posts = $wpdb->get_results($sql);
        $result = [];
        foreach ( (array) $posts as $p) {
            array_push($result,get_post($p->ID));
        }
        return $result;
    }
    return null;
}

function get_research_project($post_id){
    global $wpdb;
    $post = get_post((int)$post_id);
    if($post->post_type == 'post') {
        $sql = "SELECT p.ID FROM `{$wpdb->base_prefix}posts` p INNER JOIN  `{$wpdb->base_prefix}post_research_project` p_r ON p_r.research_post_id = p.ID WHERE p_r.post_id='{$post->ID}' ";
        $p = $wpdb->get_row($sql);
        return get_post($p->ID);
    }
    return null;
}

function add_post_to_research_project($research_post_id,$post_id){
    global $wpdb;
    $research = get_post((int)$research_post_id);
    $post = get_post((int)$post_id);
    if($post->post_type != "post") {
        return false;
    }
    if($research->post_type != "research_project") {
        return false;
    }
    $wpdb->insert($wpdb->prefix.'post_research_project',array('research_post_id' => $research->ID, 'post_id' => $post->ID));
    return true;
}

function remove_post_from_research_project($research_post_id,$post_id){
    global $wpdb;
    $research = get_post((int)$research_post_id);
    $post = get_post((int)$post_id);

    if($post->post_type != 'post') {
        return false;
    }
    if($research->post_type != 'research_project') {
        return false;
    }
    return $wpdb->delete($wpdb->prefix.'post_research_project', array( 'research_post_id' => $research->ID, 'post_id' => $post->ID ) );

}
