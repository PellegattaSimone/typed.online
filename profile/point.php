<?php require_once 'defines.inc.php'?>
<?php

	require_once 'head.inc.php';

	if(isset($_GET['user'], $_GET['redirect'], $_SESSION['id'], $_SESSION['username']))
	{
		$user = strtolower($_GET['user']);
		$date = date("Ymd", strtotime("+1 day", time()));
		$redirect = $_GET['redirect'] == "profile" ? "/profile" : '';

		if($user != $_user)
		{
			if($user == $_SESSION['username']['name'])
			{
				try {
					/*$sql = "UPDATE `accountlist` JOIN `data` ON `accountlist`.`id`=`data`.`id`
								SET `points` = `points` + (`user` = ?) * 20,
								`allow` = CASE WHEN `accountlist`.`id` = ?
											THEN ?
											ELSE `allow`
											END
								WHERE (SELECT `allow` FROM (SELECT `allow` FROM `data` WHERE `id` = ?) AS `temp`) < ?";*///temp

					$sql = "UPDATE `accountlist` JOIN `data` ON `accountlist`.`id`=`data`.`id`
								SET `points` = `points` +
								(`user` = ? AND
								(SELECT `allow` FROM (SELECT `allow` FROM `data` WHERE `id` = ?) AS `temp`) < ?) * 20,
								`allow` = CASE WHEN `data`.`id` = ?
											THEN ?
											ELSE `allow`
											END";

					$stmt = $dbh->stmt_init();
					$stmt->prepare($sql);
					$stmt->bind_param("sisis", $user, $_SESSION['id'], $date, $_SESSION['id'], $date);
					$stmt->execute();

					if($stmt->affected_rows)
						head("../".$user.$redirect, "success");
				 	else
						head("../".$user.$redirect, "time");

				} catch (mysqli_sql_exception $exception) {

					$driver->logexc($exception);

					switch($exception->getTrace()[0]['function'])
					{
						case 'prepare':
							head("../".$user.$redirect, "conn");
							break;
						default:
							head("../".$user.$redirect, "unknown");
							break;
					}
				}
			} else
				header("Location: " . HTTP . "?error=403");
		} else
			head("../".$user.$redirect, "self");
	} else
		header("Location: ..?error=404");
