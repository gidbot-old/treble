<?php

/** @var ffOneStructure $s */

$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', __('Nothing found by Search', 'zero'));

	$s->startSection('nothing-found');

		$s->addOption( ffOneOption::TYPE_TEXTAREA, 'title', __('Title', 'zero'), __('No Search Results for: %s', 'zero'));
		$s->addElement( ffOneElement::TYPE_DESCRIPTION, '', __('<code>There are no Search Results for...</code> title in search page', 'zero'));
		$s->addElement( ffOneElement::TYPE_NEW_LINE );

		$s->addOption( ffOneOption::TYPE_TEXTAREA, 'description', __('Description', 'zero'), __('Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'zero'));
		$s->addElement( ffOneElement::TYPE_DESCRIPTION, '', __('Info, that does not found any results', 'zero'));
		$s->addElement( ffOneElement::TYPE_NEW_LINE );

	$s->endSection();

$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

