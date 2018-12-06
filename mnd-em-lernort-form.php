<?php

function mnd_lernortform($editing = false)
{
	global $EM_Location;
	if($editing)
	{
		?>
		<h3>Art/Typ: Lernort</h3>
		<?php
	}
	?>
	<div class="em-location-data">
	<input type='hidden' name='formular_art' value='lernort' />
	
	<!-- div1 anfang -->
	<fieldset name="lernort_div1">
	<h4>Unterart des Lernortes</h4>
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
		<tr class="em-location-data-address">
		<th>Catering</th>
			<td>
				<label for="catering_radioja">Ja</label>
				<input type="radio" id="catering_radioja" name="catering_radio" value="Ja" 
						<?php if($editing && $EM_Location->mndzeug['catering_radio'] == 'Ja') { ?> checked <?php } ?>
						/>
						<br/>
				<label for="catering_radionein">Nein</label>
				<input type="radio" id="catering_radionein" name="catering_radio" value="Nein" 
						<?php if(($editing && $EM_Location->mndzeug['catering_radio'] == 'Nein') || !$editing) { ?> checked <?php } ?>
						/>
						<br/>
				<label for="catering_radiovlt">In Absprache</label>
				<input type="radio" id="catering_radiovlt" name="catering_radio" value="In Absprache" 
						<?php if($editing && $EM_Location->mndzeug['catering_radio'] == 'In Absprache') { ?> checked <?php } ?>
						/>
			</td>
		</tr>
		<?php
		mnd_em_loc_textarea_tr('Mehr dazu', 5, 40, 600, 'catering_text', 'catering_text', $editing, true, 'Sag etwas mehr dazu…(z.B. Küchen- & Geschirrnutzung, Kaffeekannen, Kaffeepreise, Getränkepreise usw.)');
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
		mnd_em_loc_radioset_tr('Anmeldung erforderlich', array('Ja','Nein'), 1, 'anmeldung', 'anmeldung', $editing, true, false);
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
		mnd_em_loc_textarea_tr('Anmerkungen', 5, 40, 600, 'anmerkungen', 'anmerkungen', $editing, true);
		mnd_em_loc_textfeld_tr('Ansprechpartner des Eigentümers Rückruf', 'ansprechpartner', 'ansprechpartner', $editing, true, false);
		mnd_em_loc_textfeld_tr('Rückrufnummer', 'ansprechpartner_nr', 'ansprechpartner_nr', $editing, true, false);
		mnd_em_loc_textfeld_tr('Raum wird verwaltet durch', 'raumverwaltung', 'raumverwaltung', $editing, true, false);
		?>
		<tr><th>&nbsp;</th><td>&nbsp;</td></tr><!-- linebreak tabellenzeile der einfachheit halber -->
		<?php
		//gemeinnutz Seminare
		mnd_em_loc_radioset_tr('Seminarraum zur Verfügung für gemeinnützige Seminare?', array('Ja','Nein'), 1, 'gemeinnutzseminar_radio', 'gemeinnutzseminar_radio', $editing, true, false);
		?>
		<tr class="em-location-data-address">
			<th>Gruppengröße</th><!-- Gruppengr gemeinnutz seminare  -->
			<td>
				<label for="gemeinnutzseminar_gr_von">von</label>
				<input type="number" name="gemeinnutzseminar_gr_von" id="gemeinnutzseminar_gr_von" min="1" 
					<?php if($editing) { ?> value="<?php echo $EM_Location->mndzeug['gemeinnutzseminar_gr_von']; ?>" <?php } ?>
					/>
				<br/>
				<label for="gemeinnutzseminar_gr_bis">bis</label>
				<input type="number" name="gemeinnutzseminar_gr_bis" id="gemeinnutzseminar_gr_bis" min="1" 
					<?php if($editing) { ?> value="<?php echo $EM_Location->mndzeug['gemeinnutzseminar_gr_bis']; ?>" <?php } ?>
					/> 
			</td>
		</tr>
		<?php
		mnd_em_loc_textfeld_tr('Bedingungen', 'gemeinnutzseminar_beding', 'gemeinnutzseminar_beding', $editing, true, false);
		?>
		<tr><th>&nbsp;</th><td>&nbsp;</td></tr><!-- linebreak tabellenzeile der einfachheit halber -->
		<?php
		//andere Seminare
		mnd_em_loc_radioset_tr('Seminarraum zur Verfügung für andere Seminare?', array('Ja','Nein'), 1, 'andereseminar_radio', 'andereseminar_radio', $editing, true, false);
		?>
		<tr class="em-location-data-address">
			<th>Gruppengröße</th><!-- Gruppengr andere seminare  -->
			<td>
				<label for="andereseminar_gr_von">von</label>
				<input type="number" name="andereseminar_gr_von" id="andereseminar_gr_von" min="1" 
					<?php if($editing) { ?> value="<?php echo $EM_Location->mndzeug['andereseminar_gr_von']; ?>" <?php } ?>
					/>
				<br/>
				<label for="andereseminar_gr_bis">bis</label>
				<input type="number" name="andereseminar_gr_bis" id="andereseminar_gr_bis" min="1" 
					<?php if($editing) { ?> value="<?php echo $EM_Location->mndzeug['andereseminar_gr_bis']; ?>" <?php } ?>
					/> 
			</td>
		</tr>
		<?php
		mnd_em_loc_number_tr('Preis pro Stunde in €', 0, 0.01, 'andereseminar_preis', 'andereseminar_preis', $editing, true);
		mnd_em_loc_textfeld_tr('Bedingungen', 'andereseminar_beding', 'andereseminar_beding', $editing, true, false);
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
		mnd_em_loc_date_tr('Rückruftermin', 'rueckruftermin', 'rueckruftermin', $editing, $bool_rechte);
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
		mnd_em_loc_textarea_tr('Kommentar', 5, 40, 600, 'kommentar', 'kommentar', $editing, $bool_rechte);
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
	<?php
}

?>