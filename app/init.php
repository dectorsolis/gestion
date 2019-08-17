<?php 
	session_start();
	date_default_timezone_set ( "America/Mexico_City" );
	require_once("core/app.php");
	require_once("core/controller.php");
	require_once("core/Db.php");
	require_once("core/lib/functions.php");
	define("MAIN_ROOT", __DIR__);
	define("PATH", "/gestion/public/");
	define("CONTROLLERS",  __DIR__ . "/controllers/");
	define("MODELS", __DIR__ . "/models/");
	define("VIEWS", __DIR__ . "/views/");
	define("HELPERS", __DIR__ . "/helpers/");
	define("INCLUDES", __DIR__ . "/includes/");
	define("PHPMAILER", __DIR__ . "/phpmailer/PHPMailerAutoload.php");

?>