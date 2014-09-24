jQuery(function() {
    if (window.PIE) {
	jQuery('#main_pg_container').each(function(){PIE.attach(this);});
 	jQuery('.menu_outer nav ul li a').each(function(){PIE.attach(this);});
  	jQuery('.menu_outer nav ul li:last-child a').each(function(){PIE.attach(this);});
    jQuery('.update_button').each(function(){PIE.attach(this);});
    }
});


jQuery(document).ready(function(){
	jQuery('input[type="text"], textarea').each(function(){    
	var default_value = jQuery(this).val();        
	jQuery(this).focus(function() {
		if(jQuery(this).val() == default_value)
		{
			 jQuery(this).val("");
		}
	}).blur(function(){
		if(jQuery(this).val().length == 0) /*Small update*/
		{
			jQuery(this).val(default_value);
		}
	});
});
});