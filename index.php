<?php
  @session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/stil.css">
	<link rel="stylesheet" href="css/jquery.Jcrop.min.css" type="text/css" />
  <script src="js/jquery-2.0.2.min.js"></script>
	<script src="js/jquery.Jcrop.min.js"></script>
  <script src="js/skripta.js"></script>
	<script type="text/javascript">
  //Podesava radni prostor prema rezoluciji
	function podesiProstor(){
    document.getElementById('radniProstor').style.height= (window.innerHeight - 50 + "px");
    document.getElementById('sidebar').style.height= (window.innerHeight - 50 + "px");
	}
	window.onresize = podesiProstor;
	</script>
	<script type="text/javascript">
  //Poziva funkcionalnosti za crop
		jQuery(function($){

    var jcrop_api;

    $('#slika').Jcrop({
      onChange:   showCoords,
      onSelect:   showCoords,
      onRelease:  clearCoords
    },function(){
      jcrop_api = this;
    });

    $('#coords').on('change','input',function(e){
      var x1 = $('#x1').val(),
          x2 = $('#x2').val(),
          y1 = $('#y1').val(),
          y2 = $('#y2').val();
      jcrop_api.setSelect([x1,y1,x2,y2]);
    });

  });

  // Simple event handler, called from onChange and onSelect
  // event handlers, as per the Jcrop invocation above
  function showCoords(c)
  {
    $('#x1').val(c.x);
    $('#y1').val(c.y);
    $('#x2').val(c.x2);
    $('#y2').val(c.y2);
    $('#w').val(c.w);
    $('#h').val(c.h);
  };

  function clearCoords()
  {
    $('#coords input').val('');
  };
	</script>
</head>
<body onload="podesiProstor()">
	<div id="kontrole">
    <span><p id="naslov">Diplomski</p></span>
    <?php
      if(isset($_SESSION['Username'])){
        echo "<span><i class='icon-picture'></i><input type='button' class='dugmici' id='multiUpload' value='Select pictures' onClick='multiUpload();'></span>";
      }else{
        echo "<span><i class='icon-picture'></i><input type='button' class='dugmici' id='new' value='Select picture' onClick='novaSlika();'></span>";
      }
    ?>
    <span>
      <form name="crop" id="crop" method="POST" action="crop.php">
          <input type="hidden" id="x1" name="x1" />
          <input type="hidden" id="y1" name="y1" />
          <input type="hidden" id="x2" name="x2" />
          <input type="hidden" id="y2" name="y2" />
          <input type="hidden" id="w" name="w" />
          <input type="hidden" id="h" name="h" />
          <i class='icon-crop'></i><input type="submit" class="dugmici" id="btnCrop" name="btnCrop" value="Crop">
      </form>
    </span>
    <?php
      if(isset($_SESSION['Username'])){
        echo "<span><i class='icon-gallery'></i><input type='button' class=dugmici' id='gallery' value='Show pictures' onClick='openGallery()'></span>";
        echo "<span><i class='icon-cog'></i><input type='button' class='dugmici' value='Options' name='automate' onClick='automatizacijaSlika()'></span>";
        echo "<span><i class='icon-floppy'></i><input type='button' class='dugmici' value='Save pictures' name='Save' onClick='saveSlike()'></span> ";
        echo "<span><i class='icon-trash'></i><input type='button' class='dugmici' value='Delete picture' name='Delete' onClick='deleteSlike()'></span> ";
        echo "<span><i class='icon-user'></i><input type='button' class=dugmici' id='userOptions' value='".$_SESSION['Username']."' onClick='userOptions()'></span>";

      }else{
        echo "<span><i class='icon-resize-small'></i><input type='button' class='dugmici' id='resize' value='Resize' onClick='resizeSlike();'></span>";
        echo "<span><i class='icon-camera'></i><input type='button' class='dugmici' id='filter' value='Filter' onClick='filterSlike();'></span>";
        echo "<span><i class='icon-floppy'></i><input type='button' class='dugmici' value='Save picture' name='Save' onClick='saveSlike()'></span> ";
        echo "<span><i class='icon-user'></i><input type='button' class='dugmici' id='login' value='Log in' onClick='login();'></span>";
      }
    ?>
    
  </div>

	<div id="radniProstor">
    <?php
      if(isset($_SESSION["img"])){
        echo "<img id='slika' src='".$_SESSION["img"]."?fix=".time()."'alt='[Jcrop Example]''>";
      }
    ?>  
	</div>
	<div id="properties"></div>
  <div id="sidebar">
    
    <?php
    echo "<div class='slicice'>";
    echo "<input type='checkbox' id='slike_master' value='all' onclick='togglecheckboxes(this,\"slike[]\");checkChange(this);'> Select All";
    echo "</div>";
      if(isset($_SESSION['idKorisnika'])){
        $upit="SELECT * FROM slike WHERE IdKorisnika = '".$_SESSION['idKorisnika']."' ORDER BY IdSlike DESC";
        include('konekcija.inc');
        $rez = mysqli_query($conn,$upit);
        include('zatvori.inc');
        $i=0;
        while($r=mysqli_fetch_array($rez)){
          echo "<div class='slicice'>";
          if($r['checked']==1){
            echo "<input type='checkbox' id='pic$i' name='slike[]' value=".$r['IdSlike']." checked onChange='checkChange(this)'>";
          }else{
            echo "<input type='checkbox' id='pic$i' name='slike[]' value=".$r['IdSlike']." onChange='checkChange(this)'>";
          }
          echo "<img class='sidebarSlike'src=".$r['putanja']."?xif=".time()." onClick='selektujSliku(this)'>";
          echo "</div>";
          $i++;
        }
      }
    ?>
   
  </div>
  <div id="skriveniPodaci">

    <?php
    if(isset($_SESSION['img'])){
      $pic = getimagesize($_SESSION["img"]);
      echo "<input type='hidden' id='xSlike' value='".$pic[0]."''>";
      echo "<input type='hidden' id='ySlike' value='".$pic[1]."''>";

    }
      
    ?>
  </div>
</body>
</html>