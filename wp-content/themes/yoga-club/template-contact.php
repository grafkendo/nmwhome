<?php
/**
Template name: Contact Us

 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Yoga Club
 */

get_header(); ?>

<div class="container content-area">
    <div class="middle-align">
        <div class="site-main sitefull">
           <header class="entry-header">
           	  <h1 class="entry-title"><?php the_title(); ?></h1>
       	    </header><!-- .entry-header -->
           
            <div class="contact_left">
			  <?php while ( have_posts() ) : the_post(); ?>
				<?php the_content(); ?>				
			  <?php endwhile; // end of the loop. ?>
            </div><!-- .contact_left -->
            <div class="contact_right">
            <?php if ( !dynamic_sidebar('sidebar-contact')) : ?>
               <?php if( of_get_option('contacttitle',true) != ''){ ?>
                		<h3 class="widget-title"><?php echo of_get_option('contacttitle'); ?></h3>
               <?php } ?>
           <div class="contactdetail">
                	<?php if( of_get_option('address',true) != ''){ ?>
                	  <p><i class="fa fa-map-marker"></i> <?php echo of_get_option('address'); ?></p>
                    <?php } ?>	
               
					<?php if( of_get_option('phone',true) != ''){ ?>
                        <p><i class="fa fa-phone"></i><?php echo of_get_option('phone'); ?></p>
                     <?php } ?>
                    
					<?php if( of_get_option('email',true) != '' ) { ?>
                      <p><i class="fa fa-envelope"></i><a href="mailto:<?php echo of_get_option('email',true); ?>"><?php echo of_get_option('email',true) ; ?></a></p>
                   <?php } ?>                                  
                </div> 
                
                <?php endif; ?>
            </div><!-- .contact_right -->
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<?php get_footer(); ?>