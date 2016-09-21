/* 
 * 
 * 
 * 
 */


$(document).ready(function()
{  
    $("#newmenu").click(function()
    {
        $("#newscreen").slideToggle("slow", function()
        {
           
        });
        $("#etapescreen").slideUp("slow", function()
        {
           
        });
    });
    
$("#etapeconclusion").click(function()
    {
        $("#etapescreen").slideToggle("slow", function()
        {
           
        });
        $("#newscreen").slideUp("slow", function()
        {
           
        });
    });
});