function getSelectedOptionsText(object){
	selected = new Array();
	for (var i = 0; i < object.options.length; i++)
		if (object.options[i].selected)
			selected.push(object.options[i].text);
	return selected;
}

function previewSelectedOptionsText(object, preview){
	selected = getSelectedOptionsText(object);
	label = "";
	for (var i = 0; i < selected.length; i++)
		label += "<input type = 'checkbox' disabled checked/>" + selected[i] + "<br/>";
	document.getElementById(preview.id).innerHTML = label;
}