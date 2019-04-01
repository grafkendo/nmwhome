<?php
/**
 * @package Yoga Club
 * Setup the WordPress core custom functions feature.
 *
*/

add_action('yoga_club_optionsframework_custom_scripts', 'yoga_club_optionsframework_custom_scripts');
function yoga_club_optionsframework_custom_scripts() { ?>
	<script type="text/javascript">
    jQuery(document).ready(function() {
    
        jQuery('#example_showhidden').click(function() {
            jQuery('#section-example_text_hidden').fadeToggle(400);
        });
        
        if (jQuery('#example_showhidden:checked').val() !== undefined) {
            jQuery('#section-example_text_hidden').show();
        }
        
    });
    </script><?php
}

// get_the_content format text
function get_the_content_format( $str ){
	$raw_content = apply_filters( 'the_content', $str );
	$content = str_replace( ']]>', ']]&gt;', $raw_content );
	return $content;
}
// the_content format text
function the_content_format( $str ){
	echo get_the_content_format( $str );
}

function is_google_font( $font ){
	$notGoogleFont = array( 'Arial', 'Comic Sans MS', 'FreeSans', 'Georgia', 'Lucida Sans Unicode', 'Palatino Linotype', 'Symbol', 'Tahoma', 'Trebuchet MS', 'Verdana' );
	if( in_array($font, $notGoogleFont) ){
		return false;
	}else{
		return true;
	}
}

// subhead section function
function sub_head_section( $more ) {
	$pgs = 0;
	do {
		$pgs++;
	} while ($more > $pgs);
	return $pgs;
}

//[clear]
function clear_func() {
	$clr = '<div class="clear"></div>';
	return $clr;
}
add_shortcode( 'clear', 'clear_func' );


//[column_content]Your content here...[/column_content]
function column_content_func( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'type' => '',	
	), $atts ) );
	$colPos = strpos($type, '_last');
	if($colPos === false){
		$cnt = '<div class="'.$type.'">'.do_shortcode($content).'</div>';
	}else{
		$type = substr($type,0,$colPos);
		$cnt = '<div class="'.$type.' last_column">'.do_shortcode($content).'</div>';
	}
	return $cnt;
}
add_shortcode( 'column_content', 'column_content_func' );


//[hr]
function hrule_func() {
	$hrule = '<div class="hr"></div>';
	return $hrule;
}
add_shortcode( 'hr', 'hrule_func' );

//[hr_top]
function back_to_top_func() {
	$back_top = '<div id="back-top">
		<a title="Top of Page" href="#top"><span></span></a>
	</div>';
	return $back_top;
}
add_shortcode( 'back-to-top', 'back_to_top_func' );


// [searchform]
function searchform_shortcode_func( $atts ){
	return get_search_form( false );
}
add_shortcode( 'searchform', 'searchform_shortcode_func' );

// accordion
function accordion_func( $atts, $content = null ) {
	$acc = '<div style="margin-top:10px;">'.get_the_content_format( do_shortcode($content) ).'<div class="clear"></div></div>';
	return $acc;
}
add_shortcode( 'accordion', 'accordion_func' );
function accordion_content_func( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'title' => 'Accordion Title',
	), $atts ) );
	$content = wpautop(trim($content));
	$acn = '<div class="accordion-box"><h2>'.$title.'</h2>
			<div class="acc-content">'.$content.'</div><div class="clear"></div></div>';
	return $acn;
}
add_shortcode( 'accordion_content', 'accordion_content_func' );


// remove excerpt more
function new_excerpt_more( $more ) {
	return '... ';
}
add_filter('excerpt_more', 'new_excerpt_more');

// get post categories function
function getPostCategories(){
	$categories = get_the_category();
	$catOut = '';
	$separator = ', ';
	$catOutput = '';
	if($categories){
		foreach($categories as $category) {
			$catOutput .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s", 'yoga-club' ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
		}
		$catOut = ''.trim($catOutput, $separator);
	}
	return $catOut;
}

// replace last occurance of a string.
function str_lreplace($search, $replace, $subject){
	$pos = strrpos($subject, $search);
	if($pos !== false){
		$subject = substr_replace($subject, $replace, $pos, strlen($search));
	}
	return $subject;
}

// custom post type for Testimonials
function my_custom_post_testimonials() {
	$labels = array(
		'name'               => __( 'Testimonial','yoga-club'),
		'singular_name'      => __( 'Testimonial','yoga-club'),
		'add_new'            => __( 'Add Testimonial','yoga-club'),
		'add_new_item'       => __( 'Add New Testimonial','yoga-club'),
		'edit_item'          => __( 'Edit Testimonial','yoga-club'),
		'new_item'           => __( 'New Testimonial','yoga-club'),
		'all_items'          => __( 'All Testimonials','yoga-club'),
		'view_item'          => __( 'View Testimonial','yoga-club'),
		'search_items'       => __( 'Search Testimonials','yoga-club'),
		'not_found'          => __( 'No testimonials found','yoga-club'),
		'not_found_in_trash' => __( 'No testimonials found in the Trash','yoga-club'), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Testimonials'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Manage Testimonials',
		'public'        => true,
		'menu_icon'		=> 'dashicons-format-quote',
		'menu_position' => null,
		'supports'      => array( 'title', 'editor', 'thumbnail'),
		'has_archive'   => true,
	);
	register_post_type( 'testimonials', $args );	
}
add_action( 'init', 'my_custom_post_testimonials' );

// add meta box to testimonials
add_action( 'admin_init', 'my_testimonials_admin_function' );
function my_testimonials_admin_function() {
    add_meta_box( 'testimonials_meta_box',
        'Testimonials Info',
        'display_testimonials_meta_box',
        'testimonials', 'normal', 'high'
    );
}
// add meta box form to team
function display_testimonials_meta_box( $testimonials ) {
    // Retrieve current name of the Director and Movie Rating based on review ID
    $designation = esc_html( get_post_meta( $testimonials->ID, 'designation', true ) );   
    ?>
    <table width="100%">
        <tr>
            <td width="20%">client info (designation) </td>
            <td width="80%"><input type="text" name="designation" value="<?php echo $designation; ?>" /></td>
        </tr>      
    </table>
    <?php      
}
// save team meta box form data
add_action( 'save_post', 'add_testimonials_fields_function', 10, 2 );
function add_testimonials_fields_function( $testimonials_id, $testimonials ) {
    // Check post type for testimonials
    if ( $testimonials->post_type == 'testimonials' ) {
        // Store data in post meta table if present in post data
        if ( isset($_POST['designation']) ) {
            update_post_meta( $testimonials_id, 'designation', $_POST['designation'] );
        }        
    }
}


//Testimonials function
function testimonials_output_func( $atts ){
	extract( shortcode_atts( array( 
	'show' => '',
	),
	$atts ) ); 		
	wp_reset_query();
 	query_posts('post_type=testimonials&posts_per_page='.$show);
	if ( have_posts() ) :
	 $testimonialoutput = '<div id="clienttestiminials"><div class="owl-carousel">';	
		while ( have_posts() ) : the_post();
		if ( has_post_thumbnail()) {
				$large_imgSrc = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
				$imgUrl = $large_imgSrc[0];
		}else{
				$imgUrl = get_template_directory_uri().'/images/img_404.png';
		}	
		$designation = esc_html( get_post_meta( get_the_ID(), 'designation', true ) );		   
			$testimonialoutput .= '			     
				 <div class="item">
				 <div class="mytmnlbx">
					  <i class="fa fa-quote-left"></i>
					  <div class="tmnlThumb"><img src="'.$imgUrl.'" alt=" " /></div>
					  <h6><a href="'.get_permalink().'">'.get_the_title().'</a></h6>	
					  <span>'.$designation.'</span>
					 </div>
				 
 					<div class="mytmnlcontentbx">'.content( of_get_option('testimonialsexcerptlength') ).'</div>
				 
				 
				</div>';
		endwhile;
		 $testimonialoutput .= '</div></div>';
	else:
	  $testimonialoutput = '<div id="clienttestiminials"><div class="owl-carousel"> 
              
              <div class="item">                   			  
				   <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec laoreet magna diam, id ullamcorper lacus suscipit vehicula. In porta vehicula lacus, ac viverra ipsum volutpat quis. Aenean dapibus, nisl in efficitur iaculis.</p>
				   <h6><a href="#">Julie Smith</a></h6>	
               </div>
			  
                <div class="item">                   		  
				   <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec laoreet magna diam, id ullamcorper lacus suscipit vehicula. In porta vehicula lacus, ac viverra ipsum volutpat quis. Aenean dapibus, nisl in efficitur iaculis.</p>
				   <h6><a href="#">Sandy Orthon</a></h6>		
               </div>
			  
			    <div class="item">                     
				   <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec laoreet magna diam, id ullamcorper lacus suscipit vehicula. In porta vehicula lacus, ac viverra ipsum volutpat quis. Aenean dapibus, nisl in efficitur iaculis.</p>
				   <h6><a href="#">Miky Dutson</a></h6>				
               </div>
			  
			    <div class="item">                   	  
				   <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec laoreet magna diam, id ullamcorper lacus suscipit vehicula. In porta vehicula lacus, ac viverra ipsum volutpat quis. Aenean dapibus, nisl in efficitur iaculis.</p>
				   <h6><a href="#">Rubiya Lucent</a></h6>			
               </div>
			               
           
  </div></div>';			
	  endif;  
	wp_reset_query();	
	return $testimonialoutput;
}
add_shortcode( 'testimonials', 'testimonials_output_func' );



//Testimonials function
function testimonials_listing_output_func( $atts ){
	extract( shortcode_atts( array( 
	'show' => '',
	),
	$atts ) ); 		
	wp_reset_query();
 	query_posts('post_type=testimonials&posts_per_page='.$show);
	if ( have_posts() ) :
	 $testimonialoutput = '<div id="Tmnllist">';	
		while ( have_posts() ) : the_post();
		if ( has_post_thumbnail()) {
				$large_imgSrc = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
				$imgUrl = $large_imgSrc[0];
			}else{
				$imgUrl = get_template_directory_uri().'/images/img_404.png';
			}	
		$designation = esc_html( get_post_meta( get_the_ID(), 'designation', true ) );		   
			$testimonialoutput .= '
			    <div class="tmnllisting">
			 	<div class="tmnlthumb"><a href="'.get_permalink().'"><img src="'.$imgUrl.'" alt=" " /></a></div>
				 <h6><a href="'.get_permalink().'">'.get_the_title().'</a></h6>	
				 <span>'.$designation.'</span>
				  '.content( of_get_option('testimonialsexcerptlength') ).'
				</div>	';
		endwhile;
		 $testimonialoutput .= '</div>';
	else:
	  $testimonialoutput = '<div id="Tmnllist"> 
           
              <div class="tmnllisting">
                <div class="tmnlthumb"><a href="#"><img src="'.get_template_directory_uri()."/images/team1.jpg".'" alt="" /></a></div>
                   <h6><a href="#">Brandon Doe</a></h6>
				   <span>Ceo & Founder</span>
				   <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec laoreet magna diam, id ullamcorper lacus suscipit vehicula. In porta vehicula lacus, ac viverra ipsum volutpat quis. Aenean dapibus, nisl in efficitur iaculis.</p>
               </div>
			  
                <div class="tmnllisting">
                <div class="tmnlthumb"><a href="#"><img src="'.get_template_directory_uri()."/images/team2.jpg".'" alt="" /></a></div>
                   <h6><a href="#">Brandon Doe</a></h6>
				   <span>Ceo & Founder</span>
				   <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec laoreet magna diam, id ullamcorper lacus suscipit vehicula. In porta vehicula lacus, ac viverra ipsum volutpat quis. Aenean dapibus, nisl in efficitur iaculis.</p>
               </div>
			  
			     <div class="tmnllisting">
                <div class="tmnlthumb"><a href="#"><img src="'.get_template_directory_uri()."/images/team3.jpg".'" alt="" /></a></div>
                   <h6><a href="#">Brandon Doe</a></h6>
				   <span>Ceo & Founder</span>
				   <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec laoreet magna diam, id ullamcorper lacus suscipit vehicula. In porta vehicula lacus, ac viverra ipsum volutpat quis. Aenean dapibus, nisl in efficitur iaculis.</p>
               </div>
			  
			    <div class="tmnllisting">
                <div class="tmnlthumb"><a href="#"><img src="'.get_template_directory_uri()."/images/team4.jpg".'" alt="" /></a></div>
                   <h6><a href="#">Brandon Doe</a></h6>
				   <span>Ceo & Founder</span>
				   <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec laoreet magna diam, id ullamcorper lacus suscipit vehicula. In porta vehicula lacus, ac viverra ipsum volutpat quis. Aenean dapibus, nisl in efficitur iaculis.</p>
               </div>
			               
           
  </div>';			
	  endif;  
	wp_reset_query();	
	return $testimonialoutput;
}
add_shortcode( 'testimonials-listing', 'testimonials_listing_output_func' );


//Testimonials function
function testimonials_rotator_output_func( $atts ){
	extract( shortcode_atts( array( 
	'show' => '',
	),
	$atts ) ); 		
	wp_reset_query();
 	query_posts('post_type=testimonials&posts_per_page='.$show);
	if ( have_posts() ) :
	 $testimonialoutput = '<div id="testimonials"><div class="quotes">';	
		while ( have_posts() ) : the_post();	
		$designation = esc_html( get_post_meta( get_the_ID(), 'designation', true ) );		   
			$testimonialoutput .= '
			  <div> '.content( of_get_option('testimonialsexcerptlength') ).'
				  <h6><a href="'.get_permalink().'">'.get_the_title().'</a></h6>
				  <span>'.$designation.'</span>					
              </div>
			';
		endwhile;
		 $testimonialoutput .= '</div></div>';
	else:
	  $testimonialoutput = '<div id="testimonials"><div class="quotes">
           
               <div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec laoreet magna diam, id ullamcorper lacus suscipit vehicula. In porta vehicula lacus, ac viverra ipsum volutpat quis. Aenean dapibus, nisl in efficitur iaculis.</p>
				   <h6><a href="#">Brandon Doe</a></h6>
				   <span>Ceo & Founder</span>				  
               </div>
			  
                 <div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec laoreet magna diam, id ullamcorper lacus suscipit vehicula. In porta vehicula lacus, ac viverra ipsum volutpat quis. Aenean dapibus, nisl in efficitur iaculis.</p>
				   <h6><a href="#">Brandon Doe</a></h6>
				   <span>Ceo & Founder</span>				  
               </div>
           
  </div></div>';			
	  endif;  
	wp_reset_query();	
	return $testimonialoutput;
}
add_shortcode( 'sidebar-testimonials', 'testimonials_rotator_output_func' );


//custom post type for Our Team
function my_custom_post_team() {
	$labels = array(
		'name'               => __( 'Our Team', 'yoga-club' ),
		'singular_name'      => __( 'Our Team', 'yoga-club' ),
		'add_new'            => __( 'Add New', 'yoga-club' ),
		'add_new_item'       => __( 'Add New Team Member', 'yoga-club' ),
		'edit_item'          => __( 'Edit Team Member', 'yoga-club' ),
		'new_item'           => __( 'New Member', 'yoga-club' ),
		'all_items'          => __( 'All Members', 'yoga-club' ),
		'view_item'          => __( 'View Members', 'yoga-club' ),
		'search_items'       => __( 'Search Team Members', 'yoga-club' ),
		'not_found'          => __( 'No Team members found', 'yoga-club' ),
		'not_found_in_trash' => __( 'No Team members found in the Trash', 'yoga-club' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Our Team'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Manage Team',
		'public'        => true,
		'menu_position' => null,
		'menu_icon'		=> 'dashicons-groups',
		'supports'      => array( 'title', 'editor', 'thumbnail' ),
		'rewrite' => array('slug' => 'our-team'),
		'has_archive'   => true,
	);
	register_post_type( 'team', $args );
}
add_action( 'init', 'my_custom_post_team' );

// add meta box to team
add_action( 'admin_init', 'my_team_admin_function' );
function my_team_admin_function() {
    add_meta_box( 'team_meta_box',
        'Member Info',
        'display_team_meta_box',
        'team', 'normal', 'high'
    );
}
// add meta box form to team
function display_team_meta_box( $team ) {
    // Retrieve current name of the Director and Movie Rating based on review ID
    $designation = esc_html( get_post_meta( $team->ID, 'designation', true ) );
    $facebook = get_post_meta( $team->ID, 'facebook', true );
	$facebooklink = esc_url( get_post_meta( $team->ID, 'facebooklink', true ) );
    $twitter = get_post_meta( $team->ID, 'twitter', true );
	$twitterlink = esc_url( get_post_meta( $team->ID, 'twitterlink', true ) );
    $linkedin = get_post_meta( $team->ID, 'linkedin', true );
	$linkedinlink = esc_url( get_post_meta( $team->ID, 'linkedinlink', true ) );
	$pint = get_post_meta( $team->ID, 'google', true );
	$googlelink = esc_url( get_post_meta( $team->ID, 'googlelink', true ) );
    $dribbble = get_post_meta( $team->ID, 'dribbble', true );
	$dribbblelink = get_post_meta( $team->ID, 'dribbblelink', true );
    ?>
    <table width="100%">
        <tr>
            <td width="20%">Designation </td>
            <td width="80%"><input type="text" name="designation" value="<?php echo $designation; ?>" /></td>
        </tr>
        <tr>
            <td width="20%">Social link 1</td>
            <td width="40%"><input type="text" name="facebook" value="<?php echo $facebook; ?>" /></td>
            <td width="40%"><input style="width:500px;" type="text" name="facebooklink" value="<?php echo $facebooklink; ?>" /></td>
        </tr>
        <tr>
            <td width="20%">Social Link 2</td>
            <td width="40%"><input type="text" name="twitter" value="<?php echo $twitter; ?>" /></td>
            <td width="40%"><input style="width:500px;" type="text" name="twitterlink" value="<?php echo $twitterlink; ?>" /></td>
        </tr>
        <tr>
            <td width="20%">Social Link 3</td>
            <td width="40%"><input type="text" name="linkedin" value="<?php echo $linkedin; ?>" /></td>
            <td width="40%"><input style="width:500px;" type="text" name="linkedinlink" value="<?php echo $linkedinlink; ?>" /></td>
        </tr>
        <tr>
            <td width="20%">Social Link 4</td>
            <td width="40%"><input type="text" name="dribbble" value="<?php echo $dribbble; ?>" /></td>
            <td width="40%"><input style="width:500px;" type="text" name="dribbblelink" value="<?php echo $dribbblelink; ?>" /></td>
        </tr>
        <tr>
            <td width="20%">Social Link 5</td>
            <td width="40%"><input type="text" name="google" value="<?php echo $pint; ?>" /></td>
            <td width="40%"><input style="width:500px;" type="text" name="googlelink" value="<?php echo $googlelink; ?>" /></td>
        </tr>
        <tr>
        	<td width="100%" colspan="3"><label style="font-size:12px;"><strong>Note:</strong> Icon name should be in lowercase without space. More social icons can be found at: http://fortawesome.github.io/Font-Awesome/icons/</label> </td>
        </tr>
    </table>
    <?php                 
}
// save team meta box form data
add_action( 'save_post', 'add_team_fields_function', 10, 2 );
function add_team_fields_function( $team_id, $team ) {
    // Check post type for testimonials
    if ( $team->post_type == 'team' ) {
        // Store data in post meta table if present in post data
        if ( isset($_POST['designation']) ) {
            update_post_meta( $team_id, 'designation', $_POST['designation'] );
        }
        if ( isset($_POST['facebook']) ) {
            update_post_meta( $team_id, 'facebook', $_POST['facebook'] );
        }
		if ( isset($_POST['facebooklink']) ) {
            update_post_meta( $team_id, 'facebooklink', $_POST['facebooklink'] );
        }
        if ( isset($_POST['twitter']) ) {
            update_post_meta( $team_id, 'twitter', $_POST['twitter'] );
        }
		if ( isset($_POST['twitterlink']) ) {
            update_post_meta( $team_id, 'twitterlink', $_POST['twitterlink'] );
        }
        if ( isset($_POST['linkedin']) ) {
            update_post_meta( $team_id, 'linkedin', $_POST['linkedin'] );
        }
		if ( isset($_POST['linkedinlink']) ) {
            update_post_meta( $team_id, 'linkedinlink', $_POST['linkedinlink'] );
        }
        if ( isset($_POST['dribbble']) ) {
            update_post_meta( $team_id, 'dribbble', $_POST['dribbble'] );
        }
		if ( isset($_POST['dribbblelink']) ) {
            update_post_meta( $team_id, 'dribbblelink', $_POST['dribbblelink'] );
        }
		if ( isset($_POST['google']) ) {
            update_post_meta( $team_id, 'google', $_POST['google'] );
        }
		if ( isset($_POST['googlelink']) ) {
            update_post_meta( $team_id, 'googlelink', $_POST['googlelink'] );
        }
    }
}

function our_teamposts_func( $atts ) {
   extract( shortcode_atts( array(
		'show' => '',
	), $atts ) );
	  extract( shortcode_atts( array( 'show' => '',), $atts ) ); 
	$bposts = '';
	$args = array( 'post_type' => 'team', 'posts_per_page' => $show, 'post__not_in' => get_option('sticky_posts'), 'orderby' => 'date', 'order' => 'desc' );
	query_posts( $args );
	$n = 0;
	if ( have_posts() ) {
		while ( have_posts() ) { 
			the_post();
			$n++; if( $n%3 == 0 ) $nomargn = ' lastcols'; else $nomargn = '';
			$designation = esc_html( get_post_meta( get_the_ID(), 'designation', true ) );
			$facebook = get_post_meta( get_the_ID(), 'facebook', true );
			$facebooklink = get_post_meta( get_the_ID(), 'facebooklink', true );
			$twitter = get_post_meta( get_the_ID(), 'twitter', true );
			$twitterlink = get_post_meta( get_the_ID(), 'twitterlink', true );
			$linkedin = get_post_meta( get_the_ID(), 'linkedin', true );
			$linkedinlink = get_post_meta( get_the_ID(), 'linkedinlink', true );
			$dribbble = get_post_meta( get_the_ID(), 'dribbble', true );
			$dribbblelink = get_post_meta( get_the_ID(), 'dribbblelink', true );
			$pint = get_post_meta( get_the_ID(), 'google', true );
			$googlelink = get_post_meta( get_the_ID(), 'googlelink', true );				
			
			$bposts .= '<div class="teammember-list">';	
			$bposts .= '<a href="'.get_the_permalink().'"><div class="thumnailbx"><div class="overlaplbx"></div>'.get_the_post_thumbnail().'</div></a>';
				$bposts .= '<div class="titledesbox">
								<a href="'.get_the_permalink().'"><span class="title">'.get_the_title().'</span></a>
								<span class="degination">'.$designation.'</span>
							</div>
				 			';
							$bposts .= '<div class="member-social-icon">';
								if( $facebook != '' ){
									$bposts .= '<a href="'.$facebooklink.'" title="'.$facebook.'" target="_blank"><i class="'.$facebook.'"></i></a>';
								}
								if( $twitter != '' ){
									$bposts .= '<a href="'.$twitterlink.'" title="'.$twitter.'" target="_blank"><i class="'.$twitter.'"></i></a>';
								}
								if( $linkedin != '' ){
									$bposts .= '<a href="'.$linkedinlink.'" title="'.$linkedin.'" target="_blank"><i class="'.$linkedin.'"></i></a>';
								}
								if( $dribbble != '' ){
									$bposts .= '<a href="'.$dribbblelink.'" title="'.$dribbble.'" target="_blank"><i class="'.$dribbble.'"></i></a>';
								}
								if( $pint != '' ){
									$bposts .= '<a href="'.$pintlink.'" title="'.$pint.'" target="_blank"><i class="'.$pint.'"></i></a><div class="clear"></div>';
								}
				$bposts .= '</div>';
				$bposts .= '</div>';
		}
	}else{
		$bposts .= 'There are not found our team members';
	}
	wp_reset_query();
	$bposts .= '<div class="clear"></div>';
    return $bposts;
}
add_shortcode( 'our-team', 'our_teamposts_func' );

// Social Icon Shortcodes
function yoga_club_social_area($atts,$content = null){
  return '<div class="social-icons">'.do_shortcode($content).'</div>';
 }
add_shortcode('social_area','yoga_club_social_area');

function yoga_club_social($atts){
 extract(shortcode_atts(array(
  'icon' => '',
  'link' => ''
 ),$atts));
  return '<a href="'.$link.'" target="_blank" class="'.$icon.'" title="'.$icon.'"></a>';
 }
add_shortcode('social','yoga_club_social');


function contactform_func( $atts ) {
    $atts = shortcode_atts( array(
        'to_email' => get_bloginfo('admin_email'),
		'title' => 'Contact enquiry - '.home_url( '/' ),
    ), $atts );

	$cform = "<div class=\"main-form-area\" id=\"contactform_main\">";

	$cerr = array();
	if( isset($_POST['c_submit']) && $_POST['c_submit']=='Submit' ){
		$name 			= trim( $_POST['c_name'] );
		$email 			= trim( $_POST['c_email'] );
		$phone 			= trim( $_POST['c_phone'] );
		$website		= trim( $_POST['c_website'] );
		$comments 		= trim( $_POST['c_comments'] );
		$captcha 		= trim( $_POST['c_captcha'] );
		$captcha_cnf	= trim( $_POST['c_captcha_confirm'] );

		if( !$name )
			$cerr['name'] = 'Please enter your name.';
		if( ! filter_var($email, FILTER_VALIDATE_EMAIL) ) 
			$cerr['email'] = 'Please enter a valid email.';
		if( !$phone )
			$cerr['phone'] = 'Please enter your phone number.';
		if( !$comments )
			$cerr['comments'] = 'Please enter your message.';
		if( !$captcha || (md5($captcha) != $captcha_cnf) )
			$cerr['captcha'] = 'Please enter the correct answer.';

		if( count($cerr) == 0 ){
			$subject = $atts['title'];
			$headers = "From: ".$name." <" . strip_tags($email) . ">\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

			$message = '<html><body>
							<table>
								<tr><td>Name: </td><td>'.$name.'</td></tr>
								<tr><td>Email: </td><td>'.$email.'</td></tr>
								<tr><td>Phone: </td><td>'.$phone.'</td></tr>
								<tr><td>Website: </td><td>'.$website.'</td></tr>
								<tr><td>Message: </td><td>'.$comments.'</td></tr>
							</table>
						</body>
					</html>';
			mail( $atts['to_email'], $subject, $message, $headers);
			$cform .= '<div class="success_msg">Thank you! A representative will get back to you very shortly.</div>';
			unset( $name, $email, $phone, $website, $comments, $captcha );
		}else{
			$cform .= '<div class="error_msg">';
			$cform .= implode('<br />',$cerr);
			$cform .= '</div>';
		}
	}

	$capNum1 	= rand(1,4);
	$capNum2 	= rand(1,5);
	$capSum		= $capNum1 + $capNum2;
	$sumStr		= $capNum1." + ".$capNum2 ." = ";

	$cform .= "<form name=\"contactform\" action=\"#contactform_main\" method=\"post\">
			<p><input type=\"text\" name=\"c_name\" value=\"". ( ( empty($name) == false ) ? $name : "" ) ."\" placeholder=\"Name\" /></p>
			<p><input type=\"email\" name=\"c_email\" value=\"". ( ( empty($email) == false ) ? $email : "" ) ."\" placeholder=\"Email\" /></p><div class=\"clear\"></div>
			<p><input type=\"tel\" name=\"c_phone\" value=\"". ( ( empty($phone) == false ) ? $phone : "" ) ."\" placeholder=\"Phone\" /></p>
			<p><input type=\"url\" name=\"c_website\" value=\"". ( ( empty($website) == false ) ? $website : "" ) ."\" placeholder=\"Website with prefix http://\" /></p><div class=\"clear\"></div>
			<p><textarea name=\"c_comments\" placeholder=\"Message\">". ( ( empty($comments) == false ) ? $comments : "" ) ."</textarea></p><div class=\"clear\"></div>";
	$cform .= "<p><span class=\"capcode\">$sumStr</span><input type=\"text\" placeholder=\"Captcha\" value=\"". ( ( empty($captcha) == false ) ? $captcha : "" ) ."\" name=\"c_captcha\" /><input type=\"hidden\" name=\"c_captcha_confirm\" value=\"". md5($capSum)."\"></p><div class=\"clear\"></div>";
	$cform .= "<p class=\"sub\"><input type=\"submit\" name=\"c_submit\" value=\"Submit\" class=\"search-submit\" /></p>
		</form>
	</div>";

    return $cform;
}
add_shortcode( 'contactform', 'contactform_func' );


// custom post type for Our Classes
function my_custom_post_our_classes() {
	$labels = array(
		'name'               => __( 'Our Classes','yoga-club'),
		'singular_name'      => __( 'Our Classes','yoga-club'),
		'add_new'            => __( 'Add new Classes','yoga-club'),
		'add_new_item'       => __( 'Add new Classes','yoga-club'),
		'edit_item'          => __( 'Edit Our Classes','yoga-club'),
		'new_item'           => __( 'New Our Classes','yoga-club'),
		'all_items'          => __( 'All Our Classes','yoga-club'),
		'view_item'          => __( 'View Our classes','yoga-club'),
		'search_items'       => __( 'Search classes','yoga-club'),
		'not_found'          => __( 'No classes found','yoga-club'),
		'not_found_in_trash' => __( 'No classes found in the Trash','yoga-club'), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Our Classes'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Manage Classes',
		'public'        => true,
		'menu_icon'		=> 'dashicons-welcome-write-blog',
		'menu_position' => null,
		'supports'      => array( 'title', 'editor', 'thumbnail'),
		'has_archive'   => true,
	);
	register_post_type( 'our-classes', $args );	
}
add_action( 'init', 'my_custom_post_our_classes' );

// add meta box to classes
add_action( 'admin_init', 'my_classes_admin_function' );
function my_classes_admin_function() {
    add_meta_box( 'classes_meta_box',
        'Classes Info',
        'display_classes_meta_box',
        'our-classes', 'normal', 'high'
    );
}
// add meta box form to team
function display_classes_meta_box( $classes ) {
    // Retrieve current name of the Director and Movie Rating based on review ID
    $subtitle = esc_html( get_post_meta( $classes->ID, 'subtitle', true ) ); 
	$classtime = esc_html( get_post_meta( $classes->ID, 'classtime', true ) );     
    ?>
    <table width="100%">
        <tr>
            <td width="20%">Classes Sub Title</td>
            <td width="80%"><input type="text" name="subtitle" value="<?php echo $subtitle; ?>" /></td>
        </tr>
        <tr>
            <td width="20%">Classes Time</td>
            <td width="80%"><input type="text" name="classtime" value="<?php echo $classtime; ?>" /></td>
        </tr>       
    </table>
 <?php        
}
// save team meta box form data
add_action( 'save_post', 'add_classes_fields_function', 10, 2 );
function add_classes_fields_function( $classes_id, $classes ) {
    // Check post type for classes
    if ( $classes->post_type == 'our-classes' ) {
        // Store data in post meta table if present in post data
        if ( isset($_POST['subtitle']) ) {
            update_post_meta( $classes_id, 'subtitle', $_POST['subtitle'] );
        }
		
		if ( isset($_POST['classtime']) ) {
            update_post_meta( $classes_id, 'classtime', $_POST['classtime'] );
        }          
    }
}



//Classes function
function classes_output_func( $atts ){
	extract( shortcode_atts( array( 
		'show' => 3,		
		'date' => '',		
	),
	$atts ) ); 		
	wp_reset_query();
 	query_posts('post_type=our-classes&posts_per_page='.$show);
	if ( have_posts() ) :
	 $classesoutput = '<div id="classeswrap">';	
		while ( have_posts() ) : the_post();
		$n++;
					
			if($date=='show'){   
				$post_date = ''.get_the_date('M j, Y').'';
			} else {
				$post_date = '';
			}				
			
			if( $n%3==0 )  $nomgn = 'last';	else $nomgn = ' ';
			
		if ( has_post_thumbnail()) {
				$large_imgSrc = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
				$imgUrl = $large_imgSrc[0];
		}else{
				$imgUrl = get_template_directory_uri().'/images/img_404.png';
		}	
		$subtitle = esc_html( get_post_meta( get_the_ID(), 'subtitle', true ) );
		$classtime = esc_html( get_post_meta( get_the_ID(), 'classtime', true ) );			   
			$classesoutput .= '			     
				 <div class="classesbox '.$nomgn.'">
				  <div class="moreicon"><a href="'.get_the_permalink().'"><i class="fa fa-plus"></i></a></div>
				 <div class="classthumb"><a href="'.get_the_permalink().'"><img src="'.$imgUrl.'" alt=" " /></a></div>
				 <div class="classcontentbox">
				   <span class="subttl">'.$subtitle.'</span>
				   <h6><a href="'.get_the_permalink().'">'.get_the_title().'</a></h6>	
				   <div class="datetime">
				     <span><i class="far fa-calendar-alt"></i> '.$post_date.'</span>
				     <span><i class="far fa-clock"></i> '.$classtime.'</span>
				  </div>
				 </div>
				</div>';
		endwhile;
		 $classesoutput .= '</div>';
	else:
	  $classesoutput = '<div id="classeswrap">
              
              <div class="classesbox">
			       <div class="moreicon"><a href="#"><i class="fa fa-plus"></i> </a> </div>
				   <div class="classthumb"><a href="#"><img src="'.get_template_directory_uri()."/images/class01.jpg".'" alt="" /></a></div>
				   <div class="classcontentbox">                			  
					   <span class="subttl">Alignment</span>
					   <h6><a href="#">Ashtanga Open Practice</a></h6>
						<div class="datetime">
						   <span><i class="far fa-calendar-alt"></i> Feb 25, 2018</span>
						   <span><i class="far fa-clock"></i> 10.00 AM-11.00 PM</span>
					   </div>	
					</div>	
               </div>
			  
                <div class="classesbox">
			       <div class="moreicon"><a href="#"><i class="fa fa-plus"></i> </a> </div>
				   <div class="classthumb"><a href="#"><img src="'.get_template_directory_uri()."/images/class02.jpg".'" alt="" /></a></div>
				   <div class="classcontentbox">                			  
					   <span class="subttl">Ashtanga</span>
					   <h6><a href="#">Mysore Open</a></h6>
						<div class="datetime">
						   <span><i class="far fa-calendar-alt"></i> Feb 25, 2018</span>
						   <span><i class="far fa-clock"></i> 10.00 AM-11.00 PM</span>
					   </div>	
					</div>	
               </div>
			  
			    <div class="classesbox last">
			       <div class="moreicon"><a href="#"><i class="fa fa-plus"></i> </a> </div>
				   <div class="classthumb"><a href="#"><img src="'.get_template_directory_uri()."/images/class03.jpg".'" alt="" /></a></div>
				   <div class="classcontentbox">                			  
					   <span class="subttl">Hot Yoga</span>
					   <h6><a href="#">Hot Vinyasa</a></h6>
						<div class="datetime">
						   <span><i class="far fa-calendar-alt"></i> Feb 25, 2018</span>
						   <span><i class="far fa-clock"></i> 10.00 AM-11.00 PM</span>
					   </div>	
					</div>	
               </div>   
           
  </div>';			
	  endif;  
	wp_reset_query();	
	return $classesoutput;
}
add_shortcode( 'our-classes', 'classes_output_func' );


//custom post type for Our photogallery
function my_custom_post_photogallery() {
	$labels = array(
		'name'               => __( 'Photo Gallery','yoga-club' ),
		'singular_name'      => __( 'Photo Gallery','yoga-club' ),
		'add_new'            => __( 'Add New','yoga-club' ),
		'add_new_item'       => __( 'Add New Image ','yoga-club' ),
		'edit_item'          => __( 'Edit Image','yoga-club' ),
		'new_item'           => __( 'New Image','yoga-club' ),
		'all_items'          => __( 'All Images','yoga-club' ),
		'view_item'          => __( 'View Image','yoga-club' ),
		'search_items'       => __( 'Search Images','yoga-club' ),
		'not_found'          => __( 'No images found','yoga-club' ),
		'not_found_in_trash' => __( 'No images found in the Trash','yoga-club' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Photo Gallery'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Manage Photo Gallery',
		'public'        => true,
		'menu_position' => 23,
		'supports'      => array( 'title', 'thumbnail' ),
		'has_archive'   => true,
	);
	register_post_type( 'photogallery', $args );
}
add_action( 'init', 'my_custom_post_photogallery' );


//  register gallery taxonomy
register_taxonomy( "gallerycategory", 
	array("photogallery"), 
	array(
		"hierarchical" => true, 
		"label" => "Gallery Category", 
		"singular_label" => "Photo Gallery", 
		"rewrite" => true
	)
);

add_action("manage_posts_custom_column",  "photogallery_custom_columns");
add_filter("manage_edit-photogallery_columns", "photogallery_edit_columns");
function photogallery_edit_columns($columns){
	$columns = array(
		"cb" => '<input type="checkbox" />',
		"title" => "Gallery Title",
		"pcategory" => "Gallery Category",
		"view" => "Image",
		"date" => "Date",
	);
	return $columns;
}
function photogallery_custom_columns($column){
	global $post;
	switch ($column) {
		case "pcategory":
			echo get_the_term_list($post->ID, 'gallerycategory', '', ', ','');
		break;
		case "view":
			the_post_thumbnail('thumbnail');
		break;
		case "date":

		break;
	}
}


//[photogallery filter="false"]
function photogallery_shortcode_func( $atts ) {
	extract( shortcode_atts( array(
		'show' => -1,
		'filter' => 'true'
	), $atts ) );
	$pfStr = '';

	$pfStr .= '<div class="photobooth">';
	if( $filter == 'true' ){
		$pfStr .= '<ul class="portfoliofilter clearfix"><li><a class="selected" data-filter="*" href="#">'.of_get_option('galleryshowallbtn').'</a><span></span></li>';
		$categories = get_categories( array('taxonomy' => 'gallerycategory') );
		foreach ($categories as $category) {
			$pfStr .= '<li><a data-filter=".'.$category->slug.'" href="#">'.$category->name.'</a></li>';
		}
		$pfStr .= '</ul>';
	}

	$pfStr .= '<div class="row fourcol portfoliowrap"><div class="portfolio">';
	$j=0;
	query_posts('post_type=photogallery&posts_per_page='.$show); 
	if ( have_posts() ) : while ( have_posts() ) : the_post(); 
	$j++;
		$videoUrl = get_post_meta( get_the_ID(), 'video_file_url', true);
		$imgSrc = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
		$terms = wp_get_post_terms( get_the_ID(), 'gallerycategory', array("fields" => "all"));
		$slugAr = array();
		foreach( $terms as $tv ){
			$slugAr[] = $tv->slug;
		}
		if ( $imgSrc[0]!='' ) {
			$imgUrl = $imgSrc[0];
		}else{
			$imgUrl = get_template_directory_uri().'/images/img_404.png';
		}
		$pfStr .= '<div class="entry '.implode(' ', $slugAr).'">
						<div class="holderwrap">
							 <a href="'.( ($videoUrl) ? $videoUrl : $imgSrc[0] ).'" data-rel="prettyPhoto[bkpGallery]"><img src="'.$imgSrc[0].'"/>
							 <h5>'.get_the_title().'</h5></a>							
						</div>
					</div>';
		unset( $slugAr );
	endwhile; else: 
		$pfStr .= '<p>Sorry, photo gallery is empty.</p>';
	endif; 
	wp_reset_query();
	$pfStr .= '</div></div>';
	$pfStr .= '</div>';
	return $pfStr;
}
add_shortcode( 'photogallery', 'photogallery_shortcode_func' );

/*toggle function*/
function toggle_func( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'title' => 'Click here to toggle content',
	), $atts ) );
	$tog_content = "<div class=\"toggle_holder\"><h3 class=\"slide_toggle\"><a href=\"#\">{$title}</a></h3>
					<div class=\"slide_toggle_content\">".get_the_content_format( $content )."</div></div>";

	return $tog_content;
}
add_shortcode( 'toggle_content', 'toggle_func' );

function tabs_func( $atts, $content = null ) {
	$tabs = '<div class="tabs-wrapper"><ul class="tabs">'.do_shortcode($content).'</ul></div>';
	return $tabs;
}
add_shortcode( 'tabs', 'tabs_func' );

function tab_func( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'title' => 'Tab Title',
	), $atts ) );
	$rand = rand(100,999);
	$tab = '<li><a rel="tab'.$rand.'" href="javascript:void(0)">'.$title.'</a><div id="tab'.$rand.'" class="tab-content">'.get_the_content_format($content).'</div></li>';
	return $tab;
}
add_shortcode( 'tab', 'tab_func' );

// Button Shortcode
function readmorebtn_fun($atts){
	extract(shortcode_atts(array(
	'name'	=> '',
	'align'	=> '',
	'link'	=> '#',
	'target'=> '',
	), $atts));
	return '<div class="custombtn" style="text-align:'.$align.'">	
	   <a class="morebutton" href="'.$link.'" target"'.$target.'">'.$name.'</a>	   	   
	</div>';
	}
add_shortcode('button','readmorebtn_fun');

// Button Shortcode
function readmorebtn_style2_fun($atts){
	extract(shortcode_atts(array(
	'name'	=> '',
	'align'	=> '',
	'link'	=> '#',
	'target'=> '',	
	), $atts));
	return '<div class="custombtn" style="text-align:'.$align.'">	
	   <a class="buttonstyle1" href="'.$link.'" target"'.$target.'">'.$name.'</a>	   	   
	</div>';
	}
add_shortcode('buttonstyle2','readmorebtn_style2_fun');

// space Shortcode
function space_fun($atts){
	extract(shortcode_atts(array(
	'height'	=> '',	
	), $atts));
	return '<div class="space" style="height:'.$height.'"></div>';
	}
add_shortcode('space','space_fun');

// space Shortcode
function subtitle_fun($atts){
	extract(shortcode_atts(array(
	'size'	=> '',
	'color'	=> '',	
	'description'	=> '',
	'align'	=> '',
	), $atts));
	return '<div class="subtitle" style="font-size:'.$size.'; color:'.$color.'; text-align:'.$align.';">'.$description.'</div>';
	}
add_shortcode('subtitle','subtitle_fun');


// Latest News function
function latestnewsoutput_func( $atts ){
   extract( shortcode_atts( array(
		'showposts' => 3,		
		'comment' => '',
		'date' => '',
		'author' => '',		
	), $atts ) );
	$postoutput = '<div class="threecolumn-news">';
	wp_reset_query();
	$n = 0;
	query_posts(  array( 'posts_per_page'=>$showposts, 'post__not_in' => get_option('sticky_posts') )  );
	if ( have_posts() ) :
		while ( have_posts() ) : the_post();
			$n++;
			if($comment=='show' || $comment==''){   
				$post_comment = ' <span>Comments ( <a href="'.get_the_permalink().'#comments">'.get_comments_number().' </a>)</span>';
			} else {
				$post_comment = '';
			}			
			if($date=='show'){   
				$post_date = '<span class="postdt"><span>'.get_the_date().'</span>';
			} else {
				$post_date = '';
			}	
			if($author=='show'){   
				$post_author = '<span>By <a href="#">'.get_the_author_posts_link().'</a></span>';
			} else {
				$post_author = '';
			}
			if( $n%3==0 )  $nomgn = 'last';	else $nomgn = ' ';
			if ( has_post_thumbnail()) {
				$large_imgSrc = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
				$imgUrl = $large_imgSrc[0];
			}else{
				$imgUrl = get_template_directory_uri().'/images/img_404.png';
			}
			$postoutput .= '<div class="news-box '.$nomgn.'">
								<div class="news-thumb">
									<a href="'.get_the_permalink().'"><img src="'.$imgUrl.'" alt=" " /></a>									
								</div>
								<div class="PostMeta strp'.$n.'">										
										'.$post_author.'
										'.$post_date.'
										'.$post_comment.'                                    
								</div>
								<div class="newsdesc">
									<h6><a href="'.get_permalink().'">'.get_the_title().'</a></h6>																							
									 <p>'.wp_trim_words( get_the_content(), of_get_option('latestnewslength'), '...' ).'</p>
									 <a href="'.get_permalink().'">'.of_get_option('blogpostreadmoretext').'</a>								 
								</div>
								<div class="clear"></div>
                        </div>';	
						$postoutput .= ''.(($n%3==0) ? '<div class="clear"></div>' : '');	
		endwhile;
	endif;
	wp_reset_query();
	$postoutput .= '</div>';	
	return $postoutput;
}
add_shortcode( 'latest-news', 'latestnewsoutput_func' );

// custom post type for Our Events
function my_custom_post_our_events() {
	$labels = array(
		'name'               => __( 'Our Events','yoga-club'),
		'singular_name'      => __( 'Our Events','yoga-club'),
		'add_new'            => __( 'Add new Events','yoga-club'),
		'add_new_item'       => __( 'Add new Events','yoga-club'),
		'edit_item'          => __( 'Edit Our Events','yoga-club'),
		'new_item'           => __( 'New Our Events','yoga-club'),
		'all_items'          => __( 'All Our Events','yoga-club'),
		'view_item'          => __( 'View Our Events','yoga-club'),
		'search_items'       => __( 'Search Events','yoga-club'),
		'not_found'          => __( 'No events found','yoga-club'),
		'not_found_in_trash' => __( 'No events found in the Trash','yoga-club'), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Our Events'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Manage Events',
		'public'        => true,
		'menu_icon'		=> 'dashicons-calendar',
		'menu_position' => null,
		'supports'      => array( 'title', 'editor', 'thumbnail'),
		'has_archive'   => true,
	);
	register_post_type( 'our-events', $args );	
}
add_action( 'init', 'my_custom_post_our_events' );

// add meta box to events
add_action( 'admin_init', 'my_events_admin_function' );
function my_events_admin_function() {
    add_meta_box( 'events_meta_box',
        'Events Info',
        'display_events_meta_box',
        'our-events', 'normal', 'high'
    );
}
// add meta box form to team
function display_events_meta_box( $events ) {
    // Retrieve current name of the Director and Movie Rating based on review ID
    $eventdate = esc_html( get_post_meta( $events->ID, 'eventdate', true ) ); 
	$eventtime = esc_html( get_post_meta( $events->ID, 'eventtime', true ) ); 
	$eventplace = esc_html( get_post_meta( $events->ID, 'eventplace', true ) );      
    ?>
    <table width="100%">
        <tr>
            <td width="20%">Event Date</td>
            <td width="80%"><input type="text" name="eventdate" value="<?php echo $eventdate; ?>" /></td>
        </tr>
        <tr>
            <td width="20%">Event Time</td>
            <td width="80%"><input type="text" name="eventtime" value="<?php echo $eventtime; ?>" /></td>
        </tr>
        <tr>
            <td width="20%">Event Place</td>
            <td width="80%"><input type="text" name="eventplace" value="<?php echo $eventplace; ?>" /></td>
        </tr>        
    </table>
 <?php 
}
// save team meta box form data
add_action( 'save_post', 'add_events_fields_function', 10, 2 );
function add_events_fields_function( $events_id, $events ) {
    // Check post type for events
    if ( $events->post_type == 'our-events' ) {
        // Store data in post meta table if present in post data
        if ( isset($_POST['eventdate']) ) {
            update_post_meta( $events_id, 'eventdate', $_POST['eventdate'] );
        }
		
		if ( isset($_POST['eventtime']) ) {
            update_post_meta( $events_id, 'eventtime', $_POST['eventtime'] );
        } 
		
		if ( isset($_POST['eventplace']) ) {
            update_post_meta( $events_id, 'eventplace', $_POST['eventplace'] );
        }          
    }
}



//Events function
function events_output_func( $atts ){
	extract( shortcode_atts( array( 
		'show' => 2,		
	),
	$atts ) ); 		
	wp_reset_query();
 	query_posts('post_type=our-events&posts_per_page='.$show);
	if ( have_posts() ) :
	 $eventsoutput = '<div id="eventwrap">';	
		while ( have_posts() ) : the_post();
		$eventdate = esc_html( get_post_meta( get_the_ID(), 'eventdate', true ) );
		$eventtime = esc_html( get_post_meta( get_the_ID(), 'eventtime', true ) );
		$eventplace = esc_html( get_post_meta( get_the_ID(), 'eventplace', true ) );					   
			$eventsoutput .= '			     
				 <div class="eventbox">	
				 <div class="eventthumb"><a href="'.get_the_permalink().'">'.get_the_post_thumbnail( $page->ID, 'thumbnail' ).'</a></div>									 		   	
				   <div class="eventdetails">
				     <h5><a href="'.get_the_permalink().'">'.get_the_title().'</a></h5>
				     <span><i class="far fa-calendar-alt"></i>'.$eventdate.'</span>
				     <span><i class="far fa-clock"></i> '.$eventtime.'</span>
					 <span><i class="fas fa-map-marker-alt"></i> '.$eventplace.'</span>
				  </div>
				  
				</div>';
		endwhile;
		 $eventsoutput .= '</div>';
	else:
	  $eventsoutput = '<div id="eventwrap">
              
              <div class="eventbox">				  		   
				    <div class="eventdetails">
				       <h5><a href="#">Yoga Festival in New York</a></h5>
				       <span><i class="far fa-calendar-alt"></i> Feb 25, 2018</span>
				       <span><i class="far fa-clock"></i>12.00 PM-01.00 PM</span>
					   <span><i class="fas fa-map-marker-alt"></i>Vellington, Vic 568</span>
				   </div>	
               </div>
			  
                <div class="eventbox">			      
				   <div class="eventthumb"><a href="#"><img src="'.get_template_directory_uri()."/images/team4.jpg".'" alt="" /></a></div>				   
				    <div class="eventdetails">
				       <h5><a href="#">Yoga Festival in New Newzeland</a></h5>
				       <span><i class="far fa-calendar-alt"></i> Feb 25, 2018</span>
				       <span><i class="far fa-clock"></i>12.00 PM-01.00 PM</span>
					   <span><i class="fas fa-map-marker-alt"></i>Vellington, Vic 568</span>
				   </div>	
               </div>
  </div>';			
	  endif;  
	wp_reset_query();	
	return $eventsoutput;
}
add_shortcode( 'our-events', 'events_output_func' );



/*Clients Logo function*/
function yoga_club_client_logos($atts, $content = null){
	return '<ul id="flexiselDemo3">'.do_shortcode($content).'</ul>';
	}
add_shortcode('client_lists','yoga_club_client_logos');

function yoga_club_client($atts){
	extract(shortcode_atts(array(
	'image'	=> '',	
	'link'	=> '#'	
	), $atts));
	return '<li><a href="'.$link.'" target="_blank"><img src="'.$image.'" /></a></li>';
	}
add_shortcode('client','yoga_club_client');


// add shortcode for skills
function yoga_club_skills($yoga_club_skill_var){
	extract( shortcode_atts(array(
		'title' 	=> 'title',
		'percent'	=> 'percent',
		'bgcolor'	=> 'bgcolor',
	), $yoga_club_skill_var));
	
	return '<div class="skillbar clearfix " data-percent="'.$percent.'%">
			<div class="skillbar-title"><span>'.$title.'</span></div>
			<div class="skill-bg"><div class="skillbar-bar" style="background:'.$bgcolor.'"></div></div>
			<div class="skill-bar-percent">'.$percent.'%</div>
			</div>';
}

add_shortcode('skill','yoga_club_skills');

// Counter Shortcode
function my_custom_counter_func($atts){
	extract(shortcode_atts(array(	
	'value'	=> '',	
	'title'	=> '',
	'class'	=> '',
	), $atts));
	return '<div class="mycounterbox '.$class.'">		
	    <div class="mycountervalue">'.$value.'</div>
	    <h6>'.$title.'</h6>	   	   
	</div>';
	}
add_shortcode('counter','my_custom_counter_func');

// welcome3box content
function yoga_club_welcomebox($atts,$content = null){
  return '<div class="welcome-boxes">'.do_shortcode($content).'</div>';
 }
add_shortcode('welcome_3_box','yoga_club_welcomebox');

function yoga_club_box($atts){
 extract(shortcode_atts(array(
  'title' => '',
  'image' => '',
  'link' => '',
  'bgcolor' => '',
  'fontcolor' => ''
 ),$atts));
  return '<div class="welbox" style="background-color:'.$bgcolor.'; color:'.$fontcolor.';">
  <div class="welimgbox"><a href="'.$link.'"><img src="'.$image.'" /></a></div>	
  <h4><a href="'.$link.'">'.$title.'</a></h4>
  </div>';
 }
add_shortcode('box','yoga_club_box');


// Yoga Center Shortcode
function my_custom_yogatype_func($atts){
	extract(shortcode_atts(array(	
	'title'	=> '',
	'description'	=> '',
	'icon'	=> '',
	'image' => '',
  	'link' => '',
	'bgcolor' => '',
	'fontcolor' => '',
	), $atts));
	return '<div class="yoga_2_column">	   
		    <div class="yoga_content_box" style="background-color:'.$bgcolor.'; color:'.$fontcolor.'">
		      <i class="'.$icon.'"></i>
			  <h6>'.$title.'</h6>
			  <p>'.$description.'</p>
		   </div>
		   <div class="yoga_img_box"><a href="'.$link.'"><img src="'.$image.'" /></a></div>	
	    	<div class="clear"></div>   
	</div>';
	}
add_shortcode('yoga_center','my_custom_yogatype_func');
//[yoga_center title="" description="" icon="" image="" link=""]

//Pricing Table
function pricing_table_shortcode_func( $atts, $content = null ) {
   extract( shortcode_atts( array(
		'columns' => '4',
	), $atts ) );
	$ptbl = '<div class="pricing_table pcol'.$columns.'">'.do_shortcode( str_replace(array('<br />','\t','\n','\r','\0'.'\x0B'), array('','','','','',''), $content) ) .'<div class="clear"></div></div>';
	return $ptbl;
}
add_shortcode( 'pricing_table', 'pricing_table_shortcode_func' );

function price_column_func( $atts, $content = null ) {
   extract( shortcode_atts( array(
		'highlight' => '',
		'bgcolor' => '',
	), $atts ) );
	$pcol = '<div class="price_col '.( (strtolower($highlight) == 'yes') ? 'highlight' : '' ).'" '.( ($bgcolor!='') ? 'style="background-color:'.$bgcolor.' !important;"' : '' ) .'>'.do_shortcode( $content ) .'</div>';
    return $pcol;
}
add_shortcode( 'price_column', 'price_column_func' );

function price_column_faicon_func( $atts, $content = null ) {
   extract( shortcode_atts( array(		
		'icon' => '',
	), $atts ) );
	$pfaicon = '<div class="faicon"><i class="'.$icon.'"></i></div>';
    return $pfaicon;
}
add_shortcode( 'price_faicon', 'price_column_faicon_func' );

function price_column_header_func( $atts, $content = null ) {
   extract( shortcode_atts( array(
		'bgcolors' => '',		
	), $atts ) );
	$pheader = '<div class="th" style="background-color:'.$bgcolors.'">'.strip_tags($content).'</div>';
    return $pheader;
}
add_shortcode( 'price_header', 'price_column_header_func' );

function price_column_footer_func( $atts, $content = null ) {
   extract( shortcode_atts( array(
		'link' => '#',
	), $atts ) );
	$pfooter = '<div class="tf"><a href="'.$link.'">'.strip_tags($content).'</a></div>';
    return $pfooter;
}
add_shortcode( 'price_footer', 'price_column_footer_func' );

function price_row_footer_func( $atts, $content = null ) {
	$prow = '<div class="td">'.$content.'</div>';
    return $prow;
}
add_shortcode( 'price_row', 'price_row_footer_func' );

function price_row_packageprice_func( $atts, $content = null ) {
	$ppack = '<div class="price">'.$content.'</div>';
    return $ppack;
}
add_shortcode( 'package_price', 'price_row_packageprice_func' );

define('GRACE_THEME_DOC','https://www.gracethemes.com/documentation/yoga-club/');