<?php
require('../BDD/OrderManager.php');
require('../BDD/Order.php');
require('../BDD/IsOrderedManager.php');
require('../BDD/IsOrdered.php');
require('../BDD/EmployeeManager.php');
require('../BDD/Employee.php');
require('../BDD/ClientManager.php');
require('../BDD/Client.php');
require('../BDD/CategoryManager.php');
require('../BDD/Category.php');
require('../BDD/ProductManager.php');
require('../BDD/Product.php');
require('../BDD/Newsletter.php');
require('../BDD/NewsletterManager.php');

class Connect
{
  public static function connexion() {
    try {
      return new PDO("mysql:host=localhost;dbname=septillion","root","root");
    }
    catch(PDOException $e) {
      die('<h3>Erreur!</h3>');
    }
    return $bdd;
  }
}
?>
