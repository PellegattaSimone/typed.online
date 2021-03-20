<?php require_once 'defines.inc.php'?>
<?php

	require_once 'head.inc.php';

	$info = $_GET['info'];

	if(isset($_GET['type'], $_SESSION['id']) && ($info == "visibility" || $info == "hide"))
	{
		$field = $info == "hide" ? "hidden" : "anonymous";
		$type = $_GET['type'];
		$_SESSION['view'] = 3;

		if(in_array($type, $_SESSION['info']))
		{
			try {
				$sql = "UPDATE `types` SET `$field`= NOT `$field` WHERE `id`=$type";

				$stmt = $dbh->stmt_init();
				$stmt->prepare($sql);
				$stmt->execute();

				header("Location: .?".($info=="hide" ? "$info=success" : "$type=success#$type"));

			} catch (mysqli_sql_exception $exception) {

				$driver->logexc($exception);

				switch($exception->getTrace()[0]['function'])
				{
					case 'prepare':
						header("Location: .?$type=conn#$type");
						break;
					default:
						header("Location: .?$type=unknown#$type");
						break;
				}
			}
		} else
			header("Location: .?$info=$type");
	} else
		header("Location: " . HTTP . "?error=404");
