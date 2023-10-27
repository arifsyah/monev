<?php 
/**
* 
*/
if ( ! function_exists('thumb_image')) {
	function thumb_image($path = "", $size = "", $type = ""){
		$path_thumb = public_path().DIRECTORY_SEPARATOR.'images/thumb/';
		$url_thumb = url('/').'/images/thumb/';
		// echo $size;
		if ($path != '') {
			$str_path = '';
			$exp_img = explode(".", $path);
			
			if ($size != '') {
				
				$separator = explode("x", $size);
				$width = $separator[0];
	            $height = $separator[1];
	            if (file_exists($path_thumb.$exp_img[0]."_".$size."_thumb.".$exp_img[1])) {
	            	$str_path = $url_thumb.$exp_img[0]."_".$size."_thumb.".$exp_img[1];
	            }else{
	            	$str_path = url('/').'/images/no_image.jpg';
	            }
			}
		}else{
			$str_path = url('/').'/images/no_image.jpg';
		}

		return $str_path;
	}
}
