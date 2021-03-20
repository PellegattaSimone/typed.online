<?php require_once 'defines.inc.php'?>
<?php

	if(basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]))
	{
		header("Location: " . HTTP . "?error=404");
		exit();
	}

	function expired(&$dbh, $email) {
		$sql = "DELETE FROM `update` WHERE `email`=?";
		
		$stmt = $dbh->stmt_init();
		$stmt->prepare($sql);
		$stmt->bind_param("s", $email);
		$stmt->execute();

		unset($_SESSION['spam']);
	}
