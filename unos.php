<?php
session_start();

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF8"/>
		<meta name="author" content="Filip Vasiljević"/>
		<meta name="description" content="Projekt iz kolegija: Programiranje Web Aplikacija - TVZ  2019/2020"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<link rel="stylesheet" type="text/css" href="style.css">
		<title>Ferelden News</title>
		
	</head>

	<body>
	<div class="Main">
		<header>
			<h1>Ferelden News</h1>
			<h2>Everything happening this side of the veil</h2>
		</header>
		
		<nav>
		<a href="index.php">Home</a>
		<a href="kategorija.php?kategorija='Ferelden'">Ferelden</a>
		<a href="kategorija.php?kategorija='Orlais'">Orlais</a>
		<a href="XML printer.php">XML Printer</a>
		<?php
		if(empty($_SESSION['priveleges'])){
			echo "<a href='account.php'>Login - Registracija</a></nav>";			
		}
		else if($_SESSION['priveleges'] == 2){
			echo "<a href='unos.php'>Administracija - Unos</a><a href='edit.php'>Administracija - Edit</a> <a href='account.php'>Account</a></nav>";
		}
		
		else{
			echo "<a href='account.php'>Account</a></nav>";
		}
		?><hr/>
		<form enctype="multipart/form-data" action="insert.php" method="POST">
			<p>Unos novog članka:</p>
			<div>
				<label>Naslov vijesti:</label>
				<input type="text" id="Naslov" name="Naslov"/><br/>
				<span id="naslovMSG"></span> 

			</div></br>
			<div>
				<label>Kratki sažetak:</label></br>
				<textarea name="Sazetak" id="Sazetak" cols="30" rows="5"></textarea><br/>
				<span id="sazetakMSG"></span> 
			</div></br>
			<div>
				<label>Tekst vijesti:</label></br>
				<textarea name="Vijest" id="Vijest" cols="30" rows="10"></textarea><br/>
				<span id="vijestMSG"></span> 
			</div></br>
			<div>
				<label>Kategorija vijesti:</label>
				<select name="Kategorija" id="Kategorija">
					<option value="default">Odaberite kategoriju</option>
					<option value="Ferelden">Ferelden</option>
					<option value="Orlais">Orlais</option>
				</select><br/>
				<span id="kategorijaMSG"></span> 
			</div></br>
			<div>
				<label>Slika:</label>
				<input type="file" accept="image/png,image/jpg" id="Slika" name="Slika"/><br/>
				<span id="slikaMSG"></span> 
			</div>
			<div>
				<label>Spremit u arhivu:</label>
				<input type="checkbox" name="Arhiva"/>
			</div>	
			<div>
				<button type="reset" value="Poništi">Poništi</button>
				<button type="submit" id="slanje" value="Prihvati" name="submit">Prihvati</button>
			</div>
		</form>
		<footer>
			<p>@Tehničko Veleučilište u Zagrebu, Izradio: Filip Vasiljević, U sklopu kolegija: Programiranje Web Aplikacija i XML Programiranja</p>
		</footer>
	</div>
	</body>
	 <script type="text/javascript">
    	document.getElementById("slanje").onclick = function(event) {
			var slanjeForme = true;
			
			var poljeTitle = document.getElementById("Naslov");
			var naslov= document.getElementById("Naslov").value;
			if (naslov.length < 5 || naslov.length > 30) {
				slanjeForme = false;
				poljeTitle.style.border="1px dashed red";
				document.getElementById("naslovMSG").innerHTML="Naslov vjesti mora imati između 5 i 30 znakova!<br>";
			} else {
				poljeTitle.style.border="1px solid green";
				document.getElementById("naslovMSG").innerHTML="";
			}
			// Kratki sadržaj (10-100 znakova)
			var poljeAbout = document.getElementById("Sazetak");
			var about = document.getElementById("Sazetak").value;
			if (about.length < 10 || about.length > 100) {
				slanjeForme = false;
				poljeAbout.style.border="1px dashed red";
				document.getElementById("sazetakMSG").innerHTML="Kratki sadržaj mora imati između 10 i 100 znakova!<br>";
			} else {
				poljeAbout.style.border="1px solid green";
				document.getElementById("sazetakMSG").innerHTML="";
			}
			// Sadržaj mora biti unesen
			var poljeContent = document.getElementById("Vijest");
			var content = document.getElementById("Vijest").value;
			if (content.length == 0) {
				slanjeForme = false;
				poljeContent.style.border="1px dashed red";
				document.getElementById("vijestMSG").innerHTML="Sadržaj mora biti unesen!<br>";
			} else {
				poljeContent.style.border="1px solid green";
				document.getElementById("vijestMSG").innerHTML="";
			}
				// Slika mora biti unesena
			var poljeSlika = document.getElementById("Slika");
			var slika = document.getElementById("Slika").value;
			if (slika.length == 0) {
				slanjeForme = false;
				poljeSlika.style.border="1px dashed red";
				document.getElementById("slikaMSG").innerHTML="Slika mora biti unesena!<br>";
			} else {
				poljeSlika.style.border="1px solid green";
				document.getElementById("slikaMSG").innerHTML="";
			}
			// Kategorija mora biti odabrana
			var poljeCategory = document.getElementById("Kategorija");
			if(document.getElementById("Kategorija").selectedIndex == 0) {
				slanjeForme = false;
				poljeCategory.style.border="1px dashed red";
				document.getElementById("kategorijaMSG").innerHTML="Kategorija mora biti odabrana!<br>";
			} else {
				poljeCategory.style.border="1px solid green";
				document.getElementById("kategorijaMSG").innerHTML="";
			}
			if (slanjeForme != true) {
				event.preventDefault();
			}
		};
	</script> 
</html>



