<?php require_once 'defines.inc.php'?>
<?php

	if(isset($_GET['code']))
	{
		if(isset($_GET['state']) && password_verify("local", $_GET['state']))
		{
			header("Location: http://localhost/PHP/typed/auth.php?code={$_GET['code']}");
			exit();
		}

		$id = "497099821237000";
		$secret = "33d4c2d9d2b81c4c513f98a2485618bb";
		$type = "authorization_code";
		$redirect = "https://www.typed.online/auth.php";
		$code = rtrim($_GET['code'], '_#');
		$grant = "ig_exchange_token";

		$curl = curl_init("https://api.instagram.com/oauth/access_token/");

		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, "client_id=$id&client_secret=$secret&grant_type=$type&redirect_uri=$redirect&code=$code");
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		$first = json_decode(curl_exec($curl), true);
		curl_close($curl);

		if(isset($first['access_token']))
		{
			$curl = curl_init("https://graph.instagram.com/access_token?grant_type=$grant&client_secret=$secret&access_token={$first['access_token']}");

			curl_setopt($curl, CURLOPT_HTTPGET, true);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

			$second = json_decode(curl_exec($curl), true);
			curl_close($curl);

			if(isset($second['access_token']))
			{
				$token = $second['access_token'];
				$curl = curl_init("https://graph.instagram.com/me?fields=username&access_token=$token");

				curl_setopt($curl, CURLOPT_HTTPGET, true);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

				$third = json_decode(curl_exec($curl), true);
				curl_close($curl);

				if(isset($third['username']))
				{
					try {
						$sql = "SELECT `id`, `tokendate` FROM `accountlist` WHERE `instagram`=?";

						$stmt = $dbh->stmt_init();
						$stmt->prepare($sql);
						$stmt->bind_param("i", $first['user_id']);
						$stmt->execute();

						$fourth = $stmt->get_result();

						if($fourth->num_rows)
						{
							if(!isset($_SESSION['id']))
							{
								$row = $fourth->fetch_assoc();
								$_SESSION['id'] = $row['id'];

								if(strtotime($row['tokendate']) < time())
								{
									require_once 'instagram/access.inc.php';
									$token = encrypt($token);
									$date = date("Y-m-d", strtotime("+50 day", time()));

									$sql = "UPDATE `accountlist` SET `token`=?, `tokendate`=? WHERE `id`=?";

									$stmt = $dbh->stmt_init();
									$stmt->prepare($sql);
									$stmt->bind_param("ssi", $token, $date, $_SESSION['id']);
									$stmt->execute();
								}

								include_once 'token.inc.php';

								$_SESSION['instauser'] = $third['username'];
								header("Location: .?login");
							} else
								header("Location: .?instagram=taken");
						} else {

							require_once 'instagram/access.inc.php';

							$_SESSION['instagram'] = array('id'=>$first['user_id'], 'token'=>encrypt($token), 'user'=>$third['username']);

							if(isset($_SESSION['id']))
							{
								include_once 'instagram/agents.inc.php';
								$curl = curl_init("https://www.instagram.com/{$third['username']}/?__a=1");

								curl_setopt($curl, CURLOPT_HTTPGET, true);
								curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
								curl_setopt($curl, CURLOPT_USERAGENT, $agents[array_rand($agents)]);

								$fifth = json_decode(curl_exec($curl), true);
								curl_close($curl);

								if(isset($fifth['graphql']))
									$_SESSION['instagram']['picture'] = $fifth['graphql']['user']['profile_pic_url_hd'];
								else
									$_SESSION['instagram']['picture'] = false;

								header("Location: instagram/login");
							} else
								header("Location: instagram");
						}
					} catch (mysqli_sql_exception $exception) {

						$driver->logexc($exception);

						switch($exception->getTrace()[0]['function'])
						{
							case 'prepare':
								header("Location: .?instagram=conn");
								break;
							default:
								header("Location: .?instagram=unknown");
								break;
						}
					}
				} else {
					trigger_error("Unable to retrieve the username from access token: ".$third['error']['message'], E_USER_NOTICE);
					header("Location: .?instagram=user");
				}
			} else {
				trigger_error("Unable to retrieve the long access token: ".$second['error']['message'], E_USER_NOTICE);
				header("Location: .?instagram=long");
			}
		} else {
			trigger_error("Unable to retrieve the short access token: ".$first['error_message'], E_USER_NOTICE);
			header("Location: .?instagram=short");
		}
	} else
		header("Location: " . HTTP . "?error=403");
