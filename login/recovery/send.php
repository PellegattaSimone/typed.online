<?php require_once 'defines.inc.php'?>
<?php

	require_once 'head.inc.php';

	if(isset($_POST['check']))
	{
		if(!isset($_SESSION['spam']) || $_SESSION['spam'] < 3)
		{
			if(isset($_POST['email']) && !empty($_POST['email']))
			{
				$email = $_POST['email'];

				if(filter_var($email, FILTER_VALIDATE_EMAIL))
				{
					try {
						$sql = "SELECT NULL FROM `accountlist` WHERE `email`=?";
						$stmt = $dbh->stmt_init();

						$stmt->prepare($sql);
						$stmt->bind_param("s", $email);
						$stmt->execute();

						if($stmt->get_result()->num_rows)
						{
							include_once 'signup/password/spam.inc.php';

							$id = hash("crc32", random_bytes(rand(8, 32)));
							$token = 'r' . sha1(random_bytes(128));
							$hash = password_hash($token, PASSWORD_DEFAULT);
							$date = date("Y-m-d H:i:s", strtotime("+30 minute", time()));

							$token = $token . $id;

							$sql = "INSERT INTO `update`(`id`, `hash`, `email`, `expire`) VALUES (?, ?, ?, ?)";
							$stmt = $dbh->stmt_init();

							$stmt->prepare($sql);
							$stmt->bind_param("ssss", $id, $hash, $email, $date);
							$stmt->execute();

							require_once 'PHPMailer/config.inc.php';

							if(send($email, $body['recovery']['subject'], "<h1>{$body['recovery']['title']}!</h1><div style=\"font-size: 1rem;font-family: serif\"><p>{$body['recovery']['click']} <a href=\"".HTTP."signup/password/"."$token\">{$body['recovery']['here']}</a> {$body['recovery']['reset']}.</p><p>{$body['note']}.</p></div>",
							"{$body['recovery']['title']}!\n{$body['recovery']['click']} {$body['recovery']['here']} (".HTTP."signup/password/"."$token) {$body['recovery']['set']}.\n{$body['note']}."))
								header("Location: ../..?email");
							else
								header("Location: .?recovery=send");
						} else
							head(".?recovery=email", $email);

					} catch (mysqli_sql_exception $exception) {

						$driver->logexc($exception);

						switch($exception->getTrace()[0]['function'])
						{
							case 'prepare':
								header("Location: .?recovery=conn");
								break;
							default:
								header("Location: .?recovery=unknown");
								break;
						}
					}
				} else
					head(".?recovery=invalid", $email);
			} else
				header("Location: .?recovery=empty");
		} else
			header("Location: .?recovery=spam");
	} else
		head(".", false);
