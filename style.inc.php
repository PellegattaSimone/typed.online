<?php

	if(basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]))
	{
		header("Location: " . HTTP . "?error=404");
		exit();
	}

	require_once 'lang/' . $lang . '.inc.php';

	//theme
	if(!isset($_SESSION['rgb']))
		if(isset($_COOKIE['theme']) && preg_match('/^[[:xdigit:]]{36}$/', $_COOKIE['theme']))
			$_SESSION['rgb'] = $_COOKIE['theme'];
		elseif(isset($_SESSION['id']) && (!isset($_SESSION['error']) || $_SESSION['error']))
		{
			try {
				$sql = "SELECT `rgb` FROM `data` WHERE `id`=".$_SESSION['id'];

				$stmt = $dbh->stmt_init();
				$stmt->prepare($sql);
				$stmt->execute();

				$_SESSION['rgb'] = $stmt->get_result()->fetch_assoc()['rgb'];

			} catch (mysqli_sql_exception $exception) {

				$driver->logexc($exception, E_WARNING);
				$_SESSION['rgb'] = NULL;
			}
		} else
			$_SESSION['rgb'] = NULL;

	$themes = array("light", "dark", "random");

	if(isset($_POST['theme']))
	{
		if(in_array($_POST['theme'], $themes))
			$_SESSION['theme'] = $_POST['theme'];
		elseif($_POST['theme'] == "personal" && $_SESSION['rgb'])
			$_SESSION['theme'] = $_SESSION['rgb'];

		echo "<script>history.replaceState(null, null)</script>";
	}

	if(!isset($_SESSION['theme']))
		if(isset($_COOKIE['theme']) && in_array($_COOKIE['theme'], $themes))
			$_SESSION['theme'] = $_COOKIE['theme'];
		elseif($_SESSION['rgb'])
			$_SESSION['theme'] = $_SESSION['rgb'];
		else
			$_SESSION['theme'] = "light";

	if(!isset($_COOKIE['theme']) || $_COOKIE['theme'] != $_SESSION['theme'])
		setcookie("theme", $_SESSION['theme'], $time, '/');

	//back button
	if(!isset($_SESSION['this']))
		$_SESSION['this'] = $_SERVER['REQUEST_URI'];
	if(strtok($_SERVER['REQUEST_URI'], '?') != strtok($_SESSION['this'], '?'))
	{
		$_SESSION['last'] = $_SESSION['this'];
		$_SESSION['this'] = $_SERVER['REQUEST_URI'];
	}

	$text = $$page;
	$description = isset($text['description']) ? $text['description']." | ".$short : $description;

?><script>
			console.log("%cTyped", "backgroundColor: #942; color: #48F; font-size: 4rem; margin: 3rem 0");
			console.log("%c<?=URL?>", "backgroundColor: #942; color: #280; font-size: 2.5rem; margin: 2rem 0");

			if(location.hash === "#_")
				location.replace("");

			onscroll = function()
			{
				var position = document.body.scrollTop || document.documentElement.scrollTop;
				var pageHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;

				progress.style.width = (position / pageHeight) * 100 + "%";
			}

			var last, prevent = false, allowed = sessionStorage.getItem("allowed") == "true";

			addEventListener("click", function() {
				if(prevent)
					event.stopPropagation();
			}, true);

			function scroll() {
				prevent = true;

				setTimeout(function(event) {
					scrollBy({
						top: (last - event.clientY) * document.body.clientHeight / 750,
						behaviour: "auto"
					});

					last = event.clientY;
				}, 50, event);
			}

			onmousedown = function() {
				var node = document.elementFromPoint(event.clientX, event.clientY);

				if(allowed && node && node.nodeName != "INPUT" && node.nodeName != "TEXTAREA")
				{
					last = event.clientY;
					document.body.style.cursor = "grabbing";

					addEventListener("mousemove", scroll);
				}
			}

			onmouseup = function() {
				document.body.style.cursor = "default";
				removeEventListener("mousemove", scroll);

				setTimeout(function() {
					prevent = false;
				}, 0);
			}

			function allow() {
				sessionStorage.setItem("allowed", allowed);
				allowed = !allowed;

				drag.style.backgroundColor = allowed ? "var(--blue)" : "var(--gray2)";
				document.querySelector("#drag img").src= "<?=$_SESSION['theme']?>" != "dark" == allowed ? "<?=HTTP?>img/drag.a.png" : "<?=HTTP?>img/drag.h.png";
			}

			var open = 1;

			function search()
			{
				open = !open;

				document.querySelector(".go").style.backgroundColor = open ? "var(--gray2)" : "var(--blue)";
				document.querySelector("#search img").src = "<?=$_SESSION['theme']?>" != "dark" == open ? "<?=HTTP?>img/search.h.png" : "<?=HTTP?>img/search.a.png";

				var input = document.querySelector("[type=search]");

				input.style.display = open ? "inline-block" : "none";
				input.select();
			}

			function resize()
			{
				var wide = innerWidth / innerHeight > 1;

				document.getElementsByTagName("h1")[0].style.visibility = open && wide ? "hidden" : "visible";
				theme.style.visibility= open && !wide ? "hidden" : "visible";

				for(typed of document.getElementsByClassName("typed"))
					typed.style.visibility = open && !wide ? "hidden" : "visible";

				if(document.getElementById("settings"))
				{
					settings.style.visibility = open && !wide ? "hidden" : "visible";
					border.style.visibility = open && !wide ? "hidden" : "visible";
				}
			}

			addEventListener("load", function() {
				var viewport = document.querySelector("meta[name=viewport]");
				viewport.setAttribute("content", viewport.content + ", height=" + innerHeight);
			})

			onresize = function() {
				if(open) resize()
			};
		</script>

		<?php require_once 'meta.inc.php'?>

		<!--Languages-->
		<link rel="canonical" href="<?=URL.(isset($getlang) ? "?lang=".$getlang : '')?>">
		<link rel="alternate" hreflang="en" href="<?=URL?>?lang=en">
		<link rel="alternate" hreflang="it" href="<?=URL?>?lang=it">
		<link rel="alternate" hreflang="fr" href="<?=URL?>?lang=fr">
		<link rel="alternate" hreflang="es" href="<?=URL?>?lang=es">
		<link rel="alternate" hreflang="de" href="<?=URL?>?lang=de">

		<!--Style-->
		<link rel="stylesheet" href="<?=HTTP?>style/mode.php" type="text/css" media="all">
		<link rel="stylesheet" href="<?=HTTP?>style/common.css" type="text/css" media="all">
		<link rel="stylesheet" href="<?=HTTP?>style/header.css" type="text/css" media="all">
		<link rel="stylesheet" href="<?=HTTP?>style/footer.css" type="text/css" media="all">
