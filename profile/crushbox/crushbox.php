<?php require_once 'defines.inc.php'?>
<?php

	function check(&$crush, $field)
	{
		if(strtotime("+10 day", strtotime($_SESSION['date'][$field])) > time() && $_SESSION['date'][$field] != TODAY)
		{
			$crush = $_SESSION['crush'][$field];
			return $_SESSION['date'][$field];
		}
		return $crush ? TODAY : NULL;
	}

	function set(&$crush) {
		if(in_array($crush, $_SESSION['crush']))
		{
			for($n = 0; $n < 3; $n++)
				if($crush == $_SESSION['crush'][$n])
					$date = check($crush, $n);
		} else {
			if($crush)
			{
				$date = TODAY;
				array_push($GLOBALS['new'], $crush);
			} else
				$date = NULL;
		}
		return $date;
	}

	if(isset($_POST['check']))
	{
		$expire = $_POST['expire'];

		$first = $_POST['first'] ? ucfirst(strtolower($_POST['first'])) : NULL;
		$second = $_POST['second'] ? ucfirst(strtolower($_POST['second'])) : NULL;
		$third = $_POST['third'] ? ucfirst(strtolower($_POST['third'])) : NULL;

		if(!$first && $second)
		{
			$first = $second;
			$second = NULL;
		}
		if(!$second && $third)
		{
			$second = $third;
			$third = NULL;
		}

		if($expire != $_SESSION['expire'] || array($first, $second, $third) != $_SESSION['crush'])
		{
			require_once 'head.inc.php';
			$post = array('first'=>$first, 'second'=>$second, 'third'=>$third, 'expire'=> $expire);

			if($first != $_user && $second != $_user && $third != $_user)
			{
				if(($first != $second || $first === NULL) && ($second != $third || $second === NULL) && ($third != $first || $third === NULL))
				{
					if($expire >= 5 && $expire <= 180 && ($first === NULL || strlen($first) >= 3 && strlen($first) <= 30) && ($second === NULL || strlen($second) >= 3 && strlen($second) <= 30) && ($third === NULL || strlen($third) >= 3 && strlen($third) <= 30))
					{
						if(empty(array_intersect(array($first, $second, $third), INVALID)))
						{
							$new = array();

							$firstdate = set($first);
							$seconddate = set($second);
							$thirddate = set($third);

							try {
								$sql = "SELECT `id`, `user` FROM `accountlist` WHERE `user` IN(?, ?, ?)";

								$stmt = $dbh->stmt_init();
								$stmt->prepare($sql);
								$stmt->bind_param("sss", $first, $second, $third);
								$stmt->execute();

								$result = $stmt->get_result();

								if($result->num_rows >= isset($first) + isset($second) + isset($third))
								{
									while(($row = $result->fetch_assoc()) !== NULL)
									{
										if($first == $row['user'])
											$firstid = $row['id'];
										elseif($second == $row['user'])
											$secondid = $row['id'];
										else
											$thirdid = $row['id'];
									}

									$sql = "UPDATE `data` SET `expire`=?, `first`=?, `firstdate`=?, `second`=?, `seconddate`=?, `third`=?, `thirddate`=? WHERE `id`=?";

									$stmt = $dbh->stmt_init();
									$stmt->prepare($sql);
									$stmt->bind_param("iisisisi", $expire, $firstid, $firstdate, $secondid, $seconddate, $thirdid, $thirddate, $_SESSION['id']);
									$stmt->execute();

									$_SESSION['expire'] = $expire;

									if(isset($_SESSION['match']) && !in_array($_SESSION['match'], array($first, $second, $third)))
									{
										$sql = "UPDATE `data` SET `match`=NULL WHERE ? IN (`id`, `match`)";

										$stmt = $dbh->stmt_init();
										$stmt->prepare($sql);
										$stmt->bind_param("i", $_SESSION['id']);
										$stmt->execute();

										unset($_SESSION['match']);
									}

									if(empty($new))
										head(".?crushbox=success");
									else {
										$sql = "SELECT `accountlist`.`id`, `email`, `first`, `second`, `third` FROM `accountlist` JOIN `data` ON `accountlist`.`id`=`data`.`id` WHERE `user` IN (?, ?, ?)";

										$stmt = $dbh->stmt_init();
										$stmt->prepare($sql);
										$stmt->bind_param("sss", $new[0], $new[1], $new[2]);
										$stmt->execute();

										$result = $stmt->get_result();

										while(($row = $result->fetch_assoc()) !== NULL)
										{
											if(in_array($_SESSION['id'], $row))
											{
												$sql = "UPDATE `data` SET `match`=CASE WHEN `id`=? THEN ? WHEN `id`=? THEN ? END";

												$stmt = $dbh->stmt_init();
												$stmt->prepare($sql);
												$stmt->bind_param("iiii", $_SESSION['id'], $row['id'], $row['id'], $_SESSION['id']);
												$stmt->execute();

												$_SESSION['nomatch'] = true;

												if(!(isset($_SESSION['sent']) && in_array($row['id'], $_SESSION['sent'])))
												{
													require_once 'PHPMailer/config.inc.php';

													if(send($row['email'], $body['crushbox']['subject'], "<h1 style=\"font-size: 2rem\">{$body['crushbox']['title']}!</h1><div style=\"font-size: 1rem;font-family: serif\"><p>$_user {$body['crushbox']['add']}.</p><p>{$body['crushbox']['wait']}?</p></div>",
													"{$body['crushbox']['title']}\n$_user {$body['crushbox']['add']}.\n{$body['crushbox']['wait']}?"))
													{
														if(!isset($_SESSION['sent']))
															$_SESSION['sent'] = array();
														array_push($_SESSION['sent'], $row['id']);
													} else
														trigger_error("Could not send Crushbox email", E_USER_WARNING);
												}
											}
										}

										head(".?crushbox=success");
									}
								} else {
									for($n = 0; $n < $result->num_rows; $n++)
									{
										$found = $result->fetch_assoc()['user'];

										if($first == $found)
											$first = NULL;
										elseif($second == $found)
											$second = NULL;
										elseif($third == $found)
											$third = NULL;
									}

									if($first !== NULL)
										head(".?crushbox=first", $post);
									elseif($second !== NULL)
										head(".?crushbox=second", $post);
									else
										head(".?crushbox=third", $post);
								}

							} catch (mysqli_sql_exception $exception) {

								$driver->logexc($exception);

								switch($exception->getTrace()[0]['function'])
								{
									case 'prepare':
										head(".?crushbox=conn", $post);
										break;
									default:
										head(".?crushbox=unknown", $post);
										break;
								}
							}
						} else {
							if(in_array($first, INVALID))
								head(".?crushbox=first", $post);
							elseif(in_array($second, INVALID))
								head(".?crushbox=second", $post);
							else
								head(".?crushbox=third", $post);
						}
					} else
						head(".?crushbox=length", $post);
				} else
					head(".?crushbox=twice", $post);
			} else
				head(".?crushbox=self", $post);
		} else
			header("Location: .");
	} else
		head(".", false);
