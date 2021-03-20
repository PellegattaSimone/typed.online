<?php require_once 'defines.inc.php'?>
<?php

	if(basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]))
	{
		header("Location: " . HTTP . "?error=404");
		exit();
	}

	function description(&$description, $id, $user, $instauser, &$points = 0) {
		include_once 'instagram/agents.inc.php';
		$curl = curl_init("https://www.instagram.com/$instauser/?__a=1");

		curl_setopt($curl, CURLOPT_HTTPGET, true);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_USERAGENT, $agents[array_rand($agents)]);

		$result = json_decode(curl_exec($curl), true);
		curl_close($curl);

		if(isset($result['graphql']))
		{
			$bio = $result['graphql']['user']['biography'];
			$url = $result['graphql']['user']['external_url'];

			$temp = $bio . (empty($bio) || empty($url) ? '' : "\n") . $url;
			$bio = stripos($temp, "typed.online/".$user) !== false ? 1 : 0;

			if($description !== $bio)
			{
				global $dbh;

				$sql = "UPDATE `data` SET `points`=`points`".($bio ? '+' : '-')."1000, `description`='$bio' WHERE `id`=$id";

				$stmt = $dbh->stmt_init();
				$stmt->prepare($sql);
				$stmt->execute();

				$points += $bio ? 1000 : -1000;
			}

			$description = $temp;
			return $bio;
		}
		return -1;
	}
