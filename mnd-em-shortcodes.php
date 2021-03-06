<?php

function mnd_handelsort_placeholder_div1($EM_Location)
{
	$replaceparts = array();
	$replaceparts[] = "<strong>Sortiment:</strong>";
	$sortiment = array();
	foreach($EM_Location->mndzeug['div1_checkboxes'] as $sortimentti)
	{
		$sortiment[] = $sortimentti;
	}
	$replaceparts[] = implode(', ', $sortiment);
	return implode('<br>', $replaceparts);
}
function mnd_lernort_placeholder_div1($EM_Location)
{
	$replaceparts = array();
	//div1 teile checkboxen
	$replaceparts[] = "<strong>Inventar:</strong>";
	$sortiment = array();
	foreach($EM_Location->mndzeug['div1_checkboxes'] as $sortimentti)
	{
		$sortiment[] = $sortimentti;
	}
	$replaceparts[] = implode(', ', $sortiment);
	//div1 einzelstücke
	$replaceparts[] = "<strong>Catering:</strong> ".$EM_Location->mndzeug['catering_radio'];
	$replaceparts[] = "<strong>Mehr dazu:</strong> ".$EM_Location->mndzeug['catering_text'];
	$replaceparts[] = "<strong>Café vorhanden:</strong> ".$EM_Location->mndzeug['cafevorhanden'];
	return implode('<br>', $replaceparts);
}

function mnd_repaircafe_placeholder_div1($EM_Location)
{
	$replaceparts = array();
	//div1 einzelstücke
	$replaceparts[] = "<strong>Telefon:</strong> ".$EM_Location->mndzeug['telefon'];
	$replaceparts[] = "<strong>E-Mail:</strong> ".$EM_Location->mndzeug['email'];
	$replaceparts[] = "<strong>Website:</strong> ".$EM_Location->mndzeug['website'];
	$replaceparts[] = "<strong>Öffnungszeiten:</strong> ".$EM_Location->mndzeug['oeffnungszeiten'];
	//div1 oeffnungstage
	$replaceparts[] = "<strong>Öffnungstage:</strong>";
	$sortiment = array();
	foreach($EM_Location->mndzeug['oeffnungstage'] as $sortimentti)
	{
		$sortiment[] = $sortimentti;
	}
	$replaceparts[] = implode(', ', $sortiment);
	//div1 einzelstücke fortsetzung
	$replaceparts[] = "<strong>Andere Öffnungstage:</strong> ".$EM_Location->mndzeug['andere_oeffnungstage'];
	$replaceparts[] = "<strong>Ansprechpartner/in:</strong> ".$EM_Location->mndzeug['ansprechpartner'];
	$replaceparts[] = "<strong>Café vorhanden:</strong> ".$EM_Location->mndzeug['cafevorhanden'];
	//div1 teile checkboxen
	$replaceparts[] = "<strong>Ausstattung:</strong>";
	$sortiment = array();
	foreach($EM_Location->mndzeug['div1_checkboxes'] as $sortimentti)
	{
		$sortiment[] = $sortimentti;
	}
	$replaceparts[] = implode(', ', $sortiment);
	return implode('<br>', $replaceparts);
}

function mnd_handelsort_placeholder_div3($EM_Location)
{
	$replaceparts = array();
	//div3 teile
	$replaceparts[] = "<strong><u>Für Besucher:</u></strong>";
	$replaceparts[] = "<strong>Unterstützung vor Ort:</strong> ".$EM_Location->mndzeug['unterstuetzung'];
	$replaceparts[] = "<strong>Anmeldung erforderlich:</strong> ".$EM_Location->mndzeug['anmeldung'];
	$replaceparts[] = "<strong>Gruppengröße:</strong> von ".$EM_Location->mndzeug['gruppengr_von']." bis ".$EM_Location->mndzeug['gruppengr_bis'];
	$replaceparts[] = "<strong>Lernraumsituation:</strong> ".$EM_Location->mndzeug['lernraum'];
	$replaceparts[] = "<strong>Café vorhanden:</strong> ".$EM_Location->mndzeug['cafevorhanden'];
	$replaceparts[] = "<strong>Anmerkungen:</strong> ".$EM_Location->mndzeug['anmerkungen'];
	$replaceparts[] = "<strong>Ansprechpartner Rückruf:</strong> ".$EM_Location->mndzeug['ansprechpartner'];
	$replaceparts[] = "<strong>Rückrufnummer:</strong> ".$EM_Location->mndzeug['ansprechpartner_nr'];
	return implode('<br>', $replaceparts);
}
function mnd_lernort_placeholder_div3($EM_Location)
{
	$replaceparts = array();
	//div3 einzelstücke
	$replaceparts[] = "<strong><u>Weitere Informationen:</u></strong>";
	$replaceparts[] = "<strong>Unterstützung vor Ort:</strong> ".$EM_Location->mndzeug['unterstuetzung'];
	$replaceparts[] = "<strong>Anmeldung erforderlich:</strong> ".$EM_Location->mndzeug['anmeldung'];
	$replaceparts[] = "<strong>Gruppengröße:</strong> von ".$EM_Location->mndzeug['gruppengr_von']." bis ".$EM_Location->mndzeug['gruppengr_bis'];
	$replaceparts[] = "<strong>Lernraumsituation:</strong> ".$EM_Location->mndzeug['lernraum'];
	$replaceparts[] = "<strong>Anmerkungen:</strong> ".$EM_Location->mndzeug['anmerkungen'];
	$replaceparts[] = "<strong>Ansprechpartner Rückruf:</strong> ".$EM_Location->mndzeug['ansprechpartner'];
	$replaceparts[] = "<strong>Rückrufnummer:</strong> ".$EM_Location->mndzeug['ansprechpartner_nr'];
	$replaceparts[] = "<strong>Raum wird verwaltet durch:</strong> ".$EM_Location->mndzeug['raumverwaltung'];
	$replaceparts[] = " ";
	$replaceparts[] = "<strong>Raum für andere Seminare:</strong> ".$EM_Location->mndzeug['andereseminar_radio'];
	$replaceparts[] = "<strong>Gruppengröße:</strong> von ".$EM_Location->mndzeug['andereseminar_gr_von']." bis ".$EM_Location->mndzeug['andereseminar_gr_bis'];
	//$replaceparts[] = "<strong>Preis pro Stunde:</strong> ".$EM_Location->mndzeug['andereseminar_preis'];
	$replaceparts[] = "<strong>Bedingungen:</strong> ".$EM_Location->mndzeug['andereseminar_beding'];
	return implode('<br>', $replaceparts);
}

function mnd_repaircafe_placeholder_div3($EM_Location)
{
	$replaceparts = array();
	//div3 einzelstücke
	$replaceparts[] = "<strong><u>Weitere Informationen:</u></strong>";
	$replaceparts[] = "<strong>Unterstützung vor Ort:</strong> ".$EM_Location->mndzeug['unterstuetzung'];
	$replaceparts[] = "<strong>Anmeldung erforderlich:</strong> ".$EM_Location->mndzeug['anmeldung'];
	$replaceparts[] = "<strong>Gruppengröße:</strong> von ".$EM_Location->mndzeug['gruppengr_von']." bis ".$EM_Location->mndzeug['gruppengr_bis'];
	//div3_fokus
	$replaceparts[] = "<strong>Fokus:</strong>";
	$sortiment = mnd_repaircafe_placeholder_div3_fokus($EM_Location->mndzeug['div3_fokus_cb']);
	$replaceparts[] = implode('<br>', $sortiment);
	//fokus_sonstig
	$replaceparts[] = "<strong>Sonstiger Fokus:</strong> ".$EM_Location->mndzeug['fokus_sonstiges'];
	return implode('<br>', $replaceparts);
}
function mnd_repaircafe_placeholder_div3_fokus($foki)
{
	$sortiment = array();
	foreach($foki as $fokus)
	{
		$src = "";
		switch($fokus)
		{
			case "Selbstständige Reparatur": $src = plugins_url( '/icons/user-cog-solid.svg', __FILE__ ); break;
			case "Elektronik Reparatur": $src = plugins_url( '/icons/bolt-solid.svg', __FILE__ ); break;
			case "Handy Reparatur": $src = plugins_url( '/icons/mobile-alt-solid.svg', __FILE__ ); break;
			case "Computer Reparatur": $src = plugins_url( '/icons/laptop-solid.svg', __FILE__ ); break;
			case "Tablet Reparatur": $src = plugins_url( '/icons/tablet-alt-solid.svg', __FILE__ ); break;
			case "Mobilität": $src = plugins_url( '/icons/walking-solid.svg', __FILE__ ); break;
			case "Fahrrad Reparatur": $src = plugins_url( '/icons/car-solid.svg', __FILE__ ); break;
			case "Roller Reparatur": $src = plugins_url( '/icons/motorcycle-solid.svg', __FILE__ ); break;
			case "Auto Reparatur": $src = plugins_url( '/icons/car-solid.svg', __FILE__ ); break;
			case "Kreativität": $src = plugins_url( '/icons/pencil-ruler-solid.svg', __FILE__ ); break;
			case "Selbst nähen": $src = plugins_url( '/icons/cut-solid.svg', __FILE__ ); break;
			case "Upcycling": $src = plugins_url( '/icons/angle-double-up-solid.svg', __FILE__ ); break;
			case "Downcycling": $src = plugins_url( '/icons/angle-double-down-solid.svg', __FILE__ ); break;
			case "Kunst": $src = plugins_url( '/icons/palette-solid.svg', __FILE__ ); break;
			case "Brainstorming": $src = plugins_url( '/icons/comments-regular.svg', __FILE__ ); break;
			case "Coworking": $src = plugins_url( '/icons/slideshare-brands.svg', __FILE__ ); break;
		}
		
		$sortiment[] = "<div><img style='max-width:8%' class='img-fluid' src='".$src."' alt='".$fokus."' /> ".$fokus."</div>";
	}
	return $sortiment;
}


function mnd_handelsort_placeholder_div4($EM_Location)
{
	$replaceparts = array();
	$replaceparts[] = "<strong><u>Weitere Informationen:</u></strong>";
	$replaceparts[] = "<strong>Ansprechpartner Rückruf:</strong> ".$EM_Location->mndzeug['ansprechpartner'];
	$replaceparts[] = "<strong>Rückrufnummer:</strong> ".$EM_Location->mndzeug['ansprechpartner_nr'];
	$replaceparts[] = "<strong>Rückruftermin:</strong> ".$EM_Location->mndzeug['rueckruftermin'];
	$replaceparts[] = "<strong>Atmosphäre:</strong> ".$EM_Location->mndzeug['atmosphaere'];
	
	//div4_zielgruppen_demografisch
	$replaceparts[] = "<strong>Zielgruppe demografisch:</strong>";
	$sortiment = array();
	foreach($EM_Location->mndzeug['div4_zielgruppen_demografisch'] as $sortimentti)
	{
		$sortiment[] = $sortimentti;
	}
	$replaceparts[] = implode(', ', $sortiment);
	//div4_zielgruppen_psychografisch
	$replaceparts[] = "<strong>Zielgruppe psychographisch:</strong>";
	$sortiment = array();
	foreach($EM_Location->mndzeug['div4_zielgruppen_psychografisch'] as $sortimentti)
	{
		$sortiment[] = $sortimentti;
	}
	$replaceparts[] = implode(', ', $sortiment);					
	
	$replaceparts[] = "<strong>Kommentar:</strong> ".$EM_Location->mndzeug['pitch'];
	$replaceparts[] = "<strong>Letzter Kontakt:</strong> ".$EM_Location->mndzeug['letzter_kontakt'];
	return implode('<br>', $replaceparts);
}
function mnd_lernort_placeholder_div4($EM_Location)
{
	$replaceparts = array();
	$replaceparts[] = "<strong><u>Für Abonnenten:</u></strong>";
	$replaceparts[] = "<strong>Rückruftermin:</strong> ".$EM_Location->mndzeug['rueckruftermin'];
	$replaceparts[] = "<strong>Atmosphäre:</strong> ".$EM_Location->mndzeug['atmosphaere'];
	
	//div4_zielgruppen_demografisch
	$replaceparts[] = "<strong>Zielgruppe demografisch:</strong>";
	$sortiment = array();
	foreach($EM_Location->mndzeug['div4_zielgruppen_demografisch'] as $sortimentti)
	{
		$sortiment[] = $sortimentti;
	}
	$replaceparts[] = implode(', ', $sortiment);
	//div4_zielgruppen_psychografisch
	$replaceparts[] = "<strong>Zielgruppe psychographisch:</strong>";
	$sortiment = array();
	foreach($EM_Location->mndzeug['div4_zielgruppen_psychografisch'] as $sortimentti)
	{
		$sortiment[] = $sortimentti;
	}
	$replaceparts[] = implode(', ', $sortiment);					
	
	$replaceparts[] = "<strong>Kommentar:</strong> ".$EM_Location->mndzeug['kommentar'];
	$replaceparts[] = "<strong>Letzter Kontakt:</strong> ".$EM_Location->mndzeug['letzter_kontakt'];
	return implode('<br>', $replaceparts);
}

function mnd_repaircafe_placeholder_div4($EM_Location)
{
	$replaceparts = array();
	$replaceparts[] = "<strong><u>Für Abonnenten:</u></strong>";
	$replaceparts[] = "<strong>Rückruftermin:</strong> ".$EM_Location->mndzeug['rueckruftermin'];
	$replaceparts[] = "<strong>Atmosphäre:</strong> ".$EM_Location->mndzeug['atmosphaere'];
	
	//div4_zielgruppen_demografisch
	$replaceparts[] = "<strong>Zielgruppe demografisch:</strong>";
	$sortiment = array();
	foreach($EM_Location->mndzeug['div4_zielgruppen_demografisch'] as $sortimentti)
	{
		$sortiment[] = $sortimentti;
	}
	$replaceparts[] = implode(', ', $sortiment);
	//div4_zielgruppen_psychografisch
	$replaceparts[] = "<strong>Zielgruppe psychographisch:</strong>";
	$sortiment = array();
	foreach($EM_Location->mndzeug['div4_zielgruppen_psychografisch'] as $sortimentti)
	{
		$sortiment[] = $sortimentti;
	}
	$replaceparts[] = implode(', ', $sortiment);					
	
	$replaceparts[] = "<strong>Kommentar:</strong> ".$EM_Location->mndzeug['kommentar'];
	$replaceparts[] = "<strong>Letzter Kontakt:</strong> ".$EM_Location->mndzeug['letzter_kontakt'];
	return implode('<br>', $replaceparts);
}
/**
 * wenn events manager nach placeholdern schaut, wird dieser filter angewandt, 
 *    um die mnd-placeholder mit dem entsprechenden inhalt zu ersetzen
 *
 * @param string $replace
 * @param EM_Location $EM_Location
 * @param string $result
 * @return string
 */
function mnd_em_loc_placeholders($replace, $EM_Location, $result)
{
	if(isset($EM_Location->mndzeug)) //nur bei ort mit mndzeug
	{
		if( $result == '#_MNDTYP' )
		{
			return ucfirst($EM_Location->mndzeug['formular_art']);
		}
		elseif( $result == '#_MNDUNTERTYP' )
		{
			return ucfirst($EM_Location->mndzeug['div1_radio']);
		}
		elseif( $result == '#_MNDUNTERTYPCSS' )
		{
			return strtolower( $string = str_replace(' ', '', ($EM_Location->mndzeug['div1_radio'])) );
		}
		elseif( $result == '#_MNDDIV1' )
		{
			if($EM_Location->mndzeug['formular_art'] == "handelsort")
			{
				return mnd_handelsort_placeholder_div1($EM_Location);
			}
			elseif($EM_Location->mndzeug['formular_art'] == "lernort")
			{
				return mnd_lernort_placeholder_div1($EM_Location);
			}
			elseif($EM_Location->mndzeug['formular_art'] == "repaircafe")
			{
				return mnd_repaircafe_placeholder_div1($EM_Location);
			}
		}
		elseif( $result == '#_MNDDIV3' )
		{
			if($EM_Location->mndzeug['formular_art'] == "handelsort")
			{
				return mnd_handelsort_placeholder_div3($EM_Location);
			}
			elseif($EM_Location->mndzeug['formular_art'] == "lernort")
			{
				return mnd_lernort_placeholder_div3($EM_Location);
			}
			elseif($EM_Location->mndzeug['formular_art'] == "repaircafe")
			{
				return mnd_repaircafe_placeholder_div3($EM_Location);
			}
		}
		elseif( $result == '#_MNDDIV4' ) //div4 nur für abonnenten
		{
                    if( current_user_can(MND_TEST_RECHTE))
                    {
                        if($EM_Location->mndzeug['formular_art'] == "handelsort")
			{
                            return mnd_handelsort_placeholder_div4($EM_Location);
			}
			elseif($EM_Location->mndzeug['formular_art'] == "lernort")
			{
                            return mnd_lernort_placeholder_div4($EM_Location);
			}
			elseif($EM_Location->mndzeug['formular_art'] == "repaircafe")
			{
                            return mnd_repaircafe_placeholder_div4($EM_Location);
			}
                    }
                    else return "";
		}
		elseif( $result == '#_MNDRUECKRUF' )
		{
			if(current_user_can(MND_TEST_RECHTE))
			{
				if(isset($EM_Location->mndzeug['rueckruftermin']))
				{
					return $EM_Location->mndzeug['rueckruftermin'];
				}
				else return "Kein Rückruftermin";
			}
			else return "";
		}
	}
	
	return $replace;
}
add_filter('em_location_output_placeholder','mnd_em_loc_placeholders',1,3);




/* 
print content of enclosing shortcode if user is of role attribute 

beispiel:
	[user_role role="administrator"]
	You can see this text if you are an administrator.
	[/user_role]
	
	[user_role role="subscriber"]
	You can read this if you are a common subscriber.
	[/user_role]
	
	Anyone can read this text.
*/
function check_user_role( $atts, $content = null ) 
{
        extract( shortcode_atts( array(
                'role' => 'role' ), $atts ) );
 
        if( current_user_can( $role ) ) 
		{
			return $content;
        }
} 
/* register shortcode handler function */
add_shortcode( 'user_role', 'check_user_role' );


/*
	ruft das location formular von em auf
		[location_form "repaircafe"] (mit oder ohne anführungszeichen, ist egal)
	funktioniert nur noch mit einem argument, um bedienungsfehler zu verringern
*/
function mnd_em_get_location_form_shortcode( $args = array() )
{
	/*
		unverändertes location form von em wird geholt
		eindeutig identifizierbare stelle darin finden
		falls nicht existiert -> fatal error
		sonst frontend mnd metabox einfügen
		*/
		
	if(!empty($args))
	{
		$frisches_loc_form = em_get_location_form( (array) $args );
		return apply_filters( 'mnd_loc_filter', $frisches_loc_form, $args[0] );
	}
}
add_shortcode ( 'location_form', 'mnd_em_get_location_form_shortcode');

/*
in das gewöhnliche location form von events manager 
	wurde mit add_action 'MNDPLATZHALTER' als eindeutiger orientierungspunkt eingefügt.
diesen platzhalter nutzen wir nun, um die MND formularteile an der richtigen stelle einzufügen.
*/
function mnd_location_form_filter($string, $arg )
{
    $iposi = strpos($string, 'MNDPLATZHALTER'); //14zeichen
	
	if($iposi === false)
	{
		return "Sie haben nicht die nötigen Berechtigungen, um dieses Formular zu nutzen. <br> Sind Sie eingeloggt?";
	}
	$komplettes_form = substr_replace($string, mnd_em_loc_frontend_form_input($arg), $iposi, 14); //hier die 14zeichen
	
	return $komplettes_form;
}
add_filter( 'mnd_loc_filter', 'mnd_location_form_filter', 10, 2 );



?>