<?php require_once 'defines.inc.php'?>
<?php

	if(isset($_POST['check'], $_SESSION['login']))
	{
		require_once 'head.inc.php';

		$pwd = $_POST['pwd'];

		if(!empty($pwd))
		{
			if(password_verify($pwd, $_SESSION['login']))
			{
				$date = date("Y-m-d H:i:s", strtotime("+{$_SESSION['expire']} minutes", time()));

				try {
					$sql = "UPDATE `data` SET `crushbox`=? WHERE `id`=?";

					$stmt = $dbh->stmt_init();
					$stmt->prepare($sql);
					$stmt->bind_param("si", $date, $_SESSION['id']);
					$stmt->execute();

					unset($_SESSION['login']);
					header("Location: ..?crushbox=login");

				} catch (mysqli_sql_exception $exception) {

					$driver->logexc($exception);

					switch($exception->getTrace()[0]['function'])
					{
						case 'prepare':
							header("Location: .?crushbox=conn");
							break;
						default:
							header("Location: .?crushbox=unknown");
							break;
					}
				}
			} else
				header("Location: .?crushbox=pwd");
		} else
			header("Location: .?crushbox=empty");
	} else
		header("Location: ../data.php");
