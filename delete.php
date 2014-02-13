<?php
@session_start();

$upit="SELECT putanja FRom slike WHERE checked=1";
include("konekcija.inc");
$rez=mysqli_query($conn,$upit);
while($r=mysql_fetch_array($rez)){
	unlink($r['putanja']);
}
include("zatvori.inc");

$upit="DELETE FROM slike WHERE checked=1";
include("konekcija.inc");
mysqli_query($conn,$upit);
include("zatvori.inc");
if(!file_exists($_SESSION['img'])){
	unset($_SESSION['img']);
}
header("location:index.php");
?>