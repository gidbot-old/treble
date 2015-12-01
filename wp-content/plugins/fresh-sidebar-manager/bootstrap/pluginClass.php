<?php

class ffPluginFreshSidebarManager extends ffPluginAbstract {

	const ffSidebarPrefix = 'ff-sidebar-';
	
	const NAMESPACE_WIDGET_LIMITER = 'ff-widget-limiter';

	protected function _registerAssets() {
		$fwc = $this->_getContainer()->getFrameworkContainer();
		$fwc->getAdminScreenManager()->addAdminScreenClassName('ffAdminScreenSidebarManager');
		//var_dump( get_current_screen() );
	}

	protected function _run() {
		$c1 = $this->_getContainer()->getFrameworkContainer()->getWPLayer()->is_admin_screen('widgets.php');
		$c2 = $this->_getContainer()->getFrameworkContainer()->getWPLayer()->is_ajax();

		if( $this->_getContainer()->getFrameworkContainer()->getWPLayer()->is_admin() ){
			if( $c1 or $c2 ){
				$this->registerCustomSidebars();
			}
			
			$this->_getContainer()->getFrameworkContainer()->getWPLayer()->add_action('current_screen', array( $this, 'actionCurrentScreen') );
			
		}else{
			$this->_getContainer()->getFrameworkContainer()->getWPLayer()->add_action('wp_head', array( $this, 'wp_head'));
		}
	
	}
	
	public function actionCurrentScreen() {
		
		if( $this->_getContainer()->getFrameworkContainer()->getWPLayer()->get_current_screen()->base == 'widgets' ) {
			$pluginUrl = $this->_getContainer()->getPluginUrl();
			$this->_getContainer()->getFrameworkContainer()->getScriptEnqueuer()->getFrameworkScriptLoader()->requireFrsLib();
			$this->_getContainer()->getFrameworkContainer()->getScriptEnqueuer()->addScript('ff-widget-conditional-logic-adder', $pluginUrl.'/assets/js/widgetConditionalLogicAdder.js');
			$this->_getContainer()->getFrameworkContainer()->getWPLayer()->add_action('admin_footer', array($this, 'printModalWindowLogic'), 1);
		}
	}
	
	public function printModalWindowLogic() {
		$this->_getContainer()->getFrameworkContainer()->getModalWindowFactory()->getModalWindowManagerConditions()->printWindow();
	}

	protected function _ajax() {
		$this->_getContainer()->getSidebarWidgetLogicManager()->hookAjax();
	}
	
	public function wp_head(){
		$this->_getContainer()->getFrameworkContainer()->getWPLayer()->add_action('sidebars_widgets', array( $this, 'sidebars_widgets' ) );
		$this->_getContainer()->getFrameworkContainer()->getWPLayer()->add_filter('widget_display_callback', array( $this, 'widget_display_callback' ), 10, 3 );
	}

	public function widget_display_callback($instance, $widget, $args){

		$lm = ffPluginFreshSidebarManagerContainer::getInstance()->getSidebarWidgetLogicManager();

		$fwc = $this->_getContainer()->getFrameworkContainer();
		$evaluator = $fwc->getLibManager()->createConditionalLogicEvaluator();
		$logic = $lm->getLogicForWidget( $widget->id );
		if( true === $logic ) {
			return $instance;
		}
		$query = $fwc->getOptionsFactory()->createQuery( $logic );

		if( $evaluator->evaluate($query) ) {
			return $instance;
		}

		return false;
	}

	private $_already_called = false;

	public function sidebars_widgets( $original_sidebars ) {
		if( $this->_already_called ){
			return $original_sidebars;
		}
		$this->_already_called = true;

		$fwc = $this->_getContainer()->getFrameworkContainer();

		$dataStorage = $fwc->getDataStorageFactory()->createDataStorageWPOptionsNamespace( 'ff-sidebars' );
		$data = $dataStorage->getOption( 'ff-sidebars' );
		if( empty( $data['ff-sidebars'] ) ){
			return $original_sidebars;
		}

		$evaluator = $fwc->getLibManager()->createConditionalLogicEvaluator();

		$updated_sidebar = array();

		foreach ($data['ff-sidebars'] as $_ff_sidebars_item) {

			$ff_sidebars_item = $_ff_sidebars_item['ff-sidebars-item'];

			// When name is empty => no rule will apply
			$ff_sidebars_item['sidebar_name'] = trim( $ff_sidebars_item['sidebar_name'] );
			if( empty( $ff_sidebars_item['sidebar_name'] ) ){
				continue;
			}

			// Get custom sidebar slug
			$ff_sidebars_item_slug =
						ffPluginFreshSidebarManager::ffSidebarPrefix
						. $ff_sidebars_item['sidebar_slug'];

			// May I use that on this page?
			$query = $fwc->getOptionsFactory()->createQuery( $ff_sidebars_item['conditional_logic'] );
			if( ! $evaluator->evaluate($query) ) {
				continue;
			}

			// TODO :
			if( empty( $ff_sidebars_item['enable_exclusion'] ) ){
				$ff_sidebars_item['enable_exclusion'] = array();
			}else if( ! is_array($ff_sidebars_item['enable_exclusion']) ){
				$ff_sidebars_item['enable_exclusion'] = explode('--||--', $ff_sidebars_item['enable_exclusion']);
			}
			// TODO END

			foreach ($original_sidebars as $original_sidebar_key => $original_sidebar_widgets) {

				if( ffPluginFreshSidebarManager::ffSidebarPrefix == substr($original_sidebar_key, 0, strlen(ffPluginFreshSidebarManager::ffSidebarPrefix) ) ){
					continue;
				}

				if( ! empty( $updated_sidebar[ $original_sidebar_key ] ) ){
					continue;
				}

				if( ! empty( $ff_sidebars_item['enable_exclusion'] ) ){
					if( ! in_array($original_sidebar_key, $ff_sidebars_item['enable_exclusion']) ){
						continue;
					}
				}

                if( isset($original_sidebars[ $ff_sidebars_item_slug ] ) ) {
				    $original_sidebars[ $original_sidebar_key ] = $original_sidebars[ $ff_sidebars_item_slug ];
                } else {
                    $original_sidebars[ $original_sidebar_key ] = null;
                }
				$updated_sidebar[ $original_sidebar_key ] = true;

			}
		}

		$l = $this->_getContainer()->getFrameworkContainer()->getWPLayer();
		$l->setGlobal('sidebars_widgets', $original_sidebars);
		$l->setGlobal('_wp_sidebars_widgets', $original_sidebars);
		return $original_sidebars;

	}

	public function registerCustomSidebars(){
		$dataStorage = ffContainer::getInstance()->getDataStorageFactory()->createDataStorageWPOptionsNamespace( 'ff-sidebars' );
		$our_sb = $dataStorage->getOption( 'ff-sidebars' );
		if( empty( $our_sb['ff-sidebars'] ) ){
			return;
		}
		foreach ($our_sb['ff-sidebars'] as $_ff_sidebars_item) {

			$ff_sidebars_item = $_ff_sidebars_item['ff-sidebars-item'];

			// When name is empty => no rule will apply
			$ff_sidebars_item['sidebar_name'] = trim( $ff_sidebars_item['sidebar_name'] );
			if( empty( $ff_sidebars_item['sidebar_name'] ) ){
				continue;
			}

			$this->_getContainer()->getFrameworkContainer()->getWPLayer()->register_sidebar( array(
				'name'          => $ff_sidebars_item['sidebar_name'],
				'id'            => ffPluginFreshSidebarManager::ffSidebarPrefix . $ff_sidebars_item['sidebar_slug'],
				'description'   => $ff_sidebars_item['sidebar_description'],
			) );
		}
	}

	protected function _setDependencies() {}

	/**
	 * @return ffPluginFreshSidebarManagerContainer
	 */
	protected function _getContainer() {
		return $this->_container;
	}

}