<?php
/* Page: contact.php */
$VotreAdresseMail="contact@septillion.com";//mettez ici votre adresse mail
if(isset($_POST['send'])) { // si le bouton "Envoyer" est appuyé
  //on vérifie que le champ mail est correctement rempli
  if(empty($_POST['mail'])) {
    echo "Le champ mail est vide";
  } else {
    //on vérifie que l'adresse est correcte
    if(!preg_match("#^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+.[a-zA-Z]{2,6}$#",$_POST['mail'])){
      echo "L'adresse mail entrée est incorrecte";
    }else{
      //on vérifie que le champ sujet est correctement rempli
      if(empty($_POST['name'])) {
        echo "Le champ sujet est vide";
      }else{
        //on vérifie que le champ sujet est correctement rempli
        if(empty($_POST['message'])) {
          echo "Le champ message est vide";
        }else{
          //tout est correctement renseigné, on envoi le mail
          //on renseigne les entêtes de la fonction mail de PHP
          $Entetes = "MIME-Version: 1.0\r\n";
          $Entetes .= "Content-type: text/html; charset=iso-8859-1\r\n";
          $Entetes .= "From: Nom de votre site <".$_POST['mail'].">\r\n";//de préférence une adresse avec le même domaine de là où, vous utilisez ce code, cela permet un envoie quasi certain jusqu'au destinataire
          $Entetes .= "Reply-To: Nom de votre site <".$_POST['mail'].">\r\n";
          //on sécurise les champs
          $Mail=htmlentities($_POST['mail'],ENT_QUOTES,"ISO-8859-1"); //ENT_QUOTES Convertit les guillemets doubles et les guillemets simples, en entitès HTML, ISO-8859-1 est la norme pour les langues occidentales
          $Sujet=htmlentities($_POST['sujet'],ENT_QUOTES,"ISO-8859-1");
          $Message=htmlentities($_POST['message'],ENT_QUOTES,"ISO-8859-1");
          //en fin, on envoi le mail
          if(mail($VotreAdresseMail,utf8_encode($Sujet),nl2br($Message),$Entetes)) { //la fonction nl2br permet de conserver les sauts de ligne et la fonction urf8_encore de conserver les accents dans le titre
            echo "Le mail à été envoyé avec succès !";
          } else {
            echo "Une erreur est survenue, le mail n'a pas été envoyé";
          }
        }
      }
    }
  }
}
?>
