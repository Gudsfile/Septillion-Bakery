<?php
session_start();
require('connexion.php');
$conn = Connect::connexion();
$messageManager = new MessageManager($conn);
$id = $_POST['id'];
echo $id;
$messageManager->delete($id);
header('Location: mails.php');

?>
