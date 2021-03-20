<?php

	if(basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]))
	{
		header("Location: " . HTTP . "?error=404");
		exit();
	}

	function delete(&$dbh, &$id, &$user, &$email, &$tokendate, $source) {
		$sql = "UPDATE `accountlist` SET `instagram`=NULL, `token`=NULL, `tokendate`=NULL WHERE `id`=?";

		$stmt = $dbh->stmt_init();
		$stmt->prepare($sql);
		$stmt->bind_param("i", $id);
		$stmt->execute();

		$date = TODAY;
		$tokendate = date("Y-m-d", strtotime("-50 day", strtotime($tokendate)));
		$text = "$user\n$email\n$tokendate\n$date\n$source\n-----------------------\n";

		if($log = fopen(ROOT."instagram/deletions/".hash("crc32", $id).".txt", 'a'))
			if(fwrite($log, $text) && fclose($log))
				return true;

		trigger_error("Unable to log data deletion for $id: $user", E_USER_WARNING);
		return false;
	}
