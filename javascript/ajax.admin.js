/* class: javascript / ajax script
 * 
 * Works with: 
 * classes/pages/page.admin.php (script included)
 * 
 * classes/class.controller.ajax.php (controller)
 * classes/ajax/class.ajax.admin.php (model)
 * 
 * Javascript for ajax request
 */


$(document).ready(function()
{
    $("#selectcompetition").change(function() 
    {
        var compnumber = $(this).val();
        $.ajax({ url: 'index.php',     // url of the script to be called server side
     data: {ajaxaction:'roundincompetition', competitionid:compnumber},    // action that should be called in the controller      
        // type of data,
     type: 'post',  // is it a GET or a POST
     dataType:"json", 
     success: function(thing)    // Thing that should happen on succes with the data retrieved.
               {
                   $('#etapeselection').replaceWith(thing);
               }
        });
    });
});