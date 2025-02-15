<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package the9-store
 */

get_header();
?>

<section class="error-404 not-found8">
 
    <div class="page-content">
    
         <h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'the9-store' ); ?></h1>
         <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'the9-store' ); ?></p>
         <?php get_search_form();?>
        
     
        <div class="clearfix"></div>
        <!-- .widget -->

    </div><!-- .page-content -->
</section>
<?php
get_footer();
