<?php
@session_start();
if(isset($_POST['btnCrop'])&& ($_REQUEST['x1']!=null)){
$filename =$_SESSION["img"];
$dst_x=0;
$dst_y=0;
$src_x=$_REQUEST["x1"];
$src_y=$_REQUEST["y1"];
$dst_w=$_REQUEST["w"];
$dst_h=$_REQUEST["h"];
$dst_image=imagecreatetruecolor($dst_w, $dst_h);
$src_image=imagecreatefromjpeg($filename);
imagecopyresampled($dst_image, $src_image, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $dst_w, $dst_h);
imagejpeg($dst_image,$filename);
imagedestroy($dst_image);

}
header("location:index.php");
?>