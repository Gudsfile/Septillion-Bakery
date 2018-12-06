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
	$ret = check_str($string_to_check);
	if (strpos($string_to_check,"@") == false) $ret = false;
	if (strpos($string_to_check,".") == false) $ret = false;

	return $ret;
}

?>