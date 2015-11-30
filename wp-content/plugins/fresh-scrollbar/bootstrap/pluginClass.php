<?php

class ffPluginScrollbar extends ffPluginAbstract {

	const OPTIONS_NAMESPACE = 'ff-scrollbar';
	const CACHE_NAMESPACE = 'scrollbar';
	
	
	protected function _registerAssets() {
		$fwc = $this->_getContainer()->getFrameworkContainer();
		$fwc->getAdminScreenManager()->addAdminScreenClassName('ffAdminScreenScrollbar');
	}

	public function pluginActivation() {
		//$dataStorage = $this->_getContainer()->getFrameworkContainer()->getDataStorageFactory()->createDataStorageWPOptionsNamespace( ffPluginScrollbar::CACHE_NAMESPACE );
		
	}
	
	protected function _run() {
		
		/*
		if ( !is_admin() ) {
			$frameworkUrl = ffContainer::getInstance()->getWPLayer()->getFrameworkUrl();
			ffContainer::getInstance()->getStyleEnqueuer()->addStyle('jscrollpane-css', $frameworkUrl.'/framework/extern/jscrollpane/jquery.jscrollpane.css');
			ffContainer::getInstance()->getScriptEnqueuer()->addScript('mousewheel-js', $frameworkUrl.'/framework/extern/jscrollpane/jquery.mousewheel.min.js', array('jquery'));
			ffContainer::getInstance()->getScriptEnqueuer()->addScript('jscrollpane-js', $frameworkUrl.'/framework/extern/jscrollpane/jquery.jscrollpane.min.js', array('jquery'));
			ffContainer::getInstance()->getScriptEnqueuer()->addScript('jscrollpane-js-init', $frameworkUrl.'/framework/extern/jscrollpane/jquery.jscrollpane.init.js', array('jquery'));
		}
		*/
		if ( !$this->_getContainer()->getFrameworkContainer()->getWPLayer()->is_admin() ) {
			$pluginUrl = $this->_getContainer()->getPluginUrl();

			$styleEnqueuer = ffContainer::getInstance()->getStyleEnqueuer();
			
			//$this->_getStyleEnqueuer()->addLessVariablesFromFile('ff-bootstrap-less', $this->_getWplayer()->getFrameworkDir().'/framework/extern/bootstrap/less/variables.less');
			
			$dataStorageCache = ffContainer::getInstance()->getDataStorageCache();
			
			$styleEnqueuer->addStyle('ff-scrollbar-less', $pluginUrl.'/assets/less/scrollbar.less');
			
			if( $dataStorageCache->optionExists( ffPluginScrollbar::CACHE_NAMESPACE , 'variables', 'less') ) {
				$url = $dataStorageCache->getOptionPath( ffPluginScrollbar::CACHE_NAMESPACE , 'variables', 'less');
				$styleEnqueuer->addLessVariablesFromFile('ff-scrollbar-less', $url);
			}
			
			
		}
		
		$this->_addLessFiles();
		
	}
	
	private function _addLessFiles() {
		//return;
		
		/*
		 * 
		 *  $this->_getStyleEnqueuer()->addLessVariablesFromFile('ff-bootstrap-less', $this->_getWplayer()->getFrameworkDir().'/framework/extern/bootstrap/less/variables.less');
		$this->_getStyleEnqueuer()->addLessCode('ff-bootstrap-less', 'test', ' .body {opacity:0.6;} ');
    $this->_getStyleEnqueuer()->addLessVariable('ff-bootstrap-less', 'brand-primary','green');
    $this->_getStyleEnqueuer()->addStyleFramework('ff-bootstrap-less', '/framework/extern/bootstrap/less/bootstrap.less');
		 */
		
		$pluginUrl = $this->_getContainer()->getPluginUrl();
		$lessManager = $this->_getContainer()->getFrameworkContainer()->getAssetsIncludingFactory()->getLessManager();
		$lessManager->addOneLessFile( ffOneLessFile::TYPE_PLUGIN, $pluginUrl.'/assets/less/scrollbar-variables.less', 10, 'Scrollbar');
		//ffContainer::getInstance()->getAssetsIncludingFactory()->getLessManager()->addOneLessFile( ffOneLessFile::TYPE_PLUGIN, $url);;
	}

	protected function _setDependencies() {}

	/**
	 * @return ffPluginScrollbarContainer
	 */
	protected function _getContainer() {
		return $this->_container;
	}

}