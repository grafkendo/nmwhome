<?php 

/*
Plugin Name:Awesome Gallery
Author: Raihanul Islam
Author URI:http://raihanislamcse.me
Description:With Awesome image Gallery it's very easy to implement a photo album in WordPress.Awesome Responsive image Gallery WordPress has been created to display image gallery on your WordPress site 
Version:1.0
*/

class Ra_main_class{

	public function __construct(){

		add_action('init',array($this,'Ra_main_area'));
		add_action('wp_enqueue_scripts',array($this,'Ra_main_script_area'));
		add_shortcode('Image-Galery',array($this,'Ra_main_shortcode_area'));
	}


	public function Ra_main_area(){
	
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');

	load_plugin_textdomain('Awig_photo_textdomain', false, dirname( __FILE__).'/lang');

	register_post_type('Image-Gallery',array(
		'labels'=>array(
			'name'=>'Image Gallery'
		),
		'public'=>true,
		'supports'=>array('title','thumbnail'),
		'menu_icon'=>'dashicons-format-gallery'
    ));
}

	public function Ra_main_script_area(){

		wp_enqueue_style('prettyphotocss',PLUGINS_URL('css/pretty.css',__FILE__));
		wp_enqueue_style('image-gallery',PLUGINS_URL('css/imagegallery.css',__FILE__));

		wp_enqueue_script('prettyphotojs',PLUGINS_URL('js/jquery.prettyPhoto.js',__FILE__),array('jquery'));
		wp_enqueue_script('customjs',PLUGINS_URL('js/pretiphoto.js',__FILE__),array('jquery'));
	}


	public function Ra_main_shortcode_area($attr,$content){

	extract(shortcode_atts(array(
		'title'=>__('Image Gallery','Awig_photo_textdomain')
	),$attr));

	ob_start();

	?>
	
	<div class="image-section-gallery"> 
		<div class="image-title"> 
			<h2><?php echo $title; ?></h2>
		</div>
		<div class="image-area"> 
		
		<?php $gallery = new wp_Query(array(
			'post_type'=>'Image-Gallery',
			'posts_per_page'=> -1
		));
			while( $gallery->have_posts() ) : $gallery->the_post();
		?>

		<div class="image-slide"> 
				<?php global $post; 
				 $prettyid = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' ); ?>
			<a href="<?php echo $prettyid[0];?>" rel="prettyPhoto[pp_gal]" ><?php the_post_thumbnail(); ?></a>
				
		</div>
		<?php endwhile; ?>
			
		</div>
	</div>

	
	<?php
	return ob_get_clean();
}




}
new Ra_main_class();





