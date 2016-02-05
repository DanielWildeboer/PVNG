$('.toggle').click(function()
{           
    if($('.menu').is(':hidden')) 
    {
        $('.menu').show('slide',{direction:'right'}, 1000);
    } 
    else 
    {
        $('.menu').hide('slide',{direction:'right'}, 1000);
    }
});

