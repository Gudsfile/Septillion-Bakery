<?php

function check_str($string_to_check)
{
	$ret = true;
	if (strpos($string_to_check,"<")!== false) $ret = false;
	if (strpos($string_to_check,">")!== false) $ret = false;
	if (strpos($string_to_check,"%")!== false) $ret = false;
	if (strpos($string_to_check,"./")!== false) $ret = false;
	if (strpos($string_to_check,"../")!== false) $ret = false;
	if (strpos($string_to_check,"\\")!== false) $ret = false;
	if (strpos($string_to_check,";")!== false) $ret = false;

	return $ret;
}

function check_str_hard($string_to_check)
{
	$ret = true;
	$array = str_split($string_to_check);
	foreach ($array as $char) {
		// only digit and letter
		if (ord($char) < 48 || ord($char) > 122) {
			$ret = false;
		} else if (ord($char) > 57 && ord($char) < 65) {
			$ret = false;
		} else if (ord($char) > 90 && ord($char) < 97) {
			$ret = false;
		}
	}
	return $ret;
}

function check_str_number($string_to_check)
{
	$ret = true;
	foreach ($array as $char) {
		// only digit
		if (ord($char) < 48 || ord($char) > 57) {
			$ret = false;
		}
	}
	return $ret;
}

function check_str_letter($string_to_check)
{
	$ret = true;
	$array = str_split($string_to_check);
	foreach ($array as $char) {
		// only letter
		if (ord($char) < 65 || ord($char) > 122) {
			$ret = false;
		} else if (ord($char) > 90 && ord($char) < 97) {
			$ret = false;
		}
	}
	return $ret;
}

function check_str_img($string_to_check)
{
	$ret = false;
	if (strpos($string_to_check,".png")!== false) $ret = true;
	if (strpos($string_to_check,".jpg")!== false) $ret = true;
	if (strpos($string_to_check,".jpeg")!== false) $ret = true;
	if (strpos($string_to_check,".gif")!== false) $ret = true;
	if (strpos($string_to_check,".jfif")!== false) $ret = true;

	return $ret;
}

function check_str_mail($string_to_check)
{
	$ret = filter_var($string_to_check, FILTER_VALIDATE_EMAIL);
	return $ret;
}

?>
