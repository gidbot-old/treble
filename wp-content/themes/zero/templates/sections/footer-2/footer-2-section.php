<?php

/** @var ffOneStructure $s */

$s->addElement( ffOneElement::TYPE_HEADING, '', __('Secondary Footer - Copyright and Social Links', 'zero')  );

$s->startSection('secondary');
	$s->addElement( ffOneElement::TYPE_TABLE_START );
		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', __('Settings', 'zero') );

			$s->addOption( ffOneOption::TYPE_CHECKBOX, 'show', __('Show Secondary Footer', 'zero') , 1 );

			$s->addElement( ffOneElement::TYPE_NEW_LINE );
			$s->addElement( ffOneElement::TYPE_NEW_LINE );

			$s->addOption( ffOneOption::TYPE_TEXTAREA, 'description', __('Left Side', 'zero') , __('All rights reserved &copy; 2015', 'zero')  );
			$s->addElement( ffOneElement::TYPE_NEW_LINE );
			$s->addElement( ffOneElement::TYPE_NEW_LINE );
			$s->addOption( ffOneOption::TYPE_TEXTAREA, 'social-links', __('Social Links', 'zero') , 'http://facebook.com/freshfacethemes
http://twitter.com/_freshface
http://vimeo.com/' );
		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );
	$s->addElement( ffOneElement::TYPE_TABLE_END );
$s->endSection();