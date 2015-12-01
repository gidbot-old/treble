<?php

class ffOptionsHolderCustomLoop extends ffOptionsHolder {

	public function getOptions() {

		/*

	$catop->addCategoryOption('select', 'order', 'default', 'Order', array( array('name'=> __('Default', ffgtd()), 'id'=>'default' ), array('name'=> __('Asc', ffgtd()), 'id'=>'asc' ) ,  array('name'=> __('Desc', ffgtd()), 'id'=>'Desc' ) )  );
	
	
	$catop->addCategoryOption('select', 'order_by', 'default', 'Order By', array(  array('name'=> __('Default', ffgtd()), 'id'=>'default' ), array('name'=> __('ID', ffgtd()), 'id'=>'ID' ), array('name'=> __('Author', ffgtd()), 'id'=>'author' ) ,  array('name'=> __('Title', ffgtd()), 'id'=>'title' )
																		,  array('name'=> __('Date', ffgtd()), 'id'=>'date' )
																		,  array('name'=> __('Modified', ffgtd()), 'id'=>'modified' )
																		,  array('name'=> __('Parent', ffgtd()), 'id'=>'parent' )
																		,  array('name'=> __('Rand', ffgtd()), 'id'=>'rand' )
																		,  array('name'=> __('Comment Count', ffgtd()), 'id'=>'comment_count' ) )  );

		*/

		$s = $this->_getOnestructurefactory()->createOneStructure( ffPluginFreshCustomLoop::OPTIONS_NAMESPACE );

		$s->startSection('custom-loop', ffOneSection::TYPE_REPEATABLE_VARIABLE )
		// ->addParam('class', 'enable-delete-all-repeatable-items')
		;
			$s->startSection('custom-loop'.'-item', ffOneSection::TYPE_REPEATABLE_VARIATION)->addParam('section-name', 'Custom Loops');
			
				$s->addElement( ffOneElement::TYPE_TABLE_START );

				$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', '<h2 style="margin:0 0 -20px 0; border-bottom: 1px solid #ddd; padding: 0 0 3px 0; display: inline;">General</h2>');
					$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

					$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Name');
						$s->addOption(ffOneOption::TYPE_TEXT, 'custom_loop_name', '', '')
							->addParam('placeholder', 'My Loop')
							->addParam('class', 'edit-repeatable-item-title')
							;
						$s->addOption(ffOneOption::TYPE_TEXT, 'sidebar_slug', '', '' )
							->addParam('class','hidden')
							;
					$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

					$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Description');
						$s->addOption(ffOneOption::TYPE_TEXT, 'sidebar_description', '', '')
							->addParam('class','widefat')
							->addParam('class', 'edit-repeatable-item-description')
							;
					$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

					$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );
					
					$s->addElement( ffOneElement::TYPE_TABLE_DATA_START,'', 'Conditional Logic');
						$s->addOption(ffOneOption::TYPE_CONDITIONAL_LOGIC, 'conditional_logic', 'conditional_logic' );
					$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

				$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', '<h2 style="margin:0 0 -20px 0; border-bottom: 1px solid #ddd; padding: 0 0 3px 0; display: inline;">Loop Options</h2>');
					$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

					$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Posts per page');
						
						$s->addOption(ffOneOption::TYPE_NUMBER, 'posts_per_page', '', 0);
						$s->addElement(ffOneElement::TYPE_HTML,'',' ( 0 = no limit )');
						
						//$s->addOption(ffOneOption::TYPE_NUMBER, 'numberposts', 'Number of posts ( 0 = no limit )', 0);
						
					$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );


					$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Order');
					
						$s->addOption(ffOneOption::TYPE_SELECT, 'order', 'Order ', 'desc')
						->addSelectValue('Asc - (1,2,3)', 'asc')
						->addSelectValue('Desc - (3,2,1)', 'desc')
						;
						
						$s->addOption(ffOneOption::TYPE_SELECT, 'order_by', '&nbsp;by ', 'default')
						->addSelectValue('Default', 'default')
						->addSelectValue('ID', 'id')
						->addSelectValue('Author', 'author')
						->addSelectValue('Title', 'title')
						->addSelectValue('Date', 'date')
						->addSelectValue('Modified', 'modified')
						->addSelectValue('Parent', 'parent')
						->addSelectValue('Rand', 'rand')
						->addSelectValue('Comment Count', 'comment_count');
						
					$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

					$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Image');

						$s->addOption(ffOneOption::TYPE_CHECKBOX, 'must_have_featured_image', 'Only include posts that have a featured image', 0);
						
					$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

					$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Offset');

						$s->addOption(ffOneOption::TYPE_NUMBER, 'offset', 'Exclude', 0);
						$s->addElement(ffOneElement::TYPE_HTML,'',' latest posts');
						
					$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );
					
					$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Categorized in');
						
					$s->addElement(ffOneElement::TYPE_HTML,'','<span style="padding-bottom: 3px; display: block;">Only include posts that are categorized in these categories:</span>');
							$s->addOption(ffOneOption::TYPE_TAXONOMY, 'category_include', 'Category Include ', '')
							->addParam('tax_type', 'category')
							->addParam('type', 'multiple');
							;

						$s->addElement(ffOneElement::TYPE_NEW_LINE,'','');

						$s->addElement(ffOneElement::TYPE_HTML,'','<span style="padding-bottom: 3px; display: block;">Never include posts that are categorized in these categories:</span>');
							$s->addOption(ffOneOption::TYPE_TAXONOMY, 'category_exclude', 'Category Exclude ', '')
								->addParam('tax_type', 'category')
								->addParam('type', 'multiple');
								;
					
					$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );
					
					
					$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Tagged with');
					
					$s->addElement(ffOneElement::TYPE_HTML,'','<span style="padding-bottom: 3px; display: block;">Only include posts that are tagged with these tags:</span>');
						$s->addOption(ffOneOption::TYPE_TAXONOMY, 'tag_include', 'Tags Include ', '')
						->addParam('tax_type', 'post_tag')
						->addParam('type', 'multiple');
						;
							
						$s->addElement(ffOneElement::TYPE_NEW_LINE,'','');						
						
						$s->addElement(ffOneElement::TYPE_HTML,'','<span style="padding-bottom: 3px; display: block;">Never include posts that are tagged with these tags:</span>');
						$s->addOption(ffOneOption::TYPE_TAXONOMY, 'tag_exclude', 'Tags Exclude ', '')
						->addParam('tax_type', 'post_tag')
						->addParam('type', 'multiple');
					;
						
					$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );
					
					$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Authored by');
						
					
					$s->addElement(ffOneElement::TYPE_HTML,'','<span style="padding-bottom: 3px; display: block;">Only include posts that are authored by these users:</span>');
							$s->addOption(ffOneOption::TYPE_USERS, 'user_include', 'Users Include ', '')
							->addParam('tax_type', 'post_tag')
							->addParam('type', 'multiple');
							;
							
							$s->addElement(ffOneElement::TYPE_NEW_LINE,'','');
							
							$s->addElement(ffOneElement::TYPE_HTML,'','<span style="padding-bottom: 3px; display: block;">Never include posts that are authored by these users:</span>');
							$s->addOption(ffOneOption::TYPE_USERS, 'user_exclude', 'Users Exclude ', '')
							->addParam('tax_type', 'post_tag')
							->addParam('type', 'multiple');
							;
							
					
					$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );			

					
					$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Comment Count');
					 						
						$s->addOption(ffOneOption::TYPE_NUMBER, 'comment_count_lower', 'Only include posts that have less than', '');		
							$s->addElement(ffOneElement::TYPE_HTML,'',' comments');	 

						$s->addElement(ffOneElement::TYPE_NEW_LINE,'','');		
					
						$s->addOption(ffOneOption::TYPE_NUMBER, 'comment_count_greater', 'Only include posts that have more than', '');
							$s->addElement(ffOneElement::TYPE_HTML,'',' comments');
						
					$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );
					
					
					$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Absolute Age');
					
						$s->addOption(ffOneOption::TYPE_DATEPICKER, 'date_old_max_absolute', 'Only include posts that were posted after this date:', '');
						$s->addOption(ffOneOption::TYPE_DATEPICKER, 'date_old_min_absolute', 'Only include posts that were posted before this date:', '');
						
					$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

					$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Relative Age');

						$s->addElement(ffOneElement::TYPE_DESCRIPTION,'',' Example of allowed format: 1 day, 2 days, 1 month, 2 months, 1 year, 2 years, etc. ');
						$s->addElement(ffOneElement::TYPE_NEW_LINE,'','');
						
						$s->addOption(ffOneOption::TYPE_TEXT, 'date_older_max_relative', 'Only include posts that are no more than', '')
							->addParam('placeholder', '1 month');
						$s->addElement(ffOneElement::TYPE_HTML,'',' old');
						$s->addOption(ffOneOption::TYPE_TEXT, 'date_older_min_relative', 'Only include posts that are at least ', '')
							->addParam('placeholder', '2 days');
						$s->addElement(ffOneElement::TYPE_HTML,'',' old');
						$s->addElement(ffOneElement::TYPE_NEW_LINE,'','');
						$s->addElement(ffOneElement::TYPE_NEW_LINE,'','');
						$s->addElement(ffOneElement::TYPE_NEW_LINE,'','');
						
					$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );
				
				$s->addElement(ffOneElement::TYPE_TABLE_END);
			
			$s->endSection();
		$s->endSection();

		return $s;
	}

}












