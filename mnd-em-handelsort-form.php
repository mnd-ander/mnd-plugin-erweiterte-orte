<?php

function mnd_handelsortform($editing = false)
{
	global $EM_Location;
	if($editing === true)
	{
		?>
		<h3>Art/Typ: Handelsort</h3>
		<?php
	}
	?>
	<div class="em-location-data">
	<input type='hidden' name='formular_art' value='handelsort' />
	
	<!-- div1 anfang -->
	<fieldset name="sortiment">
	<h4>Unterart des Handelsortes</h4>
	<?php
	$handel_div1_radio = (is_array(get_option('handel_div1_radio'))) ? get_option('handel_div1_radio'):array();
	mnd_em_loc_radioset($handel_div1_radio, 1, 'div1_radio', 'div1_radio', $editing, true, true);
	?>
	<h4>Kernsortiment</h4>
	<?php	
	$checkboxes = (is_array(get_option('handel_div1_checkboxes'))) ? get_option('handel_div1_checkboxes'):array();
	mnd_em_loc_checkboxset($checkboxes, 'div1[]', 'handelCB', 'div1_checkboxes', $editing, true);
	?>
	</fieldset>
	<!-- div1 ende -->
	
	<!-- div3 anfang -->
	<br/>
	<h4>Für Besucher</h4>
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
		<tr class="em-location-data-address">
		<th>Lernraumsituation</th>
			<td>
				<input 	type="text" name="lernraum" id="lernraum"
						<?php if($editing) { ?> value="<?php echo $EM_Location->mndzeug['lernraum']; ?>" <?php } ?>
						/>  
			</td>
		</tr>
		<tr class="em-location-data-address">
		<th>Café vorhanden?</th>
			<td>
				<label for="cafevorhandenja">Ja</label>
				<input type="radio" id="cafevorhandenja" name="cafevorhanden" value="Ja" 
						<?php if($editing && $EM_Location->mndzeug['cafevorhanden'] == 'Ja') { ?> checked <?php } ?>
						/>
						<br/>
				<label for="cafevorhandennein">Nein</label>
				<input type="radio" id="cafevorhandennein" name="cafevorhanden" value="Nein" 
						<?php if(($editing && $EM_Location->mndzeug['cafevorhanden'] == 'Nein') || !$editing) { ?> checked <?php } ?>
						/>
			</td>
		</tr>
		<tr class="em-location-data-address">
		<th>Anmerkungen</th>
			<td>
				<textarea id="anmerkungen" name="anmerkungen"
                  rows="5" cols="40" maxlength="600"
                  wrap="hard" ><?php if($editing) { echo $EM_Location->mndzeug['anmerkungen']; } ?></textarea>
			</td>
		</tr>
		
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
		mnd_em_loc_textfeld_tr('Ansprechpartner Rückruf', 'ansprechpartner', 'ansprechpartner', $editing, $bool_rechte, false);
		mnd_em_loc_textfeld_tr('Rückrufnummer', 'ansprechpartner_nr', 'ansprechpartner_nr', $editing, $bool_rechte, false);
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
		mnd_em_loc_textarea_tr('Kommentar', 5, 40, 600, 'pitch', 'pitch', $editing, $bool_rechte, false);
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
	<br/><!-- extra br damit der button etwas abstand hat -->
	</div><!-- div handelsort form ende -->
	<?php
}


?>