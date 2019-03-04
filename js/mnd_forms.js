function toggle_die_boxen(source, targets)
{
	var source_checkbox = document.getElementById(source);
	for(var i=0, n=targets.length; i < n; i++) 
	{
		var target_checkbox = document.getElementById(targets[i]);
		target_checkbox.checked = source_checkbox.checked;
	}
}
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
	lbl.setAttribute("data-placement", "top");
	var reusetext = "Re-Use bedeutet Wiederverwertung in allen Formen, das kann sein:" + "\n" + 
	"Upcycling Wiederverwertung durch Umnutzung von Dingen (ein Portemonaie aus einem Tetrapack basteln)" + "\n" +
	"Second Hand (gebraucht) etwas, das jemand anderes nicht mehr braucht kaufen/tauschen, um es weiter zu nutzen z.B. Kleidung oder Elektronik";
	lbl.setAttribute("title", reusetext);
	
	lbl = findeLabelZumElement(document.getElementById("div1_radioNeue Formen"));
	lbl.setAttribute("data-toggle", "tooltip");
	lbl.setAttribute("data-placement", "top");
	reusetext = "Neuere Formen dessen sind:" + "\n" + 
	"do it yourself (DIY): selbst etwas bauen, z.B. Möbel aus Platten" + "\n" +
	"do it together: zusammen mit anderen das DIY Konzept umsetzen" + "\n" +
	"Umsonstläden Abgeben oder mitnehmen von Gebrauchsgeständen etc. ohne etwas dafür bezahlen zu müssen (in einem 'Verkaufsraum')" + "\n" +
	"Die einfachsten Formen sind leihen und tauschen";
	lbl.setAttribute("title", reusetext);
	
	lbl = findeLabelZumElement(document.getElementById("div1_radioÖffentliche Einrichtung"));
	lbl.setAttribute("data-toggle", "tooltip");
	lbl.setAttribute("data-placement", "top");
	reusetext = "Räume/Häuser, die der Öffentlichkeit für Austausch, kulturelle Arbeit, Bildung etc. dienen. Wie z.B. Bibliotheken(Bücher ausleihen), Museen(Geschichte bestaunen), Nachbarschaftszentren etc.";
	lbl.setAttribute("title", reusetext);
}
function handel_tooltips_einfuegen()
{
	var lbl = findeLabelZumElement(document.getElementById("div1_radioRe-Use"));
	lbl.setAttribute("data-toggle", "tooltip");
	lbl.setAttribute("data-placement", "top");
	var reusetext = "Re-Use bedeutet Wiederverwertung in allen Formen, das kann sein:" + "\n" + 
	"Upcycling Wiederverwertung durch Umnutzung von Dingen (ein Portemonaie aus einem Tetrapack basteln)" + "\n" +
	"Second Hand (gebraucht) etwas, das jemand anderes nicht mehr braucht kaufen/tauschen, um es weiter zu nutzen z.B. Kleidung oder Elektronik";
	lbl.setAttribute("title", reusetext);
	
	lbl = findeLabelZumElement(document.getElementById("div1_radioNeue Formen"));
	lbl.setAttribute("data-toggle", "tooltip");
	lbl.setAttribute("data-placement", "top");
	reusetext = "Neuere Formen dessen sind:" + "\n" + 
	"do it yourself (DIY): selbst etwas bauen, z.B. Möbel aus Platten" + "\n" +
	"do it together: zusammen mit anderen das DIY Konzept umsetzen" + "\n" +
	"Umsonstläden Abgeben oder mitnehmen von Gebrauchsgeständen etc. ohne etwas dafür bezahlen zu müssen (in einem 'Verkaufsraum')" + "\n" +
	"Die einfachsten Formen sind leihen und tauschen";
	lbl.setAttribute("title", reusetext);
}