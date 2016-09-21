/* 
 * 
 * 
 * 
 */


$(document).ready(function()
{  
    $("#joinbuton").click(function()
    {
        $("#joinscreen").slideToggle("slow", function()
        {
           
        });
        $("#allscorescreen").slideUp("slow", function()
        {

        });
        $("#summaryscreen").slideUp("slow", function()
        {

        });
    });
    
    $("#scoresbutton").click(function()
    {
        $("#allscorescreen").slideToggle("slow", function()
        {

        });
        $("#joinscreen").slideUp("slow", function()
        {
           
        });
        $("#summaryscreen").slideUp("slow", function()
        {

        });
    });
    
    $("#summarybutton").click(function()
    {
        $("#summaryscreen").slideToggle("slow", function()
        {

        });
        $("#joinscreen").slideUp("slow", function()
        {
           
        });
        $("#allscorescreen").slideUp("slow", function()
        {

        });
    });
});