<?php require_once 'defines.inc.php'?>
<?php

	if(basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]))
	{
		header("Location: " . HTTP . "?error=404");
		exit();
	}
?>
			function zoomout() {
				zoom.innerHTML = "";

				for(it of document.querySelectorAll("body>*:not(#zoom)"))
					it.removeAttribute("style");
			}

			function zero(date) {
				return ('0'+date).slice(-2);
			}

			function load() {
				var date = new Date;
				var date = date.getFullYear()+'-'+zero(date.getMonth())+'-'+zero(date.getDate())+'.'+zero(date.getHours())+'-'+zero(date.getMinutes())+'-'+zero(date.getSeconds());

				zoom.removeChild(document.querySelector("#zoom > label"));
				var scroll = scrollY;
				scrollTo(0, 0);

				html2canvas(zoom, {
					backgroundColor: null,
					width: zoom.offsetWidth,
					height: zoom.offsetHeight
				}).then(function(canvas) {
					var link = document.createElement("a");

					link.href = canvas.toDataURL("image/png", 1);
					link.download = "Typed."+date+".png";
					link.click();
				});

				scrollTo(0, scroll);
			}

			function nobreak() {
				if(event.keyCode == 13)
				{
					event.preventDefault();

					if(confirm("<?=$GLOBALS['text']['break']?>?"))
						document.querySelector("[name=check]").click();
				}
			}
