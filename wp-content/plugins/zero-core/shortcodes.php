<?php

// Logo Shortcode
function logo_shortcode( $atts , $content = null ) {

	$query = ffThemeOptions::getQuery('header');

	if ( $query->getImage('logo-img-light-desktop')->url ){
		$logoImgUrlDesktopLight = $query->getImage('logo-img-light-desktop')->url;
	}
	if ( empty($logoImgUrlDesktopLight) ){
		$logoImgUrlDesktopLight = get_template_directory_uri() . '/templates/sections/header-1/images/logo-desktop-light@2x.png';
	}

	if ( $query->getImage('logo-img-dark-desktop')->url ){
		$logoImgUrlDesktopDark = $query->getImage('logo-img-dark-desktop')->url;
	}
	if ( empty($logoImgUrlDesktopDark) ){
		$logoImgUrlDesktopDark = get_template_directory_uri() . '/templates/sections/header-1/images/logo-desktop-dark@2x.png';
	}

	$imageDimensions = ffContainer()
		->getGraphicFactory()
		->getImageInformator( $logoImgUrlDesktopLight )
		->getImageDimensions();

	if( $query->get('logo-is-retina-desktop') ) {
		$logoWidth = $imageDimensions->width / 2;
		$logoHeight = $imageDimensions->height / 2;
	} else {
		$logoWidth = $imageDimensions->width;
		$logoHeight = $imageDimensions->height;
	}

// Attributes
	extract( shortcode_atts(
			array(
				'color' => ''
			), $atts )
	);

// Code

	if ( $color == 'dark' ){
		return '<img src="' . esc_url( $logoImgUrlDesktopDark ) . '" width="' . absint( $logoWidth ) . '" height="' . absint( $logoHeight ) . '" alt="">';
	} else if ( $color == 'light' ){
		return '<img src="' . esc_url( $logoImgUrlDesktopLight ) . '" width="' . absint( $logoWidth ) . '" height="' . absint( $logoHeight ) . '" alt="">';
	}

	return '';
}

// Punchline shortcode
function punchline( $atts , $content = null ) {
	return '<div class="punchline">' . $content . '</div>';
}


if( function_exists('add_shortcode') ) {
	add_shortcode('logo', 'logo_shortcode');
	add_shortcode( 'punchline', 'punchline' );
	require_once dirname(__FILE__).'/bootstrap-shortcodes/bootstrap-shortcodes.php';
}


