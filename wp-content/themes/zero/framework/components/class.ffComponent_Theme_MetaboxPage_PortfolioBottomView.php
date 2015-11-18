<?php

class ffComponent_Theme_MetaboxPage_PortfolioBottomView extends ffOptionsHolder {
	public function getOptions() {
		$s = $this->_getOnestructurefactory()->createOneStructure( 'page_portfolio_bottom');

		$s->startSection('general');

			$s->addOption( ffOneOption::TYPE_TEXTAREA, 'description', '', '[container]
[row]
[column sm="12"]
[punchline]Do you need our services? <a href="#contact">Contact us for quote!</a>[/punchline]
[/column]
[/row]
[/container]' );

		$s->endSection();

		return $s;
	}
}

