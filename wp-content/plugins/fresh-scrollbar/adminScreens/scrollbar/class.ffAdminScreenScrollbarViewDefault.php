<?php

class ffAdminScreenScrollbarViewDefault extends ffAdminScreenView {

	
	
	public function actionSave( ffRequest $requst ) {
		$this->_savingAction();
	}
	
	private function _generateLessOptions( $lessVariables ) {
		$variableString = '';
		$variableArrayClean = array();
		
	 
		
		foreach( $lessVariables as $variableName => $variableValue ) {
			
			if( $variableValue == '' ) {
				continue;
			}
			
			$variableString .= "\n";
			$variableString .= '@'.$variableName . ':' . $variableValue .'px;';
			
			$variableArrayClean[ $variableName ] = $variableValue.'px';
		}
		
		$toReturn = new stdClass();
	 
		$toReturn->string = $variableString;
		$toReturn->array = $variableArrayClean;
		$toReturn->hash = md5( $toReturn->string );
		
		//var_dump( $toReturn->string );
		//var_dump( $toReturn->string);
		return $toReturn;
	}
	
	private function _generateDefaultValuesFromOptions() {
		
		ffPluginScrollbarContainer::getInstance()->getScrollbarDefaultOptionsGenerator();
		
		
		$variableDir = ffPluginScrollbarContainer::getInstance()->getPluginDir().'/assets/less/scrollbar.less';
		
		$variableContent = ffContainer::getInstance()->getFileSystem()->getContents( $variableDir );
		
		$variablesParsed = ffContainer::getInstance()->getAssetsIncludingFactory()->getLessVariableParser()->getAllLessVariablesFromString( $variableContent );

		$arrayConvertor = ffContainer::getInstance()->getOptionsFactory()->createOptionsArrayConvertor( array(), $this->_getPostStructure() );
		
	
		/*
	
		echo '<pre>';
		var_dump( $arrayConvertor->walk() );
		var_dump( $variablesParsed );
		echo '</pre>'; */
		
		$convertedOptions = $arrayConvertor->walk();
		
		$newOptions = array();
		
		foreach( $convertedOptions['options'] as $name => $value ) {
			//$nameClean = str_replace('@', '', $name);
			$nameWithA = '@'.$name;
			
			if( isset( $variablesParsed[ $nameWithA]) ) {
				$newOptions[ $name ] = str_replace('px','', $variablesParsed[ $nameWithA ]);
			}
		}
		$options = array();
		$options['options'] = $newOptions;

		
		
		 
		return $options;// $options['options'];
		
		//var_Dump( $variableContent );
		
	}
	
	private function _savingAction() {
	
		
		$dataStorage = ffContainer::getInstance()->getDataStorageFactory()->createDataStorageWPOptionsNamespace( ffPluginScrollbar::OPTIONS_NAMESPACE );
		$postReader = ffContainer::getInstance()->getOptionsFactory()->createOptionsPostReader( $this->_getPostStructure() );
			//$postReader->setSetting( ffOptionsPostReader::RETURN_COLORLIB_VALUE, true);
		$b = $postReader->getData('scrollbar');
			//var_dump( $b );
		$lessVariables = $this->_generateLessOptions( $b['options']);
		$dataStorage->setOption('less_variables', $b);
		//echo 'bbb';
		//var_dump( $lessVariables );
		
		$lessVariables->string;
		
		$dataStorageCache = ffContainer::getInstance()->getDataStorageCache();
	
		
		$dataStorageCache->setOption( ffPluginScrollbar::CACHE_NAMESPACE, 'variables', $lessVariables->string, 'less');
		//var_dump( $lessVariables );
	}
	
	private function _prepareDataFromLessVariables() {
		
		
		
	}
	
	
	protected function _render() {
	
		?>
		<div class="wrap">
		<!--<h2>Scrollbar</h2>-->
<!--
		<div class="ff-tabs">
			<div class="ff-tabs-header">
				<h2 class="nav-tab-wrapper">
					<a class="nav-tab nav-tab-active" href="">Normal</a>
					<a class="nav-tab" href="">Hover</a>
					<a class="nav-tab" href="">Active</a>
				</h2>
			</div>
			<div class="ff-tabs-contents">
				<div class="ff-tabs-content" id="REPLACE WITH ID">
					aaaaaaaaaa
				</div>
				<div class="ff-tabs-content" id="REPLACE WITH ID">
					bbbbbbbbbb
				</div>
				<div class="ff-tabs-content" id="REPLACE WITH ID">
					cccccccccc
				</div>
			</div>
		</div>
-->
		<?php
		$dataStorage = ffContainer::getInstance()->getDataStorageFactory()->createDataStorageWPOptionsNamespace( ffPluginScrollbar::OPTIONS_NAMESPACE );
		
		
		$s= $this->_getPostStructure();
		
		
	 
		if( !empty( $_POST) ) {
			$this->_savingAction();
		}//var_dump( $_POST );
	 
		
		
		//$data = $this->_generateDefaultValuesFromOptions();// $dataStorage->getOption('less_variables');
		$data =  $dataStorage->getOption('less_variables');
		if( empty( $data ) ) {
			$data = $this->_generateDefaultValuesFromOptions();
		}
		//var_dump( $data );
		if( empty( $data ) ) {
			$data = array();
		}
		
		//var_dump( $data );

		 
		
		$printer = ffContainer::getInstance()->getOptionsFactory()->createOptionsPrinterBoxed($data, $s );
		
		echo '<form action="#" method="POST">';
		$printer->setNameprefix('scrollbar');
 
		$printer->walk();
		echo '<p class="submit"><input type="submit" value="Save Changes" class="button button-primary" id="submit" name="submit"></p>';
		echo '</div><!-- END WRAP -->';
		echo '</form>';
	}
	
	private function _getPostStructure() {
		$s = ffContainer::getInstance()->getOptionsFactory()->createOptionsHolder('ffScrollbarAdminOptionsHolder');
		
		return $s->getOptions();


	}

	protected function _requireAssets() {
		$pluginUrl = ffPluginScrollbarContainer::getInstance()->getPluginUrl();
		$styleEnqueuer = ffPluginScrollbarContainer::getInstance()->getFrameworkContainer()->getStyleEnqueuer();
		$lessOptionManager = ffContainer::getInstance()->getLessWPOptionsManager();
		
		$this->_getStyleEnqueuer()->addStyle('ff-scrollbar-less', $pluginUrl .'/assets/less/scrollbar.less' );
		
		$this->_getStyleEnqueuer()->addStyleAdmin('ff-scrollbar-admin-less', $pluginUrl .'/assets/less/scrollbar-admin.less' );
		
		$this->_getScriptEnqueuer()->addScript('ff-scrollbar-admin', $pluginUrl.'/assets/js/adminScreenScrollbar.js');
		
		ffContainer::getInstance()->getFrameworkScriptLoader()->addAdminColorsToStyle('ff-scrollbar-admin-less');
		$styleEnqueuer->addLessImportFile('ff-scrollbar-admin-less', 'ff-mixins-less', $lessOptionManager->getFrameworkFreshMixinsLessUrl() );
		
		
		$dataStorageCache = ffContainer::getInstance()->getDataStorageCache();
			
		//$styleEnqueuer->addStyle('ff-scrollbar-less', $pluginUrl.'/assets/less/scrollbar.less');
			
		if( $dataStorageCache->optionExists( ffPluginScrollbar::CACHE_NAMESPACE , 'variables', 'less') ) {
			$url = $dataStorageCache->getOptionPath( ffPluginScrollbar::CACHE_NAMESPACE , 'variables', 'less');
			$styleEnqueuer->addLessVariablesFromFile('ff-scrollbar-less', $url);
		}
			
	}

	protected function _setDependencies() {}

}