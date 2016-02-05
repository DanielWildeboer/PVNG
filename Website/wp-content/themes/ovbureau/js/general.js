function createDiv(){
    var bodytag = document.getElementsByTagName('body')[0];
    var div = document.createElement('div');
    div.setAttribute('id','cookie-banner');
    div.innerHTML = '<p">Deze website gebruikt cookies. Wanneer u doorgaat accepteert u het gebruik van deze cookies. Klik <a href="/neplink/">hier</a> voor meer informatie. &nbsp;&nbsp;&nbsp;<button class="close-cookie-banner" href="javascript:void(0);" onclick="removeBanner();">Doorgaan</button></p>';    
    bodytag.appendChild(div,bodytag.firstChild);
    createCookie('banner','gezien', '7'); // Create the cookie
}

function createCookie(name,value,days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000)); 
        var expires = "; expires="+date.toGMTString(); 
    }
    else var expires = "";
    document.cookie = name+"="+value+expires+"; path=/"; 
}
 
function checkCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}
function eraseCookie(name) {
    createCookie(name,"",-1);
}
 
window.onload = function(){
    if(checkCookie('banner') != 'gezien'){
        createDiv(); 
    }
}
 
function removeBanner(){
	//var element = document.getElementById('cookie-banner');
	jQuery('#cookie-banner').fadeOut("normal", function() { jQuery(this).remove(); } );
	//element.parentNode.removeChild(element);
}

jQuery( document ).ready(function() 
{
	//hoofdmenu tweedemenu toggle
	jQuery(".tweedeMenuContainer").hide();
	jQuery( ".openTweedeMenu" ).click(function() 
	{
		toggleTweedeMenu();
	});

	if(jQuery(".splash").is(":visible"))
	{
		jQuery(".wrapper").css({"opacity":"0"});
		jQuery(".navbar").css({"opacity":"0"});
		jQuery("#sidebar").css({"opacity":"0"});
		jQuery(".footer").css({"opacity":"0"});
	}
	jQuery(".splash-arrow").click(function()
	{
		jQuery(".splash").fadeOut("800", function() {
			  jQuery(".wrapper").animate({"opacity":"1.0"},800);
			  window.location.href = "http://inf2h.serverict.nl/";
		 });
	});
});

jQuery(window).scroll(function() {
  	  jQuery(window).off("scroll");
	  jQuery(".splash").fadeOut("800", function() {
	  jQuery("html, body").animate({"scrollTop":"0px"},100);
	  jQuery(".wrapper").animate({"opacity":"1.0"},800);
	  window.location.href = "http://inf2h.serverict.nl/";
 });
 });
 
 //header fontsize en contrast popovers
 //jQuery('.hoofdContrastToggle').popover();
 //jQuery('.hoofdFontToggle').popover();
jQuery(function () 
{
	jQuery('[data-toggle="popover"]').popover()
}) ;
 // 2de header menu
function toggleTweedeMenu()
{
	if(jQuery(".tweedeMenuContainer").is(":visible"))
	{
		jQuery(".tweedeMenuContainer").hide();
		jQuery("#hoofdMenuContainer").css( "padding-bottom", "10px" );
	}
	else
	{
		jQuery(".tweedeMenuContainer").show();
		jQuery("#hoofdMenuContainer").css( "padding-bottom", "0px" );
	}
}