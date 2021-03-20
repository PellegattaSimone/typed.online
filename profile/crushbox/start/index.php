<?php require_once 'defines.inc.php'?>
<!DOCTYPE html>
<html lang="<?=$lang?>">
	<head>
		<?php
			require_once 'style.inc.php';

			if(isset($_POST['check']))
			{
				$_SESSION['start'] = true;
				echo "<script>history.replaceState(null, null)</script>";
			}

			if(isset($_SESSION['start']))
				if($_SESSION['start'] && isset($_SESSION['expire']))
				{
					try {
						$sql = "SELECT `crushbox` FROM `data` WHERE `id`=?";

						$stmt = $dbh->stmt_init();
						$stmt->prepare($sql);
						$stmt->bind_param("i", $_SESSION['id']);
						$stmt->execute();

						$data = $stmt->get_result();

						if($data->num_rows && strtotime($data->fetch_assoc()['crushbox']) > time())
							$ok = true;

					} catch (mysqli_sql_exception $exception) {
						$driver->logexc($exception);
					}
				} else {
					$ok = true;
					$_SESSION['last'] = HTTP . 'profile';
				}

			if(!isset($ok)) {
				header("Location: data.php");
				exit();
			}

			if(isset($_GET['start']))
			{
				switch($_GET['start'])
				{
					case 'empty':
						$result = $empty;
						break;
					case 'length':
						$result = $text['start']['length'];
						break;
					case 'pwd':
						$result = $text['start']['pwd'];
						break;
					case 'conn':
						$result = $conn;
						break;
					case 'unknown':
						$result = $unknown;
						break;
				}
			}
		?>

		<link rel="stylesheet" href="<?=HTTP?>style/result.css" type="text/css" media="all">
		<link rel="stylesheet" href="<?=HTTP?>style/switch.css" type="text/css" media="all">
		<link rel="stylesheet" href="<?=HTTP?>style/section.css" type="text/css" media="all">
		<link rel="stylesheet" href="<?=HTTP?>style/pages/start.css" type="text/css" media="all">

		<script>
			function hideForm()
			{
				document.querySelector("label[for]").innerHTML = hide.checked == true ? "<?=$text['not-pwd']?>" : "<?=$text['pwd']?>";
				start.style.display = hide.checked == true ? "inline-block" : "none";
				document.getElementsByTagName("form")[3].style.display = hide.checked == true ? "none" : "block";
			}

<?php include_once 'password.inc.php'?>
		</script>
	</head>

	<body>
<?php include_once 'header.php'?>

		<h1><?=$text['title']?></h1>

		<section>
			<h2><?=$text['welcome']['title']?>!</h2>

			<p>
				<?=$text['welcome']['first']?>.
			</p>
			<p>
				<?=$text['welcome']['second']?>.
			</p>
			<p>
				<?=$text['welcome']['third']?>...
			</p>
			<p>
				<?=$text['welcome']['fourth']?>!
			</p>
		</section>

		<section>
			<h2><?=$text['rules']['title']?></h2>

			<ol>
				<li>
					<?=$text['rules']['first']?>
				</li>
				<li>
					<?=$text['rules']['second']?>
				</li>
				<li>
					<?=$text['rules']['third']?>
				</li>
				<li>
					<?=$text['rules']['fourth'] . $_SESSION['expire'] . $text['rules']['fifth']?>!
				</li>
			</ol>
		</section>

		<section>
			<h2><?=$text['pwd']?>:</h2>

			<form method="POST" action="start/start.php">
				<span class="switch">
					<label>
						<input id="hide" type="checkbox" name="hide" onclick="hideForm()" />
						<span class="slider"></span>
					</label>
					<label for="hide"><?=$text['pwd']?></label>
				</span><br />
				<button id="start" type="submit" name="check" style="display:none"><?=$text['not-set']?></button>
			</form>

			<form method="POST" action="start/start.php">
				<input value="Crushbox" disabled hidden />

				<input type="password" name="pwd" placeholder="<?=$text['password']?>" autocomplete="new-password" minlength="4" maxlength="255" required /><img id="show" src="<?=HTTP?>img/visible.png" alt="<?=$show?>" draggable="false" onclick="password()" />
				<span class="result common"><?=isset($result) ? $result : ''?></span><br />

				<input type="password" name="pwd2" placeholder="<?=$text['repeat']?>" autocomplete="new-password" minlength="4" maxlength="255" required /><br />

				<button type="submit" name="check"><?=$text['set']?></button>
			</form>
		</section>

<?php include_once 'footer.php'?>
