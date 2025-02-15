<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package the9-store
 */
get_header();
/**
* Hook - the9_store_container_wrap_start 	
*
* @hooked the9_store_container_wrap_start	- 5
*/

 do_action( 'the9_store_container_wrap_start','no-sidebar');
		if ( have_posts() ) : 
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		
/**
* Hook - the9_store_container_wrap_end	
*
* @hooked container_wrap_end - 999
*/
do_action( 'the9_store_container_wrap_end','no-sidebar');
get_footer();
