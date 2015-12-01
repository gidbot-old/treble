<?php

class ffThemeAssetsIncluder extends ffThemeAssetsIncluderAbstract {

	public function isAdmin() {
		$styleEnqueuer = $this->_getStyleEnqueuer();
		$scriptEnqueuer = $this->_getScriptEnqueuer();

		$styleEnqueuer->addStyleTheme( 'wp-color-picker' );
		$scriptEnqueuer->addScript( 'wp-color-picker');
	}

	private function _includeCss() {  }

	private function _includeJs() {  }

	public function isNotAdmin() {
		$this->_includeCss();
		$this->_includeJs();
	}

}
