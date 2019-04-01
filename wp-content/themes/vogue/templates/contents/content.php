<?php
/**
 * @package Vogue
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="blog-post-inner <?php echo ( get_theme_mod( 'vogue-blog-img-shape' ) == 'blog-img-shape-round' ) ? sanitize_html_class( 'blog-post-img-round' ) : ''; ?>">
		
		<?php if ( has_post_thumbnail() ) :
			$vogue_image_cut = customizer_library_get_default( 'vogue-blog-list-img-cut' );
			if ( get_theme_mod( 'vogue-blog-list-img-cut' ) ) {
				$vogue_image_cut = get_theme_mod( 'vogue-blog-list-img-cut' );
			} ?>
		
			<?php if ( get_theme_mod( 'vogue-blog-img-shape' ) == 'blog-img-shape-square' || get_theme_mod( 'vogue-blog-img-shape' ) == 'blog-img-shape-round' ) : ?>
				<a href="<?php the_permalink() ?>" class="post-loop-thumbnail post-loop-thumbnail-img" <?php echo 'style="background-image: url(' . esc_url( get_the_post_thumbnail_url( $post->ID, $vogue_image_cut ) ) . ');"'; ?>>
					<img src="<?php echo get_template_directory_uri(); ?>/images/blank_blocks_img.png" alt="<?php the_title(); ?>" />
				</a>
			<?php else : ?>
				<a href="<?php the_permalink() ?>" class="post-loop-thumbnail">
					<?php the_post_thumbnail( $vogue_image_cut ); ?>
				</a>
			<?php endif; ?>
			
		<?php endif; ?>
		
		<div class="post-loop-content">
			
			<header class="entry-header">
				<?php
				$post_title_tag = get_theme_mod( 'vogue-seo-blog-post-title-tag', customizer_library_get_default( 'vogue-seo-blog-post-title-tag' ) );
				the_title( sprintf( '<h'.esc_attr( $post_title_tag ).' class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h'.esc_attr( $post_title_tag ).'>' ); ?>

				<?php if ( 'post' == get_post_type() ) : ?>
				<div class="entry-meta">
					<?php vogue_posted_on(); ?>
				</div><!-- .entry-meta -->
				<?php endif; ?>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php
				if ( has_excerpt() ) :
					the_excerpt();
				else :
					/* translators: %s: Name of current post */
					the_content( sprintf(
						wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'vogue' ), array( 'span' => array( 'class' => array() ) ) ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					) );
				endif;
				?>

				<?php
					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'vogue' ),
						'after'  => '</div>',
					) );
				?>
			</div><!-- .entry-content -->

			<footer class="entry-footer">
				<?php vogue_entry_footer(); ?>
			</footer><!-- .entry-footer -->
			
		</div>
		<div class="clearboth"></div>
	
	</div>
	
</article><!-- #post-## -->