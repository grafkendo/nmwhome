/**
 * Customizer Custom Functionality
 *
 */
( function( $ ) {
    
    $( window ).load( function() {
        
        // Show / Hide Fonts Google/Websafe settings
        vogue_websafe_check();
        $( '#customize-control-vogue-disable-google-fonts input[type=checkbox]' ).on( 'change', function() {
            vogue_websafe_check();
        });
        
        function vogue_websafe_check() {
            if ( $( '#customize-control-vogue-disable-google-fonts input[type=checkbox]' ).is( ':checked' ) ) {
                $( '#sub-accordion-section-vogue-typography-section #customize-control-vogue-body-font' ).hide();
                $( '#sub-accordion-section-vogue-typography-section #customize-control-vogue-heading-font' ).hide();
                $( '#sub-accordion-section-vogue-typography-section #customize-control-vogue-body-font-websafe' ).show();
                $( '#sub-accordion-section-vogue-typography-section #customize-control-vogue-heading-font-websafe' ).show();
            } else {
                $( '#sub-accordion-section-vogue-typography-section #customize-control-vogue-body-font-websafe' ).hide();
                $( '#sub-accordion-section-vogue-typography-section #customize-control-vogue-heading-font-websafe' ).hide();
                $( '#sub-accordion-section-vogue-typography-section #customize-control-vogue-body-font' ).show();
                $( '#sub-accordion-section-vogue-typography-section #customize-control-vogue-heading-font' ).show();
            }
        }

        //Show / Hide Color selector for slider setting
        var the_slider_select_value = $( '#customize-control-vogue-slider-type select' ).val();
        vogue_customizer_slider_check( the_slider_select_value );
        
        $( '#customize-control-vogue-slider-type select' ).on( 'change', function() {
            var slider_select_value = $( this ).val();
            vogue_customizer_slider_check( slider_select_value );
        } );
        
        function vogue_customizer_slider_check( slider_select_value ) {
            if ( slider_select_value == 'vogue-slider-default' ) {
                $( '#sub-accordion-section-vogue-site-slider-section #customize-control-vogue-meta-slider-shortcode' ).hide();
                $( '#sub-accordion-section-vogue-site-slider-section #customize-control-vogue-slider-cats' ).show();
                $( '#sub-accordion-section-vogue-site-slider-section #customize-control-vogue-slider-scroll-effect' ).show();
                $( '#sub-accordion-section-vogue-site-slider-section #customize-control-vogue-slider-pause-oh' ).show();
                $( '#sub-accordion-section-vogue-site-slider-section #customize-control-vogue-note-slider' ).show();
            } else if ( slider_select_value == 'vogue-meta-slider' ) {
                $( '#sub-accordion-section-vogue-site-slider-section #customize-control-vogue-slider-cats' ).hide();
                $( '#sub-accordion-section-vogue-site-slider-section #customize-control-vogue-slider-scroll-effect' ).hide();
                $( '#sub-accordion-section-vogue-site-slider-section #customize-control-vogue-meta-slider-shortcode' ).show();
                $( '#sub-accordion-section-vogue-site-slider-section #customize-control-vogue-slider-pause-oh' ).hide();
                $( '#sub-accordion-section-vogue-site-slider-section #customize-control-vogue-note-slider' ).hide();
            } else {
                $( '#sub-accordion-section-vogue-site-slider-section #customize-control-vogue-slider-cats' ).hide();
                $( '#sub-accordion-section-vogue-site-slider-section #customize-control-vogue-slider-scroll-effect' ).hide();
                $( '#sub-accordion-section-vogue-site-slider-section #customize-control-vogue-meta-slider-shortcode' ).hide();
                $( '#sub-accordion-section-vogue-site-slider-section #customize-control-vogue-slider-pause-oh' ).hide();
                $( '#sub-accordion-section-vogue-site-slider-section #customize-control-vogue-note-slider' ).hide();
            }
        }

        // Show / Hide Color selector for Footer setting
        var the_footer_select_value = $( '#customize-control-vogue-footer-layout select' ).val();
        footer_customizer_footer_check( the_footer_select_value );
        
        $( '#customize-control-vogue-footer-layout select' ).on( 'change', function() {
            var footer_select_value = $( this ).val();
            footer_customizer_footer_check( footer_select_value );
        } );
        
        function footer_customizer_footer_check( footer_select_value ) {
            if ( footer_select_value == 'vogue-footer-layout-standard' ) {
                $( '#sub-accordion-section-vogue-site-footer-section #customize-control-vogue-footer-social-icon-size' ).hide();
                $( '#sub-accordion-section-vogue-site-footer-section #customize-control-vogue-footer-social-icon-space' ).hide();
            } else {
                $( '#sub-accordion-section-vogue-site-footer-section #customize-control-vogue-footer-social-icon-size' ).show();
                $( '#sub-accordion-section-vogue-site-footer-section #customize-control-vogue-footer-social-icon-space' ).show();
            }
        }
        
    } );
    
} )( jQuery );