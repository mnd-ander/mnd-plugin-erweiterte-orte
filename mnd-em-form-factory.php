<?php
function mnd_em_loc_radioset_tr($th_text, $radioset, $br_offset, $post_name, $mndzeug_key, $editing, $cur_user_can, $required)
{
	global $EM_Location;
	?>
	<tr class="em-location-data-address">
		<th><?php echo $th_text; ?></th>
		<td>
			<?php
			mnd_em_loc_radioset($radioset, $br_offset, $post_name, $mndzeug_key, $editing, $cur_user_can, $required);
			?>
		</td>
	</tr>
	<?php
}
function mnd_em_loc_radioset($radioset, $br_offset, $post_name, $mndzeug_key, $editing, $cur_user_can, $required)
{
	global $EM_Location;
	$counting = $br_offset + 1;
	
	foreach( $radioset as $radiopart )
	{
		?>
		<input type="radio" 
				id="<?php echo $post_name.$radiopart; ?>" 
				name="<?php echo $post_name; ?>" 
				value="<?php echo $radiopart; ?>" 
				<?php if( $required ) { ?> required <?php } ?>
				<?php if($editing && $EM_Location->mndzeug[$mndzeug_key] == $radiopart) { ?> checked <?php } ?>
				<?php if( !$cur_user_can ) { ?> disabled <?php } ?>
				/>
		<label for="<?php echo $post_name.$radiopart; ?>"><?php echo $radiopart; ?></label>
		
		<?php 
		//linebreak nach jedem x-ten
		if( $counting++ % $br_offset == 0 )
		{
			?><br/><?php
		}
	}
}



function mnd_em_loc_date_tr($th_text, $post_name, $mndzeug_key, $editing, $cur_user_can, $required)
{
	global $EM_Location;
	?>
	<tr class="em-location-data-address">
		<th><?php echo $th_text; ?></th>
		<td>
			<input 	type="date" 
					name="<?php echo $post_name; ?>" 
					id="<?php echo $post_name; ?>" 
					<?php if( $required ) { ?> required <?php } ?>
					<?php if($editing) { ?> value="<?php echo $EM_Location->mndzeug[$mndzeug_key]; ?>" <?php } ?>
					<?php if( !$cur_user_can ) { ?> disabled <?php } ?>
				/> 
		</td>
	</tr>
	<?php
}

function mnd_em_loc_textarea_tr($th_text, $rows, $cols, $maxlength, $post_name, $mndzeug_key, $editing, $cur_user_can, $required, $placeholder = "")
{
	global $EM_Location;
	?>
	<tr class="em-location-data-address">
		<th><?php echo $th_text; ?></th>
		<td>
			<textarea 	name="<?php echo $post_name; ?>" 
						id="<?php echo $post_name; ?>" 
						rows="<?php echo $rows; ?>" 
						cols="<?php echo $cols; ?>" 
						maxlength="<?php echo $maxlength; ?>"
						placeholder="<?php echo $placeholder; ?>"
						wrap="hard"
						<?php if( $required ) { ?> required <?php } ?>
						<?php if( !$cur_user_can ) { ?> disabled <?php } ?>
			   ><?php if($editing) { echo $EM_Location->mndzeug[$mndzeug_key]; } ?></textarea>
		</td>
	</tr>
	<?php
}

function mnd_em_loc_number_tr($th_text, $min, $step, $post_name, $mndzeug_key, $editing, $cur_user_can, $required)
{
	global $EM_Location;
	?>
	<tr class="em-location-data-address">
		<th><?php echo $th_text; ?></th>
		<td>
			<input 	type="number" 
					min="<?php echo $min; ?>"
					step="<?php echo $step; ?>"
					name="<?php echo $post_name; ?>" 
					id="<?php echo $post_name; ?>" 
					<?php if($editing) { ?> value="<?php echo $EM_Location->mndzeug[$mndzeug_key]; ?>" <?php } ?>
					<?php if( !$cur_user_can ) { ?> disabled <?php } ?>
					<?php if( $required ) { ?> required <?php } ?>
			/> 
		</td>
	</tr>
	<?php
}


function mnd_em_loc_textfeld_tr($th_text, $post_name, $mndzeug_key, $editing, $cur_user_can, $required, $placeholder = "")
{
	global $EM_Location;
	?>
	<tr class="em-location-data-address">
		<th><?php echo $th_text; ?></th>
		<td>
			<input 	type="text" 
					name="<?php echo $post_name; ?>" 
					id="<?php echo $post_name; ?>" 
					placeholder="<?php echo $placeholder; ?>"
					<?php if( $required ) { ?> required <?php } ?>
					<?php if($editing) { ?> value="<?php echo $EM_Location->mndzeug[$mndzeug_key]; ?>" <?php } ?>
					<?php if( !$cur_user_can ) { ?> disabled <?php } ?>
			/> 
		</td>
	</tr>
	<?php
}




function mnd_em_loc_checkboxset($checkbox_array, $post_array_name, $id_prefix, $mndzeug_key, $editing, $cur_user_can)
{
	global $EM_Location;
	//cur_user_can zb current_user_can(edit-locations)
	//post_array_name zb 'div1[]'
	foreach( $checkbox_array as $checkbox_id => $checkbox )
	{
		?>
		<input 	type="checkbox" 
				name="<?php echo $post_array_name; ?>" 
				id="<?php echo $id_prefix.$checkbox_id; ?>"
				value="<?php echo $checkbox; ?>" 
				<?php if( $editing && in_array($checkbox, $EM_Location->mndzeug[$mndzeug_key]) ) { ?> checked <?php	} ?>
				<?php if( !$cur_user_can ) { ?> disabled <?php } ?>
			/>
		<label for="<?php echo $id_prefix.$checkbox_id; ?>">
		<?php echo $checkbox; ?>
		</label>
		
		<br />
		<?php
	}
}
function mnd_em_loc_checkboxset_multiclick($checkbox_array, $post_array_name, $id_prefix, $mndzeug_key, $editing, $cur_user_can)
{
	global $EM_Location;
	
	$str_source = $id_prefix."0";
	$str_targets = array();
	for($i = 1; $i < count($checkbox_array); $i++)
	{
		$str_targets[] = $id_prefix.$i;
	}
	
	for($i = 0; $i < count($checkbox_array); $i++)
	{
		?>
		<input 	type='checkbox' 
				<?php if($i != 0) { ?> style='margin-left:35px' <?php } ?>
				<?php if($i == 0) { ?> onClick='toggle_die_boxen("<?php echo($str_source); ?>", <?php echo(json_encode($str_targets)); ?>)' <?php } ?>
				name="<?php echo $post_array_name; ?>" 
				id="<?php echo $id_prefix.$i; ?>"
				value="<?php echo $checkbox_array[$i]; ?>" 
				<?php if( $editing && in_array($checkbox_array[$i], $EM_Location->mndzeug[$mndzeug_key]) ) { ?> checked <?php } ?>
				<?php if( !$cur_user_can ) { ?> disabled <?php } ?>
			/>
		<label for="<?php echo $id_prefix.$i; ?>">
		<?php echo $checkbox_array[$i]; ?>
		</label>
		
		<br />
		<?php
	}
}

function mnd_em_loc_oeffnungstage_checkboxset($post_array_name, $mndzeug_key, $editing, $cur_user_can)
{
	global $EM_Location;
	//cur_user_can zb current_user_can(edit-locations)
	//post_array_name zb 'div1[]'
	$wochentage = array
	(
		'Mo','Di','Mi','Do','Fr','Sa','So'
	);
	for($i = 0; $i < 7; $i++)
	{
		?>
		<input 	type="checkbox" 
				name="<?php echo $post_array_name; ?>" 
				id="<?php echo $mndzeug_key.$i; ?>"
				value="<?php echo $wochentage[$i]; ?>" 
				<?php 
				if( ($editing && in_array($wochentage[$i], $EM_Location->mndzeug[$mndzeug_key]))
					|| (!$editing && $i < 5) )
				{
					?> checked <?php 
				}
				if( !$cur_user_can )
				{
					?> disabled <?php 
				} 
				?>
			/> 
			
		<label for="<?php echo $mndzeug_key.$i; ?>">
		<?php echo $wochentage[$i]; ?>
		</label>
		
		<br />
		<?php
	}
}
function mnd_em_loc_oeffnungstage_checkboxset_tr($th_text, $post_array_name, $mndzeug_key, $editing, $cur_user_can)
{
	global $EM_Location;
	
	?>
	<tr class="em-location-data-address">
		<th><?php echo $th_text; ?></th>
		<td>
		<?php
		mnd_em_loc_oeffnungstage_checkboxset($post_array_name, $mndzeug_key, $editing, $cur_user_can);
		?>
		</td>
	</tr>
	<?php
}



?>