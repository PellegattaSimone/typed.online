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
					header("Location: ../login");
					exit();
				} elseif(isset($_SESSION['id']))
					$post['user'] = $_user;

			} elseif(isset($_SESSION['instagram']))
			{
				require_once 'head.inc.php';
				head("instagram/login".(empty($_SERVER['QUERY_STRING']) ? '' : "?".$_SERVER['QUERY_STRING']), isset($post) ? $post : array());

			} elseif(isset($_SESSION['id']))
			{
				unset($_SESSION['post']);

				if(isset($_SESSION['redirect']))
				{
					header("Location: ".$_SESSION['redirect']);
					unset($_SESSION['redirect']);
				} else
					header("Location: ..?login");
				exit();
			}

			require_once 'style.inc.php';

			unset($_SESSION['google']);

			if(isset($_GET['login']))
				switch($_GET['login'])
				{
					case 'emptyuser':
						$result['user'] = $empty;
						break;
					case 'emptypwd':
						$result['pwd'] = $empty;
						break;
					case 'invaliduser':
						$result['user'] = $text['errors']['invaliduser'];
						break;
					case 'invalidemail':
						$result['user'] = $text['errors']['invalidemail'];
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
						$result['user'] = $text['errors']['email'];
						break;
					case 'pwd':
						$result['pwd'] = $text['errors']['pwd'];
						break;
					case 'google':
						$result['google'] = $text['errors']['google'];
						break;
				}
			elseif(isset($_GET['recovery']))
				echo "<script>alert(\"{$text['recovery']}\")</script>";
			elseif(isset($post) && $post === true)
				echo "<script>alert(\"".$text['forbidden']."\")</script>";
		?>

		<link rel="stylesheet" href="<?=HTTP?>style/result.css" type="text/css" media="all">
		<link rel="stylesheet" href="<?=HTTP?>style/switch.css" type="text/css" media="all">
		<link rel="stylesheet" href="<?=HTTP?>style/pages/login.css" type="text/css" media="all">

		<script src="https://apis.google.com/js/platform.js" async defer></script>

		<script>
			onload = function() {
				gapi.load("auth2", function() {
					var auth = gapi.auth2.init({
						client_id: "<?=GOOGLE?>",
						fetch_basic_profile: false,
						scope: "email",
						cookie_policy: "none",
						ux_mode: "redirect",
						redirect_uri: "<?=HTTP?>login/google.html"
					});

					auth.attachClickHandler(google.querySelector("div"));
				});
			}

<?php include_once 'password.inc.php'?>
		</script>
	</head>

	<body>
<?php include_once 'header.php'?>

		<h1><?=$text['title']?></h1>

		<form method="POST" action="<?=isset($_SESSION['instagram']) ? "../" : ''?>login/login.php">
			<?=isset($_SESSION['instagram']) ? '<span id="link">'.$text['link'].'</span><a href="./unset.php?login" id="instagram">'.$_SESSION['instagram']['user'].'</a><br />' : ''?>

			<input type="text" name="user" placeholder="<?=$text['user']?>" <?=isset($post['user']) ? 'value="'.$post['user'].'" ' : ''?>minlength="3" maxlength="254" pattern="[A-Za-z][A-Za-z0-9._]{2,29}|[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}" autofocus required oninput="this.setCustomValidity(this.validity.patternMismatch?this.value.includes('@')?'<?=$text['validity']?>':'<?=$validity?>':'');sessionStorage.setItem('email',this.value)" />
			<span class="result common"><?=isset($result['user']) ? $result['user'] : ''?></span><br />

			<input type="password" name="pwd" placeholder="<?=$text['password']?>" minlength="8" maxlength="255" required /><img id="show" src="<?=HTTP?>img/visible.png" alt="<?=$show?>" draggable="false" onclick="password()" />
			<span class="result common"><?=isset($result['pwd']) ? $result['pwd'] : ''?></span><br />

			<div class="switch">
				<label>
					<input id="keep" type="checkbox" name="keep"<?=isset($post['keep']) ? '' : " checked" ?> />
					<span class="slider"></span>
				</label>
				<label for="keep"><?=$text['keep']?></label>
			</div>
			<button type="submit" name="check"><?=$text['login']?></button>
		</form>

		<div id="google">
			<p><?=$text['or']?></p><br />

			<div>
				<img src="<?=HTTP?>img/google.png" alt="Google" draggable="false" />
				<label><?=$text['google']?></label>
			</div>

			<span class="result label"><?=isset($result['google']) ? $result['google'] : ''?></span>
		</div>

		<div id="redirect">
			<?=$text['forgot']?>? <a href="<?=HTTP?>login/recovery" draggable="false"><?=$text['recover']?></a>!<br />
			<?=$text['register']?>? <a href="<?=HTTP?>signup" draggable="false"><?=$text['signup']?></a>!
		</div>

<?php include_once 'footer.php'?>
