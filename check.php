<?php
@session_start();
if($_REQUEST['id']=="all"){
	$check=$_REQUEST['check'];
	$user=$_SESSION['idKorisnika'];
	$upit="UPDATE `slike` SET `checked`=$check WHERE IdKorisnika=$user";
	include("konekcija.inc");
	mysqli_query($conn,$upit);
	include("zatvori.inc");
}else{
	$id=$_REQUEST['id'];
	$check=$_REQUEST['check'];
	$upit="UPDATE `slike` SET `checked`=$check WHERE IdSlike=$id";
	include("konekcija.inc");
	mysqli_query($conn,$upit);
	include("zatvori.inc");
}
	
?>