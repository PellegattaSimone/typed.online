<?php

	if(basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]))
	{
		header("Location: " . HTTP . "?error=404");
		exit();
	}

	function verify($signed) {
		$secret = "33d4c2d9d2b81c4c513f98a2485618bb";

		$signed = explode('.', $signed);

		if(count($signed) == 2)
		{
			$hash = hash_hmac('sha256', $signed[1], $secret, true);

			if(hash_equals($hash, base64_decode(strtr($signed[0], "-_", "+/"))))
				return json_decode(base64_decode(strtr($signed[1], "-_", "+/")), true)["user_id"];
		}

		return NULL;
	}
