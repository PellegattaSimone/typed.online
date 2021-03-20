<?php require_once 'defines.inc.php'?>
<!DOCTYPE html>
<html lang="<?=$lang?>">
	<head>
		<?php
			require_once 'style.inc.php';

			if(isset($_SESSION['post']) && !$_SESSION['post'])
				$alert = true;
			elseif(isset($_GET['recovery']))
				switch($_GET['recovery'])
				{
					case 'spam':
						$result = $text['errors']['spam'];
						break;
					case 'empty':
						$result = $empty;
						break;
					case 'invalid':
						$result = $text['errors']['invalid'];
						break;
					case 'conn':
						$result = $conn;
						break;
					case 'unknown':
						$result = $unknown;
						break;
					case 'email':
						$result = $text['errors']['email'];
						break;
					case 'send':
						$result = $text['errors']['send'];
						break;
				}
		?>

		<link rel="stylesheet" href="<?=HTTP?>style/result.css" type="text/css" media="all">
	</head>

	<body>
<?php include_once 'header.php'?>

		<h1><?=$text['title']?></h1>

		<div>
			<p>
				<?=$text['insert']?>.
			</p>
			<p>
				<?=$text['send']?>.
			</p>
		</div>

		<form method="POST" action="recovery/send.php">
			<input id="recovery" type="email" name="email" placeholder="Email" <?=isset($_SESSION['post']) ? 'value="'.$_SESSION['post'].'" ' : ''?>minlength="6" maxlength="254" autofocus required />
			<span class="result common"><?=isset($result) ? $result : ''?></span><br />

			<button type="submit" name="check"><?=$text['recover']?></button>
		</form>

		<script>recovery.value = sessionStorage.getItem("email");sessionStorage.removeItem("email")</script>

<?php include_once 'footer.php'?>
