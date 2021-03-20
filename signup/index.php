<?php require_once 'defines.inc.php'?>
<!DOCTYPE html>
<html lang="<?=$lang?>">
	<head>
		<?php
			if(isset($_SESSION['post']))
			{
				$post = $_SESSION['post'];

				if($post === false)
					$alert = true;
			}

			if(isset($_GET['instagram']))
			{
				if(empty($_SESSION['instagram']))
				{
					header("Location: ../signup");
					exit();
				}
			} elseif(isset($_SESSION['instagram']))
			{
				require_once 'head.inc.php';
				head(HTTP."instagram/signup".(empty($_SERVER['QUERY_STRING']) || isset($_GET['point']) ? '' : "?".$_SERVER['QUERY_STRING']), isset($post) ? $post : array());

			} elseif(isset($_SESSION['id']))
			{
				unset($_SESSION['post']);

				header("Location: .?login");
				exit();
			}

			require_once 'style.inc.php';

			if(isset($_GET['signup']))
				switch($_GET['signup'])
				{
					case 'spam':
						$result['email'] = $text['errors']['spam'];
						break;
					case 'userempty':
						$result['user'] = $empty;
						break;
					case 'emailempty':
						$result['email'] = $empty;
						break;
					case 'invalidemail':
						$result['email'] = $text['errors']['invalidemail'];
						break;
					case 'invaliduser':
						$result['user'] = $text['errors']['invaliduser'];
						break;
					case 'conn':
						$result['user'] = $conn;
						break;
					case 'unknown':
						$result['user'] = $unknown;
						break;
					case 'user':
						$result['user'] = $text['errors']['user'];
						break;
					case 'email':
						$result['email'] = $text['errors']['email'];
						break;
					case 'send':
						$result['email'] = $text['errors']['send'];
						break;
				}
			elseif(isset($_GET['point']) && preg_match('/^[a-z0-9]{16}$/', $_GET['point']))
			{
				$_SESSION['point'] = (int)openssl_decrypt(hex2bin($_GET['point']), "rc4", getenv("SOFT"), OPENSSL_RAW_DATA);

				if(!is_numeric($_SESSION['point']))
					unset($_SESSION['point']);
			}

			if(isset($_SESSION['point']))
			{
				$sql = "SELECT `user` FROM `accountlist` WHERE `id`=".$_SESSION['point'];

				$stmt = $dbh->stmt_init();
				$stmt->prepare($sql);
				$stmt->execute();

				$point = $stmt->get_result()->fetch_assoc();
			}
		?>

		<link rel="stylesheet" href="<?=HTTP?>style/result.css" type="text/css" media="all">
	</head>

	<body>
<?php include_once 'header.php'?>

		<h1> <?=$text['title']?></h1>

		<p><?=$text['confirm']?>.</p>

		<?=isset($point) ? "<p>".$point['user'].' '.$text['point']."!</p>" : ''?>

		<form method="POST" action="<?=isset($_SESSION['instagram']) || isset($_GET['point']) ? "../" : ''?>signup/signup.php">
			<?=isset($_GET['instagram']) ? '<span id="link">'.$text['link'].'</span><a href="./unset.php?signup" id="instagram">'.$_SESSION['instagram']['user'].'</a><br />' : ''?>

			<input type="text" name="user" placeholder="<?=$text['user']?>" <?=isset($post['user']) ? 'value="'.$post['user'].'" ' : ''?>minlength="3" maxlength="30" pattern="[A-Za-z][A-Za-z0-9._]{2,29}" autofocus required oninput="setCustomValidity(this.validity.patternMismatch?'<?=$validity?>':'')" />
			<span class="result common"><?=isset($result['user']) ? $result['user'] : ''?></span><br />

			<input type="email" name="email" placeholder="Email" <?=isset($post['email']) ? 'value="'.$post['email'].'" ' : ''?>minlength="6" maxlength="254" required />
			<span class="result common"><?=isset($result['email']) ? $result['email'] : ''?></span><br />

			<button type="submit" name="check"><?=$text['signup']?></button>

			<div id="redirect">
				<?=$text['register']?> <a href="<?=HTTP?>login" draggable="false"><?=$text['login']?></a>!
			</div>
		</form>

<?php include_once 'footer.php'?>
