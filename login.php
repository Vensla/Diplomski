<?php
@session_start();
if(!isset($_SESSION['username'])){
	$user=$_REQUEST['tbUserName'];
	$pass=md5($_REQUEST['tbPassword']);
	$upit="SELECT Username,idKorisnika FROM korisnici WHERE Username='$user' AND Password='$pass'";
	include('konekcija.inc');
	$rez=mysqli_query($conn,$upit);
	include('zatvori.inc');
	if(mysqli_num_rows($rez)==1){
		$korisnik=mysqli_fetch_assoc($rez);
		$_SESSION['idKorisnika']=$korisnik['idKorisnika'];
        $_SESSION['Username']=$korisnik['Username'];
	}
}
header("location:index.php");

?>