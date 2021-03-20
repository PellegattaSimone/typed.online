<?php require_once 'defines.inc.php'?>
<?php

	if(isset($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']))
		if($_SERVER['PHP_AUTH_USER'] == "biography" && hash_equals("3FHVhbRLAVyZPgTwvS49rsRWPrY8CT8YUe9X3TrqGHx2ELuWYWG8Yun3JPAhmZkd", $_SERVER['PHP_AUTH_PW']))
		{
			$text = NOW . "\nUser-agent: " . (isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : "none") . "\n";
			$ok = true;

			if(!file_exists("stop.txt"))
			{
				try {
					$sql = "SELECT `accountlist`.`id`, `user`, `token`, `description` FROM `accountlist` JOIN `data` ON `accountlist`.`id`=`data`.`id`";

					$stmt = $dbh->stmt_init();
					$stmt->prepare($sql);
					$stmt->execute();

					$result = $stmt->get_result();
					require_once 'user/description.inc.php';

					for($count = 0, $updated = 0; ($row = $result->fetch_assoc()) !== NULL; $count++)
					{
						$text .= "\n" . $count . " (" . $row['id'] . "): " . $row['description'];

						require_once 'instagram/user.inc.php';
						$instauser = instauser($row['token']);

						if($instauser)
						{
							try {
								if(description($row['description'], $row['id'], $row['user'], $instauser) == -1)
								{
									fclose(fopen("stop.txt", 'x'));
									$ok = false;
									$text .= "\ncurl\n";
								} else {
									$text .= "\nupdated: " . ($row['description'] ? 0 : 1) . "\n";
									$updated++;
								}
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
					}

					if($count)
						$text .= "\n";

					$text .= "\nTotal: " . $result->num_rows;
					$text .= "\n\nDone: " . $count;
					$text .= "\n\nUpdated: " . $updated;
				}
				catch (mysqli_sql_exception $exception)
				{
					$driver->logexc($exception, E_WARNING);
					$ok = false;

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
			} else {
				$text .= "\nskipped";
				if(file_get_contents("stop.txt") != 5)
					file_put_contents("stop.txt", (int)file_get_contents("stop.txt") + 1);
				else
					unlink("stop.txt");
			}

			$text .= "\n\n-----------------------\n\n";

			$log = fopen("biography.txt", 'a');
			fwrite($log, $text);
			fclose($log);

			echo $ok ? "Success\n\n" : '';
			echo $text;
		} else
			http_response_code(403);
	else
		header("Location: ".HTTP."?error=404");
