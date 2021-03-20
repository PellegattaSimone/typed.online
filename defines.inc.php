<?php

	ob_start();

	if(isset($_SESSION['fatal']))
	{
		?><body style="background-color: #EED">
	<h1>Sorry, we are experiencing an internal error.</h1>
	<h2>Try again in a few hours. Our team is already working to fix the problem!</h2>
</body><?php

		unset($_SESSION['fatal']);
		$_SESSION['error'] = 2;
		exit();
	} elseif(isset($_SESSION['error']) && $_SESSION['error'])
		$fatal = true;

	define("ROOT", __DIR__.'/');

	define("HTTP", $_SERVER["SERVER_NAME"] == "localhost"
		? "http://localhost/PHP/typed/"
		: (strpos($_SERVER["SERVER_NAME"], '192') !== false
		? "http://192.168.1.10/PHP/typed/"
		: "https://" . $_SERVER["HTTP_HOST"] . '/'));

	define("URL", (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] ? "https" : "http") . "://" . $_SERVER["HTTP_HOST"] . '/' . trim(dirname($_SERVER["PHP_SELF"]), "/\\"));

	define("QUERY", preg_replace('/([^&]+)?[&]?lang=[^&]+(&|$)/', '$1', parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY)));

	//define("API", "https://api.instagram.com/oauth/authorize?client_id=497099821237000&scope=user_profile&response_type=code&redirect_uri=https://www.typed.online/auth.php" . ($_SERVER["SERVER_NAME"] == "localhost" ? "&state=".password_hash("local", PASSWORD_DEFAULT) : ''));
	define("API", HTTP."disabled.php");//temp

	define("GOOGLE", "103962165016-m8q9hn2auhu081lpaber5ghhieevdjdg.apps.googleusercontent.com");

	define("INVALID", array("Googlebot", "Admin"));

	define("HIDDEN", array("Advice", "Bug", "Instagram", "Login", "Recovery", "Privacy", "Profile", "Crushbox", "Settings", "Signup", "Style", "Terms", "Points", "Reply", "Types", "Backups", "Contactus", "Icon", "Img", "Jobs", "Lang", "Phpmailer", "Sitemap", "User"));

	define("TODAY", date("Y-m-d"));

	define("NOW", date("Y-m-d H:i:s"));

	final class Handler {
		public function __construct() {
			set_error_handler(array($this, "error"));
			set_exception_handler(array($this, "exception"));

			/*production*/
			/*$log = fopen(ROOT."jobs/log.txt", 'a');
			$text = NOW."\n";

			foreach($_SERVER as $key=>$value)
				$text .= $key.': '.$value."\n";

			foreach($_SESSION as $key=>$value)
				$text .= $key.': '.print_r($value, true)."\n";

			fwrite($log, preg_replace("/[\r\n]+/", "\n", $text)."\n---------------------------------------------\n\n");
			fclose($log);*/
		}

		public function logexc(&$exception, $type=E_ERROR) {
			$this->exception(new ErrorException($exception->getmessage(), $exception->getCode(), $type, $exception->getFile(), $exception->getLine()));
		}

		public function error($type, $error, $file, $line)
		{
			$this->exception(new ErrorException($error, 1, $type, $file, $line));
			return true;
		}

		public function exception($exception) {
			try {
				throw $exception;

			} catch(mysqli_sql_exception $exception) {

				switch($exception->getTrace()[0]['function'])
				{
					case 'prepare':
					case '__construct':
						$_SESSION['error'] = false;
						break;
					case 'bind_param':
					case 'execute':
						$_SESSION['error'] = true;
						break;
					default:
						trigger_error("Invalid trace function: ".str_replace("\n", '', var_export($exception->getTrace(), true)), E_USER_WARNING);
						break;
				}

				$this->logexc($exception);
				header("Location: ".HTTP);

			} catch (ErrorException $exception) {

				switch ($exception->getSeverity()) {
					case 0:
						$type = "Repeated Error";
						break;
					case E_ERROR:
					case E_USER_ERROR:
					case E_CORE_ERROR:
					case E_COMPILE_ERROR:
						$type = "Fatal Error";
						break;
					case E_WARNING:
					case E_USER_WARNING:
					case E_CORE_WARNING:
					case E_COMPILE_WARNING:
					case E_RECOVERABLE_ERROR:
						$type = "Warning";
						break;
					case E_PARSE:
						$type = "Parse Error";
						break;
					case E_NOTICE:
					case E_USER_NOTICE:
						$type = "Notice";
						break;
					case E_STRICT:
						$type = "Strict";
						break;
					case E_DEPRECATED:
					case E_USER_DEPRECATED:
						$type = "Deprecated";
						break;
					default :
						$type = "Unknown";
					break;
				}

				if($log = fopen(ROOT."errors/".TODAY.".txt", 'a'))
				{
					fwrite($log, (isset($_SESSION['log']) ? '' : "\n") . date("[d-F-Y H:i:s ") . date_default_timezone_get() . "] PHP " . $type . ": " . $exception->getMessage() . " in " . $exception->getFile() . " on line " . $exception->getLine() . "\n");
					fclose($log);

					if(!isset($_SESSION['log']))
						$_SESSION['log'] = true;
				}
			} catch(Throwable $exception) {
				if(isset($GLOBALS['fatal']))
				{
					if($_SESSION['error'] !== 2)
						$this->exception(new ErrorException("The website is down", 2, 0, $exception->getFile(), $exception->getLine()));

					$_SESSION['fatal'] = true;
					header("Location: .");

				} else {
					$this->logexc($exception);

					$_SESSION['error'] = true;
					header("Location: ".HTTP);
				}
			}
		}
	}

	$driver = new Handler;

	$uri = explode('/', dirname($_SERVER["PHP_SELF"]));
	$page = $uri[count($uri) - 2] == "crushbox" ? "crushbox" : strtolower(end($uri));

	if(strpos($_SERVER['PHP_SELF'], "index.php") !== false)
	{
		echo "<!--";

		if($page)
			echo str_pad(ucfirst($page), 11, " ", STR_PAD_LEFT);
		?>

              y
            TyT
          yTyTy
          TyTyT
          yTyTy
    TyTyTyTyTyTyTy            TyTyTyTyTyTyTyTyTyTyTyTyTyTyTy   yTyTyTyTyTyTy
  yTyTyTyTyTyTyTyTyT        yTyTyTyTyTyTyTyTyTyTyTyTyTyTyT   TyTyTyTyTyTyTyT
TyTyTyTyTyTyTyTyTyTyTy    TyTyTyTyTyTyTyTyTyTyTyTyTyTyTy   yTyTyTyTyTyTyTyTy
          yTyTyTyTyTyTyT yTyTyTy  yTyTy       yTyTyTyT
          TyTyT   TyTyTyTyTyTyT   TyTyT     TyTyTyTy
          yTyTy     yTyTyTyTy     yTyTyTyTyTyTyTyT    TyTyTyTyTyTyTy   yTyTyTyTyTyT
          TyTyT       TyTyTy      TyTyTyTyTyTyTy    yTyTyTyTyTyTyTyT   TyTyTyTyTyTyTy
          yTyTy       yTyTy       yTyTy          TyTyTyTyTyTyTyTyTyT   yTyTyTyTyTyTyTyT
          TyTyT       TyTyT       TyTyT                                TyTyT       TyTyT
          yTyTy       yTyTy       yTyTy                                yTyTy       yTyTy
          TyTyT       TyTyT       TyTyT      yTyTyTyTyTyTyTyT          TyTyT       TyTyT
          yTyTy       yTyTy       yTyTy    TyTyTyTyTyTyTyTyTy          yTyTy       yTyTy
          TyTyT       TyTyT       TyTyT  yTyTyTyTyTyTyTyTyTyT          TyTyT       TyTyT
          yTyTy       yTyTy                                            yTyTyTyTyTyTyTyTy
          TyT         TyT                                              TyTyTyTyTyTyTyTyT
          y           y                                                yTyTyTyTyTyTyTyTy
-->		<?php echo "\n\n";
	}

	if(empty($page))
		$page = "typed";

	if(!isset($_SESSION['error']) || $_SESSION['error'])
	{
		require_once 'dbh.inc.php';

		//id
		if(isset($_SESSION['id']) && $_SESSION['id'] == 0)
			session_unset();

		if(isset($_SESSION['id']))
		{
			$sql = "SELECT `user`, `email` FROM `accountlist` WHERE `id`=?";

			$stmt = $dbh->stmt_init();
			$stmt->prepare($sql);
			$stmt->bind_param("s", $_SESSION['id']);
			$stmt->execute();

			$row = $stmt->get_result()->fetch_assoc();

			$_user = $row['user'];
			$_email = $row['email'];
		} else {
			if(isset($_COOKIE['id']))
			{
				$hash = hash_pbkdf2("sha512", $_COOKIE['id'], hash_pbkdf2("sha512", getenv("SALT"), 2048, 16), 2048, 64);

				$sql = "SELECT `id`, `user`, `email`, `hashdate` FROM `accountlist` WHERE `hash`=?";
				$stmt = $dbh->stmt_init();

				$stmt->prepare($sql);
				$stmt->bind_param("i", $hash);
				$stmt->execute();
				$row = $stmt->get_result()->fetch_assoc();

				if($row !== NULL)
					if(strtotime($row['hashdate']) > time())
					{
						$_SESSION['id'] = $row['id'];
						$_user = $row['user'];
						$_email = $row['email'];

					} else {
						$sql = "UPDATE `accountlist` SET `hash`=NULL, `hashdate`=NULL WHERE `id`=?";

						try {
							$stmt = $dbh->stmt_init();
							$stmt->prepare($sql);
							$stmt->bind_param("i", $row['id']);
							$stmt->execute();

						} catch (mysqli_sql_exception $exception) {

							$driver->logexc($exception, E_WARNING);
						}
					}
			}

			//googlebot
			if(!isset($_SESSION['id']) && in_array($page, array("profile", "settings", "crushbox", "points", "reply", "types")) || !isset($_SESSION['instagram']) && $page == "instagram")
			{
				$useragent = strtolower($_SERVER['HTTP_USER_AGENT']);

				if(strpos($useragent, "googlebot") !== false || strpos($useragent, "bingbot") !== false)
				{
					$_SESSION['id'] = 0;
					$_user = "googlebot";
					$_email = "bot@google.com";
					$ok = true;
					$_SESSION['instagram']['user'] = "google";
					$_SESSION['login'] = false;
					$_SESSION['expire'] = 20;

				} elseif(!isset($_SESSION['id']) && $page != "profile") {
					$_SESSION['redirect'] = URL;

					require_once 'head.inc.php';
					head(HTTP . "login", true);
					exit();
				}
			}
		}
	} else
		$_user = "n/d";

	$time = strtotime("+10 year", time());

	//language
	$langs = array("en", "it", "fr", "es", "de");

	if(isset($_GET['lang']) && in_array($_GET['lang'], $langs)) {
		$lang = $getlang = $_GET['lang'];
		$_SESSION['notranslate'] = true;
	} elseif(isset($_COOKIE['lang']) && in_array($_COOKIE['lang'], $langs))
		$lang = $_COOKIE['lang'];
	else {
		$lang = "en";

		if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE']))
		{
			foreach(explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']) as $it)
				if(in_array(substr($it, 0, 2), $langs))
				{
					$lang = substr($it, 0, 2);
					break;
				}
		}
	}

	if(!isset($_COOKIE['lang']) || $_COOKIE['lang'] != $lang)
		setcookie("lang", $lang, $time, '/');

	header("Content-Language: $lang");
	header("Cache-Control: no-store");
	header("Expires: -1");
	header_remove("Pragma");
