<?php

// pll_register_string( $name, $string, $group, $multiline );
pll_register_string("Text", "ab", "Theme Zeichenketten", false);
pll_register_string("Text", "inkl. MwSt. zzgl. Versand", "Theme Zeichenketten", false);
pll_register_string("Überschrift", "Die Vorteile auf einen Blick", "Theme Zeichenketten", false);
pll_register_string("Überschrift", "Die Box passt in", "Theme Zeichenketten", false);
pll_register_string("Buttontext", "Zur Fahrzeugauswahl", "Theme Zeichenketten", false);
pll_register_string("Text", "Dein Wagen steht nicht auf der Liste?", "Theme Zeichenketten", false);
pll_register_string("Text", "Hier findest Du alle Maße mit denen Du prüfen kannst, ob Dein Fahrzeug ggf. kompatibel ist:", "Theme Zeichenketten", true);
pll_register_string("Linktext", "Voraussetzungen Box", "Theme Zeichenketten", false);
pll_register_string("Überschrift", "Lieferumfang", "Theme Zeichenketten", false);

pll_register_string("Ländername", "Deutschland", "Theme Zeichenketten", false);
pll_register_string("Ländername", "Österreich", "Theme Zeichenketten", false);
pll_register_string("Ländername", "Schweiz", "Theme Zeichenketten", false);
pll_register_string("Ländername", "Frankreich", "Theme Zeichenketten", false);
pll_register_string("Ländername", "Großbritannien", "Theme Zeichenketten", false);
pll_register_string("Ländername", "Island", "Theme Zeichenketten", false);
pll_register_string("Ländername", "Italien", "Theme Zeichenketten", false);
pll_register_string("Ländername", "Korsika", "Theme Zeichenketten", false);
pll_register_string("Ländername", "Luxemburg", "Theme Zeichenketten", false);
pll_register_string("Ländername", "Niederlande", "Theme Zeichenketten", false);
pll_register_string("Ländername", "Slowenien", "Theme Zeichenketten", false);
pll_register_string("Ländername", "Spanien", "Theme Zeichenketten", false);
pll_register_string("Ländername", "Tschechien", "Theme Zeichenketten", false);

/*
Benutzung (Beispiele):

<?php pll_e("Die Vorteile auf einen Blick"); ?>
<?php echo str_replace("Box", $title, pll__("Die Box passt in")); ?>
*/