<?php
	//temp: disable after Individual Verification
	require_once 'defines.inc.php'
?>
<!DOCTYPE html>
<html lang="<?=$lang?>">
	<head>
		<?php
			require_once 'style.inc.php';

			switch($lang)
			{
				case "en":
					$first = "Access to Instagram is temporarily disabled due to a Facebook error caused by COVID-19.";
					$second = "We apologize for the inconvenience: please try again in a few days.";
					break;
				case "it":
					$first = "L'accesso ad Instagram &egrave; stato temporaneamente disabilitato a causa di un problema di Facebook durante il periodo del virus COVID-19.";
					$second = "Ci scusiamo per l'inconveniente: per favore riprova tra qualche giorno.";
					break;
				case "fr":
					$first = "L'acc&egrave;s &agrave; Instagram est temporairement d&eacute;sactiv&eacute; en raison d'une erreur Facebook caus&eacute;e par la maladie COVID-19.";
					$second = "Nous nous excusons pour la g&ecirc;ne occasionn&eacute;e: veuillez r&eacute;essayer dans quelques jours.";
					break;
				case "es":
					$first = "El acceso a Instagram se deshabilit&oacute; temporalmente debido a un problema de Facebook durante el per&iacute;odo del virus COVID-19.";
					$second = "Disculpe las molestias: intente nuevamente en unos d&iacute;as.";
					break;
				case "de":
					$first = "Der Zugriff auf Instagram wurde aufgrund eines Facebook-Problems w&auml;hrend des COVID-19-Viruszeitraums vor&uuml;bergehend deaktiviert.";
					$second = "Wir entschuldigen uns f&uuml;r die Unannehmlichkeiten: Bitte versuchen Sie es in ein paar Tagen erneut.";
					break;
			}
		?>

		<style>
			p {
				text-align: justify;
			}
		</style>
	</head>

	<body>
<?php include_once 'header.php'?>

		<h1>Instagram</h1>

		<p><?=$first?></p>

		<p><?=$second?></p>

<?php include_once 'footer.php'?>
