<?php
require "vendor/autoload.php";
require "stranky.php";

if (array_key_exists("stranka", $_GET)) {
	$stranka = $_GET["stranka"];

	// kontrola, zda-li zadaná stránka existuje:
	if (array_key_exists($stranka, $seznamStranek) ==  false) {
		// stránka neexistuje
		$stranka = "404";

		// odeslat informaci i vyhledávači, že URL neexistuje
		http_response_code(404);
	}
} else {
	// zjsitíme první stránku z pole seznamStranek
	$stranka = array_key_first($seznamStranek);
	// nebo $stranka = array_keys($seznamStranek)[0]; -> vrátí seznam všech klíčů, proto přidáváme index [0]

}

?>

<!DOCTYPE html>
<html lang="cs">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>
		<?php echo $seznamStranek[$stranka]->titulek;
		?>
	</title>
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/header.css">
	<link rel="stylesheet" href="css/section.css">
	<link rel="stylesheet" href="css/footer.css">
	<link rel="shortcut icon" href="img/favicon.png">

	<link rel="stylesheet" href="fontawesome/fontawesome-free-6.4.2-web/css/all.min.css">
	<link rel="stylesheet" href="vendor/photoswipe/dist/photoswipe.css">

	<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

</head>

<body>
	<header> <!--HLAVIČKA-->
		<menu>
			<div class="container">
				<a href="uvod" class="logo">
					<img src="img/logo.png" alt="Logo PrimaKavárna" width="142px" height="80px">
				</a>
				<nav>
					<ul>
						<?php
						foreach ($seznamStranek as $idStranky => $instanceStranky) {
							if ($instanceStranky->menu != "") {
								echo "<li><a href='$idStranky'>$instanceStranky->menu</a></li>";
							}
						}
						?>
					</ul>
				</nav>
			</div>
		</menu>

		<div class="nadpis">
			<h2>PrimaKavárna</h2>
			<h3>Jsme tu pro vás již od roku 2002</h3>
			<div class="social">
				<a href="https://www.facebook.com" target="_blank"><i class="fa-brands fa-facebook"></i></a>
				<a href="https://www.instagram.com" target="_blank"><i class="fa-brands fa-instagram"></i></a>
				<a href="https://www.youtube.com" target="_blank"><i class="fa-brands fa-youtube"></i></a>

			</div>
		</div>
	</header>

	<section id="content"> <!--OBSAH-->
		<?php

		$obsah = $seznamStranek[$stranka]->get_obsah();
		echo primakurzy\Shortcode\Processor::process('shortcodes', $obsah);

		?>
	</section>

	<footer> <!--PATIČKA-->
		<div class="container">
			<nav>
				<h3>Menu</h3>
				<ul>
					<?php
					foreach ($seznamStranek as $idStranky => $instanceStranky) {
						if ($instanceStranky->menu != "") {
							echo "<li><a href='$idStranky'>$instanceStranky->menu</a></li>";
						}
					}
					?>
				</ul>
			</nav>
			<div class="kontakt">
				<h3>Kontakt</h3>
				<address>
					<a href="https://mapy.cz/s/jajecerazu" target="_blank">
						PrimaKavárna <br>
						Jablonského 2 <br>
						Praha, Holešovice
					</a>
				</address>
			</div>

			<div class="otevreno">
				<h3>Otevřeno</h3>
				<table>
					<tr>
						<th>Po - pá:</th>
						<td>8h - 20h</td>
					</tr>
					<tr>
						<th>So:</th>
						<td>10h - 22h</td>
					</tr>
					<tr>
						<th>Ne:</th>
						<td>12h - 20h</td>
					</tr>
				</table>
			</div>
		</div>
	</footer>

	<!-- tlačítko pro návrah nahoru (pomocí JS) -->
	<div id="nahoru">
		<i class="fa-solid fa-angle-up"></i>
	</div>

	<script src="./js/index.js"></script>
</body>

</html>