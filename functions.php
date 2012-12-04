<?php
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
			'before_widget' => '<div id="%1$s" class="well well-small clearfix %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
	) );

	// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
	register_sidebar( array(
			'name' => 'Secondary Widget Area',
			'id' => 'secondary-widget-area',
			'description' => 'The secondary widget area',
			'before_widget' => '<div id="%1$s" class="well well-small clearfix %2$s">',
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