<?php
include "connect.php";
session_start();
$kategorija=$_GET["kategorija"];
$query = "SELECT * FROM clanci WHERE kategorija = $kategorija";
$result = mysqli_query($dbc, $query);
if($kategorija=="'Ferelden'")
	$kategorija="Ferelden";
if($kategorija=="'Orlais'")
	$kategorija="Orlais";
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
		?>
		<hr/>
		<h1> <?php echo "<p>&#9632;</p> " . $kategorija;?><h1>
		<section>
		<?php
			while($row=mysqli_fetch_array($result)){
				echo "<a href='clanak.php?id=" . $row['id'] . "'><article class='categoryView'><h2>" . $row['naslov'] . "</h2><img src='img/" . $row['slika'] . "' > <div><h3>Autor: " . $row['autor'] . " </h3><h3> Izdano: " . $row['datum'] . "</h3><br/><h4>" . $row['sazetak'] . "</h4><p>" . $row['tekst'] . "</p></div></article></a>";
			}
		
		?>
		
		</section>
		
		
		<footer>
			<p>@Tehničko Veleučilište u Zagrebu, Izradio: Filip Vasiljević, U sklopu kolegija: Programiranje Web Aplikacija i XML Programiranja</p>
		</footer>
	</div>
	</body>
</html>

