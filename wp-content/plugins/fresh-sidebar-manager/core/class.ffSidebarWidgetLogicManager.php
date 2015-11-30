<?php

class ffSidebarWidgetLogicManager extends ffBasicObject {
 
	
	/**
	 * 
	 * @var ffWPLayer
	 */
	private $_WPLayer = null;
	
	/**
	 * 
	 * @var ffDataStorage_WPOptions_NamespaceFacede
	 */
	private $_dataStorageWPOptions = null;
	
	/**
	 * 
	 * @var ffRequest
	 */
	private $_request = null;
	
	private $_logicWidgetData = null;
	
	public function __construct( ffWPLayer $WPLayer, ffDataStorage_WPOptions_NamespaceFacede $dataStorageWPOptions, ffRequest $request ) {
		$this->_setWPLayer($WPLayer);
		$this->_settDataStorageWPOptions($dataStorageWPOptions);
		$this->_setRequest($request);
	}
	
	public function hookAjax() {
		$this->_getWPLayer()->getHookManager()->addAjaxRequestOwner('ffSidebarWidgetLogicManager', array($this, 'ajax'));
		add_action('wp_ajax_save-widget', array($this, 'saveWidget'),1);
	}
	
	public function saveWidget() {
		// post widget-id
		// post ff-custom-code-logic-modal-input
		$widgetId = $this->_getRequest()->post('widget-id');
		$customCodeLogic = $this->_getRequest()->post('ff-custom-code-logic-modal-input');
		
		$widgetData = $this->_getDataStorageWPOptions()->getOption('widget-data');
		$widgetData[ $widgetId ] = $customCodeLogic;
		$this->_getDataStorageWPOptions()->setOption('widget-data', $widgetData);
	}

	public function getLogicForWidget( $widgetId ) {
		
		$data = $this->_getLogicWidgetData();
		
		if( !empty( $data[ $widgetId ] ) && !is_array( $data[ $widgetId ] ) ) {
			
			$dataParsed = array();

			parse_str( $data[ $widgetId ], $dataParsed);

			return $dataParsed['a'];
		} else {
			return true;
		}
	}

	public function ajax( ffAjaxRequest $ajax ) {
		switch( $ajax->specification ) {
			case 'gather-widget-logic' :
				$widgetIds = $ajax->data['widgetIds'];
				$newWidgetData = $this->_getWidgetLimitationForIds($widgetIds);
				
				echo json_encode( $newWidgetData );
				
				break;
		}
		
	}
	
	protected function _getWidgetLimitationForIds( $widgetIds ) {
		if( empty ( $widgetIds ) ) {
			return false;
		}
		
		$oldWidgetData = $this->_getDataStorageWPOptions()->getOption('widget-data');
		$newWidgetData = array();
		
		
		foreach( $widgetIds as $oneId ) {
			if( !isset( $oldWidgetData[ $oneId ] ) ) {
				$newWidgetData[ $oneId ] = array();
			} else {
				$newWidgetData[ $oneId ] = $oldWidgetData[ $oneId ];
			}
			
			//$newWidgetData[ $oneId ] = 'kokot';
		}
		
		$this->_getDataStorageWPOptions()->setOption('widget-data', $newWidgetData);
		
		return $newWidgetData;
	}
	
	
	protected function _getLogicWidgetData() {
		if( $this->_logicWidgetData == null ) {
			$this->_logicWidgetData = $this->_getDataStorageWPOptions()->getOption('widget-data', array() );
		}
		
		return $this->_logicWidgetData;
	}
	
	/**
	 *
	 * @return the ffWPLayer
	 */
	protected function _getWPLayer() {
		return $this->_WPLayer;
	}
	
	/**
	 *
	 * @param ffWPLayer $WPLayer        	
	 */
	protected function _setWPLayer(ffWPLayer $WPLayer) {
		$this->_WPLayer = $WPLayer;
		return $this;
	}
	
	/**
	 *
	 * @return ffDataStorage_WPOptions_NamespaceFacede
	 */
	protected function _getDataStorageWPOptions() {
		return $this->_dataStorageWPOptions;
	}
	
	/**
	 *
	 * @param ffDataStorage_WPOptions_NamespaceFacede $_dataStorageWPOptions        	
	 */
	protected function _settDataStorageWPOptions(ffDataStorage_WPOptions_NamespaceFacede $dataStorageWPOptions) {
		$this->_dataStorageWPOptions = $dataStorageWPOptions;
		return $this;
	}
	
	/**
	 *
	 * @return ffRequest
	 */
	protected function _getRequest() {
		return $this->_request;
	}
	
	/**
	 *
	 * @param ffRequest $_request        	
	 */
	protected function _setRequest(ffRequest $request) {
		$this->_request = $request;
		return $this;
	}
	
	
	
	
 
}