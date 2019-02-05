function toggle_die_boxen(source, targets)
{
	var target_state = (document.getElementById(source)).checked;
	for(var checkbox in targets)
	{
		(document.getElementById(checkbox)).checked = target_state;
	}
}