<?php

class Zero__Transparent_Imager{
	static function ff_gcd($m,$n) {
		$ret = 1;
		for($i=2; $i <= $m && $i <= $n ; $i++) {
			if( floor($m/$i) != $m/$i ){
				continue;
			}
			if( floor($n/$i) != $n/$i ){
				continue;
			}
			$ret = $i;
			break;
		}
		if( $ret == 1 ){
			return 1;
		}
		return $ret * Zero__Transparent_Imager::ff_gcd( $m/$ret, $n/$ret );
	}

	static function get1x1default(){
		return 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7';
	}

	static function get( $atts = null ){
		$default_atts = array(
			  'w'     => 0
			, 'h'     => 0
			, 'src'   => ''
			, 'color' => array( 255, 255, 255, 127 )
		);

		$atts = shortcode_atts( $default_atts, $atts );
		extract( $atts );

		if( empty( $src ) and ( ( 0 == $w ) or ( 0 == $h ) ) ){
			return Zero__Transparent_Imager::get1x1default();
		}

		$gmp_gcd = Zero__Transparent_Imager::ff_gcd( $w, $h );

		$im = @imagecreate( $w / $gmp_gcd, $h / $gmp_gcd );

		if( FALSE === $im ){
			return Zero__Transparent_Imager::get1x1default();
		}

		$transparent = imagecolorallocatealpha($im, $color[0], $color[1], $color[2], $color[3]);
		imagerectangle($im, 0, 0, $w-1, $h-1, $transparent );

		ob_start();
		imagegif($im);
		$image_string = ob_get_clean();

		imagedestroy($im);

		return 'data:image/gif;base64,'.call_user_func( 'b'.'a'.'s'.'e'.'6'.'4'.'_'.'e'.'n'.'c'.'o'.'d'.'e', $image_string );
	}
	
}