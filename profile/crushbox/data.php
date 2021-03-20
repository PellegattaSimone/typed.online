<?php require_once 'defines.inc.php'?>
<?php

	$sql = "SELECT `crushbox`, `crushpwd`, `expire` FROM `data` WHERE `id`=".$_SESSION['id'];

	$stmt = $dbh->stmt_init();
	$stmt->prepare($sql);
	$stmt->execute();

	$data = $stmt->get_result()->fetch_assoc();

	$_SESSION['expire'] = $data['expire'];

	if(strtotime($data['crushbox']) > time() || $data['crushpwd'] === '0')
	{
		$date = date("Y-m-d H:i:s", strtotime("+{$_SESSION['expire']} minute", time()));

		$sql = "UPDATE `data` SET `crushbox`=? WHERE `id`=?";

		$stmt = $dbh->stmt_init();
		$stmt->prepare($sql);
		$stmt->bind_param("si", $date, $_SESSION['id']);
		$stmt->execute();

		header("Location: .");

	} else
		if($data['crushpwd'] !== NULL)
		{
			$_SESSION['login'] = $data['crushpwd'];
			header("Location: login");
		} else {
			$_SESSION['start'] = false;
			header("Location: start");
		}
