<?php require_once 'defines.inc.php'?>
<?php

	if(basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]))
	{
		header("Location: " . HTTP . "?error=404");
		exit();
	}

	$description = "Typed te ayuda a descubrir lo que la gente piensa sobre tu vida y te ayuda a hablar contigo de forma an&oacute;nima. &iexcl;&Uacute;nase a nuestra Crushbox o responda las preguntas de tus fans aqu&iacute; o en tu Red Social favorita!";
	$short = "Typed, donde puedes revelar qui&eacute;n eres";

	$empty = "Rellene todos los campos obligatorios";
	$conn = "Error al conectarse al servidor. Int&eacute;ntalo de nuevo";
	$unknown = "Error desconocido. Int&eacute;ntalo de nuevo";
	$show = "Muestra";
	$here = "aqu&iacute;";

	$validity = "El nombre de usuario debe contener entre 3 y 30 caracteres y comenzar con una letra. Caracteres v&aacute;lidos: A-Z 0-9 . _";

	$times = [
		'y' => [
			"a&ntilde;o",
			"a&ntilde;os"
		],
		'm' => [
			"mes",
			"meses"
		],
		'd' => [
			"d&iacute;a",
			"d&iacute;as"
		],
		'h' => [
			"hora",
			"horas"
		],
		'i' => [
			"minuto",
			"minutos"
		],
		's' => [
			"segundo",
			"segundos"
		],

		'now' => "Ahora",

		'ago' => [
			"Hace",
			""
		]
	];

	$header = [
		'alt1' => "Buscar",

		'alt2' => "Desplazarse",

		'back' => "Atr&aacute;s",

		'search' => "Buscar una p&aacute;gina o un usuario",

		'theme' => "Tema",

		'personal' => "Personal",

		'light' => "Claro",

		'dark' => "Oscuro",

		'random' => "Aleatorio",

		'personalize' => "Personalizar"
	];

	$footer = [
		'check' => "Ingresaste a esta p\\xe1gina desde un enlace no v\\xe1lido",//alert

		'alt1' => "Idioma",

		'bug' => "Reportar un error",

		'advice' => "Danos un consejo",

		'license1' => "Esta obra est&aacute; bajo una ",

		'license2' => "Licencia Creative Commons Atribuci&oacute;n-SinDerivadas 4.0 Internacional",

		'alt2' => "Licencia Creative Commons",

		'privacy' => "Pol&iacute;tica de Privacidad",

		'terms' => "Condiciones de Servicio"
	];

	$typed = [
		'title' => "Bienvenido a Typed",

		'results' => [
			'signup' => "Te registraste con &eacute;xito",
			'login' => "Has iniciado sesi&oacute;n con &eacute;xito",
			'logout' => "Sesi&oacute;n cerrada con &eacute;xito",
			'email' => "Haga clic en el enlace de tu correo electr&oacute;nico para establecer una contrase&ntilde;a",
			'instagram' => "Error al conectarse a Instagram. Int&eacute;ntalo de nuevo",
			'taken' => "Este perfil de Instagram est&aacute; asociado con otra cuenta"
		],

		'errors' => [
			'400' => "Solicitud Incorrecta",
			'401' => "No autorizado",
			'403' => "Prohibido",
			'404' => "Extraviado",
			'409' => "Conflicto",
			'500' => "Error Interno del Servidor",
			'501' => "No implementado",
			'502' => "Sin Respuesta",
			'503' => "Servicio no Disponible",
			'504' => "Respuesta Demasiado Lenta",
			'505' => "Versi&oacute;n de Protocolo no Compatible"
		],

		'congratulations' => "\\xa1Felicidades",//alert

		'match' => "te ha agregado a su Crushbox tambi\\xe9n",//alert

		'logged' => "Conectado como",

		'not-logged' => "No has iniciado sesi&oacute;n",

		'logout' => "Cerrar sesi&oacute;n",

		'signup' => "Reg&iacute;strate",

		'login' => "Iniciar sesi&oacute;n"
	];

	$instagram = [
		'title' => "Con&eacute;ctate a Instagram",

		'description' => "Vincula tu cuenta de Typed a Instagram para mantener tus Redes Sociales favoritas siempre conectadas",

		'new' => "Crea una cuenta nueva",

		'existing' => "Enlace a una cuenta existente",

		'posts' => "Publicaciones",

		'followers' => "Seguidores",

		'following' => "Seguidos"
	];

	$deletions = [
		'title' => "Desvinculaci&oacute;ns de Instagram",

		'user' => "Nombre de usuario",

		'email' => "Email del usuario",

		'link' => "Fecha de conexi&oacute;n a Instagram",

		'deletion' => "Fecha de eliminaci&oacute;n de datos",

		'source' => "Desvinculado a trav&eacute;s de"
	];

	$signup = [
		'title' => "Reg&iacute;strate",

		'description' => "Cree una nueva cuenta de Typed para comenzar a responder las preguntas de tus amigos",

		'errors' => [
			'spam' => "Demasiadas solicitudes de registro",
			'invaliduser' => "Nombre de usuario no v&aacute;lido",
			'invalidemail' => "Email no v&aacute;lido",
			'user' => "Este nombre de usuario ya existe",
			'email' => "Este correo electr&oacute;nico est&aacute; asociado con otra cuenta",
			'send' => "No se pudo enviar el correo electr&oacute;nico. Intenta nuevamente m&aacute;s tarde"
		],

		'confirm' => "Recibir&aacute; un correo electr&oacute;nico de confirmaci&oacute;n con las instrucciones para establecer una contrase&ntilde;a",

		'point' => "obtendr&aacute; 400 puntos despu&eacute;s de su registro",

		'link' => "Vincula tu perfil a",

		'user' => "Nombre de usuario",

		'password' => "Contrase&ntilde;a",

		'repeat' => "Repita tu contrase&ntilde;a",

		'signup' => "Reg&iacute;strate",

		'register' => "&iquest;Ya est&aacute; registrado?",

		'login' => "Inicia sesi&oacute;n"
	];

	$login = [
		'title' => "Iniciar Sesi&oacute;n",

		'description' => "Inicie sesi&oacute;n en Typed para llevar siempre tu cuenta con usted",

		'errors' => [
			'invaliduser' => "Nombre de usuario no v&aacute;lido",
			'invalidemail' => "Email no v&aacute;lido",
			'user' => "Usuario no encontrado",
			'email' => "Este correo electr&oacute;nico no est&aacute; asociado a una cuenta",
			'pwd' => "Contrase&ntilde;a incorrecta",
			'google' => "Autenticaci&oacute;n de Google no v&aacute;lida"
		],

		'forbidden' => "Debes iniciar sesi&oacute;n para acceder a esta p&aacute;gina",

		'recovery' => "Contrase\\xf1a actualizada con \\xe9xito",//alert

		'link' => "Vincula tu perfil a",

		'user' => "Nombre de usuario o Correo electr&oacute;nico",

		'validity' => "Inserte un correo electr&oacute;nico v&aacute;lido",

		'password' => "Contrase&ntilde;a",

		'keep' => "Mantenme conectado",

		'login' => "Iniciar sesi&oacute;n",

		'or' => "O",

		'google' => "Inicia sesi&oacute;n con Google",

		'forgot' => "&iquest;Se te olvid&oacute; tu contrase&ntilde;a",

		'recover' => "Recup&eacute;ralo ahora",

		'register' => "&iquest;Todav&iacute;a no estas registrado",

		'signup' => "Reg&iacute;strate"
	];

	$recovery = [
		'title' => "Olvidado Contrase&ntilde;a",

		'description' => "Nunca pierdas tu cuenta: recupera tu contrase&ntilde;a",

		'errors' => [
			'spam' => "Demasiadas solicitudes de recuperaci&oacute;n",
			'invalid' => "Email no v&aacute;lido",
			'email' => "Este correo electr&oacute;nico no est&aacute; asociado a ninguna cuenta",
			'send' => "No se pudo enviar el correo electr&oacute;nico. Intenta nuevamente m&aacute;s tarde"
		],

		'insert' => "Inserte tu correo electr&oacute;nico en el formulario a continuaci&oacute;n",

		'send' => "Te enviaremos un correo electr&oacute;nico con el enlace de recuperaci&oacute;n",

		'recover' => "Recupera tu contrase&ntilde;a"
	];

	$verify = [
		'title' => "Nueva Contrase&ntilde;a",

		'description' => "La seguridad es lo primero en Typed: mantenga tus datos seguros",

		'errors' => [
			'check' => "Ingresaste a esta p&aacute;gina desde un enlace no v&aacute;lido",
			'length' => "Longitud de contrase&ntilde;a no v&aacute;lida",
			'pwd' => "Las contrase&ntilde;as no coinciden",
			'invalid' => "Solicitud de contrase&ntilde;a inv&aacute;lida",
			'expired' => "Solicitud de contrase&ntilde;a caducada"
		],

		'link' => "Vincula tu perfil a",

		'pwd' => "Nueva contrase&ntilde;a",

		'pwd2' => "Repita la nueva contrase&ntilde;a",

		'update' => "Establece tu contrase&ntilde;a"
	];

	$main = [
		'anonymous' => "An&oacute;nimo",

		'hidden' => "Oculto",

		'visible' => "Visible",

		'listed' => "Listado",

		'link' => "Enlace en bio",

		'click' => "Tome una captura de pantalla o haga clic",

		'download' => " para descargar la imagen"
	];

	$user = [
		'title' => isset($name) ? ($name === true ? "Usuario no v&aacute;lido" : ($name ? $name : "Usuario vac&iacute;o")) : '',

		'description' => isset($name) && is_string($name) ? "Cuenta Typed de Simone" . $name . ": mire los Types de " . $name . " y haga una nueva pregunta" : "Ask your friends what you want about their life and stay always connection with them",

		'errors' => [
			'success' => "<i>Type</i> enviado con &eacute;xito",
			'anonymous' => "Debes iniciar sesi&oacute;n para mostrar tu nombre",
			'hidden' => "Tu <i>Type</i> ya est&aacute; oculto si no ha iniciado sesi&oacute;n",
			'length' => "Longitud de <i>Type</i> no v&aacute;lida"
		],

		'points' => [//alert
			'success' => "20 puntos dados con \\xe9xito",
			'self' => "No puedes darte puntos a ti mismo",
			'invalid' => "Nombre de usuario no v\\xe1lido",
			'conn' => "Error al conectarse al servidor. Int\\xe9ntalo de nuevo",
			'unknown' => "Error desconocido. Int\\xe9ntalo de nuevo",
			'time' => "Solo puedes donar a alguien una vez al d\\xeda",
			'login' => "Necesitas iniciar sesi\\xf3n para dar algunos puntos"
		],

		'info' => [
			'visible' => "Tu nombre ser&aacute; visible encima del <i>Type</i>",
			'anonymous' => "Nadie podr&aacute; saber qui&eacute;n envi&oacute; el <i>Type</i>",
			'listed' => "Podr&aacute; editar o eliminar tu <i>Type</i> desde ",
			'hidden' => "El <i>Type</i> no se mostrar&aacute; en la lista de tu <i>Types</i>",
			'login' => "Necesita iniciar sesi&oacute;n para acceder a esta funci&oacute;n"
		],

		'share' => "Compartir",

		'gain' => "Gana algunos puntos",

		'send' => "Env&iacute;ame un nuevo Type",

		'alt1' => "Foto de perfil",

		'type' => "Escriba tu Type aqu&iacute;",

		'forbidden' => "Siempre ser&aacute;s an&oacute;nimo si no est&aacute;s conectado",

		'submit' => "Enviar",

		'break' => "\\xbfQuieres enviar tu mensaje",//alert

		'meaning' => "&iquest;Qu&eacute; significa eso",

		'types' => "Tus Types",

		'reply' => "Responde a algunos Types",

		'you' => "Revisa los Types enviados",

		'logged' => "No has iniciado sesi&oacute;n",

		'login' => "Iniciar Sesi&oacute;n",

		'signup' => "Reg&iacute;strate",

		'all' => isset($name) ? "Types de " . $name : '',

		'overflow' => "Types",

		'empty' => "no tiene ning&uacute;n Type: escribe el tuyo",

		'found' => "Usuario no encontrado",

		'label' => "Buscar otro usuario",

		'search' => "Buscar un usuario",

		'alt4' => "Buscar"
	];

	$reply = [
		'title' => "Responder a los Types",

		'reply' => [
			'success' => "Respuesta enviada correctamente",
			'type' => "No puedes responder a este <i>Type</i>",
			'length' => "Longitud de respuesta inv&aacute;lida"
		],

		'delete' => [
			'success' => "<i>Type</i> eliminado con &eacute;xito",
			'type' => "No puedes eliminar este <i>Type</i>"
		],

		'rules' => "Aqu&iacute; puedes responder a los <i>Types</i> que tus amigos te han enviado",

		'protection' => "Tambi&eacute;n puede eliminar los <i>Types</i> que considere ofensivos o inapropiados",

		'edit' => "Recuerde: una vez que haya respondido a un <i>Type</i>, puede editar su respuesta",

		'send' => "Responder",

		'break' => "\\xbfQuieres enviar tu respuesta",//alert

		'confirm' => "&iquest;Seguro que quieres eliminar este Type? Esta acci\\xf3n no se puede deshacer",//alert

		'del' => "Eliminar",

		'input' => "Responder a este Type",

		'types' => "No tienes ning&uacute;n Type nuevo",

		'back' => "Mira todos tus Types"
	];

	$types = [
		'title' => "Revisa tus Types enviados",

		'edit' => [
			'success' => "<i>Type</i> editado con &eacute;xito",
			'type' => "No puedes editar este <i>Type</i>",
			'length' => "Longitud de <i>Type</i> inv&aacute;lida"
		],

		'delete' => [
			'success' => "<i>Type</i> eliminado con &eacute;xito",
			'type' => "No puedes eliminar este <i>Type</i>"
		],

		'visibility' => [
			'success' => "Visibilidad del <i>Type</i> actualizada con &eacute;xito",
			'type' => "No puede cambiar la visibilidad de este <i>Type</i>"
		],

		'hide' => [
			'success' => "<i>Type</i> oculto con &eacute;xito",
			'type' => "No puedes ocultar este <i>Type</i>"
		],

		'answer' => [
			'success' => "Respuesta editada con &eacute;xito",
			'type' => "No puedes editar esta respuesta",
			'length' => "Longitud de respuesta inv&aacute;lida"
		],

		'rules' => "Estos son los <i>Types</i> y las respuestas que ha enviado hasta ahora: puede editarlos o eliminarlos hasta 1 d&iacute;a despu&eacute;s de enviarlos",

		'restrictions' => "Solo puede editar tu <i>Type</i> si a&uacute;n no ha sido respondido",

		'show' => "Los <i>Types</i> que haya marcado como <i>ocultos</i> no se mostrar&aacute;n en esta p&aacute;gina",

		'types' => "Types",

		'answers' => "Respuestas",

		'send' => "Editar",

		'break' => "\\xbfQuieres enviar tu cambio",//alert

		'confirm1' => "&iquest;Seguro que quieres eliminar este Type",//alert

		'undo' => "Esta acci\\xf3n no se puede deshacer",//alert

		'del' => "Eliminar",

		'confirm2' => "&iquest;Seguro que quieres ocultar el Type de esta p&aacute;gina",//alert

		'input1' => "Edita este Type",

		'notypes' => "No has enviado ning&uacute;n Type",

		'back' => "Ver Types recibidos",

		'input2' => "Edita esta respuesta",

		'noanswers' => "No has respondido a ning&uacute;n Type",

		'reply' => "Responder a algunos Types"
	];

	$points = [
		'title' => "Gana algunos Puntos",

		'description' => "Gana m&aacute;s puntos para mostrar a tus amigos cu&aacute;nto esfuerzo haces en las cosas que haces",

		'copy' => "Enlace copiado al portapapeles",//alert

		'gain' => [
			'title' => "C&oacute;mo ganar puntos",
			'gain' => "Ganas",
			'1' => "punto por cada <i>Type</i> de un usuario no registrado",
			'10' => "puntos por cada <i>Type</i> de un usuario registrado",
			'20' => "puntos si alguien decide regal&aacute;rtelos",
			'30' => "puntos por cada respuesta a un <i>Type</i> o comparte en Instagram",
			'400' => "puntos si compartes esta aplicaci&oacute;n con alguien",
			'1000' => "puntos si agregas Typed a tu biograf&iacute;a de Instagram"
		],

		'gifts' => [
			'title' => "Regalos",
			'give' => "Puedes darle 20 puntos a alguien como m&aacute;ximo una vez al d&iacute;a",
			'lose' => "No perder&aacute;s los puntos que donas, simplemente se agregar&aacute;n a quien quieras"
		],

		'you' => [
			'title' => "Tus puntos",
			'points1' => "Actualmente tienes",
			'points2' => "puntos",
			'position1' => "Est&aacute;s en la",
			'position2' => "posici&oacute;n"
		],

		'share' => [
			'title' => "Compartes Typed con alguien",
			'rules' => "Si alguien se registra en Typed haciendo clic en tu enlace, recibir&aacute; autom&aacute;ticamente 400 puntos",
			'copy' => "haga clic aqu&iacute; para copiar",
			'note' => "Recuerda: tu amigo tiene que hacer clic en el enlace antes de registrarse"
		],

		'biography' => [
			'title' => "Agrega Typed a tu biograf&iacute;a",
			'link1' => "Escribe",
			'link2' => "en tu biograf&iacute;a para ganar 1000 puntos",
			'check' => "Revisa otra vez",
			'see' => "Muestra tu biograf&iacute;a",
			'hide' => "Oculta tu biograf&iacute;a",
			'note' => "Nota: si elimina Typed de tu biograf&iacute;a, tambi&eacute;n eliminaremos tus 1000 puntos",
			'empty' => "Tu biograf&iacute;a esta vac&iacute;a"
		],

		'instagram' => [
			'link1' => "Tu perfil no est&aacute; vinculado a Instagram. Haga clic",
			'link2' => "para conectar tus cuentas",
			'conn' => "Lo sentimos, no podemos verificar tu biograf&iacute;a en este momento debido a un problema de Instagram. Intenta nuevamente m&aacute;s tarde",
			'none' => "No has Typed en tu biograf&iacute;a de Instagram. A&ntilde;&aacute;delo para ganar 1000 puntos",
			'done' => "&iexcl;Buen trabajo! Typed est&aacute; presente en tu biograf&iacute;a de Instagram"
		]
	];

	$profile = [
		'title' => "Perfil",

		'description' => "Acceda a tu Crushbox, done algunos puntos o edite tus preferencias de perfil",

		'errors' => [//alert
			'success' => "20 puntos dados con \\xe9xito",
			'self' => "No puedes darte puntos a ti mismo",
			'invalid' => "Nombre de usuario no v\\xe1lido",
			'conn' => "Error al conectarse al servidor. Int\\xe9ntalo de nuevo",
			'unknown' => "Error desconocido. Int\\xe9ntalo de nuevo",
			'time' => "Solo puedes donar a alguien una vez al d\\xeda",
			'login' => "Necesitas iniciar sesi\\xf3n para dar algunos puntos",
			'crushbox' => "No puedes acceder al Crushbox de otra persona"
		],

		'found' => "Usuario no encontrado",//alert

		'alt1' => "Ajustes",

		'alt2' => "Foto de perfil",

		'followers' => "Seguidores",

		'following' => "Seguidos",

		'points' => "Puntos"
	];

	$crushbox = [
		'title' => "Crushbox",

		'description' => "Lleva tus secretos contigo y haz tu sue&ntilde;o realidad",

		/*start*/
		'start' => [
			'length' => "Longitud de contrase&ntilde;a inv&aacute;lida",
			'pwd' => "Las contrase&ntilde;as no coinciden"
		],

		'welcome' => [
			'title' => "Bienvenido a Crushbox",
			'first' => "Puedes elegir hasta tres <i>Crushes</i>",
			'second' => "Tus <i>Crushes</i> no ser&aacute;n notificados si los eliges, a menos que tambi&eacute;n te pongan como tu <i>Crush</i>",
			'third' => "Si tu <i>Crush</i> te elige en la <i>Crushbox</i>, ser&aacute;s notificado y",
			'fourth' => "Felicidades: &iexcl;has encontrado a tu compa&ntilde;ero"
		],

		'rules' => [
			'title' => "Rules",
			'first' => "Puede elegir hasta tres <i>Crushes</i> para tu <i>Crushbox</i>",
			'second' => "Para establecer un <i>Crush</i>, ingrese a tu <i>Crushbox</i> e inserte el nombre de usuario de Typed de tu secreto <i>Crush</i>",
			'third' => "Una vez que haya configurado un <i>Crush</i>, no podr&aacute; corregir durante 10 d&iacute;as",
			'fourth' => "Si lo desea, puede proteger tu <i>Crushbox</i> con una contrase&ntilde;a: se bloquear&aacute; autom&aacute;ticamente despu&eacute;s de ",
			'fifth' => " minutos"
		],

		'pwd' => "Establecer una contrase&ntilde;a",

		'not-pwd' => "No establezca una contrase&ntilde;a",

		'set' => "Establecer contrase&ntilde;a",

		'not-set' => "Empezar",

		'password' => "Contrase&ntilde;a",

		'repeat' => "Repita tu contrase&ntilde;a",

		/*login*/
		'login' => [
			'pwd' => "Contrase&ntilde;a incorrecta"
		],

		'expire1' => "Inserte tu contrase&ntilde;a (expirar&aacute; despu&eacute;s de ",

		'expire2' => " minutes)",

		'join' => "Inicia sesi&oacute;n en",

		/*crushbox*/
		'errors' => [
			'success' => "<i>Crushbox</i> actualizada con &eacute;xito",
			'self' => "No puedes ponerte como tu <i>Crush</i>",
			'twice' => "No puedes establecer la mismo <i>Crush</i> dos veces",
			'length' => "Longitud de <i>Crush</i> no v&aacute;lida",
			'first' => "La primera <i>Crush</i> no existe",
			'second' => "La segunda <i>Crush</i> no existe",
			'third' => "La tercera <i>Crush</i> no existe",
			'start' => "<i>Crushbox</i> establecida con &eacute;xito",
			'login' => "Has iniciado sesi&oacute;n correctamente"
		],

		'congratulations' => "&iexcl;Felicidades",

		'match' => "te ha agregado a su <i>Crushbox</i> tambi&eacute;n",

		'added' => "&iexcl;Te han agregado a la <i>Crushbox</i> de ",

		'person' => " persona! &iquest;Quien podr&iacute;a ser?",

		'people' => " personas! &iquest;Quienes podr&iacute;an ser?",

		'first' => "Primera",

		'second' => "Segunda",

		'third' => "Tercera",

		'expire' => "Tiempo de expiraci&oacute;n",

		'logout' => "Cerrar sesi&oacute;n",

		'add' => "A&ntilde;adir",

		'reset' => "Reinicializar",

		'update' => "Actualizar",

		'tutorial' => "Ver reglas o Restablecer contrase&ntilde;a"
	];

	$settings = [
		'title' => "Ajustes",

		'description' => "Edita tu nombre de usuario, tu correo electr&oacute;nico o actualiza tu foto de perfil",

		'file' => [
			'success' => "Foto de perfil actualizada con &eacute;xito",
			'error' => "Error al subir el archivo",
			'size' => "La imagen debe ser mayor que 3KB y menor que 2MB",
			'invalid' => "Archivo de tipo ",
			'image' => " no v&aacute;lido: sube una imagen"
		],

		'remove' => [
			'success' => "Avatar eliminado con &eacute;xito",
			'empty' => "No ten&iacute;as ninguna foto de perfil",
			'error' => "No se pudo eliminar el archivo"
		],

		'user' => [
			'success' => "Usuario actualizado con &eacute;xito",
			'invalid' => "Nombre de usuario no v&aacute;lido",
			'taken' => "Este nombre de usuario ya existe"
		],

		'email' => [
			'success' => "Correo electr&oacute;nico actualizado con &eacute;xito",
			'pending' => "Revise tu correo electr&oacute;nico para confirmar la actualizaci&oacute;n",
			'spam' => "Has enviado demasiadas solicitudes",
			'invalid' => "Email no v&aacute;lido",
			'taken' => "Este correo electr&oacute;nico est&aacute; asociado a otra cuenta",
			'send' => "No se pudo enviar el correo electr&oacute;nico. Intenta nuevamente m&aacute;s tarde",
			'link' => "Enlace de cambio de correo electr&oacute;nico no v&aacute;lido",
			'expired' => "Enlace de cambio de correo electr&oacute;nico caducado"
		],

		'privacy' => [
			'success' => "Privacidad actualizada con &eacute;xito"
		],

		'unlink' => [
			'success' => "Desvinculado con &eacute;xito de Instagram",
			'instagram' => "Instagram ya se ha desvinculado a trav&eacute;s de la aplicaci&oacute;n"
		],

		'old' => [
			'success' => "Contrase&ntilde;a actualizada correctamente",
			'wrong' => "Contrase&ntilde;a incorrecta"
		],

		'pwd' => [
			'length' => "Longitud de contrase&ntilde;a inv&aacute;lida",
			'match' => "Las contrase&ntilde;as no coinciden"
		],

		'avatar' => [
			'title' => "Actualiza tu foto de perfil",
			'remove' => "Elimina tu foto de perfil"
		],

		'account' => [
			'title' => "Configuraciones de la cuenta",
			'user' => "Cambiar nombre de usuario",
			'email' => "Cambiar correo electr&oacute;nico",
			'private' => "Privado",
			'public' => "P&uacute;blico",
			'unlink' => "Desvincula tu perfil de",
			'link' => "Vincula tu perfil a Instagram"
		],

		'password' => [
			'title' => "Restablecer la contrase&ntilde;a",
			'old' => "Contrase&ntilde;a anterior",
			'pwd' => "Nueva contrase&ntilde;a",
			'pwd2' => "Repita la nueva contrase&ntilde;a"
		],

		'reset' => "Reiniciar",

		'save' => "Guardar Cambios"
	];

	$style = [
		'title' => "Personaliza el Estilo",

		'description' => "Elige tu estilo para obtener la mejor experiencia de Typed",

		'errors' => [
			'green' => "Color verde no v&aacute;lido",
			'blue' => "Color azul no v&aacute;lido",
			'brown' => "Color marr&oacute;n no v&aacute;lido",
			'white' => "Color blanco no v&aacute;lido",
			'black' => "Color negro no v&aacute;lido",
			'gray' => "Color gris no v&aacute;lido"
		],

		'green' => "Verde",

		'blue' => "Azul",

		'brown' => "Marr&oacute;n",

		'white' => "Blanco",

		'black' => "Negro",

		'gray' => "Gris",

		'keep' => "Asociarse con tu cuenta",

		'forbidden' => "Necesitas iniciar sesi&oacute;n para mantener tu estilo",

		'delete' => "Eliminar tu estilo actual",

		'set' => "Establece tus nuevos colores"
	];

	$contact = [
		'language' => "No dude en escribirnos en cualquier idioma",

		'optional' => "facultativo",

		'logged' => "Debes iniciar sesi&oacute;n para acceder a esta p&aacute;gina",

		'goto' => "Ir a",

		'main' => "P&aacute;gina principal",

		'login' => "Iniciar sesi&oacute;n",

		'signup' => "Reg&iacute;strate",

		'user' => "P&aacute;gina de usuario",

		'reply' => "Responder a Types",

		'types' => "Editar Types",

		'points' => "Ganar puntos",

		'search' => "P&aacute;gina de b&uacute;squeda",

		'instagram' => "Inicio de sesi&oacute;n con Instagram",

		'profile' => "P&aacute;gina de " . (isset($_SESSION['id']) ? $_user : "perfil"),

		'settings' => "Ajustes",

		'style' => "Personalizar estilo",

		'other' => "Otro"
	];

	$bug = [
		'title' => "Reportar un Error",

		'description' => "Ay&uacute;danos a mejorar nosotros mismos y tu experiencia",

		'errors' => [
			'success' => "Informe de error enviado con &eacute;xito",
			'page' => "P&aacute;gina del sitio web no v&aacute;lida",
			'email' => "Email no v&aacute;lido",
			'content' => "Longitud de tu informe de error no v&aacute;lida"
		],

		'paragraph' => "Informe aqu&iacute; cualquier error que haya encontrado en este sitio web para ayudarnos a mejorar",

		'page' => "&iquest;En qu&eacute; p&aacute;gina encontraste el error",

		'textarea' => "Inserte aqu&iacute; una explicaci&oacute;n del error",

		'submit' => "Enviar Reporte"
	];

	$advice = [
		'title' => "Danos un Consejo",

		'description' => "Cu&eacute;ntanos qu&eacute; piensas y convierte tus ideas en realidad",

		'errors' => [
			'success' => "Consejo enviado con &eacute;xito",
			'page' => "P&aacute;gina del sitio web no v&aacute;lida",
			'email' => "Email no v&aacute;lido",
			'content' => "Longitud de tu informe de error no v&aacute;lida"
		],

		'paragraph' => "Danos algunos consejos sobre el sitio web para ayudarnos a mejorar",

		'page' => "&iquest;Para qu&eacute; p&aacute;gina es tu consejo",

		'textarea' => "Inserte aqu&iacute; una explicaci&oacute;n de tu consejo",

		'submit' => "Enviar Consejo"
	];
