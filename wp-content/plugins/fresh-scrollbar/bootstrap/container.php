<?php
class ffPluginScrollbarContainer extends ffPluginContainerAbstract {

	/**
	 * @var ffPluginScrollbarContainer
	 */
	private static $_instance = null;

	/**
	 * @param ffContainer $container
	 * @param string $pluginDir
	 * @return ffPluginScrollbarContainer
	 */
	public static function getInstance( ffContainer $container = null, $pluginDir = null ) {
		if( self::$_instance == null ) {
			self::$_instance = new ffPluginScrollbarContainer($container, $pluginDir);
		}
		return self::$_instance;
	}

	protected function _registerFiles() {
		$pluginDir = $this->_getPluginDir();

		$classLoader = $this->getFrameworkContainer()->getClassLoader(); 

		$classLoader->addClass('ffAdminScreenScrollbar', $pluginDir.'/adminScreens/scrollbar/class.ffAdminScreenScrollbar.php');
		$classLoader->addClass('ffAdminScreenScrollbarViewDefault', $pluginDir.'/adminScreens/scrollbar/class.ffAdminScreenScrollbarViewDefault.php');
		$classLoader->addClass('ffScrollbarAdminOptionsHolder', $pluginDir.'/core/class.ffScrollbarAdminOptionsHolder.php');
		$classLoader->addClass('ffScrollbarDefaultOptionsGenerator', $pluginDir.'/core/class.ffScrollbarDefaultOptionsGenerator.php');
		
	}
	
	
	public function getScrollbarDefaultOptionsGenerator() {
		$this->_getClassLoader()->loadClass('ffScrollbarDefaultOptionsGenerator');
		//( $pluginDir, ffFileSystem $fileSystem, ffLessVariableParser $lessVariableParser, ffOptionsArrayConvertor $optionsArrayConvertor ) {
		$generator = new ffScrollbarDefaultOptionsGenerator(
			$this->getPluginDir(),
			$this->getFrameworkContainer()->getFileSystem(),
			$this->getFrameworkContainer()->getAssetsIncludingFactory()->getLessVariableParser(),
			$this->getFrameworkContainer()->getOptionsFactory()->createOptionsArrayConvertor()
		);
		
		return $generator;
	}
}