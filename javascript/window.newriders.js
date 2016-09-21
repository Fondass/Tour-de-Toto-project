/* 
 * 
 * 
 * 
 */


$(document).ready(function()
{  
    $("#riders").click(function()
    {
        $("#riderscreen").slideToggle("slow", function()
        {
           
        });
        $("#teamscreen").slideUp("slow", function()
        {
           
        });
        $("#countryscreen").slideUp("slow", function()
        {
           
        });
    });
    
    $("#teams").click(function()
    {
        $("#teamscreen").slideToggle("slow", function()
        {
           
        });
        $("#countryscreen").slideUp("slow", function()
        {
           
        });
        $("#riderscreen").slideUp("slow", function()
        {
           
        });
    });
    
    $("#countries").click(function()
    {
        $("#countryscreen").slideToggle("slow", function()
        {
           
        });
        $("#teamscreen").slideUp("slow", function()
        {
           
        });
        $("#riderscreen").slideUp("slow", function()
        {
           
        });
    });
});