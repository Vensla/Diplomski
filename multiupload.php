<?php
@session_start();
	if(isset($_REQUEST['btnMultiUpload'])){
		$vreme = time();
		for($i=0; $i < count($_FILES['slike']['name']);$i++){
			if($_FILES['slike']['type'][$i]='image/jpg'||$_FILES['slike']['type'][$i]='image/jpeg'||$_FILES['slike']['type'][$i]='image/png'){
				$ime_fajla=$_FILES['slike']['name'][$i];
				$tmp_name=$_FILES['slike']['tmp_name'][$i];
				$slika = "slike/".$vreme.$ime_fajla;
				move_uploaded_file($tmp_name,$slika);
				if($i==0){
					$_SESSION["img"]=$slika;
				}
				$upit="INSERT INTO slike (`IdSlike`, `IdKorisnika`, `putanja`,`checked`) VALUES (NULL, '".$_SESSION['idKorisnika']."', '$slika','1');";
			    include('konekcija.inc');
			    $rez=mysqli_query($conn,$upit);
			    include('zatvori.inc');
			}
		}
	}
	header("location:index.php");
?>