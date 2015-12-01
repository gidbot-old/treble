<?php

$query = ffThemeOptions::getQuery('side-menu');

?>
<div class="side-menu-1 ff-section <?php echo 'side-menu-1__style--'.esc_attr( $query->get('side-menu-style') ); ?> ">
	<div class="side-menu">
		<div class="side-menu-inner">

			<div class="logo-wrapper">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo background-check">

						<?php
							if ( $query->getImage('logo-img-desktop')->url ){
								$logoImgUrlDesktop = $query->getImage('logo-img-desktop')->url;
							}
							if ( empty($logoImgUrlDesktop) ){
								$logoImgUrlDesktop = get_template_directory_uri() . '/templates/sections/side-menu-1/images/logo-desktop@2x.png';
							}
							$imageDimensions = ffContainer()
								->getGraphicFactory()
								->getImageInformator( $logoImgUrlDesktop )
								->getImageDimensions();

							if( $query->get('logo-is-retina-desktop') ) {
								$logoWidth = $imageDimensions->width / 2;
								$logoHeight = $imageDimensions->height / 2;
							} else {
								$logoWidth = $imageDimensions->width;
								$logoHeight = $imageDimensions->height;
							}
						?>
						<img
							class="logo-desktop"
							src="<?php echo esc_url( $logoImgUrlDesktop ); ?>"
							alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"
							width="<?php echo absint( $logoWidth ); ?>"
							height="<?php echo absint( $logoHeight ); ?>"
						>
						<?php
							if ( $query->getImage('logo-img-mobile')->url ){
								$logoImgUrlMobile = $query->getImage('logo-img-mobile')->url;
							}
							if ( empty($logoImgUrlMobile) ){
								$logoImgUrlMobile = get_template_directory_uri() . '/templates/sections/side-menu-1/images/logo-mobile@2x.png';
							}
							$imageDimensions = ffContainer()
								->getGraphicFactory()
								->getImageInformator( $logoImgUrlMobile )
								->getImageDimensions();

							if( $query->get('logo-is-retina-mobile') ) {
								$logoWidth = $imageDimensions->width / 2;
								$logoHeight = $imageDimensions->height / 2;
							} else {
								$logoWidth = $imageDimensions->width;
								$logoHeight = $imageDimensions->height;
							}
						?>
						<img
							class="logo-mobile"
							src="<?php echo esc_url( $logoImgUrlMobile ); ?>"
							alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"
							width="<?php echo absint( $logoWidth ); ?>"
							height="<?php echo absint( $logoHeight ); ?>"
						>

				</a>
			</div>

			<?php

				wp_nav_menu( array(
					'theme_location' => 'navigation',
					'container'      => false,
					'menu_class'     => 'navigation',
					'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					'fallback_cb'    => false,
					'depth'			 => '1',
				));

			?>

		</div>

		<ul class="side-menu__social">
		<?php
			$socialLinks = $query->get('social-links');

			$linksTranslated = ffContainer::getInstance()
					->getThemeFrameworkFactory()
					->getSocialFeedCreator()
					->getFeedFromLinks( $socialLinks );

			if( !empty( $linksTranslated ) ) {
				foreach( $linksTranslated as $oneItem ) {
					echo '<li class="social-icon">';
						echo '<a href="'.esc_url( $oneItem->link ).'" target="_blank">';
							$icon = apply_filters('to_zocial', $oneItem->type);
							echo '<i class="ff-font-zocial icon-'.esc_attr( $icon ).'"></i>';
						echo '</a>';
					echo '</li>';
				}
			}
		?>
		</ul>

	</div>
</div>