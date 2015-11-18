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
	'xs-1x' => absint(  540 / $column_count_xs ) ,
	'xs-2x' => absint(  768 / $column_count_xs ) ,
	'sm-1x' => absint(  768 / $column_count_sm ) ,
	'sm-2x' => absint( 1536 / $column_count_sm ) ,
	'md-1x' => absint( 1199 / $column_count_md ) ,
	'md-2x' => absint( 1920 / $column_count_md ) ,
	'lg-1x' => absint( 1920 / $column_count_lg ) ,
	'lg-2x' => absint( 1920 / $column_count_lg ) ,
);

echo '<img class="portfolio-cat-1__featured-image responsive-image-1 ff-block" ';
foreach ( $convertingArray as $viewport => $size ){

	if( 320 > $size ){
		$size = 320;
	}

	if( $W < $size ){
		$size =  $W;
	}

	if( $is_square ){
		$imageUrl = fImg::resize($responsive_img,$size,$size,true, false, true );
	}else{
		$imageUrl = fImg::resize($responsive_img,$size,null,true, false, true );
	}
	echo ' data-src-'.esc_attr( $viewport ).'="'.esc_url( $imageUrl ).'"'."\n";
}
echo ' src="'.Zero__Transparent_Imager::get($transparentImageSettings).'"';
echo ' alt=""';
echo ' />';
echo '<noscript><img src="'.esc_url( $responsive_img ).'" alt="" /></noscript>';
