<?php

wp_enqueue_script( 'zero-contact-form-1-js' );

$fwc = ffContainer::getInstance();
$postMeta = $fwc->getDataStorageFactory()->createDataStorageWPPostMetas();

$data = $postMeta->getOption( get_the_ID(), 'page_contact_form');
$query = $fwc->getOptionsFactory()->createQuery( $data,'ffComponent_Theme_MetaboxContactPage_View')->get('general');

?>
<div class="contact-form-1 ff-block">
	<form action="#" method="post" class="ff-cform">

		<div id="alert-area"></div>

		<p class="contact-form-1__p-name">
			<input type="text" placeholder="<?php echo esc_attr( $query->get('titles name') );?>" name="name">
		</p>
		<p class="contact-form-1__p-email">
			<input type="text" placeholder="<?php echo esc_attr( $query->get('titles email') );?>" name="email">
		</p>
		<p class="contact-form-1__p-subject">
			<input type="text" placeholder="<?php echo esc_attr( $query->get('titles subject') );?>" name="subject">
		</p>
		<p class="contact-form-1__p-message">
			<textarea placeholder="<?php echo esc_attr( $query->get('titles message') );?>" cols="25" rows="5" name="message"></textarea>
		</p>
		<p class="contact-form-1__p-submit">
			<button type="submit" class="btn btn-default" name="submit"><?php echo zero__wp_kses( $query->get('titles button') );?></button>
		</p>
		<?php

		$data = array();

		$data['email'] = $query->get('settings email');
		$data['subject'] = $query->get('settings subject');

		$data = json_encode( $data );

		echo '<div class="ff-contact-info" style="display:none;">'.ffContainer::getInstance()->getCiphers()->freshfaceCipher_encode( $data ).'</div>';

		?>
		<p class="ff-email-has-been-sent">
			<?php echo zero__wp_kses( $query->get('messages message-send-ok') ); ?>
		</p>

		<p class="ff-email-failed">
			<?php echo zero__wp_kses( $query->get('messages message-send-wrong') ); ?>
		</p>
	</form>
</div>