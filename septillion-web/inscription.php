<?php

// database connection parameters
$host='localhost'; //SQL server name
$db_name='septillion'; //database name
$charset='utf8'; //database charset default utf8
$user='root'; //database user name
$password='root'; //database password
$table_name='client'; //table name

/* page: inscription.php */
echo "toto";
if(isset()$_POST['inscription'])){//l'utilisateur à cliqué sur "S'inscrire", on demande donc si les champs sont défini avec "isset"
  //connexion à la base de données:
  $mysqli = mysqli_connect($host, $user, $password, $db_name);
  if(!$mysqli) {
    echo "Connexion non établie.";
    exit;
  } else {
    if(empty($_POST['last_name'])){//le champ last-name est vide, on arrête l'exécution du script et on affiche un message d'erreur
        echo "Le champ Nom est vide.";
    } elseif(empty($_POST['first_name'])){//le champ first-name est vide, on arrête l'exécution du script et on affiche un message d'erreur
        echo "Le champ Prénom est vide.";
    } elseif(empty($_POST['phone_number'])){//le champ phonr-number est vide, on arrête l'exécution du script et on affiche un message d'erreur
        echo "Le champ Numéro de téléphone est vide.";
    } elseif(empty($_POST['mail'])){//le champ mail est vide, on arrête l'exécution du script et on affiche un message d'erreur
        echo "Le champ Mail est vide.";
    } elseif(!preg_match("#^[a-z0-9]+$#",$_POST['mail'])){//le champ pseudo est renseigné mais ne convient pas au format qu'on souhaite qu'il soit, soit: que des lettres minuscule + des chiffres (je préfère personnellement enregistrer le pseudo de mes membres en minuscule afin de ne pas avoir deux pseudo identique mais différents comme par exemple: Admin et admin)
        echo "Le mail doit être renseigné en lettres minuscules sans accents, sans caractères spéciaux.";
    } elseif(empty($_POST['password'])){//le champ mot de passe est vide
        echo "Le champ Mot de passe est vide.";
    } elseif(mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM $table_name WHERE mail='".$_POST['mail']."'"))==1){//on vérifie que ce pseudo n'est pas déjà utilisé par un autre membre
        echo "Ce mail est déjà utilisé.";
    } else {
        //toutes les vérifications sont faites, on passe à l'enregistrement dans la base de données:
        //Bien évidement il s'agit là d'un script simplifié au maximum, libre à vous de rajouter des conditions avant l'enregistrement comme la longueur minimum du mot de passe par exemple
        if(!mysqli_query($mysqli,"INSERT INTO $table_name SET first_name='".$_POST['first_name']."', last_name='".$_POST['last_name']."', phone_number='".$_POST['phone_number']."', mail='".$_POST['mail']."', password='".$_POST['password']."'")){//password='".md5($_POST['password'])."'")){//on crypte le mot de passe avec la fonction propre à PHP: md5()
            echo "Une erreur s'est produite: ".mysqli_error($mysqli);//je conseille de ne pas afficher les erreurs aux visiteurs mais de l'enregistrer dans un fichier log
        } else {
            echo "Vous êtes inscrit avec succès!";
            //on affiche plus le formulaire
        }
    }
  }
}
?>
