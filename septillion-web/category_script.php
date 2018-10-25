<?php


require('BDD/Category.php'); 
require('BDD/CategoryManager.php'); 
$conn = new PDO("mysql:host=localhost;dbname=septillion", "root", "root");
$categoryManager = new CategoryManager($conn);
$categoryManager->setDb($conn);



foreach ($_POST as $key => $value) {
    if($value == null){
        header("Location: category.php?erreur=1");
        exit();
    }
}

    $newCategory = new Category($_POST);
    $newCategory->SetCreated_by('1001');
    if($categoryManager->add($newCategory)>0){
        
        //header("Location: category.php");



        //exit();
    }
    
    echo 'ERROR : no category added';





?>
