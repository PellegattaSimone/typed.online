<?php require_once 'defines.inc.php'?>
<!DOCTYPE html>
<html lang="<?=$lang?>">
	<head>
		<?php
			if(!isset($_SESSION['instagram']))
			{
				header("Location: .?error=404");
				exit();
			}

			if(isset($_POST['signup']))
			{
				require_once 'head.inc.php';
				head("instagram/signup", array('user'=>ucfirst($_SESSION['instagram']['user'])));
			}

			require_once 'style.inc.php';
			include_once 'instagram/agents.inc.php';

			$curl = curl_init("https://www.instagram.com/{$_SESSION['instagram']['user']}/?__a=1");

			curl_setopt($curl, CURLOPT_HTTPGET, true);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_USERAGENT, $agents[array_rand($agents)]);

			$result = json_decode(curl_exec($curl), true);
			curl_close($curl);

			$instagram = isset($result['graphql']);

			$_SESSION['instagram']['picture'] = $instagram ? $result['graphql']['user']['profile_pic_url_hd'] : false;
		?>

		<link rel="stylesheet" href="<?=HTTP?>style/pages/instagram.css" type="text/css" media="all">
	</head>

	<body>
<?php include_once 'header.php'?>

		<h1><?=$text['title']?></h1>

		<div id="action">
			<button onclick="location.href='instagram/signup'"><?=$text['new']?></button>
			<button onclick="location.href='instagram/login'"><?=$text['existing']?></button>
		</div>

		<div id="profile">
			<h2><?=$_SESSION['instagram']['user']?></h2>

			<span>
				<span><?=$text['posts']?></span><br />
				<span><?=$instagram ? $result['graphql']['user']['edge_owner_to_timeline_media']['count'] : "n/d"?></span>
			</span>
			<span>
				<span><?=$text['followers']?></span><br />
				<span><?=$instagram ? $result['graphql']['user']['edge_followed_by']['count'] : "n/d"?></span>
			</span>
			<span>
				<span><?=$text['following']?></span><br />
				<span><?=$instagram ? $result['graphql']['user']['edge_follow']['count'] : "n/d"?></span>
			</span>
		</div>

<?php include_once 'footer.php'?>
