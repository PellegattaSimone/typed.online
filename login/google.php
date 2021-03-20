<?php require_once 'defines.inc.php'?>
<?php

	require_once 'head.inc.php';

	if(isset($_POST['token']))
	{
		$token = explode('.', $_POST['token']);

		if(count($token) == 3)
		{
			$cache = fopen("cache.txt", 'r');

			if(fgets($cache) < time())
			{
				fclose($cache);
				$cache = fopen("cache.txt", 'w');

				function read($curl, $header) {
					global $cache;

					if(strpos($header, "max-age=") !== false)
						fwrite($cache, time() + (int)substr($header, strpos($header, "max-age=") + 8) . "\n");

					return strlen($header);
				}

				$curl = curl_init("https://www.googleapis.com/oauth2/v1/certs");

				curl_setopt($curl, CURLOPT_HTTPGET, true);
				curl_setopt($curl, CURLOPT_FRESH_CONNECT, true);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($curl, CURLOPT_HEADERFUNCTION, "read");

				$response = curl_exec($curl);
				curl_close($curl);

				$certificates = json_decode($response, true);
				fwrite($cache, $response);
			} else
				$certificates = json_decode(stream_get_contents($cache), true);

			fclose($cache);

			if(openssl_verify($token[0].'.'.$token[1], base64_decode(strtr($token[2], "-_", "+/")), openssl_pkey_get_public($certificates[json_decode(base64_decode(strtr($token[0], "-_", "+/")), true)['kid']]), OPENSSL_ALGO_SHA256))
			{
				$data = json_decode(base64_decode(strtr($token[1], "-_", "+/")), true);

				if($data['aud'] == GOOGLE && strpos($data['iss'], "accounts.google.com") !== false)
					if($data['email_verified'])
					{
						$_SESSION['google'] = $data['email'];
						header("Location: login.php");
						exit();
					} else
						head(".", array('user'=>$data['email']));
			}

			trigger_error("Invalid google authentication: ".$_POST['token'], E_USER_NOTICE);
			head(".?login=google", array('user'=>(isset($data['email']) ? $data['email'] : NULL)));
		} else
			head(".?login=google", array());
	} else
		head(".", false);
