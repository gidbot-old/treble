<?php

class ffThemeOptionsHolder extends ffOptionsHolder {

	public function getOptions() {

		$s = $this->_getOnestructurefactory()->createOneStructure( ffThemeContainer::OPTIONS_NAME );

		$s->startSection( ffThemeContainer::OPTIONS_NAME, ffOneSection::TYPE_NORMAL );


////////////////////////////////////////////////////////////////////////////////
// FONTS
////////////////////////////////////////////////////////////////////////////////


		$s->addElement( ffOneElement::TYPE_HTML, 'TYPE_HTML', '<div class="ff-theme-mix-admin-tab-fonts ff-theme-mix-admin-tab-content">' );

		$s->startSection('font');

			$s->addElement( ffOneElement::TYPE_HEADING, '', __( 'Fonts', 'zero') );

			$s->addElement( ffOneElement::TYPE_TABLE_START );

				$font_types = array(
					'body-text'				=> "'Raleway'" ,
					'inputs'				=> "'Raleway'" ,
					'buttons'				=> "'Raleway'" ,
					'code'					=> "'Courier New', Courier, monospace" ,
					'blockquote'			=> "'Raleway'" ,
					'headers'				=> "'Raleway'" ,
					'page-post-title'		=> "'Raleway'" ,
					'small-text'			=> "'Raleway'" ,
					'menu-button-label'		=> "'Raleway'" ,
					'side-menu-navigation'	=> "'Raleway'" ,
					'footer-body-text'		=> "'Raleway'" ,
					'footer-widget-title'	=> "'Raleway'" ,
				);

				foreach ($font_types as $title => $default) {
					$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', ucfirst($title));
						$s->addOption( ffOneOption::TYPE_FONT, $title, 'Family ', $default);
					$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );
				}

			$s->addElement( ffOneElement::TYPE_TABLE_END );

		$s->endSection();

		$s->addElement( ffOneElement::TYPE_HTML, 'TYPE_HTML', '</div>' );


////////////////////////////////////////////////////////////////////////////////
// HEADER
////////////////////////////////////////////////////////////////////////////////


		$s->addElement( ffOneElement::TYPE_HTML, 'TYPE_HTML', '<div class="ff-theme-mix-admin-tab-header ff-theme-mix-admin-tab-content">' );

		require locate_template('templates/sections/header-1/header-1-section.php');

		$s->addElement( ffOneElement::TYPE_HTML, 'TYPE_HTML', '</div>' );


////////////////////////////////////////////////////////////////////////////////
// SIDE MENU
////////////////////////////////////////////////////////////////////////////////


		$s->addElement( ffOneElement::TYPE_HTML, 'TYPE_HTML', '<div class="ff-theme-mix-admin-tab-side-menu ff-theme-mix-admin-tab-content">' );

		require locate_template('templates/sections/side-menu-1/side-menu-1-section.php');

		$s->addElement( ffOneElement::TYPE_HTML, 'TYPE_HTML', '</div>' );


////////////////////////////////////////////////////////////////////////////////
// POST
////////////////////////////////////////////////////////////////////////////////


		$s->addElement( ffOneElement::TYPE_HTML, 'TYPE_HTML', '<div class="ff-theme-mix-admin-tab-posts ff-theme-mix-admin-tab-content">' );

		require locate_template('templates/sections/blog-post-1/blog-post-1-section.php');

		$s->addElement( ffOneElement::TYPE_HTML, 'TYPE_HTML', '</div>' );


////////////////////////////////////////////////////////////////////////////////
// COMMENTS
////////////////////////////////////////////////////////////////////////////////


		$s->addElement( ffOneElement::TYPE_HTML, 'TYPE_HTML', '<div class="ff-theme-mix-admin-tab-comments ff-theme-mix-admin-tab-content">' );
		$s->startSection('comments');
			$s->addElement( ffOneElement::TYPE_HEADING, '', __( 'Comments General Settings', 'zero')  );

			$s->addElement( ffOneElement::TYPE_TABLE_START );

				require locate_template('templates/blocks/comments-list-1/comments-list-1-block.php');
				require locate_template('templates/blocks/comments-form-1/comments-form-1-block.php');

			$s->addElement( ffOneElement::TYPE_TABLE_END );
		$s->endSection();

		$s->addElement( ffOneElement::TYPE_HTML, 'TYPE_HTML', '</div>' );


////////////////////////////////////////////////////////////////////////////////
// SEARCH
////////////////////////////////////////////////////////////////////////////////


		$s->addElement( ffOneElement::TYPE_HTML, 'TYPE_HTML', '<div class="ff-theme-mix-admin-tab-search ff-theme-mix-admin-tab-content">' );

		$s->startSection('search');
			$s->addElement( ffOneElement::TYPE_HEADING, '', __( 'Search General Settings', 'zero')  );

			$s->addElement( ffOneElement::TYPE_TABLE_START );

				require locate_template('templates/sections/search-404-1/search-404-1-section.php');

			$s->addElement( ffOneElement::TYPE_TABLE_END );
		$s->endSection();

		$s->addElement( ffOneElement::TYPE_HTML, 'TYPE_HTML', '</div>' );


////////////////////////////////////////////////////////////////////////////////
// 404
////////////////////////////////////////////////////////////////////////////////


		$s->addElement( ffOneElement::TYPE_HTML, 'TYPE_HTML', '<div class="ff-theme-mix-admin-tab-404 ff-theme-mix-admin-tab-content">' );

		require locate_template('templates/sections/404-1/404-1-section.php');

		$s->addElement( ffOneElement::TYPE_HTML, 'TYPE_HTML', '</div>' );


////////////////////////////////////////////////////////////////////////////////
// LOADER
////////////////////////////////////////////////////////////////////////////////


		$s->addElement( ffOneElement::TYPE_HTML, 'TYPE_HTML', '<div class="ff-theme-mix-admin-tab-loader ff-theme-mix-admin-tab-content">' );

		require locate_template('templates/blocks/loader-1/loader-1-block.php');

		$s->addElement( ffOneElement::TYPE_HTML, 'TYPE_HTML', '</div>' );



////////////////////////////////////////////////////////////////////////////////
// FOOTER
////////////////////////////////////////////////////////////////////////////////


		$s->addElement( ffOneElement::TYPE_HTML, 'TYPE_HTML', '<div class="ff-theme-mix-admin-tab-footer ff-theme-mix-admin-tab-content">' );

		$s->startSection('footer');

			require locate_template('templates/sections/footer-1/footer-1-section.php');
			require locate_template('templates/sections/footer-2/footer-2-section.php');

		$s->endSection();

		$s->addElement( ffOneElement::TYPE_HTML, 'TYPE_HTML', '</div>' );


////////////////////////////////////////////////////////////////////////////////
// PORTFOLIO SLUGS
////////////////////////////////////////////////////////////////////////////////


		$s->addElement( ffOneElement::TYPE_HTML, 'TYPE_HTML', '<div class="ff-theme-mix-admin-tab-portfolio ff-theme-mix-admin-tab-content">' );

		$s->startSection('portfolio');

			$s->addElement( ffOneElement::TYPE_HEADING, '', __( 'General', 'zero')  );

				$s->addElement( ffOneElement::TYPE_TABLE_START );

				$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', __( 'Back To Portfolio Button URL Link', 'zero') );
				$s->addOption( ffOneOption::TYPE_TEXT, 'back_to_portfolio_url', '', home_url( '/' ) );
				$s->addElement( ffOneElement::TYPE_DESCRIPTION, '', __( 'Insert your Portfolio URL', 'zero')  );

				$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', __('Portfolio footer meta', 'zero') );
				$s->addOption( ffOneOption::TYPE_CHECKBOX, 'single_portfolio_post_footer', __( 'Show post footer meta on Single Portfolio Post view', 'zero') , 0);
				$s->addElement( ffOneElement::TYPE_DESCRIPTION, '', __( 'Permalink, Share, Comments - you can change translations of these in Theme Options tab panel <strong>Posts</strong>.', 'zero')  );

				$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

			$s->addElement( ffOneElement::TYPE_TABLE_END );

			$s->addElement( ffOneElement::TYPE_HEADING, '', __( 'Portfolio Slugs', 'zero')  );

				$s->addElement( ffOneElement::TYPE_TABLE_START );

				$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', __( 'Portfolio post', 'zero') );
				$s->addOption( ffOneOption::TYPE_TEXT, 'portfolio_slug', __( 'Slug', 'zero') , 'portfolio-post');
				$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

				$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', __( 'Portfolio Category', 'zero') );
				$s->addOption( ffOneOption::TYPE_TEXT, 'portfolio_category_slug', __( 'Slug', 'zero') , 'portfolio-category');
				$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

				$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', __( 'Portfolio Tag', 'zero') );
				$s->addOption( ffOneOption::TYPE_TEXT, 'portfolio_tag_slug', __( 'Slug', 'zero') , 'portfolio-tag');
				$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

			$s->addElement( ffOneElement::TYPE_TABLE_END );
		$s->endSection();

		$s->addElement( ffOneElement::TYPE_HTML, 'TYPE_HTML', '</div>' );


////////////////////////////////////////////////////////////////////////////////
// SAVE
////////////////////////////////////////////////////////////////////////////////


		$s->addElement( ffOneElement::TYPE_NEW_LINE );
		$s->addElement( ffOneElement::TYPE_BUTTON_PRIMARY, __( 'Save', 'zero') , __( 'Save Changes', 'zero')  );

		$s->endSection();

		return $s;
	}

}










