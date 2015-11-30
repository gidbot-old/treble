<?php
class ffPluginFreshCustomLoopContainer extends ffPluginContainerAbstract {
	/**
	 * @var ffPluginFreshFaviconContainer
	 */
	private static $_instance = null;

	const STRUCTURE_NAME = 'ff_fresh_favicon';

	/**
	 * @param ffContainer $container
	 * @param string $pluginDir
	 * @return ffPluginFreshCustomLoopContainer
	 */
	public static function getInstance( ffContainer $container = null, $pluginDir = null ) {
		if( self::$_instance == null ) {
			self::$_instance = new ffPluginFreshCustomLoopContainer($container, $pluginDir);
		}

		return self::$_instance;
	}
	
	protected function _registerFiles() {
		$pluginDir = $this->_getPluginDir();
		$classLoader =$this->getFrameworkContainer()->getClassLoader();
		
		$classLoader->addClass('ffAdminScreenCustomLoop', $pluginDir.'/adminScreens/customLoop/class.ffAdminScreenCustomLoop.php');
		$classLoader->addClass('ffAdminScreenCustomLoopViewDefault', $pluginDir.'/adminScreens/customLoop/class.ffAdminScreenCustomLoopViewDefault.php');
		
		$classLoader->addClass('ffOptionsHolderCustomLoop', $pluginDir.'/core/class.ffOptionsHolderCustomLoop.php');
		
		/*
		$pluginDir = $this->_getPluginDir();
		$classLoader =$this->getFrameworkContainer()->getClassLoader();

		$classLoader->addClass('ffAdminScreenFavicon', $pluginDir.'/adminScreens/favicon/class.ffAdminScreenFavicon.php');
		$classLoader->addClass('ffAdminScreenFaviconViewDefault', $pluginDir.'/adminScreens/favicon/class.ffAdminScreenFaviconViewDefault.php');

		$classLoader->addClass('ffOptionsHolderFavicon', $pluginDir.'/core/class.ffOptionsHolderFavicon.php');
		$classLoader->addClass('ffIconConvertor', $pluginDir.'/core/class.ffIconConvertor.php');*/

	}

}










