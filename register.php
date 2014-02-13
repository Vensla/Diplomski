<?php
	$user=$_POST['Username'];
	$pass=md5($_POST['Password']);
	$name=$_POST['Name'];
	$last=$_POST['Last'];
	$email=$_POST['Email'];
	$upit="SELECT Username FROM korisnici WHERE Username='$user'";
	include("konekcija.inc");
	$rez=mysqli_query($conn,$upit);
	include("zatvori.inc");
	if(mysqli_num_rows($rez)==null){
		$upit= "INSERT INTO `korisnici`(`IdKorisnika`, `Username`, `Password`, `Ime`, `Prezime`, `Email`) VALUES ('','$user','$pass','$name','$last','$email')";
		include("konekcija.inc");
		mysqli_query($conn,$upit);
		include("zatvori.inc");
		echo "Success";
	}else{
		echo "Username already in use";
	}
?>