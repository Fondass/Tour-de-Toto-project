/* 
 * 
 * 
 * 
 */

$(document).ready(function()
{  
    $("#loginonmenu").click(function()
    {
        $("#loginscreen").slideToggle("slow", function()
        {
           
        });
        $("#registerscreen").slideUp("slow", function()
        {
           
        });
    });
    
    $("#registermenu").click(function()
    {
        $("#registerscreen").slideToggle("slow", function()
        {
           
        });
        $("#loginscreen").slideUp("slow", function()
        {
           
        });
    });
});