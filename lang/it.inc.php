<?php require_once 'defines.inc.php'?>
<?php

	if(basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]))
	{
		header("Location: " . HTTP . "?error=404");
		exit();
	}

	$description = "Typed ti aiuter&agrave; a scoprire cosa pensano le persone della tua vita e permetter&agrave; agli altri di parlarti anonimamente. Entra nella nostra Crushbox o rispondi alle domande dei tuoi fan qui o sul tuo Social Network preferito!";
	$short = "Typed, dove puoi mostrare chi sei";

	$empty = "Completa tutti i campi richiesti";
	$conn = "Errore di connessione al server. Riprova";
	$unknown = "Errore sconosciuto. Riprova";
	$show = "Mostra";
	$here = "qui";

	$validity = "Il nome utente deve contenere tra 3 e 30 caratteri e iniziare con una lettera. Caratteri validi: A-Z 0-9 . _";

	$times = [
		'y' => [
			"anno",
			"anni"
		],
		'm' => [
			"mese",
			"mesi"
		],
		'd' => [
			"giorno",
			"giorni"
		],
		'h' => [
			"ora",
			"ore"
		],
		'i' => [
			"minuto",
			"minuti"
		],
		's' => [
			"secondo",
			"secondi"
		],

		'now' => "Adesso",

		'ago' => [
			"",
			"fa"
		]
	];

	$header = [
		'alt1' => "Ricerca",

		'alt2' => "Scorri",

		'back' => "Indietro",

		'search' => "Cerca una pagina o un utente",

		'theme' => "Tema",

		'personal' => "Personale",

		'light' => "Chiaro",

		'dark' => "Scuro",

		'random' => "Casuale",

		'personalize' => "Personalizza"
	];

	$footer = [
		'check' => "Sei arrivato a questa pagina da un link non valido",//alert

		'alt1' => "Lingua",

		'bug' => "Segnala un errore",

		'advice' => "Dacci un consiglio",

		'license1' => "Quest'opera &egrave; distribuita con Licenza ",

		'license2' => "Creative Commons Attribuzione - Non opere derivate 4.0 Internazionale",

		'alt2' => "Licenza Creative Commons",

		'privacy' => "Politica sulla Privacy",

		'terms' => "Termini di Servizio"
	];

	$typed = [
		'title' => "Benvenuto su Typed",

		'results' => [
			'signup' => "Registrazione effettuata con successo",
			'login' => "Hai eseguito l'accesso",
			'logout' => "Disconnessione effettuata con successo",
			'email' => "Clicca il link sulla tua email per impostare la password",
			'instagram' => "Errore di connessione ad Instagram. Riprova",
			'taken' => "Questo profilo Instagram &egrave; associato ad un altro account"
		],

		'errors' => [
			'400' => "Richiesta Errata",
			'401' => "Non Autorizzato",
			'403' => "Vietato",
			'404' => "Pagina non Trovata",
			'409' => "Conflitto",
			'500' => "Errore Interno del Server",
			'501' => "Richiesta non Implementata",
			'502' => "Nessuna Risposta",
			'503' => "Servizio non Disponibile",
			'504' => "Risposta Troppo Lenta",
			'505' => "Versione del Protocollo non Supportata"
		],

		'congratulations' => "Congratulazioni",//alert

		'match' => "ha aggiunto anche te alla sua Crushbox",//alert

		'logged' => "Accesso effettuato come",

		'not-logged' => "Non hai effettuato l'accesso",

		'logout' => "Disconnettiti",

		'signup' => "Registrati",

		'login' => "Accedi"
	];

	$instagram = [
		'title' => "Connettiti ad Instagram",

		'description' => "Collega il tuo account di Typed ad Instagram per mantenere i tuoi Social Network preferiti sempre connessi",

		'new' => "Crea un nuovo account",

		'existing' => "Collega ad un account esistente",

		'posts' => "Post",

		'followers' => "Follower",

		'following' => "Seguiti"
	];

	$deletions = [
		'title' => "Disconnessioni da Instagram",

		'user' => "Nome utente",

		'email' => "Email dell'utente",

		'link' => "Data di connessione ad Instagram",

		'deletion' => "Data di eliminazine dei dati",

		'source' => "Disconnesso tramite"
	];

	$signup = [
		'title' => "Registrazione",

		'description' => "Crea un nuovo account di Typed per iniziare a rispondere alle domande dei tuoi amici",

		'errors' => [
			'spam' => "Troppe email inviate",
			'invaliduser' => "Nome utente non valido",
			'invalidemail' => "Email non valida",
			'user' => "Questo nome utente esiste gi&agrave;",
			'email' => "Questa email &egrave; associata ad un altro account",
			'send' => "Impossibile inviare l'email. Riprova pi&ugrave; tardi"
		],

		'confirm' => "Riceverai una email di conferma con le istruzioni per impostare una password",

		'point' => "otterr&agrave; 400 punti dopo la tua registrazione",

		'link' => "Collega il tuo profilo a",

		'user' => "Nome utente",

		'password' => "Password",

		'repeat' => "Ripeti la tua password",

		'signup' => "Registrati",

		'register' => "Sei gi&agrave; registrato?",

		'login' => "Accedi"
	];

	$login = [
		'title' => "Accesso",

		'description' => "Accedi a Typed per portare il tuo account sempre con te",

		'errors' => [
			'invaliduser' => "Nome utente non valido",
			'invalidemail' => "Email non valida",
			'user' => "Nome utente non trovato",
			'email' => "Questa email non &egrave; associata ad un account",
			'pwd' => "Password errata",
			'google' => "Autenticazione a Google non valida"
		],

		'forbidden' => "Devi accedere per poter vedere questa pagina",

		'recovery' => "Password aggiornata con successo",//alert

		'link' => "Collega il tuo profilo a",

		'user' => "Nome utente o Email",

		'validity' => "Inserisci un indirizzo email valido",

		'password' => "Password",

		'keep' => "Mantieni l'accesso",

		'login' => "Accedi",

		'or' => "Oppure",

		'google' => "Accedi con Google",

		'forgot' => "Password dimenticata",

		'recover' => "Recuperala ora",

		'register' => "Non sei ancora registrato",

		'signup' => "Registrati"
	];

	$recovery = [
		'title' => "Recupero Password",

		'description' => "Non perdere mai l'account: recupera la tua password",

		'errors' => [
			'spam' => "Troppe email inviate",
			'invalid' => "Email non valida",
			'email' => "Questa email non &egrave; associata ad un account",
			'send' => "Impossibile inviare l'email. Riprova pi&ugrave; tardi"
		],

		'insert' => "Inserisci la tua email nei campi sottostanti",

		'send' => "Ti invieremo una email contenente il link per il recupero della password",

		'recover' => "Recupera la tua password"
	];

	$verify = [
		'title' => "Imposta Password",

		'description' => "La sicurezza viene prima di tutto su Typed: mantieni i tuoi dati al sicuro",

		'errors' => [
			'check' => "Sei arrivato a questa pagina da un link non valido",
			'length' => "Lunghezza della password non valida",
			'pwd' => "Le password non corrispondono",
			'invalid' => "Richiesta della password non valida",
			'expired' => "Richiesta della password scaduta"
		],

		'link' => "Collega il tuo profilo a",

		'pwd' => "Nuova password",

		'pwd2' => "Ripeti la nuova password",

		'update' => "Imposta la password"
	];

	$main = [
		'anonymous' => "Anonimo",

		'hidden' => "Nascosto",

		'visible' => "Visibile",

		'listed' => "Elencato",

		'link' => "Link in bio",

		'click' => "Fai uno screenshot o clicca",

		'download' => " per scaricare l'immagine"
	];

	$user = [
		'title' => isset($name) ? ($name === true ? "Utente non valido" : ($name ? $name : "Nome utente vuoto")) : '',

		'description' => isset($name) && is_string($name) ? "Account Typed di " . $name . ": guarda i Type di " . $name . " o fai una nuova domanda" : "Chiedi ai tuoi amici ci&ograve; che vuoi sulla loro vita e non perdere mai i contatti",

		'errors' => [
			'success' => "<i>Type</i> inviato con successo",
			'anonymous' => "Devi accedere per poter mostrare il tuo nome",
			'hidden' => "Il tuo <i>Type</i> &egrave; gi&agrave; nascosto se non sei loggato",
			'length' => "Lunghezza del <i>Type</i> non valida"
		],

		'points' => [//alert
			'success' => "20 punti regalati con successo",
			'self' => "Non puoi dare punti a te stesso",
			'invalid' => "Nome utente non valido",
			'conn' => "Errore di connessione al server. Riprova",
			'unknown' => "Errore sconosciuto. Riprova",
			'time' => "Puoi dare 20 punti a qualcuno solo una volta al giorno",
			'login' => "Devi accedere per poter regalare dei punti"
		],

		'info' => [
			'visible' => "Il tuo nome verr&agrave; mostrato sopra al <i>Type</i>",
			'anonymous' => "Nessuno potr&agrave; sapere chi ha inviato il <i>Type</i>",
			'listed' => "Potrai modificare o eliminare il tuo <i>Type</i> da ",
			'hidden' => "Il <i>Type</i> non verr&agrave; mostrato nella lista dei tuoi <i>Type</i>",
			'login' => "Devi avere effettuato l'accesso per accedere a questa funzione"
		],

		'share' => "Condividi",

		'gain' => "Guadagna qualche punto",

		'send' => "Inviami un nuovo Type",

		'alt1' => "Immagine profilo",

		'type' => "Scrivi qui il tuo Type",

		'forbidden' => "Devi accedere per mostrare il tuo nome",

		'submit' => "Invia",

		'break' => "Vuoi inviare il tuo Type",//alert

		'meaning' => "Cosa significa",

		'types' => "I tuoi Type",

		'reply' => "Rispondi ad alcuni Type",

		'you' => "Controlla i Type inviati",

		'logged' => "Non sei loggato",

		'login' => "Accedi",

		'signup' => "Registrati",

		'all' => isset($name) ? "Type di " . $name : '',

		'overflow' => "Type",

		'empty' => "non ha alcun Type: scrivigli il primo",

		'found' => "Utente non trovato",

		'label' => "Cerca un altro utente",

		'search' => "Cerca un utente",

		'alt4' => "Ricerca"
	];

	$reply = [
		'title' => "Rispondi ai Type",

		'reply' => [
			'success' => "Risposta inviata con successo",
			'type' => "Non puoi rispondere a questo <i>Type</i>",
			'length' => "Lunghezza della risposta non valida"
		],

		'delete' => [
			'success' => "<i>Type</i> eliminato con successo",
			'type' => "Non puoi eliminare questo <i>Type</i>"
		],

		'rules' => "Qui puoi rispondere ai <i>Type</i> che i tuoi amici ti hanno inviato",

		'protection' => "Puoi anche eliminare i <i>Type</i> che ritieni offensivi o inappropriati",

		'edit' => "Ricorda: una volta che hai risposto ad un <i>Type</i>, puoi modificare la tua risposta",

		'send' => "Rispondi",

		'break' => "Vuoi inviare la tua risposta",//alert

		'confirm' => "Sei sicuro di voler cancellare questo Type? Questa azione non pu\\xf2 essere annullata",//alert

		'del' => "Elimina",

		'input' => "Rispondi a questo Type",

		'types' => "Non hai nuovi Type",

		'back' => "Vedi tutti i tuoi Type"
	];

	$types = [
		'title' => "Controlla i Type inviati",

		'edit' => [
			'success' => "<i>Type</i> modificato con successo",
			'type' => "Non puoi modificare questo <i>Type</i>",
			'length' => "Lunghezza del <i>Type</i> non valida"
		],

		'delete' => [
			'success' => "<i>Type</i> eliminato con successo",
			'type' => "Non puoi eliminare questo <i>Type</i>"
		],

		'visibility' => [
			'success' => "Visibilit&agrave; del <i>Type</i> aggiornata con successo",
			'type' => "Non puoi modificare la visibilit&agrave; di questo <i>Type</i>"
		],

		'hide' => [
			'success' => "<i>Type</i> nascosto con successo",
			'type' => "Non puoi nascondere questo <i>Type</i>"
		],

		'answer' => [
			'success' => "Risposta modificata con successo",
			'type' => "Non puoi modificare questa risposta",
			'length' => "Lunghezza della risposta non valida"
		],

		'rules' => "Questi sono i <i>Type</i> e le risposte che hai inviato finora: puoi modificarli o eliminarli fino ad 1 giorno dall'invio",

		'restrictions' => "Puoi modificare il tuo <i>Type</i> solo se non ha ancora ricevuto una risposta",

		'show' => "I <i>Type</i> che hai impostato come <i>nascosti</i> non verranno mostrati in questa pagina",

		'types' => "Type",

		'answers' => "Risposte",

		'send' => "Modifica",

		'break' => "Vuoi inviare la tua modifica",//alert

		'confirm1' => "Sei sicuro di voler cancellare questo Type",//alert

		'undo' => "Questa azione non pu\\xf2 essere annullata",//alert

		'del' => "Elimina",

		'confirm2' => "Sei sicuro di voler nascondere il Type da questa pagina",//alert

		'input1' => "Modifica questo Type",

		'notypes' => "Non hai ancora inviato alcun Type",

		'back' => "Vedi i Type ricevuti",

		'input2' => "Modifica questa risposta",

		'noanswers' => "Non hai ancora risposto ad alcun Type",

		'reply' => "Rispondi a qualche Type"
	];

	$points = [
		'title' => "Guadagna dei Punti",

		'description' => "Guadagna pi&ugrave; punti per mostrare a tutti quanto ti impegni in ci&ograve; che fai",

		'copy' => "Link copiato negli appunti",//alert

		'gain' => [
			'title' => "Come guadagnare punti",
			'gain' => "Guadagni",
			'1' => "punto per ogni <i>Type</i> da un utente non loggato",
			'10' => "punti per ogni <i>Type</i> da un utente loggato",
			'20' => "punti se qualcuno decide ti regalarteli",
			'30' => "punti per ogni risposta ad un <i>Type</i> o condivisione su Instagram",
			'400' => "punti se condividi quest'app con qualcuno",
			'1000' => "punti se aggiungi Typed alla tua biografia di Instagram"
		],

		'gifts' => [
			'title' => "Regali",
			'give' => "Puoi regalare 20 punti a qualcuno una volta al giorno",
			'lose' => "Non perderai i punti che regali, saranno semplicemente aggiunti a chiunque tu voglia"
		],

		'you' => [
			'title' => "I tuoi punti",
			'points1' => "Attualmente hai",
			'points2' => "punti",
			'position1' => "Sei in",
			'position2' => "posizione"
		],

		'share' => [
			'title' => "Condividi Typed con qualcuno",
			'rules' => "Se qualcuno si registra a Typed cliccando sul tuo link, riceverai automaticamente 400 punti",
			'copy' => "clicca qui per copiare",
			'note' => "Ricorda: il tuo amico deve cliccare sul link prima di registrarsi"
		],

		'biography' => [
			'title' => "Aggiungi Typed alla tua biografia",
			'link1' => "Scrivi",
			'link2' => "nella tua biografia per guadagnare 1000 punti",
			'check' => "Controlla di nuovo",
			'see' => "Vedi la biografia",
			'hide' => "Nascondi la biografia",
			'note' => "Nota: se rimuovi Typed dalla tua biografia, ti rimuoveremo anche i 1000 punti",
			'empty' => "La tua biografia &egrave; vuota"
		],

		'instagram' => [
			'link1' => "Il tuo profilo con &egrave; collegato ad Instagram. Clicca",
			'link2' => "per connettere gli account",
			'conn' => "Spiacenti, al momento non possiamo controllare la tua biografia a causa di un problema di Instagram. Riprova pi&ugrave; tardi",
			'none' => "Non hai Typed nella tua biografia di Instagram. Aggiungilo per guadagnare 1000 punti",
			'done' => "Ottimo lavoro! Typed &egrave; gi&agrave; presente nella tua biografia di Instagram"
		]
	];

	$profile = [
		'title' => "Profilo",

		'description' => "Accedi alla tua Crushbox, regala dei punti o modifica le preferenze del tuo profilo",

		'errors' => [//alert
			'success' => "20 punti regalati con successo",
			'self' => "Non puoi dare punti a te stesso",
			'invalid' => "Nome utente non valido",
			'conn' => "Errore di connessione al server. Riprova",
			'unknown' => "Errore sconosciuto. Riprova",
			'time' => "Puoi dare 20 punti a qualcuno solo una volta al giorno",
			'login' => "Devi accedere per poter regalare dei punti",
			'crushbox' => "Non puoi accedere alla Crushbox di qualcun altro"
		],

		'found' => "Utente non trovato",//alert

		'alt1' => "Impostazioni",

		'alt2' => "Immagine profilo",

		'followers' => "Follower",

		'following' => "Seguiti",

		'points' => "Punti"
	];

	$crushbox = [
		'title' => "Crushbox",

		'description' => "Porta i tuoi segreti con te, e realizza il tuo sogno",

		/*start*/
		'start' => [
			'length' => "Lunghezza della password non valida",
			'pwd' => "Le password non corrispondono"
		],

		'welcome' => [
			'title' => "Benvenuto su Crushbox",
			'first' => "Potrai scegliere fino a tre <i>Crush</i>",
			'second' => "Le tue <i>Crush</i> non saranno avvisate se le scegli, a meno che non ti scelgano a loro volta come <i>Crush</i>",
			'third' => "Se la tua <i>Crush</i> ti sceglie a sua volta nella <i>Crushbox</i>, sarai notificato e",
			'fourth' => "Congratulazioni: hai trovato la tua anima gemella"
		],

		'rules' => [
			'title' => "Regole",
			'first' => "Puoi scegliere fino a tre <i>Crush</i> per la tua <i>Crushbox</i>",
			'second' => "Per aggiungere una <i>Crush</i>, accedi alla <i>Crushbox</i> e inserisci il nome utente di Typed della tua <i>Crush</i>",
			'third' => "Una volta che avrai impostato la tua <i>Crush</i>, non potrai modificarla per 10 giorni",
			'fourth' => "Se vuoi puoi proteggere la tua <i>Crushbox</i> con una password: si bloccher&agrave; automaticamente dopo ",
			'fifth' => " minuti"
		],

		'pwd' => "Imposta una password",

		'not-pwd' => "Non impostare una password",

		'set' => "Imposta la password",

		'not-set' => "Cominciamo",

		'password' => "Password",

		'repeat' => "Ripeti la tua password",

		/*login*/
		'login' => [
			'pwd' => "Password errata"
		],

		'expire1' => "Inserisci la tua password (scadr&agrave; tra ",

		'expire2' => " minuti)",

		'join' => "Entra nella",

		/*crushbox*/
		'errors' => [
			'success' => "<i>Crushbox</i> aggiornata con successo",
			'self' => "Non puoi impostare te stesso come <i>Crush</i>",
			'twice' => "Non puoi impostare due volte la stessa <i>Crush</i>",
			'length' => "Lunghezza della <i>Crush</i> non valida",
			'first' => "La prima <i>Crush</i> non esiste",
			'second' => "La seconda <i>Crush</i> non esiste",
			'third' => "La terza <i>Crush</i> non esiste",
			'start' => "<i>Crushbox</i> impostata con successo",
			'login' => "Accesso effettuato con successo"
		],

		'congratulations' => "Congratulazioni",

		'match' => "ha aggiunto anche te alla sua <i>Crushbox</i>",

		'added' => "Sei stato aggiunto alla <i>Crushbox</i> di ",

		'person' => " persona! Chi potrebbe essere?",

		'people' => " persone! Chi potrebbero essere?",

		'first' => "Prima Crush",

		'second' => "Seconda Crush",

		'third' => "Terza Crush",

		'expire' => "Tempo di scadenza",

		'logout' => "Disconnettiti",

		'add' => "Aggiungi",

		'reset' => "Resetta",

		'update' => "Aggiorna",

		'tutorial' => "Rivedi le regole o Resetta la password"
	];

	$settings = [
		'title' => "Impostazioni",

		'description' => "Cambia il nome utente, la tua email o aggiorna l'immagine profilo",

		'file' => [
			'success' => "Immagine profilo aggiornata con successo",
			'error' => "Errore durante il caricamento del file",
			'size' => "L'immagine deve essere pi&ugrave; grande di 3KB e pi&ugrave; piccola di 2MB",
			'invalid' => "File di tipo ",
			'image' => " non valido: carica un'immagine"
		],

		'remove' => [
			'success' => "Immagine profilo rimossa con successo",
			'empty' => "Non avevi alcuna immagine profilo",
			'error' => "Impossibile eliminare il file"
		],

		'user' => [
			'success' => "Nome utente aggiornato con successo",
			'invalid' => "Nome utente non valido",
			'taken' => "Questo nome utente esiste gi&agrave;"
		],

		'email' => [
			'success' => "Email aggiornata con successo",
			'pending' => "Controlla la tua email per confermare il cambio",
			'spam' => "Troppe email inviate",
			'invalid' => "Email non valida",
			'taken' => "Questa email &egrave; associata ad un altro profilo",
			'send' => "Impossibile inviare l'email. Riprova pi&ugrave; tardi",
			'link' => "Link per il cambio di email non valido",
			'expired' => "Link per il cambio di email scaduto"
		],

		'privacy' => [
			'success' => "Privacy aggiornata con successo"
		],

		'unlink' => [
			'success' => "Disconnesso da Instagram con successo",
			'instagram' => "Instagram &egrave; gi&agrave; stato disconnesso tramite l'applicazione"
		],

		'old' => [
			'success' => "Password aggiornata con successo",
			'wrong' => "Password errata"
		],

		'pwd' => [
			'length' => "Lunghezza della password non valida",
			'match' => "Le password non corrispondono"
		],

		'avatar' => [
			'title' => "Aggiorna l'immagine profilo",
			'remove' => "Rimuovi l'immagine profilo"
		],

		'account' => [
			'title' => "Impostazioni dell'account",
			'user' => "Cambia nome utente",
			'email' => "Cambia email",
			'private' => "Privato",
			'public' => "Pubblico",
			'unlink' => "Scollega il tuo profilo da ",
			'link' => "Collega il tuo profilo ad Instagram"
		],

		'password' => [
			'title' => "Reimposta la Password",
			'old' => "Vecchia password",
			'pwd' => "Nuova password",
			'pwd2' => "Ripeti la nuova password"
		],

		'reset' => "Resetta",

		'save' => "Salva"
	];

	$style = [
		'title' => "Personalizza lo Stile",

		'description' => "Scegli il tuo stile per avere da Typed un'esperienza migliore",

		'errors' => [
			'green' => "Colore verde non valido",
			'blue' => "Colore blu non valido",
			'brown' => "Colore marrone non valido",
			'white' => "Colore bianco non valido",
			'black' => "Colore nero non valido",
			'gray' => "Colore grigio non valido"
		],

		'green' => "Verde",

		'blue' => "Blu",

		'brown' => "Marrone",

		'white' => "Bianco",

		'black' => "Nero",

		'gray' => "Grigio",

		'keep' => "Associa con il tuo account",

		'forbidden' => "Devi accedere per mantenere il tuo stile",

		'delete' => "Cancella il tuo stile corrente",

		'set' => "Imposta i tuoi colori"
	];

	$contact = [
		'language' => "Sentiti libero di scriverci nella lingua che preferisci",

		'optional' => "facoltativo",

		'logged' => "Devi accedere per poter vedere questa pagina",

		'goto' => "Vai a",

		'main' => "Pagina principale",

		'login' => "Accesso",

		'signup' => "Registrazione",

		'user' => "Pagina utente",

		'reply' => "Rispondi ai Type",

		'types' => "Modifica i Type",

		'points' => "Guadagna dei punti",

		'search' => "Pagina di ricerca",

		'instagram' => "Login con Instagram",

		'profile' => "Pagina di " . (isset($_SESSION['id']) ? $_user : "profilo"),

		'settings' => "Impostazioni",

		'style' => "Personalizza lo stile",

		'other' => "Altro"
	];

	$bug = [
		'title' => "Segnala un Errore",

		'description' => "Aiutaci a migliorare noi stessi e la tua esperienza",

		'errors' => [
			'success' => "Segnalazione inviata con successo",
			'page' => "Pagina del sito non valida",
			'email' => "Email non valida",
			'content' => "Lunghezza della segnalazione non valida"
		],

		'paragraph' => "Segnala qui un errore che hai trovato in questo sito per aiutarci a migliorare",

		'page' => "In quale pagina hai trovato l'errore",

		'textarea' => "Inserisci qui una spiegazione dell'errore",

		'submit' => "Invia la Segnalazione"
	];

	$advice = [
		'title' => "Dacci un Consiglio",

		'description' => "Confidaci i tuoi pensieri e trasforma le tue idee in realt&agrave;",

		'errors' => [
			'success' => "Consiglio inviato con successo",
			'page' => "Pagina del sito non valida",
			'email' => "Email non valida",
			'content' => "Lunghezza del consiglio non valida"
		],

		'paragraph' => "Dacci un consiglio riguardante il sito per aiutarci a migliorare",

		'page' => "A che pagina si riferisce il tuo consiglio",

		'textarea' => "Inserisci qui il tuo consiglio",

		'submit' => "Invia il Consiglio"
	];
