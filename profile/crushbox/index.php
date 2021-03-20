<?php require_once 'defines.inc.php'?>
<!DOCTYPE html>
<html lang="<?=$lang?>">
	<head>
		<title>CrushBox</title>

		<?php
			if(isset($_SESSION['expire']))
			{
				$sql = "SELECT `crushbox`, `first`, `firstdate`, `second`, `seconddate`, `third`, `thirddate`, `match` FROM `data` WHERE `id`=".$_SESSION['id'];

				$stmt = $dbh->stmt_init();
				$stmt->prepare($sql);
				$stmt->execute();

				$data = $stmt->get_result()->fetch_assoc();
				if($data !== NULL)
					if(strtotime($data['crushbox']) > time())
					{
						$sql = "SELECT `id`, `user` FROM `accountlist` WHERE `id` IN (?, ?, ?, ?)";

						$stmt = $dbh->stmt_init();
						$stmt->prepare($sql);
						$stmt->bind_param("iiii", $data['first'], $data['second'], $data['third'], $data['match']);
						$stmt->execute();

						$all = $stmt->get_result();
						$_SESSION['crush'] = array(false, false, false);

						while(($row = $all->fetch_assoc()) !== NULL)
						{
							if($data['first'] == $row['id'])
								$_SESSION['crush'][0] = $row['user'];
							elseif($data['second'] == $row['id'])
								$_SESSION['crush'][1] = $row['user'];
							elseif($data['third'] == $row['id'])
								$_SESSION['crush'][2] = $row['user'];

							if($data['match'] === $row['id'])
								$_SESSION['match'] = $row['user'];
						}

						$match = isset($_SESSION['match']) && !isset($_SESSION['nomatch']);
						$_SESSION['date'] = array();

						$_SESSION['date'][0] = $data['firstdate'];
						$_SESSION['date'][1] = $data['seconddate'];
						$_SESSION['date'][2] = $data['thirddate'];

						if($match)
							$sql = "UPDATE `data` SET `match`=NULL WHERE `id`=?";
						else
							$sql = "SELECT COUNT(`id`) FROM `data` WHERE ? IN (`first`, `second`, `third`)";

						$stmt = $dbh->stmt_init();
						$stmt->prepare($sql);
						$stmt->bind_param("i", $_SESSION['id']);
						$stmt->execute();

						if(!$match)
							$count = $stmt->get_result()->fetch_row()[0];
					} else
						header("Location: crushbox/data.php");
			} else
				header("Location: crushbox/data.php");

			if(!isset($all))
				exit();

			require_once 'style.inc.php';

			$_SESSION['last'] = HTTP . 'profile';

			if(isset($_SESSION['post']))
			{
				$post = $_SESSION['post'];

				if($post === false)
					$alert = true;
			}

			if(isset($_GET['crushbox']))
				switch($_GET['crushbox'])
				{
					case 'success':
						$result = "<span class=\"success\">{$text['errors']['success']}</span>";
						break;
					case 'start':
						$result = "<span class=\"success\">{$text['errors']['start']}</span>";
						break;
					case 'login':
						$result = "<span class=\"success\">{$text['errors']['login']}</span>";
						break;
					case 'self':
						$result = $text['errors']['self'];
						break;
					case 'twice':
						$result = $text['errors']['twice'];
						break;
					case 'length':
						$result = $text['errors']['length'];
						break;
					case 'conn':
						$result = $conn;
						break;
					case 'unknown':
						$result = $unknown;
						break;
					case 'first':
						$result = $text['errors']['first'];
						break;
					case 'second':
						$result = $text['errors']['second'];
						break;
					case 'third':
						$result = $text['errors']['third'];
						break;
				}
		?>

		<link rel="stylesheet" href="<?=HTTP?>style/result.css" type="text/css" media="all">
		<link rel="stylesheet" href="<?=HTTP?>style/pages/crushbox.css" type="text/css" media="all">

		<script>
			var hide = 0;

			function show()
			{
				inputs = document.getElementsByTagName("input");

				if(!hide) add.style.display="none";

				if(hide)
				{
					inputs[3].style.display = "none";

					inputs[2].style.display = hide - 1 ? "none" : "inline-block";
				} else
					inputs[3].style.display = "inline-block";
			}

			onload = show;
		</script>
	</head>

	<body>
<?php include_once 'header.php'?>

		<h1><?=$text['title']?></h1>

		<?=$match ? "<h4>".$text['congratulations']."! <a href=\"../{$_SESSION['match']}/profile\">".$_SESSION['match']."</a> ".$text['match']."</h4>" : ($count ? "<h4>".$text['added'].$count.($count==1?$text['person']:$text['people'])."</h4>" : '')?>

		<form method="POST" action="crushbox/crushbox.php">
			<input type="text" name="first" minlength="3" maxlength="30" placeholder="<?=$text['first']?>" pattern="[A-Za-z][A-Za-z0-9._]{2,29}" oninput="setCustomValidity(this.validity.patternMismatch?'<?=$validity . "':'')\"" . ($_SESSION['crush'][0] || isset($post['first']) ? ' value="' . (isset($post['first']) ? $post['first'] : $_SESSION['crush'][0]) . '"' . (strtotime("+10 day", strtotime($_SESSION['date'][0])) > time() && $_SESSION['date'][0] != TODAY ? ' readonly' : '') : '')?> /><br />

			<input type="text" name="second" minlength="3" maxlength="30" placeholder="<?=$text['second']?>" pattern="[A-Za-z][A-Za-z0-9._]{2,29}" oninput="setCustomValidity(this.validity.patternMismatch?'<?=$validity . "':'')\"" . ($_SESSION['crush'][1] || isset($post['second']) ? ' value="' . (isset($post['second']) ? $post['second'] : $_SESSION['crush'][1]) . '"' . (strtotime("+10 day", strtotime($_SESSION['date'][1])) > time() && $_SESSION['date'][1] != TODAY ? ' readonly' : '') . ' />' : " /><script>hide++</script>")?><br />

			<input type="text" name="third" minlength="3" maxlength="30" placeholder="<?=$text['third']?>" pattern="[A-Za-z][A-Za-z0-9._]{2,29}" oninput="setCustomValidity(this.validity.patternMismatch?'<?=$validity . "':'')\"" . ($_SESSION['crush'][2] || isset($post['third']) ? ' value="' . (isset($post['third']) ? $post['third'] : $_SESSION['crush'][2]) . '"' . (strtotime("+10 day", strtotime($_SESSION['date'][2])) > time() && $_SESSION['date'][2] != TODAY ? ' readonly' : '') . ' />' : " /><script>hide++</script>")?><br />

			<div id="number">
				<p><label for="expire"><?=$text['expire']?></label></p>
				<input id="expire" type="number" name="expire" value="<?=$_SESSION['expire']?>" min="5" max="180" /><br />
				<button type="button" onclick="location.href='crushbox/logout.php'"><?=$text['logout']?></button>
			</div>

			<button id="add" type="button" onclick="hide--;show()"><?=$text['add']?></button>
			<div class="result"><?=isset($result) ? $result : ''?></div>

			<button type="reset" onclick="location.reload()"><?=$text['reset']?></button>

			<button type="submit" name="check"><?=$text['update']?></button>
		</form>

		<form id="rules" method="POST" action="crushbox/start">
			<button type="submit" name="check"><?=$text['tutorial']?></button>
		</form>

<?php include_once 'footer.php'?>
