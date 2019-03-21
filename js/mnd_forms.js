/*
für multiclick im repaircafe formular fokus
genutzt in mnd-em-form-factory.php mnd_em_loc_checkboxset_multiclick(...)
*/
function toggle_die_boxen(source, targets)
{
	var source_checkbox = document.getElementById(source);
	for(var i=0, n=targets.length; i < n; i++) 
	{
		var target_checkbox = document.getElementById(targets[i]);
		target_checkbox.checked = source_checkbox.checked;
	}
}

/*
hilfsfunktion zum einfügen der tooltips
findet das gewünschte label anhand der id des formularelements
*/
function findeLabelZumElement(elem) 
{
   var idVal = elem.id;
   labels = document.getElementsByTagName('label');
   for( var i = 0; i < labels.length; i++ ) 
   {
      if (labels[i].htmlFor == idVal) return labels[i];
   }
}
function lernort_tooltips_einfuegen()
{
	var lbl = findeLabelZumElement(document.getElementById("div1_radioRe-Use"));
	lbl.setAttribute("data-toggle", "tooltip");
	lbl.setAttribute("data-placement", "right");
	var reusetext = "Re-Use : An diesen Orten geht es um das Wiederverwerten von bereits genutzten Produkten. Klassische Beispiele sind Second-Hand Läden, Gebraucht- oder Tauschmärkte.";
	lbl.setAttribute("title", reusetext);
	
	lbl = findeLabelZumElement(document.getElementById("div1_radioNeue Formen"));
	lbl.setAttribute("data-toggle", "tooltip");
	lbl.setAttribute("data-placement", "right");
	reusetext = "Neue Formen : An diesen Orten werden neue Ansätze des Konsums gelebt. Hier wird der Konsument schnell zum Prosumenten. Beispiele sind DIY-Spaces, DIT-Spaces, Zero-Waste Läden, 3D-Druckergeschäfte oder Makerspaces.";
	lbl.setAttribute("title", reusetext);
	
	lbl = findeLabelZumElement(document.getElementById("div1_radioÖffentliche Einrichtung"));
	lbl.setAttribute("data-toggle", "tooltip");
	lbl.setAttribute("data-placement", "right");
	reusetext = "Öffentliche Einrichtungen : Diese Orte sind durch öffentliche Gelder finanziert. Beispiel : Bibliotheken, Schulen oder Nachbarschaftszentren.";
	lbl.setAttribute("title", reusetext);
}
function handel_tooltips_einfuegen()
{
	var lbl = findeLabelZumElement(document.getElementById("div1_radioRe-Use"));
	lbl.setAttribute("data-toggle", "tooltip");
	lbl.setAttribute("data-placement", "right");
	var reusetext = "Re-Use : An diesen Orten geht es um das Wiederverwerten von bereits genutzten Produkten. Klassische Beispiele sind Second-Hand Läden, Gebraucht- oder Tauschmärkte.";
	lbl.setAttribute("title", reusetext);
	
	lbl = findeLabelZumElement(document.getElementById("div1_radioNeue Formen"));
	lbl.setAttribute("data-toggle", "tooltip");
	lbl.setAttribute("data-placement", "right");
	reusetext = "Neue Formen : An diesen Orten werden neue Ansätze des Konsums gelebt. Hier wird der Konsument schnell zum Prosumenten. Beispiele sind DIY-Spaces, DIT-Spaces, Zero-Waste Läden, 3D-Druckergeschäfte oder Makerspaces.";
	lbl.setAttribute("title", reusetext);
}
function repaircafe_tooltips_einfuegen()
{
	var lbl = findeLabelZumElement(document.getElementById("div1_radioCoworking Space"));
	lbl.setAttribute("data-toggle", "tooltip");
	lbl.setAttribute("data-placement", "right");
	var reusetext = "Coworking - (auch Co-working, englisch für 'zusammen arbeiten' bzw. koarbeiten oder kollaborativ arbeiten) ist eine Entwicklung im Bereich „neue Arbeitsformen“. Freiberufler, Kreative, kleinere Startups oder digitale Nomaden arbeiten dabei zugleich in meist größeren, offenen Räumen und können auf diese Weise voneinander profitieren. Sie können unabhängig voneinander agieren und in unterschiedlichen Firmen und Projekten aktiv sein, oder auch gemeinsam Projekte verwirklichen und Hilfe sowie neue Mitstreiter finden.";
	lbl.setAttribute("title", reusetext);
	
	lbl = findeLabelZumElement(document.getElementById("fokusCB50"));
	lbl.setAttribute("data-toggle", "tooltip");
	lbl.setAttribute("data-placement", "right");
	//coworking text hier wieder
	lbl.setAttribute("title", reusetext);
	
	//downcycling
	lbl = findeLabelZumElement(document.getElementById("fokusCB43"));
	lbl.setAttribute("data-toggle", "tooltip");
	lbl.setAttribute("data-placement", "right");
	reusetext = "Downcycling - Rohstoffwiederverwertung mit Qualitätseinbußen ( mindestens genau so wichtig wie Upcycling)";
	lbl.setAttribute("title", reusetext);
	//brainstormen
	lbl = findeLabelZumElement(document.getElementById("fokusCB45"));
	lbl.setAttribute("data-toggle", "tooltip");
	lbl.setAttribute("data-placement", "right");
	reusetext = "Brainstormen - kurze Versammlung um spontane Ideen zu sammeln.";
	lbl.setAttribute("title", reusetext);
	//lötkolben
	lbl = findeLabelZumElement(document.getElementById("repairCB2"));
	lbl.setAttribute("data-toggle", "tooltip");
	lbl.setAttribute("data-placement", "right");
	reusetext = "Der Lötkolben ist ein Gerät zum Aufschmelzen von Metallen, um Bauteile durch Weichlöten zu verbinden. (unter 450 Grad wird es Weichlöten genannt alles darüber wird Hartlöten genannt).";
	lbl.setAttribute("title", reusetext);
	//werkzeugkoffer
	lbl = findeLabelZumElement(document.getElementById("repairCB0"));
	lbl.setAttribute("data-toggle", "tooltip");
	lbl.setAttribute("data-placement", "right");
	reusetext = "Werkzeugkoffer: Ein Werkzeugkoffer beinhaltet den kompletten Bedarf an Werkzeugen, die für Reparaturen gebraucht werden. Wie z. B." + "\n" +
				"Verschiedene Schraubendreher, Schlitz und Kreuzschlitz sowie Torx-Schraubendreher in gängigen Größen" + "\n" +
			    "(Kleines) Stemmeisen" + "\n" +
			    "Tuch zum Abwischen" + "\n" +
			    "Schnur" + "\n" +
			    "1-2 Schleifpapiere" + "\n" +
			    "Schraubenschlüsselsatz, gängige Größen, vor allem 8 bis 14, als Maul- und Ringschlüssel)";
	lbl.setAttribute("title", reusetext);
}