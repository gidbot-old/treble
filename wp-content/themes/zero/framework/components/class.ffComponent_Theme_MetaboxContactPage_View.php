<?php

class ffComponent_Theme_MetaboxContactPage_View extends ffOptionsHolder {
	public function getOptions() {
		$s = $this->_getOnestructurefactory()->createOneStructure( 'page_contact_form');

		$s->startSection('general');

		require locate_template('templates/blocks/contact-form-1/contact-form-1-block.php');

		$s->endSection();

		return $s;
	}
}

