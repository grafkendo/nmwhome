<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Massage Spa Pro
 */
$footerlayout = of_get_option('footerlayout');
?>

<div id="footer-wrapper">
    	<div class="container footer">      
        
<!-- =============================== Column One - 1 =================================== -->
			<?php if($footerlayout=='onecolumn'){ ?>
                <div class="cols-1">    
                   <?php if(!dynamic_sidebar('footer-1')) : ?> 
              <div class="widget-column-1">
                <?php wp_nav_menu( array( 'theme_location' => 'footer') ); ?>
              </div>             
            <?php endif; ?>
                    <div class="clear"></div>
                </div>
            <?php 
            }
             elseif ($footerlayout=='twocolumn'){ ?>

<!-- =============================== Column Two - 2 =================================== -->

            <div class="cols-2">    
               <?php if(!dynamic_sidebar('footer-1')) : ?>  
               <div class="widget-column-1">
				<h5><?php if( of_get_option('aboutustitle') != ''){ echo of_get_option('aboutustitle');}; ?></h5>
                 <?php if( of_get_option('aboutusdescription') != '') { echo of_get_option('aboutusdescription'); } ; ?>                    
                <div class="clear"></div> 
              </div>                  
			<?php  endif; ?>
           
              <?php if(!dynamic_sidebar('footer-2')) : ?>
              <div class="widget-column-2">     
            	
                 <h5><?php if( of_get_option('contacttitle') != ''){ echo of_get_option('contacttitle');}; ?></h5>
                  <div class="contactdetail">
                	<?php if( of_get_option('address',true) != ''){ ?>
                	  <p><i class="fas fa-map-marker-alt"></i> <?php echo of_get_option('address'); ?></p>
                    <?php } ?>	
               
					<?php if( of_get_option('phone',true) != ''){ ?>
                        <p><i class="fas fa-phone-square"></i><?php echo of_get_option('phone'); ?></p>
                     <?php } ?>
                    
					<?php if( of_get_option('email',true) != '' ) { ?>
                      <p><i class="fas fa-envelope"></i><a href="mailto:<?php echo of_get_option('email',true); ?>"><?php echo of_get_option('email',true) ; ?></a></p>
                   <?php } ?>
                    
                     <?php if( of_get_option('fax',true) != ''){ ?>
                		<p><i class="fas fa-fax"></i> <?php echo of_get_option('fax'); ?></p>
                    <?php } ?>
                                       
                </div>
               </div>
            <?php endif; ?>
                <div class="clear"></div>
            </div><!--end .cols-2-->  
			<?php 
            }
            elseif($footerlayout=='threecolumn'){ ?>
        
<!-- =============================== Column Three - 3 =================================== -->
            <div class="cols-3">    
                <?php if(!dynamic_sidebar('footer-1')) : ?>  
                    <div class="widget-column-1">            	
                        <h5><?php if( of_get_option('footermenutitle') != ''){ echo of_get_option('footermenutitle');}; ?></h5>
                        <?php wp_nav_menu( array( 'theme_location' => 'footer') ); ?>
                        <div class="clear"></div> 
                    </div>                  
				<?php  endif; ?>
           
              <?php if(!dynamic_sidebar('footer-2')) : ?>
             	 <div class="widget-column-2"> 
                    <h5><?php if( of_get_option('letestpoststitle') != ''){ echo of_get_option('letestpoststitle');}; ?></h5>
                   <ul class="recent-post"> 
                	<?php query_posts('post_type=post&showposts=2'); ?>
                    <?php  while( have_posts() ) : the_post(); ?>
                  	
                    <li>
                    <a href="<?php the_permalink(); ?>">
                    <?php if ( has_post_thumbnail() ) { $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail' );   $thumbnailSrc = $src[0]; ?>
                    <div class="footerthumb"><img src="<?php echo $thumbnailSrc; ?>" alt="" width="70" height="auto" ></div>
					<?php } else { ?>
                    <div class="footerthumb"><img src="<?php echo esc_url( get_template_directory_uri()); ?>/images/img_404.png" width="70"  /></div>
                    <?php } ?></a> 
                    <strong><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></strong>                   
                    <?php echo content( of_get_option('footerpostslength') ); ?>					
                    </li>
                    <?php endwhile; ?>
                    </ul>
                    <?php wp_reset_query(); ?>
                    
            		  <div class="clear"></div>       	
              	 </div>
            	<?php endif; ?>
                
            <?php if(!dynamic_sidebar('footer-3')) : ?>
              <div class="widget-column-3">     
            	<h5><?php if( of_get_option('contacttitle') != ''){ echo of_get_option('contacttitle');}; ?></h5>
                  <div class="contactdetail">
                	<?php if( of_get_option('address',true) != ''){ ?>
                	  <p><i class="fas fa-map-marker-alt"></i> <?php echo of_get_option('address'); ?></p>
                    <?php } ?>	
               
					<?php if( of_get_option('phone',true) != ''){ ?>
                        <p><i class="fas fa-phone-square"></i><?php echo of_get_option('phone'); ?></p>
                     <?php } ?>
                    
					<?php if( of_get_option('email',true) != '' ) { ?>
                      <p><i class="fas fa-envelope"></i><a href="mailto:<?php echo of_get_option('email',true); ?>"><?php echo of_get_option('email',true) ; ?></a></p>
                   <?php } ?>
                    
                     <?php if( of_get_option('fax',true) != ''){ ?>
                		<p><i class="fas fa-fax"></i> <?php echo of_get_option('fax'); ?></p>
                    <?php } ?>
                                       
                </div>
                </div>
            <?php endif; ?>
                
                    <div class="clear"></div>
            </div><!--end .cols-3-->  
            <?php
            }
            elseif($footerlayout=='fourcolumn'){ ?>

<!-- =============================== Column Fourth - 4 =================================== -->
          
    		<div class="cols-4">    
                <?php if(!dynamic_sidebar('footer-1')) : ?>  
                <div class="widget-column-1">            	
              
                <h5><?php if( of_get_option('contacttitle') != ''){ echo of_get_option('contacttitle');}; ?></h5>
                  <div class="contactdetail">
                	<?php if( of_get_option('address',true) != ''){ ?>
                	  <p><i class="fas fa-map-marker-alt"></i> <?php echo of_get_option('address'); ?></p>
                    <?php } ?>	
               
					<?php if( of_get_option('phone',true) != ''){ ?>
                        <p><i class="fas fa-phone-square"></i><?php echo of_get_option('phone'); ?></p>
                     <?php } ?>
                    
					<?php if( of_get_option('email',true) != '' ) { ?>
                      <p><i class="fas fa-envelope"></i><a href="mailto:<?php echo of_get_option('email',true); ?>"><?php echo of_get_option('email',true) ; ?></a></p>
                   <?php } ?>
                    
                     <?php if( of_get_option('fax',true) != ''){ ?>
                		<p><i class="fas fa-fax"></i> <?php echo of_get_option('fax'); ?></p>
                    <?php } ?>
                                       
                </div>
                <div class="clear"></div> 
              </div>                  
			<?php  endif; ?>
           
                <?php if(!dynamic_sidebar('footer-2')) : ?>
             	 <div class="widget-column-2"> 
                    <h5><?php if( of_get_option('footermenutitle') != ''){ echo of_get_option('footermenutitle');}; ?></h5>
                    <?php wp_nav_menu( array( 'theme_location' => 'footer') ); ?>
                                
            		         	
              	 </div>
            	<?php endif; ?>
                
            <?php if(!dynamic_sidebar('footer-3')) : ?> 
              <div class="widget-column-3">
                
                <h5><?php if( of_get_option('aboutustitle') != ''){ echo of_get_option('aboutustitle');}; ?></h5>
                <?php if( of_get_option('aboutusdescription') != '') { echo of_get_option('aboutusdescription'); } ; ?>                  

                
              </div>             
            <?php endif; ?>
            
                
            <?php if(!dynamic_sidebar('footer-4')) : ?>
              <div class="widget-column-4"> 
                <h5><?php if( of_get_option('letestpoststitle') != ''){ echo of_get_option('letestpoststitle');}; ?></h5>
                   <ul class="recent-post"> 
                	<?php query_posts('post_type=post&showposts=3'); ?>
                    <?php  while( have_posts() ) : the_post(); ?>
                    <li>
                     <strong><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></strong>                   
                    <?php echo content(of_get_option('footerpostslength')); ?>					
                    </li>
                    <?php endwhile; ?>
                    </ul>
                    <?php wp_reset_query(); ?>                
               </div>
            <?php endif; ?>
            
            
           
                
                    <div class="clear"></div>
                </div><!--end .cols-4-->
             <?php } ?>  
            <div class="clear"></div>
        
        </div><!--end .container-->

    <div id="footer-info">
        <div class="container">
            <div class="cols-2">    
			<?php if(!dynamic_sidebar('footer-5')) : ?>
             	<div class="widget-column-1">	                
                    <?php if( of_get_option('newslettertitle',true) != ''){ ?>
                        <h5><?php echo of_get_option('newslettertitle'); ?></h5>
                     <?php } ?>
    	            <form class="newsletter-form"> <input type="email" placeholder="Your e-mail" /> <input type="submit" value="subscribe" /></form>
                </div>
			<?php endif; ?>
                <div class="widget-column-2">
                    <?php if( of_get_option('footersocialicon') != '') { echo do_shortcode(of_get_option('footersocialicon')); } ; ?> 
                </div>
            <div class="clear"></div>
            </div>    
        </div>
    </div><!--end #footer-info-->        

        <div class="copyright-wrapper">
            <div class="container">
                <div class="copyright-txt"><?php if( of_get_option('copytext',true) != ''){ echo of_get_option('copytext',true); }; ?></div>
                <div class="design-by"><?php if( of_get_option('ftlink', true) != ''){echo of_get_option('ftlink',true);}; ?></div>
                <div class="clear"></div>
            </div> 
        </div>
       
    </div>    
<?php if( of_get_option('backtotop') != '') { echo do_shortcode(of_get_option('backtotop')); } ; ?>
<?php wp_footer(); ?>
</div>
</body>
</html>