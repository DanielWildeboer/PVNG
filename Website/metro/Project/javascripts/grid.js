document.addEventListener('DOMContentLoaded', function()
{
    function addStation()
    {
        jQuery.ajax(
        {
            url: "insertStation.php?halte=" + jQuery('#halte').val() + "&type=" + jQuery('.input:checked').val()
        })
        .done(function(data) 
        {
            jQuery(".add_station").dialog("close");
            for(i = 0; i < data.errors.length; i++)
            {
                alert(data.errors[i]);
            }
        });
    };
    
    jQuery(".add_station").dialog(
    {
        autoOpen: false,
        modal: true,
        height: 500,
        width: 400,
        show: 
        {
            effect: "fade",
            duration: 1000        
        },
        hide:
        {
            effect: "fade",
            duration: 1000  
        },
        buttons: 
        {
            "Voeg de halte toe": addStation,
            Cancel: function() 
            {
                $(".add_station").dialog("close");
            }
        },
        close: function() 
        {
            $(".add_station").dialog("close");
        }
    });
    
    var tds = document.getElementsByTagName('td');

    for (var i = 0; i< tds.length; i++)
    {
            tds[i].addEventListener('click', (function(i, event)
            {   
                    tds[i].style.backgroundColor = "white";
                    jQuery(".add_station").dialog("open");
            }).bind(window, i));
    }
});