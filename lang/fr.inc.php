<?php require_once 'defines.inc.php'?>
<?php

	if(basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]))
	{
		header("Location: " . HTTP . "?error=404");
		exit();
	}

	$description = "Typed vous aide &agrave; d&eacute;couvrir ce que les gens pensent de votre vie et aide les gens &agrave; vous parler anonymement. Rejoignez notre Crushbox ou r&eacute;pondez aux questions de vos fans ici ou sur votre r&eacute;seau social pr&eacute;f&eacute;r&eacute;!";
	$short = "Typed, o&ugrave; vous pouvez r&eacute;v&eacute;ler qui vous &ecirc;tes";

	$empty = "Remplissez tous les champs obligatoires";
	$conn = "Erreur de connexion au serveur. Essayez &agrave; nouveau";
	$unknown = "Erreur inconnue. Essayez &agrave; nouveau";
	$show = "Montrer";
	$here = "ici";

	$validity = "Le nom d\\'utilisateur doit comprendre entre 3 et 30 caract&egrave;res et commencer par une lettre. Caract&egrave;res valides: A-Z 0-9. _";

	$times = [
		'y' => [
			"an",
			"ans"
		],
		'm' => [
			"mois",
			"mois"
		],
		'd' => [
			"jour",
			"jours"
		],
		'h' => [
			"heure",
			"heures"
		],
		'i' => [
			"minute",
			"minutes"
		],
		's' => [
			"seconde",
			"secondes"
		],

		'now' => "Maintenant",

		'ago' => [
			"Il y a",
			""
		]
	];

	$header = [
		'alt1' => "Rechercher",

		'alt2' => "D&eacute;filer",

		'back' => "Arri&egrave;re",

		'search' => "Rechercher une page ou un utilisateur",

		'theme' => "Th&egrave;me",

		'personal' => "Personnel",

		'light' => "Clair",

		'dark' => "Sombre",

		'random' => "Al&eacute;atoire",

		'personalize' => "Personnaliser"
	];

	$footer = [
		'check' => "Vous \\xeates entr\\xe9 sur cette page \\xe0 partir d\\'un lien invalide",//alert

		'alt1' => "Langue",

		'bug' => "Signaler une erreur",

		'advice' => "Donnez-nous un conseil",

		'license1' => "Cette &oelig;uvre est mise &agrave; disposition selon les termes de la ",

		'license2' => "Licence Creative Commons Attribution - Pas de Modification 4.0 International",

		'alt2' => "Licence Creative Commons",

		'privacy' => "Politique de confidentialit&eacute;",

		'terms' => "Conditions d'utilisation"
	];

	$typed = [
		'title' => "Bienvenue &agrave; Typed",

		'results' => [
			'signup' => "Vous vous &ecirc;tes inscrit avec succ&egrave;s",
			'login' => "Vous vous &ecirc;tes connect&eacute; avec succ&egrave;s",
			'logout' => "Vous vous &ecirc;tes d&eacute;connect&eacute; avec succ&egrave;s",
			'email' => "Cliquez sur le lien de votre email pour choisir votre mot de passe",
			'instagram' => "Erreur de connexion &agrave; Instagram. Essayez &agrave; nouveau",
			'taken' => "Ce profil Instagram est associ&eacute; &agrave; un autre compte"
		],

		'errors' => [
			'400' => "Mauvaise Demande",
			'401' => "Non Autoris&eacute;",
			'403' => "Interdit",
			'404' => "Pas Trouv&eacute;",
			'409' => "Conflit",
			'500' => "Erreur Interne du Serveur",
			'501' => "Demande non Mise en &OElig;uvre",
			'502' => "Pas de R&eacute;ponse",
			'503' => "Service Indisponible",
			'504' => "R&eacute;ponse Trop Lente",
			'505' => "Version du Protocole non Prise en Charge"
		],

		'congratulations' => "F\\xe9licitations",//alert

		'match' => "vous a ajout\\xe9 \\xe0 sa Crushbox aussi",//alert

		'logged' => "Connect&eacute; en tant que",

		'not-logged' => "Non connect&eacute;",

		'logout' => "Se d&eacute;connecter",

		'signup' => "S'inscrire",

		'login' => "Se connecter"
	];

	$instagram = [
		'title' => "Se connecter &agrave; Instagram",

		'description' => "Liez votre Typed compte &agrave; Instagram pour garder vos R&eacute;seaux Sociaux pr&eacute;f&eacute;r&eacute;s toujours connect&eacute;s",

		'new' => "Cr&eacute;er un nouveau compte",

		'existing' => "Lien vers un compte existant",

		'posts' => "Publications",

		'followers' => "Followers",

		'following' => "Following"
	];

	$deletions = [
		'title' => "Dissociations de Instagram",

		'user' => "Nom d'utilisateur",

		'email' => "Email de l'utilisateur",

		'link' => "Date de connexion &agrave; Instagram",

		'deletion' => "Date de suppression des donn&eacute;es",

		'source' => "Dissoci&eacute; via"
	];

	$signup = [
		'title' => "S'inscrire",

		'description' => "Cr&eacute;ez un nouveau compte pour commencer &agrave; r&eacute;pondre aux questions de vos amis",

		'errors' => [
			'spam' => "Trop de emails envoy&eacute;s",
			'invaliduser' => "Nom d'utilisateur invalide",
			'invalidemail' => "Email invalide",
			'user' => "Cet identifiant existe d&eacute;j&agrave;",
			'email' => "Cet email est associ&eacute; &agrave; un autre compte",
			'send' => "L'email n'a pas pu &ecirc;tre envoy&eacute;. Essayez &agrave; nouveau"
		],

		'confirm' => "Vous recevrez un email de confirmation avec des instructions pour d&eacute;finir un mot de passe",

		'point' => "obtiendra 400 points apr&egrave;s votre inscription",

		'link' => "Liez votre profil &agrave;",

		'user' => "Nom d'utilisateur",

		'password' => "Mot de passe",

		'repeat' => "R&eacute;p&eacute;tez votre mot de passe",

		'signup' =>"S'inscrire",

		'register' => "D&eacute;j&agrave; inscrit?",

		'login' => "Connectez-vous!"
	];

	$login = [
		'title' => "Se connecter",

		'description' => "Connectez-vous &agrave; Typed pour toujours apporter votre compte avec vous",

		'errors' => [
			'invaliduser' => "Nom d'utilisateur invalide",
			'invalidemail' => "Email invalide",
			'user' => "Nom d'utilisateur non trouv&eacute;",
			'email' => "Cet email n'est pas associ&eacute; &agrave; un compte",
			'pwd' => "Mauvais mot de passe",
			'google' => "Authentification Google invalide"
		],

		'forbidden' => "Vous devez vous connecter pour acc&eacute;der &agrave; cette page",

		'recovery' => "Mot de passe mis \\xe0 jour avec succ\\xe8s",//alert

		'link' => "Liez votre profil &agrave;",

		'user' => "Nom d'utilisateur ou Email",

		'validity' => "Ins&eacute;rez un email valide",

		'password' => "Mot de passe",

		'keep' => "Rester connect&eacute;",

		'login' => "Se connecter",

		'or' => "Ou",

		'google' => "Connecter avec Google",

		'forgot' => "Mot de passe oubli&eacute;",

		'recover' => "R&eacute;cup&eacute;rer maintenant",

		'register' => "Pas encore inscrit",

		'signup' => "Inscrirez-vous"
	];

	$recovery = [
		'title' => "Mot de passe Oubli&eacute;",

		'description' => "Ne perdez jamais votre compte: r&eacute;cup&eacute;rez le mot de passe",

		'errors' => [
			'spam' => "Trop de emails envoy&eacute;s",
			'email' => "Email invalide",
			'invalid' => "Cet email n'est associ&eacute; &agrave; aucun compte",
			'send' => "L'email n'a pas pu &ecirc;tre envoy&eacute;. R&eacute;essayez plus tard"
		],

		'insert' => "Ins&eacute;rez votre email dans le formulaire ci-dessous",

		'send' => "Nous vous enverrons un email contenant le lien de r&eacute;cup&eacute;ration",

		'recover' => "R&eacute;cup&eacute;rez le mot de passe"
	];

	$verify = [
		'title' => "D&eacute;finir Mot de Passe",

		'description' => "La s&eacute;curit&eacute; passe avant tout sur Typed: prot&eacute;gez vos donn&eacute;es",

		'errors' => [
			'check' => "Vous &ecirc;tes entr&eacute; sur cette page &agrave; partir d'un lien invalide",
			'length' => "Longueur de mot de passe invalide",
			'pwd' => "Les mots de passe ne correspondent pas",
			'invalid' => "Demande invalide",
			'expired' => "Demande expir&eacute;"
		],

		'link' => "Liez votre profil &agrave;",

		'pwd' => "Nouveau mot de passe",

		'pwd2' => "R&eacute;p&eacute;tez le nouveau mot de passe",

		'update' => "D&eacute;finir un mot de passe"
	];

	$main = [
		'anonymous' => "Anonyme",

		'hidden' => "Cach&eacute;",

		'visible' => "Visible",

		'listed' => "R&eacute;pertori&eacute;",

		'link' => "Lien en bio",

		'click' => "Faites une capture d'&eacute;cran ou cliquez",

		'download' => " pour t&eacute;l&eacute;charger l'image"
	];

	$user = [
		'title' => isset($name) ? ($name === true ? "Utilisateur invalide" : ($name ? $name : "Utilisateur vide")) : '',

		'description' => isset($name) && is_string($name) ? $name . "Compte Typed de " . $name . ": regardez les Types de " . $name . " ou posez une nouvelle question" : "Demandez &agrave; vos amis ce que vous voulez de leur vie et restez toujours en contact avec eux",

		'errors' => [
			'success' => "<i>Type</i> envoy&eacute; avec succ&egrave;s",
			'anonymous' => "Vous ne pouvez pas d&eacute;finir votre nom si vous n'&ecirc;tes pas connect&eacute;",
			'hidden' => "Votre <i>Type</i> est d&eacute;j&agrave; cach&eacute; si vous n'&ecirc;tes pas connect&eacute;",
			'length' => "Longueur de <i>Type</i> invalide"
		],

		'points' => [//alert
			'success' => "20 points donn\\xe9es avec succ\\xe8s",
			'self' => "Vous ne pouvez pas vous donner des points",
			'invalid' => "Nom d\\'utilisateur invalide",
			'conn' => "Erreur de connexion au serveur. Essayez \\xe0 nouveau",
			'unknown' => "Erreur inconnue. Essayez \\xe0 nouveau",
			'time' => "Vous ne pouvez donner 20 points \\xe0 quelqu\\'un qu\\'une fois par jour",
			'login' => "Vous devez vous connecter pour donner des point"
		],

		'info' => [
			'visible' => "Votre nom sera visible au-dessus du <i>Type</i>",
			'anonymous' => "Personne ne pourra savoir qui a envoy&eacute; le <i>Type</i>",
			'listed' => "Vous pourrez modifier ou supprimer votre <i>Type</i> d'",
			'hidden' => "Le <i>Type</i> ne sera pas affich&eacute; dans la liste de vos <i>Types</i>",
			'login' => "Vous devez vous connecter pour acc&eacute;der &agrave; cette fonctionnalit&eacute;"
		],

		'share' => "Partager",

		'gain' => "Gagner des points",

		'send' => "Envoie moi un nouveau Type",

		'alt1' => "Image de profil",

		'type' => "&Eacute;crivez votre Type ici",

		'forbidden' => "Vous serez toujours anonyme si vous n\\'&ecirc;tes pas connect&eacute;",

		'submit' => "Envoyer",

		'break' => "Voulez-vous envoyer le Type",//alert

		'meaning' => "Qu'est-ce que &ccedil;a veut dire",

		'types' => "Vos Types",

		'reply' => "R&eacute;pondre &agrave; certains Types",

		'you' => "Voir les Types envoy&eacute;s",

		'logged' => "Vous n'&ecirc;tes pas connect&eacute;",

		'login' => "Se connecter",

		'signup' => "S'inscrire",

		'all' => isset($name) ? "Types de " . $name : '',

		'overflow' => "Types",

		'empty' => "n'a pas de Types: &eacute;crivez le premier",

		'found' => "Utilisateur non trouv&eacute;",

		'label' => "Rechercher un autre utilisateur",

		'search' => "Rechercher un utilisateur",

		'alt4' => "Rechercher"
	];

	$reply = [
		'title' => "R&eacute;pondre aux Types",

		'reply' => [
			'success' => "R&eacute;ponse envoy&eacute;e avec succ&egrave;s",
			'type' => "Vous ne pouvez pas r&eacute;pondre &agrave; ce <i>Type</i>",
			'length' => "Longueur de r&eacute;ponse non valide"
		],

		'delete' => [
			'success' => "<i>Type</i> supprim&eacute; avec succ&egrave;s",
			'type' => "Vous ne pouvez pas supprimer ce <i>Type</i>"
		],

		'rules' => "Ici vous pouvez r&eacute;pondre aux <i>Types</i> que vos amis vous ont envoy&eacute;s",

		'protection' => "Vous pouvez &eacute;galement supprimer les <i>Types</i> que vous jugez offensants ou inappropri&eacute;s",

		'edit' => "N'oubliez pas: une fois que vous avez r&eacute;pondu &agrave; un <i>Type</i>, vous pouvez modifier votre r&eacute;ponse",

		'send' => "R&eacute;pondre",

		'break' => "Voulez-vous envoyer votre r\\xe9ponse",//alert

		'confirm' => "Voulez-vous vraiment supprimer ce Type? Cette action ne peut pas \\xeatre annul\\xe9e",//alert

		'del' => "Supprimer",

		'input' => "R&eacute;pondez &agrave; ce Type",

		'types' => "Vous n'avez pas de nouveaux Types",

		'back' => "Voir tous vos Types"
	];

	$types = [
		'title' => "Voir tous vos Types",

		'edit' => [
			'success' => "<i>Type</i> modifi&eacute; avec succ&egrave;s",
			'type' => "Vous ne pouvez pas modifier ce <i>Type</i>",
			'length' => "Longueur de <i>Type</i> non valide"
		],

		'delete' => [
			'success' => "<i>Type</i> supprim&eacute; avec succ&egrave;s",
			'type' => "Vous ne pouvez pas supprimer ce <i>Type</i>"
		],

		'visibility' => [
			'success' => "Visibilit&eacute; du <i>Type</i> mis &agrave; jour avec succ&egrave;s",
			'type' => "Vous ne pouvez pas modifier la visibilit&eacute; de ce <i>Type</i>"
		],

		'hide' => [
			'success' => "<i>Type</i> cach&eacute; avec succ&egrave;s",
			'type' => "Vous ne pouvez pas cacher ce <i>Type</i>"
		],

		'answer' => [
			'success' => "R&eacute;ponse modifi&eacute;e avec succ&egrave;s",
			'type' => "Vous ne pouvez pas modifier cette r&eacute;ponse",
			'length' => "Longueur de r&eacute;ponse non valide"
		],

		'rules' => "Voici les <i>Types</i> et les r&eacute;ponses que vous avez envoy&eacute;s &agrave; ce jour: vous pouvez les modifier ou les supprimer jusqu'&agrave; 1 jour apr&egrave;s l'envoi",

		'restrictions' => "Vous ne pouvez modifier votre <i>Type</i> que s'il n'a pas d&eacute;j&agrave; &eacute;t&eacute; r&eacute;pondu",

		'show' => "Les <i>Types</i> que vous avez marqu&eacute;s comme <i>cach&eacute;</i> n'apparaissent pas sur cette page",

		'types' => "Types",

		'answers' => "R&eacute;ponses",

		'send' => "Modifier",

		'break' => "Voulez-vous envoyer votre modification",//alert

		'confirm1' => "Voulez-vous vraiment supprimer ce Type",//alert

		'undo' => "Cette action ne peut pas \\xeatre annul\\xe9e",//alert

		'del' => "Supprimer",

		'confirm2' => "Voulez-vous vraiment cacher le Type de cette page",//alert

		'input1' => "Modifier ce Type",

		'notypes' => "Vous n'avez encore envoy&eacute; aucun Type",

		'back' => "Voir les Types re&ccedil;us",

		'input2' => "Modifier cette r&eacute;ponse",

		'noanswers' => "Vous n'avez encore r&eacute;pondu &agrave; aucun Type",

		'reply' => "R&eacute;pondre &agrave; certains Types"
	];

	$points = [
		'title' => "Gagner des Points",

		'description' => "Gagnez plus de points pour montrer &agrave; vos amis combien d'efforts vous faites dans ce que vous faites",

		'copy' => "Lien copi\\xe9 dans le presse-papiers",//alert

		'gain' => [
			'title' => "Comment gagner quelques points",
			'gain' => "Tu gagnes",
			'1' => "point pour chaque <i>Type</i> d'un utilisateur non connect&eacute;",
			'10' => "points pour chaque <i>Type</i> d'un utilisateur connect&eacute;",
			'20' => "points si quelqu'un vous fait un cadeau",
			'30' => "points pour chaque r&eacute;ponse &agrave; un <i>Type</i> ou un partage Instagram",
			'400' => "points si vous partagez cette application avec quelqu'un",
			'1000' => "points si vous ajoutez Typed &agrave; votre biographie Instagram"
		],

		'gifts' => [
			'title' => "Cadeaux",
			'give' => "Vous pouvez donner 20 points &agrave; quelqu'un une fois par jour",
			'lose' => "Vous ne perdrez pas les points que vous donnez, ils seront simplement ajout&eacute;s &agrave; qui vous voulez"
		],

		'you' => [
			'title' => "Vos points",
			'points1' => "Vous avez actuellement",
			'points2' => "points",
			'position1' => "Vous &ecirc;tes en",
			'position2' => "position"
		],

		'share' => [
			'title' => "Partager Typed avec quelqu'un",
			'rules' => "Si quelqu'un s'inscrit &agrave; Typed en cliquant sur votre lien, vous recevrez automatiquement 400 points",
			'copy' => "cliquez ici pour copier",
			'note' => "N'oubliez pas: votre ami doit cliquer sur le lien avant de s'inscrire"
		],

		'biography' => [
			'title' => "Ajouter Typed &agrave; votre biographie",
			'link1' => "&Eacute;crivez",
			'link2' => "dans votre biographie pour gagner 1000 points",
			'check' => "Rev&eacute;rifier",
			'see' => "Voir votre biographie",
			'hide' => "Cacher la biographie",
			'note' => "Remarque: si vous supprimez Typed de votre biographie, nous supprimerons vos 1000 points aussi",
			'empty' => "Votre biographie est vide"
		],

		'instagram' => [
			'link1' => "Votre profil n'est pas connect&eacute; &agrave; Instagram. Cliquez",
			'link2' => "pour connecter vos comptes",
			'conn' => "D&eacute;sol&eacute;, nous ne pouvons pas v&eacute;rifier votre biographie pour le moment en raison d'un probl&egrave;me Instagram. R&eacute;essayez plus tard",
			'none' => "Vous n'avez pas Typed dans votre biographie Instagram. Ajoutez-le pour gagner 1000 points",
			'done' => "Bien fait! Typed est d&eacute;j&agrave; pr&eacute;sente dans votre biographie Instagram"
		]
	];

	$profile = [
		'title' => "Profil",

		'description' => "Acc&eacute;dez &agrave; votre Crushbox, donnez des points ou modifiez vos pr&eacute;f&eacute;rences de profil",

		'errors' => [//alert
			'success' => "20 points donn\\xe9es avec succ\\xe8s",
			'self' => "Vous ne pouvez pas vous donner des points",
			'invalid' => "Nom d\\'utilisateur invalide",
			'conn' => "Erreur de connexion au serveur. Essayez \\xe0 nouveau",
			'unknown' => "Erreur inconnue. Essayez \\xe0 nouveau",
			'time' => "Vous ne pouvez donner 20 points \\xe0 quelqu\\'un qu\\'une fois par jour",
			'login' => "Vous devez vous connecter pour donner des point",
			'crushbox' => "Vous ne pouvez pas acc\\xe9der \\xe0 la Crushbox de quelqu\\'un d\\'autre"
		],

		'found' => "Utilisateur non trouv\\xe9",//alert

		'alt1' => "Param&egrave;tres",

		'alt2' => "Image de profil",

		'followers' => "Abonn&eacute;s",

		'following' => "Abonnements",

		'points' => "Points"
	];

	$crushbox = [
		'title' => "Crushbox",

		'description' => "Gardez vos secrets avec vous et r&eacute;alisez votre r&ecirc;ve",

		/*start*/
		'start' => [
			'length' => "Longueur de mot de passe invalide",
			'pwd' => "Les mots de passe ne correspondent pas"
		],

		'welcome' => [
			'title' => "Bienvenue sur Crushbox",
			'first' => "Vous pouvez choisir jusqu'&agrave; trois <i>Crushes</i>",
			'second' => "Vos <i>Crushes</i> ne seront pas inform&eacute;s si vous les choisissez, &agrave; moins qu'ils ne vous d&eacute;finissent &eacute;galement comme <i>Crush</i>",
			'third' => "Si vos <i>Crush</i> vous choisit dans la <i>Crushbox</i>, vous serez inform&eacute; et",
			'fourth' => "F&eacute;licitations: vous avez trouv&eacute; votre &acirc;me s&oelig;ur"
		],

		'rules' => [
			'title' => "R&egrave;gles",
			'first' => "Vous pouvez choisir jusqu'&agrave; trois <i>Crushes</i> pour votre <i>Crushbox</i>",
			'second' => "Pour d&eacute;finir une <i>Crush</i>, entrez dans votre <i>Crushbox</i> et ins&eacute;rez le nom d'utilisateur sur Typed de votre secret <i>Crush</i>",
			'third' => "Une fois que vous avez d&eacute;fini une <i>Crush</i>, vous ne pouvez pas le d&eacute;sarmer pendant 10 jours",
			'fourth' => "Si vous voulez, vous pouvez prot&eacute;ger votre <i>Crushbox</i> avec un mot de passe: il se verrouillera automatiquement apr&egrave;s ",
			'fifth' => " minutes"
		],

		'pwd' => "D&eacute;finissez un mot de passe",

		'not-pwd' => "Ne d&eacute;finissez pas de mot de passe",

		'set' => "D&eacute;finir le mot de passe",

		'not-set' => "Commencer",

		'password' => "Mot de passe",

		'repeat' => "R&eacute;p&eacute;tez votre mot de passe",

		/*login*/
		'login' => [
			'pwd' => "Mauvais mot de passe"
		],

		'expire1' => "Ins&eacute;rez votre mot de passe (il expirera dans ",

		'expire2' => " minutes)",

		'join' => "Entrer dans",

		/*crushbox*/
		'errors' => [
			'success' => "<i>Crushbox</i> mise &agrave; jour avec succ&egrave;s",
			'self' => "Vous ne pouvez pas vous d&eacute;finir comme votre <i>Crush</i>",
			'twice' => "Vous ne pouvez pas d&eacute;finir le m&ecirc;me <i>Crush</i> deux fois",
			'length' => "Longueur de <i>Crush</i> invalide",
			'first' => "La premi&egrave;re <i>Crush</i> n'existe pas",
			'second' => "La deuxi&egrave;me <i>Crush</i> n'existe pas",
			'third' => "La troisi&egrave;me <i>Crush</i> n'existe pas",
			'start' => "<i>Crushbox</i> d&eacute;finie avec succ&egrave;s",
			'login' => "Vous vous &ecirc;tes connect&eacute; avec succ&egrave;s"
		],

		'congratulations' => "F&eacute;licitations",

		'match' => "vous a ajout&eacute; &agrave; sa <i>Crushbox</i> aussi",

		'added' => "Vous avez &eacute;t&eacute; ajout&eacute; &agrave; la <i>Crushbox</i> de ",

		'person' => " personne! Qui pourrait-il &ecirc;tre?",

		'people' => " personnes! Qui pourraient-ils &ecirc;tre?",

		'first' => "Premi&egrave;re Crush",

		'second' => "Deuxi&egrave;me Crush",

		'third' => "Troisi&egrave;me Crush",

		'expire' => "Temps d'expiration",

		'logout' => "Se d&eacute;connecter",

		'add' => "Ajouter",

		'reset' => "R&eacute;initialiser",

		'update' => "Mise &agrave; jour",

		'tutorial' => "Revoir r&egrave;gles ou R&eacute;initialiser mot de passe"
	];

	$settings = [
		'title' => "Param&egrave;tres",

		'description' => "Modifiez votre nom d'utilisateur, votre email ou mettez &agrave; jour votre photo de profil",

		'file' => [
			'success' => "Avatar mis &agrave; jour avec succ&egrave;s",
			'error' => "Erreur lors du t&eacute;l&eacute;chargement du fichier",
			'size' => "L'image doit &ecirc;tre sup&eacute;rieure &agrave; 3KB et inf&eacute;rieure &agrave; 3MB",
			'invalid' => "Fichier de type ",
			'image' => " non valide: t&eacute;l&eacute;chargez une image"
		],

		'remove' => [
			'success' => "Avatar supprim&eacute; avec succ&egrave;s",
			'empty' => "Vous n'aviez pas de photo de profil",
			'error' => "N'a pas pu supprimer le fichier"
		],

		'user' => [
			'success' => "Nom d'utilisateur mis &agrave; jour avec succ&egrave;s",
			'invalid' => "Nom d'utilisateur invalide",
			'taken' => "Ce nom d'utilisateur existe d&eacute;j&agrave;"
		],

		'email' => [
			'success' => "Email mis &agrave; jour avec succ&egrave;s",
			'pending' => "V&eacute;rifiez votre email pour confirmer la mise &agrave; jour",
			'spam' => "Trop de emails envoy&eacute;s",
			'invalid' => "Email invalide",
			'taken' => "Cet email est associ&eacute; &agrave; un autre compte",
			'send' => "L'email n'a pas pu &ecirc;tre envoy&eacute;. R&eacute;essayez plus tard",
			'link' => "Lien de modification d'email invalide",
			'expired' => "Lien de modification d'email expir&eacute;"
		],

		'privacy' => [
			'success' => "Confidentialit&eacute; mise &agrave; jour avec succ&egrave;s"
		],

		'unlink' => [
			'success' => "Dissoci&eacute; d'Instagram avec succ&egrave;s",
			'instagram' => "Instagram a d&eacute;j&agrave; &eacute;t&eacute; dissoci&eacute; via l'application"
		],

		'old' => [
			'success' => "Mot de passe mis &agrave; jour avec succ&egrave;s",
			'wrong' => "Mauvais mot de passe"
		],

		'pwd' => [
			'length' => "Longueur de mot de passe invalide",
			'match' => "Les mots de passe ne correspondent pas"
		],

		'avatar' => [
			'title' => "Changez votre image de profil",
			'remove' => "Supprimer votre image de profil"
		],

		'account' => [
			'title' => "Param&egrave;tres du compte",
			'user' => "Changer le nom d'utilisateur",
			'email' => "Changer l'email",
			'private' => "Priv&eacute;",
			'public' => "Public",
			'unlink' => "Dissociez votre profil de ",
			'link' => "Liez votre profil &agrave; Instagram"
		],

		'password' => [
			'title' => "R&eacute;initialiser le mot de passe",
			'old' => "Ancien mot de passe",
			'pwd' => "Nouveau mot de passe",
			'pwd2' => "R&eacute;p&eacute;tez le nouveau mot de passe"
		],

		'reset' => "R&eacute;initialiser",

		'save' => "Sauvegarder"
	];

	$style = [
		'title' => "Personnalisez le Style",

		'description' => "Choisissez votre style pour obtenir la meilleure exp&eacute;rience de Typed",

		'errors' => [
			'green' => "Couleur verte invalide",
			'blue' => "Couleur bleu invalide",
			'brown' => "Couleur marron invalide",
			'white' => "Couleur blanche invalide",
			'black' => "Couleur noir invalide",
			'gray' => "Couleur gris invalide"
		],

		'green' => "Verte",

		'blue' => "Bleu",

		'brown' => "Marron",

		'white' => "Blanche",

		'black' => "Noir",

		'gray' => "Gris",

		'keep' => "Associez &agrave; votre compte",

		'forbidden' => "Vous devez vous connecter pour conserver votre style",

		'delete' => "Supprimer le style actuel",

		'set' => "D&eacute;finissez vos couleurs"
	];

	$contact = [
		'language' => "N'h&eacute;sitez pas &agrave; nous &eacute;crire dans votre langue",

		'optional' => "facultatif",

		'logged' => "Vous devez vous connecter pour acc&eacute;der &agrave; cette page",

		'goto' => "Aller &agrave;",

		'main' => "Page d'accueil",

		'login' => "Page de connexion",

		'signup' => "Page d'inscription",

		'user' => "Page utilisateur",

		'reply' => "R&eacute;pondre aux Types",

		'types' => "Modifier les Types",

		'points' => "Gagner des points",

		'instagram' => "Connexion Instagram",

		'search' => "Page de recherche",

		'profile' => "Page de " . (isset($_SESSION['id']) ? $_user : "profil"),

		'settings' => "Param&egrave;tres",

		'style' => "Personnaliser le style",

		'other' => "Autre"
	];

	$bug = [
		'title' => "Signalez une Erreur",

		'description' => "Aidez-nous &agrave; nous am&eacute;liorer et &agrave; am&eacute;liorer votre exp&eacute;rience",

		'errors' => [
			'success' => "Rapport d'erreur envoy&eacute; avec succ&egrave;s",
			'page' => "Page de site non valide",
			'email' => "Email invalide",
			'content' => "Longueur de votre rapport d'erreur invalide"
		],

		'paragraph' => "Rapportez ici une erreur que vous avez trouv&eacute; sur ce site pour nous aider &agrave; am&eacute;liorer",

		'page' => "Dans quelle page avez-vous trouv&eacute; l'erreur",

		'textarea' => "Entrez ici une explication de l'erreur",

		'submit' => "Envoyer le Rapport"
	];

	$advice = [
		'title' => "Donnez un Conseil",

		'description' => "Dites-nous vos pens&eacute;es pour que vos id&eacute;es deviennent r&eacute;alit&eacute;",

		'errors' => [
			'success' => "Conseil envoy&eacute; avec succ&egrave;s",
			'page' => "Page de site non valide",
			'email' => "Email invalide",
			'content' => "Longueur de votre conseil invalide"
		],

		'paragraph' => "Donnez-nous quelques conseils sur le site pour nous aider &agrave; am&eacute;liorer",

		'page' => "Pour quelle page est votre conseil",

		'textarea' => "Ins&eacute;rez ici une explication du conseil",

		'submit' => "Envoyer le Conseil"
	];
