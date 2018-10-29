<?php
  require('BDD/Message.php');
  require('BDD/MessageManager.php');
  require('BDD/Employee.php');
  require('BDD/EmployeeManager.php');
  $conn = new PDO("mysql:host=localhost;dbname=Septillion", "root");
  $messageManager = new MessageManager($conn);
  $employeeManager = new EmployeeManager($conn);
  $messageList = $messageManager->getByReceiver(1001);
?>
<table class="table table-hover table-light">
  <?php
  foreach ($messageList as $value) {
    echo "<tr>";
    echo "<td>".$employeeManager->get($value->id_sender())->first_name()." ".$employeeManager->get($value->id_sender())->last_name()."</td>";
    echo "<td>".$value->message_object()."</td>";
    echo "<td>".$value->sent_date()."</td>";
    echo "</tr>";
  }
  ?>
</table>
