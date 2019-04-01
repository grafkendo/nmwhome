<?php
/**
 * VW Yoga Fitness Theme Customizer
 *
 * @package VW Yoga Fitness
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function vw_yoga_fitness_customize_register( $wp_customize ) {

	load_template( trailingslashit( get_template_directory() ) . 'inc/customize-homepage/class-customize-homepage.php' );

	//add home page setting pannel
	$wp_customize->add_panel( 'vw_yoga_fitness_panel_id', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'VW Settings', 'vw-yoga-fitness' ),
	    'description' => __( 'Description of what this panel does.', 'vw-yoga-fitness' ),
	) );

	$wp_customize->add_section( 'vw_yoga_fitness_left_right', array(
    	'title'      => __( 'General Settings', 'vw-yoga-fitness' ),
		'priority'   => 30,
		'panel' => 'vw_yoga_fitness_panel_id'
	) );

	$wp_customize->add_setting('vw_yoga_fitness_theme_options',array(
        'default' => __('Right Sidebar','vw-yoga-fitness'),
        'sanitize_callback' => 'vw_yoga_fitness_sanitize_choices'	        
	));
	$wp_customize->add_control('vw_yoga_fitness_theme_options',array(
        'type' => 'select',
        'label' => __('Post Sidebar Layout','vw-yoga-fitness'),
        'description' => __('Here you can change the sidebar layout for posts. ','vw-yoga-fitness'),
        'section' => 'vw_yoga_fitness_left_right',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','vw-yoga-fitness'),
            'Right Sidebar' => __('Right Sidebar','vw-yoga-fitness'),
            'One Column' => __('One Column','vw-yoga-fitness'),
            'Three Columns' => __('Three Columns','vw-yoga-fitness'),
            'Four Columns' => __('Four Columns','vw-yoga-fitness'),
            'Grid Layout' => __('Grid Layout','vw-yoga-fitness')
        ),
	) );

	$wp_customize->add_setting('vw_yoga_fitness_page_layout',array(
        'default' => __('Right Sidebar','vw-yoga-fitness'),
        'sanitize_callback' => 'vw_yoga_fitness_sanitize_choices'	        
	));
	$wp_customize->add_control('vw_yoga_fitness_page_layout',array(
        'type' => 'select',
        'label' => __('Page Sidebar Layout','vw-yoga-fitness'),
        'description' => __('Here you can change the sidebar layout for pages. ','vw-yoga-fitness'),
        'section' => 'vw_yoga_fitness_left_right',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','vw-yoga-fitness'),
            'Right Sidebar' => __('Right Sidebar','vw-yoga-fitness'),
            'One Column' => __('One Column','vw-yoga-fitness')
        ),
	) );

	$wp_customize->add_section( 'vw_yoga_fitness_topbar', array(
    	'title'      => __( 'Topbar Settings', 'vw-yoga-fitness' ),
		'priority'   => 30,
		'panel' => 'vw_yoga_fitness_panel_id'
	) );

	$wp_customize->add_setting('vw_yoga_fitness_button_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_yoga_fitness_button_text',array(
		'label'	=> __('Add Button Text','vw-yoga-fitness'),
		'input_attrs' => array(
            'placeholder' => __( 'Book Now', 'vw-yoga-fitness' ),
        ),
		'section'=> 'vw_yoga_fitness_topbar',
		'type'=> 'text'
	));		

	$wp_customize->add_setting('vw_yoga_fitness_button_url',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('vw_yoga_fitness_button_url',array(
		'label'	=> __('Add Button URL','vw-yoga-fitness'),
		'input_attrs' => array(
            'placeholder' => __( 'www.example.com', 'vw-yoga-fitness' ),
        ),
		'section'=> 'vw_yoga_fitness_topbar',
		'type'=> 'url'
	));	
    
	//Slider
	$wp_customize->add_section( 'vw_yoga_fitness_slidersettings' , array(
    	'title'      => __( 'Slider Section', 'vw-yoga-fitness' ),
		'priority'   => null,
		'panel' => 'vw_yoga_fitness_panel_id'
	) );

	$wp_customize->add_setting('vw_yoga_fitness_slider_arrows',array(
       'default' => 'false',
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('vw_yoga_fitness_slider_arrows',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide slider','vw-yoga-fitness'),
       'section' => 'vw_yoga_fitness_slidersettings',
    ));

	for ( $count = 1; $count <= 4; $count++ ) {

		$wp_customize->add_setting( 'vw_yoga_fitness_slider_page' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'vw_yoga_fitness_sanitize_dropdown_pages'
		) );
		$wp_customize->add_control( 'vw_yoga_fitness_slider_page' . $count, array(
			'label'    => __( 'Select Slider Page', 'vw-yoga-fitness' ),
			'description' => __('Slider image size (1500 x 590)','vw-yoga-fitness'),
			'section'  => 'vw_yoga_fitness_slidersettings',
			'type'     => 'dropdown-pages'
		) );
	}

	//Services
	$wp_customize->add_section( 'vw_yoga_fitness_service_section' , array(
    	'title'      => __( 'Our Classes Section', 'vw-yoga-fitness' ),
		'priority'   => null,
		'panel' => 'vw_yoga_fitness_panel_id'
	) );

	$wp_customize->add_setting('vw_yoga_fitness_section_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_yoga_fitness_section_title',array(
		'label'	=> __('Section Title','vw-yoga-fitness'),
		'input_attrs' => array(
            'placeholder' => __( 'Our Classes', 'vw-yoga-fitness' ),
        ),
		'section'=> 'vw_yoga_fitness_service_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_yoga_fitness_section_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_yoga_fitness_section_text',array(
		'label'	=> __('Section Text','vw-yoga-fitness'),
		'input_attrs' => array(
            'placeholder' => __( 'Lorem ipsum is a dummy text.', 'vw-yoga-fitness' ),
        ),
		'section'=> 'vw_yoga_fitness_service_section',
		'type'=> 'text'
	));	

	$categories = get_categories();
	$cat_post = array();
	$cat_post[]= 'select';
	$i = 0;	
	foreach($categories as $category){
		if($i==0){
			$default = $category->slug;
			$i++;
		}
		$cat_post[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('vw_yoga_fitness_services',array(
		'default'	=> 'select',
		'sanitize_callback' => 'vw_yoga_fitness_sanitize_choices',
	));
	$wp_customize->add_control('vw_yoga_fitness_services',array(
		'type'    => 'select',
		'choices' => $cat_post,
		'label' => __('Select Category to display services','vw-yoga-fitness'),
		'description' => __('Image Size (340 x 255)','vw-yoga-fitness'),
		'section' => 'vw_yoga_fitness_service_section',
	));

	//Content Craetion
	$wp_customize->add_section( 'vw_yoga_fitness_content_section' , array(
    	'title' => __( 'Customize Home Page', 'vw-yoga-fitness' ),
		'priority' => null,
		'panel' => 'vw_yoga_fitness_panel_id'
	) );

	$wp_customize->add_setting('vw_yoga_fitness_content_creation_main_control', array(
		'sanitize_callback' => 'esc_html',
	) );

	$homepage= get_option( 'page_on_front' );

	$wp_customize->add_control(	new VW_Yoga_Fitness_Content_Creation( $wp_customize, 'vw_yoga_fitness_content_creation_main_control', array(
		'options' => array(
			esc_html__( 'First select static page in homepage setting for front page.Below given edit button is to customize Home Page. Just click on the edit option, add whatever elements you want to include in the homepage, save the changes and you are good to go.','vw-yoga-fitness' ),
		),
		'section' => 'vw_yoga_fitness_content_section',
		'button_url'  => admin_url( 'post.php?post='.$homepage.'&action=edit'),
		'button_text' => esc_html__( 'Edit', 'vw-yoga-fitness' ),
	) ) );

	//Footer Text
	$wp_customize->add_section('vw_yoga_fitness_footer',array(
		'title'	=> __('Footer','vw-yoga-fitness'),
		'panel' => 'vw_yoga_fitness_panel_id',
	));	
	
	$wp_customize->add_setting('vw_yoga_fitness_footer_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_yoga_fitness_footer_text',array(
		'label'	=> __('Copyright Text','vw-yoga-fitness'),
		'input_attrs' => array(
            'placeholder' => __( 'Copyright 2018, .....', 'vw-yoga-fitness' ),
        ),
		'section'=> 'vw_yoga_fitness_footer',
		'type'=> 'text'
	));	
}

add_action( 'customize_register', 'vw_yoga_fitness_customize_register' );

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class VW_Yoga_Fitness_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/inc/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'VW_Yoga_Fitness_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new VW_Yoga_Fitness_Customize_Section_Pro(
				$manager,
				'example_1',
				array(
					'priority'   => 9,
					'title'    => esc_html__( 'VW Yoga Fitness', 'vw-yoga-fitness' ),
					'pro_text' => esc_html__( 'UPGRADE PRO', 'vw-yoga-fitness' ),
					'pro_url'  => esc_url('https://www.vwthemes.com/themes/yoga-wordpress-theme/'),
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'vw-yoga-fitness-customize-controls', trailingslashit( get_template_directory_uri() ) . '/assets/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'vw-yoga-fitness-customize-controls', trailingslashit( get_template_directory_uri() ) . '/assets/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
VW_Yoga_Fitness_Customize::get_instance();