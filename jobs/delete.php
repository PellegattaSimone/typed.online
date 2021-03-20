<?php require_once 'defines.inc.php'?>
<?php

	if(isset($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']))
		if($_SERVER['PHP_AUTH_USER'] == "delete" && hash_equals("6xut4ZqnbzCCBW27DFh8Aq2DUGnufAGLmK8h97rHQEGEKCduaLc5BjAn2dvpxXsb", $_SERVER['PHP_AUTH_PW']))
		{
			$text = NOW . "\nUser-agent: " . (isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : "none") . "\n";

			try {
				$sql = "DELETE FROM `update` WHERE `expire`<'".NOW."'";

				$stmt = $dbh->stmt_init();
				$stmt->prepare($sql);
				$stmt->execute();

				$text .= "\nRows: " . $stmt->affected_rows;

			} catch (mysqli_sql_exception $exception) {

				$driver->logexc($exception, E_WARNING);

				switch($exception->getTrace()[0]['function'])
				{
					case 'prepare':
						$text .= "\nfatal error -> conn: " . $stmt->error;
						break;
					default:
						$text .= "\nfatal error -> unknown: " . $stmt->error;
						break;
				}
			}

			$text .= "\n\n-----------------------\n\n";

			$log = fopen("delete.txt", 'a');
			fwrite($log, $text);
			fclose($log);

			echo $text;
		} else
			http_response_code(403);
	else
		header("Location: ".HTTP."?error=404");
