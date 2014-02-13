<?php
@session_start();
if(isset($_POST['btnResize'])){
  $filename = $_SESSION["img"];
  list($width, $height) = getimagesize($filename);
  $newwidth = $_REQUEST["duzinaSlike"];
  $newheight = $_REQUEST["visinaSlike"];
  $thumb = imagecreatetruecolor($newwidth, $newheight);
  $source = imagecreatefromjpeg($filename);
  imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
  imagejpeg($thumb,$filename);

}
  header("location:index.php");
?>
