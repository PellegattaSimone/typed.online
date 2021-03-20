<?php require_once 'defines.inc.php'?>
<?php

	if(basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]))
	{
		header("Location: " . HTTP . "?error=404");
		exit();
	}

	function head($url, $data=array())
	{
		$_SESSION['post'] = $data;

		header("Location: $url");
		exit();
	}
