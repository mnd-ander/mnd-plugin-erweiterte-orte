<?php

function mnd_em_loc_load_radio(&$mndzeug ,$loc_id, $option_name, $meta_key)
{
    global $wpdb;
	
    $query = "SELECT meta_value FROM ".EM_META_TABLE." WHERE object_id=".$loc_id." AND meta_key='$meta_key'";
    $db_ergebnis = $wpdb->get_var($query);
    //vergleich mit eingestellten radios, damit kein murks angezeigt wird
    $div1_radio = (is_array(get_option($option_name))) ? get_option($option_name):array();
    if(in_array($db_ergebnis, $div1_radio))
    {
        $mndzeug[$meta_key] = $db_ergebnis;
    }
}
function mnd_em_loc_load_checkboxen(&$mndzeug ,$loc_id, $option_name, $meta_key)
{
	global $wpdb;
	
	$metakeytobe = "meta_key='$meta_key'";
	//checkboxen metakey abfrage ausführen
	$sql = $wpdb->prepare("SELECT meta_value FROM ".EM_META_TABLE
												." WHERE object_id=".$loc_id." AND ".$metakeytobe);

	$db_ergebnis = $wpdb->get_col($sql, 0);

	//vergleich mit den eingestellten checkboxen, damit kein murks angezeigt wird
	$div1_checkboxes = (is_array(get_option($option_name))) ? get_option($option_name):array();

	$mndzeug[$meta_key] = array();
	foreach($db_ergebnis as $meta_entry)
	{
		if(in_array($meta_entry, $div1_checkboxes))
		{
			$mndzeug[$meta_key][] = $meta_entry;
		}
	}
}
function mnd_em_loc_load_einzelteile(&$mndzeug ,$loc_id, $option_name)
{
	global $wpdb;
	
	$div3_teile = (is_array(get_option($option_name))) ? get_option($option_name):array();
	$metakeytobe = "meta_key='".$div3_teile[0]."'";

	for($i = 1; $i < count($div3_teile); $i++)
	{
		$metakeytobe = $metakeytobe." OR meta_key='".$div3_teile[$i]."' ";
	}
	$metakeytobe = "( ".$metakeytobe." )";

	$sql = $wpdb->prepare("SELECT * FROM ".EM_META_TABLE
										." WHERE object_id=".$loc_id." AND ".$metakeytobe);
	$db_ergebnis = $wpdb->get_results($sql);

	if($db_ergebnis)
	{
		foreach ( $db_ergebnis as $dbzeile_mit_key_und_value )
		{
			//kann hier typen ignorieren, weil alles strings
			$mndzeug[$dbzeile_mit_key_und_value->meta_key] = $dbzeile_mit_key_und_value->meta_value;
		}
	}
}
/**
 * fügt das mndzeug array dem event zu, wenn es von der db instanziiert wird
 */
function mnd_em_loc_load($EM_Location)
{
    global $wpdb;

    //diese variable geht ins location_object und trägt alle murks metadaten
    $mndzeug = array();

    //art des ortes abfragen	
    $loc_id = $EM_Location->location_id;
    $query = "SELECT meta_value FROM ".EM_META_TABLE." WHERE object_id=".$loc_id." AND meta_key='formular_art'";
    $db_ergebnis = $wpdb->get_var($query);

    if($db_ergebnis == 'handelsort')
    {
        $mndzeug['formular_art'] = 'handelsort';

        //div1
        mnd_em_loc_load_radio($mndzeug, $loc_id, 'handel_div1_radio', 'div1_radio');
		mnd_em_loc_load_checkboxen(&$mndzeug ,$loc_id, 'handel_div1_checkboxes', 'div1_checkboxes');
        //div3
		mnd_em_loc_load_einzelteile(&$mndzeug ,$loc_id, 'handel_div3_teile');
        //div4
		mnd_em_loc_load_einzelteile(&$mndzeug ,$loc_id, 'handel_div4_teile');
    }
    elseif($db_ergebnis == 'lernort')
    {
        $mndzeug['formular_art'] = 'lernort';

        //div1
		mnd_em_loc_load_radio($mndzeug, $loc_id, 'lernort_div1_radio', 'div1_radio');
		mnd_em_loc_load_checkboxen(&$mndzeug ,$loc_id, 'lernort_div1_inventar_cb', 'div1_checkboxes');	
		mnd_em_loc_load_einzelteile(&$mndzeug ,$loc_id, 'lernort_div1_teile');
		//div3
		mnd_em_loc_load_einzelteile(&$mndzeug ,$loc_id, 'lernort_div3_teile');
		//div4
		mnd_em_loc_load_einzelteile(&$mndzeug ,$loc_id, 'lernort_div4_teile');
    }
    elseif($db_ergebnis == 'repaircafe')
    {
        $mndzeug['formular_art'] = 'repaircafe';

        //div1
		mnd_em_loc_load_radio($mndzeug, $loc_id, 'repaircafe_div1_radio', 'div1_radio');
		mnd_em_loc_load_checkboxen(&$mndzeug ,$loc_id, 'repaircafe_div1_ausstattung_cb', 'div1_checkboxes');	
		//div1_oeffnungstage
        $metakeytobe = "meta_key='oeffnungstage'";
        ///checkboxen metakey abfrage ausführen
        $sql = $wpdb->prepare("SELECT meta_value FROM "
													.EM_META_TABLE
													." WHERE object_id=%s AND ".$metakeytobe,
											   $EM_Location->location_id);
        $db_ergebnis = $wpdb->get_col($sql, 0);
        ///vergleich mit Wochentagen, damit kein murks angezeigt wird
        $wochentage = array
        (
			'Mo','Di','Mi','Do','Fr','Sa','So'
        );
        $mndzeug['oeffnungstage'] = array();
        foreach($db_ergebnis as $meta_entry)
        {
			if(in_array($meta_entry, $wochentage))
			{
				$mndzeug['oeffnungstage'][] = $meta_entry;
			}
        }
        //div3_fokus_cb
        $metakeytobe = "meta_key='div3_fokus_cb'";

        ///checkboxen metakey abfrage ausführen
        $sql = $wpdb->prepare("SELECT meta_value FROM "
													.EM_META_TABLE
													." WHERE object_id=%s AND ".$metakeytobe,
											   $EM_Location->location_id);

        $db_ergebnis = $wpdb->get_col($sql, 0);

        ///vergleich mit den eingestellten checkboxen, damit kein murks angezeigt wird
        $repaircafe_div3_fokus_cb1 = (is_array(get_option('repaircafe_div3_fokus_cb1'))) ? get_option('repaircafe_div3_fokus_cb1'):array();
        $repaircafe_div3_fokus_cb2 = (is_array(get_option('repaircafe_div3_fokus_cb2'))) ? get_option('repaircafe_div3_fokus_cb2'):array();
        $repaircafe_div3_fokus_cb3 = (is_array(get_option('repaircafe_div3_fokus_cb3'))) ? get_option('repaircafe_div3_fokus_cb3'):array();
        $repaircafe_div3_fokus_cb4 = (is_array(get_option('repaircafe_div3_fokus_cb4'))) ? get_option('repaircafe_div3_fokus_cb4'):array();
        $repaircafe_div3_fokus_cb5 = (is_array(get_option('repaircafe_div3_fokus_cb5'))) ? get_option('repaircafe_div3_fokus_cb5'):array();
        $repaircafe_div3_fokus_cb = array_merge($repaircafe_div3_fokus_cb1, $repaircafe_div3_fokus_cb2, $repaircafe_div3_fokus_cb3, $repaircafe_div3_fokus_cb4, $repaircafe_div3_fokus_cb5);

        $mndzeug['div3_fokus_cb'] = array();
        foreach($db_ergebnis as $meta_entry)
        {
			if(in_array($meta_entry, $repaircafe_div3_fokus_cb))
			{
					$mndzeug['div3_fokus_cb'][] = $meta_entry;
			}
        }

        //div1+3+4_teile 
		mnd_em_loc_load_einzelteile(&$mndzeug ,$loc_id, 'repaircafe_div1_teile');
		mnd_em_loc_load_einzelteile(&$mndzeug ,$loc_id, 'repaircafe_div3_teile');
		mnd_em_loc_load_einzelteile(&$mndzeug ,$loc_id, 'repaircafe_div4_teile');
       
    } //ende elseif($db_ergebnis == 'repaircafe')
	if(isset($mndzeug['formular_art']))
	{
		 //zielgruppen
		mnd_em_loc_load_checkboxen(&$mndzeug ,$loc_id, 'div4_zielgruppen_demografisch', 'div4_zielgruppen_demografisch');
		mnd_em_loc_load_checkboxen(&$mndzeug ,$loc_id, 'div4_zielgruppen_psychografisch', 'div4_zielgruppen_psychografisch');
	}

    $EM_Location->mndzeug = $mndzeug;
}
add_action('em_location','mnd_em_loc_load',1,1);



function mnd_em_loc_save_queryteile_array_auffuellen_einzelteile( &$EM_Location, $option_name, &$ids_to_add )
{
    $div_teile = (is_array(get_option($option_name))) ? get_option($option_name):array();
    foreach( $div_teile as $div_teil )
    {
        $meta_value = $_POST[$div_teil];
        $EM_Location->mndzeug[$div_teil] = $_POST[$div_teil];
        $ids_to_add[] = "({$EM_Location->location_id}, '$div_teil', '$meta_value')";
    }
}
function mnd_em_loc_save_queryteile_array_auffuellen_checkbox( &$EM_Location, $option_name, $post_name, $meta_key, &$ids_to_add )
{
    $div1_checkboxes = (is_array(get_option($option_name))) ? get_option($option_name):array();
    if(isset($_POST[$post_name]))
    {
        foreach( $_POST[$post_name] as $checkbox_name )
        {
            if( in_array($checkbox_name, $div1_checkboxes, true) )
            {
                $ids_to_add[] = "({$EM_Location->location_id}, '$meta_key', '$checkbox_name')";
                $EM_Location->mndzeug[$meta_key][] = $checkbox_name;
            }
        }
    }
}
function mnd_em_loc_save_queryteile_array_auffuellen_radio( &$EM_Location, $option_name, $post_name, &$ids_to_add )
{
    $div1_radio = (is_array(get_option($option_name))) ? get_option($option_name):array();
    $chosen_radio = (isset($_POST[$post_name])) ? $_POST[$post_name] : null;
    if( in_array($chosen_radio, $div1_radio, true) )
    {
        $ids_to_add[] = "({$EM_Location->location_id}, '$post_name', '$chosen_radio')";
        $EM_Location->mndzeug[$post_name] = $chosen_radio;
    }
}
/**
 * speichert die metadaten in die datenbank im EM_META_TABLE
 * @param bool $result
 * @param EM_Event $EM_Location
 * @return bool
 */
function mnd_em_loc_save($result,$EM_Location)
{
    //diese Funktion kann einiges an optimierung vertragen
    //->paar dinge sind mehrmals geschrieben

    global $wpdb;
    //First delete any old saves of meta
    if(!empty($_POST['formular_art']))
    {
        $wpdb->query("DELETE FROM ".EM_META_TABLE
                        ." WHERE object_id='{$EM_Location->location_id}' AND "
                        .mnd_em_get_loc_meta_keys($_POST['formular_art']) );
    }

    //$EM_Location->location_id bedeutet, dass es eine location_id hat, also dass es ein ordentlich gespeicherter ort ist
    if( $EM_Location->location_id && isset($_POST['formular_art']) )
    {
        $ids_to_add = array();
        $EM_Location->mndzeug = array();

        if($_POST['formular_art'] == 'handelsort')
        {
            $EM_Location->mndzeug['formular_art'] = 'handelsort';

            //das sind die query teile zum speichern in meta_table
                                        //	object_id,       meta_key,  meta_value)
            $ids_to_add[] = "({$EM_Location->location_id}, 'formular_art', 'handelsort')";

            //div1
            mnd_em_loc_save_queryteile_array_auffuellen_checkbox( $EM_Location, 'handel_div1_checkboxes', 'div1', 'div1_checkboxes', $ids_to_add);
            mnd_em_loc_save_queryteile_array_auffuellen_radio( $EM_Location, 'handel_div1_radio', 'div1_radio', $ids_to_add );
            //div3
            mnd_em_loc_save_queryteile_array_auffuellen_einzelteile( $EM_Location, 'handel_div3_teile', $ids_to_add );
            //div4
            mnd_em_loc_save_queryteile_array_auffuellen_einzelteile( $EM_Location, 'handel_div4_teile', $ids_to_add );
        }
        elseif($_POST['formular_art'] == 'lernort')
        {
            $EM_Location->mndzeug['formular_art'] = 'lernort';
            //das sind die query teile zum speichern in meta_table
                                            //	object_id,       meta_key,  meta_value)
            $ids_to_add[] = "({$EM_Location->location_id}, 'formular_art', 'lernort')";

            //div1
            mnd_em_loc_save_queryteile_array_auffuellen_checkbox( $EM_Location, 'lernort_div1_inventar_cb', 'div1', 'div1_checkboxes', $ids_to_add);
            mnd_em_loc_save_queryteile_array_auffuellen_radio( $EM_Location, 'lernort_div1_radio', 'div1_radio', $ids_to_add );
            mnd_em_loc_save_queryteile_array_auffuellen_einzelteile($EM_Location, 'lernort_div1_teile', $ids_to_add);
            //div3
            mnd_em_loc_save_queryteile_array_auffuellen_einzelteile($EM_Location, 'lernort_div3_teile', $ids_to_add);			
            //div4
            mnd_em_loc_save_queryteile_array_auffuellen_einzelteile($EM_Location, 'lernort_div4_teile', $ids_to_add);
        }
        elseif($_POST['formular_art'] == 'repaircafe')
        {
            $EM_Location->mndzeug['formular_art'] = 'repaircafe';
            //das sind die query teile zum speichern in meta_table
                                            //	object_id,       meta_key,  meta_value)
            $ids_to_add[] = "({$EM_Location->location_id}, 'formular_art', 'repaircafe')";

            //div1 radio und cb
            mnd_em_loc_save_queryteile_array_auffuellen_checkbox( $EM_Location, 'repaircafe_div1_ausstattung_cb', 'div1', 'div1_checkboxes', $ids_to_add);
            mnd_em_loc_save_queryteile_array_auffuellen_radio( $EM_Location, 'repaircafe_div1_radio', 'div1_radio', $ids_to_add );
            mnd_em_loc_save_queryteile_array_auffuellen_einzelteile( $EM_Location, 'repaircafe_div1_teile', $ids_to_add );
            //div1_oeffnungstage
            $wochentage = array
            (
                'Mo','Di','Mi','Do','Fr','Sa','So'
            );
            if(isset($_POST['oeffnungstage']))
            {
                foreach( $_POST['oeffnungstage'] as $oeffnungstag )
                {
                    if( in_array($oeffnungstag, $wochentage, true) )
                    {
                        $ids_to_add[] = "({$EM_Location->location_id}, 'oeffnungstage', '$oeffnungstag')";
                        $EM_Location->mndzeug['oeffnungstage'][] = $oeffnungstag;
                    }
                }
            }

            //div3
            mnd_em_loc_save_queryteile_array_auffuellen_einzelteile($EM_Location, 'repaircafe_div3_teile', $ids_to_add);
            //div3_fokus_cb
            $repaircafe_div3_fokus_cb1 = (is_array(get_option('repaircafe_div3_fokus_cb1'))) ? get_option('repaircafe_div3_fokus_cb1'):array();
            $repaircafe_div3_fokus_cb2 = (is_array(get_option('repaircafe_div3_fokus_cb2'))) ? get_option('repaircafe_div3_fokus_cb2'):array();
            $repaircafe_div3_fokus_cb3 = (is_array(get_option('repaircafe_div3_fokus_cb3'))) ? get_option('repaircafe_div3_fokus_cb3'):array();
            $repaircafe_div3_fokus_cb4 = (is_array(get_option('repaircafe_div3_fokus_cb4'))) ? get_option('repaircafe_div3_fokus_cb4'):array();
            $repaircafe_div3_fokus_cb5 = (is_array(get_option('repaircafe_div3_fokus_cb5'))) ? get_option('repaircafe_div3_fokus_cb5'):array();
            $repaircafe_div3_fokus_cb = array_merge($repaircafe_div3_fokus_cb1, $repaircafe_div3_fokus_cb2, $repaircafe_div3_fokus_cb3, $repaircafe_div3_fokus_cb4, $repaircafe_div3_fokus_cb5);
            if(isset($_POST['div3_fokus_cb']))
            {
                foreach( $_POST['div3_fokus_cb'] as $checkbox_name )
                {
                    if( in_array($checkbox_name, $repaircafe_div3_fokus_cb, true) )
                    {
                        $ids_to_add[] = "({$EM_Location->location_id}, 'div3_fokus_cb', '$checkbox_name')";
                        $EM_Location->mndzeug['div3_fokus_cb'][] = $checkbox_name;
                    }
                }
            }

            //div4
            mnd_em_loc_save_queryteile_array_auffuellen_einzelteile($EM_Location, 'repaircafe_div4_teile', $ids_to_add);
        }
        //zielgruppen sind bei allen orttypen gleich, daher hier einfach immer hintendran
        //dieser umstand könnte sich irgendwann ändern, also beachten und eventuell ändern
        mnd_em_loc_save_queryteile_array_auffuellen_checkbox( $EM_Location, 'div4_zielgruppen_demografisch', 'div4_zielgruppen_demografisch', 'div4_zielgruppen_demografisch', $ids_to_add);
        mnd_em_loc_save_queryteile_array_auffuellen_checkbox( $EM_Location, 'div4_zielgruppen_psychografisch', 'div4_zielgruppen_psychografisch', 'div4_zielgruppen_psychografisch', $ids_to_add);

        //speichern
        if( count($ids_to_add) > 0 )
        {
            $wpdb->query("INSERT INTO ".EM_META_TABLE." (object_id, meta_key, meta_value) VALUES ".implode(',',$ids_to_add));
        }
    }
    return $result;
}
add_filter('em_location_save','mnd_em_loc_save',1,2);

/**
 * helferfunktion zum vervollständigen der mysql abfrage 
 * wird nur benutzt, um das löschen einfach zu machen
 */
function mnd_em_get_loc_meta_keys($arg)
{
    $metakeytobe = "meta_key='formular_art'";
    if($arg == 'handelsort')
    {
        $einzel_keys = array
        (
            'div1_checkboxes', 'div1_radio', 'div4_zielgruppen_demografisch', 'div4_zielgruppen_psychografisch'
        );
        $div3_teile = (is_array(get_option('handel_div3_teile'))) ? get_option('handel_div3_teile'):array();
        $div4_teile = (is_array(get_option('handel_div4_teile'))) ? get_option('handel_div4_teile'):array();
        foreach( array_merge($div3_teile, $div4_teile, $einzel_keys) as $div_teil )
        {
            $metakeytobe = $metakeytobe." OR meta_key='".$div_teil."' ";
        }
    }
    elseif($arg == 'lernort')
    {
        $einzel_keys = array
        (
            'div1_checkboxes', 'div1_radio', 'div4_zielgruppen_demografisch', 'div4_zielgruppen_psychografisch'
        );
        $lernort_div1_teile = (is_array(get_option('lernort_div1_teile'))) ? get_option('lernort_div1_teile'):array();
        $lernort_div3_teile = (is_array(get_option('lernort_div3_teile'))) ? get_option('lernort_div3_teile'):array();
        $lernort_div4_teile = (is_array(get_option('lernort_div4_teile'))) ? get_option('lernort_div4_teile'):array();
        foreach( array_merge($lernort_div1_teile, $lernort_div3_teile, $lernort_div4_teile, $einzel_keys) as $div_teil )
        {
            $metakeytobe = $metakeytobe." OR meta_key='".$div_teil."' ";
        }
    }
    elseif($arg == 'repaircafe')
    {
        $einzel_keys = array
        (
            'div1_checkboxes', 'div1_radio', 'div4_zielgruppen_demografisch', 'div4_zielgruppen_psychografisch',
            'div3_fokus_cb', 'oeffnungstage'
        );
        $repaircafe_div1_teile = (is_array(get_option('repaircafe_div1_teile'))) ? get_option('repaircafe_div1_teile'):array();
        $repaircafe_div3_teile = (is_array(get_option('repaircafe_div3_teile'))) ? get_option('repaircafe_div3_teile'):array();
        $repaircafe_div4_teile = (is_array(get_option('repaircafe_div4_teile'))) ? get_option('repaircafe_div4_teile'):array();
        foreach( array_merge($repaircafe_div1_teile, $repaircafe_div3_teile, $repaircafe_div4_teile, $einzel_keys) as $div_teil )
        {
            $metakeytobe = $metakeytobe." OR meta_key='".$div_teil."' ";
        }
    }
    return "( ".$metakeytobe." )";
}

/**
 * löscht die meta einträge aus der datenbank, wenn der zugehörige ort gelöscht wird
 * @param boolean $result
 * @param EM_Location $EM_Location
 * @return boolean
 */
function mnd_em_loc_delete_meta($result, $EM_Location)
{
    global $wpdb;
    $sql = $wpdb->prepare("DELETE FROM ".EM_META_TABLE." WHERE ".mnd_em_get_loc_meta_keys($EM_Location->mndzeug['formular_art'])." AND object_id = %d", $EM_Location->location_id);
    $wpdb->query($sql);
    return $result;
}
add_filter('em_location_delete_meta','mnd_em_loc_delete_meta',1,3);



?>