<?php if ( is_home() || is_front_page() ) { ?>

<?php $hidefourbxsec = of_get_option('hidefourbxsec', '1'); ?>
		<?php if($hidefourbxsec == ''){ ?>                    
<section id="pagearea">
  <div class="container"> 
  
		<?php
			$title_arr = array( esc_attr__('Yoga Cources','yoga-club'), esc_attr__('Nutrition Strategies','yoga-club'),  esc_attr__('Spa Treatments','yoga-club'), esc_attr__('Relaxing Herbal Bar','yoga-club'));
			$boxArr = array();
			   if( of_get_option('box1',true) != '' ){
				$boxArr[] = of_get_option('box1',false);
			   }
			   if( of_get_option('box2',true) != '' ){
				$boxArr[] = of_get_option('box2',false);
			   }
			   if( of_get_option('box3',true) != '' ){
				$boxArr[] = of_get_option('box3',false);
			   }
			   if( of_get_option('box4',true) != '' ){
				$boxArr[] = of_get_option('box4',false);
			   }
			   if( of_get_option('box5',true) != '' ){
				$boxArr[] = of_get_option('box5',false);
			   }
			    if( of_get_option('box6',true) != '' ){
				$boxArr[] = of_get_option('box6',false);
			   }			   			  
			
			
			if (!array_filter($boxArr)) {
			for($fx=1; $fx<=4; $fx++) {
			?>
            <div class="fourbox <?php if($fx % 4 == 0) { echo "last_column"; } ?>" id="boxbgcolor<?php echo $fx; ?>">
             
            <div class="thumbbx"><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/services-icon<?php echo $fx; ?>.png" alt="" /></a></div>
             <div class="pagecontent">
             <a href="#"><h3><?php echo $title_arr[$fx-1]; ?></h3></a>             
             <p><?php _e('Phasellus nec metus scelerisque, feugiat est quis, vestibulum ante. Proin id vehicula enim. Pellentesque habitant...', 'yoga-club') ?></p> 
             <?php if( of_get_option('readmorebutton',true) != '') { ?>
               <a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/dots-readmore.png" alt="" /></a>      
			 <?php } ?>
             </div>
         	</div>
			<?php 
			} 
			} else {			
				$box_column = array('no_column','one_column','two_column','three_column','four_column','five_column','six_column');
				$fx = 1;				
				$queryvar = new wp_query(array('post_type' => 'page', 'post__in' => $boxArr, 'posts_per_page' => 6, 'orderby' => 'post__in' ));				
				while( $queryvar->have_posts() ) : $queryvar->the_post(); ?> 
        	    <div class="fourbox <?php echo $box_column[count($boxArr)]; ?> <?php if($fx % count($boxArr) == 0) { echo "last_column"; } ?>" id="boxbgcolor<?php echo $fx; ?>">
				<?php if( of_get_option('boximg'.$fx, true) != '') { ?>	
                <div class="thumbbx imgbx"> <a href="<?php the_permalink(); ?>"><img alt="" src="<?php echo esc_url( of_get_option( 'boximg'.$fx, true )); ?>" / ></a></div>
                <?php } ?>
                <div class="pagecontent">
                 <a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
                  <p><?php echo wp_trim_words( get_the_content(), of_get_option('pageboxlength'), '' ); ?></p>                                 
				  <?php if( of_get_option('readmorebutton',true) != '') { ?>
                   <a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/dots-readmore.png" alt="" /></a>      
				  <?php } ?>
                </div>
        	   </div>
             <?php 
			 $fx++; 
			 endwhile;
			 wp_reset_postdata();
			 }		
		 ?>  
         
        <div class="clear"></div>
    </div><!-- .container -->
</section><!-- #pagearea -->
<?php } ?>

<?php $hidewelcome = of_get_option('hidewelcomesection', '1'); ?>
		<?php if($hidewelcome == ''){ ?>
<section id="welcomearea">
    <div class="container">  
        <div class="welcomebx">
            <?php if( of_get_option('welcomebox',false) ) { ?>
        	<?php $queryvar = new wp_query('page_id='.of_get_option('welcomebox',true));				
			while( $queryvar->have_posts() ) : $queryvar->the_post(); ?>                    
                    <?php if( of_get_option('welcomeimg', true) != '') { ?>	
                     <div class="welcomebox">
                       <a href="<?php the_permalink(); ?>"><img alt="" src="<?php echo esc_url( of_get_option( 'welcomeimg', true )); ?>" / ></a>
                     </div>
                     <?php } ?>                     
                     <h3><?php the_title(); ?></h3>
                     <p><?php echo wp_trim_words( get_the_content(), of_get_option('welcomepagelength'), '' ); ?></p>                     
                     <?php if( of_get_option('welcomereadmorebutton',true) != '') { ?>
                       <a class="button" href="<?php the_permalink(); ?>"><?php echo of_get_option('welcomereadmorebutton'); ?></a>      
				    <?php } ?>                   
                     
             <?php endwhile;
						wp_reset_postdata(); ?>
        <?php } else { ?> 
               <div class="welcomebox">
                   <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/welcomethumb.jpg" /></a>
               </div>                
               <h3><?php _e('Welcome to Yoga','yoga-club'); ?></h3>                        
              <p><?php _e('Morbi nec arcu in purus laoreet efficitur id egestas purus. Nullam et dui sed tellus ultricies fermentum. Suspendisse faucibus nunc ac viverra placerat. Pellentesque aliquet congue est nec ultricies. In in rutrum urna. Morbi iaculis, turpis non tincidunt efficitur, mi odio feugiat neque, convallis gravida risus lorem a justo. Cras mollis est ullamcorper fermentum maximus. Praesent euismod commodo malesuada.','yoga-club'); ?></p>             
		<?php } ?>
       
       <?php if( of_get_option('welcome3box') != '' ){ echo do_shortcode( of_get_option('welcome3box', true ));} ?>
       <div class="clear"></div>     	  
        </div>  
    </div><!-- .container -->
</section><!-- #welcomearea -->
<?php } ?>

<?php } ?>