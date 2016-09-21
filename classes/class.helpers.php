<?php

/* Helper class that is intended to be used as a tooblox.
 * functions that see mutliple uses can be put here for ease of access
 * throughout the entire script. 
 * 
 * used primarily to make the rest of the scripts more easily readable. 
 * 
 * usage: functions that see usage through multipl scripts end up here.
 * 
 * author: Sybren Bos, Ian de Jong.
 */

class Helpers
{
    
    public function __construct()
    {
        
    }
    
//================================================
//            check request method
//================================================
/*
 * function that checks what request method is used
 * and returns the vallue of an element attached to
 * a Post[key] or a get[key], if one is set.
 */
//================================================ 
    
    public function checkRequestMethod($keyname, $defaultreturn = false)
    {
        if ($_SERVER["REQUEST_METHOD"]==="POST")
        {
            if (isset($_POST[$keyname]))
            {
                return $_POST[$keyname];
            }
            else
            {
                echo "notset".$keyname;
                return $defaultreturn;
            }
        }
        if ($_SERVER["REQUEST_METHOD"]==="GET")
        {
            if (isset($_GET[$keyname]))
            {
                return $_GET[$keyname];
            }
            else
            {
                return $defaultreturn;
            }
        }
        return $defaultreturn;
    }
      
//================================================
//                  spec chars
//================================================
/*
 * function that aplies html special chars
 * to a given string (used to slightly reduce 
 * complexity in other scripts.
 */
//================================================    
    
    public function specChars($string)
    {
        htmlspecialchars($string ,ENT_QUOTES, "UTF-8");
        return $string;
    }
    
//================================================
//                  has Duplicates
//================================================
/*
 * function that checks if an array has duplicates.
 * returns true if array has duplicates.
 * returns false if it does not have duplicates.
 */
//================================================ 
    
    
    public function hasDuplicates($array)
    {
        return count($array) !== count(array_unique($array));
    }
    
//================================================
//                  unique multi array
//================================================
/*
 * 
 */
//================================================
    
    public function uniqueMultiArray($array, $key)
    {
        $temp_array = array();
        $i = 0;
        $key_array = array();
        
        foreach ($array as $value)
        {
            if (!in_array($value[$key], $key_array))
            {
                $key_array[$i] = $value[$key];
                $temp_array[$i] = $value;
            }
            $i++;
        }
        return $temp_array;
    }
}
