<?php require_once 'defines.inc.php'?>
<!DOCTYPE html>
<html lang="<?=$lang?>">
	<head>
		<?php
			if(isset($_GET['redirect']))
			{
				$_SESSION['redirect'] = HTTP . $_GET['name'];
				header("Location: ./login");
				exit();
			}

			if(empty($_GET['name']))
				$name = false;
			elseif(preg_match('/^[A-Za-z][A-Za-z0-9._]{2,29}$/', $_GET['name']))
				$name = ucfirst(strtolower($_GET['name']));
			else
				$name = true;

			require_once 'style.inc.php';

			if(isset($_SESSION['post']))
			{
				$post = $_SESSION['post'];

				if($post === false)
					$alert = true;
			}

			if($name !== false && $name !== true && !in_array($name, INVALID))
			{
				if(in_array($name, HIDDEN))
				{
					switch($name)
					{
						case 'Advice':
							header("Location: contactus/advice");
							break;
						case 'Bug':
							header("Location: contactus/bug");
							break;
						case 'Recovery':
							header("Location: login/recovery");
							break;
						case 'Crushbox':
							header("Location: profile/crushbox");
							break;
						case 'Settings':
							header("Location: profile/settings");
							break;
						case 'Points':
							header("Location: user/points");
							break;
						case 'Reply':
							header("Location: user/reply");
							break;
						case 'Types':
							header("Location: user/types");
							break;
						default:
							throw new Exception("Invalid search redirect", 3);
					}
					exit();
				} else {
					$sql = "SELECT `accountlist`.`id`, `token`, `privacy`, `points`, `description` FROM `accountlist` JOIN `data` ON `accountlist`.`id`=`data`.`id` WHERE `user`=?";

					$stmt = $dbh->stmt_init();
					$stmt->prepare($sql);
					$stmt->bind_param("s", $name);
					$stmt->execute();

					$row = $stmt->get_result()->fetch_assoc();

					if($row)
					{
						if(isset($_GET[strtolower($name)]))
						{
							if(isset($post))
								$content = $post;

							switch($_GET[strtolower($name)])
							{
								case 'success':
									$result = "<span class=\"success\">{$text['errors']['success']}</span>";
									if(isset($content))
									{
										include_once 'article.inc.php';
										$zoom = $content;
										unset($content);
									}
									break;
								case 'anonymous':
									$result = $text['errors']['anonymous'];
									break;
								case 'hidden':
									$result = $text['errors']['hidden'];
									break;
								case 'empty':
									$result = $empty;
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
							}
						} elseif(isset($post))
						{
							switch($post)
							{
								case 'success':
									echo "<script>alert(\"{$text['points']['success']}\")</script>";
									break;
								case 'self':
									echo "<script>alert(\"{$text['points']['self']}\")</script>";
									break;
								case 'invalid':
									echo "<script>alert(\"{$text['points']['invalid']}\")</script>";
									break;
								case 'conn':
									echo "<script>alert(\"{$text['points']['conn']}\")</script>";
									break;
								case 'unknown':
									echo "<script>alert(\"{$text['points']['unknown']}\")</script>";
									break;
								case 'time':
									echo "<script>alert(\"{$text['points']['time']}\")</script>";
									break;
							}
						}

						require_once 'instagram/user.inc.php';
						$instauser = instauser($row['token']);

						if($instauser)
						{
							include_once 'description.inc.php';
							description($row['description'], $row['id'], $name, $instauser, $row['points']);
						}

						$sql = "SELECT `user`, `content`, `answer`, `anonymous`, `questiondate` FROM `accountlist` RIGHT JOIN `types` ON `accountlist`.`id`=`from` WHERE `to`=" . $row['id'] . ($row['privacy'] ? '' : " AND `answer` IS NOT NULL") . " ORDER BY `questiondate` DESC";

						$stmt = $dbh->stmt_init();
						$stmt->prepare($sql);
						$stmt->execute();

						$types = $stmt->get_result();

						$self = isset($_SESSION['id']) && $_SESSION['id'] == $row['id'];

						$_SESSION['username'] = array('id'=>$row['id'], 'name'=>strtolower($name));
					}
				}
			} else
				$row = NULL;
		?>

		<link rel="stylesheet" href="<?=HTTP?>style/result.css" type="text/css" media="all">
		<link rel="stylesheet" href="<?=HTTP?>style/main.css" type="text/css" media="all">
		<link rel="stylesheet" href="<?=HTTP?>style/pages/user.css" type="text/css" media="all">

		<?=$row === NULL && $name ? "<meta name=\"robots\" content=\"noindex\">" : '';?>
<?php
	if($row)
	{
		?>

		<script>
			function init() {
				var inputs = document.querySelectorAll(".settings input");

				<?php
					if(isset($_SESSION['id']))
					{
						?>inputs[0].value = typeof(sessionStorage.getItem("anonymous")) == "object" ? "1" : sessionStorage.getItem("anonymous");
				inputs[1].value = typeof(sessionStorage.getItem("hidden")) == "object" ? "0" : sessionStorage.getItem("hidden");<?php
					} else
						echo "inputs[0].value = \"1\"";
				?>

				position();
				color(0);
				<?=isset($_SESSION['id']) ? "color(1);" : ''?>

			}

			function position() {
				var buttons = document.querySelectorAll(".settings button");

				buttons[0].style.left = "calc((100% - " + document.querySelector("textarea").offsetWidth + "px) / 2 + 3rem";
				<?=isset($_SESSION['id']) ? "buttons[1].style.left = \"calc((100% - \" + document.querySelector(\"textarea\").offsetWidth + \"px) / 2 + 10.5rem\"" : ''?>;

				if(document.querySelector("section p").scrollWidth > document.querySelector("section p").offsetWidth)
					document.querySelector("section p").innerHTML = "<?=$text['overflow']?>:";
			}

			function color(pos) {
				var settings = document.getElementsByClassName("settings");

				if(settings[pos].querySelector("input").value == true)
				{
					settings[pos].querySelector("button").style.backgroundColor = "var(--gray2)";
					settings[pos].querySelector("img").src = "<?=HTTP?>img/" + settings[pos].querySelector("input").name + ".png";
				} else {
					settings[pos].querySelector("button").style.backgroundColor = "var(--blue)";
					settings[pos].querySelector("img").src = "<?=HTTP?>img/" + (settings[pos].querySelector("input").name == "anonymous" ? "visible" : "listed") + ".png";
				}

				setTimeout(function() {
					settings[pos].querySelector("button").style.transition = "background-color .6s";
				}, 0);
			}

			function values(pos) {
				var inputs = document.querySelectorAll(".settings input");
				return inputs[pos].value = inputs[pos].value == true ? "0" : "1";
			}

			function input() {
				if(document.querySelector("textarea").value.length >= 5)
				{
					submit.style.display = "inline-block";
					meaning.style.display = "none";

					document.querySelector("#main + form").classList.add("margin");
				} else {
					submit.style.display = "none";
					document.querySelector("#main + form").classList.remove("margin");
				}
			}

			function zoomin(inner) {
				zoom.innerHTML = "<h2 onclick='zoomout()'>Typed</h2><article onclick='zoomout()'>" + inner + "<label><?=$short?> | <?=$main['link']?></label></article><?=$self ? "<label>".$main['click']." <a onclick='load()'>$here</a>".$main['download'].".</label>" : ''?>";

				for(it of document.querySelectorAll('body>*:not(#zoom)'))
				{
					it.style.filter="blur(3px)";
					it.style.pointerEvents="none";
				}
			}

<?php include_once 'user/script.inc.php'?>

			addEventListener("mouseup", function() {
				removeEventListener("mousemove", position);
			});

			addEventListener("touchend", function() {
				removeEventListener("touchmove", position);
			});

			var active = "<?=$_SESSION['theme'] == "dark" ? HTTP."img/search.h.png" : HTTP."img/search.a.png"?>";
			var hover = "<?=$_SESSION['theme'] == "dark" ? HTTP."img/search.a.png" : HTTP."img/search.h.png"?>";
		</script>

		<?php
			if($self)
				echo "<script src=\"https://html2canvas.hertzen.com/dist/html2canvas.min.js\" async defer></script>";
	}
?>

	</head>

	<body<?=$row ? " onresize=\"position()\"" : ''?>>
<?php include_once 'header.php'?>

		<h1><?=$text['title']?></h1>

		<?php
			if($row)
			{
				include_once 'time.inc.php';

				if($instauser)
					echo "<span>@".$instauser."</span>\n\t\t";

				if($self)
				{
					include_once 'article.inc.php';

					?><div id="self">
			<button onclick="zoomin(share.innerHTML)"><?=$text['share']?></button>
			<button onclick="location.href='user/points'"><?=$text['gain']?></button>
		</div>

		<article id="share">
			<span class="user"><?=$_user?></span>

			<div class="question"><?=$text['send']?>!</div>
		</article>
					<?php
				}
			?>

		<div id="main">
			<div>
				<img src="<?=HTTP . "avatars/" . (glob(ROOT."avatars/" . substr(md5($row['id']), 10, 12) . ".*") ? basename(glob(ROOT . "avatars/" . substr(md5($row['id']), 10, 12) . ".*")[0]) : "null.null")?>" alt="<?=$text['alt1']?>" onclick="location.href='<?=$_GET['name']?>/profile'" draggable="false" />
				<span id="points" onclick="<?=$self ? "alert('".$text['points']['self']."')" : (isset($_SESSION['id']) ? "location.href='".HTTP."profile/point.php?redirect=user&user=".$name."'" : "alert('".$text['points']['login']."')")?>"><?=$row['points']?></span>

				<div id="profile">
					<div><?=$name?></div>
					<?=$instauser ? "<span>@".$instauser."</span>" : ''?>

				</div>
			</div>
		</div>

		<form method="POST" action="user/submit.php">
			<textarea name="content" placeholder="<?=$text['type']?>" minlength="5" maxlength="200" required oninput="input()" onkeypress="nobreak()" onpaste="event.preventDefault()" onmousedown="addEventListener('mousemove', position)" ontouchstart="addEventListener('touchmove', position)"><?=isset($content) ? $content : ''?></textarea>

			<span class="settings">
				<input type="hidden" name="anonymous" />
				<button type="button" onclick="<?=isset($_SESSION['id']) ? "sessionStorage.setItem('anonymous', values(0));color(0)" : "alert('".$text['forbidden']."')"?>"><img alt="<?=$main['anonymous']?>" draggable="false" /></button>
			</span>

			<?php
				if(isset($_SESSION['id']))
				{
					?><span class="settings">
				<input type="hidden" name="hidden" />
				<button type="button" onclick="sessionStorage.setItem('hidden', values(1));color(1)"><img alt="<?=$main['hidden']?>" draggable="false" /></button>
			</span>
					<?php
				}
			?>

			<button id="submit" type="submit" name="check"><?=$text['submit']?></button>
		</form>

		<span id="meaning" onclick="info.style.display='block';this.style.display='none'"><?=$text['meaning']?>?</span>

		<div class="result"><?=isset($result) ? $result : ''?></div>

		<div id="info">
			<div>
				<div>
					<img src="<?=HTTP?>img/visible.png" alt="<?=$main['visible']?>" draggable="false" /><span><?=$main['visible']?>:&nbsp;</span><span><?=$text['info']['visible']?></span>
				</div>
				<div>
					<img src="<?=HTTP?>img/anonymous.png" alt="<?=$main['anonymous']?>" draggable="false" /><span><?=$main['anonymous']?>:&nbsp;</span><span><?=$text['info']['anonymous']?></span>
				</div>
			</div>
			<div>
				<div>
					<img src="<?=HTTP?>img/listed.png" alt="<?=$main['listed']?>" draggable="false" /><span><?=$main['listed']?>:&nbsp;</span><span><?=isset($_SESSION['id']) ? $text['info']['listed']."<a href=\"user/types\">$here</a>" : $text['info']['login']?></span>
				</div>
				<div>
					<img src="<?=HTTP?>img/hidden.png" alt="<?=$main['hidden']?>" draggable="false" /><span><?=$main['hidden']?>:&nbsp;</span><span><?=isset($_SESSION['id']) ? $text['info']['hidden'] : $text['info']['login']?></span>
				</div>
			</div>
		</div>

<?php
	if(isset($_SESSION['id']))
	{
		if($self)
		{
			?>		<div id="types">
			<p><?=$text['types']?>:</p>
			<button class="types" onclick="location.href='user/reply'"><?=$text['reply']?></button>
			<button class="types" onclick="location.href='user/types'"><?=$text['you']?></button>
		</div>

<?php
		}
	} else {
		?>		<div id="types">
			<p><?=$text['logged']?></p>
			<button onclick="location.href='?redirect'"><?=$text['login']?></button>
			<button onclick="location.href='signup'"><?=$text['signup']?></button>
		</div>

<?php
	}
?>
		<section>
			<p><?=$text['all']?>:</p>
<?php
	if($types->num_rows)
		while(($row = $types->fetch_assoc()) !== NULL)
		{
			?>

			<article<?=isset($row['answer']) ? " onclick=\"zoomin(this.innerHTML)\"" : ''?>>
				<span class="user"><?=$row['anonymous'] ? $main['anonymous'] : "<a href=\"".strtolower($row['user'])."\" onclick=\"event.stopPropagation()\">".$row['user']."</a>"?></span>
				<span class="date"><span><?=($ago = timeago($row['questiondate'])) ? $times['ago'][0] : ''?> </span><?=$ago ? $ago : $times['now']?><span> <?=$ago ? $times['ago'][1] : ''?></span></span>

				<div class="question">
					<?=htmlentities($row['content'], ENT_NOQUOTES | ENT_HTML5)?>

				</div>
				<?=isset($row['answer']) ? "<div class=\"answer\">".htmlentities($row['answer'], ENT_NOQUOTES | ENT_HTML5)."</div>" : ''?>

			</article>
			<hr /><?php
		} else {
			?>

			<article>
				<div class="user"><?=$name?> <?=$text['empty']?>!</div>
			</article><?php
		}
	?>

		</section>
		<script>init()</script>

		<div id="zoom"><?=isset($zoom) ? display($zoom['user'], $zoom['content']) : ''?></div>
<?php

	} else {
		if($name)
			echo "<h3>".$text['found']."</h3>";

		?>

		<form id="user" method="GET">
			<label><?=$text['label']?>:</label>

			<input type="search" name="name" value="<?=$name ? $_GET['name'] : ''?>" placeholder="<?=$text['search']?>" minlength="3" maxlength="30" autofocus required />

			<button class="go" type="submit" onmouseover="querySelector('#user img').src=hover" onmouseout="querySelector('#user img').src=active"><img src="<?=$_SESSION['theme'] == "dark" ? HTTP."img/search.h.png" : HTTP."img/search.a.png"?>" alt="<?=$text['alt4']?>" draggable="false" /></button>
		</form><?php
	}
?>

<?php include_once 'footer.php'?>
