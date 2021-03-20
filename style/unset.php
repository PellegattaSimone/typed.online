<?php require_once 'defines.inc.php'?>
<?php

	if($_SESSION['rgb'])
	{
		unset($_SESSION['rgb']);
		$_SESSION['theme'] = "light";
		setcookie("theme", "light", $time, '/');

		if(isset($_SESSION['id']))
		{
			try {
				$sql = "UPDATE `data` SET `rgb`=NULL WHERE `id`=".$_SESSION['id'];

				$stmt = $dbh->stmt_init();
				$stmt->prepare($sql);
				$stmt->execute();

			} catch (mysqli_sql_exception $exception) {

				$driver->logexc($exception);

				switch($exception->getTrace()[0]['function'])
				{
					case 'prepare':
						header("Location: .?style=conn");
						break;
					default:
						header("Location: .?style=unknown");
						break;
				}

				exit();
			}
		}

		header("Location: ..");
	} else {
		$_SESSION['check'] = true;
		header("Location: .");
	}
