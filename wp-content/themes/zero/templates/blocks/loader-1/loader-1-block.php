<?php
/** @var ffOneStructure $s */

$s->addElement( ffOneElement::TYPE_HEADING, '', __('Loader Settings', 'zero') );

$s->startSection('loader');
	$s->addElement( ffOneElement::TYPE_TABLE_START );

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', __('Loader Type', 'zero') );

			$s->addOption(ffOneOption::TYPE_SELECT, 'loader-type', '', 1)
				->addSelectValue( __('None', 'zero') , '' )
				->addSelectValue( __('Variant #1 - Normal logo with animated spinner', 'zero') , 1)
				->addSelectValue( __('Variant #2 - Animated logo overlay', 'zero') , 2) ;

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', __('Variant #1', 'zero') );

			$s->addOption( ffOneOption::TYPE_IMAGE, 'loader-logo', __('Variant #1 Logo Image', 'zero') , '');
			$s->addElement( ffOneElement::TYPE_NEW_LINE );
			$s->addOption( ffOneOption::TYPE_CHECKBOX, 'loader-logo-is-retina', __('This logo is in retina resolution', 'zero') , 1);
			$s->addElement( ffOneElement::TYPE_DESCRIPTION, '', __('Please note that your logo will displayed in the same dimensions as the source image. This is to prevent any blurriness that would occur if we would resize your logo images with a script. We also recommend uploading logos that are double in size and then ticking the retina option below.', 'zero')  );

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', __('Variant #2', 'zero') );

			$s->addOption( ffOneOption::TYPE_IMAGE, 'loader-logo-2', __('Variant #2 Logo Image', 'zero') , '');
			$s->addElement( ffOneElement::TYPE_NEW_LINE );
			$s->addOption( ffOneOption::TYPE_CHECKBOX, 'loader-logo-2-is-retina', __('This logo is in retina resolution', 'zero') , 1);
			$s->addElement( ffOneElement::TYPE_DESCRIPTION, '', __('Please note that your logo will displayed in the same dimensions as the source image. This is to prevent any blurriness that would occur if we would resize your logo images with a script. We also recommend uploading logos that are double in size and then ticking the retina option below.', 'zero')  );

			$s->addElement( ffOneElement::TYPE_NEW_LINE );

			$s->addOption(ffOneOption::TYPE_SELECT, 'feed-source', __('Latest Featured Images for the background animation will be gathered from this post type:', 'zero') , 'post')
				->addSelectValue( __('Posts', 'zero') , 'post' )
				->addSelectValue( __('Portfolio', 'zero') , 'portfolio') ;

			$s->addElement( ffOneElement::TYPE_NEW_LINE );

			$s->addOption(ffOneOption::TYPE_SELECT, 'feed-count', __('The number of Latest Featured Images to be used in the background animation is', 'zero') , 5)
				->addSelectNumberRange(3,10);

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

	$s->addElement( ffOneElement::TYPE_TABLE_END );
$s->endSection();



