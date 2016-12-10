<?php 

/* ============================================================
	THUMBNAIL FUNCTIONS START
============================================================ */


	/* ============================================================
		KEEP RATIO START
	============================================================ */

		function createThumb($filepath, $thumbPath, $size, $quality=100){

			$created=false;
			$file_name  = pathinfo($filepath);  
			$format = $file_name['extension'];

			$image = imagecreatefromstring(file_get_contents($filepath));
			list($width_orig, $height_orig) = getimagesize($filepath);

			$ratio = $width_orig / $height_orig;

			$targetWidth = $targetHeight = min($size, max($width_orig, $height_orig));

			if ($ratio < 1) {
				$targetWidth = $targetHeight * $ratio;
			} else {
				$targetHeight = $targetWidth / $ratio;
			}

			$srcWidth = $width_orig;
			$srcHeight = $height_orig;
			$srcX = $srcY = 0;

			$thumb = imagecreatetruecolor($targetWidth, $targetHeight);
			imagealphablending( $thumb, false );
			imagesavealpha( $thumb, true );
			imagecopyresampled($thumb, $image, 0, 0, $srcX, $srcY, $targetWidth, $targetHeight, $srcWidth, $srcHeight);
			
			switch (strtolower($format)) {

				case 'png':
				imagepng($thumb, $thumbPath, 9);
				$created=true;
				break;

				case 'gif':
				imagegif($thumb, $thumbPath);
				$created=true;
				break;

				default:
				imagejpeg($thumb, $thumbPath, $quality);
				$created=true;
				break;
			}

			imagedestroy($image);
			imagedestroy($thumb);
			return $created;    

		}

	/* ============================================================
		KEEP RATIO END
	============================================================ */


	/* ============================================================
		SQUARE RATIO START
	============================================================ */

		function createSquare($filepath, $thumbPath, $size, $quality=100){

			$created=false;
			$file_name  = pathinfo($filepath); 
			$format = $file_name['extension'];
			$image = imagecreatefromstring(file_get_contents($filepath));
			list($width_orig, $height_orig) = getimagesize($filepath);
			$ratio = $width_orig / $height_orig;
			$targetWidth = $targetHeight = min($size, max($width_orig, $height_orig));

			if($width_orig > $height_orig){
				$Imagemode = 'landscape';
			}

			if($width_orig < $height_orig) {
				$Imagemode = 'portrait';
			}

			if($width_orig == $height_orig) {
				$Imagemode = 'square';
			}

			if($Imagemode == 'landscape'){

				if ($ratio < 1) {

					$targetWidth = $targetHeight;

				} else {

					$targetHeight = $targetHeight;

				}

				$rest = $width_orig - $height_orig;
				$center = $height_orig;
				$srcHeight = $height_orig;
				$srcX = $rest/2;
				$srcY = 0;
				$srcWidth= $height_orig;

			}

			if($Imagemode == 'portrait'){

				if ($ratio < 1) {

					$targetWidth = $targetWidth;

				} else {

					$targetHeight = $targetWidth;

				}

				$rest = $height_orig - $width_orig;
				$center = $width_orig;
				$srcWidth = $width_orig;
				$srcY = $rest/2;
				$srcX = 0;
				$srcHeight = $width_orig;

			}

			if($Imagemode == 'square'){

				if ($ratio < 1) {

					$targetWidth = $targetWidth;

				} else {

					$targetHeight = $targetWidth;

				}

				$center = 0;
				$srcWidth = $width_orig;
				$srcHeight = $height_orig;
				$srcY = 0;
				$srcX = 0;

			}


			$thumb = imagecreatetruecolor($targetWidth, $targetHeight);
			imagealphablending( $thumb, false );
			imagesavealpha( $thumb, true );
			imagecopyresampled($thumb, $image, 0, 0, $srcX, $srcY, $targetWidth, $targetHeight, $srcWidth, $srcHeight);
			
			switch (strtolower($format)) {

				case 'png':
				imagepng($thumb, $thumbPath, 9);
				$created=true;
				break;

				case 'gif':
				imagegif($thumb, $thumbPath);
				$created=true;
				break;

				default:
				imagejpeg($thumb, $thumbPath, $quality);
				$created=true;
				break;

			}

			imagedestroy($image);
			imagedestroy($thumb);
			return $created;    

		}

	/* ============================================================
		SQUARE RATIO END
	============================================================ */


	/* ============================================================
		CUSTOM RATIO START
	============================================================ */

		function createCustomRatio($filepath, $thumbPath, $size, $quality=100){

			$created=false;
			$file_name  = pathinfo($filepath);  
			$format = $file_name['extension'];

			$image = imagecreatefromstring(file_get_contents($filepath));
			list($width_orig, $height_orig) = getimagesize($filepath);

			
			$ratio = $width_orig / $height_orig;
			$targetWidth = $targetHeight = min($size, max($width_orig, $height_orig));

			if($width_orig > $height_orig){
				$Imagemode = 'landscape';
			}

			if($width_orig < $height_orig) {
				$Imagemode = 'portrait';
			}

			if($width_orig == $height_orig) {
				$Imagemode = 'square';
			}

			if($Imagemode == 'landscape'){

				$targetWidth = $targetWidth;
				$targetHeight = 9 * $targetWidth / 16;

				if ($height_orig < $targetHeight) {

					$targetHeight = $targetHeight;
					$targetWidth = 16 * $targetHeight / 9;

				}

				$srcX = 0;
				$srcY = 0;

				$srcWidth = $width_orig;
				$srcHeight =  $height_orig;

			}

		
			if($Imagemode == 'portrait'){

				$targetWidth = $targetWidth;
				$targetHeight = 9 * $targetWidth / 16;

				$srcX = 0;
				$srcY = 0;

				$srcWidth = $width_orig;
				$srcHeight =  $targetHeight;

			}

			if($Imagemode == 'square'){

				$targetHeight = $targetHeight;
				$targetWidth = 16 * $targetHeight / 9;

				$srcX = 0;
				$srcY = $targetHeight - $height_orig/3;

				$srcWidth = $width_orig;
				$srcHeight = $height_orig/2;

			}

			$thumb = imagecreatetruecolor($targetWidth, $targetHeight);
			imagealphablending( $thumb, false );
			imagesavealpha( $thumb, true );
			imagecopyresampled($thumb, $image, 0, 0, $srcX, $srcY, $targetWidth, $targetHeight, $srcWidth, $srcHeight);
			
			switch (strtolower($format)) {
				case 'png':
				imagepng($thumb, $thumbPath, 9);
				$created=true;
				break;

				case 'gif':
				imagegif($thumb, $thumbPath);
				$created=true;
				break;

				default:
				imagejpeg($thumb, $thumbPath, $quality);
				$created=true;
				break;
			}

			imagedestroy($image);
			imagedestroy($thumb);
			return $created;  

		}

	/* ============================================================
		CUSTOM RATIO END
	============================================================ */

/* ============================================================
	THUMBNAILS FUNCTION END
============================================================ */


?>