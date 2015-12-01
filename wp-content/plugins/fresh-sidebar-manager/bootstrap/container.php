<?php
class ffPluginFreshSidebarManagerContainer extends ffPluginContainerAbstract {

	/**
	 * @var ffPluginSidebarManagerContainer
	 */
	private static $_instance = null;

	/**
	 * @param ffContainer $container
	 * @param string $pluginDir
	 * @return ffPluginFreshSidebarManagerContainer
	 */
	public static function getInstance( ffContainer $container = null, $pluginDir = null ) {
		if( self::$_instance == null ) {
			self::$_instance = new ffPluginFreshSidebarManagerContainer($container, $pluginDir);
		}
		return self::$_instance;
	}
	
	public function getSidebarIdentificator() {
		$this->_getClassLoader()->loadClass('ffSidebarIdentificator');
		$sidebarIdentificator = new ffSidebarIdentificator(
			$this->getFrameworkContainer()->getWPLayer()		
		);
		
		return $sidebarIdentificator;
	}
	
	public function getSidebarWidgetLogicManager() {
		$this->_getClassLoader()->loadClass('ffSidebarWidgetLogicManager');
		
		$sidebarWidgetLogicManager = new ffSidebarWidgetLogicManager(
			$this->getFrameworkContainer()->getWPLayer(),
			$this->getFrameworkContainer()->getDataStorageFactory()->createDataStorageWPOptionsNamespace( ffPluginFreshSidebarManager::NAMESPACE_WIDGET_LIMITER ),
			$this->getFrameworkContainer()->getRequest()
		);
		
		return $sidebarWidgetLogicManager;
	}

	protected function _registerFiles() {
		$pluginDir = $this->_getPluginDir();

		$classLoader = $this->getFrameworkContainer()->getClassLoader(); 

		$classLoader->addClass('ffAdminScreenSidebarManager', $pluginDir.'/adminScreens/SidebarManager/class.ffAdminScreenSidebarManager.php');
		$classLoader->addClass('ffAdminScreenSidebarManagerViewDefault', $pluginDir.'/adminScreens/SidebarManager/class.ffAdminScreenSidebarManagerViewDefault.php');
		
		$classLoader->addClass('ffSidebarIdentificator', $pluginDir.'/core/class.ffSidebarIdentificator.php');
		
		$classLoader->addClass('ffSidebarWidgetLogicManager', $pluginDir.'/core/class.ffSidebarWidgetLogicManager.php');
	}
}