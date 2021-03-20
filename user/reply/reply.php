<?php require_once 'defines.inc.php'?>
<?php

	require_once 'head.inc.php';

	if(isset($_POST['check'], $_SESSION['id']))
	{
		$type = $_POST['check'];

		if(in_array($type, $_SESSION['reply']))
		{
			$answer = str_replace(array("\n", "\r"), array(' ', ''), $_POST['answer']);

			if(!empty($answer))
			{
				$post = array($type=>htmlentities($answer, ENT_NOQUOTES | ENT_HTML5));

				if(mb_strlen($answer) >= 5 && mb_strlen($answer) <= 200)
				{
					$date = NOW;

					try {
						$sql = "UPDATE `types` SET `answer`=?, `answerdate`=? WHERE `id`=?";

						$stmt = $dbh->stmt_init();
						$stmt->prepare($sql);
						$stmt->bind_param("ssi", $answer, $date, $type);
						$stmt->execute();

						$sql = "UPDATE `data` SET `points`=`points`+30 WHERE `id`=".$_SESSION['id'];

						$stmt = $dbh->stmt_init();
						$stmt->prepare($sql);
						$stmt->execute();

						head(".?reply=success", $type);

					} catch (mysqli_sql_exception $exception) {

						$driver->logexc($exception);

						switch($exception->getTrace()[0]['function'])
						{
							case 'prepare':
								head(".?$type=conn#$type", $post);
								break;
							default:
								head(".?$type=unknown#$type", $post);
								break;
						}
					}
				} else
					head(".?$type=length#$type", $post);
			} else
				header("Location: .?$type=empty#$type");
		} else
			header("Location: .?reply=$type#$type");
	} else
		head(".", false);
