<?php require_once 'defines.inc.php'?>
<?php

	if(basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]))
	{
		header("Location: " . HTTP . "?error=404");
		exit();
	}

	$description = "Mit Typed k&ouml;nnen Sie herausfinden, was die Leute &uuml;ber Ihr Leben denken, und anonym mit Ihnen sprechen. Treten Sie unserem Crushbox bei oder beantworten Sie die Fragen Ihrer Fans hier oder in Ihrem bevorzugten Sozialen Netzwerk!";
	$short = "Typed, wo du verraten kannst, wer du bist";

	$empty = "F&uuml;llen Sie alle erforderlichen Felder aus";
	$conn = "Fehler beim Herstellen einer Verbindung zum Server. Versuchen Sie es erneut";
	$unknown = "Unbekannter Fehler. Versuchen Sie es erneut";
	$show = "Sehen";
	$here = "hier";

	$validity = "Der Benutzername muss zwischen 3 und 30 Zeichen enthalten und mit einem Buchstaben beginnen. G&uuml;ltige Zeichen: A-Z 0-9 . _";

	$times = [
		'y' => [
			"Jahr",
			"Jahren"
		],
		'm' => [
			"Monat",
			"Monaten"
		],
		'd' => [
			"Tag",
			"Tagen"
		],
		'h' => [
			"Stunde",
			"Stunden"
		],
		'i' => [
			"Minute",
			"Minuten"
		],
		's' => [
			"Sekunde",
			"Sekunden"
		],

		'now' => "Jetzt",

		'ago' => [
			"Vor",
			""
		]
	];

	$header = [
		'alt1' => "Suchen",

		'alt2' => "Scrollen",

		'back' => "Zur&uuml;ck",

		'search' => "Suche nach einer Seite oder Benutzer",

		'theme' => "Thema",

		'personal' => "Pers&ouml;nlich",

		'light' => "Licht",

		'dark' => "Dunkel",

		'random' => "Zuf&auml;llig",

		'personalize' => "Personifizieren"
	];

	$footer = [
		'check' => "Sie sind \\xfcber einen ung\\xfcltigen Link auf diese Seite gekommen",//alert

		'alt1' => "Sprache",

		'bug' => "Einen Fehler melden",

		'advice' => "Uns einen Rat geben",

		'license1' => "Dieses Werk ist lizenziert unter einer ",

		'license2' => "Creative Commons Namensnennung - Keine Bearbeitungen 4.0 International Lizenz",

		'alt2' => "Creative Commons Lizenzvertrag",

		'privacy' => "Datenschutzbestimmungen",

		'terms' => "Nutzungsbedingungen"
	];

	$typed = [
		'title' => "Willkommen bei Typed",

		'results' => [
			'signup' => "Sie haben sich erfolgreich registriert",
			'login' => "Sie haben sich erfolgreich angemeldet",
			'logout' => "Sie haben sich erfolgreich abgemeldet",
			'email' => "Klicken Sie auf den Link in Ihrer Email, um ein Passwort festzulegen",
			'instagram' => "Fehler beim Verbinden mit Instagram. Versuchen Sie es erneut",
			'taken' => "Dieses Instagram-Profil ist einem anderen Konto zugeordnet"
		],

		'errors' => [
			'400' => "Ung&uuml;ltige Anforderung",
			'401' => "Nicht autorisiert",
			'403' => "Verboten",
			'404' => "Nicht gefunden",
			'409' => "Konflikt",
			'500' => "Interner Serverfehler",
			'501' => "Anfrage nicht implementiert",
			'502' => "Schlechtes Gateway",
			'503' => "Dienst nicht verf&uuml;gbar",
			'504' => "Gateway-Zeit&uuml;berschreitung",
			'505' => "Protokollversion wird nicht unterst&uuml;tzt"
		],

		'congratulations' => "Gl\\xfcckw\\xfcnsche",//alert

		'match' => "hat dich auch zu seinem Crushbox hinzugef\\xfcgt",//alert

		'logged' => "Angemeldet als",

		'not-logged' => "Nicht angemeldet",

		'logout' => "Abmelden",

		'signup' => "Registrieren",

		'login' => "Anmelden"
	];

	$instagram = [
		'title' => "Verbinde dich mit Instagram",

		'description' => "Verkn\\xfcpfen Sie Ihr Typed-Konto mit Instagram, um Ihre bevorzugten Sozialen Netzwerke immer in Verbindung zu halten",

		'new' => "Ein neues Konto erstellen",

		'existing' => "Link zu einem bestehenden Konto",

		'posts' => "Beitr&auml;ge",

		'followers' => "Abonnenten",

		'following' => "Abonniert"
	];

	$deletions = [
		'title' => "Instagram Trennungsanfragen",

		'user' => "Benutzername",

		'email' => "Benutzer Email",

		'link' => "Datum der Verbindung zu Instagram",

		'deletion' => "Datum des L&ouml;schens der Daten",

		'source' => "Getrennt &uuml;ber"
	];

	$signup = [
		'title' => "Registrieren",

		'description' => "Erstellen Sie ein neues Typed-Konto, um die Fragen Ihrer Freunde zu beantworten",

		'errors' => [
			'spam' => "Zu viele Emails gesendet",
			'invaliduser' => "Ung&uuml;ltiger Benutzername",
			'invalidemail' => "Ung&uuml;ltige Email",
			'user' => "Dieser Benutzername ist schon vergeben",
			'email' => "Diese Email ist einem anderen Konto zugeordnet",
			'send' => "Die Email konnte nicht gesendet werden. Versuchen Sie es sp&auml;ter erneut"
		],

		'confirm' => "Sie erhalten eine Best&auml;tigungs-Email mit den Anweisungen zum Festlegen eines Passworts",

		'point' => "erh&auml;lt nach deiner Anmeldung 400 Punkte",

		'link' => "Verkn&uuml;pfe dein Profil mit",

		'user' => "Benutzername",

		'password' => "Passwort",

		'repeat' => "Wiederhole dein Passwort",

		'signup' => "Registrieren",

		'register' => "Bereits registriert?",

		'login' => "Anmelden"
	];

	$login = [
		'title' => "Anmelden",

		'description' => "Melden Sie sich bei Typed an, um Ihr Konto immer mitzunehmen",

		'errors' => [
			'invaliduser' => "Ung&uuml;ltiger Benutzername",
			'invalidemail' => "Ung&uuml;ltige Email",
			'user' => "Benutzername nicht gefunden",
			'email' => "Diese Email ist keinem Konto zugeordnet",
			'pwd' => "Falsches Passwort",
			'google' => "Ung&uuml;ltige Google-Authentifizierung"
		],

		'forbidden' => "Sie m&uuml;ssen sich anmelden, um diese Seite zuzugreifen",

		'recovery' => "Passwort erfolgreich aktualisiert",//alert

		'link' => "Verkn&uuml;pfe dein Profil mit",

		'user' => "Benutzername oder Email",

		'validity' => "Geben Sie eine g&uuml;ltige Email",

		'password' => "Passwort",

		'keep' => "Lass mich angemeldet",

		'login' => "Anmelden",

		'or' => "Oder",

		'google' => "Anmelden mit Google",

		'forgot' => "Passwort vergessen",

		'recover' => "Erholen Sie es jetzt",

		'register' => "Noch nicht registriert",

		'signup' => "Registrieren"
	];

	$recovery = [
		'title' => "Wiederherstellung",

		'description' => "Verlieren Sie niemals Ihr Konto: Holen Sie sich Ihr Passwort zur&uuml;ck",

		'errors' => [
			'spam' => "Zu viele Emails gesendet",
			'invalid' => "Ung&uuml;ltige Email",
			'email' => "Diese Email ist keinem Konto zugeordnet",
			'send' => "Die Email konnte nicht gesendet werden. Versuchen Sie es sp&auml;ter erneut"
		],

		'insert' => "Legen Sie Ihre Email in das untenstehende Formular aus",

		'send' => "Wir senden Ihnen eine Email mit dem Wiederherstellungslink",

		'recover' => "Ihr Passwort wiederherstellen"
	];

	$verify = [
		'title' => "Legen Sie ein Passwort fest",

		'description' => "Sicherheit steht bei Typed an erster Stelle: Sch&uuml;tzen Sie Ihre Daten",

		'errors' => [
			'check' => "Sie sind &uuml;ber einen ung&uuml;ltigen Link auf diese Seite gekommen",
			'length' => "Ung&uuml;ltige Passwortl&auml;nge",
			'pwd' => "Die Passw&ouml;rter stimmen nicht &uuml;berein",
			'invalid' => "Ung&uuml;ltige Passwortabfrage",
			'expired' => "Passwortanfrage abgelaufen"
		],

		'link' => "Verkn&uuml;pfe dein Profil mit",

		'pwd' => "Neues Passwort",

		'pwd2' => "Wiederhole das neue Passwort",

		'update' => "Lege ein Passwort fest"
	];

	$main = [
		'anonymous' => "Anonym",

		'hidden' => "Versteckt",

		'visible' => "Sichtbar",

		'listed' => "Aufgef&uuml;hrt",

		'link' => "Link in Bio",

		'click' => "Machen Sie einen Screenshot oder klicken Sie",

		'download' => ", um das Bild herunterzuladen"
	];

	$user = [
		'title' => isset($name) ? ($name === true ? "Ung&uuml;ltiger Benutzer" : ($name ? $name : "Leerer Benutzer")) : '',

		'description' => isset($name) && is_string($name) ? $name . "s Typed-Konto: Blick auf " . $name . "s Typen an und stellen Sie eine neue Frage" : "Fragen Sie Ihre Freunde, was Sie &uuml;ber ihr Leben wollen, und bleiben Sie immer mit ihnen in Verbindung",

		'errors' => [
			'success' => "<i>Type</i> erfolgreich gesendet",
			'anonymous' => "Sie k&ouml;nnen Ihren Namen nicht festlegen, wenn Sie nicht angemeldet sind",
			'hidden' => "Ihre <i>Type</i> ist bereits versteckt, wenn Sie nicht angemeldet sind",
			'length' => "Ung&uuml;ltige <i>Type</i>-l&auml;nge"
		],

		'points' => [//alert
			'success' => "20 Punkte erfolgreich vergeben",
			'self' => "Sie k\\xf6nnen sich keine Punkte geben",
			'invalid' => "Ung\\xfcltiger Benutzername",
			'conn' => "Fehler beim Herstellen einer Verbindung zum Server. Versuchen Sie es erneut",
			'unknown' => "Unbekannter Fehler. Versuchen Sie es erneut",
			'time' => "Sie k\\xf6nnen nur einmal am Tag an jemanden spenden",
			'login' => "Sie m\\xfcssen sich anmelden, um einige Punkte zu vergeben"
		],

		'info' => [
			'visible' => "Ihr Name wird &uuml;ber dem <i>Type</i> angezeigt",
			'anonymous' => "Niemand wird in der Lage sein zu wissen, wer den <i>Type</i> gesendet",
			'listed' => "Sie werden zu bearbeiten oder l&ouml;schen Ihren <i>Type</i> der Lage sein, aus ",
			'hidden' => "Ihr <i>Type</i> wird nicht in der <i>Typen</i>-liste angezeigt",
			'login' => "Sie m&uuml;ssen sich anmelden, um auf diese Funktion zugreifen zu k&ouml;nnen"
		],

		'share' => "Teilen",

		'gain' => "Verdiene Sie einige Punkte",

		'send' => "Sende mir ein neuer Type",

		'alt1' => "Profilbild",

		'type' => "Schreibe deine Type hier",

		'forbidden' => "Sie werden immer anonym sein, wenn Sie sind nicht angemeldet",

		'submit' => "Absenden",

		'break' => "M\\xf6chten Sie Ihren Type senden",//alert

		'meaning' => "Was bedeutet es",

		'types' => "Ihre Typen",

		'reply' => "Antwort auf einige Typen",

		'you' => "Gesendeten Typen pr&uuml;fen",

		'logged' => "Du bist nicht angemeldet",

		'login' => "Anmelden",

		'signup' => "Registrieren",

		'all' => isset($name) ? $name . "s Typen" : '',

		'overflow' => "Typen",

		'empty' => "hat keine Typen: schreiben Sie Ihre eigenen",

		'found' => "Benutzer wurde nicht gefunden",

		'label' => "Suche nach einem anderen Benutzer",

		'search' => "Suchen Sie nach einem Benutzer",

		'alt4' => "Suche"
	];

	$reply = [
		'title' => "Antwort auf Typen",

		'reply' => [
			'success' => "Antwort erfolgreich gesendet",
			'type' => "Sie k&ouml;nnen auf diesen <i>Type</i> nicht antworten",
			'length' => "Ung&uuml;ltige Antwortl&auml;nge"
		],

		'delete' => [
			'success' => "<i>Type</i> erfolgreich gel&ouml;scht",
			'type' => "Sie k&ouml;nnen diesen <i>Type</i> nicht gel&ouml;scht"
		],

		'rules' => "Hier k&ouml;nnen Sie auf den <i>Typen</i> antworten, die Ihre Freunde Ihnen gesendet haben",

		'protection' => "Sie k&ouml;nnen auch den <i>Typen</i> gel&ouml;scht, die Sie als beleidigend oder unangemessen erachten",

		'edit' => "Denken Sie daran: Sobald Sie auf eine <i>Type</i> antwortet haben, k&ouml;nnen Sie Ihre Antwort bearbeiten",

		'send' => "Antworten",

		'break' => "M\\xf6chten Sie Ihre Antwort senden",//alert

		'confirm' => "M\\xf6chten Sie diesen Type wirklich l\\xf6schen? Diese Aktion kann nicht r\\xfcckg\\xe4ngig gemacht werden",//alert

		'del' => "Gel&ouml;scht",

		'input' => "Auf diesen Type antworten",

		'types' => "Sie haben keine neuen Typen",

		'back' => "Alle Ihre Typen anzeigen"
	];

	$types = [
		'title' => "&Uuml;berpr&uuml;fen Sie alle Ihre Typen",

		'edit' => [
			'success' => "<i>Type</i> erfolgreich bearbeitet",
			'type' => "Sie k&ouml;nnen diesen <i>Type</i> nicht bearbeiten",
			'length' => "Ung&uuml;ltige <i>Type</i>-l&auml;nge"
		],

		'delete' => [
			'success' => "<i>Type</i> erfolgreich gel&ouml;scht",
			'type' => "Sie k&ouml;nnen diesen <i>Type</i> nicht gel&ouml;scht"
		],

		'visibility' => [
			'success' => "<i>Type</i>-sichtbarkeit erfolgreich aktualisiert",
			'type' => "Sie k&ouml;nnen die Sichtbarkeit dieses <i>Type</i> nicht &auml;ndern"
		],

		'hide' => [
			'success' => "<i>Type</i> erfolgreich versteckt",
			'type' => "Sie k&ouml;nnen diesen <i>Type</i> nicht verstecken"
		],

		'answer' => [
			'success' => "Antwort erfolgreich bearbeitet",
			'type' => "Sie k&ouml;nnen diese Antwort nicht bearbeiten",
			'length' => "Ung&uuml;ltige Antwortl&auml;nge"
		],

		'rules' => "Dies sind die <i>Typen</i> und Antworten, die Sie bisher gesendet haben: Sie k&ouml;nnen sie bis zu 1 Tag nach dem Senden bearbeiten oder gel&ouml;scht",

		'restrictions' => "Sie k&ouml;nnen Ihren <i>Type</i> nur bearbeiten, wenn sie noch nicht antwortet wurde",

		'show' => "Die <i>Typen</i>, die Sie als <i>versteckt</i> markiert haben, werden auf dieser Seite nicht angezeigt",

		'types' => "Typen",

		'answers' => "Antworten",

		'send' => "Bearbeiten",

		'break' => "M\\xf6chten Sie Ihre \\xc4nderung senden",//alert

		'confirm1' => "M\\xf6chten Sie diesen Type wirklich l\\xf6schen",//alert

		'undo' => "Diese Aktion kann nicht r\\xfcckg\\xe4ngig gemacht werden",//alert

		'del' => "Gel&ouml;scht",

		'confirm2' => "M\\xf6chten Sie den <i>Type</i> wirklich von dieser Seite verbergen",//alert

		'input1' => "Bearbeiten Sie diesen <i>Type</i>",

		'notypes' => "Sie haben noch keine Typen gesendet",

		'back' => "Erhaltenen Typen pr&uuml;fen",

		'input2' => "Bearbeiten Sie diese Antwort",

		'noanswers' => "Sie haben noch keinem Typen antwortet",

		'reply' => "Antwort auf einige Typen"
	];

	$points = [
		'title' => "Verdiene Punkte",

		'description' => "Sammeln Sie mehr Punkte, um Ihren Freunden zu zeigen, wie viel M&uuml;he Sie in Dinge nehmen Sie tun",

		'copy' => "Link kopiert auf Zwischenablage",//alert

		'gain' => [
			'title' => "Wie man Punkte verdiene",
			'gain' => "Sie erhalten",
			'1' => "Punkt f&uuml;r jeden <i>Type</i> von einem nicht-angemeldeten Benutzer",
			'10' => "Punkte f&uuml;r jeden <i>Type</i> von einem angemeldeten Benutzer",
			'20' => "Punkte, wenn jemand zu dir spendet",
			'30' => "Punkte f&uuml;r jede Antwort auf einen <i>Type</i> oder eine Instagram-Freigabe",
			'400' => "Punkte, wenn Sie diese App mit jemandem teilen",
			'1000' => "Punkte, wenn Sie Ihrer Instagram-Biografie Typed hinzuf&uuml;gen"
		],

		'gifts' => [
			'title' => "Geschenke",
			'give' => "Sie k&ouml;nnen jemandem einmal am Tag 20 Punkte geben",
			'lose' => "Sie werden nicht die Punkte verlieren Sie spenden, werden sie einfach hinzugef&uuml;gt werden, wer auch immer Sie wollen"
		],

		'you' => [
			'title' => "Ihre Punkte",
			'points1' => "Sie haben derzeit",
			'points2' => "Punkte",
			'position1' => "Sie befinden sich auf der",
			'position2' => "Position"
		],

		'share' => [
			'title' => "Teilen Typed mit jemandem",
			'rules' => "Wenn sich jemand durch Klicken auf Ihren Link bei Typed anmeldet, erhalten Sie automatisch 400 Punkte",
			'copy' => "Klicken Sie hier zum Kopieren",
			'note' => "Denken Sie daran: Ihr Freund muss vor der Anmeldung auf den Link klicken"
		],

		'biography' => [
			'title' => "F&uuml;gen Sie Ihrer Biografie Typed hinzu",
			'link1' => "Schreiben",
			'link2' => "dies in Ihre Biografie, um 1000 Punkte zu erhalten",
			'check' => "Nochmal &uuml;berpr&uuml;fen",
			'see' => "Sehen deine Biografie",
			'hide' => "Verstecke deine Biografie",
			'note' => "Hinweis: Wenn Sie Typed aus Ihrer Biografie entfernen, werden wir Ihre 1000 Punkte entfernen zu",
			'empty' => "Ihre Biografie ist leer"
		],

		'instagram' => [
			'link1' => "Dein Profil ist nicht mit Instagram verlinkt. Klicken Sie",
			'link2' => "um Ihre Konten zu verbinden",
			'conn' => "Leider k&ouml;nnen wir Ihre Biografie derzeit aufgrund eines Instagram-Problems nicht &uuml;berpr&uuml;fen. Versuchen Sie es sp&auml;ter erneut",
			'none' => "Du hast kein Typed in deiner Instagram-Biografie. Addiere es, um 1000 Punkte zu erhalten",
			'done' => "Gut gemacht! Du hast bereits Typed in deiner Instagram-Biografie"
		]
	];

	$profile = [
		'title' => "Profil",

		'description' => "Greifen Sie auf Ihren Crushbox zu, spenden Sie einige Punkte oder bearbeiten Sie Ihre Profileinstellungen",

		'errors' => [//alert
			'success' => "20 Punkte erfolgreich vergeben",
			'self' => "Sie k\\xf6nnen sich keine Punkte geben",
			'invalid' => "Ung\\xfcltiger Benutzername",
			'conn' => "Fehler beim Herstellen einer Verbindung zum Server. Versuchen Sie es erneut",
			'unknown' => "Unbekannter Fehler. Versuchen Sie es erneut",
			'time' => "Sie k\\xf6nnen nur einmal am Tag an jemanden spenden",
			'login' => "Sie m\\xfcssen sich anmelden, um einige Punkte zu vergeben",
			'crushbox' => "Sie k&ouml;nnen nicht auf den Crushbox einer anderen Person zugreifen"
		],

		'found' => "Benutzer wurde nicht gefunden",//alert

		'alt1' => "Einstellungen",

		'alt2' => "Profilbild",

		'followers' => "Abonnenten",

		'following' => "Abonniert",

		'points' => "Punkte"
	];

	$crushbox = [
		'title' => 'Crushbox',

		'description' => "Nehmen Sie Ihre Geheimnisse mit und lassen Sie Ihren Traum wahr werden",

		/*start*/
		'start' => [
			'length' => "Ung&uuml;ltige Passwortl&auml;nge",
			'pwd' => "Die Passw&ouml;rter stimmen nicht &uuml;berein"
		],

		'welcome' => [
			'title' => "Willkommen bei Crushbox",
			'first' => "Sie k&ouml;nnen bis zu drei <i>Crushes</i> ausw&auml;hlen",
			'second' => "Ihre <i>Crushes</i> werden nicht benachrichtigt, wenn Sie w&auml;hlen, es sei denn, sie dich auch als ihre <i>Crush</i> gesetzt",
			'third' => "Wenn Ihre <i>Crush</i> Sie in den <i>Crushbox</i> ausw&auml;hlt, werden Sie benachrichtigt und",
			'fourth' => "Gl&uuml;ckw&uuml;nsche: Sie haben Ihren Partner gefunden"
		],

		'rules' => [
			'title' => "Regeln",
			'first' => "Sie k&ouml;nnen bis zu drei <i>Crushs</i> in Ihrem <i>Crushbox</i> ausw&auml;hlen",
			'second' => "Um eine <i>Crush</i> zu setzen, gehen Sie in Ihren <i>Crushbox</i> und geben Sie den Typed-Benutzernamen Ihrer geheimen <i>Crush</i> ein",
			'third' => "Sobald Sie eine <i>Crush</i> eingestellt haben, k&ouml;nnen Sie sie 10 Tage lang nicht mehr deaktivieren",
			'fourth' => "Wenn Sie m&ouml;chten, k&ouml;nnen Sie Ihren <i>Crushbox</i> mit einem Passwort sch&uuml;tzen: es wird automatisch gesperrt, nach ",
			'fifth' => " Minuten"
		],

		'pwd' => "Legen Sie ein Passwort fest",

		'not-pwd' => "Legen Sie kein Passwort fest",

		'set' => "Passwort festlegen",

		'not-set' => "Loslegen",

		'password' => "Passwort",

		'repeat' => "Wiederhole dein Passwort",

		/*login*/
		'login' => [
			'pwd' => "Falsches Passwort"
		],

		'expire1' => "Geben Sie Ihr Passwort ein (es wird nach ",

		'expire2' => " Minuten ablaufen)",

		'join' => "Geh in den",

		/*crushbox*/
		'errors' => [
			'success' => "<i>Crushbox</i> erfolgreich aktualisiert",
			'self' => "Sie k&ouml;nnen sich nicht als Ihre <i>Crush</i> festlegen",
			'twice' => "Sie k&ouml;nnen dieselbe Katze nicht zweimal einstellen",
			'length' => "Ung&uuml;ltige <i>Crush</i>-L&auml;nge",
			'first' => "Die erste <i>Crush</i> existiert nicht",
			'second' => "Die zweite <i>Crush</i> existiert nicht",
			'third' => "Die dritte <i>Crush</i> existiert nicht",
			'start' => "<i>Crushbox</i> erfolgreich gesetzt",
			'login' => "Sie haben sich erfolgreich angemeldet"
		],

		'congratulations' => "Gl&uuml;ckw&uuml;nsche",

		'match' => "hat dich auch zu seinem <i>Crushbox</i> hinzugef&uuml;gt",

		'added' => "Sie wurden von ",

		'person' => " Person zum <i>Crushbox</i> hinzugef&uuml;gt! Wer k&ouml;nnte es sein?",

		'people' => " Personen zum <i>Crushbox</i> hinzugef&uuml;gt! Wer k&ouml;nnten sie sein?",

		'first' => "Erste",

		'second' => "Zweite",

		'third' => "Dritte",

		'expire' => "Ablaufzeit",

		'logout' => "Abmelden",

		'add' => "Hinzuf&uuml;gen",

		'reset' => "Zur&uuml;cksetzen",

		'update' => "Aktualisierung",

		'tutorial' => "Regeln pr&uuml;fen oder Passwort zur&uuml;cksetzen"
	];

	$settings = [
		'title' => "Einstellungen",

		'description' => "&Auml;ndern Sie Ihren Benutzernamen, Ihre Email oder aktualisieren Sie Ihr Profilbild",

		'file' => [
			'success' => "Avatar erfolgreich aktualisiert",
			'error' => "Fehler beim Hochladen der Datei",
			'size' => "Das Bild muss gr&ouml;&szlig;er als 3KB und kleiner als 2MB sein",
			'invalid' => "Ung&uuml;ltige ",
			'image' => "-datei: laden Sie ein Bild hoch"
		],

		'remove' => [
			'success' => "Avatar erfolgreich gel&ouml;scht",
			'empty' => "Sie hatte kein Profilbild",
			'error' => "Die Datei konnte nicht gel&ouml;scht werden"
		],

		'user' => [
			'success' => "Benutzername erfolgreich aktualisiert",
			'invalid' => "Ung&uuml;ltiger Benutzername",
			'taken' => "Dieser Benutzername ist schon vergeben"
		],

		'email' => [
			'success' => "Email erfolgreich aktualisiert",
			'pending' => "&Uuml;berpr&uuml;fen Sie Ihre Email zur Best&auml;tigung der Aktualisierung",
			'spam' => "Zu viele Emails gesendet",
			'invalid' => "Ung&uuml;ltige Email",
			'taken' => "Diese Email ist einem anderen Konto zugeordnet",
			'send' => "Die Email konnte nicht gesendet werden. Versuchen Sie es sp&auml;ter erneut",
			'link' => "Ung&uuml;ltiger Link zum &Auml;ndern der Email",
			'expired' => "Link zum &Auml;ndern der Email abgelaufen"
		],

		'privacy' => [
			'success' => "Privatsph&auml;re erfolgreich aktualisiert"
		],

		'unlink' => [
			'success' => "Erfolgreich von Instagram getrennt",
			'instagram' => "Instagram wurde bereits &uuml;ber die Anwendung getrennt"
		],

		'old' => [
			'success' => "Passwort erfolgreich aktualisiert",
			'wrong' => "Falsches Passwort"
		],

		'pwd' => [
			'length' => "Ung&uuml;ltige Passwortl&auml;nge",
			'match' => "Die Passw&ouml;rter stimmen nicht &uuml;berein"
		],

		'avatar' => [
			'title' => "&Auml;ndere deinen Avatar",
			'remove' => "Entferne deinen Avatar"
		],

		'account' => [
			'title' => "Kontoeinstellungen",
			'user' => "Benutzernamen &auml;ndern",
			'email' => "&Auml;ndern Sie die Email",
			'private' => "Privat",
			'public' => "&Ouml;ffentlich",
			'unlink' => "Trenne dein Profil von ",
			'link' => "Verkn&uuml;pfe dein Profil mit Instagram"
		],

		'password' => [
			'title' => "Passwort zur&uuml;cksetzen",
			'old' => "Altes Passwort",
			'pwd' => "Neues Kennwort",
			'pwd2' => "Wiederhole das neue Passwort"
		],

		'reset' => "Zur&uuml;cksetzen",

		'save' => "&Auml;nderungen speichern"
	];

	$style = [
		'title' => "Personifizieren",

		'description' => "W&auml;hlen Sie Ihren Stil, um die beste Erfahrung mit Typed zu erzielen",

		'errors' => [
			'green' => "Ung&uuml;ltige gr&uuml;ne Farbe",
			'blue' => "Ung&uuml;ltige blaue Farbe",
			'brown' => "Ung&uuml;ltige braune Farbe",
			'white' => "Ung&uuml;ltige wei&szlig;e Farbe",
			'black' => "Ung&uuml;ltige schwarze Farbe",
			'gray' => "Ung&uuml;ltige graue Farbe"
		],

		'green' => "Gr&uuml;n",

		'blue' => "Blau",

		'brown' => "Braun",

		'white' => "Wei&szlig;",

		'black' => "Schwarz",

		'gray' => "Grau",

		'keep' => "Verkn&uuml;pfen Sie mit Ihrem Konto",

		'forbidden' => "Sie m&uuml;ssen sich anmelden, um Ihren Stil beizubehalten",

		'delete' => "L&ouml;schen Sie Ihren aktuellen Stil",

		'set' => "Setzen Sie Ihre neuen Farben"
	];

	$contact = [
		'language' => "Sie k&ouml;nnen uns in jeder Sprache schreiben",

		'optional' => "fakultativ",

		'logged' => "Sie m&uuml;ssen sich anmelden, um diese Seite zuzugreifen",

		'goto' => "Gehe zu",

		'main' => "Hauptseite",

		'login' => "Anmelden",

		'signup' => "Registrieren",

		'user' => "Benutzerseite",

		'reply' => "Auf Typen antworten",

		'types' => "Typen bearbeiten",

		'points' => "Verdiene Punkte",

		'search' => "Suchseite",

		'instagram' => "Instagram anmelden",

		'profile' => (isset($_SESSION['id']) ? $_user."s " : "Profil") . "seite",

		'settings' => "Einstellungen",

		'style' => "Stil personalisieren",

		'other' => "Andere"
	];

	$bug = [
		'title' => "Einen Fehler melden",

		'description' => "Helfen Sie uns, uns selbst und Ihre Erfahrungen zu verbessern",

		'errors' => [
			'success' => "Fehlerbericht erfolgreich gesendet",
			'page' => "Ung&uuml;ltige Webseite Seite",
			'email' => "Ung&uuml;ltige Email",
			'content' => "Ung&uuml;ltige L&auml;nge des Fehlerberichts"
		],

		'paragraph' => "Melden Sie hier alle Fehler, die Sie auf dieser Website gefunden haben, um uns bei der Verbesserung zu helfen",

		'page' => "Auf welcher Seite haben Sie den Fehler gefunden",

		'textarea' => "F&uuml;gen Sie hier eine Erkl&auml;rung des Fehlers ein",

		'submit' => "Bericht einreichen"
	];

	$advice = [
		'title' => "Geben Sie uns einen Rat",

		'description' => "Sagen Sie uns, was Sie denken, um Ihre Ideen in die Realit&auml;t umzusetzen",

		'errors' => [
			'success' => "Rat erfolgreich gesendet",
			'page' => "Ung&uuml;ltige Webseite Seite",
			'email' => "Ung&uuml;ltige Email",
			'content' => "Ung&uuml;ltige L&auml;nge Ihres Ratschlags"
		],

		'paragraph' => "Geben Sie uns einige Ratschl&auml;ge zur Website, damit wir uns verbessern k&ouml;nnen",

		'page' => "F&uuml;r welche Seite ist der Rat",

		'textarea' => "F&uuml;gen Sie hier eine Erkl&auml;rung Ihres Ratschlags ein",

		'submit' => "Ratschl&auml;ge einreichen"
	];
