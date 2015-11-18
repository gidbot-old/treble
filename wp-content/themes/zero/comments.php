<?php
if( ! post_password_required() ) {
	if ( get_comments_number() > 0 ) {
		require locate_template('templates/blocks/comments-list-1/comments-list-1.php');
	}
	if ( comments_open() ) {
		require locate_template('templates/blocks/comments-form-1/comments-form-1.php');
	}
}
?>