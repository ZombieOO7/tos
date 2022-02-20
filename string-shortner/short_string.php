<?php
function string_short($string,$start_pos=0,$length_to_cut)
{
	$final_srting="";
	$string=trim(stripslashes(urldecode(strip_tags($string))));
	$str_len=strlen($string);
	if($str_len<=$length_to_cut)
	{
		$final_srting=$final_srting.substr($string,0,$str_len);
	}
	else
	{
		$final_srting=$final_srting.substr($string,0,$length_to_cut-3);
		$final_srting=$final_srting."...";
	}
	return $final_srting;
}
?>