<?php
/**
 * Replaces "[...]"
 */
function bootstrap_excerpt_more($more) {
	return ' ...<div><a href="' . get_permalink() . '">' . __('Xem tiếp &#8250;', 'wp-bootstrap') . '</a></div>';
}

add_filter('excerpt_more', 'bootstrap_excerpt_more');

function breadcrumb_lists () {

	$chevron = '<span class="divider">/</span>';
	$before = '<span class="active">'; // tag before the current crumb
	$after = '</span>'; // tag after the current crumb

	if ( !is_home() && !is_front_page() || is_paged() ) {

		echo '<div class="breadcrumb">';

		global $post;
		$homeLink = home_url();
		echo '<a href="' . $homeLink . '">Home</a> ' . $chevron . ' ';

		if ( is_category() ) {
			global $wp_query;
			$cat_obj = $wp_query->get_queried_object();
			$thisCat = $cat_obj->term_id;
			$thisCat = get_category($thisCat);
			$parentCat = get_category($thisCat->parent);
			if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $chevron . ' '));
			echo $before; printf('Archive for %s', single_cat_title('', false) ); $after;

		} elseif ( is_day() ) {
			echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $chevron . ' ';
			echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $chevron . ' ';
			echo $before . get_the_time('d') . $after;

		} elseif ( is_month() ) {
			echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $chevron . ' ';
			echo $before . get_the_time('F') . $after;

		} elseif ( is_year() ) {
			echo $before . get_the_time('Y') . $after;

		} elseif ( is_single() && !is_attachment() ) {
			if ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $chevron . ' ';
				echo $before . get_the_title() . $after;
			} else {
				$cat = get_the_category(); $cat = $cat[0];
				echo get_category_parents($cat, TRUE, ' ' . $chevron . ' ');
				echo $before . get_the_title() . $after;
			}

		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
			$post_type = get_post_type_object(get_post_type());
			echo $before . $post_type->labels->singular_name . $after;

		} elseif ( is_attachment() ) {
			$parent = get_post($post->post_parent);
			$cat = get_the_category($parent->ID); $cat = $cat[0];
			echo get_category_parents($cat, TRUE, ' ' . $chevron . ' ');
			echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $chevron . ' ';
			echo $before . get_the_title() . $after;

		} elseif ( is_page() && !$post->post_parent ) {
			echo $before . get_the_title() . $after;

		} elseif ( is_page() && $post->post_parent ) {
			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
				$page = get_page($parent_id);
				$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
				$parent_id  = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $chevron . ' ';
			echo $before . get_the_title() . $after;

		} elseif ( is_search() ) {
			echo $before; printf('Search results for: %s', get_search_query() ); $after;

		} elseif ( is_tag() ) {
			echo $before; printf('Posts tagged %s', single_tag_title('', false) ); $after;

		} elseif ( is_author() ) {
			global $author;
			$userdata = get_userdata($author);
			echo $before; printf('View all posts by %s', $userdata->display_name ); $after;

		} elseif ( is_404() ) {
			echo $before . 'Error 404 ' . $after;
		}

		if ( get_query_var('paged') ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
			echo 'Page ' . get_query_var('paged');
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
		}

		echo '</div>';

	}
}

if ( ! function_exists( 'bootstrap_posted_on' ) ) :

/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function bootstrap_posted_on() {
	printf(get_the_date());
}
endif;

/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override bootstrap_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 */
function bootstrap_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
			'name' => 'Primary Widget Area',
			'id' => 'primary-widget-area',
			'description' => 'The primary widget area',
			'before_widget' => '<div id="%1$s" class="widget well well-small clearfix %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
	) );

	// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
	register_sidebar( array(
			'name' => 'Secondary Widget Area',
			'id' => 'secondary-widget-area',
			'description' => 'The secondary widget area',
			'before_widget' => '<div id="%1$s" class="widget well well-small clearfix %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
	) );
}
/** Register sidebars by running bootstrap_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'bootstrap_widgets_init' );

if ( ! function_exists( 'bootstrap_list_comments' ) ) :

/**
 * Prints HTML with meta information for the current post-date/time and author.
*/
function bootstrap_list_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
?>
<li class="media">
	<a class="pull-left" href="#"><?php echo get_avatar( $comment, 64 ); ?></a>
  <div class="media-body">
    <div class="media-heading"><strong><?php printf(get_comment_author_link()); ?></strong> said on <?php printf( '%1$s at %2$s', get_comment_date(), get_comment_time()); edit_comment_link('<i class="icon-edit"></i> Edit', ' | '); ?></div>
    <?php
    comment_text();
    comment_reply_link( array_merge( $args, array(
    		'reply_text'	=>	__( 'Reply <span>&darr;</span>', 'the-bootstrap' ),
    		'depth'			=>	$depth,
    		'max_depth'		=>	$args['max_depth']
					) ) ); ?>
  </div>
</li>
<?php
}
endif;