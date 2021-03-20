<?php require_once 'defines.inc.php'?>
<!DOCTYPE html>
<html lang="<?=$lang?>">
	<head>
		<?php
			require_once 'style.inc.php';

			if(isset($_SESSION['instauser']))
				$sql = "SELECT `points`, `description` FROM `data` WHERE `id`=".$_SESSION['id'];
			else
				$sql = "SELECT `token`, `points`, `description` FROM `accountlist` JOIN `data` ON `accountlist`.`id`=`data`.`id` WHERE `accountlist`.`id`=".$_SESSION['id'];

			$stmt = $dbh->stmt_init();
			$stmt->prepare($sql);
			$stmt->execute();

			$row = $stmt->get_result()->fetch_assoc();

			if(!isset($_SESSION['instauser']))
			{
				require_once 'instagram/user.inc.php';
				$_SESSION['instauser'] = instauser($row['token']);
			}

			if($_SESSION['instauser'])
			{
				include_once '../description.inc.php';
				$bio = description($row['description'], $_SESSION['id'], $_user, $_SESSION['instauser'], $row['points']);
			} else
				$bio = -2;

			if(!isset($_SESSION['rand']))
				$_SESSION['rand'] = array(rand(3000000, 4500000), rand(7, 11));

			$formatter = new NumberFormatter($lang, NumberFormatter::ORDINAL);
			$position = $formatter->format(round($_SESSION['rand'][0] / ($row['points'] + $_SESSION['rand'][1])) + 1);

			$link = bin2hex(openssl_encrypt(str_pad($_SESSION['id'], 8, $_user, STR_PAD_RIGHT), "rc4", getenv("SOFT"), OPENSSL_RAW_DATA));
		?>

		<link rel="stylesheet" href="<?=HTTP?>style/section.css" type="text/css" media="all">
		<link rel="stylesheet" href="<?=HTTP?>style/pages/points.css" type="text/css" media="all">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inconsolata" media="all">

		<script>
			function copy(pos)
			{
				var input = document.querySelectorAll("p input")[pos];

				input.select();
				document.execCommand('copy');

				input.selectionStart = input.selectionEnd;
				input.blur();

				setTimeout(function() {
					alert("<?=$text['copy']?>");
				}, 10);
			}

			var hide = 0;

			function description() {
				hide = !hide;

				<?=$bio >= 0 ? "check.innerHTML = hide ? \"".$text['biography']['see']."\" : \"".$text['biography']['hide']."\";" : ''?>
				bio.querySelector("div").style.height = hide ? 0 : "calc(" + bio.querySelector("div p").clientHeight + "px + 3rem)";
			}

			onload = description;
		</script>
	</head>

	<body>
<?php include_once 'header.php'?>

		<h1><?=$text['title']?></h1>

		<section>
			<h2><?=$text['gain']['title']?></h2>

			<p>
				<?=$text['gain']['gain']?>:
			</p>

			<ul>
				<li>
					+1 <?=$text['gain']['1']?>

				</li>
				<li>
					+10 <?=$text['gain']['10']?>

				</li>
				<li>
					+20 <?=$text['gain']['20']?>

				</li>
				<li>
					+30 <?=$text['gain']['30']?>

				</li>
				<li onclick="window.scrollTo({top: scrollY + share.getBoundingClientRect().top - document.querySelector('header').offsetHeight, behavior: 'smooth'})">
					+400 <?=$text['gain']['400']?>

				</li>
				<li onclick="window.scrollTo({top: scrollY + bio.getBoundingClientRect().top - document.querySelector('header').offsetHeight, behavior: 'smooth'})">
					+1000 <?=$text['gain']['1000']?>

				</li>
			</ul>
		</section>

		<section>
			<h2><?=$text['gifts']['title']?></h2>

			<p>
				<?=$text['gifts']['give']?>.
			</p>

			<p>
				<?=$text['gifts']['lose']?>.
			</p>
		</section>

		<section>
			<h2><?=$text['you']['title']?></h2>

			<p>
				<?=$text['you']['points1']?> <?=$row['points']?> <?=$text['you']['points2']?>.
			</p>

			<p>
				<?=$text['you']['position1']?> <?=$position?> <?=$text['you']['position2']?>.
			</p>
		</section>

		<section id="share">
			<h2><?=$text['share']['title']?></h2>

			<p>
				<?=$text['share']['rules']?>.
			</p>

			<p >
				<input type="text" value="<?="typed.online/signup/" . $link?>" readonly onclick="copy(0)" /> (<?=$text['share']['copy']?>)
			</p>

			<p>
				<?=$text['share']['note']?>.
			</p>
		</section>

		<section id="bio">
			<h2><?=$text['biography']['title']?></h2>

			<p>
				<?=$text['biography']['link1']?> <input type="text" value="typed.online/<?=strtolower($_user)?>" readonly onclick="copy(1)" style="width:<?=14+strlen($_user)?>ch" /> <?=$text['biography']['link2']?>.
			</p>

			<p>
				<?php
					switch((int)$bio)
					{
						case -2:
							echo $text['instagram']['link1'] . " <a rel=\"external\" href=\"".API."\">$here</a> " . $text['instagram']['link2'] . '.';
							break;
						case -1:
							echo $text['instagram']['conn'] . '.';
							break;
						case 0:
							echo $text['instagram']['none'] . '!';
							break;
						case 1:
							echo $text['instagram']['done'] . '.';
							break;
					}
				?>
			</p>

			<p>
				<button onclick="location.reload(true);"><?=$text['biography']['check']?></button>

				<?=$bio >= 0 ? "<button id=\"check\" onclick=\"description()\"></button>" : ''?>
			</p>

			<div><p><?=$row['description'] ? $row['description'] : $text['biography']['empty'].'.'?></p></div>

			<p>
				<?=$text['biography']['note']?>.
			</p>
		</section>

<?php include_once 'footer.php'?>
