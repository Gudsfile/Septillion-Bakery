<?php
require('../BDD/Employee.php');
require('../BDD/EmployeeManager.php');
require('../BDD/Category.php');
require('../BDD/CategoryManager.php');
require('../BDD/Product.php');
require('../BDD/ProductManager.php');
require('../BDD/Image.php');
require('../BDD/ImageManager.php');
require('../BDD/Message.php');
require('../BDD/MessageManager.php');
require('../BDD/Client.php');
require('../BDD/ClientManager.php');
require('../BDD/Feedback.php');
require('../BDD/FeedbackManager.php');
require('../BDD/IsOrdered.php');
require('../BDD/IsOrderedManager.php');
require('../BDD/Order.php');
require('../BDD/OrderManager.php');
require('verif_connexion.php');
class Connect {
    public static function connexion() {
        try {
          return new PDO("mysql:host=localhost;dbname=Septillion","root");
        }
        catch(PDOException $e) {
            die('<h3>Erreur! voir back-office\connexion.php </h3>');
        }
        return $bdd;
    }
}
?>
