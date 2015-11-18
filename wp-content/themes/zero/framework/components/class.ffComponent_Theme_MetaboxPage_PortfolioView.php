<?php

class ffComponent_Theme_MetaboxPage_PortfolioView extends ffOptionsHolder {
	public function getOptions() {
		$s = $this->_getOnestructurefactory()->createOneStructure( 'page_portfolio');

		$s->startSection('general');

			$s->addElement( ffOneElement::TYPE_TABLE_START );

				$s->addElement(ffOneElement::TYPE_TABLE_DATA_START, '', __( 'Portfolio Title', 'zero') );
					$s->addOption(ffOneOption::TYPE_CHECKBOX, 'show_title', __( 'Show Title', 'zero') , 1);
				$s->addElement(ffOneElement::TYPE_TABLE_DATA_END );

				$s->addElement(ffOneElement::TYPE_TABLE_DATA_START, '', __( 'Portfolio Sortable Tags', 'zero') );
					$s->addOption(ffOneOption::TYPE_CHECKBOX, 'show_sortable_tags', __( 'Show Sortable Tags', 'zero') , 1);
					$s->addElement(ffOneElement::TYPE_NEW_LINE );
					$s->addOption(ffOneOption::TYPE_TEXT, 'all_translation', __( '<code>All</code> translation', 'zero') , __( 'All', 'zero') );
				$s->addElement(ffOneElement::TYPE_TABLE_DATA_END );

				$s->addElement(ffOneElement::TYPE_TABLE_DATA_START, '', __( 'Photo Cropping', 'zero') );
					$s->addOption(ffOneOption::TYPE_CHECKBOX, 'is_square', __( 'Crop all photos to squares', 'zero') , 0);
				$s->addElement(ffOneElement::TYPE_TABLE_DATA_END );

			$s->addElement( ffOneElement::TYPE_TABLE_END );


			$s->addElement( ffOneElement::TYPE_TABLE_START );


				$s->addElement(ffOneElement::TYPE_TABLE_DATA_START, '', __( 'Columns', 'zero') );
				$s->addOption(ffOneOption::TYPE_SELECT, 'column_count_xs', __( 'Phone', 'zero').' (XS) &nbsp;' , 1 )
					->addSelectNumberRange(1,2)
				;
				$s->addElement( ffOneElement::TYPE_HTML, '', ' &nbsp; '.__('Columns', 'zero') .', ' );
				$s->addOption(ffOneOption::TYPE_CHECKBOX, 'show_description_xs', __('Show description on hover', 'zero'), 1);
				$s->addElement(ffOneElement::TYPE_NEW_LINE );


				$s->addOption(ffOneOption::TYPE_SELECT, 'column_count_sm', __('Tablet', 'zero').' (SM) &nbsp;', 2 )
					->addSelectNumberRange(1,3)
				;
				$s->addElement( ffOneElement::TYPE_HTML, '', ' &nbsp; '.__('Columns', 'zero') .', ' );
				$s->addOption(ffOneOption::TYPE_CHECKBOX, 'show_description_sm', __('Show description on hover', 'zero'), 1);
				$s->addElement(ffOneElement::TYPE_NEW_LINE );


				$s->addOption(ffOneOption::TYPE_SELECT, 'column_count_md', __('Laptop', 'zero').' (MD) &nbsp;', 3 )
					->addSelectNumberRange(1,6)
				;
				$s->addElement( ffOneElement::TYPE_HTML, '', ' &nbsp; '.__('Columns', 'zero') .', ' );
				$s->addOption(ffOneOption::TYPE_CHECKBOX, 'show_description_md', __('Show description on hover', 'zero'), 1);
				$s->addElement(ffOneElement::TYPE_NEW_LINE );


				$s->addOption(ffOneOption::TYPE_SELECT, 'column_count_lg', __('Desktop', 'zero').' (LG) &nbsp;', 4 )
					->addSelectNumberRange(1,12)
				;
				$s->addElement( ffOneElement::TYPE_HTML, '', ' &nbsp; '.__('Columns', 'zero') .', ' );
				$s->addOption(ffOneOption::TYPE_CHECKBOX, 'show_description_lg', __('Show description on hover', 'zero'), 1);

			$s->addElement( ffOneElement::TYPE_TABLE_END );



			$s->addElement( ffOneElement::TYPE_TABLE_START );
				$s->addElement(ffOneElement::TYPE_TABLE_DATA_START, '', __('Show Portfolio items only from these categories', 'zero'));
					$s->startSection('loop-influence-portfolio-block');


						$s->addOption( ffOneOption::TYPE_TAXONOMY, 'categories', __('Categories', 'zero'), 'all')
							->addParam('tax_type', 'ff-portfolio-category')
							->addParam('type', 'multiple')
						;

					$s->endSection();

				$s->addElement(ffOneElement::TYPE_TABLE_DATA_END );
			$s->addElement( ffOneElement::TYPE_TABLE_END );

			$s->addElement( ffOneElement::TYPE_TABLE_START );
				$s->addElement(ffOneElement::TYPE_TABLE_DATA_START, '', __('Number of items to show', 'zero'));

						$s->addOption( ffOneOption::TYPE_TEXT, 'posts_per_page', '', '0' );
						$s->addElement( ffOneElement::TYPE_HTML, '', ' <span class="description"> '.__('Set <code>0</code> for no limit', 'zero').'</span>' );

				$s->addElement(ffOneElement::TYPE_TABLE_DATA_END );
			$s->addElement( ffOneElement::TYPE_TABLE_END );

		$s->endSection();

		return $s;
	}
}

