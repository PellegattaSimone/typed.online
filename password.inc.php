<?php require_once 'defines.inc.php'?>
<?php

	if(basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]))
	{
		header("Location: " . HTTP . "?error=404");
		exit();
	}
?>
			var shown = false;

			function password() {
				show.src = shown ? "<?=HTTP?>img/visible.png" : "<?=HTTP?>img/anonymous.png";

				for(it of document.querySelectorAll("[type=password], [type=shown]"))
					it.type = shown ? "password" : "shown";

				document.querySelector("[type=password], [type=shown]").focus();

				shown = !shown;
			}
