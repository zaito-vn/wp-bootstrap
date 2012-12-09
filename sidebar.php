<div id="primary" class="widget-area" role="complementary">
  <?php
	if ( ! dynamic_sidebar( 'primary-widget-area' ) ) : ?>
  <div class="widget well well-small">
    <h3 class="widget-title">Archives</h3>
    <ul>
      <?php wp_get_archives( 'type=monthly' ); ?>
    </ul>
  </div>
  <div class="widget well well-small">
    <h3 class="widget-title">Meta</h3>
    <ul>
      <?php wp_register(); ?>
      <li><?php wp_loginout(); ?></li>
      <?php wp_meta(); ?>
    </ul>
  </div>
  <?php endif; // end primary widget area ?>
</div>
<!-- #primary .widget-area -->

<?php
// A second sidebar for widgets, just because.
if ( is_active_sidebar( 'secondary-widget-area' ) ) :
dynamic_sidebar( 'secondary-widget-area' );
endif;
