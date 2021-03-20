<?php require_once 'defines.inc.php'?>
<?php

	require_once 'head.inc.php';

	if(isset($_POST['check']))
	{
		$user = ucfirst(strtolower($_POST['user']));
		$email = strtolower($_POST['email']);

		$post = array('user'=>$user, 'email'=>$email);

		if(!isset($_SESSION['spam']) || $_SESSION['spam'] < 3)
		{
			if(!(empty($user) || empty($email)))
			{
				if(filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match('/^[A-Z][a-z0-9._]{2,29}$/', $user) && !in_array($user, HIDDEN))
				{
					try {
						$sql = "SELECT `user` FROM `accountlist` WHERE `user`=? OR `email`=?";

						$stmt = $dbh->stmt_init();
						$stmt->prepare($sql);
						$stmt->bind_param("ss", $user, $email);
						$stmt->execute();

						$result = $stmt->get_result();

						if(!$result->num_rows)
						{
							include_once 'password/spam.inc.php';

							$id = hash("crc32", random_bytes(rand(8, 32)));
							$token = 's' . sha1(random_bytes(128));
							$hash = password_hash($token, PASSWORD_DEFAULT);
							$token = $token . $id;

							$date = date("Y-m-d H:i:s", strtotime("+30 minute"));
							$instagram = isset($_SESSION['instagram']) ? $_SESSION['instagram'] : array('id'=>NULL, 'token'=>NULL);

							$sql = "INSERT INTO `update`(`id`, `hash`, `email`, `expire`, `user`, `instagram`, `token`, `point`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

							$stmt = $dbh->stmt_init();
							$stmt->prepare($sql);
							$stmt->bind_param("sssssisi", $id, $hash, $email, $date, $user, $instagram['id'], $instagram['token'], $_SESSION['point']);
							$stmt->execute();

							require_once 'PHPMailer/config.inc.php';

							if(send($email, $body['signup']['subject'], "<h1>{$body['signup']['title']}!</h1><div style=\"font-size: 1rem;font-family: serif\"><p>{$body['signup']['ready']}...</p><p>{$body['signup']['click']} <a href=\"".HTTP."signup/password/"."$token\">{$body['signup']['here']}</a> {$body['signup']['set']}.</p><p>{$body['note']}.</p></div>",
							"{$body['signup']['title']}!\n{$body['signup']['ready']}...\n{$body['signup']['click']} {$body['signup']['here']} (".HTTP."signup/password/"."$token) {$body['signup']['set']}.\n{$body['note']}."))
								header("Location: ..?email");
							else
								head(".?signup=send", $post);
						} else {
							$found = $result->fetch_assoc();

							if(isset($found['user']) && $found['user']==$user)
								head(".?signup=user", $post);
							else
								head(".?signup=email", $post);
						}

					} catch (mysqli_sql_exception $exception) {

						$driver->logexc($exception);

						switch($exception->getTrace()[0]['function'])
						{
							case 'prepare':
								head(".?signup=conn", $post);
								break;
							default:
								head(".?signup=unknown", $post);
								break;
						}
					}
				} elseif(!filter_var($email, FILTER_VALIDATE_EMAIL))
						head(".?signup=invalidemail", $post);
					else
						head(".?signup=invaliduser", $post);
			} elseif(empty($user))
					head(".?signup=userempty", $post);
				else
					head(".?signup=emailempty", $post);
		} else
			head(".?signup=spam", $post);
	} else
		head(".", false);
