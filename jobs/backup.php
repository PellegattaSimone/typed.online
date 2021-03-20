<?php require_once 'defines.inc.php'?>
<?php

	if(isset($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']))
		if($_SERVER['PHP_AUTH_USER'] == "backup" && hash_equals("0thIk2IJywzhTJDIY7KDurNjtdC8hGeDIb4vzNAwPJRnhWZRCLU20F52xG3o2SQe", $_SERVER['PHP_AUTH_PW']))
		{
			$text = NOW . "\nUser-agent: " . (isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : "none") . "\n";

			$count = 0;
			$tables = array("accountlist", "data", "types", "contactus");

			foreach($tables as $it)
			{
				$text .= "\n" . $it . ": ";

				try {
					$sql = "SELECT * INTO OUTFILE '".ROOT."backups/".$it.'/'.TODAY.".txt' FROM `$it`";

					$stmt = $dbh->stmt_init();
					$stmt->prepare($sql);
					$stmt->execute();

					$text .= "backed up";
					$count++;

				} catch (mysqli_sql_exception $exception) {

					$driver->logexc($exception, E_WARNING);

					switch($exception->getTrace()[0]['function'])
					{
						case 'prepare':
							$text .= "\nconn: " . $exception->getMessage() . "\n";
							break;
						default:
							$text .= "\nunknown: " . $exception->getMessage() . "\n";
							break;
					}
				}
			}

			$text .= "\n\nTotal: " . count($tables);
			$text .= "\n\nDone: " . $count;

			$text .= "\n\n-----------------------\n\n";

			$log = fopen("backup.txt", 'a');
			fwrite($log, $text);
			fclose($log);

			echo count($tables) - $count ? '' : "Success\n\n";
			echo $text;
		} else
			http_response_code(403);
	else
		header("Location: .?error=404");
