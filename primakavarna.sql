-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Sob 09. pro 2023, 15:18
-- Verze serveru: 10.4.28-MariaDB
-- Verze PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `primakavarna`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `stranka`
--

DROP TABLE IF EXISTS `stranka`;
CREATE TABLE `stranka` (
  `id` varchar(100) NOT NULL,
  `titulek` text DEFAULT NULL,
  `menu` text DEFAULT NULL,
  `obsah` text DEFAULT NULL,
  `poradi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `stranka`
--

INSERT INTO `stranka` (`id`, `titulek`, `menu`, `obsah`, `poradi`) VALUES
('404', 'Stránka neexistuje', '', '<div class=\"stranka-neexistuje\">\r\n<h1>Stránka neexistuje</h1>\r\n<div class=\"obrazek\"><img src=\"img/error.png\" alt=\"stránka neexistuje\" width=\"40%\" /></div>\r\n</div>', 5),
('galerie', 'PrimaKavárna - Galerie', 'Galerie', '<div class=\"galerie\">\r\n<div class=\"obsah\">\r\n<div class=\"container\">\r\n<h1> Galerie</h1>\r\n<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dicta atque fugit cum! Cumque, nemo. Numquam, nemo atque. Optio nulla temporibus pariatur minus dolorem, laboriosam porro similique tenetur dolor, officia aliquid iste omnis exercitationem nemo error. Quidem unde cum labore beatae!</p>\r\n<p> [fotogalerie slozka=\"dezerty\"]</p>\r\n<div class=\"fotky\"><br /><br /><br /><br /></div>\r\n</div>\r\n</div>\r\n</div>', 2),
('kontakt', 'PrimaKavárna - Kontakt', 'Kontakt', '<div class=\"kontakt\">\r\n<div class=\"info\">\r\n<div class=\"container\">\r\n<h1>Kontakt</h1>\r\n<div class=\"informace\">\r\n<div class=\"adresa\">\r\n<h2>Adresa</h2>\r\n<address><a href=\"https://mapy.cz/s/jajecerazu\" target=\"_blank\" rel=\"noopener\"> PrimaKavárna <br />Jablonského 2 <br />Praha, Holešovice </a></address>\r\n<ul class=\"kontakt\">\r\n<li><i class=\"fa-solid fa-phone\"></i>Telefon: <a href=\"tel:606123456\">606 123 456</a></li>\r\n<li><i class=\"fa-solid fa-at\"></i>E-mail: <a href=\"mailto: rezervace@primakavarna.cz\">rezervace@primakavarna.cz</a></li>\r\n</ul>\r\n</div>\r\n<!--KONEC adresa-->\r\n<div class=\"otevreno\">\r\n<h2>Otevřeno</h2>\r\n<table>\r\n<tbody>\r\n<tr>\r\n<th>Po - pá:</th>\r\n<td>8h - 20h</td>\r\n</tr>\r\n<tr>\r\n<th>So:</th>\r\n<td>10h - 22h</td>\r\n</tr>\r\n<tr>\r\n<th>Ne:</th>\r\n<td>12h - 20h</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n<!--KONEC otevreno--></div>\r\n<!--KONEC informace--></div>\r\n<!--KONEC container--></div>\r\n<!--KONEC info-->\r\n<div class=\"mapa\"><iframe style=\"border: none;\" src=\"https://frame.mapy.cz/s/pavurafuja\" width=\"100%\" height=\"450\" frameborder=\"0\"></iframe></div>\r\n[kontaktni-formular email=\"spravce@primakavarna.cz\"]</div>', 4),
('nabidka', 'PrimaKavárna - Nabídka', 'Nabídka', '<div class=\"nabidka\">\r\n<div class=\"obsah\">\r\n<div class=\"container\">\r\n<h1>Nabídka</h1>\r\n<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique obcaecati quidem impedit neque repellendus aliquid inventore cum, fuga maiores perspiciatis?</p>\r\n<div class=\"boxy\">\r\n<div class=\"karta\"><!--ESPRESSO-->\r\n<div class=\"obrazek\">\r\n<h2>Espresso</h2>\r\n<img src=\"img/nabidka-espresso.jpg\" alt=\"espresso\" width=\"500\" height=\"333\" /></div>\r\n<div class=\"cenik\">\r\n<table>\r\n<tbody>\r\n<tr>\r\n<th>Espresso</th>\r\n<td>45 Kč</td>\r\n</tr>\r\n<tr>\r\n<th>Espresso Macchiato</th>\r\n<td>55 Kč</td>\r\n</tr>\r\n<tr>\r\n<th>Capuccino</th>\r\n<td>60 Kč</td>\r\n</tr>\r\n<tr>\r\n<th>Double espresso</th>\r\n<td>65 Kč</td>\r\n</tr>\r\n<tr>\r\n<th>Flat White</th>\r\n<td>60 Kč</td>\r\n</tr>\r\n<tr>\r\n<th>Cafe Latte</th>\r\n<td>80 Kč</td>\r\n</tr>\r\n<tr>\r\n<th>Espresso Tonic</th>\r\n<td>80 kč</td>\r\n</tr>\r\n<tr>\r\n<th>Irish Coffee</th>\r\n<td>135 Kč</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n<!--konec CENÍK--></div>\r\n<!--konec KARTA ESPRESSO-->\r\n<div class=\"karta\"><!--DEZERTY-->\r\n<div class=\"obrazek\">\r\n<h2>Dezerty</h2>\r\n<img src=\"img/nabidka-dezerty.jpg\" alt=\"dezerty\" width=\"500\" height=\"333\" /></div>\r\n<div class=\"cenik\">\r\n<table>\r\n<tbody>\r\n<tr>\r\n<th>Cheesecake</th>\r\n<td>69 Kč</td>\r\n</tr>\r\n<tr>\r\n<th>Mrkvový dortík</th>\r\n<td>79 Kč</td>\r\n</tr>\r\n<tr>\r\n<th>Muffin čokoládový</th>\r\n<td>50 Kč</td>\r\n</tr>\r\n<tr>\r\n<th>skořicový rohlíček</th>\r\n<td>59 Kč</td>\r\n</tr>\r\n<tr>\r\n<th>Apple Pie</th>\r\n<td>49 Kč</td>\r\n</tr>\r\n<tr>\r\n<th>Panna Cotta</th>\r\n<td>55 Kč</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n<!--konec CENÍK--></div>\r\n<!--konec KARTA DEZERTY-->\r\n<div class=\"karta\"><!--SNÍDANĚ-->\r\n<div class=\"obrazek\">\r\n<h2>Snídaně</h2>\r\n<img src=\"img/nabidka-snidane.jpg\" alt=\"snídaně\" width=\"500\" height=\"333\" /></div>\r\n<div class=\"cenik\">\r\n<table>\r\n<tbody>\r\n<tr>\r\n<th>Vejce Benedikt soufflé</th>\r\n<td>135 Kč</td>\r\n</tr>\r\n<tr>\r\n<th>Vejce Florentine soufflé</th>\r\n<td>135 Kč</td>\r\n</tr>\r\n<tr>\r\n<th>Bürcher müsli s mátovým sirupem a ovocem</th>\r\n<td>90 Kč</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n<!--konec CENÍK--></div>\r\n<!--konec KARTA SNÍDANĚ-->\r\n<div class=\"karta\"><!--NEALKO-->\r\n<div class=\"obrazek\">\r\n<h2>Nealko</h2>\r\n<img src=\"img/nabidka-nealko.jpg\" alt=\"nealko\" width=\"500\" height=\"333\" /></div>\r\n<div class=\"cenik\">\r\n<table>\r\n<tbody>\r\n<tr>\r\n<th>Domácí limonády 0,25l</th>\r\n<td>40 Kč</td>\r\n</tr>\r\n<tr>\r\n<th>Fentimas Ginger beer 0,125l</th>\r\n<td>65 Kč</td>\r\n</tr>\r\n<tr>\r\n<th>Fentimas limonády 0,275l</th>\r\n<td>65 Kč</td>\r\n</tr>\r\n<tr>\r\n<th>Thomas Henry Grapefruit 0,2l</th>\r\n<td>55 Kč</td>\r\n</tr>\r\n<tr>\r\n<th>Fritz Cola 0,33l</th>\r\n<td>45 Kč</td>\r\n</tr>\r\n<tr>\r\n<th>Fritz Cola light 0,33l</th>\r\n<td>45 Kč</td>\r\n</tr>\r\n<tr>\r\n<th>Juice 0,2l</th>\r\n<td>30 Kč</td>\r\n</tr>\r\n<tr>\r\n<th>John Lemon limonády 0,33l</th>\r\n<td>32 kč</td>\r\n</tr>\r\n<tr>\r\n<th>Minerální voda Coralba 0,25l</th>\r\n<td>20 Kč</td>\r\n</tr>\r\n<tr>\r\n<th>Minerální voda Coralba 0,75l</th>\r\n<td>40 Kč</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n<!--konec CENÍK--></div>\r\n<!--konec KARTA NEALKO--></div>\r\n<!--konec BOXY--></div>\r\n<!--konec CONTAINER--></div>\r\n<!--konec OBSAH--></div>\r\n<!--konec NABIDKA-->', 1),
('rezervace', 'PrimaKavárna - Rezervace', 'Rezervace', '<div class=\"rezervace\">\r\n<div class=\"obsah\">\r\n<div class=\"container\">\r\n<h1>Rezervace</h1>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos odio assumenda exercitationem sit laboriosam qui ab fugit et voluptates? Praesentium doloribus sequi, iusto vero nemo alias corporis necessitatibus tempora itaque.</p>\r\n<ul class=\"kontakt\">\r\n<li><i class=\"fa-solid fa-phone\"></i>Volat můžete na tel. <a href=\"tel:606123456\">606 123 456</a></li>\r\n<li><i class=\"fa-solid fa-at\"></i>Psát na e-mail: <a href=\"mailto: rezervace@primakavarna.cz\">rezervace@primakavarna.cz</a></li>\r\n<li><i class=\"fa-regular fa-rectangle-list\"></i>Nebo můžete využít následující rezervační formulář</li>\r\n</ul>\r\n[kontaktni-formular email=\"spravce@primakavarna.cz\"]</div>\r\n</div>\r\n</div>', 3),
('uvod', 'PrimaKavárna', 'Domů', '<div class=\"domu\">\r\n<div class=\"onas\">\r\n<div class=\"container\">\r\n<h1>- O nás -</h1>\r\n<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Pariatur maxime sit laudantium et libero dolores, ad incidunt quia fuga? Illum molestias sequi aspernatur laboriosam. Vitae aspernatur repellat recusandae magni tenetur modi laudantium ipsum similique earum expedita veniam maiores voluptatum nisi tempore ex eveniet veritatis perferendis, consequatur nam voluptatibus quo laborum obcaecati, officiis distinctio! Optio illo ratione blanditiis? Eum, possimus iusto.</p>\r\n<div class=\"boxy\">\r\n<div class=\"karta\"><img src=\"img/pribeh-kava.jpg\" alt=\"Káva\" width=\"300\" height=\"200\" />\r\n<div class=\"text\">\r\n<h2>Káva</h2>\r\n<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae molestiae earum tenetur voluptate. Ad quibusdam, commodi ipsa facere molestias ipsum.</p>\r\n<a href=\"nabidka\">Více <i class=\"fa-solid fa-angles-right\"></i></a></div>\r\n</div>\r\n<div class=\"karta\"><img src=\"img/pribeh-dobroty.jpg\" alt=\"Dobroty\" width=\"300\" height=\"200\" />\r\n<div class=\"text\">\r\n<h2>Dobroty</h2>\r\n<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae molestiae earum tenetur voluptate. Ad quibusdam, commodi ipsa facere molestias ipsum. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima, nam!</p>\r\n<a href=\"nabidka\">Více <i class=\"fa-solid fa-angles-right\"></i></a></div>\r\n</div>\r\n<div class=\"karta\"><img src=\"img/pribeh-zakusky.jpg\" alt=\"Zákusky\" width=\"300\" height=\"200\" />\r\n<div class=\"text\">\r\n<h2>Zákusky</h2>\r\n<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae molestiae earum tenetur voluptate. Ad quibusdam, commodi ipsa facere molestias ipsum.</p>\r\n<a href=\"nabidka\">Více <i class=\"fa-solid fa-angles-right\"></i></a></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"akce\">\r\n<div class=\"levy\">\r\n<div class=\"boxy\">\r\n<div class=\"box\">\r\n<h2>Každé pondělí cappucino zdarma</h2>\r\n<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque quam dolorem sit maiores itaque atque reiciendis vel vero voluptatum aliquam?</p>\r\n</div>\r\n<div class=\"box\">\r\n<h2>Sleva pro stálé zákazníky</h2>\r\n<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni voluptatem ducimus inventore enim laudantium! Veniam quia cum adipisci? Facilis dolore commodi facere amet exercitationem id repellendus laboriosam. Recusandae, corrupti accusantium.</p>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"pravy\">\r\n<div class=\"lista\"></div>\r\n</div>\r\n</div>\r\n<div class=\"tip\">\r\n<div class=\"container\">\r\n<div class=\"fotky\"><img src=\"img/tip-chleba.jpg\" alt=\"Chleba\" width=\"300px\" height=\"450px\" /> <img src=\"img/tip-vareni.jpg\" alt=\"Vaření\" width=\"300px\" height=\"450px\" /></div>\r\n<div class=\"text\">\r\n<h2>Náš tip</h2>\r\n<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores reiciendis dolores hic nobis consequuntur quae assumenda cumque porro et delectus.</p>\r\n<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa voluptatum maiores exercitationem amet sapiente cupiditate, illo quaerat? Deleniti, accusantium earum?</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>', 0);

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `stranka`
--
ALTER TABLE `stranka`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
