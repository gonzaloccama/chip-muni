<?php

$user_agent = $_SERVER['HTTP_USER_AGENT'];

function getBrowser($user_agent)
{
	if (strpos($user_agent, 'MSIE') !== FALSE)
		return 'Internet explorer';
	elseif (strpos($user_agent, 'Edge') !== FALSE) //Microsoft Edge
		return 'Microsoft Edge';
	elseif (strpos($user_agent, 'Trident') !== FALSE) //IE 11
		return 'Internet explorer';
	elseif (strpos($user_agent, 'Opera Mini') !== FALSE)
		return "Opera Mini";
	elseif (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR') !== FALSE)
		return "Opera";
	elseif (strpos($user_agent, 'Firefox') !== FALSE)
		return 'Mozilla Firefox';
	elseif (strpos($user_agent, 'Chrome') !== FALSE)
		return 'Google Chrome';
	elseif (strpos($user_agent, 'Safari') !== FALSE)
		return "Safari";
	else
		return 'Navegador no detectado';

}

function getRealIP()
{

	if (isset($_SERVER["HTTP_CLIENT_IP"]))
	{
		return $_SERVER["HTTP_CLIENT_IP"];
	}
	elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
	{
		return $_SERVER["HTTP_X_FORWARDED_FOR"];
	}
	elseif (isset($_SERVER["HTTP_X_FORWARDED"]))
	{
		return $_SERVER["HTTP_X_FORWARDED"];
	}
	elseif (isset($_SERVER["HTTP_FORWARDED_FOR"]))
	{
		return $_SERVER["HTTP_FORWARDED_FOR"];
	}
	elseif (isset($_SERVER["HTTP_FORWARDED"]))
	{
		return $_SERVER["HTTP_FORWARDED"];
	}
	else
	{
		return $_SERVER["REMOTE_ADDR"];
	}

}

function get_ip_api($ip){
	return  json_decode(file_get_contents("http://ip-api.com/json/".$ip), true);
}

//date_default_timezone_set('America/Lima');
//
//$date_current = date("Y-m-d H:i:s");

$browser = getBrowser($user_agent);

$get_ip = get_ip_api(getRealIP());
//$get_ip = get_ip_api('181.176.165.69');

if ($get_ip['status'] != 'fail') {

	$api_country = $get_ip['country'];
	$api_regionName = $get_ip['regionName'];
	$api_city = $get_ip['city'];
	$api_lat = $get_ip['lat'];
	$api_lon = $get_ip['lon'];
	$api_timezone = $get_ip['timezone'];
	$api_isp = $get_ip['isp'];
	$api_query = $get_ip['query'];

	$sql_r_ = "INSERT INTO register_en 
				    		( 
				    		 dni_familia_f, 				    		  
				    		 fecha_register_en,
				    		 fecha_entrega_en,
				    		 country,
				    		 regionName,
				    		 city,
				    		 lat,
				    		 lon,
				    		 timezone,
				    		 isp,
				    		 query_,
				    		 browser) 
				    values 
				           ('$rel_id', 
				            '$date_current', 
				            '$date_current', 
				            '$api_country', 
				            '$api_regionName',
				            '$api_city',
				            '$api_lat',
				            '$api_lon',
				            '$api_timezone',
				            '$api_isp',
				            '$api_query',
				            '$browser')";
	$conn->query($sql_r_);
}else{
	$api_query = $get_ip['query'];
	$sql_r_ = "INSERT INTO register_en 
				    		( 
				    		 dni_familia_f, 				    		  
				    		 fecha_register_en,
				    		 fecha_entrega_en,
				    		 country,
				    		 regionName,
				    		 city,
				    		 lat,
				    		 lon,
				    		 timezone,
				    		 isp,
				    		 query_,
				    		 browser) 
				    values 
				           ('$rel_id', 
				            '$date_current', 
				            '$date_current', 
				            '', 
				            '',
				            '',
				            '',
				            '',
				            '',
				            '',
				            '$api_query',
				            '$browser')";
	$conn->query($sql_r_);
}



if (isset($_GET['chip']) && !empty($_GET['chip'])){
	$sql_chip_ = "
				INSERT INTO service_chip (dni_familia_f, numero_chip, plan, fecha_register, fecha_entrega) 
				VALUES ('$rel_id', '$chip', '$plan', '$date_current', '$date_current')";
	$conn->query($sql_chip_);
}

//echo getBrowser($user_agent);

