function novaSlika(){
	document.getElementById('properties').style.display="block";
	document.getElementById('properties').innerHTML="<form method='POST' action='new.php' name='uploadSlike' id='uploadSlike' class='forma' enctype='multipart/form-data'>"+
	"<input type='file' name='slika'><br/><br/><input type='submit' name='btnUpload' value='Upload'><input type='button' value='Cancel' onClick='sakriProperties();'></form>";
}
function multiUpload(){
	document.getElementById('properties').style.display="block";
	document.getElementById('properties').innerHTML="<form method='POST' action='multiupload.php' name='multiUpload' id='multiUpload' class='forma' enctype='multipart/form-data'>"+
	"<input type='file' name='slike[]' multiple=''><br/><br/><input type='submit' name='btnMultiUpload' value='Upload'><input type='button' value='Cancel' onClick='sakriProperties();'></form>";
}
function resizeSlike(){
	document.getElementById('properties').style.display="block";
	var x=document.getElementById('xSlike').value;
	var y=document.getElementById('ySlike').value;
	document.getElementById('properties').innerHTML="<form method='POST' action='resize.php' name='resizeSlike' class='forma' id='resizeSlike'>"+
	"<input type='text' placeholder='Horizontal = "+x+"' name='duzinaSlike'><br/><br/><input type='text' placeholder='Vertical = "+y+"' name='visinaSlike'><br/>"+
	"<br/><input type='submit' name='btnResize' value='Resize'><input type='button' value='Cancel' onClick='sakriProperties();'></form>";
}
function filterSlike(){
	document.getElementById('properties').style.display="block";
	document.getElementById('properties').innerHTML="<form method='POST' action='filter.php' name='filterSlike' class='forma' id='filterSlike'>"+
	"<select id='imeFiltera'name='imeFiltera' onchange='pokaziSlajder();'>"+
		"<option value='blackAndWhite'>Black and white</option>"+
		"<option value='negate'>Negate</option>"+
		"<option value='brightness'>Brightness</option>"+
		"<option value='contrast'>Contrast</option>"+
		"<option value='colorize'>Colorize</option>"+
		"<option value='edgedetect'>Edge detect</option>"+
		"<option value='emboss'>Emboss</option>"+
		"<option value='gaussianBlur'>Gaussian blur</option>"+
		"<option value='selectiveBlur'>Selective blur</option>"+
		"<option value='meanRemoval'>Mean removal</option>"+
		"<option value='smooth'>Smooth</option>"+
		"<option value='pixelate'>Pixelate</option>"+
	"</select><br/><br/>"+
	"<div id='slajderi'></div>"+
	"<input type='submit' name='btnFilter' value='Apply'><input type='button' value='Cancel' onClick='sakriProperties();'></form>";
}
function sakriProperties(){
	document.getElementById('properties').innerHTML="";
	document.getElementById('properties').style.display="none";
}
function pokaziSlajder(){
	var lista = document.getElementById("imeFiltera");
	var izabrano = lista.options[lista.selectedIndex].value;
	switch(izabrano){
		case "brightness":
			document.getElementById('slajderi').innerHTML = "<p id='arg1Prikaz'>0</p><input name='arg1' type='range' min='-255' max='255' value='0' step='1' onChange='sliderChange(this.value,this.name);'>";
			break;
		case "contrast":
			document.getElementById('slajderi').innerHTML = "<p id='arg1Prikaz'>0</p><input name='arg1' type='range' min='-100' max='100' value='0' step='1' onChange='sliderChange(this.value,this.name);'>";
			break;
		case "smooth":
			document.getElementById('slajderi').innerHTML = "<p id='arg1Prikaz'>0</p><input name='arg1' type='range' min='-8' max='8' value='0' step='1' onChange='sliderChange(this.value,this.name);'>";
			break;
		case "pixelate":
			document.getElementById('slajderi').innerHTML = "<p id='arg1Prikaz'>0</p><input name='arg1' type='range' min='0' max='255' value='0' step='1' onChange='sliderChange(this.value,this.name);'>";
			break;
		case "colorize":
			document.getElementById('slajderi').innerHTML = "<p>Red</p><p id='arg1Prikaz'>0</p><input name='arg1' type='range' min='-255' max='255' value='0' step='1' onChange='sliderChange(this.value,this.name);'>";
			document.getElementById('slajderi').innerHTML += "<p>Green</p><p id='arg2Prikaz'>0</p><input name='arg2' type='range' min='-255' max='255' value='0' step='1' onChange='sliderChange(this.value,this.name);'>";
			document.getElementById('slajderi').innerHTML += "<p>Blue</p><p id='arg3Prikaz'>0</p><input name='arg3' type='range' min='-255' max='255' value='0' step='1' onChange='sliderChange(this.value,this.name);'>";
			document.getElementById('slajderi').innerHTML += "<p>Alfa</p><p id='arg4Prikaz'>0</p><input name='arg4' type='range' min='0' max='127' value='0' step='1' onChange='sliderChange(this.value,this.name);'>";
			break;
		default:
			document.getElementById('slajderi').innerHTML = "";
	}
	
}
function sliderChange(val,value) {
	document.getElementById(value+'Prikaz').innerHTML = val;
}
function automatizacijaSlika () {
	document.getElementById('properties').style.display="block";
	document.getElementById('properties').innerHTML="<form method='POST' action='automatizacija.php' name='automate' class='forma' id='automatizacija'>"+
	"<input type='checkbox' name='cbAutoResize'value='resize' onChange='automatizacijaPrikaz(this);'> Resize<br/><div id='autoResize'></div>"+
	"<input type='checkbox' name='cbAutoFilter'value='filter' onChange='automatizacijaPrikaz(this);'> Filter<br/><div id='autoFilter'></div>"+
	"<input type='submit' name='btnAuto' value='Run'>&nbsp&nbsp<input type='button' value='Cancel' onClick='sakriProperties();'></form>";

}
function automatizacijaPrikaz(cb){
	if(cb.value=="resize"&& cb.checked){
		document.getElementById("autoResize").innerHTML="<input type='text' name='duzinaSlike' placeholder='Horizontal'><br/><br/><input type='text' name='visinaSlike' placeholder='Vertical'><br/><br/>"
	}else if(cb.value=="resize"&& !cb.checked){
		document.getElementById("autoResize").innerHTML="";
	}else if(cb.value=="filter"&& cb.checked){
		document.getElementById("autoFilter").innerHTML="<div id='autoFilteri'>"+
		"<input type='checkbox' name='blackAndWhite' value='blackAndWhite'>Black and white<br/>"+
		"<input type='checkbox' name='negate' value='negate'>Negate<br/>"+
		"<input type='checkbox' onChange='autoSlajder(this);' name='brightness' value='brightness'>Brightness<br/><div id='brightness'></div>"+
		"<input type='checkbox' onChange='autoSlajder(this);' name='contrast' value='contrast'>Contrast<br/><div id='contrast'></div>"+
		"<input type='checkbox' onChange='autoSlajder(this);' name='colorize' value='colorize'>Colorize<br/><div id='colorize'></div>"+
		"<input type='checkbox' name='edgedetect' value='edgedetect'>Edge detect<br/>"+
		"<input type='checkbox' name='emboss' value='emboss'>Emboss<br/>"+
		"<input type='checkbox' name='gaussianBlur' value='gaussianBlur'>Gaussian blur<br/>"+
		"<input type='checkbox' name='selectiveBlur' value='selectiveBlur'>Selective blur<br/>"+
		"<input type='checkbox' name='meanRemoval' value='meanRemoval'>Mean removal<br/>"+
		"<input type='checkbox' onChange='autoSlajder(this);' name='smooth' value='smooth'>Smooth<br/><div id='smooth'></div>"+
		"<input type='checkbox' onChange='autoSlajder(this);' name='pixelate' value='pixelate'>Pixelate<br/><div id='pixelate'></div>"+
		"</div>";
	}else if(cb.value=="filter"&& !cb.checked){
		document.getElementById("autoFilter").innerHTML="";
	}
	
}
function autoSlajder(cb){
	if(cb.checked){
		switch(cb.value){
		case "brightness":
			document.getElementById('brightness').innerHTML = "<p id='brightnessArg1Prikaz'>0</p><input name='brightnessArg1' type='range' min='-255' max='255' value='0' step='1' onChange='sliderChange(this.value,this.name);'>";
			break;
		case "contrast":
			document.getElementById('contrast').innerHTML = "<p id='contrastArg1Prikaz'>0</p><input name='contrastArg1' type='range' min='-100' max='100' value='0' step='1' onChange='sliderChange(this.value,this.name);'>";
			break;
		case "smooth":
			document.getElementById('smooth').innerHTML = "<p id='smoothArg1Prikaz'>0</p><input name='smoothArg1' type='range' min='-8' max='8' value='0' step='1' onChange='sliderChange(this.value,this.name);'>";
			break;
		case "pixelate":
			document.getElementById('pixelate').innerHTML = "<p id='pixelateArg1Prikaz'>0</p><input name='pixelateArg1' type='range' min='0' max='255' value='0' step='1' onChange='sliderChange(this.value,this.name);'>";
			break;
		case "colorize":
			document.getElementById('colorize').innerHTML = "<p>Red</p><p id='colorizeArg1Prikaz'>0</p><input name='colorizeArg1' type='range' min='-255' max='255' value='0' step='1' onChange='sliderChange(this.value,this.name);'>";
			document.getElementById('colorize').innerHTML += "<p>Green</p><p id='colorizeArg2Prikaz'>0</p><input name='colorizeArg2' type='range' min='-255' max='255' value='0' step='1' onChange='sliderChange(this.value,this.name);'>";
			document.getElementById('colorize').innerHTML += "<p>Blue</p><p id='colorizeArg4Prikaz'>0</p><input name='colorizeArg3' type='range' min='-255' max='255' value='0' step='1' onChange='sliderChange(this.value,this.name);'>";
			document.getElementById('colorize').innerHTML += "<p>Alfa</p><p id='colorizeArg4Prikaz'>0</p><input name='colorizeArg4' type='range' min='0' max='127' value='0' step='1' onChange='sliderChange(this.value,this.name);'>";
			break;
		}
	}else{
		switch(cb.value){
		case "brightness":
			document.getElementById('brightness').innerHTML = "";
			break;
		case "contrast":
			document.getElementById('contrast').innerHTML = "";
			break;
		case "smooth":
			document.getElementById('smooth').innerHTML = "";
			break;
		case "pixelate":
			document.getElementById('pixelate').innerHTML = "";
			break;
		case "colorize":
			document.getElementById('colorize').innerHTML = "";
			break;
		}
	
	}
	
}
function saveSlike() {
	window.location.replace("save.php");
}
function deleteSlike(){
	window.location.replace("delete.php");
}
function login () {
	document.getElementById('properties').style.display="block";
	document.getElementById('properties').innerHTML="<form method='POST' action='login.php' name='login' class='forma' id='login'>"+
	"<label for='tbUserName'>Username:</label><br/>"+
	"<input type='text' name='tbUserName' placeholder='Username'><br/>"+
	"<label for='tbPassword'>Password:</label><br/>"+
	"<input type='Password' name='tbPassword' placeholder='Password'><br/><br/>"+
	"<input type='button' value='Register' onClick='registracija();'><br/><input type='submit' name='btnLogin' value='Log in'><input type='button' value='Cancel' onClick='sakriProperties();'></form>";
}
function logout(){
	window.location.replace("logout.php");
}
function openGallery(){
	if($("#sidebar").css("display")=="none"){
		$('#sidebar').css("display","block");
		document.getElementById('radniProstor').style.width= (window.innerWidth - 200 + "px");
	}else{
		$('#sidebar').css("display","none");
		document.getElementById('radniProstor').style.width= (window.innerWidth + "px");


	}
}
function selektujSliku(img){
	window.location.replace("postaviSliku.php?img="+img.src);
}
function checkChange(cb){
	var vars = "id="+cb.value+"&check="+cb.checked;
	var hr=new XMLHttpRequest();
	hr.open("POST","check.php",true);
	hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	hr.send(vars);

}
function togglecheckboxes(master,group){
    var cbarray = document.getElementsByName(group);
    for(var i = 0; i < cbarray.length; i++){
        cbarray[i].checked = master.checked;
    }
}
function registracija(){
	document.getElementById("properties").style.display="block";
	document.getElementById("properties").innerHTML="<form name='registracija' class='forma' >"+
	"<label for='tbUserName'>Username:</label><br/>"+
	"<input type='textbox' id='tbUserName'name='tbUserName' placeholder='Username'><br/>"+
	"<p id='tbUserNameE' class='error'></p>"+
	"<label for='tbPassword'>Password:</label><br/>"+
	"<input type='password' id='tbPassword' name='tbPassword' placeholder='Password'><br/>"+
	"<p id='tbPasswordE' class='error'></p>"+
	"<label for='tbName'>Name:</label><br/>"+
	"<input type='textbox' id='tbName' name='tbName' placeholder='Name'><br/>"+
	"<p id='tbNameE' class='error'></p>"+
	"<label for='tbLast'>Lastname:</label><br/>"+
	"<input type='textbox' id='tbLast' name='tbLast' placeholder='Lastname'><br/>"+
	"<p id='tbLastE' class='error'></p>"+
	"<label for='tbEmail'>Email:</label><br/>"+
	"<input type='textbox' id='tbEmail' name='tbEmail' placeholder='Email'><br/>"+
	"<p id='tbEmailE' class='error'></p>"+
	"<p id='success' class='success'></p>"+
	"<br/><input type='button' value='Register' onClick='proveraReg();'><input type='button' value='Cancel' onClick='sakriProperties();'>"+
	"</form>";
}
function proveraReg(){
	var greske="";
	var regUser=/^[\w\n]{4,20}$/;
	var Username=document.getElementById("tbUserName").value;
	var regPass=/^[\w\n\S]{4,20}$/;
	var Pass=document.getElementById("tbPassword").value;
	var regName=/^[A-Z]{1}[a-z]{2,19}$/;
	var Name=document.getElementById("tbName").value;
	var regLast=/^[A-Z]{1}[a-z]{2,19}$/;
	var Last=document.getElementById("tbLast").value;
	var regEmail=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	var Email=document.getElementById("tbEmail").value;
	if(regUser.test(Username)){
		document.getElementById('tbUserNameE').innerHTML="";
	}else{
		document.getElementById('tbUserNameE').innerHTML="Must be longer than 4 characters";
		greske="error";
	}
	if(regPass.test(Pass)){
		document.getElementById('tbPasswordE').innerHTML="";
	}else{
		document.getElementById('tbPasswordE').innerHTML="Must be longer than 4 characters";
		greske="error";
	}
	if(regName.test(Name)){
		document.getElementById('tbNameE').innerHTML="";
	}else{
		document.getElementById('tbNameE').innerHTML="Must begin with a capital letter";
		greske="error";
	}
	if(regLast.test(Last)){
		document.getElementById('tbLastE').innerHTML="";
	}else{
		document.getElementById('tbLastE').innerHTML="Must begin with a capital letter";
		greske="error";
	}
	if(regEmail.test(Email)){
		document.getElementById('tbEmailE').innerHTML="";
	}else{
		document.getElementById('tbEmailE').innerHTML="Invalid mail";
		greske="error";
	}
	if (greske == "") {
    	var vars = "Username="+Username+"&Password="+Pass+"&Name="+Name+"&Last="+Last+"&Email="+Email;
		var hr=new XMLHttpRequest();
		hr.open("POST","register.php",true);
		hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		hr.onreadystatechange = function() {
		    if(hr.readyState == 4 && hr.status == 200) {
			    var return_data = hr.responseText;
				document.getElementById("success").innerHTML = return_data;
		    }
    	}
		hr.send(vars);

    }
}
function userOptions(){

}