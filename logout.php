<?php require_once 'defines.inc.php'?>
<?php

	if(isset($_POST['check']))
	{
		if(isset($_COOKIE['id']))
		{
			setcookie("id", NULL, time(), '/');

			$sql = "UPDATE `accountlist` SET `hash`=NULL, `hashdate`=NULL WHERE `id`=?";

			$stmt = $dbh->stmt_init();
			$stmt->prepare($sql);
			$stmt->bind_param("i", $_SESSION['id']);
			$stmt->execute();
		}

		session_destroy();

		header("Location: .?logout");
	} else
		header("Location: .?error=404");
