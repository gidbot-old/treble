<?php

/**
 *  Zero__Featured_Area
 *
 *  @author freshface
 */

class Zero__Featured_Area {

	/**
	 * @var Zero__Featured_Area
	 */
	private static $_instance = null;

	private static $_ignore_first_featured = false;
	private static $_featured_shortcode_printer = null;

	/**
	 * @return Zero__Featured_Area
	 */
	public static function getInstance() {
		if( self::$_instance == null ) {
			self::$_instance = new Zero__Featured_Area();
		}
		return self::$_instance;
	}

	public static function getFeaturedImage(){
		$media_att_id = get_post_thumbnail_id( get_the_ID() );
		if( 'image' == substr( get_post_mime_type($media_att_id) , 0, 5 ) ){
			return wp_get_attachment_url( $media_att_id );
		}else{
			return null;
		}
	}

	public static function getFeaturedImageSizes(){
		$featured_size = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
		return $featured_size
			? array( $featured_size[1], $featured_size[2] )
			: array( null, null )
			;
	}

	public static function getFeaturedAudio(){
		$featured_audio = null;
		if ( preg_match_all( '/' . get_shortcode_regex() . '/s', get_the_content(), $matches, PREG_SET_ORDER ) ) {
			foreach ( $matches as $shortcode ) {
				if ( ( 'audio' === $shortcode[2] ) or ('playlist' === $shortcode[2] ) ) {
					$featured_audio = trim( do_shortcode_tag( $shortcode ) );
					if ( $featured_audio ) {
						break;
					}
				}
			}
		}
		return $featured_audio;
	}

	public static function getFeaturedVideo(){
		$featured_video = null;
		foreach ( explode( "\n", get_the_content() ) as $key => $value) {
			$value = trim($value);
			if( empty( $value ) ) continue;
			$featured_video = wp_oembed_get( $value );
			if( ! empty($featured_video) ) break;
		}
		return Zero__Featured_Area::wrapEmbeded( $featured_video );;
	}

	public static function setIgnoreFirstFeatured( $state ){
		Zero__Featured_Area::$_ignore_first_featured = $state;
	}

	public static function setFeaturedPrinter( $printer ){
		Zero__Featured_Area::$_featured_shortcode_printer = $printer;
	}

	public static function wrapEmbeded( $html ){

		$html = str_replace('<ifr'.'ame ', '<div class="embed-responsive embed-responsive-16by9"><ifr'.'ame'."\t".'class="embed-responsive-item" ', $html);
		$html = str_replace('</ifr'.'ame>', '</ifr'.'ame ></div>', $html);

		$html = str_replace('<embed ', '<div class="embed-responsive embed-responsive-16by9"><embed'."\t".'class="embed-responsive-item" ', $html);
		$html = str_replace('</embed>', '</embed ></div>', $html);

		$html = str_replace(' src="', ' src="', $html);

		return $html;
	}

	public static function actionHijackFeaturedShortcode( $html, $attr ) {
		if( Zero__Featured_Area::$_ignore_first_featured ){
			Zero__Featured_Area::$_ignore_first_featured = false;
			return ' ';
		}

		return ( Zero__Featured_Area::$_featured_shortcode_printer )
				? call_user_func( Zero__Featured_Area::$_featured_shortcode_printer, $html, $attr )
				: Zero__Featured_Area::wrapEmbeded( $html )
				;
	}

}


