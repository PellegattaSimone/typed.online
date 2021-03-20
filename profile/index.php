<?php require_once 'defines.inc.php'?>
<!DOCTYPE html>
<html lang="<?=$lang?>">
	<head>
		<?php
			require_once 'style.inc.php';

			if(isset($_SESSION['post']))
			{
				switch($_SESSION['post'])
				{
					case 'success':
						echo "<script>alert(\"{$text['errors']['success']}\")</script>";
						break;
					case 'self':
						echo "<script>alert(\"{$text['errors']['self']}\")</script>";
						break;
					case 'invalid':
						echo "<script>alert(\"{$text['errors']['invalid']}\")</script>";
						break;
					case 'conn':
						echo "<script>alert(\"{$text['errors']['conn']}\")</script>";
						break;
					case 'unknown':
						echo "<script>alert(\"{$text['errors']['unknown']}\")</script>";
						break;
					case 'time':
						echo "<script>alert(\"{$text['errors']['time']}\")</script>";
						break;
				}
			}

			$sql = "SELECT `accountlist`.`id`, `user`, `token`, `crushbox`, `first`, `second`, `third`, `points` FROM `accountlist` JOIN `data` ON `accountlist`.`id`=`data`.`id` WHERE `user` IN(?, ?)";

			$stmt = $dbh->stmt_init();
			$stmt->prepare($sql);
			$stmt->bind_param("ss", $_GET['name'], $_user);
			$stmt->execute();

			$data = $stmt->get_result();

			if(!$data->num_rows)
			{
				if(isset($_SESSION['last']))
					$_SESSION['this'] = $_SESSION['last'];
				else
					unset($_SESSION['this']);

				$_SESSION['redirect'] = URL;
				header("Location: ./login");
				exit();
			}

			$self = isset($_user) && $data->num_rows == 1;

			if($self)
				$row = $data->fetch_assoc();
			else {
				do
					$row = $data->fetch_assoc();
				while(strtolower($row['user']) != strtolower($_GET['name']));

				$_SESSION['username'] = array('name'=>strtolower($row['user']));
			}

			$crushsum = isset($row['first']) + isset($row['second']) + isset($row['third']);

			require_once 'instagram/user.inc.php';

			if($self)
			{
				if(!isset($_SESSION['instauser']))
					$_SESSION['instauser'] = instauser($row['token']);

				$instauser = $_SESSION['instauser'];

				if(isset($_GET['name']) && strtolower($_GET['name']) != strtolower($_user))
					echo "<script>alert('".$text['found']."')</script>";
			} else
				$instauser = instauser($row['token']);

			if(isset($row['token']))
			{
				include_once 'instagram/agents.inc.php';
				$curl = curl_init("https://www.instagram.com/$instauser/?__a=1");

				curl_setopt($curl, CURLOPT_HTTPGET, true);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($curl, CURLOPT_USERAGENT, $agents[array_rand($agents)]);

				$result = json_decode(curl_exec($curl), true);
				curl_close($curl);

				if(isset($result['graphql']))
				{
					$followers = $result['graphql']['user']['edge_followed_by']['count'];
					$following = $result['graphql']['user']['edge_follow']['count'];
				} else
					$followers = $following = "n/d";
			} else
				$followers = $following = $self ? "<a rel=\"external\" href=\"".API."\" rel=\"external\" draggable=\"false\">n/d</a>"
												: "n/d";
		?>

		<link rel="stylesheet" href="<?=HTTP?>style/pages/profile.css" type="text/css" media="all">

		<script>
			function ratio() {
				if(innerWidth / innerHeight < 11 / 32)
					document.getElementById("search").style.display = "none";
				else
					document.getElementById("search").style.display = "block";
			}

			function display() {
				for(typed of document.getElementsByClassName('typed'))
					typed.style.right = "8.5rem";

				theme.style.marginRight = "7rem";
				drag.style.marginRight = "7rem";

				addEventListener("resize", ratio);
				ratio();
			}
		</script>
	</head>

	<body>
<?php include_once 'header.php'?>

		<h1><?=$text['title']?></h1>

		<?=$self ? "<img id=\"border\" src=\"".HTTP."img/settings.b.png\" alt=\"".$text['alt1']."' draggable=\"false\" />
		<img id=\"settings\" src=\"".HTTP."img/settings.a.png\" alt=\"".$text['alt1']."\" onclick=\"location.href='".HTTP."profile/settings'\" draggable=\"false\" />
		<script>display()</script>" : ''?>


		<div id="main">
			<div>
				<div id="circle"></div>
				<?php
					if(isset($row['crushbox']) && strtotime($row['crushbox']) > time())
						echo "<script>circle.style.left=\"68%\"</script>";
				?>
				<div class="sub" onclick="<?=$self ? "location.href='".HTTP."profile/crushbox'" : "alert('".$text['errors']['crushbox']."')"?>">
					<div>Crushbox</div>
					<span><?=$crushsum?></span>
				</div>

				<div class="sub" onclick="<?=$self ? "alert('".$text['errors']['self']."')" : (isset($_SESSION['id']) ? "location.href='".HTTP."profile/point.php?redirect=profile&user=".$row['user']."'" : "alert('".$text['errors']['login']."')")?>">
					<div><?=$text['points']?></div>
					<span><?=$row['points']?></span>
				</div>
			</div>

			<img src="<?=HTTP . "avatars/" . (glob(ROOT . "avatars/" . substr(md5($row['id']), 10, 12) . ".*") ? basename(glob(ROOT . "avatars/" . substr(md5($row['id']), 10, 12) . ".*")[0]) : "null.null")?>" alt="<?=$text['alt2']?>" onclick="location.href='<?=HTTP.strtolower($row['user'])?>'" draggable="false" />

			<div>
				<div class="sub">
					<div><?=$text['followers']?></div>
					<span><?=$followers?></span>
				</div>

				<div class="sub">
					<div><?=$text['following']?></div>
					<span><?=$following?></span>
				</div>
			</div>
		</div>

		<div id="profile">
			<div><?=$row["user"]?></div><br />
			<?=$instauser ? "<span>@".$instauser."</span>" : ''?>
		</div>

<?php include_once 'footer.php'?>
