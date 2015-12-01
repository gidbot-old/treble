<?php

Zero__Featured_Area::setIgnoreFirstFeatured( false );
$featured_img = Zero__Featured_Area::getFeaturedImage();
list( $featured_img_w, $featured_img_h  ) = Zero__Featured_Area::getFeaturedImageSizes();

switch ( get_post_format() ) {

	case 'video':
		$featured_primary = Zero__Featured_Area::getFeaturedVideo();
		if( !empty( $featured_primary ) ){

			$featured_primary = zero__video( $featured_primary );
			wp_enqueue_script( 'zero-featured-video-1-js' );

		}
		break;

	case 'gallery':
		Zero__Featured_Area::setFeaturedPrinter( 'zero__gallery' );
		$featured_primary = get_post_gallery( get_the_ID() );
		Zero__Featured_Area::setFeaturedPrinter( false );
		break;

	default:
		$featured_primary = '';
		break;
}

global $featured_height;

if( ! empty( $featured_primary ) ){

	// Modified default WP featured areas
	echo  $featured_primary;

	Zero__Featured_Area::setIgnoreFirstFeatured( true );

} else if( ! empty( $featured_img ) ) {
	?>
		<div class="featured-area-1 ff-section">
			<div
				class="
					featured-image-1
					ff-block
				"
			>

				<?php

					// it allows to use "$responsive_img"
					$responsive_img = $featured_img;
					require locate_template('templates/blocks/responsive-image-1/responsive-image-1.php');

				?>

			</div>
		</div>
	<?php
}