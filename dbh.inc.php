<?php require_once 'defines.inc.php'?>
<?php

	if(basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]))
	{
		header("Location: " . HTTP . "?error=404");
		exit();
	}

	if($_SERVER["SERVER_NAME"] == "localhost" || strpos($_SERVER["SERVER_NAME"], "192.168") !== false)
	{
		$dbHostname = "localhost";
		$dbUsername = "root";
		$dbPassword = "";
		$dbName = "_typed";

	} else {
		$dbHostname = "sql306.epizy.com";
		$dbUsername = "epiz_25381446";
		$dbPassword = "wp6zbarQrD";
		$dbName = "epiz_25381446_typed";
	}

	$retry = 0;

	while(true) {
		try {
			mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
			$dbh = new mysqli($dbHostname, $dbUsername, $dbPassword, $dbName);

			if($retry)
				trigger_error("Mysqli failed $retry times:", E_USER_NOTICE);
			break;
		}
		catch (mysqli_sql_exception $exception)
		{
			if($retry++ == 3)
				throw $exception;
		}
	}
