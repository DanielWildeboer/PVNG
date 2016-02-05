jQuery( document ).ready(function() {
  jQuery(".ov_nee_actie").hide();
  jQuery(".ov_ja_actie").hide();
  if(jQuery('#ov_ja_vraag').is(':checked'))
  {	  
	v1();
  }
  if(jQuery('#ov_ja_pagina').is(':checked'))
  {	  
	v2(); 
  }
  if(jQuery('#ov_nee_vraag').is(':checked'))
  {	  
	v3(); 
  }
  if(jQuery('#ov_nee_pagina').is(':checked'))
  {	  
	v4(); 
  }
});

function v1()
{
  jQuery(".ov_ja_actie").hide();
  jQuery("#ja_vraag").show();
}
function v2()
{
  jQuery(".ov_ja_actie").hide();
  jQuery("#ja_pagina").show();
}
function v3()
{
  jQuery(".ov_nee_actie").hide();
  jQuery("#nee_vraag").show();
}
function v4()
{
  jQuery(".ov_nee_actie").hide();
  jQuery("#nee_pagina").show();
}