function mysql_search(searchForm, url_root)
{
	if (searchForm.words.value == '')
	{
		return false;
	}
	
	switch(searchForm.hidden.value)
	{
	    case 'option1':
			// common search
			document.location.href = url_root+"search.php?cat=all&string="+searchForm.words.value;	    
	    break;
	    
		case 'option2':
			document.location.href = url_root+"search.php?cat=journal&string="+searchForm.words.value;
		break
		
		// news
		case 'option3':
			document.location.href = url_root+"search.php?cat=poetry&string="+searchForm.words.value;
	    break

		// ai
		case 'option4':
			document.location.href = url_root+"search.php?cat=fiction&string="+searchForm.words.value;
	    break
	    
		// podcast
		case 'option5':
			document.location.href = url_root+"search.php?cat=art&string="+searchForm.words.value;
	    break

	    
		default:
			// common search
			document.location.href = url_root+"common_search.php?cat=all&string="+searchForm.words.value;
		
	}	
	
	return false;
}

function search_selection(lnk)
{
	document.getElementById('option2').className = "";
	document.getElementById('option3').className = "";
	document.getElementById('option4').className = "";
	//document.getElementById('s_podcast').className = "";
	document.getElementById('option1').className = "";
	
	lnk.className = "selected";
	
	document.forms['searchForm'].hidden.value=lnk.id;
	
	return false;
}