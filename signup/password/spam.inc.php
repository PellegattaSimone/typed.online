<?php

	if(basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]))
	{
		header("Location: " . HTTP . "?error=404");
		exit();
	}

	$sql = "SELECT `expire` FROM `update` WHERE `email`=?";
	$stmt = $dbh->stmt_init();

	$stmt->prepare($sql);
	$stmt->bind_param("s", $email);
	$stmt->execute();

	$result = $stmt->get_result();

	if($result->num_rows)
	{
		if(strtotime($result->fetch_assoc()['expire']) < time())
		{
			include_once 'expired.inc.php';
			expired($dbh, $email);
		}
		elseif(isset($_SESSION['spam']))
			$_SESSION['spam']++;
		else
			$_SESSION['spam'] = 1;
	}
