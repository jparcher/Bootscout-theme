<?php
/*
 * Setup
 */

if ( ! function_exists('b4st_setup') ) {
	function b4st_setup() {

		add_theme_support( 'editor-styles' );
		add_editor_style('theme/css/editor.css');

		// Gutenberg
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'align-wide' );

		// Theme
		add_theme_support('title-tag');
		add_theme_support('post-thumbnails');

		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => __( 'Small', 'b4st' ),
					'shortName' => __( 'S', 'b4st' ),
					'size'      => 14,
					'slug'      => 'small',
				),
				array(
					'name'      => __( 'Normal', 'b4st' ),
					'shortName' => __( 'M', 'b4st' ),
					'size'      => 16,
					'slug'      => 'normal',
				),
				array(
					'name'      => __( 'Large', 'b4st' ),
					'shortName' => __( 'L', 'b4st' ),
					'size'      => 22,
					'slug'      => 'large',
				),
				array(
					'name'      => __( 'Huge', 'b4st' ),
					'shortName' => __( 'XL', 'b4st' ),
					'size'      => 28,
					'slug'      => 'huge',
				),
			)
		);

		update_option('thumbnail_size_w', 285); /* internal max-width of col-3 */
		update_option('small_size_w', 350); /* internal max-width of col-4 */
		update_option('medium_size_w', 730); /* internal max-width of col-8 */
		update_option('large_size_w', 1110); /* internal max-width of col-12 */

		if ( ! isset($content_width) ) {
			$content_width = 1100;
		}

		add_theme_support( 'post-formats', array(
			'aside',
			'gallery',
			'link',
			'image',
			'quote',
			'status',
			'video',
			'audio',
			'chat'
		) );

		add_theme_support('automatic-feed-links');

		add_theme_support( 'custom-logo', array(
			'height'      => 142,
			'width'       => 312,
			'flex-height' => true,
			'flex-width'  => true,
			'header-text' => array( 'site-title', 'site-description' ),
		) );
	}
}
add_action('init', 'b4st_setup');

if ( ! function_exists( 'b4st_avatar_attributes' ) ) {
	function b4st_avatar_attributes($avatar_attributes) {
		$display_name = get_the_author_meta( 'display_name' );
		$avatar_attributes = str_replace('alt=\'\'', 'alt=\'Avatar for '.$display_name.'\' title=\'Gravatar for '.$display_name.'\'',$avatar_attributes);
		return $avatar_attributes;
	}
}
add_filter('get_avatar','b4st_avatar_attributes');

if ( ! function_exists( 'b4st_author_avatar' ) ) {
	function b4st_author_avatar() {

		echo get_avatar('', $size = '96');
	}
}

if ( ! function_exists( 'b4st_author_description' ) ) {
	function b4st_author_description() {
		echo get_the_author_meta('user_description');
	}
}

if ( ! function_exists( 'b4st_post_date' ) ) {
	function b4st_post_date() {
		if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';

			if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
				$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time> <time class="updated" datetime="%3$s">(updated %4$s)</time>';
			}

			$time_string = sprintf( $time_string,
				esc_attr( get_the_date( 'c' ) ),
				get_the_date(),
				esc_attr( get_the_modified_date( 'c' ) ),
				get_the_modified_date()
			);

			echo $time_string;
		}
	}
}

//edit theme-options
$options = get_option('scout_theme_options');
