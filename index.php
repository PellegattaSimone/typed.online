<?php require_once 'defines.inc.php'?>
<!DOCTYPE html>
<html lang="<?=$lang?>">
	<head>
		<?php
			require_once 'style.inc.php';

			if(isset($_SESSION['error']) && $_SESSION['error'] !== 2)
				$result = $_SESSION['error'] ? $unknown : $conn;
			elseif(!empty($_GET))
			{
				if(isset($_GET['login']))
				{
					$result = $text['results']['login'];
					if(isset($_SESSION['post']))
						echo "<script>alert('".$text['congratulations']."! ".$_SESSION['post'].' '.$text['match']."')</script>";
				}

				elseif(isset($_GET['signup']))
					$result = $text['results']['signup'];

				elseif(isset($_GET['logout']))
					$result = $text['results']['logout'];

				elseif(isset($_GET['email']))
					$result = $text['results']['email'];

				elseif(isset($_GET['instagram']))
					switch($_GET['instagram'])
					{
						case 'short':
						case 'long':
						case 'user':
							$result = $text['results']['instagram'];
							break;
						case 'conn':
							$result = $conn;
							break;
						case 'unknown':
							$result = $unknown;
							break;
						case 'taken':
							$result = $text['results']['taken'];
							break;
					}
				elseif(isset($_GET['error']))
				{
					switch($_GET['error'])
					{
						case '400':
							$result = $text['errors']['400'];
							break;
						case '401':
							$result = $text['errors']['401'];
							break;
						case '403':
							$result = $text['errors']['403'];
							break;
						case '404':
							$result = $text['errors']['404'];
							break;
						case '409':
							$result = $text['errors']['409'];
							break;
						case '500':
							$result = $text['errors']['500'];
							break;
						case '501':
							$result = $text['errors']['501'];
							break;
						case '502':
							$result = $text['errors']['502'];
							break;
						case '503':
							$result = $text['errors']['503'];
							break;
						case '504':
							$result = $text['errors']['504'];
							break;
					}

					if(isset($result))
						http_response_code($_GET['error']);
				}
			}
		?>

		<link rel="stylesheet" href="<?=HTTP?>style/pages/index.css" type="text/css" media="all">
	</head>

	<body>
<?php include_once 'header.php'?>

		<h1><?=$text['title']?></h1>

		<p><?=$description?></p>

		<?=isset($result) ? "<h3>$result</h3>" : ''?>

		<p id="user"><?=isset($_SESSION['id']) ? $text['logged'] . " <a href=\"profile\">" . $_user . '</a>' : $text['not-logged']?></p>

		<div id="action">
<?php
	if(isset($_SESSION['id']))
	{
		?>			<form method="POST" action="logout.php">
				<button type="submit" name="check"><?=$text['logout']?></button>
			</form>
		<?php
	} else {
		?>

			<button onclick="location.href='signup'"><?=$text['signup']?></button>
			<button onclick="location.href='login'"><?=$text['login']?></button><br />
			<button id="instagram" rel="external" onclick="location.href='<?=API?>'">Instagram</button>
		<?php
	}
?></div>

<?php include_once 'footer.php'?>
