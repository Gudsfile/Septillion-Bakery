<?php
session_start();
require('connexion.php');
$conn = Connect::connexion();
$messageManager = new MessageManager($conn);
$employeeManager = new EmployeeManager($conn);

$CSRFtoken = isset($_POST['CSRFtoken']) ? $_POST['CSRFtoken'] : -1;
if (hash_equals($CSRFtoken, $_SESSION['CSRFtoken'])) {
  if ($employeeManager->getByMail($_POST['mail'])->id() == 0) {
    $erreur = 1;
    header('Location: mails.php?erreur=1');
    exit();
  }

  $messageData = array(
    "message_object" => $_POST['object'],
    "body" => $_POST['body'],
    "id_sender" => intval($_SESSION['id_admin']),
    "id_receiver" => $employeeManager->getByMail($_POST['mail'])->id(),
  );
  $newMessage = new Message($messageData);
  $idMessage = $messageManager->add($newMessage);
  if ($idMessage == 0){
    $erreur = 2;
    header('Location: mails.php?erreur=2');
    exit();
  } else {
    $erreur = 3;
    $_SESSION['CSRFtoken'] = bin2hex(random_bytes(32));
    header('Location: mails.php?erreur=3');
    exit();
  }
}
?>
