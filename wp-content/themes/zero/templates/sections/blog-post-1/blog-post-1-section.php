<?php
/** @var ffOneStructure $s */

$s->addElement( ffOneElement::TYPE_HEADING, '', __('Post Settings', 'zero') );

$s->startSection('post');
	$s->addElement( ffOneElement::TYPE_TABLE_START );

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', __('Post expanding/collapsing in category view', 'zero') );
			$s->addOption(ffOneOption::TYPE_SELECT, 'posts-opening', '', 'post-cookie-opening')
				->addSelectValue( __('Disable expanding and collapsing', 'zero') , 'posts-opening-closing-disabled')
				->addSelectValue( __('Always expanded between page reloads', 'zero') , 'posts-opened')
				->addSelectValue( __('Always collapsed between page reloads', 'zero') , 'post-closed')
				->addSelectValue( __('Use cookies to remember which posts are expanded/collapsed between page reloads', 'zero') , 'post-cookie-opening')
				;
		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', __('Post Article Head', 'zero') ) ;

			$s->addOption( ffOneOption::TYPE_CHECKBOX, 'show-date', __('Show Date&nbsp;', 'zero') , 1);
			$s->addOption( ffOneOption::TYPE_TEXT, 'date-format', __(' in Format', 'zero') , 'F j, Y');
			$s->addElement( ffOneElement::TYPE_DESCRIPTION, '', __('For right date format please see <a href="//php.net/manual/en/function.date.php" target="_blank">Date PHP function manual</a>.', 'zero')  );
			$s->addElement( ffOneElement::TYPE_NEW_LINE );

			$s->addOption( ffOneOption::TYPE_CHECKBOX, 'show-author', __('Show Author', 'zero') , 1);
			$s->addElement( ffOneElement::TYPE_NEW_LINE );

			$s->addOption( ffOneOption::TYPE_CHECKBOX, 'show-categories', __('Show Categories', 'zero') , 1);
			$s->addElement( ffOneElement::TYPE_NEW_LINE );

			$s->addOption( ffOneOption::TYPE_CHECKBOX, 'show-tags', __('Show Tags', 'zero') , 1);
			$s->addElement( ffOneElement::TYPE_NEW_LINE );

			$s->addOption( ffOneOption::TYPE_CHECKBOX, 'show-comment-count', __('Show Comment Counter', 'zero') , 0);
			$s->addElement( ffOneElement::TYPE_NEW_LINE );
			$s->addOption( ffOneOption::TYPE_TEXT, 'comment-zero', __('No Comments', 'zero') , __('Comments (0)', 'zero') );
			$s->addElement(ffOneElement::TYPE_NEW_LINE );

			$s->addOption( ffOneOption::TYPE_TEXT, 'comment-one', __('1 Comment', 'zero') , __('Comments (1)', 'zero') );
			$s->addElement(ffOneElement::TYPE_NEW_LINE );

			$s->addOption( ffOneOption::TYPE_TEXT, 'comment-more', __('%s Comments', 'zero') , __('Comments (%s)', 'zero') );
			$s->addElement( ffOneElement::TYPE_NEW_LINE );
			$s->addElement( ffOneElement::TYPE_NEW_LINE );

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', __('Post Article Footer', 'zero') );

			$s->addOption( ffOneOption::TYPE_CHECKBOX, 'show-read-more', __('Show "Read More"&nbsp;', 'zero') , 1);
			$s->addOption( ffOneOption::TYPE_TEXT, 'read-more', __(' with text', 'zero') , __('Read More', 'zero') );
			$s->addElement( ffOneElement::TYPE_NEW_LINE );

			$s->addOption( ffOneOption::TYPE_CHECKBOX, 'show-permalink', __('Show "Permalink",&nbsp;', 'zero') , 1);
			$s->addOption( ffOneOption::TYPE_TEXT, 'permalink', __(' with text', 'zero') , __('Permalink', 'zero') );
			$s->addElement( ffOneElement::TYPE_NEW_LINE );

			$s->addOption( ffOneOption::TYPE_CHECKBOX, 'show-share', __('Show "Share",&nbsp;', 'zero') , 1);
			$s->addOption( ffOneOption::TYPE_TEXT, 'share', __(' with text', 'zero') , __('Share', 'zero') );
			$s->addElement( ffOneElement::TYPE_NEW_LINE );
			$s->addElement( ffOneElement::TYPE_NEW_LINE );

			$s->startSection('social-networks', ffOneSection::TYPE_REPEATABLE_VARIABLE);
				$s->startSection('one-social-network', ffOneSection::TYPE_REPEATABLE_VARIATION)
					->addParam('section-name', __('Share on', 'zero') );

					// Social network list

					$socialNetworkOptionSelect = $s->addOption( ffOneOption::TYPE_SELECT, 'type', __('Social Network', 'zero') , 'facebook');

					$socialNetworkList = ffContainer::getInstance()->getThemeFrameworkFactory()->getSocialSharerFeedCreator()->getThePossibleList();

					foreach ($socialNetworkList as $snID=>$snVal) {
						$socialNetworkOptionSelect->addSelectValue( $snVal['title'], $snID );
					}

				$s->endSection();
			$s->endSection();
			$s->addElement( ffOneElement::TYPE_NEW_LINE );

			$s->addOption( ffOneOption::TYPE_CHECKBOX, 'show-discussion', __('Show Comment Counter', 'zero') , 1);
			$s->addElement( ffOneElement::TYPE_NEW_LINE );
			$s->addOption( ffOneOption::TYPE_TEXT, 'discussion-zero', __('No Comments', 'zero') , __('Comments (0)', 'zero') );
			$s->addElement(ffOneElement::TYPE_NEW_LINE );

			$s->addOption( ffOneOption::TYPE_TEXT, 'discussion-one', __('1 Comment', 'zero') , __('Comments (1)', 'zero') );
			$s->addElement(ffOneElement::TYPE_NEW_LINE );

			$s->addOption( ffOneOption::TYPE_TEXT, 'discussion-more', __('%s Comments', 'zero') , __('Comments (%s)', 'zero') );
			$s->addElement( ffOneElement::TYPE_NEW_LINE );
			$s->addElement( ffOneElement::TYPE_NEW_LINE );

			$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );
	$s->addElement( ffOneElement::TYPE_TABLE_END );
$s->endSection();



