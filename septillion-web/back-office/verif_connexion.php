<?php
if(!isset($_SESSION['connect'])){
	header('Location: script_logout.php');
}

$IPtoken = isset($_SESSION['IPtoken']) ? $_SESSION['IPtoken'] : -1;
$UAtoken = isset($_SESSION['UAtoken']) ? $_SESSION['UAtoken'] : -1;
if (!isset($_SESSION['IPtoken']) || !isset($_SESSION['UAtoken'])) {
	header('Location: script_logout.php');
} else {
	if ($_SESSION['IPtoken'] != $_SERVER['REMOTE_ADDR'] || $UAtoken != $_SERVER['HTTP_USER_AGENT']) {
		header('Location: script_logout.php');
	}
}
?>
