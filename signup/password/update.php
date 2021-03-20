<?php require_once 'defines.inc.php'?>
<?php

	if(isset($_POST['check'], $_SESSION['data'], $_GET['token']))
	{
		if(!(empty($_POST['pwd']) || empty($_POST['pwd2'])))
		{
			if(strlen($_POST['pwd']) >= 8 && strlen($_POST['pwd']) <= 255)
			{
				if($_POST['pwd'] === $_POST['pwd2'])
				{
					$pwd = password_hash($_POST['pwd'], PASSWORD_DEFAULT);

					try {
						$sql = "UPDATE `accountlist` SET `password`=? WHERE `email`=?";

						$stmt = $dbh->stmt_init();
						$stmt->prepare($sql);
						$stmt->bind_param("ss", $pwd, $_SESSION['data']);
						$stmt->execute();

						include_once 'expired.inc.php';
						expired($dbh, $_SESSION['data']);

						unset($_SESSION['data']);
						header("Location: ".HTTP."login?recovery");
						
					} catch (mysqli_sql_exception $exception) {

						$driver->logexc($exception);

						switch($exception->getTrace()[0]['function'])
						{
							case 'prepare':
								header("Location: {$_GET['token']}?verify=conn");
								break;
							default:
								header("Location: {$_GET['token']}?verify=unknown");
								break;
						}
					}
				} else
					header("Location: {$_GET['token']}?verify=pwd");
			} else
				header("Location: {$_GET['token']}?verify=length");
		} else
			header("Location: {$_GET['token']}?verify=empty");
	} else {
		$_SESSION['check'] = true;
		header("Location: {$_GET['token']}");
	}
