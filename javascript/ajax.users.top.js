/* class: javascript / ajax script
 * 
 * Works with: 
 * classes/pages/page.riders.php (script included)
 * classes/pages/page.teams.php (script included)
 * classes/pages/page.countries.php (script included)
 * 
 * classes/class.controller.ajax.php (controller)
 * classes/ajax/class.ajax.users.top.php (model)
 * 
 * Javascript for ajax request
 */

$(document).ready(function()
{
    $("#top10compsel").change(function() 
    {
        var number = $(this).val();
        $.ajax({ url: 'index.php',     // url of the script to be called server side
     data: {ajaxaction:'top10', competition:number},    // action that should be called in the controller      
        // type of data,
     type: 'post',  // is it a GET or a POST
     dataType:"json", 
     success: function(thing)    // Thing that should happen on succes with the data retrieved.
               {
                   $('#top10replaceme').replaceWith(thing);
                   $("#topreplacescreen").slideDown(function()
                   {
                       
                   });
               }
        });
    });
    
    $("#top5compsel").change(function() 
    {
        var number = $(this).val();
        $.ajax({ url: 'index.php',     // url of the script to be called server side
     data: {ajaxaction:'top5', competition:number},    // action that should be called in the controller      
        // type of data,
     type: 'post',  // is it a GET or a POST
     dataType:"json", 
     success: function(thing)    // Thing that should happen on succes with the data retrieved.
               {
                   $('#top5replaceme').replaceWith(thing);
                   $("#topreplacescreen").slideDown(function()
                   {
                       
                   });
               }
        });
    });
    
    $("#top3compsel").change(function() 
    {
        var number = $(this).val();
        $.ajax({ url: 'index.php',     // url of the script to be called server side
     data: {ajaxaction:'top3', competition:number},    // action that should be called in the controller      
        // type of data,
     type: 'post',  // is it a GET or a POST
     dataType:"json", 
     success: function(thing)    // Thing that should happen on succes with the data retrieved.
               {
                   $('#top3replaceme').replaceWith(thing);
                   $("#topreplacescreen").slideDown(function()
                   {
                       
                   });
               }
        });
    });
});