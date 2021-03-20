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

			$sql = "SELECT `types`.`id`, `user`, `content`, `answer`, `anonymous`, `questiondate` FROM `accountlist` RIGHT JOIN `types` ON `accountlist`.`id`=`to` WHERE `from`={$_SESSION['id']} AND `hidden`=0 ORDER BY `questiondate` DESC";

			$stmt = $dbh->stmt_init();
			$stmt->prepare($sql);
			$stmt->execute();

			$types = $stmt->get_result();

			$sql = "SELECT `types`.`id`, `user`, `content`, `answer`, `anonymous`, `answerdate` FROM `accountlist` RIGHT JOIN `types` ON `accountlist`.`id`=`from` WHERE `to`={$_SESSION['id']} AND `answer` IS NOT NULL ORDER BY `answerdate` DESC";

			$stmt = $dbh->stmt_init();
			$stmt->prepare($sql);
			$stmt->execute();

			$answers = $stmt->get_result();

			$_SESSION['types'] = $_SESSION['info'] = $_SESSION['answers'] = array();
			$view = isset($_SESSION['view']) ? $_SESSION['view'] : 1;

			include_once '../time.inc.php';
		?>

		<link rel="stylesheet" href="<?=HTTP?>style/result.css" type="text/css" media="all">
		<link rel="stylesheet" href="<?=HTTP?>style/main.css" type="text/css" media="all">
		<link rel="stylesheet" href="<?=HTTP?>style/types.css" type="text/css" media="all">

		<script>
			function select() {
				var scroll = 0;

				if(sessionStorage.getItem("answers")=="1")
				{
					view.querySelectorAll("button")[1].click();
					scroll++;
				}

				if(document.querySelectorAll("section")[scroll].getElementsByClassName(location.hash.substr(1)).length)
					scrollTo({
						top: scrollY + document.querySelectorAll("section")[scroll].getElementsByClassName(location.hash.substr(1))[0].getBoundingClientRect().top - document.querySelector("header").offsetHeight,
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

		<p><?=$text['rules']?>!</p>
		<p><?=$text['restrictions']?>.</p>
		<p><?=$text['show']?>.</p>

		<div id="view">
			<button onclick="document.querySelector('section').style.display='block';answers.style.display='none';this.nextElementSibling.style.backgroundColor='var(--gray2)';this.style.backgroundColor='var(--gray1)';sessionStorage.removeItem('answers')"><?=$text['types']?></button>
			<button onclick="document.querySelector('section').style.display='none';answers.style.display='block';this.previousElementSibling.style.backgroundColor='var(--gray2)';this.style.backgroundColor='var(--gray1)';sessionStorage.setItem('answers', '1')"><?=$text['answers']?></button>
		</div>

		<section>
	<?php
		if($view > 1)
		{
			if(isset($_GET['edit']) && is_numeric($_GET['edit']))
				echo "<div id=\"dummy\" class=\"result\">".${"n{$_GET['edit']}"} = $text['edit']['type']."</div>\n";
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
			elseif(isset($_GET['visibility']) && is_numeric($_GET['visibility']))
				echo "<div id=\"dummy\" class=\"result\">".${"n{$_GET['visibility']}"} = $text['visibility']['type']."</div>\n";
			elseif(isset($_GET['hide']))
				switch($hide = $_GET['hide'])
				{
					case 'success':
						echo "<div class=\"result success\">".$text['hide']['success']."</div>\n";
						break;
					default:
						if(is_numeric($hide))
							echo "<div id=\"dummy\" class=\"result\">".${"n$hide"} = $text['hide']['type']."</div>\n";
						break;
				}
		}

		if($types->num_rows)
			while(($row = $types->fetch_assoc()) !== NULL)
			{
				$id = $row['id'];

				if(strtotime("+1 day", strtotime($row['questiondate'])) > time())
					$_SESSION['types'][$id] = isset($row['answer']);

				array_push($_SESSION['info'], $id);

				if($view > 1)
					if(isset(${"n$id"})) {
						$result = ${"n$id"};
						echo "<script>dummy.style.display=\"none\"</script>\n";
					} elseif(isset($_GET[$id]))
						switch($_GET[$id])
						{
							case 'success':
								$result = "<span class=\"success\">".($view - 2 ? $text['visibility']['success'] : $text['edit']['success'])."</span>";
								if(isset($post) && $post == $id)
								{
									include_once '../article.inc.php';
									$zoom = $row;
								}
								break;
							case 'empty':
								$result = $empty;
								break;
							case 'length':
								$result = $text['edit']['length'];
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
				<span class="user"><a href="../<?=strtolower($row['user'])?>"><?=$row['user']?></a></span>
				<span class="date"><span><?=($ago = timeago($row['questiondate'])) ? $times['ago'][0] : ''?> </span><?=$ago ? $ago : $times['now']?><span> <?=$ago ? $times['ago'][1] : ''?></span></span>

				<div class="question">
					<?=htmlentities($row['content'], ENT_NOQUOTES | ENT_HTML5)?>

				</div>

				<?=isset($row['answer']) ? "<div class=\"answer\">".htmlentities($row['answer'], ENT_NOQUOTES | ENT_HTML5)."</div>" : ''?>

				<div class="reply">
					<div>
						<span <?=isset($_SESSION['types'][$id]) && !$_SESSION['types'][$id] ? "onclick=\"this.closest('article').querySelector('form').style.maxHeight=getComputedStyle(this.closest('article').querySelector('form')).maxHeight=='0px'?'35rem':'0px'\"" : "class=\"hidden\""?>><img src="<?=HTTP?>img/edit.png" alt="<?=$text['send']?>" draggable="false" /><?=$text['send']?></span>

						<span <?=isset($_SESSION['types'][$id]) ? "onclick=\"if(confirm('".$text['confirm1']."? ".$text['undo'].".'))location.href='delete.php?page=$page&type=$id';console.log('aaa')\"" : "class=\"hidden\""?>><img src="<?=HTTP?>img/delete.png" alt="<?=$text['del']?>" draggable="false" /><?=$text['del']?></span>
					</div>

					<div>
						<span onclick="location.href='types/info.php?info=visibility&type=<?=$id?>'"><img src="<?=HTTP."img/" . ($row['anonymous'] ? 'anonymous' : 'visible') . ".png"?>" alt="<?=$main['anonymous']?>" draggable="false" /><?=$main[$row['anonymous'] ? 'anonymous' : 'visible']?></span>

						<span onclick="if(confirm('<?=$text['confirm2']?>? <?=$text['undo']?>.'))location.href='types/info.php?info=hide&type=<?=$id?>'"><img src="<?=HTTP?>img/listed.png" alt="<?=$main['hidden']?>" draggable="false" /><?=$main['listed']?></span>
					</div>
				</div>

				<div class="result"><?=isset($result) ? $result : ''?></div>

				<form class="send" method="POST" action="types/edit.php"<?=isset($post[$id]) && $view ? "style=\"max-height: 35rem\"" : ''?>>
					<textarea type="text" name="content" placeholder="<?=$text['input1']?>" minlength="5" maxlength="200" required onkeypress="nobreak()"><?=isset($post[$id]) && $view ? $post[$id] : htmlentities($row['content'], ENT_NOQUOTES | ENT_HTML5)?></textarea>

					<button type="submit" name="check" value="<?=$id?>"><?=$text['send']?></button>
				</form>
			</article>
			<hr />
	<?php
			unset($result);
		}
	else {
		?>		<article>
			<div class="user"><?=$text['notypes']?>!</div>

			<div id="all">
				<button onclick="location.href='<?=HTTP.strtolower($_user)?>'"><?=$text['back']?></button>
			</div>
		</article><?php
	}
?>

		</section>

		<section id="answers">
	<?php
		if(!$view && isset($_GET['answer']) && is_numeric($_GET['answer']))
			echo "<div id=\"dummy\" class=\"result\">".${"n{$_GET['answer']}"} = $text['answer']['type']."</div>\n";

		if($answers->num_rows)
			while(($row = $answers->fetch_assoc()) !== NULL)
			{
				$id = $row['id'];

				if(strtotime("+1 day", strtotime($row['answerdate'])) > time())
					array_push($_SESSION['answers'], $id);

				if(!$view)
					if(isset(${"n$id"})) {
						$result = ${"n$id"};
						echo "<script>dummy.style.display=\"none\"</script>\n";
					}
					elseif(isset($_GET[$id]))
						switch($_GET[$id])
						{
							case 'success':
								$result = "<span class=\"success\">{$text['answer']['success']}</span>";
								if(isset($post) && $post == $id)
								{
									include_once '../article.inc.php';
									$zoom = $row;
								}
								break;
							case 'empty':
								$result = $empty;
								break;
							case 'length':
								$result = $text['answer']['length'];
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
				<span class="date"><span><?=($ago = timeago($row['answerdate'])) ? $times['ago'][0] : ''?> </span><?=$ago ? $ago : $times['now']?><span> <?=$ago ? $times['ago'][1] : ''?></span></span>

				<div class="question">
					<?=htmlentities($row['content'], ENT_NOQUOTES | ENT_HTML5)?>

				</div>

				<div class="answer"><?=htmlentities($row['answer'], ENT_NOQUOTES | ENT_HTML5)?></div>

				<div class="reply">
					<span <?=in_array($id, $_SESSION['answers']) ? "onclick=\"this.closest('article').querySelector('form').style.maxHeight=getComputedStyle(this.closest('article').querySelector('form')).maxHeight=='0px'?'35rem':'0px'\"" : "class=\"hidden\""?>><img src="<?=HTTP?>img/edit.png" alt="<?=$text['send']?>" draggable="false" /><?=$text['send']?></span>
				</div>

				<div class="result"><?=isset($result) ? $result : ''?></div>

				<form class="send" method="POST" action="types/answer.php"<?=isset($post[$id]) && !$view ? "style=\"max-height: 35rem\"" : ''?>>
					<textarea type="text" name="answer" placeholder="<?=$text['input2']?>" minlength="5" maxlength="200" required onkeypress="nobreak()"><?=isset($post[$id]) && !$view ? $post[$id] : htmlentities($row['answer'], ENT_NOQUOTES | ENT_HTML5)?></textarea>

					<button type="submit" name="check" value="<?=$id?>"><?=$text['send']?></button>
				</form>
			</article>
			<hr />
	<?php
			unset($result);
		}
	else {
		?>		<article>
				<div class="user"><?=$text['noanswers']?>!</div>

				<div id="all">
					<button onclick="location.href='reply'"><?=$text['reply']?></button>
				</div>
			</article><?php
	}
?>

		</section>

		<script>select()</script>

		<?php
			if(isset($zoom))
			{
				echo "<div id=\"zoom\" onclick=\"select()\">";
				display($zoom['anonymous'] ? 0 : $zoom['user'], $zoom['content'], $zoom['answer']);
				echo "</div>";
			}
		?>

<?php include_once 'footer.php'?>
