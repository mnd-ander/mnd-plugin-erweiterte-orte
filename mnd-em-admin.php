<?php


/**
 * hakt das untermenü mit dem namen AnderBox im Events Manager adminmenü ein 
 */
function mnd_em_admin_submenu()
{
	if(function_exists('add_submenu_page')) 
	{
   		//             add_submenu_page( string $parent_slug, string $page_title, string $menu_title, string $capability, string $menu_slug, callable $function = '' )
		$plugin_page = add_submenu_page('edit.php?post_type='.EM_POST_TYPE_EVENT, 'Ander Boxen', 'AnderBox', 'edit_locations', "events-manager-mndbox", 'mnd_em_admin_page');
  	}
}
add_action('admin_menu','mnd_em_admin_submenu', 20);


/**
 * das AnderBox untermenü
 */
function mnd_em_admin_page()
{
	global $EM_Notices;
	
	?>
	<div class='wrap'>
		<div id='icon-edit' class='icon32'>
			<br/>
		</div>
  		<h2>Anders erweiterte Orte</h2>	 		
		<?php echo $EM_Notices; ?>
		<div id='col-container'>
			<!-- begin col-right -->   
			<div id='col-right'>
			 	<div class='col-wrap'>     
					<h3>Aktuell akzeptierte Formulartypen:</h3>				
				 	<ol>
						<li>handelsort</li>
						<li>lernort</li>
						<li>repaircafe</li>
					</ol>  
					<h3>Verfügbare Frontend Platzhalter:</h3>				
				 	<ol>
						<li>#_MNDTYP</li>
						<li>#_MNDUNTERTYP</li>
						<li>#_MNDDIV1</li>
						<li>#_MNDDIV3</li>
						<li>#_MNDDIV4</li>
						<li>#_MNDRUECKRUF</li>
						<li>#_MNDUNTERTYPCSS</li>
					</ol>
				</div>
			</div>
			<!-- end col-right -->
			
			<!-- begin col-left -->
			<div id='col-left'>
		  		<div class='col-wrap'>
					<h3>Achtung - Wichtig:</h3> 
					<p>
						Dieses Plugin kann nur fehlerfrei funktionieren, wenn Events nicht mit neuen Orten eingetragen werden können.
						Orte müssen getrennt über das location_form eingereicht werden
						<br><br>
						Die Einstellung ist zu finden unter:
						<br>
						Events ->Settings ->General ->General Options ->Location Settings ->Use dropdown for locations?
						<br>
						"Yes" ankreuzen
					</p>
					<h3>Bedienungsanleitung</h3> 
					<h4>Formular</h4>
					<p>
						Ortsformular einfügen mit [location_form ORTTYP]
						<br> z.B. [location_form handelsort]
						<br>-> siehe akzeptierte Formulartypen in der rechten Spalte
					</p>
					<h4>Frontend Ortseiten</h4>
					<p>
						Die Platzhalter in den Eventsmanger Einstellungen hinzufügen, um Orte mit den zusätzlichen Informationen im Frontend anzuzeigen.
						<br><br>
						Die Einstellung ist zu finden unter:
						<br>
						Events ->Settings ->Formatting ->Locations ->Single Location Page ->Single location page format
						<br>
						Dort an den gewünschten Stellen ein #_MND[TEIL] einsetzen
						<br> z.B. #_MNDDIV1
						<br>-> siehe Platzhalter rechte Spalte
					</p>
					<h4>Plugin Updates</h4>
					<p>
						Die alte Version muss manuell entfernt und danach die neue Version manuell hochgeladen werden.
					</p>
				</div>    
			</div> 
			<!-- end col-left --> 		
		</div> 
  	</div>
  	<?php
}








?>