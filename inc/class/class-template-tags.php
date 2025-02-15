<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package the9-store
 */
class The9_Store_Post_Meta {
	/**
	 * Function that is run after instantiation.
	 *
	 * @return void
	 */
	public function __construct() {
		
		add_action( 'the9_store_do_tags', array( $this, 'render_tags_list' ) );
		add_action( 'the9_store_site_content_type', array( $this, 'render_meta_list' ), 10, 1 );
		add_action( 'the9_store_meta_info', array( $this, 'render_meta_list' ), 10, 2 );
	
	}

	/**
	 * Render meta list.
	 *
	 * @param array $order the order array. Passed through the action parameter.
	 */
	public function render_meta_list( $order, $wrp_class = '' ) {
		
		if ( ! is_array( $order ) || empty( $order ) ) {
			return;
		}

		$order  = $this->sanitize_order_array( $order );
		$markup = '';
		$markup .= '<div class="post-meta-wrap'.esc_attr( $wrp_class ).'">';
		
		$markup .= $this->get_avatar( $order );
		$markup .= '<ul class="post-meta">';
		foreach ( $order as $meta ) {
			switch ( $meta ) {
				case 'author':
					global $post;
					$author_name = get_the_author_meta( 'display_name', $post->post_author );
					$author_posts_url = get_author_posts_url( $post->post_author );
					$markup .= '<li class="post-by">';
					$markup .= ' <span>'. esc_html__( 'By - ','the9-store' ) .'</span>';
					$markup .= '<a href="' . esc_url( $author_posts_url ) . '">' . esc_html( $author_name ) . '</a>';
					$markup .= '</li>';
					break;
				case 'date':
					$markup .= '<li class="meta date posted-on">';
					$markup .= esc_html__( 'Posted on ','the9-store' );
					$markup .= $this->get_time_tags();
					$markup .= '</li>';
					break;
				case 'category':
					$markup .= '<li class="meta category">';
					$markup .= esc_html__( 'Posted in ','the9-store' );
					$markup .= get_the_category_list( ', ', get_the_ID() );
					$markup .= '</li>';
					break;
				case 'comments':
					$comments = $this->get_comments();
					if ( empty( $comments ) ) {
						break;
					}
					$markup .= '<li class="meta comments">';
					$markup .= $comments;
					$markup .= '</li>';
					break;
				default:
					break;
			}
		}
		$markup .= '</ul>';
		
		$markup .= '</div>';

		echo wp_kses( $markup, the9_store_alowed_tags() );
	}
	
	
	/**
	 * Makes sure there's a valid meta order array.
	 *
	 * @param array $order meta order array.
	 *
	 * @return mixed
	 */
	private function sanitize_order_array( $order ) {
		$allowed_order_values = array(
			'avatar',
			'author',
			'date',
			'category',
			'comments',
			
		);
		foreach ( $order as $index => $value ) {
			if ( ! in_array( $value, $allowed_order_values ) ) {
				unset( $order[ $index ] );
			}
		}

		return $order;
	}
	
	/**
	 * Get the get_avatar a link.
	 *
	 * @return string
	 */
	private function get_avatar( $order ) {
		
		if( !empty( $order ) && in_array( 'avatar',$order ) )
		return ' <div class="tb-cell avatar"><a href="'.esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ).'" class="avatar_round"> '.get_avatar( get_the_author_meta('user_email'), $size = '60').' </a></div>';
		

	}
	/**
	 * Get the comments with a link.
	 *
	 * @return string
	 */
	private function get_comments() {
		$comments_number = get_comments_number();
		if ( ! comments_open() ) {
			return '';
		}
		if ( $comments_number == 0 ) {
			return '';
		} else {
			/* translators: %s: number of comments */
			$comments = sprintf( _n( '%s Comment', '%s Comments', $comments_number, 'the9-store' ), $comments_number );
		}

		return '<a href="' . esc_url( get_comments_link() ) . '">' . esc_html( $comments ) . '</a>';
	}

	

	/**
	 * Render the tags list.
	 */
	public function render_tags_list() {
		$tags = get_the_tags();
		if ( ! is_array( $tags ) ) {
			return;
		}
		$html  = '<div class="bcf-tags-list">';
		$html .= '<span>' . esc_html__( 'Tags', 'the9-store' ) . ':</span>';
		foreach ( $tags as $tag ) {
			$tag_link = get_tag_link( $tag->term_id );
			$html    .= '<a href=' . esc_url( $tag_link ) . ' title="' . esc_attr( $tag->name ) . '" class=' . esc_attr( $tag->slug ) . ' rel="tag">';
			$html    .= esc_html( $tag->name ) . '</a>';
		}
		$html .= ' </div> ';
		echo wp_kses_post( $html );
	}

	/**
	 * Get <time> tags.
	 *
	 * @return string
	 */
	private function get_time_tags() {
		$time = '<time class="entry-date published" datetime="' . esc_attr( get_the_date( 'c' ) ) . '" content="' . esc_attr( get_the_date( 'Y-m-d' ) ) . '">' . esc_html( get_the_date() ) . '</time>';
		if ( get_the_time( 'U' ) === get_the_modified_time( 'U' ) ) {
			return $time;
		}
		$time .= '<time class="updated" datetime="' . esc_attr( get_the_modified_date( 'c' ) ) . '">' . esc_html( get_the_modified_date() ) . '</time>';

		return $time;
	}
	
	
}

$the9_store_post_meta = new The9_Store_Post_Meta();