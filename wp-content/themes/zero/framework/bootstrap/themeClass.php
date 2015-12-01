<?php

class ffTheme extends ffThemeAbstract {


	protected function _setDependencies() {

	}

	protected function _registerAssets() {
		$fwc = $this->_getContainer()->getFrameworkContainer();

		$fwc->getAdminScreenManager()->addAdminScreenClassName('ffAdminScreenThemeOptions');

		$fwc->getMetaBoxes()->getMetaBoxManager()->addMetaBoxClassName('ffMetaBoxContactPage');
		$fwc->getMetaBoxes()->getMetaBoxManager()->addMetaBoxClassName('ffMetaBoxPagePortfolio');
		$fwc->getMetaBoxes()->getMetaBoxManager()->addMetaBoxClassName('ffMetaBoxPagePortfolioBottom');

		$fwc->getWidgetManager()->addWidgetClassName('ffWidgetTwitter');

	}

	protected function _run() {
	}

	protected function _ajax() {

	}
}