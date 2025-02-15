<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package the9-store
 */

?>

	</div><!-- #content -->

	<?php
	/**
	* Hook - the9_store_site_footer
	*
	* @hooked the9_store_container_wrap_start
	*/
	do_action( 'the9_store_site_footer');
	?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
