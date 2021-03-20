<?php require_once 'defines.inc.php'?>
		<!--Header-->

		<header>
			<?=isset($_SESSION['last']) ? "<button id=\"back\" accesskey=\"b\" onclick=\"location.href='" . $_SESSION['last'] . "'\">" . $header['back'] . "</button>\n" : ''?>

			<form id="search" method="GET" action="<?=HTTP?>user">
				<button class="go" type="button" onclick="search();resize()"><img alt="<?=$header['alt1']?>" accesskey="s" draggable="false" /></button>

				<input type="search" name="name" placeholder="<?=$header['search']?>" minlength="3" maxlength="30" pattern="[A-Za-z][A-Za-z0-9._]{2,29}" required oninput="setCustomValidity(this.validity.patternMismatch?'<?=$validity?>':'')" />

				<button type="submit"></button>
			</form>

			<button id="drag" type="button" accesskey="l" onclick="allow()"><img alt="<?=$header['alt2']?>" draggable="false" /></button>

			<script>search();allow()</script>

			<form id="theme" method="POST" onmouseover="this.querySelector('div').style.height='12.5rem'" onmouseout="this.querySelector('div').style.height='0'">
				<span><?=$header['theme']?></span>

				<div>
					<?php if($_SESSION['rgb']){?><button id="personal" type="submit" name="theme" value="personal"><?=$header['personal']?></button><?php }?>

					<button id="light" type="submit" name="theme" value="light"><?=$header['light']?></button>
					<button id="dark" type="submit" name="theme" value="dark"><?=$header['dark']?></button>
					<button id="random" type="submit" name="theme" value="random"><?=$header['random']?></button>
					<button id="personalize" type="button" onclick="location.href='<?=HTTP?>style'"><?=$header['personalize']?></button>
				</div>
			</form>

			<img id="maxi" class="typed" src="<?=HTTP?>img/typed.png" alt="Typed" onclick="location.href='<?=HTTP?>'" accesskey="t" draggable="false" />

			<img id="mini" class="typed" src="<?=HTTP?>icon/monochrome.svg" alt="Typed" onclick="location.href='<?=HTTP?>'" accesskey="t" draggable="false" />

			<div id="progress"></div>
		</header>

		<div id="space"></div>

		<!--Header end-->
