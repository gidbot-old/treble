<?php

class ffComponent_TwitterWidget_OptionsHolder extends ffOptionsHolder {
	public function getOptions() {
		$s = $this->_getOnestructurefactory()->createOneStructure( 'twitter-structure' );
		$s->startSection('twitter', __( 'Twitter', 'zero'));

		$s->addElement( ffOneElement::TYPE_HEADING, '', __( 'General', 'zero') );
		$s->addElement( ffOneElement::TYPE_DESCRIPTION, '', __( 'Some changes will be applied after the Twitter cache expires, please be patient in these cases.', 'zero') );
		$s->addOption(ffOneOption::TYPE_TEXT, 'title', __( 'Title:', 'zero').'<br>', __( 'Twitter', 'zero'));
		$s->addElement( ffOneElement::TYPE_NEW_LINE );
		$s->addElement( ffOneElement::TYPE_NEW_LINE );

		$s->startSection('fw_twitter');
		$s->addOption(ffOneOption::TYPE_TEXT, 'username', __( 'Username:', 'zero') .'<br>', '_freshface');
		$s->addElement( ffOneElement::TYPE_NEW_LINE );
		$s->addElement( ffOneElement::TYPE_NEW_LINE );
		$s->addOption(ffOneOption::TYPE_TEXT, 'number-of-tweets', __( 'Number of Tweets:', 'zero') .'<br>', '3');
		$s->addElement( ffOneElement::TYPE_NEW_LINE );
		$s->addElement( ffOneElement::TYPE_NEW_LINE );
		$s->addOption(ffOneOption::TYPE_TEXT, 'caching-time-in-minutes', __( 'Caching time in minutes:', 'zero') . '<br>', '60');
		$s->addElement( ffOneElement::TYPE_NEW_LINE );
		$s->addElement( ffOneElement::TYPE_NEW_LINE );

		$s->addElement( ffOneElement::TYPE_HEADING, '', __( 'Twitter API Settings', 'zero') );
		$s->addElement( ffOneElement::TYPE_DESCRIPTION, '', __( 'Start by creating your own Twitter app <a href="//apps.twitter.com/">here</a>. You will then be given the necessary details you need to input below.', 'zero') );
		$s->addOption(ffOneOption::TYPE_TEXT, 'consumer-key', __( 'Consumer Key:', 'zero') .'<br>');
		$s->addElement( ffOneElement::TYPE_NEW_LINE );
		$s->addElement( ffOneElement::TYPE_NEW_LINE );
		$s->addOption(ffOneOption::TYPE_TEXT, 'consumer-secret', __( 'Consumer Secret:', 'zero') . '<br>');
		$s->addElement( ffOneElement::TYPE_NEW_LINE );
		$s->addElement( ffOneElement::TYPE_NEW_LINE );
		$s->addOption(ffOneOption::TYPE_TEXT, 'access-token', __( 'Access Token:', 'zero').'<br>');
		$s->addElement( ffOneElement::TYPE_NEW_LINE );
		$s->addElement( ffOneElement::TYPE_NEW_LINE );
		$s->addOption(ffOneOption::TYPE_TEXT, 'access-token-secret', __( 'Access Token Secret:', 'zero').'<br>');
		$s->addElement( ffOneElement::TYPE_NEW_LINE );
		$s->addElement( ffOneElement::TYPE_NEW_LINE );
		$s->endSection();
		$s->endSection();
		return $s;
	}
}

