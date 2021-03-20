<?php require_once 'defines.inc.php'?>
<?php

	require_once 'head.inc.php';

	if(isset($_POST['check'], $_SESSION['id']))
	{
		$type = $_POST['check'];
		$_SESSION['view'] = 0;

		if(in_array($type, $_SESSION['answers']))
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

						head(".?$type=success#$type", $type);

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
			header("Location: .?answer=$type#$type");
	} else
		head(".", false);
