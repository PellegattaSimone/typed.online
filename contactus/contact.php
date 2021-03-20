<?php require_once 'defines.inc.php'?>
<!DOCTYPE html>
<html lang="<?=$lang?>">
	<head>
		<?php
			require_once 'style.inc.php';

			if(!isset($text))
			{
				header("Location: ..?error=404");
				exit();
			}

			if(isset($_GET[$page]))
			{
				switch($_GET[$page])
				{
					case 'success':
						$result = "<span class=\"success\">{$text['errors']['success']}</span>";
						break;
					case 'page':
						$result['page'] = $text['errors']['page'];
						break;
					case 'email':
						$result['email'] = $text['errors']['email'];
						break;
					case 'content':
						$result['content'] = $text['errors']['content'];
						break;
					case 'conn':
						$result = $conn;
						break;
					case 'unknown':
						$result = $unknown;
						break;
				}
			}

			if(isset($_SESSION['post']))
				$post = $_SESSION['post'];
		?>

		<link rel="stylesheet" href="<?=HTTP?>style/result.css" type="text/css" media="all">
		<link rel="stylesheet" href="<?=HTTP?>style/pages/contactus.css" type="text/css" media="all">

		<script>
			function link(value)
			{
				var result = document.querySelector(".common");
				switch(value)
				{
					case "0":
						result.innerHTML = "<a href='<?=HTTP?>'><img src='<?=HTTP?>img/goto.png' alt='<?=$contact['goto']?>' draggable='false' /><?=$contact['main']?></a>";
						break;
					case "1":
						result.innerHTML = "<a href='<?=HTTP?>login'><img src='<?=HTTP?>img/goto.png' alt='<?=$contact['goto']?>' draggable='false' /><?=$contact['login']?></a>";
						break;
					case "2":
						result.innerHTML = "<a href='<?=HTTP?>signup'><img src='<?=HTTP?>img/goto.png' alt='<?=$contact['goto']?>' draggable='false' /><?=$contact['signup']?></a>";
						break;
					case "3":
						result.innerHTML = "<?=isset($_SESSION['id']) ? "<a href='".HTTP.$_user."'><img src='".HTTP."img/goto.png' alt='".$contact['goto']."' draggable='false' />".$contact['user']."</a>" : $contact['logged']?>";
						break;
					case "4":
						result.innerHTML = "<?=isset($_SESSION['id']) ? "<a href='".HTTP."user/reply'><img src='".HTTP."img/goto.png' alt='".$contact['goto']."' draggable='false' />".$contact['reply']."</a>" : $contact['logged']?>";
						break;
					case "5":
						result.innerHTML = "<?=isset($_SESSION['id']) ? "<a href='".HTTP."user/types'><img src='".HTTP."img/goto.png' alt='".$contact['goto']."' draggable='false' />".$contact['types']."</a>" : $contact['logged']?>";
						break;
					case "6":
						result.innerHTML = "<?=isset($_SESSION['id']) ? "<a href='".HTTP."user/points'><img src='".HTTP."img/goto.png' alt='".$contact['goto']."' draggable='false' />".$contact['points']."</a>" : $contact['logged']?>";
						break;
					case "7":
						result.innerHTML = "<a href='<?=HTTP?>user'><img src='<?=HTTP?>img/goto.png' alt='<?=$contact['goto']?>' draggable='false' /><?=$contact['search']?></a>";
						break;
					case "8":
						result.innerHTML = "<a rel='external' href='<?=API?>'><img src='<?=HTTP?>img/goto.png' alt='<?=$contact['goto']?>' draggable='false' /><?=$contact['instagram']?></a>";
						break;
					case "9":
						result.innerHTML = "<?=isset($_SESSION['id']) ? "<a href='".HTTP."profile/crushbox'><img src='".HTTP."img/goto.png' alt='".$contact['goto']."' draggable='false' />Crushbox</a>" : $contact['logged']?>";
						break;
					case "10":
						result.innerHTML = "<?=isset($_SESSION['id']) ? "<a href='".HTTP."profile'><img src='".HTTP."img/goto.png' alt='".$contact['goto']."' draggable='false' />".$contact['profile']."</a>" : $contact['logged']?>";
						break;
					case "11":
						result.innerHTML = "<?=isset($_SESSION['id']) ? "<a href='".HTTP."profile/settings'><img src='".HTTP."img/goto.png' alt='".$contact['goto']."' draggable='false' />".$contact['settings']."</a>" : $contact['logged']?>";
						break;
					case "12":
						result.innerHTML = "<a href='<?=HTTP?>style'><img src='<?=HTTP?>img/goto.png' alt='<?=$contact['goto']?>' draggable='false' /><?=$contact['style']?></a>";
						break;
				}
			}
		</script>
	</head>

	<body>
<?php include_once 'header.php'?>

		<h1><?=$text['title']?></h1>

		<p>
			<?=$text['paragraph']?> <a href="<?=HTTP?>">Typed</a>.
		</p>
		<p>
			<?=$contact['language']?>!
		</p>

		<form method="POST" action="send.php?page=<?=$page?>">
			<div class="result"><?=empty($result) || is_array($result) ? '' : $result?></div>

			<select name="page" onchange="link(this.value)">
				<option selected disabled hidden><?=$text['page']?>? (<?=$contact['optional']?>)</option>
				<option value="0"><?=$contact['main']?></option>
				<option value="1"><?=$contact['login']?></option>
				<option value="2"><?=$contact['signup']?></option>
				<option value="3"><?=$contact['user']?></option>
				<option value="4"><?=$contact['reply']?></option>
				<option value="5"><?=$contact['types']?></option>
				<option value="6"><?=$contact['points']?></option>
				<option value="7"><?=$contact['search']?></option>
				<option value="8"><?=$contact['instagram']?></option>
				<option value="9">Crushbox</option>
				<option value="10"><?=$contact['profile']?></option>
				<option value="11"><?=$contact['settings']?></option>
				<option value="12"><?=$contact['style']?></option>
				<option value="13"><?=$contact['other']?>...</option>
			</select>
			<span class="result common"><?=isset($result['page']) ? $result['page'] : ''?></span><br />

			<?php
				if(isset($post['page']))
					echo "<script>document.getElementsByTagName(\"option\")[".($post['page']+1)."].selected=true</script>"
			?>

			<input type="email" name="email" placeholder="Email (<?=$contact['optional']?>)" value="<?=isset($post['email']) ? $post['email'] : ''?>" minlength="6" maxlength="254" />
			<span class="result common"><?=isset($result['email']) ? $result['email'] : ''?></span><br />

			<textarea name="content" placeholder="<?=$text['textarea']?>" minlength="5" maxlength="1000" required><?=isset($post['content']) ? $post['content'] : ''?></textarea>
			<span class="result content"><?=isset($result['content']) ? $result['content'] : ''?></span><br />

			<button type="submit" name="check"><?=$text['submit']?></button>
		</form>

<?php include_once 'footer.php'?>
