<?php require_once 'defines.inc.php'?>
<?php

	if(isset($_GET['token']))
	{
		$id = substr($_GET['token'], 41);

		try {
			$sql = "SELECT `hash`, `email`, `expire`, `userid` FROM `update` WHERE `id`=?";

			$stmt = $dbh->stmt_init();
			$stmt->prepare($sql);
			$stmt->bind_param("s", $id);
			$stmt->execute();

			$row = $stmt->get_result()->fetch_assoc();

			if($row !== NULL && password_verify(substr($_GET['token'], 0, 41), $row['hash']))
			{
				include_once 'signup/password/expired.inc.php';
				expired($dbh, $row['email']);

				if(strtotime($row['expire']) > time())
				{
					$email = $row['email'];
					$sql = "UPDATE `accountlist` SET `email`='$email' WHERE `id`=".$row['userid'];

					$stmt = $dbh->stmt_init();
					$stmt->prepare($sql);
					$stmt->execute();

					header("Location: .?email=success");
				} else
					header("Location: .?email=expired");
			} else
				header("Location: .?email=link");

		} catch (mysqli_sql_exception $exception) {

			$driver->logexc($exception);

			switch($exception->getTrace()[0]['function'])
			{
				case 'prepare':
					header("Location: .?email=conn");
					break;
				default:
					header("Location: .?email=unknown");
					break;
			}
		}
	} else {
		$_SESSION['check'] = true;
		header("Location: .");
	}
