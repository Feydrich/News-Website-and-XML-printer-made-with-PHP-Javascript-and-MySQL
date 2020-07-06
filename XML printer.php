<?php
session_start();
include "connect.php";
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
		<div class='XMLPRINTER'><img src="XML printer.png"/></div>
		<form action="" method="POST">
			<label>Odabir vijesti za printanje:</label><br/>
			
				<?php
					$query = "SELECT * FROM clanci";
					$result = mysqli_query($dbc, $query);
					echo "<select name='index' id='xmlPrinter' name='Printer'>";
					while($row = mysqli_fetch_array($result)){
						echo "<option value='" . $row['id'] . "'>" . $row['datum'] . " [" . $row['kategorija'] . "] " . $row['naslov'] . "</option>";
					}
					echo "</select>";
				?> <input type="submit" name="XML-PRINTER" class="bigButton" value="XML PRINT!"/>
		</form>
		
		<?php
		if (isset($_POST['XML-PRINTER'])) {
		
		$index = $_POST['index'];
		
		$query = "SELECT * FROM clanci WHERE id = $index";
		$result = mysqli_fetch_array(mysqli_query($dbc, $query));

        $id=$result['id'];		
        $datum=$result['datum'];
        $naslov=$result['naslov'];
        $sazetak=$result['sazetak'];
        $tekst=$result['tekst'];
        $slika=$result['slika'];
        $kategorija=$result['kategorija'];
        $arhiva=$result['arhiva'];
        $autor=$result['autor'];
		
        $holder = "";

        $holder .= "<Clanak>\n";

        // Id clanka u bazi - auto inkrementirano
        $holder .= "<ID>" . $id . "</ID>\n";

        // datum unosa clanka u bazu
        $holder .= "<Datum>" . $datum. "</Datum>\n";

        // naslov clanka
        $holder .= "<Naslov>" . $naslov . "</Naslov>\n";

        // sazetak clanka
        $holder .= "<Sazetak>" . $sazetak . "</Sazetak>\n";

        // slika clanka
        $holder .= "<Slika>" . $slika . "</Slika>\n";
		
		//kategorija clanka
        $holder .= "<Kategorija>" . $kategorija . "</Kategorija>\n";
		
		//arhiva
        $holder .= "<Arhiva>" . $arhiva . "</Arhiva>\n";
		
		//autor clanka
        $holder .= "<Autor>" . $autor . "</Autor>\n";

        $holder .= "</Clanak>";
		
        $filename = "Clanak-" . $naslov . "-" . date("Y_m_d") . ".xml";
        file_put_contents($filename, $holder);
		
        die("Uspješno generiran XML!");
		
    }
?>
		
		
		
		
		<footer>
			<p>@Tehničko Veleučilište u Zagrebu, Izradio: Filip Vasiljević, U sklopu kolegija: Programiranje Web Aplikacija i XML Programiranja</p>
		</footer>
	</div>
	</body>
</html>