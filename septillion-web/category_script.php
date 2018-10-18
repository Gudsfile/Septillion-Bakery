<?php


require('BDD/Category.php');
require('BDD/CategoryManager.php');
$conn = new PDO("mysql:host=localhost;dbname=septillion", "root", "root");
$categoryManager = new CategoryManager($conn);
$categoryManager->setDb($conn);
$error = 100;
if (isset($_GET["erreur"]))
    $error = $_GET["erreur"];


$categoryList = $categoryManager->getList();


foreach ($_POST as $key => $value) {
    if($value == null){
        header("Location: category.php?erreur=1");
        exit();
    }
}

    $newCategory = new Category($_POST);
    if($categoryManager->add($newCategory)>0){
        session_start();
        $_SESSION['name'] = $_POST['name'];
        $_SESSION['description'] = $_POST['description'];
        header("Location: category.php");
    }







?>