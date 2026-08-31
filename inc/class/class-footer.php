<?php
/**
 * The Site Theme Header Class 
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package the9-store
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
class the9_store_Footer_Layout{
	/**
	 * Function that is run after instantiation.
	 *
	 * @return void
	 */
	public function __construct() {
		
		add_action('the9_store_site_footer', array( $this, 'site_footer_container_before' ), 5);
		add_action('the9_store_site_footer', array( $this, 'site_footer_widgets' ), 10);
		add_action('the9_store_site_footer', array( $this, 'site_footer_info' ), 80);
		add_action('the9_store_site_footer', array( $this, 'site_footer_container_after' ), 998);
		add_action('the9_store_site_footer', array( $this, 'site_footer_back_top' ), 999);
	}
	
	/**
	* the9-store foter conteinr before
	*
	* @return $html
	*/
	public function site_footer_container_before (){
		
		$html = ' <footer id="colophon" class="site-footer">';
						
		$html = apply_filters( 'the9_store_footer_container_before_filter',$html);		
				
		echo wp_kses( $html, $this->alowed_tags() );
		
						
	}
	
	/**
	* Footer Container before
	*
	* @return $html
	*/
	function site_footer_widgets(){
		$this->site_footer_content();
	}

	/** Render WordPress-owned footer data and assigned menus. */
	private function site_footer_content() {
		$about       = get_theme_mod( 'footer_about', '' );
		$branches    = function_exists( 'the9_store_footer_branches' ) ? the9_store_footer_branches() : array();
		$has_shop    = has_nav_menu( 'footer-shop' );
		$has_info    = has_nav_menu( 'footer-information' );
		$has_brand   = has_custom_logo() || $about;

		if ( ! $has_brand && ! $has_shop && ! $has_info && ! $branches ) {
			return;
		}
		?>
		<div class="the9-store-footer-main">
			<div class="container">
				<div class="the9-store-footer-content the9-store-footer-grid">
					<?php if ( $has_brand ) : ?>
						<section class="the9-store-footer-column the9-store-footer-brand" aria-label="<?php esc_attr_e( 'Store information', 'the9-store' ); ?>">
							<?php if ( has_custom_logo() ) { the_custom_logo(); } ?>
							<?php if ( $about ) : ?><p><?php echo nl2br( esc_html( $about ) ); ?></p><?php endif; ?>
						</section>
					<?php endif; ?>

					<?php if ( $has_shop ) : ?>
						<section class="the9-store-footer-column">
							<h2><?php esc_html_e( 'Shop', 'the9-store' ); ?></h2>
							<?php wp_nav_menu( array( 'theme_location' => 'footer-shop', 'container' => false, 'depth' => 2, 'fallback_cb' => false ) ); ?>
						</section>
					<?php endif; ?>

					<?php if ( $has_info ) : ?>
						<section class="the9-store-footer-column">
							<h2><?php esc_html_e( 'Information', 'the9-store' ); ?></h2>
							<?php wp_nav_menu( array( 'theme_location' => 'footer-information', 'container' => false, 'depth' => 2, 'fallback_cb' => false ) ); ?>
						</section>
					<?php endif; ?>

					<?php if ( $branches ) : ?>
						<section class="the9-store-footer-column">
							<h2><?php esc_html_e( 'Our stores', 'the9-store' ); ?></h2>
							<?php foreach ( $branches as $branch ) : ?>
								<div class="the9-store-footer-branch">
									<?php if ( $branch['name'] ) : ?><strong><?php echo esc_html( $branch['name'] ); ?></strong><?php endif; ?>
									<?php if ( $branch['address'] ) : ?><address><?php echo nl2br( esc_html( $branch['address'] ) ); ?></address><?php endif; ?>
									<?php if ( $branch['phones'] ) : ?><div class="the9-store-footer-phones"><?php foreach ( $branch['phones'] as $phone ) : $phone_url = the9_store_phone_url( $phone ); ?><a href="<?php echo esc_url( $phone_url ); ?>"><?php echo esc_html( $phone ); ?></a><?php endforeach; ?></div><?php endif; ?>
									<?php if ( $branch['hours'] ) : ?><p class="the9-store-footer-hours"><?php echo nl2br( esc_html( $branch['hours'] ) ); ?></p><?php endif; ?>
									<?php if ( $branch['map'] ) : ?><a class="the9-store-footer-map" href="<?php echo esc_url( $branch['map'] ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'View map', 'the9-store' ); ?></a><?php endif; ?>
								</div>
							<?php endforeach; ?>
						</section>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php
	}
	
	
	/**
	* the9-store foter conteinr after
	*
	* @return $html
	*/
	public function site_footer_info (){
		$text ='';
		$html = '<div class="site_info"><div class="container">
					<div class="row">';
			$html .= '<div class="col-6">';
			
			if( get_theme_mod('copyright_text') != '' ){
				$text .= esc_html(  get_theme_mod('copyright_text') );
			}else{
				/* translators: 1: Current Year, 2: Blog Name  */
				$text .= sprintf( esc_html__( 'Copyright &copy; %1$s %2$s. All Right Reserved.', 'the9-store' ), date_i18n( _x( 'Y', 'copyright date format', 'the9-store' ) ), esc_html( get_bloginfo( 'name' ) ) );
			}
			$html  .= apply_filters( 'the9_store_footer_copywrite_filter', $text );
				
				$html .= '</div>';
			$html .= '<div class="col-6">';

			$html .= '<ul class="social-links text-end d-flex justify-content-end align-items-center" aria-label="' . esc_attr__( 'Social media', 'the9-store' ) . '">';

			if( the9_store_get_option('__fb_pro_link') != "" ):
				$html .= '<li class="social-item-facebook"><a href="'.esc_url( the9_store_get_option('__fb_pro_link') ).'" target="_blank" rel="nofollow noopener noreferrer" aria-label="Facebook"><i class="icofont-facebook" aria-hidden="true"></i></a></li>';
			endif;

			if( the9_store_get_option('__tw_pro_link') != "" ): 
				$html .= '<li class="social-item-twitter"><a href="'.esc_url( the9_store_get_option('__tw_pro_link') ).'" target="_blank" rel="nofollow noopener noreferrer" aria-label="X / Twitter"><i class="icofont-twitter" aria-hidden="true"></i></a></li>';
			endif;
			if( the9_store_get_option('__you_pro_link') != "" ): 
				$html .= '<li class="social-item-youtube"><a href="'.esc_url( the9_store_get_option('__you_pro_link') ).'" target="_blank" rel="nofollow noopener noreferrer" aria-label="YouTube"><i class="icofont-youtube" aria-hidden="true"></i></a></li>';
			 endif;
					
			$html .= '</ul>';

			$html .= '</div>';
			
		$html .= '	</div>
		  		</div>';
		
		
				
		echo wp_kses( $html, $this->alowed_tags() );
	
	}
	
	/**
	* the9-store foter conteinr after
	*
	* @return $html
	*/
	public function site_footer_container_after (){
		
		$html = '</footer>';
						
		$html = apply_filters( 'the9_store_footer_container_after_filter',$html);		
				
		echo wp_kses( $html, $this->alowed_tags() );
	
	}
	
	
	/**
	* the9-store foter conteinr after
	*
	* @return $html
	*/
	public function site_footer_back_top (){
		
			$html = '<a id="backToTop" class="ui-to-top active" href="#page" aria-label="' . esc_attr__( 'Back to top', 'the9-store' ) . '"><i class="bi bi-arrow-up-square-fill" aria-hidden="true"></i></a>';
		$html = apply_filters( 'the9_store_site_footer_back_top_filter',$html);		
				
		echo wp_kses( $html, $this->alowed_tags() );
	
	}
	
	
	
	private function alowed_tags(){
		
		if( function_exists('the9_store_alowed_tags') ){ 
			return the9_store_alowed_tags(); 
		}else{
			return array();	
		}
		
	}
}

$the9_store_footer_layout = new the9_store_Footer_Layout();
