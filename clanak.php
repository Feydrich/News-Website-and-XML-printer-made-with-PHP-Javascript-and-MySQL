<?php
session_start();
include "connect.php";
$id=$_GET["id"];
$query = "SELECT * FROM clanci WHERE id = $id";
$result = mysqli_fetch_array(mysqli_query($dbc, $query));
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
		<section class="Clanak">
			<div>
				<h1> <?php echo "<p>&#9632;</p> " . $result['kategorija'];?><h1>
				<h2><?php echo $result['naslov'];?></h2>
				<h3>Autor: <?php echo $result['autor'];?></h3>
				<h3>Objavljeno: <?php echo $result['datum'] ?></h3>
				<?php echo "<img src='img/" .$result['slika'] . "' width='100%' height='300px'>";?>
				<h4><?php echo $result['sazetak'];?></h4>
				<p><?php echo $result['tekst'];?></p>
			</div>
		</section>
		<footer>
			<p>@Tehničko Veleučilište u Zagrebu, Izradio: Filip Vasiljević, U sklopu kolegija: Programiranje Web Aplikacija i XML Programiranja</p>
		</footer>
	</div>
	</body>
</html>

