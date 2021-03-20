<?php require_once 'defines.inc.php'?>
<?php

	if(isset($_POST['check']))
	{
		if(isset($_POST['green'], $_POST['blue'], $_POST['brown'], $_POST['white']))
		{
			$green = trim($_POST['green'], '#');
			$blue = trim($_POST['blue'], '#');
			$brown = trim($_POST['brown'], '#');
			$white = trim($_POST['white'], '#');
			$black = trim($_POST['black'], '#');
			$gray = trim($_POST['gray1'], '#');

			if(ctype_xdigit($green) && ctype_xdigit($blue) && ctype_xdigit($brown) && ctype_xdigit($white) && ctype_xdigit($black) && ctype_xdigit($gray) && strlen($green) == 6 && strlen($blue) == 6 && strlen($brown) == 6 && strlen($white) == 6 && strlen($black) == 6 && strlen($gray) == 6)
			{
				$rgb = $green . $blue . $brown . $white . $black . $gray;

				if(isset($_POST['keep'], $_SESSION['id']))
				{
					try {
						$sql = "UPDATE `data` SET `rgb`=? WHERE `id`=?";

						$stmt = $dbh->stmt_init();
						$stmt->prepare($sql);
						$stmt->bind_param("ss", $rgb, $_SESSION['id']);
						$stmt->execute();

					} catch (mysqli_sql_exception $exception) {

						$driver->logexc($exception);

						switch($exception->getTrace()[0]['function'])
						{
							case 'prepare':
								header("Location: .?style=conn");
								break;
							default:
								header("Location: .?style=unknown");
								break;
						}
					}

					exit();
				}
				$_SESSION['theme'] = $_SESSION['rgb'] = $rgb;
				setcookie("theme", $rgb, $time, '/');

				header("Location: ..");

			} elseif (!ctype_xdigit($green) || strlen($green) != 6)
				header("Location: .?style=green");
			elseif (!ctype_xdigit($blue) || strlen($blue) != 6)
				header("Location: .?style=blue");
			elseif (!ctype_xdigit($brown) || strlen($brown) != 6)
				header("Location: .?style=brown");
			elseif(!ctype_xdigit($white) || strlen($white) != 6)
				header("Location: .?style=white");
			elseif(!ctype_xdigit($black) || strlen($black) != 6)
				header("Location: .?style=black");
			else
				header("Location: .?style=gray");
		} else
			header("Location: .?style=empty");
	} else {
		$_SESSION['check'] = true;
		header("Location: .");
	}
