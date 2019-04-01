<?php
/**
 * Massage Spa Pro functions and definitions
 *
 * @package Massage Spa Pro
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
error_reporting(0);
function content($limit) {
$content = explode(' ', get_the_excerpt(), $limit);
if (count($content)>=$limit) {
array_pop($content);
$content = implode(" ",$content).'...';
} else {
$content = implode(" ",$content);
}	
$content = preg_replace('/\[.+\]/','', $content);
$content = apply_filters('the_content', $content);
$content = str_replace(']]>', ']]&gt;', $content);
return $content;
}
//Excerpt limit function
function custom_excerpt_length( $length ) {
	return 100;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

if ( ! function_exists( 'spa_massage_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function spa_massage_setup() {

	if ( ! isset( $content_width ) )
		$content_width = 640; /* pixels */

	load_theme_textdomain( 'massage-spa-pro', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'title-tag' );
	add_filter('widget_text', 'do_shortcode');
	add_image_size('homepage-thumb',240,145,true);	
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'massage-spa-pro' ),
		'footer' => __( 'Footer Menu', 'massage-spa-pro' ),
	) );
	add_theme_support( 'custom-background', array(
		'default-color' => 'ffffff'
	) );
	add_editor_style( 'editor-style.css' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
endif; // spa_massage_setup
add_action( 'after_setup_theme', 'spa_massage_setup' );

function spa_massage_widgets_init() {

	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'massage-spa-pro' ),
		'description'   => __( 'Appears on blog page sidebar', 'massage-spa-pro' ),
		'id'            => 'sidebar-1',
		'before_widget' => '',		
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3><aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '<div class="clear"></div></aside>',
	) );

	register_sidebar( array(
		'name'          => __( 'Sidebar Main', 'massage-spa-pro' ),
		'description'   => __( 'Appears on page sidebar', 'massage-spa-pro' ),
		'id'            => 'sidebar-main',
		'before_widget' => '',		
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3><aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Header Widget', 'massage-spa-pro' ),
		'description'   => __( 'Appears on header', 'massage-spa-pro' ),
		'id'            => 'header-widget',
		'before_widget' => '<aside id="%1$s" class="headerinfo %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="headwidjet">',
		'after_title'   => '</h5>',
	) );	
	
	register_sidebar( array(
		'name'          => __( 'Footer Widget 1', 'massage-spa-pro' ),
		'description'   => __( 'Appears on footer', 'massage-spa-pro' ),
		'id'            => 'footer-1',
		'before_widget' => '<div id="%1$s" class="widget-column-1">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5>',
		'after_title'   => '</h5>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer Widget 2', 'massage-spa-pro' ),
		'description'   => __( 'Appears on footer', 'massage-spa-pro' ),
		'id'            => 'footer-2',
		'before_widget' => '<div id="%1$s" class="widget-column-2">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5>',
		'after_title'   => '</h5>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer Widget 3', 'massage-spa-pro' ),
		'description'   => __( 'Appears on footer', 'massage-spa-pro' ),
		'id'            => 'footer-3',
		'before_widget' => '<div id="%1$s" class="widget-column-3">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5>',
		'after_title'   => '</h5>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer Widget 4', 'massage-spa-pro' ),
		'description'   => __( 'Appears on footer', 'massage-spa-pro' ),
		'id'            => 'footer-4',
		'before_widget' => '<div id="%1$s" class="widget-column-4">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5>',
		'after_title'   => '</h5>',
	) );
	
	
	register_sidebar( array(
		'name'          => __( 'Footer Sign Up Form Widget', 'massage-spa-pro' ),
		'description'   => __( 'Appears on footer sign up form', 'massage-spa-pro' ),
		'id'            => 'footer-5',
		'before_widget' => '<div id="%1$s" class="widget-column-1">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5>',
		'after_title'   => '</h5>',
	) );
	
	
	register_sidebar( array(
		'name'          => __( 'Sidebar Contact Page', 'massage-spa-pro' ),
		'description'   => __( 'Appears on contact page', 'massage-spa-pro' ),
		'id'            => 'sidebar-contact',
		'before_widget' => '<aside class="widget-contact %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

}
add_action( 'widgets_init', 'spa_massage_widgets_init' );

define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
require_once get_template_directory() . '/inc/options-framework.php';

function spa_massage_scripts() {	
	wp_enqueue_style( 'massagespapro-gfonts-lato', '//fonts.googleapis.com/css?family=Lato:400,300,300italic,400italic,700,700italic' );	

	if( of_get_option('bodyfontface',true) != '' ){
		wp_enqueue_style( 'massagespapro-gfonts-body', '//fonts.googleapis.com/css?family='.rawurlencode(of_get_option('bodyfontface',true)) .'&subset=cyrillic,arabic,bengali,cyrillic,cyrillic-ext,devanagari,greek,greek-ext,gujarati,hebrew,latin-ext,tamil,telugu,thai,vietnamese,latin' );
	}
	if( of_get_option('logofontface',true) != '' ){
		wp_enqueue_style( 'massagespapro-gfonts-logo', '//fonts.googleapis.com/css?family='.rawurlencode(of_get_option('logofontface',true)).'&subset=cyrillic,arabic,bengali,cyrillic,cyrillic-ext,devanagari,greek,greek-ext,gujarati,hebrew,latin-ext,tamil,telugu,thai,vietnamese,latin' );
	}
	if ( of_get_option('navfontface', true) != '' ) {
		wp_enqueue_style( 'massagespapro-gfonts-nav', '//fonts.googleapis.com/css?family='.rawurlencode(of_get_option('navfontface',true)).'&subset=cyrillic,arabic,bengali,cyrillic,cyrillic-ext,devanagari,greek,greek-ext,gujarati,hebrew,latin-ext,tamil,telugu,thai,vietnamese,latin' );
	}
	if ( of_get_option('headfontface', true) != '' ) {
		wp_enqueue_style( 'massagespapro-gfonts-heading', '//fonts.googleapis.com/css?family='.rawurlencode(of_get_option('headfontface',true)) .'&subset=cyrillic,arabic,bengali,cyrillic,cyrillic-ext,devanagari,greek,greek-ext,gujarati,hebrew,latin-ext,tamil,telugu,thai,vietnamese,latin');
	} 
	
	if ( of_get_option('sectiontitlefontface', true) != '' ) {
		wp_enqueue_style( 'massagespapro-gfonts-sectiontitle', '//fonts.googleapis.com/css?family='.rawurlencode(of_get_option('sectiontitlefontface',true)) .'&subset=cyrillic,arabic,bengali,cyrillic,cyrillic-ext,devanagari,greek,greek-ext,gujarati,hebrew,latin-ext,tamil,telugu,thai,vietnamese,latin');
	}
	if ( of_get_option('slidetitlefontface', true) != '' ) {
		wp_enqueue_style( 'massagespapro-gfonts-slidetitle', '//fonts.googleapis.com/css?family='.rawurlencode(of_get_option('slidetitlefontface',true)) .'&subset=cyrillic,arabic,bengali,cyrillic,cyrillic-ext,devanagari,greek,greek-ext,gujarati,hebrew,latin-ext,tamil,telugu,thai,vietnamese,latin');
	}
	if ( of_get_option('slidedesfontface', true) != '' ) {
		wp_enqueue_style( 'massagespapro-gfonts-slidedes', '//fonts.googleapis.com/css?family='.rawurlencode(of_get_option('slidedesfontface',true)) .'&subset=cyrillic,arabic,bengali,cyrillic,cyrillic-ext,devanagari,greek,greek-ext,gujarati,hebrew,latin-ext,tamil,telugu,thai,vietnamese,latin');
	} 	

	wp_enqueue_style( 'massagespapro-basic-style', get_stylesheet_uri() );
	wp_enqueue_style( 'massagespapro-editor-style', get_template_directory_uri().'/editor-style.css' );
	wp_enqueue_style( 'massagespapro-base-style', get_template_directory_uri().'/css/default.css' );	
	if ( is_home() || is_front_page() ) { 
	wp_enqueue_style( 'massagespapro-nivo-style', get_template_directory_uri().'/css/nivo-slider.css' );
	wp_enqueue_script( 'massagespapro-nivo-slider', get_template_directory_uri() . '/js/jquery.nivo.slider.js', array('jquery') );
	}	

	wp_enqueue_script( 'massagespapro-customscripts', get_template_directory_uri() . '/js/custom.js', array('jquery') );	
	wp_enqueue_style( 'massagespapro-font-awesome-style', get_template_directory_uri().'/fontsawesome/css/fontawesome-all.css' );
	wp_enqueue_style( 'massagespapro-animation', get_template_directory_uri().'/css/animation.css' );
	wp_enqueue_style( 'massagespapro-hover', get_template_directory_uri().'/css/hover.css' );
	wp_enqueue_style( 'massagespapro-hover-min', get_template_directory_uri().'/css/hover-min.css' );
	wp_enqueue_script( 'massagespapro-testimonialsminjs', get_template_directory_uri().'/testimonialsrotator/js/jquery.quovolver.min.js', array('jquery') );	
	wp_enqueue_style( 'massagespapro-testimonialslider-style', get_template_directory_uri().'/testimonialsrotator/js/tm-rotator.css' );	
	wp_enqueue_style( 'massagespapro-responsive-style', get_template_directory_uri().'/css/responsive.css' );		
	wp_enqueue_style( 'massagespapro-owl-style', get_template_directory_uri().'/testimonialsrotator/js/owl.carousel.css' );
	wp_enqueue_script( 'massagespapro-owljs', get_template_directory_uri().'/testimonialsrotator/js/owl.carousel.js', array('jquery') );
	
	
	// mixitup script
	wp_enqueue_style( 'massagespapro-mixitup-style', get_template_directory_uri().'/mixitup/style-mixitup.css' );
	wp_enqueue_script( 'massagespapro-jquery_013-script', get_template_directory_uri() . '/mixitup/jquery_013.js', array('jquery') );
	wp_enqueue_script( 'massagespapro-jquery_003-script', get_template_directory_uri() . '/mixitup/jquery_003.js', array('jquery') );
	wp_enqueue_script( 'massagespapro-screen-script', get_template_directory_uri() . '/mixitup/screen.js', array('jquery') );
	// prettyPhoto script
	wp_enqueue_style( 'massagespapro-prettyphoto-style', get_template_directory_uri().'/mixitup/prettyPhotoe735.css' );
	wp_enqueue_script( 'massagespapro-prettyphoto-script', get_template_directory_uri() . '/mixitup/jquery.prettyPhoto5152.js', array('jquery') );
	
	//Client Logo Rotator
	wp_enqueue_style( 'massagespapro-flexiselcss', get_template_directory_uri().'/css/flexiselcss.css' );	
	wp_enqueue_script( 'massagespapro-flexisel', get_template_directory_uri() . '/js/jquery.flexisel.js', array('jquery') );
	
	if( of_get_option('scrollanimation',true) != true) {
		wp_enqueue_style( 'massagespapro-animation-style', get_template_directory_uri().'/css/animation-style.css' );
		wp_enqueue_script( 'massagespapro-custom-animation', get_template_directory_uri() . '/js/custom-animation.js', array('jquery') );	
	}
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'spa_massage_scripts' );

function media_css_hook(){
	
	?>
    	
    	<script>
		jQuery(window).bind('scroll', function() {
	var wwd = jQuery(window).width();
	if( wwd > 939 ){
		var navHeight = jQuery( window ).height() - 575;
		<?php if( of_get_option('headstick',true) == true) { ?>
		if (jQuery(window).scrollTop() > navHeight) {
			jQuery(".header").addClass('fixed');
		}else {
			jQuery(".header").removeClass('fixed');
		}
		<?php } ?>
	}
});		
					



jQuery(window).load(function() {   
  jQuery('.owl-carousel').owlCarousel({
    loop:true,	
	autoplay: <?php echo of_get_option('testimonialsautoplay',true); ?>,
	autoplayTimeout: <?php echo of_get_option('testimonialsrotatingspeed',true); ?>,
    margin:20,
    nav:true,
	dots: false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
})
    
  });


jQuery(document).ready(function() {
  
  jQuery('.link').on('click', function(event){
    var $this = jQuery(this);
    if($this.hasClass('clicked')){
      $this.removeAttr('style').removeClass('clicked');
    } else{
      $this.css('background','#7fc242').addClass('clicked');
    }
  });
 
});
</script>

<?php if ( is_home() || is_front_page() ) { ?>        
<script>
		jQuery(window).load(function() {
        jQuery('#slider').nivoSlider({
        	effect:'<?php echo of_get_option('slideefect',true); ?>', //sliceDown, sliceDownLeft, sliceUp, sliceUpLeft, sliceUpDown, sliceUpDownLeft, fold, fade, random, slideInRight, slideInLeft, boxRandom, boxRain, boxRainReverse, boxRainGrow, boxRainGrowReverse
		  	animSpeed: <?php echo of_get_option('slideanim',true); ?>,
			pauseTime: <?php echo of_get_option('slidepause',true); ?>,
			directionNav: <?php echo of_get_option('slidenav',true); ?>,
			controlNav: <?php echo of_get_option('slidepage',true); ?>,
			pauseOnHover: <?php echo of_get_option('slidepausehover',true); ?>,
    });
});
</script>
<?php } ?>

<?php      
}
add_action('wp_head','media_css_hook'); 


function spa_massage_custom_head_codes() { 
	if ( function_exists('of_get_option') ){
		if ( of_get_option('style2', true) != '' ) {
			echo "<style>". esc_html( of_get_option('style2', true) ) ."</style>";
		}
		echo "<style>";		
		if ( of_get_option('bodyfontcolor', true) != '' ) {
			echo 'body, .contact-form-section .address,  .accordion-box .acc-content, #contactform_main input[type=text], #contactform_main input[type=email], #contactform_main input[type=tel], #contactform_main input[type=url], #contactform_main textarea, #contactform_main ::-webkit-input-placeholder,#contactform_main ::-moz-placeholder{color:'. esc_html( of_get_option('bodyfontcolor', true) ) .';}';
		}
		if( of_get_option('bodyfontface', true) != '' || of_get_option('bodyfontsize',true) != ''){
			echo "body{font-family:".of_get_option('bodyfontface')."; font-size:".of_get_option('bodyfontsize',true).";}";
		}
		if( of_get_option('logofontface',true) != '' || of_get_option('logofontcolor',true) != '' || of_get_option('logofontsize',true) != ''){
			echo ".logo h1 {font-family:".of_get_option('logofontface').";color:".of_get_option('logofontcolor',true).";font-size:".of_get_option('logofontsize',true)."}";
		}
		if( of_get_option('logotaglinecolor',true) != '' ){
			echo ".tagline{color:".of_get_option('logotaglinecolor',true).";}";
		}
		if( of_get_option('logoheight',true) != '' ){
			echo ".logo img{height:".of_get_option('logoheight',true)."px;}";
		}				
		
		if( of_get_option('headtopstrip',true) != '' ){
			echo ".header{margin-top:50px;}";
		}	
		
		
		if ( of_get_option('navfontface', true) != '' || of_get_option('navfontsize',true) != '' ) {
			echo '.sitenav ul{font-family:\''. esc_html( of_get_option('navfontface', true) ) .'\', sans-serif;font-size:'.of_get_option('navfontsize',true).'}';
		}		
		if ( of_get_option('navfontcolor', true) != '' ) {
			echo '.sitenav ul li a, .sitenav ul li.current_page_item ul.sub-menu li a, .sitenav ul li.current-menu-parent ul.sub-menu li a{color:'. esc_html( of_get_option('navfontcolor', true) ) .';}';
		}		
		
		if ( of_get_option('navsubbgcolor',true) != '' ) {
			echo '.sitenav ul li ul{background:'. esc_html( of_get_option('navsubbgcolor', true) ) .';}';
		}		 
		if( of_get_option('sectiontitlefontface',true) != '' || of_get_option('sectitlesize',true) != '' || of_get_option('sectitlecolor',true) != '' ){
			echo "h2.section_title{ font-family:".of_get_option('sectiontitlefontface',true)."; font-size:".of_get_option('sectitlesize',true)."; color:".of_get_option('sectitlecolor',true)."; }";
		}
		 
		
		if ( of_get_option('linkhovercolor', true) != '' ) {
			echo 'a:hover, .slide_toggle a:hover{color:'. esc_html( of_get_option('linkhovercolor', true) ) .';}';
		}			
		if( of_get_option('foottitlecolor', true) != '' || of_get_option('ftfontsize', true) != ''){
			echo ".footer h5, #footer-info .cols-2 h5{color:".of_get_option('foottitlecolor', true)."; font-size:".of_get_option('ftfontsize', true)."; }";
		}
										
		if( of_get_option('copycolor', true) != ''){
			echo ".copyright-txt{color:".of_get_option('copycolor',true)."}";
		}
		if( of_get_option('designcolor', true) != ''){
			echo ".design-by{color:".of_get_option('designcolor',true)."}";
		}		
				
		if ( of_get_option('headertopfontcolor', true) != '' || of_get_option('headertopbgstrip', true) != '') {
			echo ".header-top{ color:".of_get_option('headertopfontcolor',true)."; background-color:".of_get_option('headertopbgstrip',true).";}";
		}

		if( of_get_option('fontawesomeiconcolor',true) != '' ){
			echo ".best-featurs i{ color:".of_get_option('fontawesomeiconcolor',true).";}";
		}		
						
		if( of_get_option('socialfontcolor',true) != '' ){
			echo ".header-top .social-icons a{ color:".of_get_option('socialfontcolor',true).";}";
		}
		
		if( of_get_option('headerbgcolor',true) != '' ){
			echo ".header{background-color:".of_get_option('headerbgcolor',true).";}";
		}			
		
				
		if( of_get_option('btntxtcolor', true) != ''){
			echo ".button, #commentform input#submit, input.search-submit, .post-password-form input[type=submit], p.read-more a, .pagination ul li span, .pagination ul li a, .headertop .right a, .wpcf7 form input[type='submit'], #sidebar .search-form input.search-submit{ color:". of_get_option('btntxtcolor', true) ."; }";
		}
		if( of_get_option('btnbghvcolor',true) != '' || of_get_option('btntxthvcolor', true) != '' ){
			echo ".button:hover, #commentform input#submit:hover, input.search-submit:hover, .post-password-form input[type=submit]:hover, p.read-more a:hover, .pagination ul li .current, .pagination ul li a:hover,.headertop .right a:hover, .wpcf7 form input[type='submit']:hover{background-color:".of_get_option('btnbghvcolor',true)."; color:". esc_html( of_get_option('btntxthvcolor', true) ) .";}";
		}		
		if( of_get_option('btntxtcolor', true) != ''){
			echo "a.morebutton{ color:". of_get_option('btntxtcolor', true) ."; }";
		}
		if( of_get_option('btnbghvcolor',true) != '' || of_get_option('btntxthvcolor', true) != '' ){
			echo "a.morebutton:hover{background-color:".of_get_option('btnbghvcolor',true)."; color:". esc_html( of_get_option('btntxthvcolor', true) ) .";}";
		}
		
		if( of_get_option('btnbghvcolor',true) != '' || of_get_option('btntxthvcolor', true) != ''){
			echo "a.buttonstyle1{background-color:".of_get_option('btnbghvcolor',true)."; color:". of_get_option('btntxthvcolor', true) ."; }";
		}
		if( of_get_option('btntxtcolor', true) != '' ){
			echo "a.buttonstyle1:hover{ color:". esc_html( of_get_option('btntxtcolor', true) ) .";}";
		}
			
		if ( of_get_option('widgetboxbgcolor', true) != '' || of_get_option('widgetboxfontcolor', true) != '' ) {
		echo "#sidebar .search-form input.search-field{ background-color:".of_get_option('widgetboxbgcolor', true)."; color:".of_get_option('widgetboxfontcolor', true).";  }";
		}			
		if ( of_get_option('wdgttitleccolor', true) != '' ) {
			echo "h3.widget-title{ color:".of_get_option('wdgttitleccolor', true).";}";
		}				
		if ( of_get_option('footerbgcolor', true) != '' || of_get_option('footdesccolor', true) != '' ) {
		echo "#footer-wrapper{background-color:".of_get_option('footerbgcolor', true)."; color:".of_get_option('footdesccolor', true).";}";
		}				
		
		if ( of_get_option('footerbgimage', true) != '') {
		echo "#footer-wrapper{background: url(".of_get_option('footerbgimage', true).") no-repeat; background-attachment: fixed !important; background-size: 100% 100% !important; }";
		}		
		
		if ( of_get_option('footdesccolor', true) != '' ) {
			echo ".contactdetail a{color:".of_get_option('footdesccolor', true)."; }";
		}			
		if ( of_get_option('copybgcolor', true) != '' ) {
			echo '.copyright-wrapper{background-color:'. esc_html( of_get_option('copybgcolor', true) ) .';}';
		}
			
		
		if( of_get_option('sldpagebg',true) != ''){
			echo ".nivo-controlNav a{background-color:".of_get_option('sldpagebg',true)."}";
		}
			
		if( of_get_option('sldpagehvbd',true) != ''){
			echo ".nivo-controlNav a{border-color:".of_get_option('sldpagehvbd',true)."}";
		}
		if( of_get_option('sidebarliaborder', true) != '' ){
			echo "#sidebar ul li{border-color:".of_get_option('sidebarliaborder',true)."}";
		}	
		if( of_get_option('sidebarfontcolor',true) != '' ){
			echo "#sidebar ul li a{color:".of_get_option('sidebarfontcolor',true)."; }";
		}		
		
		if ( of_get_option('slidetitlefontface', true) != '' || of_get_option('slidetitlecolor', true) != '' || of_get_option('slidetitlefontsize', true) != '') {
		echo ".nivo-caption h2{ font-family:".of_get_option('slidetitlefontface', true)."; color:".of_get_option('slidetitlecolor', true)."; font-size:".of_get_option('slidetitlefontsize', true).";  }";
		}
		
		if ( of_get_option('slidedesfontface', true) != '' || of_get_option('slidedesccolor', true) != '' || of_get_option('slidedescfontsize', true) != '') {
		echo ".nivo-caption p{font-family:".of_get_option('slidedesfontface', true)."; color:".of_get_option('slidedesccolor', true)."; font-size:".of_get_option('slidedescfontsize', true).";}";
		}
		
			
		if ( of_get_option('copylinkshover', true) != '' ) {
		echo ".copyright-wrapper a:hover{ color: ".of_get_option('copylinkshover', true)."; }";
		}	
		
		if ( of_get_option('togglemenucolor', true) != '' ) {
		echo ".toggle a{ color:".of_get_option('togglemenucolor', true)."; }";
		}		
		
/* Heading */
		if( of_get_option('headfontface', true) != '' ){
			echo "h1,h2,h3,h4,h5,h6{ font-family:".of_get_option('headfontface',true)."; }";
		}		
		if ( of_get_option('h1fontsize', true) != '' || of_get_option('h1fontcolor', true) != '' ) {
			echo "h1{ font-size:".of_get_option('h1fontsize', true)."; color:".of_get_option('h1fontcolor', true).";}";
		}
		if ( of_get_option('h2fontsize', true) != '' || of_get_option('h2fontcolor', true) != '' ) {
			echo "h2{ font-size:".of_get_option('h2fontsize', true)."; color:".of_get_option('h2fontcolor', true).";}";
		}		
		if ( of_get_option('h3fontsize', true) != '' || of_get_option('h3fontcolor', true) != '' ) {
			echo "h3{ font-size:".of_get_option('h3fontsize', true)."; color:".of_get_option('h3fontcolor', true).";}";
		}		
		if ( of_get_option('h4fontsize', true) != '' || of_get_option('h4fontcolor', true) != '' ) {
			echo "h4{ font-size:".of_get_option('h4fontsize', true)."; color:".of_get_option('h4fontcolor', true).";}";
		}		
		if ( of_get_option('h5fontsize', true) != '' || of_get_option('h5fontcolor', true) != '' ) {
			echo "h5{font-size:".of_get_option('h5fontsize', true)."; color:".of_get_option('h5fontcolor', true).";}";
		}		
		if ( of_get_option('h6fontsize', true) != '' || of_get_option('h6fontcolor', true) != '' ) {
			echo "h6{ font-size:".of_get_option('h6fontsize', true)."; color:".of_get_option('h6fontcolor', true).";}";
		}
/* Custom editable */

		if ( of_get_option('welcomebgimg', true) != '' ) {
			echo "#welcomearea{ background:url(".of_get_option('welcomebgimg', true).") no-repeat center top; background-attachment:fixed; background-size:cover;; }";
		}			
			
		if ( of_get_option('footsocialcolor', true) != '' || of_get_option('footsocialbgcolor', true) != '' ) {
			echo ".footer .social-icons a, #footer-info .social-icons a{ color:".of_get_option('footsocialcolor', true)."; background-color:".of_get_option('footsocialbgcolor', true).";}";
		}		
		
		$sliderarrowhex = of_get_option('sldarrowbg',true); 
		list($r,$g,$b) = sscanf($sliderarrowhex,'#%02x%02x%02x');
		if ( of_get_option('sldarrowbg', true) != '' ) {
			echo ".nivo-directionNav a:hover{background-color:rgba(".$r.",".$g.",".$b.",".of_get_option('sldarrowopacity',true).");}";
		}
				
		if ( of_get_option('galleryfiltercolor', true) != '' ) {
			echo "ul.portfoliofilter li a{color:".of_get_option('galleryfiltercolor', true).";}";
		}
		 
		if ( of_get_option('gallerytitlecolorhv', true) != '' ) {
			echo ".holderwrap h5{ color:".of_get_option('gallerytitlecolorhv', true)."; }";
		}
		if ( of_get_option('gallerytitlecolorhv', true) != '' ) {
			echo ".holderwrap h5::after{ background-color:".of_get_option('gallerytitlecolorhv', true)."; }";
		}
		
		if ( of_get_option('latestpoststtlcolor', true) != '' ) {
			echo ".news-box h6 a{ color:".of_get_option('latestpoststtlcolor', true)."; }";
		}
		
		// Top Four Boxes CSS 
		if ( of_get_option('hometopfourbxcolor', true) != '' ) {
			echo ".threebox{ color:".of_get_option('hometopfourbxcolor', true)."; }";
		}
		if ( of_get_option('hometopfourbxtitlecolor', true) != '' ) {
			echo ".threebox h3{ color:".of_get_option('hometopfourbxtitlecolor', true)."; }";
		}

		if ( of_get_option('topboxbgcolor1', true) != '' || of_get_option('topboxbgcolor2', true) != '' || of_get_option('topboxbgcolor3', true) != '' || of_get_option('topboxbgcolor4', true) != '' || of_get_option('topboxbgcolor5', true) != '' || of_get_option('topboxbgcolor6', true) != '' ) {
			echo "#boxbgcolor1{background-color:".of_get_option('topboxbgcolor1', true)."; }";
			echo "#boxbgcolor2{background-color:".of_get_option('topboxbgcolor2', true)."; }";
			echo "#boxbgcolor3{background-color:".of_get_option('topboxbgcolor3', true)."; }";
			echo "#boxbgcolor4{background-color:".of_get_option('topboxbgcolor4', true)."; }";
			echo "#boxbgcolor5{background-color:".of_get_option('topboxbgcolor5', true)."; }";
			echo "#boxbgcolor6{background-color:".of_get_option('topboxbgcolor6', true)."; }";
		}
		
		if ( of_get_option('ourvarietybg', true) != '') {
			echo ".variety-spa-list, .variety-spa-list:after, .tabs-wrapper ul.tabs, .tabs-wrapper ul.tabs:after{background-color:".of_get_option('ourvarietybg', true).";}";
		}
			
		if ( of_get_option('hometopfourbxreadmore', true) != '' || of_get_option('topfourbxreadmorecolor', true) != '' ) {
			echo ".pagemore{ background-color:".of_get_option('hometopfourbxreadmore', true)."; color:".of_get_option('topfourbxreadmorecolor', true)."; }";
		}
		if ( of_get_option('hometopfourbxreadmorehv', true) != '' ) {
			echo ".threebox:hover .pagemore{ color:".of_get_option('hometopfourbxreadmorehv', true)."; }";
		}
		if ( of_get_option('teamttlfontcolor', true) != '' ) {
			echo ".teammember-list:hover span.title{ color:".of_get_option('teamttlfontcolor', true)."; }";
		}
		 
		if ( of_get_option('featuressection', true) != '' ) {
			echo "#section5:before{ background-color:".of_get_option('featuressection', true)."; }";
		}
		if ( of_get_option('counterfontcolor', true) != '' || of_get_option('counterbghover', true) != '') {
			echo ".counterlist .counter, .counterlist .countercon{color:".of_get_option('counterfontcolor', true)."; }";
			echo ".countercon h6{background-color:".of_get_option('counterbghover', true)."; }";
		}		
		//Testimonials CSS
		
		if ( of_get_option('testidotsbgcolor', true) != '' ) {
			echo ".owl-controls .owl-dot{ background-color:".of_get_option('testidotsbgcolor', true)."; }";
		}		
		
		if ( of_get_option('testimonialdescriptioncolor', true) != '' ) {
			echo "#clienttestiminials .item{ color:".of_get_option('testimonialdescriptioncolor', true)."; }";
		}
				
		if ( of_get_option('testimonialtitlecolor', true) != '' ) {
			echo "#clienttestiminials h6{ color:".of_get_option('testimonialtitlecolor', true)."; }";
		}		
				
		if ( of_get_option('footerpoststitlecolor', true) != '' ) {
			echo "ul.recent-post li a{ color:".of_get_option('footerpoststitlecolor', true)."; }";
		}			
				
		
		//Color scheme for one click background color
		if ( of_get_option('colorscheme', true) != '' ) {
			echo ".button, 
			#commentform input#submit, 
			input.search-submit, 
			.post-password-form input[type='submit'], 
			p.read-more a, 
			.pagination ul li span, 
			.pagination ul li a, 
			.headertop .right a, 
			.wpcf7 form input[type='submit'], 
			#sidebar .search-form input.search-submit,
			.nivo-controlNav a.active,
			.counterlist:hover .cntimage,
			.offer-1-column .offimgbx,
			.hvr-rectangle-out::before,			
			.holderwrap,
			.owl-controls .owl-dot.active,
			.button:hover, 
			#commentform input#submit:hover, 
			input.search-submit:hover, 
			.post-password-form input[type=submit]:hover, 
			p.read-more a:hover, 
			.pagination ul li .current, 
			.pagination ul li a:hover,
			.headertop .right a:hover, 
			.wpcf7 form input[type='submit']:hover,
			.shopnow:hover,			
			.toggle a,
			a.morebutton,
			a.buttonstyle1:hover,
			.shopnow:hover,
			.mainmenu,
			.hvr-sweep-to-right::before,
			.news-thumb .postdt,			
			.news-box .news-thumb,
			h2.section_title::after, .teammember-list:hover .titledesbox, .woocommerce ul.products li .woocommerce-loop-product__title, .newsletter-form input[type=submit], .nivo-directionNav a, .wearesuprime .aboutmore a, .servicebox:hover h6, .news-box .PostMeta, .woocommerce span.onsale, #section10 .subtitle, #footer-info .social-icons a:hover, a.booknow, section#section6:before{background-color:".of_get_option('colorscheme', true)."; }";
		}
			
		
		
		//Color scheme for one click font color
		if ( of_get_option('colorscheme', true) != '' ) {
			echo ".header-top .social-icons a:hover,
			.sitenav ul li a:hover, 
			.sitenav ul li.current_page_item a, 
			.sitenav ul li.current_page_item ul li a:hover,
			.sitenav ul li.current-menu-parent a, 
			.sitenav ul li:hover,
			.sitenav ul li.current_page_item ul.sub-menu li a:hover, 
			.sitenav ul li.current-menu-parent ul.sub-menu li a:hover,
			.sitenav ul li.current-menu-parent ul.sub-menu li.current_page_item a,
			.sitenav ul li:hover,
			.cntbutton,
			.offcontnt .pricedv,		
			.contactdetail a:hover, 
			.footer h5 span, 
			.footer ul li a:hover, 
			.footer ul li.current_page_item a, 
			div.recent-post a:hover,
			.footer .social-icons a:hover,
			.copyright-wrapper a,
			a, 
			.slide_toggle a, 
			.news-box h6 a:hover,
			#sidebar ul li a:hover,
			.teammember-content span,
			#clienttestiminials span,
			.member-social-icon a:hover,
			.best-featurs:hover i,
			.woocommerce div.product p.price, .woocommerce div.product span.price,
			.frdbox i, ul.portfoliofilter li a.selected, ul.portfoliofilter li a:hover, ul.portfoliofilter li:hover a,
			.header-top .left span, .logo h1 span, .nivo-caption .button:hover, .variety-spa-list ul li a:hover, .variety-of-spa h6, .tabs-wrapper .tab-content h6, .tabs-wrapper ul.tabs li a.selected, .tabs-wrapper ul.tabs li:hover a{ color:".of_get_option('colorscheme', true)."; }";
		}
		
			
		
		//Color scheme for one click border color
		if ( of_get_option('colorscheme', true) != '' ) {
			echo "#clienttestiminials .item span::after,
			.frdbox h4::after
			{ border-color:".of_get_option('colorscheme', true)."; }";
		}
		if ( of_get_option('colorscheme', true) != '' ) {
			echo ".teammember-list:hover .thumnailbx, .woocommerce ul.products li .woocommerce-loop-product__title:after{ border-bottom-color:".of_get_option('colorscheme', true)."; }";
		}
		
		if ( of_get_option('colorscheme', true) != '' ) {
			echo ".woocommerce ul.products li:hover .woocommerce-loop-product__title:after{ border-bottom-color:".of_get_option('colorscheme', true)." ; }";
			echo ".woocommerce ul.products li:hover .woocommerce-loop-product__title, .newsletter-form input[type=submit]:hover{background-color:".of_get_option('colorscheme', true)."; }";
		}
		
		$testimonialshex = of_get_option('colorscheme',true); 
		list($r,$g,$b) = sscanf($testimonialshex ,'#%02x%02x%02x');
		if ( of_get_option('colorscheme', true) != '' ) {
			echo ".testimonials-area{background-color:rgba(".$r.",".$g.",".$b.",".of_get_option('testimonilopacity',true).");}";
		}
		
		if ( of_get_option('colorscheme', true) != '' ) {
			echo ".threebox:hover .pagemore{ background-color:".of_get_option('colorscheme', true)."; }";
		}

 		if ( of_get_option('shopbtnbgcolor', true) != '' ) {
			echo ".shopnow{ background-color:".of_get_option('shopbtnbgcolor', true).";}";
		}
		
		
		echo "</style>";
	}
}
add_action('wp_head', 'spa_massage_custom_head_codes');


function spa_massage_pagination() {
	global $wp_query;
	$big = 12345678;
	$page_format = paginate_links( array(
	    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	    'format' => '?paged=%#%',
	    'current' => max( 1, get_query_var('paged') ),
	    'total' => $wp_query->max_num_pages,
	    'type'  => 'array'
	) );
	if( is_array($page_format) ) {
		$paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
		echo '<div class="pagination"><div><ul>';
		echo '<li><span>'. $paged . ' of ' . $wp_query->max_num_pages .'</span></li>';
		foreach ( $page_format as $page ) {
			echo "<li>$page</li>";
		}
		echo '</ul></div></div>';
	}
}
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


/**
 * Load custom functions file.
 */
require get_template_directory() . '/inc/custom-functions.php';

function spa_massage_custom_blogpost_pagination( $wp_query ){
	$big = 999999999; // need an unlikely integer
	if ( get_query_var('paged') ) { $pageVar = 'paged'; }
	elseif ( get_query_var('page') ) { $pageVar = 'page'; }
	else { $pageVar = 'paged'; }
	$pagin = paginate_links( array(
		'base' 			=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' 		=> '?'.$pageVar.'=%#%',
		'current' 		=> max( 1, get_query_var($pageVar) ),
		'total' 		=> $wp_query->max_num_pages,
		'prev_text'		=> '&laquo; Prev',
		'next_text' 	=> 'Next &raquo;',
		'type'  => 'array'
	) ); 
	if( is_array($pagin) ) {
		$paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
		echo '<div class="pagination"><div><ul>';
		echo '<li><span>'. $paged . ' of ' . $wp_query->max_num_pages .'</span></li>';
		foreach ( $pagin as $page ) {
			echo "<li>$page</li>";
		}
		echo '</ul></div></div>';
	} 
}
// get slug by id
function spa_massage_get_slug_by_id($id) {
	$post_data = get_post($id, ARRAY_A);
	$slug = $post_data['post_name'];
	return $slug; 
}