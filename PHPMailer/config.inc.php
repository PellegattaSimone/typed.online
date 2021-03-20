<?php require_once 'defines.inc.php'?>
<?php

	if(basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]))
	{
		header("Location: " . HTTP . "?error=404");
		exit();
	}

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	use PHPMailer\PHPMailer\SMTP;

	require_once 'src/PHPMailer.php';
	require_once 'src/SMTP.php';
	require_once 'src/Exception.php';

	$en = [
		'signup' => [
			'subject' => "Typed Signup Confirmation",//utf-8
			'title' => "One last step",
			'ready' => "Your account is almost ready",
			'click' => "Click",
			'here' => "here",
			'set' => "to set your password: you will be redirected to the Typed password page"
		],

		'recovery' => [
			'subject' => "Typed Password Recovery",//utf-8
			'title' => "Your account is safe",
			'click' => "Click",
			'here' => "here",
			'reset' => "to reset your password: you will be redirected to the Typed password page"
		],

		'crushbox' => [
			'subject' => "New Crushbox Match",//utf-8
			'title' => "Awesome news",
			'add' => "has decided to add you to his Crushbox",
			'wait' => "What are you waiting for"
		],

		'settings' => [
			'subject' => "Typed Change of Email",//utf-8
			'title' => "Almost done",
			'click' => "Click",
			'here' => "here",
			'confirm' => "to confirm your email address: you will be redirected to the Typed settings page"
		],

		'note' => "Remember: this link will expire after 30 minutes and can be used at most once",

		'reply' => "do not reply"//utf-8
	];

	$it = [
		'signup' => [
			'subject' => "Conferma della Registrazione a Typed",//utf-8
			'title' => "Un ultimo passaggio",
			'ready' => "Il tuo account &egrave; quasi pronto",
			'click' => "Clicca",
			'here' => "qui",
			'set' => "per impostare una password: sarai reindirizzato alla pagina della password di Typed"
		],

		'recovery' => [
			'subject' => "Recupero della Password di Typed",//utf-8
			'title' => "Il tuo account &egrave; al sicuro",
			'click' => "Clicca",
			'here' => "qui",
			'reset' => "per resettare la tua password: sarai reindirizzato alla pagina della password di Typed"
		],

		'crushbox' => [
			'subject' => "Nuova Corrispondenza nella Crushbox",//utf-8
			'title' => "Ottime notizie",
			'add' => "ha deciso di aggiungerti a sua volta alla sua Crushbox",
			'wait' => "Cosa stai aspettando"
		],

		'settings' => [
			'subject' => "Cambio dell'Email di Typed",//utf-8
			'title' => "Ci sei quasi",
			'click' => "Clicca",
			'here' => "qui",
			'confirm' => "per confermare il tuo indirizzo email: sarai reindirizzato alla pagina delle impostazioni di Typed"
		],

		'note' => "Ricorda: questo link dura 30 minuti e non pu&ograve; essere utilizzato pi&ugrave; di una volta",

		'reply' => "non rispondere"//utf-8
	];

	$fr = [
		'signup' => [
			'subject' => "Confirmation d'inscription =C3=A0 Typed",//utf-8
			'title' => "Une derni&egrave;re &eacute;tape",
			'ready' => "Votre compte est presque pr&ecirc;t",
			'click' => "Cliquez",
			'here' => "ici",
			'set' => "pour d&eacute;finir votre mot de passe: vous serez redirig&eacute; vers la page de mot de passe Typed"
		],

		'recovery' => [
			'subject' => "R=C3=A9cup=C3=A9ration de Mot de Passe Typed",//utf-8
			'title' => "Votre compte est en s&eacute;curit&eacute;",
			'click' => "Cliquez",
			'here' => "ici",
			'reset' => "pour r&eacute;initialiser votre mot de passe: vous serez redirig&eacute; vers la page de mot de passe Typed"
		],

		'crushbox' => [
			'subject' => "Nouvelle Correspondance dans la Crushbox",//utf-8
			'title' => "Bonnes nouvelles",
			'add' => "a d&eacute;cid&eacute; de vous ajouter &agrave; sa Crushbox",
			'wait' => "Qu'est-ce que vous attendez?"
		],

		'settings' => [
			'subject' => "Changement de l'email Typed",//utf-8
			'title' => "Tu y es presque",
			'click' => "Cliquez",
			'here' => "ici",
			'confirm' => "pour confirmer votre adresse email: vous serez redirig&eacute; vers la page des param&egrave;tres Typed"
		],

		'note' => "Rappelez-vous: ce lien expirera apr&egrave;s 30 minutes et peut &ecirc;tre utilis&eacute; au plus une fois",

		'reply' => "ne r=C3=A9pondez pas"//utf-8
	];

	$es = [
		'signup' => [
			'subject' => "Confirmaci=C3=B3n de Registro de Typed",//utf-8
			'title' => "&Uacute;ltimo paso",
			'ready' => "Tu cuenta esta casi lista",
			'click' => "Haga clic",
			'here' => "aqu&iacute;",
			'set' => "para establecer tu contrase&ntilde;a: ser&aacute; redirigido a la p&aacute;gina de contrase&ntilde;a de Typed"
		],

		'recovery' => [
			'subject' => "Recuperaci=C3=B3n de contrase=C3=B1a de Typed",//utf-8
			'title' => "Tu cuenta est&aacute; segura",
			'click' => "Haga clic",
			'here' => "aqu&iacute;",
			'reset' => "para restablecer tu contrase&ntilde;a: ser&aacute; redirigido a la p&aacute;gina de contrase&ntilde;a de Typed"
		],

		'crushbox' => [
			'subject' => "Nueva correspondencia en la Crushbox",//utf-8
			'title' => "Incre&iacute;bles noticias",
			'add' => "ha decidido agregarte a su Crushbox",
			'wait' => "Que estas esperando"
		],

		'settings' => [
			'subject' => "Cambio de Correo Electr=C3=B3nico de Typed",//utf-8
			'title' => "Ya casi est&aacute;s ah&iacute;",
			'click' => "Haga clic",
			'here' => "aqu&iacute;",
			'confirm' => "para confirmar su direcci&oacute;n de correo electr&oacute;nico: ser&aacute; redirigido a la p&aacute;gina de ajustes de Typed"
		],

		'note' => "Recuerde: este enlace expirar&aacute; despu&eacute;s de 30 minutos y puede usarse como m&aacute;ximo una vez",

		'reply' => "no respondas"//utf-8
	];

	$de = [
		'signup' => [
			'subject' => "Typed Anmeldebest=C3=A4tigung",//utf-8
			'title' => "Ein letzter Schritt",
			'ready' => "Ihr Konto ist fast fertig",
			'click' => "Klicken",
			'here' => "hier",
			'set' => "um Ihr Passwort festzulegen: Sie werden zur Typed-Passwortseite weitergeleitet"
		],

		'recovery' => [
			'subject' => "Typed Passwortwiederherstellung",//utf-8
			'title' => "Ihr Konto ist sicher",
			'click' => "Klicken",
			'here' => "hier",
			'reset' => "um Ihr Passwort zur&uuml;ckzusetzen: Sie werden zur Typed-Passwortseite weitergeleitet"
		],

		'crushbox' => [
			'subject' => "Neues Korrespondenz in der Crushbox",//utf-8
			'title' => "Fantastische Neuigkeiten",
			'add' => "hat beschlossen, Sie zu ihrer Crushbox hinzuzuf&uuml;gen",
			'wait' => "Worauf wartest du"
		],

		'settings' => [
			'subject' => "=C3=84nderung der Typed-Email",//utf-8
			'title' => "Du bist fast da",
			'click' => "Klicken",
			'here' => "hier",
			'confirm' => "um Ihre Email-Adresse zu best&auml;tigen: Sie werden zur Seite Typed-Einstellungen weitergeleitet"
		],

		'note' => "Denken Sie daran: Dieser Link l&auml;uft nach 30 Minuten ab und kann h&ouml;chstens einmal verwendet werden",

		'reply' => "antworte nicht"//utf-8
	];

	$body = $$lang;

	function send(&$address, $subject, $body, $altbody) {
		$emails = [
			"notify@typed.online",
			"recovery@typed.online",
			"support@typed.online"
		];

		$count = count($emails);

		for($send = 0; $send < $count; $send++) {
			try {
				$mail = new PHPMailer(true);

				$mail->SMTPDebug = SMTP::DEBUG_SERVER;
				$mail->isSMTP();
				$mail->SMTPAuth = true;
				$mail->SMTPAutoTLS = false;
				$mail->SMTPSecure = "ssl";
				$mail->isHTML(true);
				$mail->CharSet = "UTF-8";

				$mail->Host = "authsmtp.securemail.pro";
				$mail->Port = 465;
				$mail->Username = "support@typed.online";
				$mail->Password = 'P3ll3Cr@fT\'$_G@m3$';

				$mail->addAddress($address);
				$mail->setFrom($emails[$used = array_rand($emails)], "Typed Support Team");

				$mail->Subject = "=?utf-8?Q?" . $subject . " (" . $GLOBALS['body']['reply'] . ")?=";
				$mail->Body = $body;
				$mail->AltBody = $altbody;

				$mail->send();
				return true;
			} catch (Exception $e) {
				trigger_error($emails[$used] . " could not be used: " . $e->getMessage(), E_USER_NOTICE);
				unset($emails[$used]);
			}
		}

		trigger_error("Error sending the email", E_USER_WARNING);
		return false;
	}
