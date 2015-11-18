<?php

/** @var ffOneStructure $s */

$s->addElement( ffOneElement::TYPE_HEADING, '', __('Side Menu Settings', 'zero') );

$s->startSection('side-menu');
	$s->addElement( ffOneElement::TYPE_TABLE_START );

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', __('Color Style', 'zero') );

			$s->addOption(ffOneOption::TYPE_SELECT, 'side-menu-style', '', 'black')
				->addSelectValue( __('Black', 'zero') , 'black')
				->addSelectValue( __('White', 'zero') , 'white');
				
		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', __('Desktop Logo', 'zero') );

			$s->addOption( ffOneOption::TYPE_IMAGE, 'logo-img-desktop', __('Desktop Logo', 'zero') , '');
			$s->addElement( ffOneElement::TYPE_NEW_LINE );
			$s->addOption( ffOneOption::TYPE_CHECKBOX, 'logo-is-retina-desktop', __('This logo image is in retina resolution', 'zero') , 1);

		$s->addElement( ffOneElement::TYPE_DESCRIPTION, '', __('Please note that your logo will displayed in the same dimensions as the source image. This is to prevent any blurriness that would occur if we would resize your logo images with a script. We also recommend uploading logos that are double in size and then ticking the retina option below.', 'zero')  );

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', __('Mobile Logo', 'zero') );

			$s->addOption( ffOneOption::TYPE_IMAGE, 'logo-img-mobile', __('Mobile Logo', 'zero') , '');
			$s->addElement( ffOneElement::TYPE_NEW_LINE );
			$s->addOption( ffOneOption::TYPE_CHECKBOX, 'logo-is-retina-mobile', __('This logo image is in retina resolution', 'zero') , 1);

		$s->addElement( ffOneElement::TYPE_DESCRIPTION, '', __('Please note that your logo will displayed in the same dimensions as the source image. This is to prevent any blurriness that would occur if we would resize your logo images with a script. We also recommend uploading logos that are double in size and then ticking the retina option below.', 'zero')  );

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', __('Menu', 'zero') );

			$s->addElement( ffOneElement::TYPE_DESCRIPTION, '', __('You may change menu in <a href="./nav-menus.php">Appereance &rarr; Menus</a>', 'zero') );

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );
		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', __('Social Links and Icons', 'zero') );

			$s->addOption( ffOneOption::TYPE_TEXTAREA, 'social-links', '', 'http://facebook.com/freshfacethemes
http://twitter.com/_freshface
http://vimeo.com/' );

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );
	$s->addElement( ffOneElement::TYPE_TABLE_END );
$s->endSection();
