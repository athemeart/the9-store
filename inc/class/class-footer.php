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
		if ( is_active_sidebar( 'footer-1' ) ) { ?>
         <div class="footer_widget_wrap">
         <div class="container">
            <div class="row the9-store-flex">
                <?php dynamic_sidebar( 'footer-1' ); ?>
            </div>
         </div>  
         </div>
        <?php }
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
				
			/* translators: 1: developer website, 2: WordPress url  */
			$html  .= '<small class="dev_info">'.sprintf( esc_html__( ' %1$s theme by aThemeArt - Proudly powered by %2$s .', 'the9-store' ), '<a href="'. esc_url( 'https://athemeart.com/' ) .'" target="_blank">'.esc_html_x( 'The9 Store', 'credit - theme', 'the9-store' ).'</a>',  '<a  href="'.esc_url( __( 'https://wordpress.org', 'the9-store' ) ).'" target="_blank" rel="nofollow">'.esc_html_x( 'WordPress', 'credit to cms', 'the9-store' ).'</a>' ).'</small>';
			
			$html .= '</div>';
			$html .= '<div class="col-6">';

			$html .= '<ul class="social-links text-end d-flex justify-content-end align-items-center">';

			if( the9_store_get_option('__fb_pro_link') != "" ): 
				$html .= '<li class="social-item-facebook"><a href="'.esc_url( the9_store_get_option('__fb_pro_link') ).'" target="_blank" rel="nofollow"><i class="icofont-facebook"></i></a></li>';				
			endif;

			if( the9_store_get_option('__tw_pro_link') != "" ): 
				$html .= '<li class="social-item-twitter"><a href="'.esc_url( the9_store_get_option('__tw_pro_link') ).'" target="_blank" rel="nofollow"><i class="icofont-twitter"></i></a></li>';
			endif;
			if( the9_store_get_option('__you_pro_link') != "" ): 
				$html .= '<li class="social-item-youtube"><a href="'.esc_url( the9_store_get_option('__you_pro_link') ).'" target="_blank" rel="nofollow"><i class="icofont-youtube"></i></a></li>';
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
		
		$html = '<a id="backToTop" class="ui-to-top active"><i class="icofont-bubble-up"></i></a>';
						
		$html = '<a id="backToTop" class="ui-to-top active"><i class="bi bi-arrow-up-square-fill"></i></a>';				
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