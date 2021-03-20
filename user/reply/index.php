<?php require_once 'defines.inc.php'?>
<!DOCTYPE html>
<html lang="<?=$lang?>">
	<head>
		<?php
			require_once 'style.inc.php';

			if(isset($_SESSION['post']))
			{
				$post = $_SESSION['post'];

				if($post === false)
					$alert = true;
			}

			$sql = "SELECT `types`.`id`, `user`, `content`, `anonymous`, `questiondate` FROM `accountlist` RIGHT JOIN `types` ON `accountlist`.`id`=`from` WHERE `to`={$_SESSION['id']} AND `answer` IS NULL ORDER BY `questiondate`";

			$stmt = $dbh->stmt_init();
			$stmt->prepare($sql);
			$stmt->execute();

			$data = $stmt->get_result();

			$_SESSION['reply'] = array();

			include_once '../time.inc.php';
		?>

		<link rel="stylesheet" href="<?=HTTP?>style/result.css" type="text/css" media="all">
		<link rel="stylesheet" href="<?=HTTP?>style/main.css" type="text/css" media="all">
		<link rel="stylesheet" href="<?=HTTP?>style/types.css" type="text/css" media="all">

		<script>
			onload = function() {
				if(document.getElementsByClassName(location.hash.substr(1)).length)
					scrollTo({
						top: scrollY + document.getElementsByClassName(location.hash.substr(1))[0].getBoundingClientRect().top - document.querySelector("header").offsetHeight,
						behavior: "smooth"
					});
			}

<?php include_once '../script.inc.php'?>
		</script>

		<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js" async defer></script>
	</head>

	<body>
<?php include_once 'header.php'?>

		<h1><?=$text['title']?></h1>

		<p><?=$text['rules']?>.</p>
		<p><?=$text['protection']?>!</p>
		<p><?=$text['edit']?> <a href="types" onclick="sessionStorage.setItem('answers', '1')"><?=$here?></a>.</p>

		<section>
	<?php
		if(isset($_GET['reply']))
			switch($delete = $_GET['reply'])
			{
				case 'success':
					echo "<div class=\"result success\">".$text['reply']['success']."</div>\n";
					if(isset($post))
					{
						include_once '../article.inc.php';
						$sql = "SELECT `user`, `content`, `answer`, `anonymous` FROM `accountlist` RIGHT JOIN `types` ON `accountlist`.`id`=`from` WHERE `types`.`id`=$post";

						$stmt = $dbh->stmt_init();
						$stmt->prepare($sql);
						$stmt->execute();

						$zoom = $stmt->get_result()->fetch_assoc();
					}
					break;
				default:
					if(is_numeric($delete))
						echo "<div id=\"dummy\" class=\"result\">".${"n$delete"} = $text['reply']['type']."</div>\n";
					break;
			}
		elseif(isset($_GET['delete']))
			switch($delete = $_GET['delete'])
			{
				case 'success':
					echo "<div class=\"result success\">".$text['delete']['success']."</div>\n";
					break;
				default:
					if(is_numeric($delete))
						echo "<div id=\"dummy\" class=\"result\">".${"n$delete"} = $text['delete']['type']."</div>\n";
					break;
			}

		if($data->num_rows)
			while(($row = $data->fetch_assoc()) !== NULL)
			{
				$id = $row['id'];
				array_push($_SESSION['reply'], $id);

				if(isset(${"n$id"})) {
					$result = ${"n$id"};
					echo "<script>dummy.style.display=\"none\"</script>\n";
				} elseif(isset($_GET[$id]))
					switch($_GET[$id])
					{
						case 'reply':
							$result = $text['reply']['type'];
							break;
						case 'delete':
							$result = $text['delete']['type'];
							break;
						case 'empty':
							$result = $empty;
							break;
						case 'length':
							$result = $text['reply']['length'];
							break;
						case 'conn':
							$result = $conn;
							break;
						case 'unknown':
							$result = $unknown;
							break;
					}
				?>
		<article class="<?=$id?>">
				<span class="user"><?=$row['anonymous'] ? $main['anonymous'] : "<a href=\"../".strtolower($row['user'])."\">".$row['user']."</a>"?></span>
				<span class="date"><span><?=($ago = timeago($row['questiondate'])) ? $times['ago'][0] : ''?> </span><?=$ago ? $ago : $times['now']?><span> <?=$ago ? $times['ago'][1] : ''?></span></span>

				<div class="question">
					<?=htmlentities($row['content'], ENT_NOQUOTES | ENT_HTML5)?>

				</div>

				<div class="reply">
					<span onclick="this.closest('article').querySelector('form').style.maxHeight=getComputedStyle(this.closest('article').querySelector('form')).maxHeight=='0px'?'35rem':'0px'"><img src="<?=HTTP?>img/reply.png" alt="<?=$text['send']?>" draggable="false" /><?=$text['send']?></span>

					<span onclick="if(confirm('<?=$text['confirm']?>.'))location.href='delete.php?page=<?=$page?>&type=<?=$id?>'"><img src="<?=HTTP?>img/delete.png" alt="<?=$text['del']?>" draggable="false" /><?=$text['del']?></span>
				</div>

				<div class="result"><?=isset($result) ? $result : ''?></div>

				<form class="send" method="POST" action="reply/reply.php"<?=isset($post[$id]) ? "style=\"max-height: 35rem\"" : ''?>>
					<textarea type="text" name="answer" placeholder="<?=$text['input']?>" minlength="5" maxlength="200" required onkeypress="nobreak()"><?=isset($post[$id]) ? $post[$id] : ''?></textarea>

					<button type="submit" name="check" value="<?=$id?>"><?=$text['send']?></button>
				</form>
			</article>
			<hr />
		<?php
			unset($result);
		}
	else {
		?>		<article>
				<div class="user"><?=$text['types']?>!</div>

				<div id="all">
					<button onclick="location.href='<?=HTTP.strtolower($_user)?>'"><?=$text['back']?></button>
				</div>
			</article><?php
		}
	?>

		</section>

		<?php
			if(isset($zoom))
			{
				echo "<div id=\"zoom\">";
				display($zoom['anonymous'] ? 0 : $zoom['user'], $zoom['content'], $zoom['answer']);
				echo "</div>";
			}
		?>

<?php include_once 'footer.php'?>
