<?php

	if(basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]))
	{
		header("Location: " . HTTP . "?error=404");
		exit();
	}

	function encrypt($token) {
		$cipher = "aes-128-ctr";

		$iv = random_bytes(openssl_cipher_iv_length($cipher));
		$raw = $iv . openssl_encrypt(str_pad($token, 255, '-'), $cipher, hash_pbkdf2("sha512", getenv("KEY"), 1024, 16), OPENSSL_RAW_DATA, $iv);
		return base64_encode(hash_hmac("sha256", $raw, hash_pbkdf2("sha512", getenv("KEY"), 1024, 16), true) . $raw);
	}

	function decrypt ($token) {
		$cipher = "aes-128-ctr";
		$length = openssl_cipher_iv_length($cipher);
		$algo = "sha256";

		$decoded = base64_decode($token, true);

		if($decoded !== false)
		{
			$hash = hash_hmac($algo, substr($decoded, strlen(hash($algo, '', true))), hash_pbkdf2("sha512", getenv("KEY"), 1024, 16), true);

			if(hash_equals($hash, substr($decoded, 0, strlen($hash))))
				return strtok(openssl_decrypt(substr($decoded, strlen($hash) + $length), $cipher, hash_pbkdf2("sha512", getenv("KEY"), 1024, 16), OPENSSL_RAW_DATA, substr($decoded, strlen($hash), $length)), '-');
		}

		return false;
	}
