<?php require_once 'defines.inc.php'?>
<?php

	if(!empty($_SESSION['instauser']))
	{
		try {
			$sql = "SELECT `tokendate` FROM `accountlist` WHERE `id`=?";

			$stmt = $dbh->stmt_init();
			$stmt->prepare($sql);
			$stmt->bind_param("i", $_SESSION['id']);
			$stmt->execute();

			$_SESSION['instauser'] = false;
			$tokendate = $stmt->get_result()->fetch_assoc()['tokendate'];

			if($tokendate !== NULL)
			{
				require_once 'instagram/delete.inc.php';
				if(delete($dbh, $_SESSION['id'], $_user, $_email, $tokendate, "Typed Settings"))
					header("Location: .?unlink=success");
				else
					header("Location: .?unlink=nolog");
			}
			elseif(file_exists(ROOT."instagram/deletions/".hash("crc32", $_SESSION['id']).".txt"))
				header("Location: .?unlink=instagram");
			else {
				trigger_error("Unable to unlink Instagram profile from: ".$_SESSION['id'], E_USER_WARNING);
				header("Location: .?unlink=unknown");
			}

		} catch (mysqli_sql_exception $exception) {

			$driver->logexc($exception);

			switch($exception->getTrace()[0]['function'])
			{
				case 'prepare':
					header("Location: .?unlink=conn");
					break;
				default:
					header("Location: .?unlink=unknown");
					break;
			}
		}
	} else {
		$_SESSION['check'] = true;
		header("Location: .");
	}
