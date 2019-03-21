<?php


/**
 * hakt die metabox bei orten zum editieren ein
 * bedeutet, dass die metabox bei diesen post types zum editieren aufgerufen werden kann
 */
function mnd_em_loc_meta_boxes()
{
	/*
	add_meta_box( 	string $id, string $title, 
					callable $callback, string|array|WP_Screen $screen = null, 
					string $context = 'advanced', string $priority = 'default', 
					array $callback_args = null )
	*/
	add_meta_box(	'em-event-mndzeug', 'Orttypformular', 
					'mnd_em_loc_metabox',EM_POST_TYPE_LOCATION, 
					'side','high'); //context kann nur side sein, weil es so eine metaboxart ist (siehe https://developer.wordpress.org/reference/functions/add_meta_box/ ) 
}
add_action('add_meta_boxes', 'mnd_em_loc_meta_boxes');

/**
 * dies ist die metabox, die ins formular beim editieren von bestehenden orten eingefügt wird
 */
function mnd_em_loc_metabox()
{
	global $EM_Location;
	
	//hier wird das richtige formular entsprechend des orttyps gewählt
	//wir editieren also das argument $editing = true
	switch($EM_Location->mndzeug['formular_art'])
	{
		case 'handelsort': mnd_handelsortform(true); break;
		case 'lernort': mnd_lernortform(true); break;
		case 'repaircafe': mnd_repairform(true); break;
	}
}

/**
 * fügt die metabox ins front end formular ein
 */
function mnd_em_loc_frontend_form_input($arg)
{
	ob_start();
	
	?>
	<div>
		<?php 
		switch($arg)
		{
			case 'handelsort': mnd_handelsortform(); break;
			case 'lernort': mnd_lernortform(); break;
			case 'repaircafe': mnd_repairform(); break;
		} 
		?>
	</div>
	<?php
	
	return ob_get_clean();
}


/**
 * das ist der anhaltspunkt, damit zuverlössig ins formular reingeschrieben werden kann
 *  mithilfe der filter funktion
*/
function mnd_platzhalter_in_locationeditor_einfuegen()
{
	//hier noch ein hinweis für den bildupload davor
	?>
	<h4>Maximale Größe: 200 kb</h4>
	<h4>Minimale Auflösung: 200x200</h4>
	<h4>Maximale Auflösung: 700x700</h4>
	<?php
	//hier die eigentliche funktion
	echo("MNDPLATZHALTER");
}
add_action('em_front_location_form_footer', 'mnd_platzhalter_in_locationeditor_einfuegen');




?>