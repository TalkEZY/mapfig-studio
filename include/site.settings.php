<?PHP
	error_reporting(0);
	session_start();
	
	define("SUB_FOLDER", ""); // with tralling slash e.g: subfolder/
	
	$http_host = (($_SERVER['HTTPS'] == 'on') ? 'https://' : 'http://').$_SERVER['HTTP_HOST'].'/'.SUB_FOLDER;
	
	define("BASEURL",$http_host);
	define("APIURL",$http_host."api/");
	define("CDNURL","https://cdn.mapfig.com/mapfig-cdn/");
	
	define("COPYRIGHT_TEXT","Copyright @ ".date("Y")." MapFig, Inc. | MapFig, Ltd");
	
	define("SITE_NAME", "mapfig");
	define("SITE_NAME_FORMATED", "MapFig");
	define("MAIN_DOMAIN", "mapfig.com");
	define("HELP_URL", "http://help.mapfig.com");
?>