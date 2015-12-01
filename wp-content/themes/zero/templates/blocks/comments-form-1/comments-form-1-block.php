<?php
/** @var ffOneStructure $s */

$s->startSection('comments-form');

	$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', __('Comment Form Options', 'zero') );

		$s->addOption( ffOneOption::TYPE_TEXT, 'heading', __('Form Heading', 'zero') , __('Leave a Reply', 'zero') );
		$s->addElement(ffOneElement::TYPE_NEW_LINE );

		$s->addOption( ffOneOption::TYPE_TEXT, 'name', __('Name', 'zero') , __('Name', 'zero') );
		$s->addElement(ffOneElement::TYPE_NEW_LINE );

		$s->addOption( ffOneOption::TYPE_TEXT, 'email', __('E-mail', 'zero') , __('E-mail', 'zero') );
		$s->addElement(ffOneElement::TYPE_NEW_LINE );

		$s->addOption( ffOneOption::TYPE_TEXT, 'website', __('Website', 'zero') , __('Website', 'zero') );
		$s->addElement(ffOneElement::TYPE_NEW_LINE );

		$s->addOption( ffOneOption::TYPE_TEXT, 'comment-form', __('Comment Form', 'zero') , __('Message', 'zero') );
		$s->addElement(ffOneElement::TYPE_NEW_LINE );

		$s->addOption( ffOneOption::TYPE_TEXT, 'submit-button', __('Submit Button Text', 'zero') , __('Send', 'zero') );
		$s->addElement(ffOneElement::TYPE_NEW_LINE );

		$s->addOption( ffOneOption::TYPE_TEXTAREA, 'logged-in', __('Logged in text', 'zero') , __('Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'zero') );

		$s->addOption( ffOneOption::TYPE_TEXTAREA, 'closing-unfinished-comment', __('Before Closing Unfinished Comment', 'zero') , __('Closing this popup will erase your unfinished comment. Do you wish to proceed with closing?', 'zero') );

	$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

$s->endSection();