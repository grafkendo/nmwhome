<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Yoga Club
 */
get_header(); 

if( of_get_option('singlelayout',true) != ''){
	$layout = of_get_option('singlelayout');
}

$eventdate = esc_html( get_post_meta( get_the_ID(), 'eventdate', true ) );
$eventtime = esc_html( get_post_meta( get_the_ID(), 'eventtime', true ) );
$eventplace = esc_html( get_post_meta( get_the_ID(), 'eventplace', true ) );		
?>

<style>
<?php
if( of_get_option('singlelayout', true) == 'singleleft' ){
	echo '#sidebar { float:left !important; }'; 
}
?>
</style>	

<div class="container content-area">
    <div class="middle-align">
        <div class="site-main <?php echo $layout; ?>" id="sitemain">
        
			<?php while ( have_posts() ) : the_post(); ?>
               <h1 class="entry-title"><?php the_title();?></h1>
               <div class="post-thumb"><?php the_post_thumbnail('medium', array( 'class' => 'alignleft' ) ); ?></div><!-- post-thumb -->
               <div class="eventdetails">				    
				<span><i class="far fa-calendar-alt"></i><?php echo $eventdate; ?></span>
				<span><i class="far fa-clock"></i> <?php echo $eventtime; ?></span>
				<span><i class="fas fa-map-marker-alt"></i><?php echo $eventplace; ?></span>
			  </div>               
               
               <?php the_content();?>
            <?php endwhile; // end of the loop. ?>
        </div>
        <?php 
		if( $layout != 'sitefull' && $layout != 'nosidebar' ){
		  get_sidebar();
		} ?>
        <div class="clear"></div>
    </div>
</div>
<?php get_footer(); ?>