// javascript pro veřejnou část

// NASTAVENÍ TLAČÍTKA PRO POSUN STRÁNKY NAHORU NA ZAČÁTEK
const nahoru = document.querySelector("#nahoru");
nahoru.addEventListener("click", (udalost) => {
	window.scrollTo({
		left: 0,
		top: 0,
		behavior: "smooth",
	})
});

const header = document.querySelector("header");
window.addEventListener("scroll", (udalost) => {
	// console.log(window.scrollY);
	const poziceHeaderu = header.getBoundingClientRect(); // funkce vrací Rect Angle - obdélník, kde je element umístěný - vrací pozici X, pozici Y, šírku a výšku
	// console.log(poziceHeaderu);

	if(window.scrollY > poziceHeaderu.bottom)
	{
		nahoru.classList.add("zobrazit"); // ve style.css vytvoříme class "zobrazit"
	}
	else 
	{
		nahoru.classList.remove("zobrazit");
	}
})