<?php
/**
 * The main header template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Bulma
 */
?>

<?php get_header(); ?>

<div id="primary" class="content-area landing">
    <main id="main" class="site-main" role="main">
        <section class="hero is-info is-large header-image">
            <div class="hero-body">
                <div class="container">
                    <h1 class="title">
                        <?php echo get_option('gait_front_page_header_title'); ?>
                    </h1>
                    <h2 class="subtitle">
                        <?php echo get_option('gait_front_page_header_subtitle'); ?>
                    </h2>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="container">
                <h2 class="title is-2"><?php echo get_option('gait_front_page_second_title'); ?></h2>
                <p><?php echo get_option('gait_front_page_header_subtitle'); ?></p>
            </div>
        </section>
        <section class="section">
            <div class="container">
                <h2 class="title is-2"><?php echo get_option('gait_front_page_third_title'); ?></h2>
                <div class="columns">
                    <div class="column">
                        <img src="<?php echo get_option('gait_front_page_third_1_image'); ?>"/>
                        <p class="title is-4"><?php echo get_option('gait_front_page_third_1_title'); ?></p>
                        <div class="content"><?php echo get_option('gait_front_page_third_1_description'); ?></div>
                    </div>
                    <div class="column">
                        <img src="<?php echo get_option('gait_front_page_third_2_image'); ?>"/>
                        <p class="title is-4"><?php echo get_option('gait_front_page_third_2_title'); ?></p>
                        <div class="content"><?php echo get_option('gait_front_page_third_2_description'); ?></div>
                    </div>
                    <div class="column">
                        <img src="<?php echo get_option('gait_front_page_third_3_image'); ?>"/>
                        <p class="title is-4"><?php echo get_option('gait_front_page_third_3_title'); ?></p>
                        <div class="content"><?php echo get_option('gait_front_page_third_3_description'); ?></div>
                    </div>
                </div>
            </div>
        </section>
        <?php
        bulmapress_custom_query(array(
                'post_type' => 'post',
                'post_class'	=> 'posts',
                'section_title' => 'Recent Posts',
                'section_columns' => 3,
                'section_max_posts' => 3,
                'section_button_text' => 'See all Posts'
            )
        );
        bulmapress_custom_query(array(
                'post_type' => 'page',
                'post_class'	=> 'pages',
                'section_title' => 'Recent Pages',
                'section_columns' => 4,
                'section_max_posts' => 4
            )
        );
        ?>
    </main><!-- #main -->
</div><!-- #primary -->

<!-- move somewhere and clean up -->
<style>
    .header-image {
        background-image: url("<?php echo get_option('gait_front_page_header_image'); ?>");
        background-position: center center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
        background-color: #999;
    }
</style>

<?php get_sidebar(); ?>
<?php get_footer(); ?>

