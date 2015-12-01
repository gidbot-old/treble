<?php
/** @var ffOneStructure $s */

$s->addElement( ffOneElement::TYPE_HEADING, '', __('404 Settings', 'zero') );

$s->startSection('404');
	$s->addElement( ffOneElement::TYPE_TABLE_START );
		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', __('404', 'zero') );

			$s->addOption( ffOneOption::TYPE_TEXTAREA, 'title', __('Title', 'zero') , __('404 Not found', 'zero') );
			$s->addElement( ffOneElement::TYPE_DESCRIPTION, '', __('"Not found" title in 404 page', 'zero') );
			$s->addElement( ffOneElement::TYPE_NEW_LINE );

			$s->addOption( ffOneOption::TYPE_TEXTAREA, 'description', __('Description', 'zero') ,
				__('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'zero') );
			$s->addElement( ffOneElement::TYPE_DESCRIPTION, '', __('Info, that there are no results', 'zero') );
			$s->addElement( ffOneElement::TYPE_NEW_LINE );

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );
	$s->addElement( ffOneElement::TYPE_TABLE_END );
$s->endSection();
