<?php

class ffThemeContainer extends ffThemeContainerAbstract {

	const OPTIONS_HOLDER    = 'ffThemeOptionsHolder';
	const OPTIONS_PREFIX    = 'ff_options';
	const OPTIONS_NAMESPACE = 'theme_hoax';
	const OPTIONS_NAME      = 'theme_options';
	const THEME_NAME_LOW    = 'hoax';


	/**
	 * @var ffThemeContainer
	 */
	private static $_instance = null;

	/**
	 * @param ffContainer $container
	 * @param string $pluginDir
	 * @return ffThemeContainer
	 */
	public static function getInstance( ffContainer $container = null, $pluginDir = null ) {
		if( self::$_instance == null ) {
			self::$_instance = new ffThemeContainer($container, $pluginDir);
		}
		return self::$_instance;
	}

	protected function _registerFiles() {

		$this->_registerThemeFile('ffAdminScreenThemeOptions', '/framework/adminScreens/ThemeOptions/class.ffAdminScreenThemeOptions.php');
		$this->_registerThemeFile('ffAdminScreenThemeOptionsViewDefault', '/framework/adminScreens/ThemeOptions/class.ffAdminScreenThemeOptionsViewDefault.php');

		$this->_registerThemeFile('ffThemeOptionsHolder', '/framework/core/class.ffThemeOptionsHolder.php');
		$this->_registerThemeFile('ffThemeOptions', '/framework/core/class.ffThemeOptions.php');

		$this->_registerThemeFile('ffComponent_Theme_LayoutOptions', '/framework/components/class.ffComponent_Theme_LayoutOptions.php');

		$this->_registerThemeFile('ffThemeLayoutPreparator', '/framework/core/class.ffThemeLayoutPreparator.php');
		$this->getFrameworkContainer()->getClassLoader()->loadClass( 'ffThemeOptions' );

		$this->getFrameworkContainer()->getClassLoader()->loadClass( 'externFreshizer' );

		$this->_registerThemeFile('ffThemeAssetsIncluder', '/framework/theme/class.ffThemeAssetsIncluder.php');

		$this->_registerThemeFile('ffMetaBoxContactPage', '/framework/adminScreens/metaBoxes/metaBoxContactPage/class.ffMetaBoxContactPage.php');
		$this->_registerThemeFile('ffMetaBoxContactPageView', '/framework/adminScreens/metaBoxes/metaBoxContactPage/class.ffMetaBoxContactPageView.php');
		$this->_registerThemeFile('ffComponent_Theme_MetaboxContactPage_View', '/framework/components/class.ffComponent_Theme_MetaboxContactPage_View.php');

		$this->_registerThemeFile('ffMetaBoxPagePortfolio', '/framework/adminScreens/metaBoxes/metaBoxPagePortfolio/class.ffMetaBoxPagePortfolio.php');
		$this->_registerThemeFile('ffMetaBoxPagePortfolioView', '/framework/adminScreens/metaBoxes/metaBoxPagePortfolio/class.ffMetaBoxPagePortfolioView.php');
		$this->_registerThemeFile('ffComponent_Theme_MetaboxPage_PortfolioView', '/framework/components/class.ffComponent_Theme_MetaboxPage_PortfolioView.php');

		$this->_registerThemeFile('ffMetaBoxPagePortfolioBottom', '/framework/adminScreens/metaBoxes/metaBoxPagePortfolioBottom/class.ffMetaBoxPagePortfolioBottom.php');
		$this->_registerThemeFile('ffMetaBoxPagePortfolioBottomView', '/framework/adminScreens/metaBoxes/metaBoxPagePortfolioBottom/class.ffMetaBoxPagePortfolioBottomView.php');
		$this->_registerThemeFile('ffComponent_Theme_MetaboxPage_PortfolioBottomView', '/framework/components/class.ffComponent_Theme_MetaboxPage_PortfolioBottomView.php');

		$this->_registerThemeFile('ffComponent_TwitterWidget_OptionsHolder', '/framework/components/widgets/twitter/class.ffComponent_TwitterWidget_OptionsHolder.php');
		$this->_registerThemeFile('ffComponent_TwitterWidget_Printer', '/framework/components/widgets/twitter/class.ffComponent_TwitterWidget_Printer.php');
		$this->_registerThemeFile('ffWidgetTwitter', '/framework/components/widgets/twitter/class.ffWidgetTwitter.php');

	}

	private $_themeLayoutPreparator = null;

	public function getThemeLayoutPreparator() {
		if( $this->_themeLayoutPreparator == null ) {
			$this->getFrameworkContainer()->getClassLoader()->loadClass('ffThemeLayoutPreparator');
			$this->_themeLayoutPreparator = new ffThemeLayoutPreparator( $this->getFrameworkContainer()->getWPLayer() );
		}

		return $this->_themeLayoutPreparator;
	}

}