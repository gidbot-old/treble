<?php

$query = ffThemeOptions::getQuery('header');

?>
<div class="header-1 ff-section">
	<div class="header-holder">

		<div class="logo-holder">
			<div class="vcenter-wrapper">
				<div class="vcenter">
					<div class="logo-wrapper">
						<h1>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="logo">
								<span class="logo__inner background-check">
									<?php
										if ( $query->getImage('logo-img-light-desktop')->url ){
											$logoImgUrlDesktopLight = $query->getImage('logo-img-light-desktop')->url;
										}
										if ( empty($logoImgUrlDesktopLight) ){
											$logoImgUrlDesktopLight = get_template_directory_uri() . '/templates/sections/header-1/images/logo-desktop-light@2x.png';
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
									?>
									<img
										class="logo-desktop logo-light"
										src="<?php echo esc_url( $logoImgUrlDesktopLight ); ?>"
										alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"
										width="<?php echo absint( $logoWidth ); ?>"
										height="<?php echo absint( $logoHeight ); ?>"
									>
									<?php
										if ( $query->getImage('logo-img-dark-desktop')->url ){
											$logoImgUrlDesktopDark = $query->getImage('logo-img-dark-desktop')->url;
										}
										if ( empty($logoImgUrlDesktopDark) ){
											$logoImgUrlDesktopDark = get_template_directory_uri() . '/templates/sections/header-1/images/logo-desktop-dark@2x.png';
										}
										$imageDimensions = ffContainer()
											->getGraphicFactory()
											->getImageInformator( $logoImgUrlDesktopDark )
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
										class="logo-desktop logo-dark"
										src="<?php echo esc_url( $logoImgUrlDesktopDark ); ?>"
										alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"
										width="<?php echo absint( $logoWidth ); ?>"
										height="<?php echo absint( $logoHeight ); ?>"
									>
									<?php
										if ( $query->getImage('logo-img-mobile')->url ){
											$logoImgUrlMobile = $query->getImage('logo-img-mobile')->url;
										}
										if ( empty($logoImgUrlMobile) ){
											$logoImgUrlMobile = get_template_directory_uri() . '/templates/sections/header-1/images/logo-mobile@2x.png';
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
								</span>
							</a>
						</h1>
					</div>
				</div>
			</div>
		</div>

		<div class="menu-holder">
			<div class="vcenter-wrapper">
				<div class="vcenter">
					<a href="" class="menu-button clearfix">
						<span class="menu-button__inner clearfix background-check">
							<span class="menu-button__lines">
								<span class="menu-button__line-1"></span>
								<span class="menu-button__line-2"></span>
								<span class="menu-button__line-3"></span>
							</span>
							<span class="menu-button__label">
								<span class="menu-button__label__text-closed"><?php echo zero__wp_kses( $query->get('menu-menu') ); ?></span>
								<span class="menu-button__label__text-opened"><?php echo zero__wp_kses( $query->get('menu-close') ); ?></span>
							</span>
						</span>
					</a>
				</div>
			</div>
		</div>

		<div class="clear"></div>

	</div>
</div>