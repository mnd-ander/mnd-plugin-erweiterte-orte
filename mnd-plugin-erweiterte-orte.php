<?php
/*
Plugin Name: Events Manager - MND Erweiterte Orte
Plugin URI: https://www.shakuras.me
Description: Bitte die Bedienungsanleitung beachten (unter Events->Anderbox). Dieses Plugin erweitert die Funktionalität des Events Manager Plugins um Orttypen. Icons von fontawesome https://fontawesome.com/license/free - die Lizenz erfordert, dass dies auf der Seite kenntlich gemacht wird. 
Author: Alexander Schmidt
Author URI: https://www.shakuras.me
Version: 0.9.3
*/

define('MND_VERSION', 0.0903); 
/*
versionsnummern sind a.b.c
a = erfüllt alle aktuellen anforderungen
b = größeres feature wie ein neues formular oder änderung der unterliegenden struktur
c = iterationen von b
a,b,c können/sollen/dürfen 2-stellig sein
*/

/*
	--------------
	informationen:
	--------------
	- um die Funktionsweise dieses Plugins zu verstehen, muss man sich mit Wordpress-Pluginerstellung vertraut machen
	  speziell filter verstehen ist wichtig
	- das Plugin hält sich nur an die internen Prozesse von EventsManager und 'filtert' (= fügt dort hinzu) 
	  man muss sich die stellen im EventsManager anschauen, in denen jeweils die funktionen 'eingehakt' wurden
	- das Fehlen von POST daten ist kaum irgendwo bedacht und macht vielleicht irgendwann in einer situation probleme,
	  zur zeit sollte es aber nichts ausmachen (solange der programmiermensch nichts falsch macht...)
	- es ist egal, dass event manager meta und location meta im selben EM_META_TABLE gespeichert wird,
	  denn beim laden eines ortes/events werden nur die von uns im code eingestellten attribute gelesen/bearbeitet
	
	------------------------------------
	Arbeitsschritte Formularerweiterung:
	------------------------------------
	- abrufbare option in mnd_em_init() anlegen 				=>  erledigt
	- optionen in uninstall.php mitnehmen						=>  erledigt
	- mnd_em_ms_globals optionen für multisite bereitstellen  	=>  erledigt
	- mnd-em-location-forms.php die form elemente einsetzen   	=>  erledigt
	- löschen meta_key abfrage hinzufügen						=>  erledigt
	- laden meta_key abfrage hinzufügen							=>  erledigt
	- speichern meta_key abfrage hinzufügen						=>  erledigt
	- mnd_em_loc_placeholders shortcodes erweitern/hinzufügen 	=>  erledigt
	
	----------------------------------
	Arbeitsschritte neue Formularform:
	----------------------------------
	- in mnd_em_loc_metabox() die editierbarkeit durch eintrag des funktionsaufrufs ermöglichen	=> repaircafe erledigt
	- in mnd_em_loc_frontend_form_input() das formular zum einsenden bereitstellen				=> repaircafe erledigt
	- alle formularerweiterungsarbeitsschritte													=> repaircafe erledigt
	
	-----
	todo:
	-----
	
	seite mit kommenden rückrufterminen => https://wp-events-plugin.com/tutorials/create-custom-event-information-pages/
	
	metadaten klasse mit table? macht das formular erweitern/laden/speichern vermutlich viel besser
	
	---------------------------------------------------
	veraltete formularteile für aufräumfunktion später:
	---------------------------------------------------
	- 'pitch' (handel_div4_teile) ändern zu: 'kommentar'
*/

//wenn nutzer nur edit_locations rechte hat, können orte eingereicht werden, aber sie müssen noch bestätigt werden
define('MND_TEST_RECHTE', 'edit_locations');

//das adminmenü im dashboard mit der bedienungsanleitung
include('mnd-em-admin.php');

//auswahllogik damit das richtige formular erscheint
include('mnd-em-location-forms.php');

//formular-bausteine
include('mnd-em-form-factory.php');
//die einzelnen formulare
include('mnd-em-handelsort-form.php');
include('mnd-em-lernort-form.php');
include('mnd-em-repaircafe-form.php');

//die laden/speichern/löschen filter-funktionen
include('mnd-em-locationzeug.php');

//shortcodes
include('mnd-em-shortcodes.php');

function mnd_js_init() 
{
    wp_enqueue_script( 'mnd-forms-js', plugins_url( '/js/mnd_forms.js', __FILE__ ));
}
add_action('wp_enqueue_scripts','mnd_js_init');

function mnd_em_init()
{
	if( get_option( "mnd_em_version" ) != MND_VERSION )
	{
		update_option('mnd_em_version', MND_VERSION);
		
		allgemeine_formularteile_anlegen();
		handelsort_formularteile_anlegen();
		lernort_formularteile_anlegen();
		repaircafe_formularteile_anlegen();
		
		//wird später für location-rückruftermin-seite gebraucht => https://wp-events-plugin.com/tutorials/create-custom-event-information-pages/
		//global $wp_rewrite;
	}
}
add_filter('init','mnd_em_init', 10);

function allgemeine_formularteile_anlegen()
{
	/*
	 * das hier soll noch in alle formulare eingefügt werden, wie und wo ist noch nicht bekannt
	 
	$div3_allgemein_teile = array
	(
		'sammelstelle'
	);
	$div3_sammelstellen_cb = array
	(
		'Allgemein', 'Elektro', 'Food', 'Textil'
	);
	
	*/
	$div4_zielgruppen_demografisch = array
	(
		"Männer", "Frauen", "LGBT", 
		"Alter 0-6", "Alter 6-18", "Alter 18-30", "Alter 30-50", "Alter 50+",
		"Niedriges Einkommen", "Mittleres Einkommen", "Hohes Einkommen"
	);
	update_option('div4_zielgruppen_demografisch',$div4_zielgruppen_demografisch);
	$div4_zielgruppen_psychografisch = array
	(
		"Konservativ-Etablierte", "Liberal-Intellektuelle", "Performer", "Expeditive",
		"Adaptiv-Pragmatische", "Bürgerliche Mitte", "Sozialökologisches Milieu", "Traditionelle",
		"Prekäre", "Hedonisten"
	);
	update_option('div4_zielgruppen_psychografisch',$div4_zielgruppen_psychografisch);
}
function lernort_formularteile_anlegen()
{
	$lernort_div1_radio = array
	(
		"Einzelhandel", "Re-Use", "Neue Formen", "Bauernhof", 
		"Straßenmarkt", "Markthalle", "Bildungseinrichtung", "Öffentliche Einrichtung",
		"Gastronomie", "Privat", "Sonstige"		
	);
	update_option('lernort_div1_radio',$lernort_div1_radio);
	$lernort_div1_inventar_cb = array
	(
		"Größe", "Flipchart", "Stifte/Eddings in verschiedenen Farben", "Klemmbretter", 
		"Stromanschlüsse für Vortragende", "Stromanschlüsse für alle Teilnehmer", "Lautsprecher", "Overheadprojektor",
		"Beamer", "Abdunkelbar", "Leinwand", "Barrierefrei",
		"Behindertentoilette", "Toiletten", "Aufzug", "Backstageraum",
		"Außenbereich", "Parkett", "WLAN"
	);
	update_option('lernort_div1_inventar_cb',$lernort_div1_inventar_cb);
	$lernort_div1_teile = array
	(
		"catering_radio", "catering_text", "cafevorhanden"
	);
	update_option('lernort_div1_teile',$lernort_div1_teile);
	$lernort_div3_teile = array
	(
		"unterstuetzung", "anmeldung", "gruppengr_von", "gruppengr_bis",
		"lernraum", "anmerkungen", "ansprechpartner", "ansprechpartner_nr", "raumverwaltung",
		"andereseminar_radio", "andereseminar_gr_von", "andereseminar_gr_bis", "andereseminar_beding"
	);
	update_option('lernort_div3_teile',$lernort_div3_teile);
	$lernort_div4_teile = array
	(
		"rueckruftermin", "atmosphaere", "kommentar", "letzter_kontakt"
	);
	update_option('lernort_div4_teile',$lernort_div4_teile);
}
function handelsort_formularteile_anlegen()
{
	$handel_div1_radio = array
	(
		"Einzelhandel", "Re-Use", "Neue Formen", "Bauernhof", "Straßenmarkt", "Markthalle", "Sonstige" 
	);
	update_option('handel_div1_radio',$handel_div1_radio);
	
	$handel_div1_checkboxes = array
	(
		"Lebensmittel", "Baumarktsortiment", "Bekleidung", "Einrichtungsbedarf",
		"Gesundheit, Pflege", "Bücher, Schreibwaren", "Unterhaltungselektronik", "Elektrohaushaltsgeräte",
		"Spielwaren, Hobbys", "Foto, Optik", "Informationstechnologie", "Schuhe, Lederwaren",
		"Sportbedarf, Camping", "Hausrat", "Uhren, Schmuck", "Telekommunikation",
		"Baby-, Kinderartikel", "Mobilität", "Sonstiges"
	);
	update_option('handel_div1_checkboxes',$handel_div1_checkboxes);
	
	$handel_div3_teile = array
	(
		"unterstuetzung", "anmeldung", "gruppengr_von", "gruppengr_bis",
		"lernraum", "cafevorhanden", "anmerkungen", "ansprechpartner", "ansprechpartner_nr"
	);
	update_option('handel_div3_teile',$handel_div3_teile);
	
	$handel_div4_teile = array
	(
		"rueckruftermin", "atmosphaere",
		"pitch", "letzter_kontakt"
	);
	update_option('handel_div4_teile',$handel_div4_teile);
}
function repaircafe_formularteile_anlegen()
{
	$repaircafe_div1_radio = array
	(
		"Repair Café", "Offene Werkstatt", "Makerspace", "Nähcafé", 
		"Offene Gartengemeinschaft",  "Coworking Space"
	);
	update_option('repaircafe_div1_radio',$repaircafe_div1_radio);
	$repaircafe_div1_teile = array
	(
		//vorsicht: oeffnungstage wäre teil hiervon, wird aber extra behandelt 
		//  		-> dafür gibts mnd_em_loc_oeffnungstage_checkboxset()
		"telefon", "email", "website", "oeffnungszeiten", "andere_oeffnungstage", "ansprechpartner", "cafevorhanden"
	);
	update_option('repaircafe_div1_teile',$repaircafe_div1_teile);
	$repaircafe_div1_ausstattung_cb = array
	(
		"Werkzeugkoffer", "Werkbank", "Lötkolben", "Auffahrrampe", 
		"3D Drucker", "3D Scanner", "3D Druckmaterial", "Textilien", 
		"Nähmaschine", "Gartenwerkzeug", "Stromanschluss", "WIFI"
	);
	update_option('repaircafe_div1_ausstattung_cb',$repaircafe_div1_ausstattung_cb);
	$repaircafe_div3_teile = array
	(
		"unterstuetzung", "anmeldung", "gruppengr_von", "gruppengr_bis",
		"fokus_sonstiges"
	);
	update_option('repaircafe_div3_teile',$repaircafe_div3_teile);
		
	$repaircafe_div3_fokus_cb1 = array
	(
		"Selbstständige Reparatur"
	);
	update_option('repaircafe_div3_fokus_cb1',$repaircafe_div3_fokus_cb1);
	$repaircafe_div3_fokus_cb2 = array
	(
		"Elektronik Reparatur", "Handy Reparatur", "Computer Reparatur", "Tablet Reparatur"
	);
	update_option('repaircafe_div3_fokus_cb2',$repaircafe_div3_fokus_cb2);
	$repaircafe_div3_fokus_cb3 = array
	(
		"Mobilität", "Fahrrad Reparatur", "Roller Reparatur", "Auto Reparatur"
	);
	update_option('repaircafe_div3_fokus_cb3',$repaircafe_div3_fokus_cb3);
	$repaircafe_div3_fokus_cb4 = array
	(
		"Kreativität", "Selbst nähen", "Upcycling", "Downcycling", "Kunst", "Brainstorming"
	);
	update_option('repaircafe_div3_fokus_cb4',$repaircafe_div3_fokus_cb4);
	$repaircafe_div3_fokus_cb5 = array
	(
		"Coworking"
	);
	update_option('repaircafe_div3_fokus_cb5',$repaircafe_div3_fokus_cb5);
	
	$repaircafe_div4_teile = array
	(
		"rueckruftermin", "atmosphaere", "kommentar", "letzter_kontakt"
	);
	update_option('repaircafe_div4_teile',$repaircafe_div4_teile);
	
}
/**
 * Registers the mnd_em_boxnamen option as a global option for when in MS GLobal mode
 * @param array $globals
 * @return array
 */
function mnd_em_ms_globals( $globals )
{
	$globals[] = 'div4_zielgruppen_demografisch';
	$globals[] = 'div4_zielgruppen_psychografisch';
	
	$globals[] = 'handel_div1_radio';
	$globals[] = 'handel_div1_checkboxes';
	$globals[] = 'handel_div3_teile';
	$globals[] = 'handel_div4_teile';
	
	$globals[] = 'lernort_div1_radio';
	$globals[] = 'lernort_div1_inventar_cb';
	$globals[] = 'lernort_div1_teile';
	$globals[] = 'lernort_div3_teile';
	$globals[] = 'lernort_div4_teile';
	
	$globals[] = 'repaircafe_div1_radio';
	$globals[] = 'repaircafe_div1_teile';
	$globals[] = 'repaircafe_div1_ausstattung_cb';
	$globals[] = 'repaircafe_div3_teile';
	$globals[] = 'repaircafe_div3_fokus_cb1';
	$globals[] = 'repaircafe_div3_fokus_cb2';
	$globals[] = 'repaircafe_div3_fokus_cb3';
	$globals[] = 'repaircafe_div3_fokus_cb4';
	$globals[] = 'repaircafe_div3_fokus_cb5';
	$globals[] = 'repaircafe_div4_teile';
	
	return $globals;
}
add_filter('em_ms_globals', 'mnd_em_ms_globals', 10, 1);


?>