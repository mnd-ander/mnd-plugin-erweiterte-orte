<?php

if (!defined('WP_UNINSTALL_PLUGIN')) 
{
    die;
}

//4,5,6 optionen - 3mal raten in welcher reihenfolge die formulare entstanden sind
//handelsort optionen
delete_option('handel_div1_checkboxes');	
delete_option('handel_div1_radio');	
delete_option('handel_div3_teile');	
delete_option('handel_div4_teile');	
//lernort optionen
delete_option('lernort_div1_radio');	
delete_option('lernort_div1_inventar_cb');	
delete_option('lernort_div1_teile');	
delete_option('lernort_div3_teile');	
delete_option('lernort_div4_teile');	
//repaircafe optionen
delete_option('repaircafe_div1_radio');
delete_option('repaircafe_div1_teile');
delete_option('repaircafe_div1_ausstattung_cb');
delete_option('repaircafe_div3_teile');
delete_option('repaircafe_div3_fokus_cb1');
delete_option('repaircafe_div3_fokus_cb2');
delete_option('repaircafe_div3_fokus_cb3');
delete_option('repaircafe_div3_fokus_cb4');
delete_option('repaircafe_div3_fokus_cb5');
delete_option('repaircafe_div4_teile');
//allerortsoptionen
delete_option('div4_zielgruppen_demografisch');	
delete_option('div4_zielgruppen_psychografisch');	

//veraltete optionen löschen
if(get_option('mnd_em_version') <= 0.0810)
{
	delete_option('ander_em_version');	
	delete_option('handel_div4_checkboxes');
	delete_option('repaircafe_div3_fokus_cb');
}

/* von lerntort_div3 entfernt in 0.0812
"gemeinnutzseminar_radio", "gemeinnutzseminar_gr_von", "gemeinnutzseminar_gr_bis", "gemeinnutzseminar_beding"
*/
if(get_option('mnd_em_version') <= 0.0812)
{
	$veraltete_metakeys = array
	(
		"gemeinnutzseminar_radio", "gemeinnutzseminar_gr_von", "gemeinnutzseminar_gr_bis", "gemeinnutzseminar_beding"
	);
	$zu_loeschende_keys = "meta_key='gemeinnutzseminar_radio'";
	foreach($veraltete_metakeys as $alter_key)
	{
		$zu_loeschende_keys = $zu_loeschende_keys." OR meta_key='".$alter_key."' ";
	}
	$wpdb->query("DELETE FROM ".EM_META_TABLE
				." WHERE ".$zu_loeschende_keys);
}

//versionsnummer als letztes gelöscht, damit vielleicht mal veraltete optionen nur bei alten versionen gelöscht werden
delete_option('mnd_em_version');	

?>