<?php
@session_start();
if(isset($_POST['btnUpload'])){
  $vreme = time();
  $fajl=$_FILES['slika'];
  if($fajl['type']='image/jpg'||$fajl['type']='image/jpeg'||$fajl['type']='image/png'){
    $ime_fajla=$fajl['name'];
    $tmp_name=$fajl['tmp_name'];
    $slika = "slike/".$vreme.$ime_fajla;
    move_uploaded_file($tmp_name,$slika);
    $_SESSION["img"]=$slika;
  }
}
header("location:index.php");
?>