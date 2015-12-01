<?php

/** @var ffOneStructure $s */

$s->addElement( ffOneElement::TYPE_HEADING, '', __('Header Settings', 'zero') );

$s->startSection('header');
	$s->addElement( ffOneElement::TYPE_TABLE_START );

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', __('Desktop Logo', 'zero'));

			$s->addOption( ffOneOption::TYPE_IMAGE, 'logo-img-dark-desktop', __('Dark Desktop Logo', 'zero'), '');
			$s->addElement( ffOneElement::TYPE_NEW_LINE );
			$s->addOption( ffOneOption::TYPE_IMAGE, 'logo-img-light-desktop', __('Light Desktop Logo', 'zero'), '');
			$s->addElement( ffOneElement::TYPE_NEW_LINE );
			$s->addOption( ffOneOption::TYPE_CHECKBOX, 'logo-is-retina-desktop', __('These logo images are in retina resolution', 'zero'), 1);

		$s->addElement( ffOneElement::TYPE_DESCRIPTION, '', __('Please note that your logo will displayed in the same dimensions as the source image. This is to prevent any blurriness that would occur if we would resize your logo images with a script. We also recommend uploading logos that are double in size and then ticking the retina option below.', 'zero') );

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', __('Mobile Logo', 'zero'));

			$s->addOption( ffOneOption::TYPE_IMAGE, 'logo-img-mobile', __('Mobile Logo', 'zero'), '');
			$s->addElement( ffOneElement::TYPE_NEW_LINE );
			$s->addOption( ffOneOption::TYPE_CHECKBOX, 'logo-is-retina-mobile', __('This logo image is in retina resolution', 'zero'), 1);

		$s->addElement( ffOneElement::TYPE_DESCRIPTION, '', __('Please note that your logo will displayed in the same dimensions as the source image. This is to prevent any blurriness that would occur if we would resize your logo images with a script. We also recommend uploading logos that are double in size and then ticking the retina option below.', 'zero') );

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', __('Translations', 'zero'));

			$s->addOption( ffOneOption::TYPE_TEXT, 'menu-menu', __('Menu', 'zero'), __('Menu', 'zero'));
			$s->addElement( ffOneElement::TYPE_NEW_LINE );
			$s->addOption( ffOneOption::TYPE_TEXT, 'menu-close', __('Close', 'zero'), __('Close', 'zero'));

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

	$s->addElement( ffOneElement::TYPE_TABLE_END );
$s->endSection();
