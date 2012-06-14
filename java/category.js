// JavaScript Document
function selectOption(object) {
	for(var i=1; i<=5; i++) {
    document.getElementById("option"+i).className = "option";
}
    var id = object.id;
    var divLink = document.getElementById(id);
    divLink.className = "optionSelect";
	document.forms['searchForm'].hidden.value=object.id;
}


function reload(form)
{
var val=form.issue.options[form.issue.options.selectedIndex].value;
self.location='index.php?issue=' + val ;
}