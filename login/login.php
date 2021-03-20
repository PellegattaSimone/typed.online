<?php require_once 'defines.inc.php'?>
<?php

	require_once 'head.inc.php';
	$google = isset($_SESSION['google']);

	if(isset($_POST['check']) || $google)
	{
		if($google)
		{
			$user = $_SESSION['google'];
			$pwd = true;
		} else {
			$user = $_POST['user'];
			$pwd = $_POST['pwd'];
		}

		$keep = isset($_POST['keep']);

		$post['user'] = $user;
		if(!$keep)
			$post['keep'] = $keep;

		if(!(empty($user) || empty($pwd)))
		{
			if(filter_var($user, FILTER_VALIDATE_EMAIL) || preg_match('/^[A-Za-z][A-Za-z0-9._]{2,29}$/', $user))
			{
				try {
					$sql = "SELECT `id`, `user`, `password`, `instagram` FROM `accountlist` WHERE ? IN(`user`, `email`)";

					$stmt = $dbh->stmt_init();
					$stmt->prepare($sql);
					$stmt->bind_param("s", $user);
					$stmt->execute();

					$result = $stmt->get_result();

					if($result->num_rows)
					{
						$row = $result->fetch_assoc();

						if($google || password_verify($pwd, $row['password']))
						{
							unset($_SESSION['google']);

							if(isset($_SESSION['instagram']))
							{
								$sql = "SELECT NULL FROM `accountlist` WHERE `instagram`=".$_SESSION['instagram']['id'];

								$stmt = $dbh->stmt_init();
								$stmt->prepare($sql);
								$stmt->execute();

								if(!$stmt->get_result()->num_rows)
								{
									$date = date("Y-m-d", strtotime("+50 day", time()));

									$sql = "UPDATE `accountlist` SET `instagram`=?, `token`=?, `tokendate`=? WHERE `id`=?";

									$stmt = $dbh->stmt_init();
									$stmt->prepare($sql);
									$stmt->bind_param("issi", $_SESSION['instagram']['id'], $_SESSION['instagram']['token'], $date, $row['id']);
									$stmt->execute();

									if($_SESSION['instagram']['picture'])
									{
										foreach(glob(ROOT."avatars/".substr(md5($row['id']), 10, 12).".*") as $old)
											unlink($old);

										file_put_contents(ROOT."avatars/".substr(md5($row['id']), 10, 12).'.jpg', file_get_contents($_SESSION['instagram']['picture'], false, stream_context_create(["ssl"=>["verify_peer"=>false,"verify_peer_name"=>false]])));
									}

									$_SESSION['instauser'] = $_SESSION['instagram']['user'];
									unset($_SESSION['instagram']);

								} else {
									unset($_SESSION['instagram']);
									header("Location: ..?instagram=taken");
									exit();
								}

							} elseif(!isset($row['instagram']))
								$_SESSION['instauser'] = false;

							$sql = "SELECT `rgb`, `match` FROM `data` WHERE `id`=".$row['id'];

							$stmt = $dbh->stmt_init();
							$stmt->prepare($sql);
							$stmt->execute();

							$data = $stmt->get_result()->fetch_assoc();
							$_SESSION['rgb'] = $data['rgb'];

							if(isset($data['match']))
							{
								$sql = "SELECT `user` FROM `accountlist` WHERE `id`=".$data['match'];

								$stmt = $dbh->stmt_init();
								$stmt->prepare($sql);
								$stmt->execute();

								$_SESSION['post'] = $stmt->get_result()->fetch_assoc()['user'];
							}

							if(isset($_POST['keep']))
								include_once 'token.inc.php';
							else
								setcookie("id", NULL, time(), '/');

							$_SESSION['id'] = $row['id'];

							if(isset($_SESSION['redirect']))
							{
								header("Location: ".$_SESSION['redirect']);
								unset($_SESSION['redirect']);
							} else
								header("Location: ..?login");
						} else
							head(".?login=pwd", $post);
					} elseif(filter_var($user, FILTER_VALIDATE_EMAIL))
						head(".?login=email", $post);
					else
						head(".?login=user", $post);

				} catch (mysqli_sql_exception $exception) {

					$driver->logexc($exception);

					switch($exception->getTrace()[0]['function'])
					{
						case 'prepare':
							head(".?login=conn", $post);
							break;
						default:
							head(".?login=unknown", $post);
							break;
					}
				}
			} elseif(strpos($user, '@') !== false)
					head(".?login=invalidemail", $post);
				else
					head(".?login=invaliduser", $post);
		} elseif(empty($user))
				head(".?login=emptyuser", $post);
			else
				head(".?login=emptypwd", $post);
	} else
		head(".", false);
