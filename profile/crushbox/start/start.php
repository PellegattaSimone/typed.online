<?php require_once 'defines.inc.php'?>
<?php

	if(isset($_POST['check']))
	{
		require_once 'head.inc.php';

		if(isset($_POST['hide']))
			$pwd = 0;
		else {
			$pwd = $_POST['pwd'];

			if(!empty($pwd))
			{
				if(strlen($pwd) >= 4 && strlen($pwd) <= 255)
				{
					if($pwd === $_POST['pwd2'])
					{
						$pwd = password_hash($pwd, PASSWORD_DEFAULT);

					} else {
						header("Location: .?start=pwd");
						exit();
					}
				} else {
					header("Location: .?start=length");
					exit();
				}
			} else {
				header("Location: .?start=empty");
				exit();
			}
		}

		$date = date("Y-m-d H:i:s", strtotime("+{$_SESSION['expire']} minutes", time()));

		try {
			$sql = "UPDATE `data` SET `crushbox`=?, `crushpwd`=? WHERE `id`=?";

			$stmt = $dbh->stmt_init();
			$stmt->prepare($sql);
			$stmt->bind_param("ssi", $date, $pwd, $_SESSION['id']);
			$stmt->execute();

			unset($_SESSION['start']);
			header("Location: ..?crushbox=start");

		} catch (mysqli_sql_exception $exception) {

			$driver->logexc($exception);

			switch($exception->getTrace()[0]['function'])
			{
				case 'prepare':
					header("Location: .?start=conn");
					break;
				default:
					header("Location: .?start=unknown");
					break;
			}
		}
	} else
		header("Location: ../data.php");
