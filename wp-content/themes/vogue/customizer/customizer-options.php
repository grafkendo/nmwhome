<?php
/**
 * Defines customizer options
 *
 * @package Customizer Library Vogue
 */

function customizer_library_vogue_options() {

	$primary_color = '#F061A8';
	$secondary_color = '#EA1B82';

	$body_font_color = '#3C3C3C';
	$heading_font_color = '#000000';

	// Stores all the controls that will be added
	$options = array();

	// Stores all the sections to be added
	$sections = array();

	// Stores all the panels to be added
	$panels = array();

	// Adds the sections to the $options array
	$options['sections'] = $sections;

    // Header Image
    $section = 'header_image';

    $sections[] = array(
        'id' => $section,
        'title' => __( 'Site Logo', 'vogue' ),
        'priority' => '25'
    );

    $options['vogue-site-title-uc'] = array(
        'id' => 'vogue-site-title-uc',
        'label'   => __( 'Site Title - Uppercase', 'vogue' ),
        'section' => $section,
        'type'    => 'checkbox',
        'default' => 0,
    );
    $options['vogue-site-tagline-lc'] = array(
        'id' => 'vogue-site-tagline-lc',
        'label'   => __( 'Site Tagline - Lowercase', 'vogue' ),
        'section' => $section,
        'type'    => 'checkbox',
        'default' => 0,
    );
    $options['vogue-header-image-logo-max-width'] = array(
        'id' => 'vogue-header-image-logo-max-width',
        'label'   => __( 'Set a max-width for the logo', 'vogue' ),
        'section' => $section,
        'type'    => 'number',
        'description' => __( 'This only applies if a logo image is uploaded', 'vogue' )
    );


    $panel = 'vogue-panel-layout';

    $panels[] = array(
        'id' => $panel,
        'title' => __( 'Vogue Theme Settings', 'vogue' ),
        'priority' => '30'
    );

    $section = 'vogue-site-layout-section';

    $sections[] = array(
        'id' => $section,
        'title' => __( 'Site Layout', 'vogue' ),
        'priority' => '10',
        'description' => 'Change/edit the <a href="#vogue-site-header-section" rel="tc-section">Header</a> & <a href="#vogue-site-footer-section" rel="tc-section">Footer</a> Layouts<br />Add a <a href="#vogue-site-slider-section" rel="tc-section">Home Page Slider</a><br />Change/edit the <a href="#vogue-site-blog-section" rel="tc-section">Blog Layout</a><br />Add <a href="#vogue-social-section" rel="tc-section">Social Links</a> to your site<br />Edit <a href="#vogue-website-section" rel="tc-section">Website Text</a>',
        'panel' => $panel
    );

    $options['vogue-disable-google-fonts'] = array(
        'id' => 'vogue-disable-google-fonts',
        'label'   => __( 'GDPR: Disable Google Fonts', 'vogue' ),
        'section' => $section,
        'type'    => 'checkbox',
        'default' => 0,
        'description' => __( 'Disable Google Fonts and only select from web-safe fonts', 'vogue' ),
    );
    $options['vogue-btt-button'] = array(
        'id' => 'vogue-btt-button',
        'label'   => __( 'Enable a Back To Top button', 'vogue' ),
        'section' => $section,
        'type'    => 'checkbox',
        'default' => 0,
    );
    $options['vogue-titlebar-centered'] = array(
        'id' => 'vogue-titlebar-centered',
        'label'   => __( 'Center Align Page Titles', 'vogue' ),
        'section' => $section,
        'type'    => 'checkbox',
        'default' => 0,
    );
    $choices = array(
        'vogue-page-fimage-layout-none' => __( 'None', 'vogue' ),
        'vogue-page-fimage-layout-standard' => __( 'Standard', 'vogue' )
    );
    $options['vogue-page-fimage-layout'] = array(
        'id' => 'vogue-page-fimage-layout',
        'label'   => __( 'Featured Image Layout', 'vogue' ),
        'section' => $section,
        'type'    => 'select',
        'choices' => $choices,
        'description' => __( 'Select the layouts you want for the Featured Image for Blog Posts & Pages', 'vogue' ),
        'default' => 'vogue-page-fimage-layout-none'
    );
    $options['vogue-site-add-side-social'] = array(
        'id' => 'vogue-site-add-side-social',
        'label'   => __( 'Add Side Aligned Social Icons', 'vogue' ),
        'section' => $section,
        'type'    => 'checkbox',
        'description' => __( 'Add <a href="#vogue-social-section" rel="tc-section">Social Icons</a> for this to show', 'vogue' ),
        'default' => 0,
    );
    $options['vogue-side-social-top'] = array(
        'id' => 'vogue-side-social-top',
        'label'   => __( 'Position from the top', 'vogue' ),
        'section' => $section,
        'type'    => 'number',
        'default' => 110,
    );
    if ( vogue_is_woocommerce_activated() ) :
        $options['vogue-wc-mobile-prod-full-width'] = array(
            'id' => 'vogue-wc-mobile-prod-full-width',
            'label'   => __( 'Products Full Width on Mobile', 'vogue' ),
            'section' => $section,
            'type'    => 'checkbox',
            'default' => 0,
        );
    endif;
    $options['vogue-note-layout'] = array(
        'id' => 'vogue-note-layout',
        'section' => $section,
        'type'    => 'note',
        'description' => __( '<b>Premium Extra Features:</b><br />- Site Boxed / Full Width layouts<br />- Set custom website container width<br />- Set page sidebar custom width<br />- Remove all Page Titles<br />- Page Featured Image displayed as full width banner<br />- Set WooCommerce Shop, Archives & Product pages to Left Sidebar<br />- Set WooCommerce Shop, Archives & Product pages to Full Width<br />- Remove WooCommerce Product borders<br />- Set Shop products per page<br />- Set Shop products per row<br />- Remove WooCommerce Product Image Zoom and/or LightBox', 'vogue' )
    );


	$section = 'vogue-site-header-section';

    $sections[] = array(
        'id' => $section,
        'title' => __( 'Header', 'vogue' ),
        'priority' => '20',
        'panel' => $panel
    );

	$options['vogue-header-remove-topbar'] = array(
		'id' => 'vogue-header-remove-topbar',
		'label'   => __( 'Remove the Top Bar', 'vogue' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 0,
	);

    $choices = array(
        'vogue-header-layout-one' => __( 'Header Centered One', 'vogue' ),
        'vogue-header-layout-two' => __( 'Header Centered Two', 'vogue' ),
        'vogue-header-layout-three' => __( 'Header Standard', 'vogue' ),
        'vogue-header-layout-four' => __( 'Header Standard Two', 'vogue' )
    );
    $options['vogue-header-layout'] = array(
        'id' => 'vogue-header-layout',
        'label'   => __( 'Header Layout', 'vogue' ),
        'section' => $section,
        'type'    => 'select',
        'choices' => $choices,
        'default' => 'vogue-header-layout-one'
    );

    $options['vogue-nav-change-case'] = array(
        'id' => 'vogue-nav-change-case',
        'label'   => __( 'Navigation Text - Normal Case', 'vogue' ),
        'section' => $section,
        'type'    => 'checkbox',
        'default' => 0,
    );
	$options['vogue-header-menu-text'] = array(
		'id' => 'vogue-header-menu-text',
		'label'   => __( 'Menu Button Text', 'vogue' ),
		'section' => $section,
		'type'    => 'text',
		'default' => 'menu',
		'description' => __( 'This is the text for the mobile menu button', 'vogue' )
	);

	$options['vogue-header-search'] = array(
        'id' => 'vogue-header-search',
        'label'   => __( 'Remove Search', 'vogue' ),
        'section' => $section,
        'type'    => 'checkbox',
        'default' => 0,
    );
    $options['vogue-header-hide-social'] = array(
        'id' => 'vogue-header-hide-social',
        'label'   => __( 'Remove Social Links', 'vogue' ),
        'section' => $section,
        'type'    => 'checkbox',
        'default' => 0,
    );
    $options['vogue-header-hide-add'] = array(
        'id' => 'vogue-header-hide-add',
        'label'   => __( 'Remove Address', 'vogue' ),
        'section' => $section,
        'type'    => 'checkbox',
        'default' => 0,
    );
    $options['vogue-header-hide-no'] = array(
        'id' => 'vogue-header-hide-no',
        'label'   => __( 'Remove Phone Number', 'vogue' ),
        'section' => $section,
        'type'    => 'checkbox',
        'default' => 0,
    );

    $options['vogue-note-header'] = array(
        'id' => 'vogue-note-header',
        'section' => $section,
        'type'    => 'note',
        'description' => __( '<b>Premium Extra Features:</b><br />- Add/Show WooCommerce Cart items basket<br />- Set Sticky Navigation<br />- Change header density - Comfortable or Compact<br />- Remove the WooCommerce Cart<br />- Option to replace default search with Shortcode<br />- Remove Slider Text on mobile<br />- Remove Top Bar on mobile devices<br />- Customize Navigation font size', 'vogue' )
    );


    $section = 'vogue-site-slider-section';

    $sections[] = array(
        'id' => $section,
        'title' => __( 'Home Page Slider', 'vogue' ),
        'priority' => '30',
        'panel' => $panel
    );

    $choices = array(
        'vogue-slider-default' => __( 'Default Slider', 'vogue' ),
        'vogue-meta-slider' => __( 'Slider Shortcode', 'vogue' ),
        'vogue-no-slider' => __( 'None', 'vogue' )
    );
    $options['vogue-slider-type'] = array(
        'id' => 'vogue-slider-type',
        'label'   => __( 'Choose a Slider', 'vogue' ),
        'section' => $section,
        'type'    => 'select',
        'choices' => $choices,
        'default' => 'vogue-slider-default'
    );
    $options['vogue-slider-cats'] = array(
        'id' => 'vogue-slider-cats',
        'label'   => __( 'Slider Categories', 'vogue' ),
        'section' => $section,
        'type'    => 'text',
        'description' => __( 'Enter the ID\'s of the post categories you want to display in the slider. Eg: "13,17,19" (no spaces and only comma\'s)<br /><br />Get the ID at <b>Posts -> Categories</b>.<br /><br />Or <a href="https://kairaweb.com/documentation/setting-up-the-default-slider/" target="_blank"><b>See more instructions here</b></a>', 'vogue' )
    );
    $options['vogue-meta-slider-shortcode'] = array(
        'id' => 'vogue-meta-slider-shortcode',
        'label'   => __( 'Slider Shortcode', 'vogue' ),
        'section' => $section,
        'type'    => 'text',
        'description' => __( 'Enter the shortcode give by the slider plugin', 'vogue' )
    );
    $choices = array(
        'crossfade' => __( 'Cross Fade', 'vogue' ),
        'cover-fade' => __( 'Cover Fade', 'vogue' ),
        'uncover-fade' => __( 'Uncover Fade', 'vogue' ),
        'cover' => __( 'Cover', 'vogue' ),
        'scroll' => __( 'Scroll', 'vogue' )
    );
    $options['vogue-slider-scroll-effect'] = array(
        'id' => 'vogue-slider-scroll-effect',
        'label'   => __( 'Slider Scroll Effect', 'vogue' ),
        'section' => $section,
        'type'    => 'select',
        'choices' => $choices,
        'default' => 'uncover-fade'
    );
    $options['vogue-slider-pause-oh'] = array(
        'id' => 'vogue-slider-pause-oh',
        'label'   => __( 'Pause Slider on mouse hover', 'vogue' ),
        'section' => $section,
        'type'    => 'checkbox',
        'default' => 0,
    );
    $options['vogue-slider-random'] = array(
        'id' => 'vogue-slider-random',
        'label'   => __( 'Randomize the Slider Slides', 'vogue' ),
        'section' => $section,
        'type'    => 'checkbox',
        'default' => 0,
    );

    $options['vogue-note-slider'] = array(
        'id' => 'vogue-note-slider',
        'section' => $section,
        'type'    => 'note',
        'description' => __( '<b>Premium Extra Features:</b><br />- Set each slide to have custom url link<br />- Change slider size - Small / Medium / Large<br />- Scroll Duration<br />- Remove slider title/text<br />- Link slide To post<br />- Stop auto scroll<br /><br />- Extra Slider color settings', 'vogue' )
    );

    $section = 'vogue-site-blog-section';

    $sections[] = array(
        'id' => $section,
        'title' => __( 'Blog', 'vogue' ),
        'priority' => '40',
        'panel' => $panel
    );

    $choices = array(
        'blog-left-layout' => __( 'Left Layout', 'vogue' ),
        'blog-right-layout' => __( 'Right Layout', 'vogue' ),
        'blog-top-layout' => __( 'Top Layout', 'vogue' ),
        'blog-alt-layout' => __( 'Alternate Layout', 'vogue' )
    );
    $options['vogue-blog-layout'] = array(
        'id' => 'vogue-blog-layout',
        'label'   => __( 'Blog Posts Layout', 'vogue' ),
        'section' => $section,
        'type'    => 'select',
        'choices' => $choices,
        'description' => __( 'This uses the "Large Size" image cut', 'vogue' ),
        'default' => 'blog-left-layout'
    );
    $choices = array(
        'blog-img-shape-img' => __( 'Image Shape Blocks', 'vogue' ),
        'blog-img-shape-square' => __( 'Square Blocks', 'vogue' ),
        'blog-img-shape-round' => __( 'Round Images', 'vogue' )
    );
    $options['vogue-blog-img-shape'] = array(
        'id' => 'vogue-blog-img-shape',
        'label'   => __( 'Blog Image Shape', 'vogue' ),
        'section' => $section,
        'type'    => 'select',
        'choices' => $choices,
        'default' => 'blog-img-shape-img'
    );
    $options['vogue-blog-list-img-cut'] = array(
        'id' => 'vogue-blog-list-img-cut',
        'label'   => __( 'Blog Image Cut', 'vogue' ),
        'section' => $section,
        'type'    => 'imageselect',
        'description' => __( 'Select which cut the Blog list uses<br />Recommended: Optimize images before upload', 'vogue' ),
        'default' => 'large'
    );
    $options['vogue-blog-cats'] = array(
        'id' => 'vogue-blog-cats',
        'label'   => __( 'Exclude Blog Categories', 'vogue' ),
        'section' => $section,
        'type'    => 'text',
        'description' => __( 'Enter the ID\'s of the post categories you\'d like to EXCLUDE from the Blog, enter only the ID\'s with a minus sign (-) before them, separated by a comma (,)<br />Eg: "-13, -17, -19"<br /><br />If you enter the ID\'s without the minus then it\'ll show ONLY posts in those categories.<br /><br />Get the ID at <b>Posts -> Categories</b>.', 'vogue' )
    );
    $options['vogue-blog-list-title-size'] = array(
        'id' => 'vogue-blog-list-title-size',
        'label'   => __( 'Blog List Title Font Size', 'vogue' ),
        'section' => $section,
        'type'    => 'number',
        'default' => 32
    );
    $options['vogue-remove-single-pag'] = array(
        'id' => 'vogue-remove-single-pag',
        'label'   => __( 'Remove Single Page Next & Previous posts', 'vogue' ),
        'section' => $section,
        'type'    => 'checkbox',
        'default' => 0,
    );

    $options['vogue-note-blog'] = array(
        'id' => 'vogue-note-blog',
        'section' => $section,
        'type'    => 'note',
        'description' => __( '<b>Premium Extra Features:</b><br />- Display Full Post or Summary<br />- Includes blog grid layout<br />- Select grid layout columns<br />- Set Blog/Archives & Single pages to Left Sidebar<br />- Set Blog/Archives & Single pages to Full Width<br />- Remove meta text<br />- Remove categories/tags on blog list<br />- Blog Single page featured image as page banner<br />- Remove single page titles<br />- Add Author block on post pages', 'vogue' )
    );

    $section = 'vogue-site-footer-section';

    $sections[] = array(
        'id' => $section,
        'title' => __( 'Footer', 'vogue' ),
        'priority' => '50',
        'panel' => $panel
    );

    $choices = array(
        'vogue-footer-layout-social' => __( 'Social Layout', 'vogue' ),
        'vogue-footer-layout-standard' => __( 'Standard Layout', 'vogue' )
    );
    $options['vogue-footer-layout'] = array(
        'id' => 'vogue-footer-layout',
        'label'   => __( 'Footer Layout', 'vogue' ),
        'section' => $section,
        'type'    => 'select',
        'choices' => $choices,
        'default' => 'vogue-footer-layout-social'
    );
    $options['vogue-footer-privacy-link'] = array(
        'id' => 'vogue-footer-privacy-link',
        'label'   => __( 'Add "Privacy Policy" page link', 'vogue' ),
        'section' => $section,
        'type'    => 'checkbox',
        'default' => 0,
    );
    $options['vogue-footer-bottombar'] = array(
        'id' => 'vogue-footer-bottombar',
        'label'   => __( 'Remove the Bottom Bar', 'vogue' ),
        'section' => $section,
        'type'    => 'checkbox',
        'default' => 0,
    );
    $options['vogue-footer-hide-social'] = array(
        'id' => 'vogue-footer-hide-social',
        'label'   => __( 'Remove Social Links', 'vogue' ),
        'section' => $section,
        'type'    => 'checkbox',
        'default' => 0,
    );
    $options['vogue-footer-social-icon-size'] = array(
        'id' => 'vogue-footer-social-icon-size',
        'label'   => __( 'Social Icon Size', 'vogue' ),
        'section' => $section,
        'type'    => 'range',
        'input_attrs' => array(
            'min'   => 16,
            'max'   => 100,
            'step'  => 1,
        ),
        'default' => 34
    );
    $options['vogue-footer-social-icon-space'] = array(
        'id' => 'vogue-footer-social-icon-space',
        'label'   => __( 'Social Icon Spacing', 'vogue' ),
        'section' => $section,
        'type'    => 'range',
        'input_attrs' => array(
            'min'   => 5,
            'max'   => 80,
            'step'  => 1,
        ),
        'default' => 14
    );

    $options['vogue-note-footer'] = array(
        'id' => 'vogue-note-footer',
        'section' => $section,
        'type'    => 'note',
        'description' => __( '<b>Premium Extra Features:</b><br />- Offers 5 footer layouts<br />- Advanced custom footer layout, select columns & manually adjust column widths<br />- Remove/Edit Kaira attribution text', 'vogue' )
    );


    $section = 'vogue-site-seo-section';

    $sections[] = array(
        'id' => $section,
        'title' => __( 'SEO (Search Engine Optimization)', 'vogue' ),
        'priority' => '50',
        'panel' => $panel
    );

    $choices = array(
        '1' => __( 'H1', 'vogue' ),
        '2' => __( 'H2', 'vogue' ),
        '3' => __( 'H3', 'vogue' ),
        '4' => __( 'H4', 'vogue' ),
        '5' => __( 'H5', 'vogue' ),
        '6' => __( 'H6', 'vogue' )
    );
    $options['vogue-seo-site-title-tag'] = array(
        'id' => 'vogue-seo-site-title-tag',
        'label'   => __( 'Site Title Element', 'vogue' ),
        'section' => $section,
        'type'    => 'select',
        'choices' => $choices,
        'default' => '1'
    );

    $choices = array(
        '1' => __( 'H1', 'vogue' ),
        '2' => __( 'H2', 'vogue' ),
        '3' => __( 'H3', 'vogue' ),
        '4' => __( 'H4', 'vogue' ),
        '5' => __( 'H5', 'vogue' ),
        '6' => __( 'H6', 'vogue' )
    );
    $options['vogue-seo-site-desc-tag'] = array(
        'id' => 'vogue-seo-site-desc-tag',
        'label'   => __( 'Site Description Element', 'vogue' ),
        'section' => $section,
        'type'    => 'select',
        'choices' => $choices,
        'default' => '2'
    );

    $choices = array(
        '1' => __( 'H1', 'vogue' ),
        '2' => __( 'H2', 'vogue' ),
        '3' => __( 'H3', 'vogue' ),
        '4' => __( 'H4', 'vogue' ),
        '5' => __( 'H5', 'vogue' ),
        '6' => __( 'H6', 'vogue' )
    );
    $options['vogue-seo-page-title-tag'] = array(
        'id' => 'vogue-seo-page-title-tag',
        'label'   => __( 'Page Titles Element', 'vogue' ),
        'section' => $section,
        'type'    => 'select',
        'choices' => $choices,
        'default' => '3'
    );
    $choices = array(
        '1' => __( 'H1', 'vogue' ),
        '2' => __( 'H2', 'vogue' ),
        '3' => __( 'H3', 'vogue' ),
        '4' => __( 'H4', 'vogue' ),
        '5' => __( 'H5', 'vogue' ),
        '6' => __( 'H6', 'vogue' )
    );
    $options['vogue-seo-blog-post-title-tag'] = array(
        'id' => 'vogue-seo-blog-post-title-tag',
        'label'   => __( 'Blog List Titles Element', 'vogue' ),
        'section' => $section,
        'type'    => 'select',
        'choices' => $choices,
        'default' => '3'
    );
    $choices = array(
        '1' => __( 'H1', 'vogue' ),
        '2' => __( 'H2', 'vogue' ),
        '3' => __( 'H3', 'vogue' ),
        '4' => __( 'H4', 'vogue' ),
        '5' => __( 'H5', 'vogue' ),
        '6' => __( 'H6', 'vogue' )
    );
    $options['vogue-seo-widget-title-tag'] = array(
        'id' => 'vogue-seo-widget-title-tag',
        'label'   => __( 'Widget Titles Element', 'vogue' ),
        'section' => $section,
        'type'    => 'select',
        'choices' => $choices,
        'default' => '4'
    );


	// Colors
	$section = 'colors';

	$sections[] = array(
		'id' => $section,
		'title' => __( 'Colors', 'vogue' ),
		'priority' => '80'
	);

	$options['vogue-primary-color'] = array(
		'id' => 'vogue-primary-color',
		'label'   => __( 'Primary Color', 'vogue' ),
		'section' => $section,
		'type'    => 'color',
		'default' => $primary_color,
	);
	$options['vogue-secondary-color'] = array(
		'id' => 'vogue-secondary-color',
		'label'   => __( 'Secondary Color', 'vogue' ),
		'section' => $section,
		'type'    => 'color',
		'default' => $secondary_color,
	);
    $choices = array(
        'vogue-mobile-nav-skin-dark' => __( 'Dark Skin', 'vogue' ),
        'vogue-mobile-nav-skin-light' => __( 'Light Skin', 'vogue' )
    );
    $options['vogue-mobile-nav-skin'] = array(
        'id' => 'vogue-mobile-nav-skin',
        'label'   => __( 'Mobile Navigation Colors', 'vogue' ),
        'section' => $section,
        'type'    => 'select',
        'choices' => $choices,
        'description' => __( 'Premium includes custom color settings for the mobile navigation', 'vogue' ),
        'default' => 'vogue-mobile-nav-skin-dark'
    );

    $options['vogue-note-color'] = array(
        'id' => 'vogue-note-color',
        'section' => $section,
        'type'    => 'note',
        'description' => __( '<b>Premium Extra Features:</b><br />- Advanced color settings for header<br />- Advanced color settings for Top Bar & Navigation<br />- Advanced color settings for footer<br />- Custom color settings for mobile navigation', 'vogue' )
    );


	// Font Options
    $section = 'vogue-typography-section';
    $font_websafe_choices = array( 'Arial' => 'Arial', 'Arial Black' => 'Arial Black', 'Helvetica' => 'Helvetica', 'Verdana' => 'Verdana', 'Georgia' => 'Georgia', 'Palatino' => 'Palatino', 'Garamond' => 'Garamond', 'Bookman' => 'Bookman', 'Courier' => 'Courier', 'Courier New' => 'Courier New', 'Times New Roman' => 'Times New Roman', 'Times' => 'Times' );
	$font_choices = customizer_library_get_font_choices();

	$sections[] = array(
		'id' => $section,
		'title' => __( 'Vogue Theme Fonts', 'vogue' ),
		'priority' => '50'
	);

	$options['vogue-body-font'] = array(
		'id' => 'vogue-body-font',
		'label'   => __( 'Body Font', 'vogue' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => $font_choices,
		'default' => 'Open Sans'
    );
    $options['vogue-body-font-websafe'] = array(
		'id' => 'vogue-body-font-websafe',
		'label'   => __( 'Body Font', 'vogue' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => $font_websafe_choices,
		'default' => 'Arial'
	);
	$options['vogue-body-font-color'] = array(
		'id' => 'vogue-body-font-color',
		'label'   => __( 'Body Font Color', 'vogue' ),
		'section' => $section,
		'type'    => 'color',
		'default' => $body_font_color,
	);

	$options['vogue-heading-font'] = array(
		'id' => 'vogue-heading-font',
		'label'   => __( 'Heading Font', 'vogue' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => $font_choices,
		'default' => 'Lato'
    );
    $options['vogue-heading-font-websafe'] = array(
		'id' => 'vogue-heading-font-websafe',
		'label'   => __( 'Heading Font', 'vogue' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => $font_websafe_choices,
		'default' => 'Verdana'
	);
	$options['vogue-heading-font-color'] = array(
		'id' => 'vogue-heading-font-color',
		'label'   => __( 'Heading Font Color', 'vogue' ),
		'section' => $section,
		'type'    => 'color',
		'default' => $heading_font_color,
	);
    $options['vogue-defaul-text-size'] = array(
        'id' => 'vogue-defaul-text-size',
        'label'   => __( 'Default Body Font Size', 'vogue' ),
        'section' => $section,
        'type'    => 'number',
        'default' => 14,
    );

    $options['vogue-note-typography'] = array(
        'id' => 'vogue-note-typography',
        'section' => $section,
        'type'    => 'note',
        'description' => __( '<b>Premium Extra Features:</b><br />- Select custom font for site title<br />- Change site title size<br />- Change site tagline size<br />- Set spacing for site tite & tagline<br /><br />- Custom settings for uploaded logo', 'vogue' )
    );


	// Site Text Settings
    $section = 'vogue-website-section';

    $sections[] = array(
        'id' => $section,
        'title' => __( 'Vogue Theme Text', 'vogue' ),
        'priority' => '60'
    );

    $options['vogue-website-site-add'] = array(
        'id' => 'vogue-website-site-add',
        'label'   => __( 'Header Address', 'vogue' ),
        'section' => $section,
        'type'    => 'text',
        'default' => __( 'Cape Town, South Africa', 'vogue' ),
        'description' => __( 'The address in the Header and Social Footer', 'vogue' )
    );
    $options['vogue-website-head-no'] = array(
        'id' => 'vogue-website-head-no',
        'label'   => __( 'Header Phone Number', 'vogue' ),
        'section' => $section,
        'type'    => 'text',
        'default' => __( 'Call Us: +2782 444 YEAH', 'vogue' )
    );

    $options['vogue-website-error-head'] = array(
        'id' => 'vogue-website-error-head',
        'label'   => __( '404 Error Page Heading', 'vogue' ),
        'section' => $section,
        'type'    => 'text',
        'default' => __( 'Oops! <span>404</span>', 'vogue'),
        'description' => __( 'Enter the heading for the 404 Error page', 'vogue' )
    );
    $options['vogue-website-error-msg'] = array(
        'id' => 'vogue-website-error-msg',
        'label'   => __( 'Error 404 Message', 'vogue' ),
        'section' => $section,
        'type'    => 'textarea',
        'default' => __( 'It looks like that page does not exist. <br />Return home or try a search', 'vogue'),
        'description' => __( 'Enter the default text on the 404 error page (Page not found)', 'vogue' )
    );
    $options['vogue-website-nosearch-msg'] = array(
        'id' => 'vogue-website-nosearch-msg',
        'label'   => __( 'No Search Results', 'vogue' ),
        'section' => $section,
        'type'    => 'textarea',
        'default' => __( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'vogue'),
        'description' => __( 'Enter the default text for when no search results are found', 'vogue' )
    );

    $options['vogue-note-website'] = array(
        'id' => 'vogue-note-website',
        'section' => $section,
        'type'    => 'note',
        'description' => __( '<b>Premium Extra Features:</b><br />- Change attribution/copyright text to your own', 'vogue' )
    );


	// Social Settings
    $section = 'vogue-social-section';

    $sections[] = array(
        'id' => $section,
        'title' => __( 'Vogue Social Links', 'vogue' ),
        'priority' => '60'
    );

    $options['vogue-social-email'] = array(
        'id' => 'vogue-social-email',
        'label'   => __( 'Email Address', 'vogue' ),
        'section' => $section,
        'type'    => 'text',
    );
    $options['vogue-social-facebook'] = array(
        'id' => 'vogue-social-facebook',
        'label'   => __( 'Facebook', 'vogue' ),
        'section' => $section,
        'type'    => 'text',
    );
    $options['vogue-social-twitter'] = array(
        'id' => 'vogue-social-twitter',
        'label'   => __( 'Twitter', 'vogue' ),
        'section' => $section,
        'type'    => 'text',
    );
    $options['vogue-social-skype'] = array(
        'id' => 'vogue-social-skype',
        'label'   => __( 'Skype Name', 'vogue' ),
        'section' => $section,
        'type'    => 'text',
    );
    $options['vogue-social-linkedin'] = array(
        'id' => 'vogue-social-linkedin',
        'label'   => __( 'LinkedIn', 'vogue' ),
        'section' => $section,
        'type'    => 'text',
    );
    $options['vogue-social-tumblr'] = array(
        'id' => 'vogue-social-tumblr',
        'label'   => __( 'Tumblr', 'vogue' ),
        'section' => $section,
        'type'    => 'text',
    );
    $options['vogue-social-flickr'] = array(
        'id' => 'vogue-social-flickr',
        'label'   => __( 'Flickr', 'vogue' ),
        'section' => $section,
        'type'    => 'text',
    );
    $options['vogue-social-houzz'] = array(
        'id' => 'vogue-social-houzz',
        'label'   => __( 'Houzz', 'vogue' ),
        'section' => $section,
        'type'    => 'text',
    );
    $options['vogue-social-vk'] = array(
        'id' => 'vogue-social-vk',
        'label'   => __( 'VK', 'vogue' ),
        'section' => $section,
        'type'    => 'text',
    );

    $options['vogue-note-social'] = array(
        'id' => 'vogue-note-social',
        'section' => $section,
        'type'    => 'note',
        'description' => __( '<b>Premium Extra Features:</b><br />- Change Social Links to their brand color<br />- Over 22 different social profile links available<br />- Setting to add your own social icon', 'vogue' )
    );
    
    // Site Plugins Support
    $section = 'vogue-plugin-support-section';

    $sections[] = array(
        'id' => $section,
        'title' => __( 'Plugin Support', 'vogue' ),
        'priority' => '120',
        'description' => __( 'Vogue adds/removes custom styling to support external plugins', 'vogue' )
    );
    
    $options['vogue-plugin-mega-menu'] = array(
        'id' => 'vogue-plugin-mega-menu',
        'label'   => __( 'Mega Menu', 'vogue' ),
        'section' => $section,
        'type'    => 'checkbox',
        'default' => 0,
    );
    $options['vogue-plugin-hfelementor'] = array(
        'id' => 'vogue-plugin-hfelementor',
        'label'   => __( 'Header Footer Elementor', 'vogue' ),
        'section' => $section,
        'type'    => 'checkbox',
        'default' => 0,
    );


	// Adds the sections to the $options array
	$options['sections'] = $sections;

	// Adds the panels to the $options array
	$options['panels'] = $panels;

	$customizer_library = Customizer_Library::Instance();
	$customizer_library->add_options( $options );

	// To delete custom mods use: customizer_library_remove_theme_mods();

}
add_action( 'init', 'customizer_library_vogue_options' );
