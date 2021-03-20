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
					$data = $_SESSION['data'];
					$date = $data['instagram'] ? date("Y-m-d", strtotime("+50 day", time())) : NULL;
					$allow = TODAY;

					try {
						$sql = "INSERT INTO `accountlist`(`user`, `password`, `email`, `instagram`, `token`, `tokendate`, `creationdate`) VALUES (?, ?, ?, ?, ?, ?, ?)";
						$stmt = $dbh->stmt_init();
						$stmt->prepare($sql);
						$stmt->bind_param("sssisss", $data['user'], $pwd, $data['email'], $data['instagram'], $data['token'], $date, $data['expire']);
						$stmt->execute();

						$sql = "INSERT INTO `data`(`allow`) VALUES (?)";
						$stmt = $dbh->stmt_init();
						$stmt->prepare($sql);
						$stmt->bind_param("s", $allow);
						$stmt->execute();

						$sql = "SELECT `id` FROM `accountlist` WHERE `user`=?";
						$stmt = $dbh->stmt_init();
						$stmt->prepare($sql);
						$stmt->bind_param("s", $data['user']);
						$stmt->execute();

						$id = $stmt->get_result()->fetch_assoc()['id'];

						if(isset($_SESSION['instagram']))
						{
							if($_SESSION['instagram']['picture'])
							{
								foreach(glob(ROOT."avatars/".substr(md5($id), 10, 12).".*") as $old)
									unlink($old);

								file_put_contents(ROOT."avatars/".substr(md5($id), 10, 12).'.jpg', file_get_contents($_SESSION['instagram']['picture'], false, stream_context_create(["ssl"=>["verify_peer"=>false,"verify_peer_name"=>false]])));
							}

							$_SESSION['instauser'] = $_SESSION['instagram']['user'];
							unset($_SESSION['instagram']);
						}

						if(isset($data['point']))
						{
							$sql = "UPDATE `data` SET `points`=`points`+400 WHERE `id`=?";

							$stmt = $dbh->stmt_init();
							$stmt->prepare($sql);
							$stmt->bind_param("i", $data['point']);
							$stmt->execute();
						}

						$_SESSION['id'] = $id;

						include_once 'expired.inc.php';
						expired($dbh, $data['email']);

						header("Location: ../..?signup");

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
