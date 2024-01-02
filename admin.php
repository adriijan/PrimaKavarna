<?php
require "stranky.php";

session_start();
$chyba = "";

// zpracování přihlašovacího formuláře
if (array_key_exists("prihlasit", $_POST)) {
	$jmeno = $_POST["jmeno"];
	$heslo = $_POST["heslo"];

	if ($jmeno == "admin" && $heslo == "1234") {	//uzivatel zadal platné přihlašovací údaje
		$_SESSION["prihlasenyUzivatel"] = $jmeno;
	} else {	// špatné přihlašovací údaje
		$chyba = "Nesprávné přihlašovací údaje.";
	}
}

// zpracování tlačítka ODHLÁSIT
if (array_key_exists("odhlasit", $_POST)) {
	unset($_SESSION["prihlasenyUzivatel"]); // ze SESSIOn chceme odstranit prihlasenyUzivatel
	header("Location:?");
}

// zpracování akcí v administraci pouze pro přihlášené uživatele
if (array_key_exists("prihlasenyUzivatel", $_SESSION)) {

	// pomocná proměnná představující stránku, kterou zrovna editujeme:
	$instanceAktualniStranky = null;

	// zpracování výberu aktuální stránky:
	if (array_key_exists("stranka", $_GET)) {
		$idStranky = $_GET["stranka"];
		$instanceAktualniStranky = $seznamStranek[$idStranky];
	}

	// zpracování tlačítka PŘIDAT (pro přidání nové stránky)
	if (array_key_exists("pridat", $_GET)) {
		$instanceAktualniStranky = new Stranka("", "", "");
	}

	// zpracování mazání stránky
	if (array_key_exists("smazat", $_GET)) {
		$instanceAktualniStranky->smazat();
		// po smazání stránky se musíme přesměrovat "domů"
		header("Location: ?");
	}

	// zpracování formuláře pro uložení

	if (array_key_exists("ulozit", $_POST)) {

		// poznamenáme si původní ID, než si ho přepíšeme
		$puvodniId = $instanceAktualniStranky->id;

		// ukládání změn v ID, titulku a menu
		$instanceAktualniStranky->id = $_POST["id"];
		$instanceAktualniStranky->titulek = $_POST["titulek"];
		$instanceAktualniStranky->menu = $_POST["menu"];
		// zavoláme funkci pro uložení změněných hodnot do databáze
		$instanceAktualniStranky->ulozit($puvodniId);


		// ukládání změn v obsahu stránky
		$obsah = $_POST["obsah"]; // textarea má name="obsah"
		$instanceAktualniStranky->set_obsah($obsah);

		// přesměrování na URL s editací stránky s novým ID (kdyby se ID změnilo, tak nesmíme zůstat na původní URL)
		header("Location: ?stranka=" . urlencode($instanceAktualniStranky->id));
	}

	// zpracování požadavku změny pořadí stránek z javascriptu (ajaxem)
	if (array_key_exists("poradi", $_GET)) {
		$poradi = $_GET["poradi"];

		// zavolání funkce pro nastavení pořadí a uložení do databáze:
		Stranka::nastavitPoradi($poradi);

		// odpovíme JS, že je to OK a ukončíme script, aby se do JS negeneroval zbytek HTML stránky:
		echo "OK"; // jen pro naši kontrolu v Developer tools -> Network
		exit;
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="fontawesome/fontawesome-free-6.4.2-web/css/all.min.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="./css/admin.css">
	<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
	<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

</head>

<body>
	<div class="admin-body">
		<?php
		if (array_key_exists("prihlasenyUzivatel", $_SESSION) == false) // pokud není uživatel přihlášený, zobrazí se formulář:
		{
		?> <!-- konec PHP, můžeme psát HTML kód: -->

			<main class="form-signin w-100 m-auto">
				<form method="post">
					<h1 class="h3 mb-3 fw-normal">Přihlašte se prosím</h1>

					<?php
					if ($chyba != "") { ?>
						<div class="alert alert-dark" role="alert">
							<?php echo $chyba ?>
						</div>
					<?php } ?>

					<div class="form-floating">
						<input type="text" class="form-control" id="floatingInput" placeholder="login" name="jmeno">
						<label for="floatingInput">Přihlašovací jméno</label>
					</div>
					<div class="form-floating">
						<input type="password" class="form-control" id="floatingPassword" placeholder="heslo" name="heslo">
						<label for="floatingPassword">Heslo</label>
					</div>
					<button class="btn btn-primary w-100 py-2" type="submit" name="prihlasit">Přihlásit</button>
				</form>
			</main>

		<?php // znovu otevřu PHP
		} else { // pokud je  uživatel přihlášený, dostane se do SEKCE PRO PŘIHLÁŠENÉ
			echo "<main class='admin'>";
		?>
			<div class="container">
				<header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
					<div>Přihlášený uživatel:
						<?php
						echo $_SESSION['prihlasenyUzivatel'];
						?>
					</div>
					<div class="col-md-3 text-end">
						<form method='post'>
							<button name='odhlasit' class="btn btn-outline-primary me-2"> Odhlásit </button>
						</form>
					</div>
				</header>
			</div>
			<?php


			// vypíšeme seznam stránek, které chceme editovat:
			echo "<ul id='stranky' class='list-group'>";
			foreach ($seznamStranek as $idStranky => $instanceStranky) {
				$active = '';
				$buttonClass = 'btn-primary';
				if ($instanceStranky == $instanceAktualniStranky) {
					$active = 'active';
					$buttonClass = 'btn-secondary';
				}
				echo "<li class='list-group-item $active' id='$instanceStranky->id'>
			 <a class='btn $buttonClass' href='?stranka=$instanceStranky->id'><i class='fa-solid fa-pen-to-square'></i></a>

			 <a class='smazat btn $buttonClass' href='?stranka=$instanceStranky->id&smazat'><i class='fa-solid fa-trash-can'></i></a>

			 <a class='btn $buttonClass' href='$instanceStranky->id' target='_blank'><i class='fa-solid fa-eye'></i></a> 
			 <span>$instanceStranky->id</span>
			</li>";
			}
			echo "</ul>";

			// formulář s tlačítkem pro přidání stránky
			?>

			<div class="container">
				<header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
					<div class="col-md-3 text-start">
						<form><button name='pridat' class="btn btn-outline-primary me-2">Přidat</button></form>
					</div>
				</header>
			</div>

			<?php

			// editační formulář 
			// chceme jej zobrazit, pokud je nějaká stránka vybraná k editaci - to poznáme podle toho, že proměnná $instanceAktualniStranky buďto je nebo není NULL
			if ($instanceAktualniStranky != null) {
				echo "<br><div class='alert alert-secondary' role='alert'><h1>";
				if ($instanceAktualniStranky->id == "") {
					echo "Přidání nové stránky";
				} else {
					echo "Editace stránky: $instanceAktualniStranky->id";
				}
				echo "</h1></div>";

			?>

				<form method="post">
					<div class="form-floating">
						<input class="form-control" placeholder="Id" type="text" name="id" id="id" value="<?php echo htmlspecialchars($instanceAktualniStranky->id) ?>">
						<label for="id"> Id</label>
					</div>

					<div class="form-floating">
						<input class="form-control" placeholder="Titulek" type="text" name="titulek" id="titulek" value="<?php echo htmlspecialchars($instanceAktualniStranky->titulek) ?>">
						<label for="titulek"> Titulek</label>
					</div>

					<div class="form-floating">
						<input class="form-control" placeholder="Menu" type="text" name="menu" id="menu" value="<?php echo htmlspecialchars($instanceAktualniStranky->menu) ?>">
						<label for="menu"> Menu</label>
					</div>
					<br>

					<textarea id="obsah" name="obsah" rows="15" cols="80">
				<?php // chceme vypsat obsah aktuální stránky - zde je však nutné říct, že speciální znaky <> nejsou HTML znaky - musíme použít escapování pomocí HTML entit - funkce HTMLSPECIALCHARS:
				echo htmlspecialchars($instanceAktualniStranky->get_obsah());
				?>
			</textarea>
					<br>
					<button class="btn btn-primary" name="ulozit"><i class="fa-solid fa-floppy-disk"></i> Uložit</button>
				</form>
				<script src="vendor\tinymce\tinymce\tinymce.min.js" referrerpolicy="origin"></script>
				<script>
					tinymce.init({
						selector: '#obsah',
						language: 'cs',
						language_url: '<?php echo dirname($_SERVER["PHP_SELF"]); ?>/vendor/tweeb/tinymce-i18n/langs/cs.js',
						height: '50vw',
						entity_encoding: 'raw',
						verify_html: false,
						content_css: [
							'css/reset.css',
							'css/style.css',
							'css/section.css',
							'css/header.css',
							'fontawesome/fontawesome-free-6.4.2-web/css/all.min.css',
							'fonts/kaushan-script-v16-latin_latin-ext-regular.woff2',
						],
						body_id: "content",
						plugins: 'advlist anchor autolink charmap code colorpicker contextmenu directionality emoticons fullscreen hr image imagetools insertdatetime link lists nonbreaking noneditable pagebreak paste preview print save searchreplace tabfocus table textcolor textpattern visualchars',
						toolbar1: "insertfile undo redo | styleselect | fontselect | fontsizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | forecolor backcolor",
						toolbar2: "link unlink anchor | fontawesome | image media | responsivefilemanager | preview code",
						external_plugins: {
							'responsivefilemanager': '<?php echo dirname($_SERVER['PHP_SELF']); ?>/vendor/primakurzy/responsivefilemanager/tinymce/plugins/responsivefilemanager/plugin.min.js',
						},
						external_filemanager_path: "<?php echo dirname($_SERVER['PHP_SELF']); ?>/vendor/primakurzy/responsivefilemanager/filemanager/",
						filemanager_title: "File manager",
					});
				</script>
		<?php
			}
			echo "</main>";
		}
		?>
	</div>

	<script src="./js/admin.js"></script>
</body>

</html>