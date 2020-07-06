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
		<section>
		<h1><p>&#9632;</p> Ferelden<h1>
			<?php
				$query = "SELECT * FROM clanci WHERE arhiva=0 AND kategorija='Ferelden' LIMIT 3";
				$result = mysqli_query($dbc, $query);
				while($row = mysqli_fetch_array($result)){
					echo "<article><a href = 'clanak.php?id=" .$row['id'] ."'><img src='img/" . $row['slika'] . "'/><h4>" . $row['naslov'] . "</h4></article></a>";
				}
			?>            
		</section>
		
		
		<section>
			<h1><p>&#9632;</p> Orlais<h1>
			<?php
				$query = "SELECT * FROM clanci WHERE arhiva=0 AND kategorija='Orlais' LIMIT 3";
				$result = mysqli_query($dbc, $query);
				while($row = mysqli_fetch_array($result)){
					echo "<article><a href = 'clanak.php?id=" .$row['id'] ."'><img src='img/" . $row['slika'] . "'/><h4>" . $row['naslov'] . "</h4></article></a>";
				}
			?>
		</section>
		
		<footer>
			<p>@Tehničko Veleučilište u Zagrebu, Izradio: Filip Vasiljević, U sklopu kolegija: Programiranje Web Aplikacija i XML Programiranja</p>
		</footer>
	</div>
	</body>
</html>