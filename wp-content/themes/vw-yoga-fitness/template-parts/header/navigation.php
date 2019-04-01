<?php
/**
 * The template part for header
 *
 * @package VW Yoga Fitness 
 * @subpackage vw_yoga_fitness
 * @since VW Yoga Fitness 1.0
 */
?>

<div class="toggle"><a class="toggleMenu" href="#"><?php esc_html_e('Menu','vw-yoga-fitness'); ?></a></div>
<div id="header" class="menubar">
	<div class="nav">
		<?php wp_nav_menu( array('theme_location'  => 'primary') ); ?>
	</div>
</div>