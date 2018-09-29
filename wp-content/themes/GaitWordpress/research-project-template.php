<?php
/*
 * Template Name: Research Projects
 * description: >-
  Page template to display portfolio custom post types 
 * underneath the page content
 */


get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <?php while ( have_posts() ) : the_post(); ?>
            <?php get_template_part( 'template-parts/content' ); ?>
            <?php bulmapress_get_comments(); ?>
        <?php endwhile; ?>

        <?php query_posts( array('post_type' => 'research_project') ); ?>
        <?php while ( have_posts() ) : the_post(); ?>
            <?php get_template_part( 'template-parts/content' ); ?>
        <?php endwhile;?>
    </main><!-- #main -->
</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
