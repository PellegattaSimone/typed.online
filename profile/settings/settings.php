<?php require_once 'defines.inc.php'?>
<?php

	$url = ".?";

	if(isset($_POST['check']))
	{
		$id = $_SESSION['id'];
		$post = array();

		if(isset($_POST['remove']))
		{
			//remove
			if(glob(ROOT."avatars/".substr(md5($id), 10, 12).".*"))
				if(unlink(glob(ROOT."avatars/".substr(md5($id), 10, 12).".*")[0]))
					$url .= "remove=success&";
				else
					$url .= "remove=error&";
			else
				$url .= "remove=empty&";
		}
		elseif(isset($_FILES['avatar'])) {
			//avatar
			$file = $_FILES['avatar'];

			if(!empty($file['name']))
				if($file['error'] === 0)
				{
					$file['tmp_name'];

					$extension = explode('/', $file['type']);
					if($extension[0] == "image")
					{
						if($file['size'] > 3 * 1024 && $file['size'] < 2 * 1024 * 1024)
						{
							foreach(glob(ROOT."avatars/".substr(md5($id), 10, 12).".*") as $old)
								unlink($old);

							move_uploaded_file($file['tmp_name'], ROOT."avatars/".substr(md5($id), 10, 12).'.'.strtok(end($extension), '+'));

							$url .= "file=success&";
						} else
							$url .= "file=size&";
					} else
						$url .= "file=$extension[0]&";
				} else
					$url .= "file=error&";
		}

		//user
		if(!empty($_POST['user']))
		{
			$post['user'] = $user = ucfirst(strtolower($_POST['user']));

			if($user != $_user)
			{
				if(preg_match('/^[A-Z][a-z0-9._]{2,29}$/', $user))
				{
					try {
						$sql = "SELECT NULL FROM `accountlist` WHERE `user`=?";

						$stmt = $dbh->stmt_init();
						$stmt->prepare($sql);
						$stmt->bind_param("s", $user);
						$stmt->execute();

						if(!$stmt->get_result()->num_rows)
						{
							$sql = "UPDATE `accountlist` SET `user`=? WHERE `id`=?";

							$stmt = $dbh->stmt_init();
							$stmt->prepare($sql);
							$stmt->bind_param("si", $user, $id);
							$stmt->execute();

							$_SESSION['last'] = str_ireplace($_user, strtolower($user), $_SESSION['last']);

							$url .= "user=success&";
						} else
							$url .= "user=taken&";

					} catch (mysqli_sql_exception $exception) {

						$driver->logexc($exception, E_WARNING);

						switch($exception->getTrace()[0]['function'])
						{
							case 'prepare':
								$url .= "user=conn&";
								break;
							default:
								$url .= "user=unknown&";
								break;
						}
					}
				} else
					$url .= "user=invalid&";
			}
		}

		//email
		if(!empty($_POST['email']))
		{
			$post['email'] = $email = strtolower($_POST['email']);

			if($email != $_email)
			{
				if(!isset($_SESSION['spam']) || $_SESSION['spam'] < 3)
				{
					if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
					{
						try {
							$sql = "SELECT NULL FROM `accountlist` WHERE `email`=?";

							$stmt = $dbh->stmt_init();
							$stmt->prepare($sql);
							$stmt->bind_param("s", $_POST['email']);
							$stmt->execute();

							if(!$stmt->get_result()->num_rows)
							{
								include_once 'signup/password/spam.inc.php';

								$tokenid = hash("crc32", random_bytes(rand(8, 32)));
								$token = 'e' . sha1(random_bytes(128));
								$hash = password_hash($token, PASSWORD_DEFAULT);
								$date = date("Y-m-d H:i:s", strtotime("+30 minute", time()));

								$token = $token . $tokenid;

								$sql = "INSERT INTO `update`(`id`, `hash`, `email`, `expire`,`userid`) VALUES (?, ?, ?, ?, ?)";
								$stmt = $dbh->stmt_init();

								$stmt->prepare($sql);
								$stmt->bind_param("sssss", $tokenid, $hash, $email, $date, $id);
								$stmt->execute();

								require_once 'PHPMailer/config.inc.php';

								if(send($email, $body['settings']['subject'], "<h1>{$body['settings']['title']}!</h1><div style=\"font-size: 1rem;font-family: serif\"><p>{$body['settings']['click']} <a href=\"".HTTP."profile/settings/$token\">{$body['settings']['here']}</a> {$body['settings']['confirm']}.</p><p>{$body['note']}.</p></div>",
								"{$body['settings']['title']}!\n{$body['settings']['click']} {$body['settings']['here']} (".HTTP."profile/settings/$token) {$body['settings']['confirm']}.\n{$body['note']}."))
									$url .= "email=pending&";
								else
									$url .= "email=send&";
							} else
								$url .= "email=taken&";

						} catch (mysqli_sql_exception $exception) {

							$driver->logexc($exception, E_WARNING);

							switch($exception->getTrace()[0]['function'])
							{
								case 'prepare':
									$url .= "email=conn&";
									break;
								default:
									$url .= "email=unknown&";
									break;
							}
						}
					} else
						$url .= "email=invalid&";
				} else
					$url .= "email=spam&";
			}
		}

		//privacy
		if(isset($_POST['privacy']) != $_SESSION['privacy'])
		{
			$privacy = !$_SESSION['privacy'];

			try {
				$sql = "UPDATE `accountlist` SET `privacy`=? WHERE `id`=?";

				$stmt = $dbh->stmt_init();
				$stmt->prepare($sql);
				$stmt->bind_param("ii", $privacy, $id);
				$stmt->execute();

				$_SESSION['privacy'] = $privacy;
				$url .= "privacy=success&";

			} catch (mysqli_sql_exception $exception) {

				$driver->logexc($exception, E_WARNING);

				switch($exception->getTrace()[0]['function'])
				{
					case 'prepare':
						$url .= "privacy=conn&";
						break;
					default:
						$url .= "privacy=unknown&";
						break;
				}
			}
		}

		//password
		if(empty($_POST['old']) || empty($_POST['pwd']) || empty($_POST['pwd2']))
		{
			if(!(empty($_POST['old']) && empty($_POST['pwd']) && empty($_POST['pwd2'])))
			{
				if(empty($_POST['old']))
					$url .= "old=empty&";
				if(empty($_POST['pwd']) || empty($_POST['pwd2']))
					$url .= "pwd=empty&";
			}
		} else {
			try {
				$sql = "SELECT `password` FROM `accountlist` WHERE `id`=?";

				$stmt = $dbh->stmt_init();
				$stmt->prepare($sql);
				$stmt->bind_param("i", $id);
				$stmt->execute();

				if(password_verify($_POST['old'], $stmt->get_result()->fetch_assoc()['password']))
				{
					if(strlen($_POST['pwd']) >= 8 && strlen($_POST['pwd']) <= 255)
					{
						if($_POST['pwd'] === $_POST['pwd2'])
						{
							$pwd = password_hash($_POST['pwd'], PASSWORD_DEFAULT);
							$sql = "UPDATE `accountlist` SET `password`=? WHERE `id`=?";

							$stmt = $dbh->stmt_init();
							$stmt->prepare($sql);
							$stmt->bind_param("si", $pwd, $id);
							$stmt->execute();

							$url .= "old=success&";
						} else
							$url .= "pwd=match&";
					} else
						$url .="pwd=length&";
				} else
					$url .= "old=wrong&";

			} catch (mysqli_sql_exception $exception) {

				$driver->logexc($exception, E_WARNING);

				switch($exception->getTrace()[0]['args'][0])
				{
					case 'i':
						switch($exception->getTrace()[0]['function'])
						{
							case 'prepare':
								$url .= "old=conn&";
								break;
							default:
								$url .= "old=unknown&";
								break;
						}
					case 'si':
						switch($exception->getTrace()[0]['function'])
						{
							case 'prepare':
								$url .= "pwd=conn&";
								break;
							default:
								$url .= "pwd=unknown&";
								break;
						}
				}
			}
		}

		if(substr($url, -1) == '&')
		{
			require_once 'head.inc.php';
			head(rtrim($url, '&'), $post);
		}
		else
			header("Location: ..");
	} else {
		$_SESSION['check'] = true;
		header("Location: .");
	}
