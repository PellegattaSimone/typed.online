<?php require_once 'defines.inc.php'?>
<?php

	if(isset($_POST['signed_request']))
	{
		require_once 'instagram/signed.inc.php';

		$instagram = verify($_POST['signed_request']);

		if($instagram !== NULL)
		{
			try {
				$sql = "SELECT `id` FROM `accountlist` WHERE `instagram`=?";

				$stmt = $dbh->stmt_init();
				$stmt->prepare($sql);
				$stmt->bind_param("i", $instagram);
				$stmt->execute();

				$row = $stmt->get_result()->fetch_assoc();

				if($row !== NULL)
					echo json_encode(array('success'=>true, 'url'=>HTTP."instagram/deletion/".hash("crc32", $row['id']), 'confirmation_code'=>hash("crc32", $row['id'])));
				else
				{
					trigger_error("Instagram account not found in the database: $instagram", E_USER_NOTICE);
					echo json_encode(array('success'=>false, 'error'=>"Instagram account not found in the database"));
				}
			} catch (mysqli_sql_exception $exception) {

				$driver->logexc($exception);

				switch($exception->getTrace()[0]['function'])
				{
					case 'prepare':
							echo json_encode(array('success'=>false, 'error'=>"Error connecting to the server"));
						break;
					default:
							echo json_encode(array('success'=>false, 'error'=>"Unknown error"));
						break;
				}
			}
		}
		else
		{
			trigger_error("Invalid instagram authentication: ".$_POST['signed_request'], E_USER_NOTICE);
			echo json_encode(array('success'=>false, 'error'=>"Invalid instagram authentication"));
		}
	} else
		header("Location: " . HTTP . "?error=403");
