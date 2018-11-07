<?php
include('header_link.php');
require('../BDD/OrderManager.php');
require('../BDD/Order.php');
require('../BDD/IsOrderedManager.php');
require('../BDD/IsOrdered.php');
require('../BDD/EmployeeManager.php');
require('../BDD/Employee.php');
require('../BDD/ClientManager.php');
require('../BDD/Client.php');
session_start();
if(!isset($_SESSION['mail']) && !isset($_SESSION['password'])){
  header("Location: index.php");
  exit();
}

// Ajout du message dans la table des message avec id du employee concerné
$conn = Connect::connexion();
$orderManager =  new OrderManager($conn);
$employeeManager = new EmployeeManager($conn);
$isOrderedManager = new IsOrderedManager($conn);
$productManager = new ProductManager($conn);
$clientManager = new ClientManager($conn);

$order = $orderManager->get($_POST['id_order']);
$employee=$employeeManager->get($order->employee());
$client=$clientManager->get($order->client());

$to = $employee->mail();
$subject = $_POST['objet'];
$txt = "Client-id : ".$client->id()."\n\t first name : ".$client->first_name()."\n\t last name : ".$client->last_name()."\n****** Commande ******"."\n Commande-id : ".$order->id()."\n\t description : ".$order->description()."\n****** Message ******\n".$_POST['message'];

mail($to, $subject,$txt);

echo "<script>
alert('Message envoyé ! le retour par mail');
window.location.href='order_track.php';
</script>";
?>
