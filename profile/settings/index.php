<?php require_once 'defines.inc.php'?>
<!DOCTYPE html>
<html lang="<?=$lang?>">
	<head>
		<?php
			require_once 'style.inc.php';

			if(isset($_SESSION['instauser']))
				$sql = "SELECT `privacy` FROM `accountlist` WHERE `id`=".$_SESSION['id'];
			else
				$sql = "SELECT `token`, `privacy` FROM `accountlist` WHERE `id`=".$_SESSION['id'];

			$stmt = $dbh->stmt_init();
			$stmt->prepare($sql);
			$stmt->execute();

			$row = $stmt->get_result()->fetch_assoc();
			$_SESSION['privacy'] = $row['privacy'];

			if(!isset($_SESSION['instauser']))
			{
				require_once 'instagram/user.inc.php';
				$_SESSION['instauser'] = instauser($row['token']);
			}

			if(isset($_SESSION['post']))
				$post = $_SESSION['post'];

			function scroll($scroll) {
				if(!isset($GLOBALS['scroll']))
					$GLOBALS['scroll'] = $scroll;
			}

			if(isset($_SESSION['check']))
				$alert = true;
			elseif(!empty($_GET))
			{
				if(isset($_GET['file']))
				{
					scroll(0);

					switch($_GET['file'])
					{
						case 'success':
							$result['file'] = "<span class=\"success\">{$text['file']['success']}</span>";
							break;
						case 'error':
							$result['file'] = $text['file']['error'];
							break;
						case 'size':
							$result['file'] = $text['file']['size'];
							break;
						default:
							$result['file'] = $text['file']['invalid'].$_GET['file'].$text['file']['image'];
							break;
					}
				}

				if(isset($_GET['remove']))
				{
					scroll(0);

					switch($_GET['remove'])
					{
						case 'success':
							$result['remove'] = "<span class=\"success\">{$text['remove']['success']}</span>";
							break;
						case 'empty':
							$result['remove'] = $text['remove']['empty'];
							break;
						case 'error':
							$result['remove'] = $text['remove']['error'];
							break;
					}
				}

				if(isset($_GET['user']))
				{
					scroll(1);

					switch($_GET['user'])
					{
						case 'success':
							$result['user'] = "<span class=\"success\">{$text['user']['success']}</span>";
							break;
						case 'invalid':
							$result['user'] = $text['user']['invalid'];
							break;
						case 'conn':
							$result['user'] = $conn;
							break;
						case 'unknown':
							$result['user'] = $unknown;
							break;
						case 'taken':
							$result['user'] = $text['user']['taken'];
							break;
					}
				}

				if(isset($_GET['email']))
				{
					scroll(1);

					switch($_GET['email'])
					{
						case 'success':
							$result['email'] = "<span class=\"success\">{$text['email']['success']}</span>";
							break;
						case 'pending':
							$result['email'] = "<span class=\"success\">{$text['email']['pending']}</span>";
							break;
						case 'spam':
							$result['email'] = $text['email']['spam'];
							break;
						case 'invalid':
							$result['email'] = $text['email']['invalid'];
							break;
						case 'conn':
							$result['email'] = $conn;
							break;
						case 'unknown':
							$result['email'] = $unknown;
							break;
						case 'taken':
							$result['email'] = $text['email']['taken'];
							break;
						case 'send':
							$result['email'] = $text['email']['send'];
							break;
						case 'link':
							$result['email'] = $text['email']['link'];
							break;
						case 'expired':
							$result['email'] = $text['email']['expired'];
							break;
					}
				}

				if(isset($_GET['privacy']))
				{
					scroll(1);

					switch($_GET['privacy'])
					{
						case 'success':
							$result['privacy'] = "<span class=\"success\">{$text['privacy']['success']}</span>";
							break;
						case 'conn':
							$result['privacy'] = $conn;
							break;
						case 'unknown':
							$result['privacy'] = $unknown;
							break;
					}
				}

				if(isset($_GET['unlink']))
				{
					scroll(1);

					switch($_GET['unlink'])
					{
						case 'success':
							$result['unlink'] = "<span class=\"success\" onclick=\"location.href='".HTTP."instagram/deletions/".hash("crc32", $_SESSION['id'])."'\">{$text['unlink']['success']}</span>";
							break;
						case 'nolog':
							$result['unlink'] = "<span class=\"success\">{$text['unlink']['success']}</span>";
							break;
						case 'instagram':
							$result['unlink'] = "<span class=\"success\" onclick=\"location.href='".HTTP."instagram/deletions/".hash("crc32", $_SESSION['id'])."'\">{$text['unlink']['instagram']}</span>";
							break;
						case 'conn':
							$result['unlink'] = $conn;
							break;
						case 'unknown':
							$result['unlink'] = $unknown;
							break;
					}
				}

				if(isset($_GET['old']))
				{
					scroll(2);

					switch($_GET['old'])
					{
						case 'success':
							$result['old'] = "<span class=\"success\">{$text['old']['success']}</span>";
							break;
						case 'empty':
							$result['old'] = $empty;
							break;
						case 'conn':
							$result['old'] = $conn;
							break;
						case 'unknown':
							$result['old'] = $unknown;
							break;
						case 'wrong':
							$result['old'] = $text['old']['wrong'];
							break;
					}
				}

				if(isset($_GET['pwd']))
				{
					scroll(2);

					switch($_GET['pwd'])
					{
						case 'empty':
							$result['pwd'] = $empty;
							break;
						case 'length':
							$result['pwd'] = $text['pwd']['length'];
							break;
						case 'match':
							$result['pwd'] = $text['pwd']['match'];
							break;
						case 'conn':
							$result['pwd'] = $conn;
							break;
						case 'unknown':
							$result['pwd'] = $unknown;
					}
				}
			}

			scroll(0);
		?>

		<link rel="stylesheet" href="<?=HTTP?>style/result.css" type="text/css" media="all">
		<link rel="stylesheet" href="<?=HTTP?>style/switch.css" type="text/css" media="all">
		<link rel="stylesheet" href="<?=HTTP?>style/section.css" type="text/css" media="all">
		<link rel="stylesheet" href="<?=HTTP?>style/pages/settings.css" type="text/css" media="all">

		<script>
			function public()
			{
				document.querySelector('label[for="private"]').innerHTML = private.checked ? "<?=$text['account']['public']?>" : "<?=$text['account']['private']?>";
			}

			function select() {
				scrollTo({
					top: scrollY + document.querySelectorAll("section")[<?=$scroll?>].getBoundingClientRect().top - document.querySelector("header").offsetHeight,
					behavior: "smooth"
				});
			}

<?php include_once 'password.inc.php'?>
		</script>
	</head>

	<body>
<?php include_once 'header.php'?>

		<h1><?=$text['title']?></h1>

		<form method="POST" action="settings/settings.php" enctype="multipart/form-data">
			<section>
				<h2><?=$text['avatar']['title']?></h2>

				<div id="file">
					<input type="file" name="avatar" />
					<span class="result label"><?=isset($result['file']) ? $result['file'] : ''?></span>
				</div>

				<span class="switch">
					<label>
						<input id="remove" type="checkbox" name="remove" onclick="file.style.display = this.checked ? 'none' : 'block'" />
						<span class="slider"></span>
					</label>
					<label for="remove"><?=$text['avatar']['remove']?></label>
				</span>
				<span class="result label"><?=isset($result['remove']) ? $result['remove'] : ''?></span>
			</section>

			<section>
				<h2><?=$text['account']['title']?></h2>

				<input type="text" name="user" placeholder="<?=$text['account']['user']?>" value="<?=isset($post['user']) ? $post['user'] : $_user.'" class="default'?>" autocomplete="off" minlength="3" maxlength="30" pattern="[A-Za-z][A-Za-z0-9._]{2,29}" oninput="setCustomValidity(this.validity.patternMismatch?'<?=$validity?>':'');this.classList.remove('default')" />
				<span class="result common"><?=isset($result['user']) ? $result['user'] : ''?></span><br />

				<input type="email" name="email" placeholder="<?=$text['account']['email']?>" value="<?=isset($post['email']) ? $post['email'] : $_email.'" class="default'?>" oninput="this.classList.remove('default')" />
				<span class="result common"><?=isset($result['email']) ? $result['email'] : ''?></span><br />

				<span class="switch">
					<label>
						<input id="private" type="checkbox" name="privacy" <?=$row['privacy'] ? "checked " : ''?>onclick="public()" />
						<span class="slider"></span>
					</label>
					<label for="private"></label>
					<script>public()</script>
				</span>
				<span class="result label"><?=isset($result['privacy']) ? $result['privacy'] : ''?></span><br />

				<a id="instagram" draggable="false" href="<?=$_SESSION['instauser'] ? "settings/unlink.php\">".$text['account']['unlink'].$_SESSION['instauser'] : API . "\" rel=\"external\">" . $text['account']['link']?></a>
				<span class="result label"><?=isset($result['unlink']) ? $result['unlink'] : ''?></span>
			</section>

			<section>
				<h2><?=$text['password']['title']?></h2>

				<input type="password" name="old" placeholder="<?=$text['password']['old']?>" minlength="8" maxlength="255" /><img id="show" src="<?=HTTP?>img/visible.png" alt="<?=$show?>" draggable="false" onclick="password()" />
				<span class="result common"><?=isset($result['old']) ? $result['old'] : ''?></span><br />

				<input type="password" name="pwd" placeholder="<?=$text['password']['pwd']?>" autocomplete="new-password" minlength="8" maxlength="255" />
				<span class="result common"><?=isset($result['pwd']) ? $result['pwd'] : ''?></span><br />

				<input type="password" name="pwd2" placeholder="<?=$text['password']['pwd2']?>" autocomplete="new-password" minlength="8" maxlength="255" />
			</section>

			<button type="reset" onclick="document.querySelector('[name=user]').classList.add('default');document.querySelector('[name=email]').classList.add('default');"><?=$text['reset']?></button>
			<button type="submit" name="check"><?=$text['save']?></button>
		</form>

		<script>select()</script>

<?php include_once 'footer.php'?>
