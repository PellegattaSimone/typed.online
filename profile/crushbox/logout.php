<?php require_once 'defines.inc.php'?>
<?php

	try {
		$sql = "UPDATE `data` SET `crushbox`=NULL WHERE `id`=?";

		$stmt = $dbh->stmt_init();
		$stmt->prepare($sql);
		$stmt->bind_param("i", $_SESSION['id']);
		$stmt->execute();

		unset($_SESSION['expire'], $_SESSION['crush'], $_SESSION['date']);
		header("Location: ..");

	} catch (mysqli_sql_exception $exception) {

		$driver->logexc($exception);

		switch($exception->getTrace()[0]['function'])
		{
			case 'prepare':
				header('Location: .?crushbox=conn');
				break;
			default:
				header("Location: .?crushbox=unknown");
				break;
		}
	}
