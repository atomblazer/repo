<?php
function convert_date($date_input, $into = 'out_db')
{
	if($into == "out_db") 
	{
		return date('m/d/Y', strtotime($date_input)); 
	}	
	if($into == "out_db_time") 
	{
		return date('m/d/Y H:i', strtotime($date_input)); 
	}	
	
}




?>