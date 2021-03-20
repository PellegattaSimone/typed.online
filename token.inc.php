<?php require_once 'defines.inc.php'?>
<?php

	if(basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]))
	{
		header("Location: " . HTTP . "?error=404");
		exit();
	}

	$token = sha1(random_bytes(64));
	$hash = hash_pbkdf2("sha512", $token, hash_pbkdf2("sha512", getenv("SALT"), 2048, 16), 2048, 64);
	$date = date("Y-m-d", strtotime("+30 day", time()));

	$sql = "UPDATE `accountlist` SET `hash`=?, `hashdate`=? WHERE `id`=?";

	$stmt = $dbh->stmt_init();
	$stmt->prepare($sql);
	$stmt->bind_param("ssi", $hash, $date, $row['id']);
	$stmt->execute();

	setcookie("id", $token, time()+2592000, '/');
