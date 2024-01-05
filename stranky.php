<?php

// vytvoření připojení na databázi:
$db = new PDO(
	"mysql:host=localhost;dbname=primakavarna;charset=utf8",
	"root",
	"",
	array(
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	)
);


class Stranka
{ 
	public $id;
	public $titulek;
	public $menu;

	function __construct($id, $titulek, $menu)
	{
		$this->id = $id;
		$this->titulek = $titulek;
		$this->menu = $menu;
	}

	function get_obsah()
	{
		// JIŽ NEPOTŘEBUJEME - return file_get_contents("$this->id.html");

		// chceme načíst obsah stránky z databáze
		global $db;

		$dotaz = $db->prepare("SELECT obsah FROM stranka WHERE id = ?");
		$dotaz->execute([$this->id]);

		$vysledek = $dotaz->fetch();

		// pokud by databáze nic nevrátila, tak vrátíme prázdný obsah
		if ($vysledek == false) {
			return "";
		} else {
			return $vysledek["obsah"];
		}
	}

	function set_obsah($obsah)
	{
		// JIŽ NEPOTŘEBUJEME - file_put_contents("$this->id.html", $obsah);

		// ukládání obsahu stránky do databáze
		global $db;

		$dotaz = $db->prepare("UPDATE stranka SET obsah = ? WHERE id = ?");
		$dotaz->execute([$obsah, $this->id]);
	}

	function ulozit($puvodniId)
	{
		global $db;

		if ($puvodniId != "") // pokud původní ID není prázdné, jde o aktualizaci existující stránky - UPDATE
		{
			$dotaz = $db->prepare("UPDATE stranka SET id = ?, titulek = ?, menu = ? WHERE id = ?");
			$dotaz->execute([$this->id, $this->titulek, $this->menu, $puvodniId]);
		} else // v opačném případě jde o přidání nové stránky - INSERT
		{
			// zjištění maximální hodnoty POŘADÍ:
			$dotaz = $db->prepare("SELECT MAX(poradi) AS poradi FROM stranka");
			$dotaz->execute();
			$vysledek = $dotaz->fetch();
			// vezmeme nejvyšší pořadí, které je v tabulce databáze, a navýšíme jej o číslo 1:
			$poradi = $vysledek["poradi"] + 1;

			$dotaz = $db->prepare("INSERT INTO stranka SET id = ?, titulek = ?, menu = ?, poradi = ?");
			$dotaz->execute([$this->id, $this->titulek, $this->menu, $poradi]);
		}
	}

	function smazat()
	{
		global $db;
		$dotaz = $db->prepare("DELETE FROM stranka WHERE id = ?");
		$dotaz->execute([$this->id]);
	}

	// funkce pro nastavení pořadí a uložení do databáze - budeme ji volat v admin.php (Stranka::nastavitPoradi($poradi)
	static function nastavitPoradi($poradi)
	{
		global $db;

		// projdeme pole s pořadím (pole je číslované)
		foreach ($poradi as $cislo => $idStranky) {
			$dotaz = $db->prepare("UPDATE stranka SET poradi = ? WHERE id = ?");
			$dotaz->execute([$cislo, $idStranky]);
		}
	}
}

/*
$seznamStranek = [
	"uvod" => new Stranka("uvod", "PrimaKavárna", "Domů"),
	"nabidka" => new Stranka("nabidka", "PrimaKavárna - Nabídka", "Nabídka"),
	"galerie" => new Stranka("galerie", "PrimaKavárna - Galerie", "Galerie"),
	"rezervace" => new Stranka("rezervace", "PrimaKavárna - Rezervace", "Rezervace"),
	"kontakt" => new Stranka("kontakt", "PrimaKavárna - Kontakt", "Kontakt"),
	"404" => new Stranka("404", "Stránka neexistuje", ""),
];
*/

$seznamStranek = [];
// pole $seznamStranek naplníme dynamicky z databáze
$dotaz = $db->prepare("SELECT id, titulek, menu FROM stranka ORDER BY poradi"); 
$dotaz->execute();
$stranky = $dotaz->fetchAll();
// var_dump($stranky);

// vezmeme pole řádek, které nám vrátila databáze, a postupně nakrmíme pole $seznamStránek jednotlivými instancemi třídy Stránka
foreach ($stranky as $stranka) {
	$idStranky = $stranka["id"];
	$seznamStranek[$idStranky] = new Stranka($idStranky, $stranka["titulek"], $stranka["menu"]);
}
