<?php get_header(); ?>
<?php remove_filter ('the_content', 'wpautop'); ?>
  <div class="row-fluid">
    <div class="span9">
			<?php
			/* Run the loop to output the posts.
			 * If you want to overload this in a child theme then include a file
			 * called loop-index.php and that will be used instead.
			 */
			 get_template_part( 'loop', 'index' );
			?>
    </div>
    <div class="span3">
      <?php get_sidebar(); ?>
    </div>
  </div>
<?php get_footer(); ?>