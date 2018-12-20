<?php
if(!isset($_SESSION['connect'])){
	header('Location: script_logout.php');
}

if (!isset($_SESSION['IPtoken']) || !isset($_SESSION['UAtoken'])) {
	header('Location: script_logout.php');
} else {
	if ($_SESSION['IPtoken'] != $_SERVER['REMOTE_ADDR'] || $_SESSION['UAtoken'] != $_SERVER['HTTP_USER_AGENT']) {
		header('Location: script_logout.php');
	}
}
?>
