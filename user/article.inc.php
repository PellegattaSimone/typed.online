<?php require_once 'defines.inc.php'?>
<?php

	if(basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]))
	{
		header("Location: " . HTTP . "?error=404");
		exit();
	}

	function display($user, $content, $answer = "") {
		?>
		<h2 onclick="zoomout()">Typed</h2>
		<article onclick='zoomout()'>
			<span class="user"><?=$user ? $user : $GLOBALS['main']['anonymous']?></span>
			<span class="date"><?=$GLOBALS['times']['now']?></span>

			<div class="question">
				<?=htmlentities($content, ENT_NOQUOTES | ENT_HTML5)?>

			</div>

			<?=$answer ? "<div class=\"answer\">".htmlentities($answer, ENT_NOQUOTES | ENT_HTML5)."</div>\n" : ''?>

			<label><?=$GLOBALS['short']?> | <?=$GLOBALS['main']['link']?></label>
		</article>

		<?=$answer ? "<label>".$GLOBALS['main']['click']." <a onclick='load()'>".$GLOBALS['here']."</a>".$GLOBALS['main']['download'].".</label>" : ''?>

		<script>
			for(it of document.querySelectorAll('body>*:not(#zoom)'))
			{
				it.style.filter="blur(3px)";
				it.style.pointerEvents="none";
			}
		</script>

		<?php
	}
