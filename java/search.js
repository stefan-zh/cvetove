
/**
 * Redirects to the selected issue.
 */
function reload(form) {
   var index = form.issue.options.selectedIndex;
   var val = form.issue.options[index].value;
   self.location='index.php?issue=' + val ;
}

/**
 * Changes the selected option under the search bar.
 */
function selectOption(object) {
   document.getElementById("all-opt").className = "option";
   document.getElementById("journal-opt").className = "option";
   document.getElementById("poetry-opt").className = "option";
   document.getElementById("fiction-opt").className = "option";
   document.getElementById("art-opt").className = "option";
   object.className = "optionSelect";
	document.forms['searchForm'].hidden.value = object.id;
}