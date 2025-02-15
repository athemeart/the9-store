<?php

/*Add theme menu page*/
 
add_action('admin_menu', 'the9_store_admin_menu');

function the9_store_admin_menu() {
	
	$the9_store_page_title = esc_html__("Learn More The9 Store",'the9-store');
	
	$the9_store_menu_title = esc_html__("Learn More The9 Store",'the9-store');
	
	add_theme_page($the9_store_page_title, $the9_store_menu_title, 'edit_theme_options', 'the9_store_theme_info', 'the9_store_theme_info_page');
}

/*
**
** Premium Theme Feature Page
**
*/

function the9_store_theme_info_page(){
	if ( is_admin() ) {
		get_template_part('/inc/premium-screen/index');
		
	} 
}

function the9_store_admin_script($the9_store_hook){
	
	if($the9_store_hook != 'appearance_page_the9_store_theme_info') {
		return;
	} 
	wp_enqueue_style( 'the9_store-custom-css', get_template_directory_uri() .'/inc/premium-screen/pro-custom.css',array(),'1.0' );

}

add_action( 'admin_enqueue_scripts', 'the9_store_admin_script' );



if ( ! class_exists( 'the9_store_Admin' ) ) :

/**
 * the9_store_Admin Class.
 */
class the9_store_Admin {

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'wp_loaded', array( __CLASS__, 'hide_notices' ) );
		add_action( 'load-themes.php', array( $this, 'admin_notice' ) );
	}

	/**
	 * Add admin notice.
	 */
	public function admin_notice() {
		global $the9_store_pagenow;

		wp_enqueue_style( 'the9_store-message', get_template_directory_uri() . '/inc/premium-screen/message.css', array(), '1.0' );

		// Let's bail on theme activation.
		if ( 'themes.php' == $the9_store_pagenow && isset( $_GET['activated'] ) ) {
			add_action( 'admin_notices', array( $this, 'welcome_notice' ) );
			update_option( 'the9_store_admin_notice_welcome', 1 );

		// No option? Let run the notice wizard again..
		} elseif( ! get_option( 'the9_store_admin_notice_welcome' ) ) {
			add_action( 'admin_notices', array( $this, 'welcome_notice' ) );
		}
	}

	/**
	 * Hide a notice if the GET variable is set.
	 */
	public static function hide_notices() {
		if ( !empty( $_GET['the9_store-hide-notice'] ) && !empty( $_GET['_the9_store_notice_nonce'] ) ) {
			if ( ! wp_verify_nonce( wp_unslash($_GET['_the9_store_notice_nonce']), 'the9_store_hide_notices_nonce' ) ) {
				/* translators: %s: plugin name. */
				wp_die( esc_html__( 'Action failed. Please refresh the page and retry.', 'the9-store' ) );
			}

			if ( ! current_user_can( 'manage_options' ) ) 
			/* translators: %s: plugin name. */{
				wp_die( esc_html__( 'Cheatin&#8217; huh?', 'the9-store' ) );
			}

			$hide_notice = sanitize_text_field( wp_unslash( $_GET['the9_store-hide-notice'] ) );
			update_option( 'the9_store_admin_notice_' . $hide_notice, 1 );
		}
	}

	/**
	 * Show welcome notice.
	 */
	public function welcome_notice() {
		?>
		<div id="message" class="updated cresta-message">
        
			<a class="cresta-message-close notice-dismiss" href="<?php echo esc_url( wp_nonce_url( remove_query_arg( array( 'activated' ), add_query_arg( 'the9_store-hide-notice', 'welcome' ) ), 'the9_store_hide_notices_nonce', '_the9_store_notice_nonce' ) ); ?>"><?php  /* translators: %s: plugin name. */ esc_html_e( 'Dismiss', 'the9-store' ); ?></a>
            
			<p><?php printf( /* translators: %s: plugin name. */  esc_html__( 'Welcome! Thank you for choosing The9 Store! To fully take advantage of the best our theme can offer please make sure you visit our %1$sLearn more page%2$s.', 'the9-store' ), '<a href="' . esc_url( admin_url( 'themes.php?page=the9_store_theme_info' ) ) . '">', '</a>' ); ?></p>
			<p class="submit">
				<a class="button-secondary" href="<?php echo esc_url( admin_url( 'themes.php?page=tgmpa-install-plugins' ) ); ?>"><?php esc_html_e( 'Install Recommended Plugins', 'the9-store' ); ?></a>
			</p>
		</div>
		<?php
	}



	

	
}

endif;

return new the9_store_Admin();




