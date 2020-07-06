<!DOCTYPE html>
<?php
	session_start();
	//$_SESSION['priveleges'] = 2;
	include 'connect.php';
?>



<html>
	<head>
		<meta charset="UTF-8"/>
		<meta name="author" content="Filip Vasiljević"/>
		<meta name="description" content="Projekt iz kolegija: Programiranje Web Aplikacija - TVZ  2019/2020"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<link rel="stylesheet" type="text/css" href="style.css">
		<title>Ferelden News</title>
		
	</head>

	<body>
	<div class="Account">
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
		?>
		<hr/>
		
		<form enctype="multipart/form-data" action="" method="POST">
			<p>Vaši podaci:</p>
			<div>
				<label>Ime: </label>
				<input type="text" id="Name" name="Name"/><br/>
				<span id="imeMSG"></span> 
			</div></br>
			<div>
				<label>Prezme: </label>
				<input type="text" id="Surname" name="Surname"/><br/>
				<span id="prezimeMSG"></span> 
			</div></br>
			<div>
				<label>Korisničko ime: </label>
				<input type="text" id="Username" name="Username"/><br/>
				<span id="korisnicko_imeMSG"></span> 
			</div></br>
			<div>
				<label>Sifra: </label>
				<input type="text" id="Pass1" name="Pass1"/><br/>
			</div></br>
			<div>
				<label>Ponovljena šifra: </label>
				<input type="text" id="Pass2" name="Pass2"/><br/>
				<span id="sifraMSG"></span> 
			</div></br>
			
				<button type="reset" value="Poništi">Poništi</button>
				<button type="submit" id="slanje" value="Prihvati" name="submit">Prihvati</button>
			</div>
		</form>
		
		<script type="text/javascript">
    	document.getElementById("slanje").onclick = function(event) {
			
			var slanjeForme = true;
			
			var poljeIme = document.getElementById("Name");
			var ime = document.getElementById("Name").value;
			if (ime.length == 0) {
				
				slanjeForme = false;
				poljeIme.style.border="1px dashed red";
				document.getElementById("imeMSG").innerHTML="Ime ne smije biti prazno!<br>";
			} else {
				poljeIme.style.border="1px solid green";
				document.getElementById("imeMSG").innerHTML="";
			}
			
			var poljePIme = document.getElementById("Surname");
			var pime = document.getElementById("Surname").value;
			if (pime.length == 0) {
				slanjeForme = false;
				poljePIme.style.border="1px dashed red";
				document.getElementById("prezimeMSG").innerHTML="Prezime ne smije biti prazno!<br>";
			} else {
				poljePIme.style.border="1px solid green";
				document.getElementById("prezimeMSG").innerHTML="";
			}
			
			var poljeUIme = document.getElementById("Username");
			var uime = document.getElementById("Username").value;
			if (uime.length == 0) {
				slanjeForme = false;
				poljeUIme.style.border="1px dashed red";
				document.getElementById("korisnicko_imeMSG").innerHTML="Korisničko ime ne smije biti prazno!<br>";
			} else {
				poljeUIme.style.border="1px solid green";
				document.getElementById("korisnicko_imeMSG").innerHTML="";
			}
			
			var polje1 = document.getElementById("Pass1");
			var polje2 = document.getElementById("Pass2");
			var password1 = document.getElementById("Pass1").value;
			var password2 = document.getElementById("Pass2").value;
			if (password1 != password2) {
				slanjeForme = false;
				polje1.style.border="1px dashed red";
				polje2.style.border="1px dashed red";
				document.getElementById("sifraMSG").innerHTML="Šifre moraju biti iste!<br>";
			} else {
				poljeUIme.style.border="1px solid green";
				document.getElementById("sifraMSG").innerHTML="";
			}
			
			
			
			
			if (slanjeForme != true) {
				event.preventDefault();
			}
		};
		</script>
		
		<?php
			if (isset($_POST['submit'])) {
				$ime = $_POST['Name'];
				$prezime = $_POST['Surname'];
				$korisnicko_ime = $_POST['Username'];
				$sifra = $_POST['Pass1'];
				$Tsifra=password_hash($sifra, CRYPT_BLOWFISH);
				$privilege = 1;
				
				$sql = "INSERT INTO korisnik (ime,prezime,korisnicko_ime,lozinka,razina) VALUES (?,?,?,?,?)";
				$ant = mysqli_stmt_init($dbc);

				if (mysqli_stmt_prepare($ant, $sql)) {
					mysqli_stmt_bind_param($ant, 'sssss', $ime, $prezime, $korisnicko_ime, $Tsifra, $privilege);
					if(mysqli_stmt_execute($ant)){

						echo "<p>Uspješno ste se registrirali!</p>";

					}
					else{
						echo "<p>Istoimeni korisnik pronađen, probajte nešto drugo!<p>";
					};
				}

				mysqli_close($dbc);
				
			}
?>
		
		<footer>
			<p>@Tehničko Veleučilište u Zagrebu, Izradio: Filip Vasiljević, U sklopu kolegija: Programiranje Web Aplikacija i XML Programiranja</p>
		</footer>
	</div>
	</body>
</html>