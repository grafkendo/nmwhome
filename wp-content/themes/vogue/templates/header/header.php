<?php if ( function_exists( 'hfe_render_header' ) && get_theme_mod( 'vogue-plugin-hfelementor' ) == 1 ) :
		hfe_render_header(); ?>
<?php else : ?>
	
	<?php if ( get_theme_mod( 'vogue-header-layout' ) == 'vogue-header-layout-four' ) : ?>
	
		<?php get_template_part( '/templates/header/header-layout-four' ); ?>
	
	<?php elseif ( get_theme_mod( 'vogue-header-layout' ) == 'vogue-header-layout-three' ) : ?>
	
		<?php get_template_part( '/templates/header/header-layout-three' ); ?>
	
	<?php elseif ( get_theme_mod( 'vogue-header-layout' ) == 'vogue-header-layout-two' ) : ?>
		
		<?php get_template_part( '/templates/header/header-layout-two' ); ?>
		
	<?php else : ?>
		
		<?php get_template_part( '/templates/header/header-layout-one' ); ?>
		
	<?php endif; ?>
	
<?php endif; ?>