<?php
/** @var ffOneStructure $s */

$s->startSection('comments-list');

	$s->startSection('heading');
		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', __('Comment List Heading', 'zero') ) ;
			$s->addOption(ffOneOption::TYPE_CHECKBOX, 'show', __('Show Heading', 'zero') , 1);
			$s->addElement(ffOneElement::TYPE_NEW_LINE );

			$s->addOption( ffOneOption::TYPE_TEXT, 'trans-zero', __('No Comments', 'zero') , __('Comments (0)', 'zero') );
			$s->addElement(ffOneElement::TYPE_NEW_LINE );

			$s->addOption( ffOneOption::TYPE_TEXT, 'trans-one', __('1 Comment', 'zero') , __('Comments (1)', 'zero') );
			$s->addElement(ffOneElement::TYPE_NEW_LINE );

			$s->addOption( ffOneOption::TYPE_TEXT, 'trans-more', __('%s Comments', 'zero') , __('Comments (%s)', 'zero') );

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );
	$s->endSection();

	$s->startSection('one-comment');
		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', __('Comment List Options', 'zero') );

			$s->addOption(ffOneOption::TYPE_CHECKBOX, 'show-date', __('Show', 'zero') , 1);

			$s->addOption( ffOneOption::TYPE_TEXT, 'how-much-ago', __('"%s Ago"', 'zero') , __('%s ago', 'zero') );
			$s->addElement(ffOneElement::TYPE_NEW_LINE );


			$s->addOption( ffOneOption::TYPE_TEXT, 'trans-reply', __('Reply comment', 'zero') , __('Reply', 'zero') );
			$s->addElement(ffOneElement::TYPE_NEW_LINE );

			$s->addOption( ffOneOption::TYPE_TEXTAREA, 'trans-moderation', __('Awaiting for moderation', 'zero') , __('Your comment is awaiting moderation.', 'zero') );

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

	$s->endSection();

$s->endSection();