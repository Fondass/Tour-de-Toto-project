/* class: javascript / ajax script
 * 
 * Works with: 
 * classes/pages/page.etape.php (script included)
 * 
 * classes/class.controller.ajax.php (controller)
 * classes/ajax/class.ajax.etape.php (model)
 * 
 * Javascript for ajax request
 */

$(document).ready(function()
{
    number = 10;
    
    $("#addanother").click(function()
    {
        number++;
        var competition = $("#competitionselected").val();
        var etape = $("#etaperound").val();
        $.ajax({ url: 'index.php',     // url of the script to be called server side
     data: {ajaxaction:'addetapewinner', winnercount:number, competitionselected:competition, etaperound:etape},    // action that should be called in the controller      
        // type of data,
     type: 'post',  // is it a GET or a POST
     dataType:"json", 
     success: function(thing)    // Thing that should happen on succes with the data retrieved.
               {
                   $('#replacemep').append(thing);
               },
      error: function()
               {
                   alert("lol");
               }
        });
    });
});
