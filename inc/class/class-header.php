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
class The9_Store_Header_Layout{
	/**
	 * Function that is run after instantiation.
	 *
	 * @return void
	 */
	public function __construct() {

		add_action('the9_store_header_layout_1_branding', array( $this, 'get_site_branding' ), 10 );

		add_action('the9_store_mini_cart', array( $this, 'header_mini_cart' ), 10 );

		add_action('the9_store_site_header', array( $this, 'site_skip_to_content' ), 5 );

		add_action('the9_store_site_header', array( $this, 'site_header_top_bar' ), 10 );
		
		add_action('the9_store_site_header', array( $this, 'site_header_layout' ), 30 );

		add_action('the9_store_site_header', array( $this, 'get_site_navigation' ), 40 );

		add_action('the9_store_site_header', array( $this, 'site_hero_sections' ), 9999 );
	}
	/**
	* @return $html
	*/
	function site_header_top_bar(){
		if ( has_nav_menu( 'topbar' ) || !empty(the9_store_get_option('__dialogue')) ) :
			
		echo '<div class="top-bar-wrap">
		<div class="container"><div class="left-menu">';
		if( the9_store_get_option('__dialogue') ) : 
			echo '<span class="dialogue">'.esc_html( the9_store_get_option('__dialogue') ).'</span>';
		endif;
		echo '</div><div class="right-menu"><div class="top-bar-menu">';
			wp_nav_menu( array(
				'theme_location'    => 'topbar',
				'depth'             => 2,
				'menu_class'  		=> 'menu',
				'menu_id'  			=> 'menu-store',
				'container'			=> 'ul',
				'fallback_cb'       => 'the9_store_navwalker::fallback',
			) );
		echo '</div>';
		echo '</div></div>
		</div>';
		endif;
		
	}
	/**
	* @return $html
	*/
	function site_header_wrap_after(){
		
		$html = '</header>';	
		
		echo wp_kses( $html , $this->alowed_tags() );
		
	}
	/**
	* Container before
	*
	* @return $html
	*/
	function site_skip_to_content(){
		
		echo '<a class="skip-link screen-reader-text" href="#content">'. esc_html__( 'Skip to content', 'the9-store' ) .'</a>';
	}
	/**
	* Container before
	*
	* @return $html
	*/
	function site_header_layout(){
		?>
		<header id="masthead" class="site-header style_1">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-xl-3 col-lg-3 col-sm-4 col-12 text-right">
					<div class="d-flex align-items-center gap-3">
						<?php do_action('the9_store_header_layout_1_branding');?>
					</div>
				</div>
				<div class="col-xl-9 col-lg-9 col-sm-8 col-12 d-flex justify-content-end">
				<?php 
					if ( is_active_sidebar( 'logo-side' ) ) {
							dynamic_sidebar( 'logo-side' );
					}else{
			          
			            if( class_exists('APSW_Product_Search_Finale_Class') ){
			           		 do_action('apsw_search_bar_preview');
			            }else{
			            	get_search_form();
			            }
           
					}
				?>
				<?php if ( class_exists( 'WooCommerce' ) ): ?>
				<ul class="header-icon d-flex justify-content-end">
					<li>

				<?php if ( is_user_logged_in() ) { ?>
				<a class="gs-tooltip-act" href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>"><i class="icofont-user-alt-4"></i></a><span class="icon_txt"><span class="label"><?php echo esc_html__('My','the9-store');?></span> <span class="class2"><?php echo esc_html__('Account','the9-store');?></span></span>
				<?php } else { ?>
				<a class="gs-tooltip-act" href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>"><i class="icofont-user-alt-4"></i></a><span class="icon_txt"><span class="label"><?php echo esc_html__('Login','the9-store');?></span> <span class="class2"><?php echo esc_html__('Reg.','the9-store');?></span></span>
				<?php } ?>
				<?php if ( is_user_logged_in() ) { ?>
				<ul class="joyas-myaccount-endpoint">
					<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
					<li class="<?php echo esc_attr( wc_get_account_menu_item_classes( $endpoint ) ); ?>">
					<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
					</li>
					<?php endforeach; ?>
				</ul>
				<?php }?>

					</li>
				</ul>
				<?php endif;?>
			   	</div>
			</div>
		</div>
	    </header>
		<?php		
	}
	
	
	/**
	* Get the Site logo
	*
	* @return HTML
	*/
	public function get_site_branding (){
		
		$html = '<div class="logo-wrap">';
		
		if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
			$html .= get_custom_logo();
			
		}
		if ( display_header_text() == true ){
			
			$html .= '<h3><a href="'.esc_url( home_url( '/' ) ).'" rel="home" class="site-title">';
			$html .= get_bloginfo( 'name' );
			$html .= '</a></h3>';
			$description = get_bloginfo( 'description', 'display' );
		
			if ( $description ) :
			    $html .=  '<div class="site-description">'.esc_html($description).'</div>';
			endif;
		}
		
		
		$html .= '</div>';
		
		$html = apply_filters( 'get_site_branding_filter', $html );
		
		echo wp_kses( $html, $this->alowed_tags() );
		
	}
	
	/**
	* Get the Site Main Menu / Navigation
	*
	* @return HTML
	*/
	public function get_site_navigation (){
		
		?>
		<nav id="navbar" class="navbar-fill">
			<div class="container d-flex align-items-center">
				<button class="the9-store-responsive-navbar"><i class="bi bi-list"></i></button>
				<div id="aside-nav-wrapper" class="nav-wrap flex-grow-1">
				<button class="the9-store-navbar-close"><i class="bi bi-x-lg"></i></button>	
				<?php
					wp_nav_menu( array(
						'theme_location'    => 'menu-1',
						'depth'             => 3,
						'menu_class'  		=> 'the9_store-main-menu navigation-menu',
						'container'			=> 'ul',
						'walker' 			=> new the9_store_navwalker(),
				        'fallback_cb'       => 'the9_store_navwalker::fallback_2',
					) );
				?>
				</div>
				<div class="ml-auto">
					<?php do_action('the9_store_mini_cart');?>
				</div>
			</div>
		</nav>
        <?php	
		
	}


	function header_mini_cart() {
		if ( class_exists( 'WooCommerce' ) ):
	?>
    <div class="top-form-minicart box-icon-cart">
		<i class="icofont-cart"></i>
		<?php the9_store_woocommerce_cart_link();
			$instance = array(
					'title' => '',
				);
			echo '<div class="dropdown-box">';
			the_widget( 'WC_Widget_Cart', $instance );
			echo '</div>';
		 ?>
		
	</div>
	<?php
		endif;
	}

	public function get_site_breadcrumb (){
		if( function_exists('bcn_display') && ( !is_home() || !is_front_page())  ):?>
        	<div class="the9-store-breadcrumbs-wrap"><div class="container"><div class="row"><div class="col-md-12">
            <div class="the9-store-breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
                <?php bcn_display_list();?>
           </div></div></div></div>
            </div>
        <?php
		endif; 
	}
	/**
	* Get the hero sections
	*
	* @return HTML
	*/
	public function site_hero_sections(){
		if( is_404() ) return;
		if ( is_front_page() && is_active_sidebar( 'slider' ) ) : 
		 dynamic_sidebar( 'slider' );
		else: 
		$header_image = get_header_image();
		?>
        	<?php if( !empty( $header_image ) ) : ?>
            <div id="static_header_banner" class="header-img" style="background-image: url(<?php echo esc_url( $header_image );?>); background-attachment: scroll; background-size: cover; background-position: center center;">
             <?php else: ?>
             <div id="static_header_banner">
            <?php endif;?>
		    	<div class="content-text">
		            <div class="container">
		              <?php echo wp_kses( $this->hero_block_heading(), $this->alowed_tags() ); 
						 ?>
		            </div>
		        </div>
		    </div>
		<?php
		endif;
	}
	/**
	 * Add Banner Title.
	 *
	 * @since 1.0.0
	 */
	function hero_block_heading() {
		 echo '<div class="site-header-text-wrap">';
		
			if ( is_home() ) {
					echo '<h1 class="page-title-text">';
					echo bloginfo( 'name' );
					echo '</h1>';
					echo '<p class="subtitle">';
					echo esc_html(get_bloginfo( 'description', 'display' ));
					echo '</p>';
			}else if ( function_exists('is_shop') && is_shop() ){
				if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
					echo '<h1 class="page-title-text">';
					echo esc_html( woocommerce_page_title() );
					echo '</h1>';
				}
			}else if( function_exists('is_product_category') && is_product_category() ){
				echo '<h1 class="page-title-text">';
				echo esc_html( woocommerce_page_title() );
				echo '</h1>';
				echo '<p class="subtitle">';
				do_action( 'the9_store_archive_description' );
				echo '</p>';
				
			}elseif ( is_singular() ) {
				echo '<h1 class="page-title-text">';
					echo single_post_title( '', false );
				echo '</h1>';
			} elseif ( is_archive() ) {
				
				the_archive_title( '<h1 class="page-title-text">', '</h1>' );
				the_archive_description( '<p class="archive-description subtitle">', '</p>' );
				
			} elseif ( is_search() ) {
				echo '<h1 class="title">';
					printf( /* translators:straing */ esc_html__( 'Search Results for: %s', 'the9-store' ),  get_search_query() );
				echo '</h1>';
			} elseif ( is_404() ) {
				echo '<h1 class="display-1">';
					esc_html_e( 'Oops! That page can&rsquo;t be found.', 'the9-store' );
				echo '</h1>';
			}
		
		echo '</div>';
	}
	private function alowed_tags(){
		
		if( function_exists('the9_store_alowed_tags') ){ 
			return the9_store_alowed_tags(); 
		}else{
			return array();	
		}
		
	}
}



$the9_store_header_layout = new The9_Store_Header_Layout();