<?php require_once 'defines.inc.php'?>
<?php

	if(isset($_SESSION['instagram']) && (isset($_GET['login']) || isset($_GET['signup'])))
	{
		unset($_SESSION['instagram']);

		header("Location: ../".(isset($_GET['login']) ? "login" : "signup"));
	}
	else
		header("Location: ..");
