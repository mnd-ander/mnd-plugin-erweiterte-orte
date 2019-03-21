<?php

/*
hier wird oft die wordpress funktion get_option() benutzt
die optionen wurden bei der intialisierung des plugins angelegt 
    in mnd-plugin-erweiterte-orte.php mnd_em_init()

die schreibweise $var = (is_array(get_option('lernort_div1_radio'))) ? get_option('lernort_div1_radio'):array()
stellt sicher dass auch in dem fall von verlorenen optionen (datenbankfehler?) das formular geladen wird
  und nicht irgendeine fehlermeldung entsteht
*/
function mnd_lernortform($editing = false)
{
	//wir befinden uns bei do_action('em_front_location_form_footer')
	//EM hat hier $EM_Location als global deklariert, damit wir direkt auf die daten in dem objekt zugreifen können
	global $EM_Location;
	if($editing)
	{
		//damit niemand vergisst, um welche formularart es sich handelt, während der nutzer editiert
		//... nicht gerade wichtig
		?>
		<h3>Art/Typ: Lernort</h3>
		<?php
	}
	?>
	<div class="em-location-data">
	<input type='hidden' name='formular_art' value='lernort' />
	
	<!-- div1 anfang -->
	<fieldset name="lernort_div1">
	<h4>Unterart des Lernortes [*]</h4>
	<?php
	$lernort_div1_radio = (is_array(get_option('lernort_div1_radio'))) ? get_option('lernort_div1_radio'):array();
	mnd_em_loc_radioset($lernort_div1_radio, 1, 'div1_radio', 'div1_radio', $editing, true, true);
	?>
	<h4>Inventar</h4>
	<?php	
	$lernort_div1_inventar_cb = (is_array(get_option('lernort_div1_inventar_cb'))) ? get_option('lernort_div1_inventar_cb'):array();
	mnd_em_loc_checkboxset($lernort_div1_inventar_cb, 'div1[]', 'lernortCB', 'div1_checkboxes', $editing, true);
	?>
	<h4>Angaben zum Catering</h4>
	<table class="em-location-data">
		<?php
		mnd_em_loc_radioset_tr('Catering [*]', array('Ja','Nein', 'In Absprache'), 1, 'catering_radio', 'catering_radio', $editing, true, true);
		mnd_em_loc_textarea_tr('Mehr dazu', 5, 40, 600, 'catering_text', 'catering_text', $editing, true, false, 'Sag etwas mehr dazu…(z.B. Küchen- & Geschirrnutzung, Kaffeekannen, Kaffeepreise, Getränkepreise usw.)');
		mnd_em_loc_radioset_tr('Café vorhanden?', array('Ja','Nein'), 1, 'cafevorhanden', 'cafevorhanden', $editing, true, false);
		?>
	</table>
	</fieldset>
	<!-- div1 ende -->
	<br/>
	<!-- div3 anfang -->
	<h4>Weitere Informationen</h4>
	<table class="em-location-data">
		<?php
		mnd_em_loc_textfeld_tr('Unterstützung vor Ort', 'unterstuetzung', 'unterstuetzung', $editing, true, false);
		mnd_em_loc_radioset_tr('Anmeldung erforderlich [*]', array('Ja','Nein'), 1, 'anmeldung', 'anmeldung', $editing, true, true);
		?>
		<tr class="em-location-data-address">
			<th>Gruppengröße</th>
			<td>
				<label for="gruppengr_von">von</label>
				<input type="number" name="gruppengr_von" id="gruppengr_von" min="1" 
					<?php if($editing) { ?> value="<?php echo $EM_Location->mndzeug['gruppengr_von']; ?>" <?php } ?>
					/>
				<br/>
				<label for="gruppengr_bis">bis</label>
				<input type="number" name="gruppengr_bis" id="gruppengr_bis" min="1" 
					<?php if($editing) { ?> value="<?php echo $EM_Location->mndzeug['gruppengr_bis']; ?>" <?php } ?>
					/> 
			</td>
		</tr>
		<?php
		mnd_em_loc_textfeld_tr('Lernraumsituation', 'lernraum', 'lernraum', $editing, true, false);
		mnd_em_loc_textarea_tr('Anmerkungen', 5, 40, 600, 'anmerkungen', 'anmerkungen', $editing, true, false);
		mnd_em_loc_textfeld_tr('Ansprechpartner des Eigentümers für Rückruf [*]', 'ansprechpartner', 'ansprechpartner', $editing, true, true);
		mnd_em_loc_textfeld_tr('Rückrufnummer [*]', 'ansprechpartner_nr', 'ansprechpartner_nr', $editing, true, true);
		mnd_em_loc_textfeld_tr('Raum wird verwaltet durch', 'raumverwaltung', 'raumverwaltung', $editing, true, false);
		?>
		<tr><th>&nbsp;</th><td>&nbsp;</td></tr><!-- linebreak tabellenzeile der einfachheit halber -->
		<?php
		//andere Seminare
		mnd_em_loc_radioset_tr('Seminarraum steht zur Verfügung für Seminare? [*]', array('Ja','Nein'), 1, 'andereseminar_radio', 'andereseminar_radio', $editing, true, true);
		?>
		<tr class="em-location-data-address">
			<th>Gruppengröße [*]</th><!-- Gruppengr andere seminare  -->
			<td>
				<label for="andereseminar_gr_von">von</label>
				<input type="number" name="andereseminar_gr_von" id="andereseminar_gr_von" min="1" required
					<?php if($editing) { ?> value="<?php echo $EM_Location->mndzeug['andereseminar_gr_von']; ?>" <?php } ?>
					/>
				<br/>
				<label for="andereseminar_gr_bis">bis</label>
				<input type="number" name="andereseminar_gr_bis" id="andereseminar_gr_bis" min="1" required
					<?php if($editing) { ?> value="<?php echo $EM_Location->mndzeug['andereseminar_gr_bis']; ?>" <?php } ?>
					/> 
			</td>
		</tr>
		<?php
		//mnd_em_loc_number_tr('Preis pro Stunde in €', 0, 0.01, 'andereseminar_preis', 'andereseminar_preis', $editing, true, false);
		mnd_em_loc_textfeld_tr('Weitere Bedingungen', 'andereseminar_beding', 'andereseminar_beding', $editing, true, false);
		?>
	</table>		
	<!-- div3 ende -->
	
	<!-- div4 anfang -->
	<?php
	//nur für bestimmte rechtegruppen oder beim editieren als deaktivierte felder
	$bool_rechte = current_user_can(MND_TEST_RECHTE);
	if($bool_rechte || $editing)
	{
		?>
		<br/>
		<fieldset name="extra_weiteres" style="background-color: rgba(145, 142, 122, 0.64);">
		<h4>Weitere Informationen</h4>
		<table class="em-location-data">
		<?php
		mnd_em_loc_date_tr('Rückruftermin', 'rueckruftermin', 'rueckruftermin', $editing, $bool_rechte, false);
		mnd_em_loc_textfeld_tr('Atmosphäre', 'atmosphaere', 'atmosphaere', $editing, $bool_rechte, false);
		?>
		</table>
		<br/>
		<fieldset name="zielgruppen">
		<h4>Zielgruppe Demografisch</h4>
		<?php
		$div4_zielgruppen_demografisch = (is_array(get_option('div4_zielgruppen_demografisch'))) ? get_option('div4_zielgruppen_demografisch'):array();
		mnd_em_loc_checkboxset($div4_zielgruppen_demografisch, 'div4_zielgruppen_demografisch[]', 'div4CBd', 'div4_zielgruppen_demografisch', $editing, $bool_rechte);
		?>
		</fieldset>
		<fieldset name="zielgruppen">
		<h4>Zielgruppe Psychografisch</h4>
		<?php
		$div4_zielgruppen_psychografisch = (is_array(get_option('div4_zielgruppen_psychografisch'))) ? get_option('div4_zielgruppen_psychografisch'):array();
		mnd_em_loc_checkboxset($div4_zielgruppen_psychografisch, 'div4_zielgruppen_psychografisch[]', 'div4CBp', 'div4_zielgruppen_psychografisch', $editing, $bool_rechte);
		?>
		</fieldset>
		<table class="em-location-data">
		<?php
		mnd_em_loc_textarea_tr('Kommentar', 5, 40, 600, 'kommentar', 'kommentar', $editing, $bool_rechte, false);
		?>
		<tr class="em-location-data-address">
			<th>Letzter Kontakt</th>
			<td>
				<input 	type="date" name="letzter_kontakt" id="letzter_kontakt"
					<?php if(!$bool_rechte) { ?> disabled <?php } ?>
					<?php if($editing) { ?> value="<?php echo $EM_Location->mndzeug['letzter_kontakt']; ?>" <?php } ?>
					<?php if($editing === false) { ?> value="<?php echo(date('Y-m-d')); ?>" <?php } ?>
					/>
			</td>
		</tr>		
		</table>
		</fieldset>
		<?php
	}
	?>
	<!-- div4 ende -->
	</div>
	<script>lernort_tooltips_einfuegen();</script>
	<?php
}

?>