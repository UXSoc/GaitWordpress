<?php

function theme_settings()
{
    if (!current_user_can('manage_options'))
    {
        wp_die( 'You do not have sufficient permissions to access this page.');
    }

    ?>


        <div class="wrap"  >
            <?php screen_icon(); ?>
            <h2>Your Plugin Name</h2>

            <form method="post" action="options.php">
                <?php settings_fields( 'gait-front-page-settings' ); ?>
                <?php do_settings_sections( 'gait-front-page-settings' ); ?>

                <h1>Header</h1>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">Title</th>
                        <td><input type="text" name="gait_front_page_header_title" value="<?php echo get_option('gait_front_page_header_title'); ?>" /></td>

                    </tr>
                    <tr valign="top">
                        <th scope="row">Sub Title</th>
                        <td><input type="text" name="gait_front_page_header_subtitle" value="<?php echo get_option('gait_front_page_header_subtitle'); ?>" /></td>
                    </tr>

                    <tr valign="top">
                        <th scope="row">Image</th>
                        <td>
                            <div class="button-image-upload">
                                <input type="button" value="Upload Image" class="upload-image button add-image" />
                                <img class="preview" src="<?php echo get_option('gait_front_page_header_image'); ?>">
                                <input type="hidden" class="payload" name="gait_front_page_header_image" value="<?php echo get_option('gait_front_page_header_image'); ?>">
                            </div>
                        </td>
                    </tr>
                </table>

                <h1>Second Section</h1>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">Title</th>
                        <td><input type="text" name="gait_front_page_second_title" value="<?php echo get_option('gait_front_page_second_title'); ?>" /></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Content</th>
                        <td><input type="text" name="gait_front_page_second_content" value="<?php echo get_option('gait_front_page_second_content'); ?>" /></td>
                    </tr>
                </table>

                <h1>Third Section</h1>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">Title</th>
                        <td><input type="text" name="gait_front_page_third_title" value="<?php echo get_option('gait_front_page_third_title'); ?>" /></td>
                    </tr>

                    <tr valign="top">
                        <th scope="row">Description 1</th>
                        <td><textarea class="large-text code" name="gait_front_page_third_1_description"><?php echo get_option('gait_front_page_third_1_description'); ?></textarea></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Title 1</th>
                        <td><textarea class="large-text code" name="gait_front_page_third_1_title"><?php echo get_option('gait_front_page_third_1_title'); ?></textarea></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Image 1</th>
                        <td>
                            <div class="button-image-upload">
                                <input type="button" value="Upload Image" class="upload-image button add-image" />
                                <img class="preview" src="<?php echo get_option('gait_front_page_third_1_image'); ?>">
                                <input type="hidden" class="payload" value="<?php echo get_option('gait_front_page_third_1_image'); ?>" name="gait_front_page_third_1_image">
                            </div>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Description 2</th>
                        <td><textarea class="large-text code" name="gait_front_page_third_2_description"><?php echo get_option('gait_front_page_third_2_description'); ?></textarea></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Title 2</th>
                        <td><textarea class="large-text code" name="gait_front_page_third_2_title"><?php echo get_option('gait_front_page_third_2_title'); ?></textarea></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Image 2</th>
                        <td>
                            <div class="button-image-upload">
                                <input type="button" value="Upload Image" class="upload-image button add-image" />
                                <img class="preview" src="<?php echo get_option('gait_front_page_third_2_image'); ?>">
                                <input type="hidden" class="payload" value="<?php echo get_option('gait_front_page_third_2_image'); ?>" name="gait_front_page_third_2_image">
                            </div>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Description 1</th>
                        <td><textarea class="large-text code" name="gait_front_page_third_3_description"><?php echo get_option('gait_front_page_third_3_description'); ?></textarea></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Title 3</th>
                        <td><textarea class="large-text code" name="gait_front_page_third_3_title"><?php echo get_option('gait_front_page_third_3_title'); ?></textarea></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Image 1</th>
                        <td>
                            <div class="button-image-upload">
                                <input type="button" value="Upload Image" class="upload-image button add-image" />
                                <img class="preview" src="<?php echo get_option('gait_front_page_third_3_image'); ?>">
                                <input type="hidden" class="payload" value="<?php echo get_option('gait_front_page_third_3_image'); ?>" name="gait_front_page_third_3_image">
                            </div>
                        </td>
                    </tr>
                </table>

                <?php submit_button(); ?>
            </form>
        </div>

    <?php
}

add_theme_page('home page', 'Theme Options', 'read', 'home', 'theme_settings');


add_action('admin_init', 'gait_admin_home_script_style');
function gait_admin_home_script_style()
{
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
    wp_enqueue_style('thickbox');

    $json = file_get_contents(get_template_directory() . '/dist/manifest.json');
    $manifest = json_decode($json, true);
    wp_enqueue_script( 'gait-admin-javascript', get_template_directory_uri() . '/dist/' . $manifest['admin.js'], array(), '20151215', true );

    register_setting( 'gait-front-page-settings', 'gait_front_page_header_title' );
    register_setting( 'gait-front-page-settings', 'gait_front_page_header_subtitle' );
    register_setting( 'gait-front-page-settings', 'gait_front_page_header_image' );
    register_setting( 'gait-front-page-settings', 'gait_front_page_second_title' );
    register_setting( 'gait-front-page-settings', 'gait_front_page_second_content' );
    register_setting( 'gait-front-page-settings', 'gait_front_page_third_title' );
    register_setting( 'gait-front-page-settings', 'gait_front_page_third_1_description' );
    register_setting( 'gait-front-page-settings', 'gait_front_page_third_1_title' );
    register_setting( 'gait-front-page-settings', 'gait_front_page_third_1_image' );
    register_setting( 'gait-front-page-settings', 'gait_front_page_third_2_description' );
    register_setting( 'gait-front-page-settings', 'gait_front_page_third_2_title' );
    register_setting( 'gait-front-page-settings', 'gait_front_page_third_2_image' );
    register_setting( 'gait-front-page-settings', 'gait_front_page_third_3_description' );
    register_setting( 'gait-front-page-settings', 'gait_front_page_third_3_title' );
    register_setting( 'gait-front-page-settings', 'gait_front_page_third_3_image' );




}