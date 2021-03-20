<?php require_once 'defines.inc.php'?>
<?php

	if(isset($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']))
		if($_SERVER['PHP_AUTH_USER'] == "refresh" && hash_equals("9XE7u6CHM85pSEqF2tRFCxnqTQUrGvSsHpACqHprBKtHZDnMeMpQL7n8yjLRJZ2K", $_SERVER['PHP_AUTH_PW']))
		{
			$date = date("Y-m-d", strtotime("+50 day", time()));
			$text = NOW . "\nUser-agent: " . (isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : "none") . "\n";
			$ok = true;

			try {
				$sql = "SELECT `id`, `token`, `tokendate` FROM `accountlist` WHERE `tokendate`<'".TODAY."'";

				$stmt = $dbh->stmt_init();
				$stmt->prepare($sql);
				$stmt->execute();

				$result = $stmt->get_result();
				require_once 'instagram/access.inc.php';

				for($count = 0; ($row = $result->fetch_assoc()) !== NULL; $count++)
				{
					$token = decrypt($row['token']);

					if($token)
					{
						$text .= "\n" . $count . " (" . $row['id'] . "): " . $row['tokendate'];
						$curl = curl_init("https://graph.instagram.com/refresh_access_token?grant_type=ig_refresh_token&access_token=$token");

						curl_setopt($curl, CURLOPT_HTTPGET, true);
						curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

						$response = json_decode(curl_exec($curl), true);

						curl_close($curl);

						if(isset($response['access_token']))
						{
							$refresh = encrypt($response['access_token']);

							try {
								$sql = "UPDATE `accountlist` SET `token`=?, `tokendate`=? WHERE `id`=?";

								$stmt = $dbh->stmt_init();
								$stmt->prepare($sql);
								$stmt->bind_param("ssi", $refresh, $date, $row['id']);
								$stmt->execute();

								if(!$stmt->affected_rows);
									throw new mysqli_sql_exception("No rows affected");

								continue;

							} catch (mysqli_sql_exception $exception) {

								$driver->logexc($exception, E_WARNING);

								switch($exception->getTrace()[0]['function'])
								{
									case 'prepare':
										$text .= "\nconn: " . $exception->getMessage();
										break;
									default:
										$text .= "\nunknown: " . $exception->getMessage();
										break;
								}
							}
						} else
							$text .= "\ncurl: " . $token . "\n" . print_r($response, TRUE);
					} else
						$text .= "\ndecrypt: " . $row['token'];

					$ok = false;
				}

				if($count)
					$text .= "\n";

				$text .= "\nTotal: " . $result->num_rows;
				$text .= "\n\nDone: " . $count;

			} catch (mysqli_sql_exception $exception) {

				$driver->logexc($exception, E_WARNING);

				switch($exception->getTrace()[0]['function'])
				{
					case 'prepare':
						$text .= "\nfatal error -> conn: " . $exception->getMessage();
						break;
					default:
						$text .= "\nfatal error -> unknown: " . $exception->getMessage();
						break;
				}
			}

			$text .= "\n\n-----------------------\n\n";

			$log = fopen("refresh.txt", 'a');
			fwrite($log, $text);
			fclose($log);

			echo $ok ? "Success\n\n" : '';
			echo $text;
		} else
			http_response_code(403);
	else
		header("Location: .?error=404");
