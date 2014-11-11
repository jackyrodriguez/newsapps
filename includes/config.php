<?php
/*
*	Environment status
* true = Local or Dev environment
* false = Production environment
*/

$development = true;

if($development) {
	//error_reporting(E_ALL);

	define('DB_HOST',			'localhost' );
	define('DB_USER',			'root' );
	define('DB_PASSWD',		'' );
	define('DB_NAME',			'newsapp' );
	define('DB_TABLE_PREFIX',	'' );

} else {
	//error_reporting(E_WARNING);
	//error_reporting(E_ERROR | E_WARNING | E_PARSE);

	define('DB_HOST',			'localhost' );
	define('DB_USER',			'' );
	define('DB_PASSWD',		'' );
	define('DB_NAME',			'' );
	define('DB_TABLE_PREFIX',	'' );
}

$now = new DateTime(null, new DateTimeZone('Asia/Manila'));
if( ! ini_get('date.timezone') )
{
   date_default_timezone_set('Asia/Manila');
}

define('PAGE_TITLE','Test Site');
session_start();
?>