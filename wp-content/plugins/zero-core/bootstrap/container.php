<?php
class ffPluginZeroCoreContainer extends ffPluginContainerAbstract {
	/**
	 * @var ffPluginZeroCore
	 */
	private static $_instance = null;

	const STRUCTURE_NAME = 'ff_fresh_favicon';

	/**
	 * @param ffContainer $container
	 * @param string $pluginDir
	 * @return ffPluginZeroCoreContainer
	 */
	public static function getInstance( ffContainer $container = null, $pluginDir = null ) {
		if( self::$_instance == null ) {
			self::$_instance = new ffPluginZeroCoreContainer($container, $pluginDir);
		}
		return self::$_instance;
	}

	protected function _registerFiles() {
	}
}

