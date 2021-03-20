<?php

	if(basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]))
	{
		header("Location: " . HTTP . "?error=404");
		exit();
	}

	function instauser($token) {
		if($token)
		{
			require_once 'instagram/access.inc.php';
			$token = decrypt($token);

			$curl = curl_init("https://graph.instagram.com/me?fields=username&access_token=$token");

			curl_setopt($curl, CURLOPT_HTTPGET, true);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

			$result = json_decode(curl_exec($curl), true);
			curl_close($curl);

			if(isset($result['username']))
				return $result['username'];

			trigger_error("Unable to retrieve the username from access token: ".$result['error']['message'], E_USER_NOTICE);
		}

		return false;
	}
