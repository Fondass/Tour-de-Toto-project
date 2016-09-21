/* class: javascript / ajax script
 * 
 * Works with: 
 * classes/pages/page.playerscores.php (script included)
 * 
 * classes/class.controller.ajax.php (controller)
 * classes/ajax/class.ajax.playerscores.php (model)
 * 
 * Javascript for ajax request
 */

$(document).ready(function()
{
    $("#scorecompsel").change(function() 
    {
        var number = $(this).val();
        $.ajax({ url: 'index.php',     // url of the script to be called server side
     data: {ajaxaction:'playerscores', competition:number},    // action that should be called in the controller      
        // type of data,
     type: 'post',  // is it a GET or a POST
     dataType:"json", 
     success: function(thing)    // Thing that should happen on succes with the data retrieved.
               {
                   $('#scoresreplaceme').replaceWith(thing);
                   $("#scoreslidescreen").slideDown(function()
                   {
                       
                   });
               },
        error: function()
            {
                $('#scoresreplaceme').text('No Data Avialable');
            }
        });
    });
});