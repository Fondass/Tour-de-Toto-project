/* class: javascript script
 * 
 * Works with: 
 * classes/pages/page.users.php (script included)
 * 
 * stores the value of selected competition name in a hidden field.
 */


$(document).ready(function() 
{
   $(".rankingscompetitionselect").change(function()
   {
       var text2 = $(this).children("option").filter(":selected").text();
       $(".varcompname").val(text2);
   });
});