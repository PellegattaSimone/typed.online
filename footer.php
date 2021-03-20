<?php require_once 'defines.inc.php'?>
<?=isset($alert) ? "<script>alert(\"{$footer['check']}\")</script>" : ''?>
		<!--Footer-->

		<footer>
			<div id="lang" onmouseover="this.querySelector('ul').style.height='12.5rem'" onmouseout="this.querySelector('ul').style.height='0'">
				<img src="<?=HTTP?>img/lang/<?=$lang?>.png" alt="<?=$footer['alt1']?>" draggable="false" />

				<ul>
					<a hreflang="en" href="?<?=empty(QUERY) ? '' : QUERY.'&'?>lang=en"><li>English</li></a>
					<a hreflang="it" href="?<?=empty(QUERY) ? '' : QUERY.'&'?>lang=it"><li>Italiano</li></a>
					<a hreflang="fr" href="?<?=empty(QUERY) ? '' : QUERY.'&'?>lang=fr"><li>Fran&ccedil;ais</li></a>
					<a hreflang="es" href="?<?=empty(QUERY) ? '' : QUERY.'&'?>lang=es"><li>Espa&ntilde;ol</li></a>
					<a hreflang="de" href="?<?=empty(QUERY) ? '' : QUERY.'&'?>lang=de"><li>Deutsch</li></a>
				</ul>
			</div>

			<div id="foot">
				<button onclick="location.href='<?=HTTP?>contactus/advice'"><?=$footer['advice']?></button>

				<div></div>

				<button onclick="location.href='<?=HTTP?>contactus/bug'"><?=$footer['bug']?></button>

				<span>
					<?=$footer['license1']?><a rel="license external" href="http://creativecommons.org/licenses/by-nd/4.0/legalcode.<?=$lang?>"><?=$footer['license2']?></a> &copy; 2020.
				</span>

				<a id="privacy" href="<?=HTTP?>privacy"><?=$footer['privacy']?></a>

				<a id="terms" href="<?=HTTP?>terms"><?=$footer['terms']?></a>
			</div>

			<a id="license" rel="license external" href="http://creativecommons.org/licenses/by-nd/4.0/deed.<?=$lang?>"><img src="https://licensebuttons.net/l/by-nd/4.0/88x31.png" alt="<?=$footer['alt2']?>" /></a>
		</footer>

		<!--Footer End-->
	</body>
</html>

<?php
	unset($_SESSION['post'], $_SESSION['check'], $_SESSION['error']);
?>
