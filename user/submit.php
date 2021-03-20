<?php require_once 'defines.inc.php'?>
<?php

	require_once 'head.inc.php';

	if(isset($_POST['check'], $_SESSION['username']))
	{
		$user = $_SESSION['username']['name'];

		$content = str_replace(array("\n", "\r"), array(' ', ''), $_POST['content']);
		$hidden = isset($_POST['hidden']) && $_POST['hidden'];
		$anonymous = isset($_POST['anonymous']) && $_POST['anonymous'];

		$post = htmlentities($content, ENT_NOQUOTES | ENT_HTML5);

		if(isset($_SESSION['id']) || $anonymous)
		{
			if(isset($_SESSION['id']) || !isset($_POST['hidden']))
			{
				if(!empty($content))
				{
					if(mb_strlen($content) >= 5 && mb_strlen($content) <= 200)
					{
						$date = NOW;

						try {
							$sql = "INSERT INTO `types`(`from`, `to`, `content`, `anonymous`, `hidden`, `questiondate`) VALUES (?, ?, ?, ?, ?, ?)";

							$stmt = $dbh->stmt_init();
							$stmt->prepare($sql);
							$stmt->bind_param("iisiis", $_SESSION['id'], $_SESSION['username']['id'], $content, $anonymous, $hidden, $date);
							$stmt->execute();

							if(!isset($_SESSION['id']) || $_SESSION['id'] != $_SESSION['username']['id'])
							{
								$points = isset($_SESSION['id']) ? '10' : '1';
								$sql = "UPDATE `data` SET `points`=`points`+? WHERE `id`=?";

								$stmt = $dbh->stmt_init();
								$stmt->prepare($sql);
								$stmt->bind_param("ii", $points, $_SESSION['username']['id']);
								$stmt->execute();
							}

							head("../$user?$user=success", array('user'=>$anonymous ? 0 : ucfirst($user), 'content'=>$content));

						} catch (mysqli_sql_exception $exception) {

							$driver->logexc($exception);

							switch($exception->getTrace()[0]['function'])
							{
								case 'prepare':
									head("../$user?$user=conn", $post);
									break;
								default:
									head("../$user?$user=unknown", $post);
									break;
							}
						}
					} else
						head("../$user?$user=length", $post);
				} else
					head("../$user?$user=empty", $post);
			} else
				head("../$user?$user=hidden", $post);
		} else
			head("../$user?$user=anonymous", $post);
	} else
		head(".", false);
