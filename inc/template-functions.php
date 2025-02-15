<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package the9-store
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function the9_store_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'the9_store_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function the9_store_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'the9_store_pingback_header' );

if ( ! function_exists( 'the9_store_alowed_tags' ) ) :
	/**
	 * @see the9-store_alowed_tags().
	 */
function the9_store_alowed_tags() {
	
	
	$wp_post_allow_tag = wp_kses_allowed_html( 'post' );
	
	$allowed_tags = array(
		'a' => array(
			'class' => array(),
			'href'  => array(),
			'rel'   => array(),
			'title' => array(),
			'id'	=> array(),
			'target'=> array(),
		),
		'abbr' => array(
			'title' => array(),
		),
		'b' => array(),
		'blockquote' => array(
			'cite'  => array(),
		),
		'cite' => array(
			'title' => array(),
		),
		'code' => array(),
		'del' => array(
			'datetime' => array(),
			'title' => array(),
		),
		'dd' => array(),
		'div' => array(
			'class' => array(),
			'title' => array(),
			'style' => array(),
			'id' => array(),
			'data-aos' => array(),
		),
		'dl' => array( 
			'class' => array(),
			'style' => array(),
			'id' => array(),
		),
		'dt' => array(
			'class' => array(),
			'style' => array(),
			'id' => array(),
		),
		'em' => array(
			'class' => array(),
			'style' => array(),
			'id' => array(),
		),
		'h1' => array(
			'class' => array(),
			'title' => array(),
			'style' => array(),
			'id' => array(),
		
		),
		'h2' => array(
			'class' => array(),
			'style' => array(),
			'id' => array(),
		
		),
		'h3' => array(
			'class' => array(),
			'style' => array(),
			'id' => array(),
		),
		'h4' => array(
			'class' => array(),
			'style' => array(),
			'id' => array(),
		),
		'h5' => array(
			'class' => array(),
			'style' => array(),
			'id' => array(),
		),
		'h6' => array(
			'class' => array(),
			'style' => array(),
			'id' => array(),
		),
		'i' => array(
			'class' => array(),
			'style' => array(),
			'id' => array(),
		),
		'img' => array(
			'alt'    => array(),
			'class'  => array(),
			'height' => array(),
			'src'    => array(),
			'width'  => array(),
		),
		'li' => array(
			'class' => array(),
			'style' => array(),
			'id' => array(),
		),
		'i' => array(
			'class' => array(),
			'style' => array(),
			'id' => array(),
		),
		'ol' => array(
			'class' => array(),
			'style' => array(),
			'id' => array(),
		),
		'p' => array(
			'class' => array(),
			'style' => array(),
			'id' => array(),
		),
		'q' => array(
			'cite' => array(),
			'title' => array(),
		),
		'span' => array(
			'class' => array(),
			'style' => array(),
			'id' => array(),
		),
		'strike' => array(),
		'strong' => array(),
		'ul' => array(
			'class' => array(),
			'style' => array(),
			'id' => array(),
		),
		'iframe' => array(
			'src'             => array(),
			'height'          => array(),
			'width'           => array(),
			'frameborder'     => array(),
			'allowfullscreen' => array(),
		),
		'time' => array(
			'class' => array(),
			'title' => array(),
			'style' => array(),
			'datetime' => array(),
			'content' => array(),
		),
		'main' => array(
			'class' => array(),
			'id' => array(),
			'style' => array(),
			
		),
	);

	
	$tags = array_merge( $wp_post_allow_tag, $allowed_tags );

	return apply_filters( 'the9_store_alowed_tags', $tags );
	
}
endif;



if ( ! function_exists( 'the9_store_walker_comment' ) ) : 
	/**
	 * Implement Custom Comment template.
	 *
	 * @since 1.0.0
	 *
	 * @param $comment, $args, $depth
	 * @return $html
	 */
	  
	function the9_store_walker_comment($comment, $args, $depth) {
		if ( 'div' === $args['style'] ) {
			$tag       = 'div';
			$add_below = 'comment';
		} else {
			$tag       = 'li';
			$add_below = 'div-comment';
		}
		?>
		<li <?php comment_class( empty( $args['has_children'] ) ? 'comment shift' : 'comment' ) ?> id="comment-<?php comment_ID() ?>">
           <div class="single-comment clearfix">
				 <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, 80,'','', array('class' => 'float-left') ); ?>
                <div class="comment float-left">
                    <h6><?php echo get_comment_author_link();?></h6>
                    <div class="date"> 
                        <?php
                            /* translators: 1: date, 2: time */
                            printf( esc_html__('%1$s at %2$s', 'the9-store' ), esc_html( get_comment_date() ),  esc_html( get_comment_time()) ); 
                        ?>
                    </div>
                    
                    <div class="reply"> <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></div>
                            
                   
                    <div class="comment-text"><?php comment_text(); ?></div>
                </div>
            </div>
			<div class="clearfix"></div>
	   </li>
       <?php
	}
	
	
endif;



class the9_store_navwalker extends Walker_Nav_Menu {

		// Start element adds the icon for items with children
	    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
	        $classes = empty($item->classes) ? array() : (array) $item->classes;
	        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
	        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

	        $output .= '<li' . $class_names . '>';

	        $atts = array();
	        $atts['title']  = ! empty($item->title)   ? $item->title   : '';
	        $atts['target'] = ! empty($item->target)  ? $item->target  : '';
	        $atts['rel']    = ! empty($item->xfn)     ? $item->xfn     : '';
	        $atts['href']   = ! empty($item->url)     ? $item->url     : '';

	        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);

	        $attributes = '';
	        foreach ($atts as $attr => $value) {
	            if (! empty($value)) {
	                $value = esc_attr($value);
	                $attributes .= ' ' . $attr . '="' . $value . '"';
	            }
	        }

	        $item_output = $args->before;
	        $item_output .= '<a'. $attributes .'>';
	        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
	        $item_output .= '</a>';
	        // Add icon for dropdown items
	        if (in_array('menu-item-has-children', $classes)) {
	            $item_output .= '<button class="responsive-submenu-toggle bi bi-caret-down-fill"></button>'; // Adjust icon class as needed
	        }
	        $item_output .= $args->after;

	        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
	    }
		
		/**
		 * Menu Fallback
		 * =============
		 * If this function is assigned to the wp_nav_menu's fallback_cb variable
		 * and a menu has not been assigned to the theme location in the WordPress
		 * menu manager the function with display nothing to a non-logged in user,
		 * and will add a link to the WordPress menu manager if logged in as an admin.
		 *
		 * @param array $args passed from the wp_nav_menu function.
		 */
		public static function fallback( $args ) {
			if ( current_user_can( 'edit_theme_options' ) ) {

				echo '<ul>';
				echo '<li><a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '" title="">' . esc_html__( 'Add a menu', 'the9-store' ) . '</a></li>';
				echo '</ul>';
				
			}
		}
	
}

if( !function_exists('the9_store_elementor_editor_simplify') ){
	
	function the9_store_elementor_editor_simplify(){
		
		add_action( 'wp_head', function () {
				echo '<style type="text/css">
				#elementor-panel-category-pro-elements,
				#elementor-panel-category-theme-elements,
				#elementor-panel-category-woocommerce-elements,
				#elementor-panel-get-pro-elements{
					display:none!important;	
				}
				</style>';
			}  );
		
	}
	add_action( 'elementor/editor/init', 'the9_store_elementor_editor_simplify');

}