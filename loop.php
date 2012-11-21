<?php
/**
 * The loop that displays posts.
 *
 * The loop displays the posts and the post content. See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop.php or
 * loop-template.php, where 'template' is the loop context
 * requested by a template. For example, loop-index.php would
 * be used if it exists and we ask for the loop with:
 * <code>get_template_part( 'loop', 'index' );</code>
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>

<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if ( ! have_posts() ) : ?>
	<div class="alert alert-block">
		<button data-dismiss="alert" class="close" type="button">x</button>
    <h4>Not Found!</h4>
    <p>Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.</p>
  </div>
<?php endif; ?>

<?php
	/* Start the Loop.
	 *
	 * In Twenty Ten we use the same loop in multiple contexts.
	 * It is broken into three main parts: when we're displaying
	 * posts that are in the gallery category, when we're displaying
	 * posts in the asides category, and finally all other posts.
	 *
	 * Additionally, we sometimes check for whether we are on an
	 * archive page, a search page, etc., allowing for small differences
	 * in the loop on each template without actually duplicating
	 * the rest of the loop that is shared.
	 *
	 * Without further ado, the loop:
	 */ ?>
<?php while ( have_posts() ) : the_post(); ?>
<div class="well well-small">
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="entry-meta">
			<?php echo get_the_date(); ?>
		</div><!-- .entry-meta -->

		<h3 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php printf('Permalink to %s', the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>

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
			<span class="comments-link"><?php comments_popup_link('Leave a comment', '1 Comment', '% Comments'); ?></span>
			<?php edit_post_link('Edit', '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
		</div><!-- .entry-utility -->
	</div><!-- #post-## -->

	<?php comments_template( '', true ); ?>
</div>
<?php endwhile; // End the loop. Whew. ?>

<?php if (  $wp_query->max_num_pages > 1 ) : ?>
	<div class="well well-small">
		<div class="nav-previous pull-left"><?php next_posts_link('&larr; Older posts'); ?></div>
		<div class="nav-next pull-right"><?php previous_posts_link('Newer posts &rarr;'); ?></div>
	</div><!-- #nav-below -->
<?php endif; ?>
