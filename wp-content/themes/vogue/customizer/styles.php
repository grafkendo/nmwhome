<?php
/**
 * Implements styles set in the theme customizer
 *
 * @package Customizer Library Vogue
 */

if ( ! function_exists( 'customizer_library_vogue_build_styles' ) && class_exists( 'Customizer_Library_Styles' ) ) :
/**
 * Process user options to generate CSS needed to implement the choices.
 *
 * @since  1.0.0.
 *
 * @return void
 */
function customizer_library_vogue_build_styles() {

	$websafe = ( get_theme_mod( 'vogue-disable-google-fonts', customizer_library_get_default( 'vogue-disable-google-fonts' ) ) == 1 ) ? '-websafe' : '';
	
	// Site Logo Max Width
	$setting = 'vogue-header-image-logo-max-width';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$logo_max_width = esc_attr( $mod );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'a.site-logo-img'
			),
			'declarations' => array(
				'max-width' => $logo_max_width . 'px'
			)
		) );
	}
	
	// Primary Color
	$setting = 'vogue-primary-color';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$color = sanitize_hex_color( $mod );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'#comments .form-submit #submit,
                .search-block .search-submit,
                .side-aligned-social a.header-social-icon,
                .no-results-btn,
                button,
                input[type="button"],
                input[type="reset"],
                input[type="submit"],
                .woocommerce ul.products li.product a.add_to_cart_button, .woocommerce-page ul.products li.product a.add_to_cart_button,
                .woocommerce ul.products li.product .onsale, .woocommerce-page ul.products li.product .onsale,
                .woocommerce button.button.alt,
                .woocommerce-page button.button.alt,
                .woocommerce input.button.alt:hover,
                .woocommerce-page #content input.button.alt:hover,
                .woocommerce .cart-collaterals .shipping_calculator .button,
                .woocommerce-page .cart-collaterals .shipping_calculator .button,
                .woocommerce a.button,
                .woocommerce #respond input#submit.alt,
				.woocommerce a.button.alt,
				.woocommerce button.button.alt,
				.woocommerce input.button.alt,
                .woocommerce-page a.button,
                .woocommerce input.button,
                .woocommerce-page #content input.button,
                .woocommerce-page input.button,
                .woocommerce #review_form #respond .form-submit input,
                .woocommerce-page #review_form #respond .form-submit input,
                .woocommerce-cart .wc-proceed-to-checkout a.checkout-button:hover,
                .woocommerce .widget_price_filter .ui-slider .ui-slider-range,
                .woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
                .single-product span.onsale,
                .woocommerce button.button.alt.disabled,
                .main-navigation ul ul a:hover,
                .main-navigation ul ul li.current-menu-item > a,
                .main-navigation ul ul li.current_page_item > a,
                .main-navigation ul ul li.current-menu-parent > a,
                .main-navigation ul ul li.current_page_parent > a,
                .main-navigation ul ul li.current-menu-ancestor > a,
                .main-navigation ul ul li.current_page_ancestor > a,
                .main-navigation button,
                .wpcf7-submit'
			),
			'declarations' => array(
				'background' => 'inherit',
                'background-color' => $color
			)
		) );
		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.wp-block-quote:not(.is-large),
				.wp-block-quote:not(.is-style-large)'
			),
			'declarations' => array(
                'border-left-color' => $color
			)
		) );
	}
	
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$color = sanitize_hex_color( $mod );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'a,
				.content-area .entry-content a,
				#comments a,
				.post-edit-link,
				.site-title a,
				.error-404.not-found .page-header .page-title span,
				.search-button .fa-search,
				.header-cart-checkout.cart-has-items .fa-shopping-cart,
				.main-navigation div > ul > li > a:hover,
				.main-navigation div > ul > li.current-menu-item > a,
				.main-navigation div > ul > li.current-menu-ancestor > a,
				.main-navigation div > ul > li.current-menu-parent > a,
				.main-navigation div > ul > li.current_page_parent > a,
				.main-navigation div > ul > li.current_page_ancestor > a'
			),
			'declarations' => array(
                'color' => $color . ''
			)
		) );
	}
	
	

	// Secondary Color
	$setting = 'vogue-secondary-color';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$color = sanitize_hex_color( $mod );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.main-navigation button:hover,
                #comments .form-submit #submit:hover,
                .search-block .search-submit:hover,
                .no-results-btn:hover,
                button,
                input[type="button"],
                input[type="reset"],
                input[type="submit"],
                .woocommerce input.button.alt,
                .woocommerce-page #content input.button.alt,
                .woocommerce .cart-collaterals .shipping_calculator .button,
                .woocommerce-page .cart-collaterals .shipping_calculator .button,
                .woocommerce a.button:hover,
                .woocommerce #respond input#submit.alt:hover,
				.woocommerce a.button.alt:hover,
				.woocommerce button.button.alt:hover,
				.woocommerce input.button.alt:hover,
                .woocommerce-page a.button:hover,
                .woocommerce input.button:hover,
                .woocommerce-page #content input.button:hover,
                .woocommerce-page input.button:hover,
                .woocommerce ul.products li.product a.add_to_cart_button:hover, .woocommerce-page ul.products li.product a.add_to_cart_button:hover,
                .woocommerce button.button.alt:hover,
                .woocommerce-page button.button.alt:hover,
                .woocommerce #review_form #respond .form-submit input:hover,
                .woocommerce-page #review_form #respond .form-submit input:hover,
                .woocommerce-cart .wc-proceed-to-checkout a.checkout-button,
                .woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content,
                .woocommerce button.button.alt.disabled:hover,
                .wpcf7-submit:hover'
			),
			'declarations' => array(
				'background' => 'inherit',
                'background-color' => $color
			)
		) );
	}
	
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$color = sanitize_hex_color( $mod );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'a:hover,
				.content-area .entry-content a:hover,
                .widget-area .widget a:hover,
                .site-header-topbar ul li a:hover,
                .site-footer-widgets .widget a:hover,
                .site-footer .widget a:hover,
                .search-btn:hover,
                .search-button .fa-search:hover,
                .woocommerce #content div.product p.price,
                .woocommerce-page #content div.product p.price,
                .woocommerce-page div.product p.price,
                .woocommerce #content div.product span.price,
                .woocommerce div.product span.price,
                .woocommerce-page #content div.product span.price,
                .woocommerce-page div.product span.price,
                .woocommerce #content div.product .woocommerce-tabs ul.tabs li.active,
                .woocommerce div.product .woocommerce-tabs ul.tabs li.active,
                .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active,
                .woocommerce-page div.product .woocommerce-tabs ul.tabs li.active'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Body Font
	$setting = 'vogue-body-font'.$websafe;
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );
	if ( $websafe ) {
		$stack = '\''.$mod.'\', sans-serif';
	} else {
		$stack = customizer_library_get_font_stack( $mod );
	}

	if ( $mod != customizer_library_get_default( $setting ) || get_theme_mod( 'vogue-disable-google-fonts' ) == 1 ) {

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'body,
				.main-navigation ul li a,
				.widget-area .widget a'
			),
			'declarations' => array(
				'font-family' => $stack
			)
		) );

	}
	
	// Body Font Color
	$setting = 'vogue-body-font-color';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$color = sanitize_hex_color( $mod );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'body,
                .widget-area .widget a'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Heading Font
	$setting = 'vogue-heading-font'.$websafe;
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );
	if ( $websafe ) {
		$stack = '\''.$mod.'\', sans-serif';
	} else {
		$stack = customizer_library_get_font_stack( $mod );
	}

	if ( $mod != customizer_library_get_default( $setting ) || get_theme_mod( 'vogue-disable-google-fonts' ) == 1 ) {

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'h1, h2, h3, h4, h5, h6,
                h1 a, h2 a, h3 a, h4 a, h5 a, h6 a,
                .widget-area .widget-title,
                .woocommerce table.cart th,
                .woocommerce-page #content table.cart th,
                .woocommerce-page table.cart th,
                .woocommerce input.button.alt,
                .woocommerce-page #content input.button.alt,
                .woocommerce table.cart input,
                .woocommerce-page #content table.cart input,
                .woocommerce-page table.cart input,
                button, input[type="button"],
                input[type="reset"],
                input[type="submit"]',
			),
			'declarations' => array(
				'font-family' => $stack
			)
		) );

	}
	
	// Heading Font Color
	$setting = 'vogue-heading-font-color';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$color = sanitize_hex_color( $mod );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'h1, h2, h3, h4, h5, h6,
                h1 a, h2 a, h3 a, h4 a, h5 a, h6 a,
                .widget-area .widget-title'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Change Main Navigation case
	$setting = 'vogue-nav-change-case';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );
	$stack = customizer_library_get_font_stack( $mod );

	if ( $mod != customizer_library_get_default( $setting ) ) {

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.main-navigation li'
			),
			'declarations' => array(
				'text-transform' => 'none'
			)
		) );

	}

	$setting = 'vogue-wc-mobile-prod-full-width';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$title_bottom_margin = esc_attr( $mod );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.woocommerce ul.products,
    			.woocommerce-page ul.products'
			),
			'declarations' => array(
				'margin' => '0 0 30px !important'
			),
			'media' => '(max-width: 600px)'
		) );
		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.woocommerce ul.products li.product,
    			.woocommerce-page ul.products li.product'
			),
			'declarations' => array(
				'width' => '100% !important',
				'margin' => '0 0 24px !important'
			),
			'media' => '(max-width: 600px)'
		) );
	}

	$setting = 'vogue-site-title-uc';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$container_width = esc_attr( $mod );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.site-title'
			),
			'declarations' => array(
				'text-transform' => 'uppercase'
			)
		) );
	}
	$setting = 'vogue-site-tagline-lc';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$container_width = esc_attr( $mod );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.site-description'
			),
			'declarations' => array(
				'text-transform' => 'none'
			)
		) );
	}
	$setting = 'vogue-blog-list-title-size';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$post_title_font_size = esc_attr( $mod );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.post-loop-content .entry-title'
			),
			'declarations' => array(
				'font-size' => $post_title_font_size . 'px'
			)
		) );
	}
	$setting = 'vogue-defaul-text-size';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$body_text_size = esc_attr( $mod );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'body,
				button,
				input,
				select,
				textarea'
			),
			'declarations' => array(
				'font-size' => $body_text_size.'px'
			)
		) );
	}
	$setting = 'vogue-side-social-top';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$side_social_top = esc_attr( $mod );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.side-aligned-social'
			),
			'declarations' => array(
				'top' => $side_social_top.'px'
			)
		) );
	}
	$setting = 'vogue-footer-social-icon-size';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$footer_social_size = esc_attr( $mod );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.footer-social-icon'
			),
			'declarations' => array(
				'font-size' => $footer_social_size . 'px'
			)
		) );
	}
	$setting = 'vogue-footer-social-icon-space';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$footer_social_size = esc_attr( $mod );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.footer-social-icon'
			),
			'declarations' => array(
				'margin' => '0 ' . $footer_social_size . 'px 15px'
			)
		) );
	}

}
endif;

add_action( 'customizer_library_styles', 'customizer_library_vogue_build_styles' );

if ( ! function_exists( 'customizer_library_vogue_styles' ) ) :
/**
 * Generates the style tag and CSS needed for the theme options.
 *
 * By using the "Customizer_Library_Styles" filter, different components can print CSS in the header.
 * It is organized this way to ensure there is only one "style" tag.
 *
 * @since  1.0.0.
 *
 * @return void
 */
function customizer_library_vogue_styles() {

	do_action( 'customizer_library_styles' );

	// Echo the rules
	$css = Customizer_Library_Styles()->build();

	if ( ! empty( $css ) ) {
		echo "\n<!-- Begin Custom CSS -->\n<style type=\"text/css\" id=\"vogue-custom-css\">\n";
		echo $css;
		echo "\n</style>\n<!-- End Custom CSS -->\n";
	}
}
endif;

add_action( 'wp_head', 'customizer_library_vogue_styles', 11 );