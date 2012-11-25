<?php get_header(); ?>
  <div class="row-fluid">
    <div class="span9">
<?php if ( have_posts() ) : ?>
		    <div class="alert alert-success">
		    	<?php printf('Search Results for: %s', '<strong>' . get_search_query() . '</strong>' ); ?>
    		</div>
				<?php
				/* Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called loop-search.php and that will be used instead.
				 */
				 get_template_part( 'loop', 'search' );
				?>
<?php else : ?>
				<div class="alert alert-block">
					<button data-dismiss="alert" class="close" type="button">x</button>
			    <h4>Nothing Found</h4>
			    <p>Sorry, but nothing matched your search criteria. Please try again with some different keywords.</p>
			  </div>
			  <?php get_search_form(); ?>
<?php endif; ?>
    </div>
    <div class="span3">
      <?php get_sidebar(); ?>
    </div>
  </div>
<?php get_footer(); ?>