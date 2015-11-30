<?php

class ffPluginZeroCore extends ffPluginAbstract {
	/**
	 *
	 * @var ffPluginZeroCoreContainer
	 */
	protected $_container = null;

	protected function _registerAssets() { }

	protected function _run() {
		add_action('after_setup_theme', array( $this, 'registerCustomPostTypes' ) );
		require dirname( dirname( __FILE__ ) ).'/shortcodes.php';
	}

	public function registerCustomPostTypes() {
		$portfolioSlug = 'ff-portfolio';
		$portfolioTagSlug = 'ff-portfolio-tag';
		$portfolioCategorySlug = 'ff-portfolio-category';

		if( class_exists('ffThemeOptions') ) {

			if( ffThemeOptions::getQuery()->queryExists( 'theme_options portfolio portfolio_slug') ){
				$portfolioSlug = ffThemeOptions::getQuery( 'portfolio portfolio_slug' );
			}else{
				$portfolioSlug = 'ff-portfolio';
			}
			if( ffThemeOptions::getQuery()->queryExists( 'theme_options portfolio portfolio_tag_slug') ){
				$portfolioTagSlug = ffThemeOptions::getQuery('portfolio portfolio_tag_slug' );
			}else{
				$portfolioTagSlug = 'ff-portfolio-tag';
			}
			if( ffThemeOptions::getQuery()->queryExists( 'theme_options portfolio portfolio_category_slug') ){
				$portfolioCategorySlug = ffThemeOptions::getQuery('portfolio portfolio_category_slug' );
			}else{
				$portfolioCategorySlug = 'ff-portfolio-category';
			}

		}

		$fwc = $this->_getContainer()->getFrameworkContainer();

		// Portfolio - Custom Post Type
		$ptPortfolio = $fwc->getPostTypeRegistratorManager()
			->addPostTypeRegistrator('portfolio', 'Portfolio');

		$ptPortfolio->getArgs()->set('rewrite', array( 'slug' => $portfolioSlug ));
		$ptPortfolio->getSupports()->set('comments', true);
		$ptPortfolio->getSupports()->set('post-formats', true);

		// Portfolio Tag - Custom Taxonomy
		$taxPortfolioTag = $fwc->getCustomTaxonomyManager()
			->addCustomTaxonomy('ff-portfolio-tag', 'Portfolio Tag');
		$taxPortfolioTag->connectToPostType( 'portfolio' );

		$taxPortfolioTag->getArgs()->set('rewrite', array( 'slug' => $portfolioTagSlug ));

		// Portfolio Category - Custom Taxonomy
		$taxPortfolioCategory = $fwc->getCustomTaxonomyManager()
			->addCustomTaxonomy('ff-portfolio-category', 'Portfolio Category');
		$taxPortfolioCategory->setCategoryBehaviour();
		$taxPortfolioCategory->connectToPostType('portfolio');

		$taxPortfolioCategory->getArgs()->set('rewrite', array( 'slug' => $portfolioCategorySlug));


	}

	protected function _registerActions() { }

	protected function _setDependencies() { }


	/**
	 * @return ffPluginZeroCoreContainer
	 */
	protected function _getContainer() {
		return $this->_container;
	}
}