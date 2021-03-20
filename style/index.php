<?php require_once 'defines.inc.php'?>
<!DOCTYPE html>
<html lang="<?=$lang?>">
	<head>
		<?php
			if(isset($_GET['redirect']))
			{
				$_SESSION['redirect'] = URL;
				header("Location: ./login");
				exit();
			}

			require_once 'style.inc.php';

			if(isset($_SESSION['check']))
				$alert = true;
			elseif(isset($_GET['style']))
				switch($_GET['style'])
				{
					case 'empty':
						$result = $empty;
						break;
					case 'green':
						$result = $text['errors']['green'];
						break;
					case 'blue':
						$result = $text['errors']['blue'];
						break;
					case 'brown':
						$result = $text['errors']['brown'];
						break;
					case 'white':
						$result = $text['errors']['white'];
						break;
					case 'black':
						$result = $text['errors']['black'];
						break;
					case 'gray':
						$result = $text['errors']['gray'];
						break;
					case 'conn':
						$result = $conn;
						break;
					case 'unknown':
						$result = $unknown;
						break;
				}
		?>

		<link rel="stylesheet" href="<?=HTTP?>style/result.css" type="text/css" media="all">
		<link rel="stylesheet" href="<?=HTTP?>style/switch.css" type="text/css" media="all">
		<link rel="stylesheet" href="<?=HTTP?>style/pages/style.css" type="text/css" media="all">
	</head>

	<body>
<?php include_once 'header.php'?>

		<h1><?=$text['title']?></h1>

		<form id="colors" method="POST" action="style/theme.php">
			<div class="result"><?=isset($result) ? $result : ''?></div>

			<span>
				<span><input id="green" type="color" name="green" /></span>
				<label for="green"><?=$text['green']?></label>
			</span>
			<span>
				<span><input id="blue" type="color" name="blue" /></span>
				<label for="blue"><?=$text['blue']?></label>
			</span><br />
			<span>
				<span><input id="brown" type="color" name="brown" /></span>
				<label for="brown"><?=$text['brown']?></label>
			</span>
			<span>
				<span><input id="white" type="color" name="white" /></span>
				<label for="white"><?=$text['white']?></label>
			</span><br />
			<span>
				<span><input id="black" type="color" name="black" /></span>
				<label for="black"><?=$text['black']?></label>
			</span>
			<span>
				<span><input id="gray" type="color" name="gray1" /></span>
				<label for="gray"><?=$text['gray']?></label>
			</span><br />

			<div class="switch">
				<label>
					<input id="keep" type="checkbox" name="keep"<?=isset($_SESSION['id']) ? '' : " disabled"?> />
					<span class="slider"></span>
				</label>
				<label for="keep"><?=$text['keep']?></label>
			</div>

			<?=isset($_SESSION['id']) ? '' : "<a href=\"?redirect\">".$text['forbidden']."</a><script>for(label of document.querySelectorAll(\".switch label\"))label.style.cursor=\"not-allowed\"</script>"?>

			<?=$_SESSION['rgb'] ? "<button type=\"button\" onclick=\"location.href='style/unset.php'\">".$text['delete']."</button>" : ''?>
			<button type="submit" name="check"><?=$text['set']?></button>
		</form>

		<script>
			for(input of document.querySelectorAll("input[type=color]"))
			{
				var color = getComputedStyle(document.body).getPropertyValue("--"+input.getAttribute("name"));
				if(color.length < 7)
					color = '#'+color[2]+color[2]+color[3]+color[3]+color[4]+color[4];

				input.value = color.trim();
			}
		</script>

<?php include_once 'footer.php'?>
