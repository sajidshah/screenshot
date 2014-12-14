<?php

if(! function_exists('curPageName'))
{
	function curPageName() {
 		return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
	}
}

if(! function_exists('getEncryptedPassword'))
{
	function getEncryptedPassword($password)
	{
		return md5($password.AUTH_SALT);
	}
}

if(! function_exists('getEncryptedUserSession'))
{
	function getEncryptedUserSession($userPacket)
	{
		 //this will create a unique session for each user, which will be validated before user can perform any action. This is security check.. 
		//CustomerPacket is combination of customerId.customerEmail.customerPassword
		//we will include AUTH_SALT at the end, this will add extra security and thn we will encrypt the whole string with MD5.
		//echo md5($customerPacket.AUTH_SALT);
		return md5($userPacket.AUTH_SALT); 
	}
}

if(! function_exists('getUniqueString'))
{
	function getUniqueString()
	{
		return md5(date("dmY".time()).AUTH_SALT);
	}
}

if(! function_exists('genRandomString'))
{
	function genRandomString() {
	    $length = 10;
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUBWXYZ';
	    $string="";
		for($p = 0; $p < $length; $p++) {
	        $string .= $characters[mt_rand(0, strlen($characters))];
	    }
	    return $string;
	}
}

if(! function_exists('mySQLDate'))
{
	function mySQLDate($date)
	{
		if($date!='00-00-0000') return date("Y-m-d", strtotime($date));
	}
}

if(! function_exists('my_print'))
{
	function myprint($data,$flag=TRUE)
	{
		echo "<pre>";
		print_r($data);
		echo "</pre>";
		if($flag) die;
	}
}


?>