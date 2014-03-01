//var konamicode = new KonamiCode(function(){alert("KONAMI COOOOODE!")});

jQuery(document).ready(function(){
	
	//On initial click, clear the field.
	//If nothing is entered, return the field to inital
	var formInit = "Search";
	$("#s").focus(function(){
		if($(this).val() == formInit)
			$(this).val("");
	});
	
	$("#s").blur(function(){
		if($(this).val() == "")
			$(this).val(formInit);
	});
});
