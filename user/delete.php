<?php require_once 'defines.inc.php'?>
<?php

	require_once 'head.inc.php';

	$get = $_GET['page'];

	if(isset($_GET['type'], $_SESSION['id']) && ($get == "types" || $get == "reply"))
	{
		$type = $_GET['type'];

		if($get == "types")
			$_SESSION['view'] = 2;

		if(isset($_SESSION['types'][$type]) || in_array($type, $_SESSION['reply']))
		{
			try {
				$sql = "DELETE FROM `types` WHERE `id`=$type";

				$stmt = $dbh->stmt_init();
				$stmt->prepare($sql);
				$stmt->execute();

				header("Location: $get?delete=success");

			} catch (mysqli_sql_exception $exception) {

				$driver->logexc($exception);

				switch($exception->getTrace()[0]['function'])
				{
					case 'prepare':
						header("Location: $get?$type=conn#$type");
						break;
					default:
						header("Location: $get?$type=unknown#$type");
						break;
				}
			}
		} else
			header("Location: $get?delete=$type#$type");
	} else
		header("Location: " . HTTP . "?error=404");
