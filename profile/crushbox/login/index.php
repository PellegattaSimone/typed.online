<?php require_once 'defines.inc.php'?>
<!DOCTYPE html>
<html lang="<?=$lang?>">
	<head>
		<?php
			if(!isset($_SESSION['login']))
				header("Location: data.php");

			require_once 'style.inc.php';

			if(isset($_GET['crushbox']))
				switch($_GET['crushbox'])
				{
					case 'empty':
						$result = $empty;
						break;
					case 'pwd':
						$result = $text['login']['pwd'];
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
		<link rel="stylesheet" href="<?=HTTP?>style/pages/password.css" type="text/css" media="all">

		<script>
<?php include_once 'password.inc.php'?>
		</script>
	</head>

	<body>
<?php include_once 'header.php'?>

		<h1><?=$text['title']?></h1>

		<div id="login">
			<p><?=$text['expire1'] . $_SESSION['expire'] . $text['expire2']?></p>

			<form method="POST" action="login/login.php">
				<input value="Crushbox" disabled hidden />
				<input type="password" name="pwd" placeholder="<?=$text['password']?>" minlength="4" maxlength="255" autofocus required /><img id="show" src="<?=HTTP?>img/visible.png" alt="<?=$show?>" draggable="false" onclick="password()" />
				<span class="result common"><?=isset($result) ? $result : ''?></span><br />

				<button type="submit" name="check"><?=$text['join']?> Crushbox</button>
			</form>
		</div>

<?php include_once 'footer.php'?>
