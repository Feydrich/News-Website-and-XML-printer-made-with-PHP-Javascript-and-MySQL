<!DOCTYPE html>

<?php
include "connect.php";
session_start();
$autor=$_SESSION['User'];
$naslov = $_POST['Naslov'];
$sazetak = $_POST['Sazetak'];
$vijest = $_POST['Vijest'];
$kategorija = $_POST['Kategorija'];

$slika = $_FILES['Slika']['name'];
$datum=date('d.m.Y.');
if(isset($_POST['Arhiva'])){
		$archive=1;
	}
	else{
		$archive=0;
	} 
$target_dir = 'img/'.$slika;
move_uploaded_file($_FILES["Slika"]["tmp_name"], $target_dir);

$query = "INSERT INTO Clanci (datum, naslov, sazetak, tekst, slika, kategorija, arhiva, autor)
VALUES (?,?,?,?,?,?,?,?)";
        $ant = mysqli_stmt_init($dbc);

        if (mysqli_stmt_prepare($ant, $query)) {
            mysqli_stmt_bind_param($ant, 'ssssssis', $datum, $naslov, $sazetak, $vijest, $slika, $kategorija, $archive, $autor);
            mysqli_stmt_execute($ant);
        }
?>



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
				<h1> <?php echo "<p>&#9632;</p> " . $kategorija;?><h1>
				<h2><?php echo $naslov;?></h2>
				<h3>Autor: <?php echo $_SESSION['User'];?></h3>
				<h3>Objavljeno: <?php echo $datum;?></h3>
				<?php echo "<img src='img/$slika' width='100%' height='300px'>";?>
				<h4><?php echo $sazetak;?></h4>
				<p><?php echo $vijest;?></p>
			</div>
		</section>
		<footer>
			<p>@Tehničko Veleučilište u Zagrebu, Izradio: Filip Vasiljević, U sklopu kolegija: Programiranje Web Aplikacija i XML Programiranja</p>
		</footer>
	</div>
	</body>
</html>

