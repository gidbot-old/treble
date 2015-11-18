<?php

function zero__gallery($output, $attr) {

	static $instance = 0;
	$instance++;

	global $post;

	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( !$attr['orderby'] ){
			unset( $attr['orderby'] );
		}
	}

	extract(shortcode_atts(array(
			'order'      => 'ASC',
			'orderby'    => 'menu_order ID',
			'id'         => $post->ID,
			'columns'    => 3,
			'size'       => 'thumbnail',
			'include'    => '',
			'exclude'    => ''
	), $attr));

	$gallery_ID = $id = intval($id);

	if ( 'RAND' == $order )
		$orderby = 'none';

	if ( !empty($include) ) {
		$include = preg_replace( '/[^0-9,]+/', '', $include );
		$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( !empty($exclude) ) {
		$exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
		$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	} else {
		$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	}

	if ( empty($attachments) )
		return '';

	$output = "";

	// global $featured_height;
	// global $content_width;

	wp_enqueue_script( 'zero-featured-slider-1-js' );

	$output .= '<div class="featured-slider-1 ff-section">';
	$output .= '<div class="swiper-container">';
	$output .= '<div class="swiper-wrapper">';

	$i = 0;
	foreach ( $attachments as $id => $attachment ) {
		$url = wp_get_attachment_url( $id );
		if( empty( $url ) ) continue;

		$output .= '<div class="swiper-slide">';

		ob_start();
		$responsive_img = $url;
		// it allows to use "$featured_img"
		require locate_template('templates/blocks/responsive-image-1/responsive-image-1.php');
		$output .= ob_get_clean();

		$output .= '</div>';
	}

	$output .= '</div>';

	$output .= '<div class="swiper-pagination"></div>';

	$output .= '<a class="swiper-arrow__left" href=""><i class="fa fa-angle-left background-check"></i></a>';
	$output .= '<a class="swiper-arrow__right" href=""><i class="fa fa-angle-right background-check"></i></a>';

	$output .= '</div>';
	$output .= '</div>';

	return $output;
}
