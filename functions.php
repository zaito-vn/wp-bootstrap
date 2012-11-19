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
			'before_widget' => '<div id="%1$s" class="well well-small %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
	) );

	// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
	register_sidebar( array(
			'name' => 'Secondary Widget Area',
			'id' => 'secondary-widget-area',
			'description' => 'The secondary widget area',
			'before_widget' => '<div id="%1$s" class="well well-small %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
	) );
}
/** Register sidebars by running bootstrap_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'bootstrap_widgets_init' );