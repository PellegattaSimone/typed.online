<!--Generic-->
		<meta charset="UTF-8" />
		<title><?=$text['title']?> | Typed</title>
		<meta name="description" content="<?=$description?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
		<meta name="author" content="Pellegatta Simone">
		<meta name="reply-to" content="support@typed.online">
		<meta name="coverage" content="Worldwide">
		<meta name="keywords" content="typed, instagram, message, anonymous, private, question, crush">
		<meta name="copyright" content="Creative Commons &copy; 2020">
		<?=isset($_SESSION['notranslate']) || isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) && in_array(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2), $langs) ? "<meta name=\"google\" content=\"notranslate\">\n" : ''?>

		<!--Favicons-->
		<link rel="manifest" href="<?=HTTP?>manifest.json">
		<link rel="apple-touch-icon" sizes="60x60" href="<?=HTTP?>icon/apple-touch-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="76x76" href="<?=HTTP?>icon/apple-touch-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="120x120" href="<?=HTTP?>icon/apple-touch-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="152x152" href="<?=HTTP?>icon/apple-touch-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="<?=HTTP?>icon/apple-touch-icon-180x180.png">
		<link rel="icon" type="image/png" sizes="32x32" href="<?=HTTP?>icon/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="<?=HTTP?>icon/favicon-16x16.png">
		<link rel="shortcut icon" href="<?=HTTP?>favicon.ico">
		<link rel="mask-icon" href="<?=HTTP?>icon/monochrome.svg" color="#4488FF">

		<!--Icon formatting-->
		<meta name="application-name" content="Typed">
		<meta name="apple-mobile-web-app-title" content="Typed">
		<meta name="msapplication-config" content="<?=HTTP?>icon/config.xml">
		<meta name="theme-color" content="#228800">
		<meta name="msapplication-TileColor" content="#228800">
		<meta name="thumbnail" content="<?=HTTP?>icon/android-chrome-256x256.png">

		<!--Social-->
		<meta itemprop="name" property="og:title" name="twitter:title" content="Typed">
		<meta itemprop="description" property="og:description" name="twitter:description" content="<?=$description?>">
		<meta itemprop="image" name="twitter:image" content="<?=HTTP?>icon/card.png">
		<meta property="og:image:alt" name="twitter:image:alt" content="Typed">
		<meta property="og:url" name="twitter:url" content="<?=URL.(isset($getlang) ? "?lang=".$getlang : '')?>">

		<!--Facebook-->
		<meta property="og:site_name" content="Typed">
		<meta property="og:type" content="<?=$page == "user" || $page == "profile" ? "profile" : "website"?>">
		<meta property="og:locale" content="<?=$lang?>">
		<meta property="fb:app_id" content="852132928636228">

		<meta property="og:image" content="<?=HTTP?>icon/square.png">
		<meta property="og:image:width" content="445">
		<meta property="og:image:height" content="445">
		<meta property="og:image:type" content="image/png">

		<meta property="og:image" content="<?=HTTP?>icon/wide.png">
		<meta property="og:image:width" content="1000">
		<meta property="og:image:height" content="524">
		<meta property="og:image:type" content="image/png">

		<meta property="og:see_also" content="https://www.typed.online">
		<meta property="og:see_also" content="https://www.typed.online/login">
		<meta property="og:see_also" content="https://www.typed.online/signup">
		<meta property="og:see_also" content="https://www.typed.online/user">
		<meta property="og:see_also" content="https://www.typed.online/profile">

		<!--Twitter-->
		<meta name="twitter:card" content="summary">
		<meta name="twitter:site" content="@typedonline">
		<meta name="twitter:creator" content="@simopellegatta">

		<!--Apple-->
		<meta name="mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">

		<!--Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato" media="all">
