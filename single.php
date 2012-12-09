<?php get_header(); ?>
  <div class="row-fluid">
    <div class="span9">
			<?php
			 get_template_part( 'loop', 'single' );
			?>
    </div>
    <div class="span3">
      <?php get_sidebar(); ?>
    </div>
  </div>
<?php get_footer(); ?>