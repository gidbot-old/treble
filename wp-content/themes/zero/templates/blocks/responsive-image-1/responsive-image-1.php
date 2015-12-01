<?php

wp_enqueue_script( 'zero-responsive-image-1-js' );

$imageDimensions = ffContainer()
	->getGraphicFactory()
	->getImageInformator( $responsive_img )
	->getImageDimensions()
;

$W = $imageDimensions->width;
$H = $imageDimensions->height;

$transparentImageSettings = array(
	'src'=>$responsive_img,
	'w'=>$W,
	'h'=>$H,
	'color' => array( 236, 236, 236, 0 ),
);

$convertingArray = array(
	'xs-1x' => 540,
	'xs-2x' => 1080,
	'sm-1x' => 768,
	'sm-2x' => 1536,
	'md-1x' => 1199,
	'md-2x' => 1920,
	'lg-1x' => 1920,
	'lg-2x' => 1920,
);


echo '<img class="responsive-image-1 ff-block" ';
foreach ( $convertingArray as $viewport => $maxWidth ){
	if ( $W < $maxWidth ){
		$imageUrl = $responsive_img;
	} else {
		$imageUrl = fImg::resize($responsive_img,$maxWidth,null,false, false, true );
	}
	echo ' data-src-'.esc_attr( $viewport ).'="'.esc_url( $imageUrl ).'"'."\n";
}
echo ' src="'.Zero__Transparent_Imager::get($transparentImageSettings).'"';
echo ' alt=""';
echo ' />';
echo '<noscript><img src="'.esc_url( $responsive_img ).'" alt="" /></noscript>';
