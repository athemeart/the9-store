<?php
/**
 * Template Name: Homepage Canvas
 *
 * @package the9-store
 * @subpackage the9-store
 * @since the9-store 1.0.0
 * @version 1.0.0
 */
get_header();

$layout = 'full-container';
?>
<div class="container"><div class="row"><div class="col-md-12">
<?php 
	while ( have_posts() ) :
		the_post();
	the_content();

	endwhile; // End of the loop.
?>
</div></div></div>
<?php		
get_footer();