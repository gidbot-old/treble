<?php


///////////////////////////////////////////////////////////////////////////////////////////////////
// Add wrappers to comment input fields
///////////////////////////////////////////////////////////////////////////////////////////////////
$queryTranslation = ffThemeOptions::getQuery('comments');
$query = $queryTranslation->get('comments-form');


$commentFormPrinter = ffContainer()->getThemeFrameworkFactory()->getCommentsFormPrinter();

if( $commentFormPrinter->commentsOpen() ) {

	$commentFormPrinter->addFieldAuthorLine('<p class="comment-form__p-name">');
	$commentFormPrinter->addFieldAuthorLine('<label for="name">' . zero__wp_kses( $query->get('name') ) . ' <span class="required">*</span></label>');
	$commentFormPrinter->addFieldAuthorLine('<input class="ff-field-author" id="name" name="author" type="text" placeholder="' . esc_attr( $query->get('name') ) . ' *">');
	$commentFormPrinter->addFieldAuthorLine('</p>');

	$commentFormPrinter->addFieldEmailLine('<p class="comment-form__p-email">');
	$commentFormPrinter->addFieldEmailLine('<label for="email">' . zero__wp_kses( $query->get('email') ) . ' <span class="required">*</span></label>');
	$commentFormPrinter->addFieldEmailLine('<input class="ff-field-email" id="email" name="email" type="text" placeholder="' . esc_attr( $query->get('email') ) . ' *">');
	$commentFormPrinter->addFieldEmailLine('</p>');

	$commentFormPrinter->addFieldWebsiteLine('<p class="comment-form__p-website">');
	$commentFormPrinter->addFieldWebsiteLine('<label for="url">' . zero__wp_kses( $query->get('website') ) . ' </label>');
	$commentFormPrinter->addFieldWebsiteLine('<input class="ff-field-url" id="url" name="url" type="text" placeholder="' . esc_attr( $query->get('website') ) . '">');
	$commentFormPrinter->addFieldWebsiteLine('</p>');

	$commentFormPrinter->addFieldCommentLine('<p class="comment-form__p-message">');
	$commentFormPrinter->addFieldCommentLine('<label for="message">' . zero__wp_kses( $query->get('comment-form') ) . ' </label>');
	$commentFormPrinter->addFieldCommentLine('<textarea class="ff-field-comment" id="comment" name="comment" rows="5" cols="25" placeholder="' . esc_attr( $query->get('comment-form') ) . '"></textarea>');
	$commentFormPrinter->addFieldCommentLine('</p>');

	$commentFormPrinter->setClassSubmitButton('btn btn-default');

	$commentFormPrinter->addFieldLoggedInLine('<p class="col-1 logged-in-as">');
	$commentFormPrinter->addFieldLoggedInLine( zero__wp_kses( $query->get('logged-in') ) );
	$commentFormPrinter->addFieldLoggedInLine('</p>');


	$commentFormPrinter->setTextHeading(zero__wp_kses( $query->get('heading') ));
	$commentFormPrinter->setTextSubmit(zero__wp_kses( $query->get('submit-button') ));



	$commentFormPrinter->addReplaceRule('comment-reply-title', 'comment-reply-title commentform-title');

	echo '<div class="comments-form-1 ff-block">';
	echo '<div class="closing-unfinished-comment hidden">'.strip_tags( $query->get('closing-unfinished-comment') ).'</div>';
	$commentFormPrinter->printForm();
	echo '</div>';

}