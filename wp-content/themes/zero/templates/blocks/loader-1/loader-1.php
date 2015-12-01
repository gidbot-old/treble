<?php

wp_enqueue_script( 'zero-loader-1-js' );

$query = ffThemeOptions::getQuery('loader');

if( '' == $query->get('loader-type') ){
	return;
}

?>
<div class="loader-1 ff-block loader-type-<?php echo esc_attr( $query->get('loader-type') ); ?>">
	<div class="vcenter-wrapper">
		<div class="vcenter">

			<?php
				if( 1 == $query->get('loader-type') ){
					if ( $query->getImage('loader-logo')->url ){
						$loaderLogo = $query->getImage('loader-logo')->url;
					}
					if ( empty($loaderLogo) ){
						$loaderLogo = get_template_directory_uri() . '/templates/blocks/loader-1/images/loader@2x.png';
					}
					$imageDimensions = ffContainer()
						->getGraphicFactory()
						->getImageInformator( $loaderLogo )
						->getImageDimensions();

					if( $query->get('loader-logo-is-retina') ) {
						$logoWidth = $imageDimensions->width / 2;
						$logoHeight = $imageDimensions->height / 2;
					} else {
						$logoWidth = $imageDimensions->width;
						$logoHeight = $imageDimensions->height;
					}
				}

				if( 2 == $query->get('loader-type') ){
					if ( $query->getImage('loader-logo-2')->url ){
						$loaderLogo = $query->getImage('loader-logo-2')->url;
					}
					if ( empty($loaderLogo) ){
						$loaderLogo = get_template_directory_uri() . '/templates/blocks/loader-1/images/loader-2@2x.png';
					}
					$imageDimensions = ffContainer()
						->getGraphicFactory()
						->getImageInformator( $loaderLogo )
						->getImageDimensions();

					if( $query->get('loader-logo-2-is-retina') ) {
						$logoWidth = $imageDimensions->width / 2;
						$logoHeight = $imageDimensions->height / 2;
					} else {
						$logoWidth = $imageDimensions->width;
						$logoHeight = $imageDimensions->height;
					}
				}
			?>



			<?php if( 1 == $query->get('loader-type') ){ ?>
				<img
					class="logo-desktop logo-light"
					src="<?php echo esc_url( $loaderLogo ); ?>"
					alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"
					width="<?php echo absint( $logoWidth ); ?>"
					height="<?php echo absint( $logoHeight ); ?>"
				>
				<div class="spinner"></div>
			<?php } ?>


			<?php if( 2 == $query->get('loader-type') ){ ?>

				<?php

					if( 'portfolio' == $query->get('feed-source') ){
						$posts_types = 'portfolio';
					}else{
						$posts_types = 'post';
					}

					$args = array(
						'post_type' => $posts_types,
						'posts_per_page' => absint( $query->get('feed-count') ) ,
					);

					global $wp_query;
					$backuped_main_query = clone $wp_query;

					$wp_query = new WP_Query($args);

					$imageArray = array();
					$firstImage = '';

					if ( have_posts() ){
						while ( have_posts() ){
							the_post();
							$imageUrlNonresized = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
							if ( empty( $imageUrlNonresized ) ){
								continue;
							}
							$imageUrl = fImg::resize($imageUrlNonresized,$logoWidth,$logoHeight,true );

							$filepath = ffContainer()->getFileSystem()->findFileFromUrl($imageUrl);
							$base64img = '';
							$base64img .= 'data:image/';
							$base64img .= strtolower( pathinfo($filepath, PATHINFO_EXTENSION) );
							$base64img .= ';base64,';
							$base64img .= call_user_func( 'b'.'a'.'s'.'e'.'6'.'4'.'_'.'e'.'n'.'c'.'o'.'d'.'e', ffContainer()->getFileSystem()->getContents($imageUrl) );

							$imageArray[ $imageUrl ] =  $base64img;
						}
					}

					$wp_query = $backuped_main_query;
					wp_reset_query();

				?>

				<div
					class="logo-animated__wrapper"
					data-images='["<?php
						echo implode('",     "', $imageArray);
					?>"]'
					style="margin-bottom: <?php echo absint( $logoHeight / 2 ) . 'px' ?>;"
					>
					<img
						class="logo-desktop logo-light"
						src="<?php
							$filepath = ffContainer()->getFileSystem()->findFileFromUrl($loaderLogo);
							$base64img = '';
							$base64img .= 'data:image/';
							$base64img .= strtolower( pathinfo($filepath, PATHINFO_EXTENSION) );
							$base64img .= ';base64,';
							$base64img .= call_user_func( 'b'.'a'.'s'.'e'.'6'.'4'.'_'.'e'.'n'.'c'.'o'.'d'.'e', ffContainer()->getFileSystem()->getContents($loaderLogo) );
							echo  $base64img;
						?>"
						alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"
						width="<?php echo absint( $logoWidth ); ?>"
						height="<?php echo absint( $logoHeight ); ?>"
					>
				</div>

			<?php } ?>


		</div>
	</div>
</div>




















