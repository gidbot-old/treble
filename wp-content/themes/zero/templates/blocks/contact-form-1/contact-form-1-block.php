<?php
/** @var ffOneStructure $s */

$s->addElement( ffOneElement::TYPE_TABLE_START );

	$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', __('Contact Form User Data', 'zero') );
		$s->startSection('settings');

			$s->addOption(ffOneOption::TYPE_TEXT, 'email', __('Your email address (where to receive emails)', 'zero') , 'nation@mailinator.com');
			$s->addElement( ffOneElement::TYPE_NEW_LINE );

			$s->addOption(ffOneOption::TYPE_TEXT, 'subject', __('Subject of the emails received', 'zero') , __('Contact Form', 'zero') );
			$s->addElement( ffOneElement::TYPE_NEW_LINE );

		$s->endSection();
	$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

	$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', __('Contact Form', 'zero') );

		$s->startSection('titles');
			$s->addOption(ffOneOption::TYPE_TEXT, 'name', __('Name', 'zero') , __('Name', 'zero') );
			$s->addElement( ffOneElement::TYPE_NEW_LINE );

			$s->addOption(ffOneOption::TYPE_TEXT, 'email', __('E-mail', 'zero') , __('E-mail', 'zero') );
			$s->addElement( ffOneElement::TYPE_NEW_LINE );

			$s->addOption(ffOneOption::TYPE_TEXT, 'subject', __('Subject', 'zero') , __('Subject', 'zero') );
			$s->addElement( ffOneElement::TYPE_NEW_LINE );

			$s->addOption(ffOneOption::TYPE_TEXT, 'message', __('Message', 'zero') , __('Message', 'zero') );
			$s->addElement( ffOneElement::TYPE_NEW_LINE );

			$s->addOption(ffOneOption::TYPE_TEXT, 'button', __('Button Text', 'zero') , __('Send', 'zero') );
			$s->addElement( ffOneElement::TYPE_NEW_LINE );

		$s->endSection();
	$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );



	$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', __('Contact Form Messages', 'zero') );
		$s->startSection('messages');

			$s->addOption(ffOneOption::TYPE_TEXTAREA, 'message-send-ok', __('Message has been sent', 'zero') , __('Your message was successfully sent!', 'zero') );
			$s->addElement( ffOneElement::TYPE_NEW_LINE );

			$s->addOption(ffOneOption::TYPE_TEXTAREA, 'message-send-wrong', __('Message has NOT been sent', 'zero') , __('There was an error sending the message!', 'zero') );

		$s->endSection();
	$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );


$s->addElement( ffOneElement::TYPE_TABLE_END );