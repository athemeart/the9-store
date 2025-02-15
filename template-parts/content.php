<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package the9-store
 */

?>

<article data-aos="fade-up" id="post-<?php the_ID(); ?>" <?php post_class( array('the9-store-post') ); ?>>

 	 <?php
    /**
    * Hook - the9_store_posts_blog_media.
    *
    * @hooked the9_store_posts_formats_thumbnail - 10
    */
    do_action( 'the9_store_posts_blog_media' );
    ?>
    <div class="post">
               
		<?php
        /**
        * Hook - the9-store_site_content_type.
        *
		* @hooked site_loop_heading - 10
        * @hooked render_meta_list	- 20
		* @hooked site_content_type - 30
        */
		
		$meta = array();
		
		if ( !is_singular() ) :

			if( the9_store_get_option('blog_meta_hide') != true ){
				
				$meta = array( 'author', 'date', 'category', 'comments' );
			}
			$meta  	 = apply_filters( 'the9_store_blog_meta', $meta );
		 endif;
	
		
		 do_action( 'the9_store_site_content_type', $meta );
        ?>
      
       
    </div>
    <div class="clearfix"></div>
</article><!-- #post-<?php the_ID(); ?> -->
