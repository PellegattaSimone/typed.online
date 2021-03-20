<?php require_once 'defines.inc.php'?>
<?php

	require_once 'head.inc.php';

	if(isset($_POST['check'], $_SESSION['id']))
	{
		$type = $_POST['check'];
		$_SESSION['view'] = 2;

		if(isset($_SESSION['types'][$type]) && !$_SESSION['types'][$type])
		{
			$content = str_replace(array("\n", "\r"), array(' ', ''), $_POST['content']);

			if(!empty($content))
			{
				$post = array($type=>htmlentities($content, ENT_NOQUOTES | ENT_HTML5));

				if(mb_strlen($content) >= 5 && mb_strlen($content) <= 200)
				{
					$date = NOW;

					try {
						$sql = "UPDATE `types` SET `content`=?, `questiondate`=? WHERE `id`=?";

						$stmt = $dbh->stmt_init();
						$stmt->prepare($sql);
						$stmt->bind_param("ssi", $content, $date, $type);
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
			header("Location: .?edit=$type#$type");
	} else
		head(".", false);
