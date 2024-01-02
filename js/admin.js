// javascript pro administraci 
 
 // ZMĚNA POŘADÍ STRÁNEK:
$("#stranky").sortable({
	update: (udalost) => {
		const sortedIDs = $("#stranky").sortable("toArray");
		console.log(sortedIDs);
		// v admin.php musíme u jednotlivých položek LI přidat atribut ID, orotože funkce toArray vypíše ID jednotlivých položek
		// 	echo "<li class='list-group-item $active' PŘIDÁME: id='$instanceStranky->id'>

		$.ajax({
			url: "admin.php",
			// method: "GET" (automaticky) nebo "POST",
			data: {
				"poradi": sortedIDs,
			} // tímto vznikne ajaxový požadavek s těmito parametry, který se na pozadí  pomocí metody GET odešle na admin.php
			// 	nyní v admin.php přidáme do php bloku kód pro zpracování požadavku změny pořadí stránek z javascriptu

		})

	}
});

// OCHRANA NECHTĚNÉHO SMAZÁNÍ STRÁNKY:
// nejprve v admin.php ke tlačítku popelnice přidáme class "smazat"

$("#stranky .smazat").click((udalost) => {
	if (confirm("Opravdu chcete danou stránku smazat?") == false) { 
		// přerušíme událost, čímž se zruší následné navštívení odkazu pro smazání stránky
		udalost.preventDefault();
	}
})