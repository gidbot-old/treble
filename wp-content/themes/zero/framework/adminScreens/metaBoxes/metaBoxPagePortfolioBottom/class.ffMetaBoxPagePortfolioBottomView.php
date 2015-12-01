<?php

class ffMetaBoxPagePortfolioBottomView extends ffMetaBoxView {


	protected function _requireAssets() {
		ffContainer::getInstance()->getScriptEnqueuer()->getFrameworkScriptLoader()->requireFfAdmin();
	}


	public function requireModalWindows() {
	}


	protected function _render( $post ) {

		ffContainer::getInstance()->getWPLayer()->add_action('admin_footer', array($this,'requireModalWindows'), 1);

		$fwc = ffContainer::getInstance();

		$s = $fwc->getOptionsFactory()->createOptionsHolder('ffComponent_Theme_MetaboxPage_PortfolioBottomView')->getOptions();

		$value = $fwc->getDataStorageFactory()->createDataStorageWPPostMetas_NamespaceFacade(  $post->ID )->getOptionCoded('page_portfolio_bottom');

		$printer = $fwc->getOptionsFactory()->createOptionsPrinterBoxed( $value, $s );
		$printer->setNameprefix('page_portfolio_bottom');
		$printer->walk();


	}


	protected function _save( $postId ) {


		$fwc = ffContainer::getInstance();
		$saver = $fwc->getDataStorageFactory()->createDataStorageWPPostMetas_NamespaceFacade( $postId );

		$s = $fwc->getOptionsFactory()->createOptionsHolder('ffComponent_Theme_MetaboxPage_PortfolioBottomView')->getOptions();
		$postReader = $fwc->getOptionsFactory()->createOptionsPostReader($s);
		$value = $postReader->getData('page_portfolio_bottom');

		$saver->setOptionCoded( 'page_portfolio_bottom' , $value );
	}
}

