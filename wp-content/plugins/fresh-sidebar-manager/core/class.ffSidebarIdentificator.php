<?php

class ffSidebarIdentificator extends ffBasicObject {

	/**
	 * 
	 * @var ffWPLayer
	 */
	private $WPLayer = null;
	
	public function __construct( ffWPLayer $WPLayer ) {
		$this->_setWPLayer($WPLayer);
	}
	
	public function getActiveSidebarsList() {
		$registeredSidebars  = $this->_getWPLayer()->get_wp_registered_sidebars();
		
		$list = array();
		
		foreach( $registeredSidebars as $oneSidebarDefinition ) {
			$newValue = array( 'name'=> $oneSidebarDefinition['name'], 'value'=>$oneSidebarDefinition['id']);
			$list[] = $newValue;
		}
		
		return $list;
 		//$this->_getWPLayer()->action_been_executed($actionName);
		//	global $wp_registered_sidebars;
		//	var_dump($wp_registered_sidebars);
		
		//	foreach ($wp_registered_sidebars as $sb_definition) {
		//		$sb->addSelectValue( $sb_definition['name'], $sb_definition['id'] );
		//	}
 
	}
	protected function _getWPLayer() {
		return $this->_WPLayer;
	}
	protected function _setWPLayer(ffWPLayer $WPLayer) {
		$this->_WPLayer = $WPLayer;
		return $this;
	}
	
}