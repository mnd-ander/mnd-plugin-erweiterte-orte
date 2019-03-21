<?php
 
/*
hier wird oft die wordpress funktion get_option() benutzt
die optionen wurden bei der intialisierung des plugins angelegt 
    in mnd-plugin-erweiterte-orte.php mnd_em_init()

die schreibweise $var = (is_array(get_option('lernort_div1_radio'))) ? get_option('lernort_div1_radio'):array()
stellt sicher dass auch in dem fall von verlorenen optionen (datenbankfehler?) das formular geladen wird
  und nicht irgendeine fehlermeldung entsteht
*/
function mnd_repairform($editing = false)
{
	//wir befinden uns bei do_action('em_front_location_form_footer')
	//EM hat hier $EM_Location als global deklariert, damit wir direkt auf die daten in dem objekt zugreifen können
	global $EM_Location;
	if($editing)
	{
		//damit niemand vergisst, um welche formularart es sich handelt, während der nutzer editiert
		//... nicht gerade wichtig
		?>
		<h3>Art/Typ: RepairCafé / DIY / Werkstatt</h3>
		<?php
	}
	?>
	<div class="em-location-data">
	<input type='hidden' name='formular_art' value='repaircafe' />
	
	<!-- div1 anfang -->
	<fieldset name="repaircafe_div1">
	<h4>Art des DIY Ortes [*]</h4>
	<?php
	$repaircafe_div1_radio = (is_array(get_option('repaircafe_div1_radio'))) ? get_option('repaircafe_div1_radio'):array();
	mnd_em_loc_radioset($repaircafe_div1_radio, 1, 'div1_radio', 'div1_radio', $editing, true, true);
	?>
	<h4>BasisInfos</h4>
	<table class="em-location-data">
	<?php
	mnd_em_loc_textfeld_tr('Telefon [*]', 'telefon', 'telefon', $editing, true, true);
	mnd_em_loc_textfeld_tr('E-Mail [*]', 'email', 'email', $editing, true, true);
	mnd_em_loc_textfeld_tr('Website', 'website', 'website', $editing, true, false);
	mnd_em_loc_textfeld_tr('Öffnungszeiten [*]', 'oeffnungszeiten', 'oeffnungszeiten', $editing, true, true);
	mnd_em_loc_oeffnungstage_checkboxset_tr('Öffnungstage [*]', 'oeffnungstage[]', 'oeffnungstage', $editing, true);
	mnd_em_loc_textfeld_tr('Andere Öffnungstage', 'andere_oeffnungstage', 'andere_oeffnungstage', $editing, true, false);
	mnd_em_loc_textfeld_tr('Ansprechpartner/in [*]', 'ansprechpartner', 'ansprechpartner', $editing, true, true);
	?>
	</table>
	<h4>Ausstattung [*]</h4>
	<?php
	$repaircafe_div1_ausstattung_cb = (is_array(get_option('repaircafe_div1_ausstattung_cb'))) ? get_option('repaircafe_div1_ausstattung_cb'):array();
	mnd_em_loc_checkboxset($repaircafe_div1_ausstattung_cb, 'div1[]', 'repairCB', 'div1_checkboxes', $editing, true);
	?>
	<table class="em-location-data">
	<?php
	mnd_em_loc_radioset_tr('Café vorhanden? [*]', array('Ja','Nein'), 1, 'cafevorhanden', 'cafevorhanden', $editing, true, true);
	?>
	</table>
	</fieldset>
	<!-- div1 ende -->
	<br/>
	<!-- div3 anfang -->
	<fieldset name="repaircafe_div3">
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
	</table>
	<h4>Fokus [*]</h4>
	<?php
	$repaircafe_div3_fokus_cb1 = (is_array(get_option('repaircafe_div3_fokus_cb1'))) ? get_option('repaircafe_div3_fokus_cb1'):array();
	mnd_em_loc_checkboxset($repaircafe_div3_fokus_cb1, 'div3_fokus_cb[]', 'fokusCB1', 'div3_fokus_cb', $editing, true);
	
	$repaircafe_div3_fokus_cb2 = (is_array(get_option('repaircafe_div3_fokus_cb2'))) ? get_option('repaircafe_div3_fokus_cb2'):array();
	mnd_em_loc_checkboxset_multiclick($repaircafe_div3_fokus_cb2, 'div3_fokus_cb[]', 'fokusCB2', 'div3_fokus_cb', $editing, true);
		
	$repaircafe_div3_fokus_cb3 = (is_array(get_option('repaircafe_div3_fokus_cb3'))) ? get_option('repaircafe_div3_fokus_cb3'):array();
	mnd_em_loc_checkboxset_multiclick($repaircafe_div3_fokus_cb3, 'div3_fokus_cb[]', 'fokusCB3', 'div3_fokus_cb', $editing, true);
	
	$repaircafe_div3_fokus_cb4 = (is_array(get_option('repaircafe_div3_fokus_cb4'))) ? get_option('repaircafe_div3_fokus_cb4'):array();
	mnd_em_loc_checkboxset_multiclick($repaircafe_div3_fokus_cb4, 'div3_fokus_cb[]', 'fokusCB4', 'div3_fokus_cb', $editing, true);
	
	$repaircafe_div3_fokus_cb5 = (is_array(get_option('repaircafe_div3_fokus_cb5'))) ? get_option('repaircafe_div3_fokus_cb5'):array();
	mnd_em_loc_checkboxset_multiclick($repaircafe_div3_fokus_cb5, 'div3_fokus_cb[]', 'fokusCB5', 'div3_fokus_cb', $editing, true);
	?>
	<table class="em-location-data">
	<?php
	mnd_em_loc_textfeld_tr('Sonstiges', 'fokus_sonstiges', 'fokus_sonstiges', $editing, true, false);
	?>
	</table>
	</fieldset>
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
	<script>repaircafe_tooltips_einfuegen();</script>
	<?php
}

?>