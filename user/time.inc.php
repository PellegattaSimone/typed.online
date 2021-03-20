<?php require_once 'defines.inc.php'?>
<?php

	if(basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]))
	{
		header("Location: " . HTTP . "?error=404");
		exit();
	}

	function timeago(&$time) {
		foreach((array)date_diff(date_create("now"), date_create($time)) as $key=>$date)
			if($date)
				return $key != 'f' ? $date . ' ' . $GLOBALS['times'][$key][(bool)($date - 1)] : 0;
	}
