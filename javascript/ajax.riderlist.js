/* class: javascript / ajax script
 * 
 * Works with: 
 * classes/pages/page.riderlist.php (script included)
 * 
 * classes/class.controller.ajax.php (controller)
 * classes/ajax/class.ajax.riderlist.php (model)
 * 
 * Javascript for ajax request
 */


$(document).ready(function()
{
    for (i = 1; i < 26; i++)
    {
        $("#rider"+i).change(function() 
        {
            var number = $(this).find('option:selected').attr('ajaxdata');
            var rider = $(this).children("option").filter(":selected").val();
            $.ajax({ url: 'index.php',     // url of the script to be called server side
         data: {ajaxaction:'selection', select:rider},    // action that should be called in the controller      
            // type of data,
         type: 'post',              // is it a GET or a POST
         dataType:"json",
         success: function(thing)    // Thing that should happen on succes with the data retrieved.
                   {
                       $("#sel-t"+number).text(thing[0]);
                       $("#sel-c"+number).text(thing[1]);
                   }
            });
        });
    }
});