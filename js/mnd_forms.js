function toggle_die_boxen(source, targets)
{
	var source_checkbox = document.getElementById(source);
	for(var i=0, n=targets.length; i < n; i++) 
	{
		var target_checkbox = document.getElementById(targets[i]);
		target_checkbox.checked = source_checkbox.checked;
	}
}