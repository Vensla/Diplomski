<?php
@session_start();
	$id=$_SESSION['idKorisnika'];
	if($_POST['option']=="changePass"){
		$oldPass=md5($_POST['oldPass']);
		$newPass=md5($_POST['newPass']);
		$upit="SELECT * FROM korisnici WHERE idKorisnika='$id' AND Password='$oldPass'";
		include("konekcija.inc");
		$rez=mysqli_query($conn,$upit);
		include("zatvori.inc");
		if(mysqli_num_rows($rez)==1){
			$upit= "UPDATE `korisnici` SET `Password`='$newPass' WHERE idKorisnika='$id'";
			include("konekcija.inc");
			mysqli_query($conn,$upit);
			include("zatvori.inc");
			echo "Password change success";
		}else{
			echo "Password change fail";
		}
	}else{
		$mail=$_POST['Mail'];
		$upit="SELECT * FROM korisnici WHERE idKorisnika='$id'";
		include("konekcija.inc");
		$rez=mysqli_query($conn,$upit);
		include("zatvori.inc");
		if(mysqli_num_rows($rez)==1){
			$upit= "UPDATE `korisnici` SET `Email`='$mail' WHERE idKorisnika='$id'";
			include("konekcija.inc");
			mysqli_query($conn,$upit);
			include("zatvori.inc");
			echo "Email change success";
		}else{
			echo "Email change fail";
		}
	}
	
?>