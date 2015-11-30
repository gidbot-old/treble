<?php

class ffAdminScreenSidebarManagerViewDefault extends ffAdminScreenView {

	protected function _generateCode(){
		$_CODE_CHARS = "abcdefghijklmnopqrstuvwxyz012345";
		$slug = '' ;
		for( $i=0; $i<32; $i++){
			$num = ( mt_rand(0, 32 << 4) >> 4 ) -1;
			$slug = $slug . substr($_CODE_CHARS, $num, 1);
			$i++;
		}
		return $slug;
	}

	protected function _render() {
		?><div class="wrap">
		<h2>Sidebars</h2>
		<form method="post" class="ff-options-form">
		<br/>
		<?php


		$_OPTIONS_NAME = 'ff-sidebars';

		// Options

		$sidebarIdentificator = ffPluginFreshSidebarManagerContainer::getInstance()->getSidebarIdentificator();
		$activeSidebars = $sidebarIdentificator->getActiveSidebarsList();

		$s = ffContainer::getInstance()->getOptionsFactory()->createStructure($_OPTIONS_NAME);

			$s->startSection($_OPTIONS_NAME, ffOneSection::TYPE_REPEATABLE_VARIABLE )
				// ->addParam('class', 'enable-delete-all-repeatable-items')
				;
				$s->startSection($_OPTIONS_NAME.'-item', ffOneSection::TYPE_REPEATABLE_VARIATION)->addParam('section-name', 'Custom Sidebar');
					$s->addElement( ffOneElement::TYPE_TABLE_START );
						$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Name');
							$s->addOption(ffOneOption::TYPE_TEXT, 'sidebar_name', '', '')
								->addParam('placeholder', 'My Sidebar')
								->addParam('class', 'edit-repeatable-item-title')
								;
							$s->addOption(ffOneOption::TYPE_TEXT, 'sidebar_slug', '', '' )
								->addParam('class','hidden')
								;
						$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

						$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Description');
							$s->addOption(ffOneOption::TYPE_TEXT, 'sidebar_description', '', '')
								->addParam('class','widefat')
								->addParam('class', 'edit-repeatable-item-description')
								;
						$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

						$s->addElement( ffOneElement::TYPE_TABLE_DATA_START,'', 'Replaces');

						$sb = $s->addOption(ffOneOption::TYPE_SELECT2, 'enable_exclusion', 'Enable exclusion', 1, '')
							->addParam('type','multiple')
							->addSelectValues( $activeSidebars );

						$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

						$s->addElement( ffOneElement::TYPE_TABLE_DATA_START,'', 'Conditions');
							$s->addOption(ffOneOption::TYPE_CONDITIONAL_LOGIC, 'conditional_logic', 'conditional_logic' );
						$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

					$s->addElement(ffOneElement::TYPE_TABLE_END);

				$s->endSection();
			$s->endSection();


		// Data


		$postReader = ffContainer::getInstance()->getOptionsFactory()->createOptionsPostReader();
		$postReader->setOptionsStructure( $s );
		$postData = $postReader->getData($_OPTIONS_NAME);

		$dataStorage = ffContainer::getInstance()->getDataStorageFactory()->createDataStorageWPOptionsNamespace( $_OPTIONS_NAME );
		if( ! empty($postData) and ! empty($postData['ff-sidebars']) ){

			foreach ($postData['ff-sidebars'] as $key => $value) {
				if( empty( $postData['ff-sidebars'][ $key ]['ff-sidebars-item']['sidebar_slug'] ) ){
					$postData['ff-sidebars'][ $key ]['ff-sidebars-item']['sidebar_slug'] = $this->_generateCode();
				}
			}

			$dataStorage->setOption($_OPTIONS_NAME, $postData);
		}

		$data = $dataStorage->getOption( $_OPTIONS_NAME );

		$printer = ffContainer::getInstance()->getOptionsFactory()->createOptionsPrinterBoxed( $data , $s );
		$printer->setNameprefix($_OPTIONS_NAME);

		$printer->walk();

		?>

		<br/>
		<p><input type="submit" name="" class="button button-primary action ff-form-submit" value="Save Changes" /></p>
		</form>
		</div>
		<?php
	}

	protected function _requireAssets() {}

	protected function _setDependencies() {}

}








