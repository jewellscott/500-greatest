<?php 

function getData($fileName) {
	$path = "data/$fileName";
	if ( file_exists($path) ) {
		$json = file_get_contents($path);
		return json_decode($json, true);			
	} 
	return null;
}


