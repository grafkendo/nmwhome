<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Enrollment
 * @subpackage Enrolled
 * @since 1.0.0
 */

    if( ! is_page_template( 'templates/template-home.php' ) ) { 
        echo '</div><!-- .cv-container -->';
    }

    $enrolled_footer_bg_image = get_theme_mod( 'enrolled_footer_bg_image', '' );
    $footer_style = '';
    $footer_class = '';
    if( !empty( $enrolled_footer_bg_image ) ) {
        $footer_style = 'style="background-image:url('. esc_url( $enrolled_footer_bg_image ) .')"';
        $footer_class = 'has-bg-image';
    }
?>

    </div><!-- #content -->

    <footer id="colophon" class="site-footer <?php echo esc_attr( $footer_class ); ?>" role="contentinfo" <?php echo $footer_style; ?>>
        <?php 
            $enrollment_footer_widget_option = get_theme_mod( 'enrollment_footer_widget_option', true );
            if( $enrollment_footer_widget_option === true ) {
                get_sidebar( 'footer' );
            }
        ?>
        <div class="site-info-wrapper">
            <div class="site-info">
                <div class="cv-container">
                    <div class="enrollment-copyright-wrapper">
                        <?php $enrollment_copyright_text = get_theme_mod( 'enrollment_copyright_text', __( 'Enrolled', 'enrolled' ) ); ?>
                        <span class="enrollment-copyright"><?php echo wp_kses_post( $enrollment_copyright_text ); ?></span>
                        <span class="sep"> | </span>
                        <?php printf( esc_html__( '%1$s by %2$s.', 'enrolled' ), 'Enrolled Theme', '<a href="'. esc_url( 'https://codevibrant.com/' ).'" rel="designer">CodeVibrant</a>' ); ?>
                    </div>
                    <?php 
                        $enrollment_sub_footer_type = get_theme_mod( 'enrollment_sub_footer_type', 'social_icon' );
                        if( $enrollment_sub_footer_type == 'social_icon' ) {
                    ?>
                        <div class="cv-footer-social">
                            <?php enrollment_social_icons(); ?>
                        </div><!-- .cv-footer-social -->
                    <?php } else { ?>
                        <nav id="site-footer-navigation" class="footer-navigation" role="navigation">
                            <?php wp_nav_menu( array( 'theme_location' => 'enrollment_footer_menu', 'menu_id' => 'footer-menu', 'fallback_cb'    => false ) ); ?>
                        </nav><!-- #site-navigation -->
                    <?php } ?>
                </div>
            </div><!-- .site-info -->
        </div>
    </footer><!-- #colophon -->
    <div id="cv-scrollup" class="animated arrow-hide"><i class="fa fa-chevron-up"></i></div>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>