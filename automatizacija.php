<?php
@session_start();
	if(isset($_REQUEST['btnAuto'])){
		if(isset($_REQUEST['cbAutoResize'])){
			$id=$_SESSION['idKorisnika'];
			$upit="SELECT putanja FROM slike WHERE checked=1 AND IdKorisnika=$id";
			include("konekcija.inc");
			$rez=mysqli_query($conn,$upit);
			$files=array();
			while($fajl=mysqli_fetch_array($conn,$rez)){
				$files[]=$fajl;
			}
			if(!empty($files)){
				foreach ($files as $file) {
					list($width, $height) = getimagesize($file['putanja']);
					$newwidth = $_REQUEST["duzinaSlike"];
					$newheight = $_REQUEST["visinaSlike"];
					$thumb = imagecreatetruecolor($newwidth, $newheight);
					$source = imagecreatefromjpeg($file['putanja']);
					imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
					imagejpeg($thumb,$file['putanja']);
				}
			}
		}
		if(isset($_REQUEST['cbAutoFilter'])){
			$id=$_SESSION['idKorisnika'];
			$upit="SELECT putanja FROM slike WHERE checked=1 AND IdKorisnika=$id";
			include("konekcija.inc");
			$rez=mysqli_query($conn,$upit);
			$files=array();
			while($fajl=mysqli_fetch_array($rez)){
				$files[]=$fajl;
			}
			if(!empty($files)){
				foreach ($files as $file) {
					$img;
					if(isset($_REQUEST['blackAndWhite'])){
						$img=imagecreatefromjpeg($file['putanja']);
						imagefilter($img, IMG_FILTER_GRAYSCALE);
						imagejpeg($img, $file['putanja']);
					}
					if(isset($_REQUEST['negate'])){
						$img=imagecreatefromjpeg($file['putanja']);
						imagefilter($img, IMG_FILTER_NEGATE);
						imagejpeg($img, $file['putanja']);
					}
					if(isset($_REQUEST['brightness'])){
						$img=imagecreatefromjpeg($file['putanja']);
						imagefilter($img, IMG_FILTER_BRIGHTNESS);
						imagejpeg($img, $file['putanja']);
					}
					if(isset($_REQUEST['contrast'])){
						$img=imagecreatefromjpeg($file['putanja']);
						imagefilter($img, IMG_FILTER_CONTRAST, $_REQUEST["contrastArg1"]);
						imagejpeg($img, $file['putanja']);
					}
					if(isset($_REQUEST['colorize'])){
						$img=imagecreatefromjpeg($file['putanja']);
						imagefilter($img, IMG_FILTER_COLORIZE, $_REQUEST["colorizeArg1"], $_REQUEST["colorizeArg2"], $_REQUEST["colorizeArg3"], $_REQUEST["colorizeArg4"]);
						imagejpeg($img, $file['putanja']);
					}
					if(isset($_REQUEST['edgedetect'])){
						$img=imagecreatefromjpeg($file['putanja']);
						imagefilter($img, IMG_FILTER_EDGEDETECT);
						imagejpeg($img, $file['putanja']);
					}
					if(isset($_REQUEST['emboss'])){
						$img=imagecreatefromjpeg($file['putanja']);
						imagefilter($img, IMG_FILTER_EMBOSS);
						imagejpeg($img, $file['putanja']);
					}
					if(isset($_REQUEST['gaussianBlur'])){
						$img=imagecreatefromjpeg($file['putanja']);
						imagefilter($img, IMG_FILTER_GAUSSIAN_BLUR);
						imagejpeg($img, $file['putanja']);
					}
					if(isset($_REQUEST['selectiveBlur'])){
						$img=imagecreatefromjpeg($file['putanja']);
						imagefilter($img, IMG_FILTER_SELECTIVE_BLUR);
						imagejpeg($img, $file['putanja']);
					}
					if(isset($_REQUEST['meanRemoval'])){
						$img=imagecreatefromjpeg($file['putanja']);
						imagefilter($img, IMG_FILTER_MEAN_REMOVAL);
						imagejpeg($img, $file['putanja']);
					}
					if(isset($_REQUEST['smooth'])){
						$img=imagecreatefromjpeg($file['putanja']);
						imagefilter($img, IMG_FILTER_SMOOTH, $_REQUEST["smoothArg1"]);
						imagejpeg($img, $file['putanja']);
					}
					if(isset($_REQUEST['pixelate'])){
						$img=imagecreatefromjpeg($file['putanja']);
						imagefilter($img, IMG_FILTER_PIXELATE, $_REQUEST['pixelateArg1']);
						imagejpeg($img, $file['putanja']);
					}
					
					
				imagedestroy($img);
				}
			}
		}
	}


		
header("location:index.php");
?>