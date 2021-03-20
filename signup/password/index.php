<?php require_once 'defines.inc.php'?>
<!DOCTYPE html>
<html lang="<?=$lang?>">
	<head>
		<?php
			$page = "verify";
			require_once 'style.inc.php';

			if(isset($_GET['token']))
			{
				$token = $_GET['token'];
				if($token[0] == 'r' || $token[0] == 's')
				{
					$recover = $token[0] == 'r';
					$id = substr($token, 41);

					try {
						if($recover)
							$sql = "SELECT `hash`, `email`, `expire` FROM `update` WHERE `id`=?";
						else
							$sql = "SELECT `hash`, `email`, `expire`, `user`, `instagram`, `token`, `point` FROM `update` WHERE `id`=?";

						$stmt = $dbh->stmt_init();
						$stmt->prepare($sql);
						$stmt->bind_param("s", $id);
						$stmt->execute();

						$row = $stmt->get_result()->fetch_assoc();

						if($row !== NULL && password_verify(substr($token, 0, 41), $row['hash']))
						{
							unset($row['hash']);

							if(strtotime($row['expire']) > time())
								$_SESSION['data'] = ($recover ? $row['email'] : $row);
							else {
								$error = $text['errors']['expired'];

								include_once 'expired.inc.php';
								expired($dbh, $row['email']);
							}
						} else
							$error = $text['errors']['invalid'];

					} catch (mysqli_sql_exception $exception) {

						$driver->logexc($exception, E_WARNING);

						switch($exception->getTrace()[0]['function'])
						{
							case 'prepare':
								$error = $conn;
								break;
							default:
								$error = $unknown;
								break;
						}
					}

					if(isset($_SESSION['check']))
					{
						$alert = true;
						$error = $text['errors']['check'];

					} elseif(isset($_GET['verify']))
						switch($_GET['verify'])
						{
							case 'empty':
								$result = $empty;
								break;
							case 'length':
								$result = $text['errors']['length'];
								break;
							case 'pwd':
								$result = $text['errors']['pwd'];
								break;
							case 'conn':
								$result = $conn;
								break;
							case 'unknown':
								$result = $unknown;
								break;
						}
				} else
					$error = $text['errors']['invalid'];
			} else {
				$alert = true;
				$error = $text['errors']['check'];
			}
		?>
		<link rel="stylesheet" href="<?=HTTP?>style/result.css" type="text/css" media="all">

		<script>
<?php include_once 'password.inc.php'?>
		</script>
	</head>
	<body>
<?php include_once 'header.php'?>

		<h1><?=$text['title']?></h1>

		<?php
			if(isset($error))
				echo "<h3>$error</h3>";
			else {
				echo '<h3>'.$row['email']?></h3>

				<form method="POST" action="<?=$recover ? "update" : "confirm"?>.php?token=<?=$token?>">
					<?=isset($_SESSION['instagram']) ? '<span id="link">'.$text['link'].'</span><span id="instagram">'.$_SESSION['instagram']['user'].'</span><br />' : ''?>

					<input type="password" name="pwd" placeholder="<?=$text['pwd']?>" autocomplete="new-password" minlength="8" maxlength="255" autofocus required /><img id="show" src="<?=HTTP?>img/visible.png" alt="<?=$show?>" draggable="false" onclick="password()" />
					<span class="result common"><?=isset($result) ? $result : ''?></span><br />

					<input type="password" name="pwd2" placeholder="<?=$text['pwd2']?>" autocomplete="new-password" minlength="8" maxlength="255" required /><br />

					<button type="submit" name="check"><?=$text['update']?></button>
				</form><?php
			}
		?>

<?php include_once 'footer.php'?>
