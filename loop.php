<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if ( ! have_posts() ) : ?>
	<div class="alert alert-block">
		<button data-dismiss="alert" class="close" type="button">x</button>
    <h4>Not Found!</h4>
    <p>Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.</p>
  </div>
<?php endif; ?>

<?php while ( have_posts() ) : the_post(); ?>
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="page-header">
			<h1 class="post-title">
				<a href="<?php the_permalink(); ?>" title="<?php printf('Permalink to %s', the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a><br>
				<small><?php echo get_the_date(); ?></small>
				<a href="#collapse-<?php the_ID(); ?>" class="pull-right" data-toggle="collapse"><i class="icon-chevron-down"></i></a>
			</h1>
		</div>
		<div class="post-content collapse in" id="collapse-<?php the_ID(); ?>">
<?php if ( is_archive() || is_search() ) : // Only display excerpts for archives and search. ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
<?php else : ?>
		<div class="entry-content">
			<?php the_content('Continue reading <span class="meta-nav">&rarr;</span>'); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link">' . 'Pages:', 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
<?php endif; ?>

		<div class="entry-utility">
			<?php if ( count( get_the_category() ) ) : ?>
				<span class="cat-links">
					<span>Categorized: </span>
					<?php
						$categories = get_the_category();
						foreach ( $categories as $category ) {
							printf('<a class="label label-important" href="' . esc_url( get_category_link( $category->term_id ) ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" ' . $rel . '>' . $category->name.'</a> ');
						}
					?>
				</span>
				<span class="meta-sep">|</span>
			<?php endif; ?>
			<?php
				$terms = get_the_terms(false, 'post_tag');
				if ( !empty( $terms ) ):
			?>
				<span class="tag-links">
					<span>Tagged: </span>
					<?php
						foreach ( $terms as $term ) {
							$link = get_term_link( $term, $taxonomy );
							if ( is_wp_error( $link ) )
								return $link;
							printf('<a class="label label-info" href="' . esc_url( $link ) . '" rel="tag">' . $term->name . '</a> ');
						}
					?>
				</span>
				<span class="meta-sep">|</span>
			<?php endif; ?>
			<span class="comments-link"><?php comments_popup_link('<i class="icon-comment"></i> Leave a comment', '1 Comment', '<i class="icon-comment"></i> % Comments'); ?></span>
			<?php edit_post_link('<i class="icon-edit"></i> Edit', ' | '); ?>
		</div><!-- .entry-utility -->
		</div>
	</div><!-- #post-## -->

	<?php comments_template( '', true ); ?>

	<?php endwhile; // End the loop. Whew. ?>

<?php if (  $wp_query->max_num_pages > 1 ) : ?>
	<div class="well well-small">
		<div class="nav-previous pull-left"><?php next_posts_link('&larr; Older posts'); ?></div>
		<div class="nav-next pull-right"><?php previous_posts_link('Newer posts &rarr;'); ?></div>
	</div><!-- #nav-below -->
<?php endif; ?>
