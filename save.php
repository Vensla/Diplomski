<?php
@session_start();
	$files=array();
	if(isset($_SESSION['idKorisnika'])){
		$korisnik=$_SESSION['idKorisnika'];
		$upit="SELECT putanja FROM slike WHERE checked=1 AND IdKorisnika = $korisnik";
		include("konekcija.inc");
		$rez=mysqli_query($conn,$upit);
		while($fajl=mysqli_fetch_array($rez)){
			$files[]=$fajl;
		}
		include("zatvori.inc");
		if(!empty($files)){
			$zipname = time().'slike.zip';
			$zip = new ZipArchive;
			$zip->open($zipname, ZipArchive::CREATE);
			foreach ($files as $file) {
			  $zip->addFile($file['putanja']);
			}
			$zip->close();
			header('Content-Type: application/zip');
			header('Content-disposition: attachment; filename=slike.zip');
			header('Content-Length: ' . filesize($zipname));
			readfile($zipname);
		}
		echo "radi";
	}else{
		$file=$_SESSION['img'];
		if(!$file==""){
		$zipname = time().'slika.zip';
		$zip = new ZipArchive;
		$zip->open($zipname, ZipArchive::CREATE);
		$zip->addFile($file);
		$zip->close();
		header('Content-Type: application/zip');
		header('Content-disposition: attachment; filename=slike.zip');
		header('Content-Length: ' . filesize($zipname));
		readfile($zipname);

		}
	}
	
	header("location:index.php");
?>