<?php

class ffScrollbarDefaultOptionsGenerator extends ffBasicObject {

################################################################################
# CONSTANTS
################################################################################

################################################################################
# PRIVATE OBJECTS
################################################################################
	/**
	 * 
	 * @var ffFileSystem
	 */
	private $fileSystem = null;
	
	/**
	 * 
	 * @var ffLessVariableParser
	 */
	private $lessVariableParser = null;
	
	
	/**
	 * 
	 * @var ffOptionsArrayConvertor
	 */
	private $optionsArrayConvertor = null;
################################################################################
# PRIVATE VARIABLES	
################################################################################	

################################################################################
# CONSTRUCTOR
################################################################################	
	public function __construct( $pluginDir, ffFileSystem $fileSystem, ffLessVariableParser $lessVariableParser, ffOptionsArrayConvertor $optionsArrayConvertor ) {
		
	}
################################################################################
# ACTIONS
################################################################################
	
################################################################################
# PUBLIC FUNCTIONS
################################################################################	
	public function generateDefaultOptionsArray() {
		$fwc = ffContainer::getInstance();
		
		$variableDir = ffPluginScrollbarContainer::getInstance()->getPluginDir().'/assets/less/scrollbar.less';
		
		$variableContent = $fwc->getFileSystem()->getContents( $variableDir );
		
		
		$variablesParsed = $fwc->getAssetsIncludingFactory()->getLessVariableParser()->getAllLessVariablesFromString( $variableContent );
		
		$arrayConvertor = $fwc->getOptionsFactory()->createOptionsArrayConvertor( array(), $this->_getPostStructure() );
		
	
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
	}
	

	
################################################################################
# PRIVATE FUNCTIONS
################################################################################
	 
################################################################################
# GETTERS AND SETTERS
################################################################################	
	/**
	 *
	 * @return ffFileSystem
	 */
	protected function _getFileSystem() {
		return $this->_fileSystem;
	}
	
	/**
	 *
	 * @param ffFileSystem $fileSystem
	 */
	protected function _setFileSystem(ffFileSystem $fileSystem) {
		$this->_fileSystem = $fileSystem;
		return $this;
	}
	
	/**
	 *
	 * @return ffLessVariableParser
	 */
	protected function _getLessVariableParser() {
		return $this->_lessVariableParser;
	}
	
	/**
	 *
	 * @param ffLessVariableParser $lessVariableParser
	 */
	protected function _setLessVariableParser(ffLessVariableParser $lessVariableParser) {
		$this->_lessVariableParser = $lessVariableParser;
		return $this;
	}
	
	/**
	 *
	 * @return ffOptionsArrayConvertor
	 */
	protected function _getOptionsArrayConvertor() {
		return $this->_optionsArrayConvertor;
	}
	
	/**
	 *
	 * @param ffOptionsArrayConvertor $optionsArrayConvertor
	 */
	protected function _setOptionsArrayConvertor(ffOptionsArrayConvertor $optionsArrayConvertor) {
		$this->_optionsArrayConvertor = $optionsArrayConvertor;
		return $this;
	}
}