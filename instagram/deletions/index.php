<?php require_once 'defines.inc.php'?>
<!DOCTYPE html>
<html lang="<?=$lang?>">
	<head>
		<?php
			if(isset($_GET['code']))
			{
				$file = $_GET['code'].".txt";

				if(file_exists($file))
					if($resource = fopen($file, 'r'))
						$ok = true;
					else
						trigger_error("Unable to open file: $file", E_USER_WARNING);
			}

			if(!isset($ok)) {
					header("Location: " . HTTP . "?error=404");
					exit();
			}

			require_once 'style.inc.php';
		?>

		<link rel="stylesheet" href="<?=HTTP?>style/pages/deletions.css" type="text/css" media="all">

		<meta name="robots" content="noindex">
	</head>

	<body>
<?php include_once 'header.php'?>

		<h1><?=$text['title']?></h1>

		<div>
			<?php
				$data = array("user", "email", "link", "deletion", "source");

				for($n = 1; $row = trim(fgets($resource)); $n++) {
					echo $text[$data[$n - 1]] . ": <b>" . $row . "</b><br />\n\t\t\t";

					if($n == count($data))
					{
						$row = fgets($resource);
						echo "<hr /><br />\n\t\t\t";
						$n = 0;
					}
				};
			?>

		</div>

<?php include_once 'footer.php'?>
