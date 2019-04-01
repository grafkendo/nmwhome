<?php
/**
 * Template Name: Gutenberg Template
 * Template Post Type: Post, Page
 */
get_header(); ?>
    
    <?php get_template_part( '/templates/titlebar' ); ?>
    
    <?php while ( have_posts() ) : the_post(); ?>

        <?php get_template_part( 'templates/contents/content', 'page' ); ?>

        <?php
        // If comments are open or we have at least one comment, load up the comment template
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif; ?>

    <?php endwhile; // end of the loop. ?>
    
<?php get_footer(); ?>