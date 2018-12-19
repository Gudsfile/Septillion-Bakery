<?php
session_start();
require('connexion.php');
$conn = Connect::connexion();
$messageManager = new MessageManager($conn);
$employeeManager = new EmployeeManager($conn);

$CSRFtoken = isset($_POST['CSRFtoken']) ? $_POST['CSRFtoken'] : -1;
$IPtoken = isset($_SESSION['IPtoken']) ? $_SESSION['IPtoken'] : -1;
$UAtoken = isset($_SESSION['UAtoken']) ? $_SESSION['UAtoken'] : -1;

// compare CSRFtoken and ip
if (hash_equals($_SESSION['CSRFtoken'], $CSRFtoken) && $IPtoken == $_SERVER['REMOTE_ADDR'] && $UAtoken == $_SERVER['HTTP_USER_AGENT']) {
  //Secure post's data :
  $messageObject = htmlentities($_POST['object'], ENT_QUOTES, "ISO-8859-1");
  $body = htmlentities($_POST['body'], ENT_QUOTES, "ISO-8859-1");
  $receiver = htmlentities($_POST['receiver'], ENT_QUOTES, "ISO-8859-1");

  $messageData = array(
    "message_object" => $messageObject,
    "body" => $body,
    "id_sender" => intval($_SESSION['id_admin']),
    "id_receiver" => $receiver,
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
