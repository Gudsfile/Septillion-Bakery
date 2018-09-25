<?php

// database connection parameters
$host='localhost'; //SQL server name
$db_name='septillion'; //database name
$charset='utf8'; //database charset default utf8
$user='root'; //database user name
$password='root'; //database password
$table_name='client'; //table name

/* Script Connexion */
session_start(); // à mettre tout en haut du fichier .php, cette fonction propre à PHP servira à maintenir la $_SESSION
if(isset($_POST['connexion'])) { // si le bouton "Connexion" est appuyé
    // on vérifie que le champ "Mail" n'est pas vide
    // empty vérifie à la fois si le champ est vide et si le champ existe belle et bien (is set)
    if(empty($_POST['mail'])) {
        echo "Le champ Mail est vide.";
    } else {
        // on vérifie maintenant si le champ "Mot de passe" n'est pas vide"
        if(empty($_POST['password'])) {
            echo "Le champ Mot de passe est vide.";
        } else {
            // les champs sont bien posté et pas vide, on sécurise les données entrées par le membre:
            $Mail = htmlentities($_POST['mail'], ENT_QUOTES, "ISO-8859-1"); // le htmlentities() passera les guillemets en entités HTML, ce qui empêchera les injections SQL
            $MotDePasse = htmlentities($_POST['password'], ENT_QUOTES, "ISO-8859-1");
            //on se connecte à la base de données:
            $mysqli = mysqli_connect($host, $user, $password, $db_name);
            //on vérifie que la connexion s'effectue correctement:
            if(!$mysqli){
                echo "Erreur de connexion à la base de données.";
            } else {
                // on fait maintenant la requête dans la base de données pour rechercher si ces données existe et correspondent:
                $Requete = mysqli_query($mysqli,"SELECT * FROM $table_name WHERE mail = '".$Mail."' AND password = '".$MotDePasse."'");//si vous avez enregistré le mot de passe en md5() il vous suffira de faire la vérification en mettant mdp = '".md5($MotDePasse)."' au lieu de mdp = '".$MotDePasse."'
                // si il y a un résultat, mysqli_num_rows() nous donnera alors 1
                // si mysqli_num_rows() retourne 0 c'est qu'il a trouvé aucun résultat
                if(mysqli_num_rows($Requete) == 0) {
                    echo "Le mail ou le mot de passe est incorrect, le compte n'a pas été trouvé.";
                } else {
                    // on ouvre la session avec $_SESSION:
                    //$_SESSION['mail'] = $Mail; // la session peut être appelée différemment et son contenu aussi peut être autre chose que le mail
                    //echo "Vous êtes à présent connecté !";
                    header("Location: index.php");
                }
            }
        }
    }
}

/* Script Inscription */
if(isset($_POST['inscription'])){//l'utilisateur à cliqué sur "S'inscrire", on demande donc si les champs sont défini avec "isset"
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
