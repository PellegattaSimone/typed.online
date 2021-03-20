<?php require_once 'defines.inc.php'?>
<?php

	//NEVER CALL THIS FILE IN PRODUCTION!!
	//YOU COULD LOSE THE ENTIRE DATABASE DATA

	if(isset($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']))
		if($_SERVER['PHP_AUTH_USER'] == "restore" && hash_equals("8oNrF1XJG85l94t6BOMFVXoDKd50WbdDLeVwDRoDL6OrJGWxN1IWSojVlxgpYx29", $_SERVER['PHP_AUTH_PW']))
		{
			$tables = array("accountlist", "data", "types", "contactus");

			if(isset($_GET['table'], $_GET['time']) && in_array($_GET['table'], $tables))
			{
				$day = $_GET['time'];
				$table = $_GET['table'];

				if(strtotime($_GET['time']) < time() && date("Y-m-d", strtotime($_GET['time'])) === $_GET['time'])
				{
					echo NOW . "\nUser-agent: " . (isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : "none") . "\n\n" . $table . ":\n\n";

					if(file_exists(ROOT."backups/".$table.'/'.$_GET['time'].".txt"))
					{
						try {
							$sql = "SELECT * INTO OUTFILE '".ROOT."backups/".$table.'/'.TODAY.".backup.txt' FROM `$table`";

							$stmt = $dbh->stmt_init();
							$stmt->prepare($sql);
							$stmt->execute();

							$sql = "LOAD DATA INFILE '".ROOT."backups/".$table.'/'.$_GET['time'].".txt' REPLACE INTO TABLE `$table`";

							$dbh->query($sql);
							echo "Restored";

						} catch (mysqli_sql_exception $exception) {

							$driver->logexc($exception, E_WARNING);

							switch($exception->getTrace()[0]['function'])
							{
								case 'prepare':
								case 'query':
									echo "conn: " . $exception->getMessage();
									break;
								default:
									echo "unknown: " . $exception->getMessage();
									break;
							}
						}
					} else
						echo "the file does not exist";

					echo "\n\n-----------------------\n\n";
				} else
					http_response_code(400);
			} else
				http_response_code(400);
		} else
			http_response_code(403);
	else
		header("Location: .?error=404");
