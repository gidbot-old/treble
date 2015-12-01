<?php

function zero__video( $html ){
	$html = trim( $html );

	if( empty($html) ){
		return '';
	}

	$bg_image_url = Zero__Featured_Area::getFeaturedImage();

	$ret  = '';

	$ret .= '<div class="featured-video-1 ff-section">';
		$ret .= '<img class="black-bg" src="data:image/gif;base64,R0lGODlhAQABAIAAAAUEBAAAACwAAAAAAQABAAACAkQBADs=" alt="">';
		$ret .= '<div class="featured-video__wrapper">';
		$ret .= $html;
		$ret .= '</div>';

		if( empty( $bg_image_url ) ){

			// 16x9px black gif base64 encoded image

			$ret .= '<img class="responsive-image-1 ff-block" src="data:image/gif;base64,R0lGODlhEAAJAPAAAAAAAAAAACH5BAAAAAAAIf8LSUNDUkdCRzEwMTL/AAACdGFwcGwEAAAAbW50clJHQiBYWVogB9wACwAMABIAOgAXYWNzcEFQUEwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAPbWAAEAAAAA0y1hcHBsZkn52TyFd5+0BkqZHjp0LAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAALZGVzYwAAAQgAAABjZHNjbQAAAWwAAAAsY3BydAAAAZgAAAAtd3RwdAAAAcgAAAAUclhZWgAAAdwAAAAUZ1hZWgAAAfAAAAAUYlhZWgAAAgQAAAAUclRSQwAAAhgAAAAQYlRSQwAAAigAAAAQZ1RSQwAAAjgAAAAQY2hh/2QAAAJIAAAALGRlc2MAAAAAAAAACUhEIDcwOS1BAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABtbHVjAAAAAAAAAAEAAAAMZW5VUwAAABAAAAAcAEgARAAgADcAMAA5AC0AQXRleHQAAAAAQ29weXJpZ2h0IEFwcGxlIENvbXB1dGVyLCBJbmMuLCAyMDEwAAAAAFhZWiAAAAAAAADzUgABAAAAARbPWFlaIAAAAAAAAG+hAAA5IwAAA4xYWVogAAAAAAAAYpYAAHa3vAAAGMpYWVogAAAAAAAAJJ4AAA87AAC2znBhcmEAAAAAAAAAAAAB9gRwYXJhAAAAAAAAAAAAAfYEcGFyYQAAAAAAAAAAAAH2BHNmMzIAAAAAAAEMQgAABd7///MmAAAHkgAA/ZH///ui///9owAAA9wAAMBsACwAAAAAEAAJAAACCoSPqcvtD6OclBUAOw==" alt="">';

		}else{
			ob_start();
			$responsive_img = $bg_image_url;
			// it allows to use "$featured_img"
			require locate_template('templates/blocks/responsive-image-1/responsive-image-1.php');
			$ret .= ob_get_clean();
		}
		$ret .= '<a class="big-play-button background-check" href="">';
			$ret .= '<span class="play-shape"></span>';
		$ret .= '</a>';
	$ret .= '</div>';

	return $ret;
}