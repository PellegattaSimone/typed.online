<?php require_once 'defines.inc.php'?>
<?php

	require_once 'head.inc.php';

	$get = $_GET['page'];

	if(isset($_POST['check']) && ($get == "bug" || $get == "advice"))
	{
		$type = (int)($_GET['page'] == "advice");
		$page = isset($_POST['page']) ? $_POST['page'] : NULL;
		$email = empty($_POST['email']) ? NULL : $_POST['email'];
		$content = str_replace("\r", '', $_POST['content']);

		if($page === NULL || is_numeric($page) && $page >= 0 && $page <= 13)
		{
			$post = array('page'=>$page, 'email'=>$email, 'content'=>htmlentities($content, ENT_NOQUOTES | ENT_HTML5));

			if((empty($email) || filter_var($email, FILTER_VALIDATE_EMAIL)) && mb_strlen($content) >= 5 && mb_strlen($content) <= 1000)
			{
				$date = NOW;

				try {
					$sql = "INSERT INTO `contactus`(`userid`, `type`, `page`, `email`, `content`, `date`) VALUES (? ,? ,? ,?, ?, ?)";

					$stmt = $dbh->stmt_init();
					$stmt->prepare($sql);
					$stmt->bind_param("iiisss", $_SESSION['id'], $type, $page, $email, $content, $date);
					$stmt->execute();

					header("Location: $get?$get=success");
				} catch (mysqli_sql_exception $exception) {
					$driver->logexc($exception);

					switch($exception->getTrace()[0]['function'])
					{
						case 'prepare':
							head("$get?$get=conn", $post);
							break;
						default:
							head("$get?$get=unknown", $post);
							break;
					}
				}
			} elseif(isset($email) && !filter_var($email, FILTER_VALIDATE_EMAIL))
					head("$get?$get=email", $post);
				else
					head("$get?$get=content", $post);
		} else
			header("Location: $get?$get=page");
	} else
		header("Location: ".HTTP."?error=404");
