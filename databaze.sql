/* vytvoření databáze*/
CREATE DATABASE primakavarna COLLATE utf8_czech_ci;

/* vytvoření tabulky */
CREATE Table stranka (
	id VARCHAR(100) PRIMARY KEY,
	titulek TEXT, 
	menu TEXT,
	obsah TEXT,
	poradi INT
);

/* vložení záznamů (kromě obsahu) */
INSERT INTO stranka SET 
	id = "uvod",
	titulek = "PrimaKavárna",
	menu = "Domů", 
	obsah = "...",
	poradi = 1;

INSERT INTO stranka SET 
	id = "nabidka",
	titulek = "PrimaKavárna - Nabídka",
	menu = "Nabídka", 
	obsah = "...",
	poradi = 2;

	INSERT INTO stranka SET 
	id = "galerie",
	titulek = "PrimaKavárna - Galerie",
	menu = "Galerie", 
	obsah = "...",
	poradi = 3;

	INSERT INTO stranka SET 
	id = "rezervace",
	titulek = "PrimaKavárna - Rezervace",
	menu = "Rezervace", 
	obsah = "...",
	poradi = 4;

	INSERT INTO stranka SET 
	id = "kontakt",
	titulek = "PrimaKavárna - Kontakt",
	menu = "Kontakt", 
	obsah = "...",
	poradi = 5;

	INSERT INTO stranka SET 
	id = "404",
	titulek = "Stránka neexistuje",
	menu = "", 
	obsah = "...",
	poradi = 6;

	-- testovací stránka
		INSERT INTO stranka SET 
	id = "test",
	titulek = "Testovací stránka",
	menu = "test", 
	obsah = "...",
	poradi = 7;