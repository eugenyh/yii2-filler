<?php

/**
 * Filler class.
 **/
namespace frontend\components\helpers;

class Filler {

public static function searchin($key, $array)
{
       	$key = str_replace('[', '', $key);
       	$key = str_replace(']', '', $key);

    	if (is_array($array)) {
        	if (isset($array[$key])) {
	            return $array[$key];
    	    } else {
        		foreach ($array as $subarray) { //call it recursive
        			searchin($key, $subarray);
        		}
        	}	
    	} else {
       		return null;
    	}
}

public static function Fill($strtofill, $vararray) 
{


	$matches = null;
	//Search keys in square brackets in string
	//Example: 'some kind [this_is_key] of string' 
	$pattern = '/\[([^\]]*)\]/';
	//$pattern = '/\\[[^\\]]*\\]/';
	$result = $strtofill;

	if ($returnValue = preg_match_all($pattern, $strtofill, $matches)<>0) {
		//Have some vars
        foreach ($matches[0] as $keyname) {
        	$value = Filler::searchin($keyname, $vararray);
        	if (isset($value)) $result = str_replace($keyname, $value, $result);
        }
	};

	return $result;
}

}
?>
