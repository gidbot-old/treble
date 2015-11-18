<?php

/** @var ffOneStructure $s */

$s->addElement( ffOneElement::TYPE_HEADING, '', __('Primary Footer - Widgets', 'zero')  );

$s->startSection('primary');
	$s->addElement( ffOneElement::TYPE_TABLE_START );
		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', __('Settings', 'zero') );

			$s->addOption( ffOneOption::TYPE_CHECKBOX, 'show', __('Show Primary Footer', 'zero') , 1 );

			$s->addElement( ffOneElement::TYPE_NEW_LINE );
			$s->addElement( ffOneElement::TYPE_NEW_LINE );

			$s->startSection('widgets', ffOneSection::TYPE_REPEATABLE_VARIABLE);
				$s->startSection('one-widget', ffOneSection::TYPE_REPEATABLE_VARIATION)
					->addParam('section-name', __('Footer Widget', 'zero') );

					$s->addOption(ffOneOption::TYPE_SELECT, 'xs', __('Width for Phones and up', 'zero') , '12')
						->addSelectValue( __( 'Default', 'zero'), '')
						->addSelectValue( '1 / 12', 1)
						->addSelectValue( '1 / 6', 2)
						->addSelectValue( '1 / 4', 3)
						->addSelectValue( '1 / 3', 4)
						->addSelectValue( '5 / 12', 5)
						->addSelectValue( '1 / 2', 6)
						->addSelectValue( '7 / 12', 7)
						->addSelectValue( '2 / 3', 8)
						->addSelectValue( '3 / 4', 9)
						->addSelectValue( '5 / 6', 10)
						->addSelectValue( '11 / 12', 11)
						->addSelectValue( __('Fullwidth', 'zero'), 12) ;

					$s->addElement( ffOneElement::TYPE_NEW_LINE );
					$s->addOption(ffOneOption::TYPE_SELECT, 'sm', __('Width for Tablets and up', 'zero') , '6')
						->addSelectValue( __( 'Default', 'zero'), '')
						->addSelectValue( '1 / 12', 1)
						->addSelectValue( '1 / 6', 2)
						->addSelectValue( '1 / 4', 3)
						->addSelectValue( '1 / 3', 4)
						->addSelectValue( '5 / 12', 5)
						->addSelectValue( '1 / 2', 6)
						->addSelectValue( '7 / 12', 7)
						->addSelectValue( '2 / 3', 8)
						->addSelectValue( '3 / 4', 9)
						->addSelectValue( '5 / 6', 10)
						->addSelectValue( '11 / 12', 11)
						->addSelectValue( __('Fullwidth', 'zero'), 12) ;

					$s->addElement( ffOneElement::TYPE_NEW_LINE );
					$s->addOption(ffOneOption::TYPE_SELECT, 'md', __('Width for Laptops and up', 'zero') , '3')
						->addSelectValue( __( 'Default', 'zero'), '')
						->addSelectValue( '1 / 12', 1)
						->addSelectValue( '1 / 6', 2)
						->addSelectValue( '1 / 4', 3)
						->addSelectValue( '1 / 3', 4)
						->addSelectValue( '5 / 12', 5)
						->addSelectValue( '1 / 2', 6)
						->addSelectValue( '7 / 12', 7)
						->addSelectValue( '2 / 3', 8)
						->addSelectValue( '3 / 4', 9)
						->addSelectValue( '5 / 6', 10)
						->addSelectValue( '11 / 12', 11)
						->addSelectValue( __('Fullwidth', 'zero'), 12);

					$s->addElement( ffOneElement::TYPE_NEW_LINE );
					$s->addOption(ffOneOption::TYPE_SELECT, 'lg', __('Width for Desktops and up', 'zero') , '')
						->addSelectValue( __( 'Default', 'zero'), '')
						->addSelectValue( '1 / 12', 1)
						->addSelectValue( '1 / 6', 2)
						->addSelectValue( '1 / 4', 3)
						->addSelectValue( '1 / 3', 4)
						->addSelectValue( '5 / 12', 5)
						->addSelectValue( '1 / 2', 6)
						->addSelectValue( '7 / 12', 7)
						->addSelectValue( '2 / 3', 8)
						->addSelectValue( '3 / 4', 9)
						->addSelectValue( '5 / 6', 10)
						->addSelectValue( '11 / 12', 11)
						->addSelectValue( __('Fullwidth', 'zero'), 12) ;

				$s->endSection();
			$s->endSection();

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );
	$s->addElement( ffOneElement::TYPE_TABLE_END );
$s->endSection();