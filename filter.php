<?php
@session_start();
if(isset($_REQUEST['btnFilter'])){
	$imeSlike=$_SESSION['img'];
	$img=imagecreatefromjpeg($imeSlike);
	switch($_REQUEST['imeFiltera']){
		case "blackAndWhite":
			imagefilter($img, IMG_FILTER_GRAYSCALE);
			imagejpeg($img, $imeSlike);
			break;
		case "negate":
			imagefilter($img, IMG_FILTER_NEGATE);
			imagejpeg($img, $imeSlike);
			break;
		case "brightness":
			imagefilter($img, IMG_FILTER_BRIGHTNESS, $_REQUEST["arg1"]);
			imagejpeg($img,$imeSlike);
			break;
		case "contrast":
			imagefilter($img, IMG_FILTER_CONTRAST, $_REQUEST["arg1"]);
			imagejpeg($img,$imeSlike);
			break;
		case "colorize":
			imagefilter($img, IMG_FILTER_COLORIZE, $_REQUEST["arg1"], $_REQUEST["arg2"], $_REQUEST["arg3"], $_REQUEST["arg4"]);
			imagejpeg($img,$imeSlike);
			break;
		case "edgedetect":
			imagefilter($img, IMG_FILTER_EDGEDETECT);
			imagejpeg($img,$imeSlike);
			break;
		case "emboss":
			imagefilter($img, IMG_FILTER_EMBOSS);
			imagejpeg($img,$imeSlike);
			break;
		case "gaussianBlur":
			imagefilter($img, IMG_FILTER_GAUSSIAN_BLUR);
			imagejpeg($img,$imeSlike);
			break;
		case "selectiveBlur":
			imagefilter($img, IMG_FILTER_SELECTIVE_BLUR);
			imagejpeg($img,$imeSlike);
			break;
		case "meanRemoval":
			imagefilter($img, IMG_FILTER_MEAN_REMOVAL);
			imagejpeg($img,$imeSlike);
			break;
		case "smooth":
			imagefilter($img, IMG_FILTER_SMOOTH, $_REQUEST["arg1"]);
			imagejpeg($img,$imeSlike);
			break;
		case "pixelate":
			imagefilter($img, IMG_FILTER_PIXELATE, $_REQUEST['arg1']);
			imagejpeg($img,$imeSlike);
			break;
	}
	
imagedestroy($img);
}
header("location:index.php");
?>