<?php
/* Page: contact.php */
$mail ="contact@septillion.com";
if(isset($_POST['send'])) {
  if(empty($_POST['mail'])) {
    header('Location: contact.php?n=Le mail est vide');
  } else {
    if(!preg_match("#^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+.[a-zA-Z]{2,6}$#",$_POST['mail'])){
      header('Location: contact.php?n=Le mail est incorrecte');
    } else {
      if(empty($_POST['objet'])) {
        header('Location: contact.php?n=L\'objet est vide');
        echo "Le champ objet est vide";
      } else {
        if(empty($_POST['message'])) {
          header('Location: contact.php?n=Le message est vide');
        } else {
          //entêtes de la fonction mail de PHP
          $entetes = "MIME-Version: 1.0\r\n";
          $entetes .= "Content-type: text/html; charset=iso-8859-1\r\n";
          $entetes .= "From: Nom de votre site <".$_POST['mail'].">\r\n";
          $entetes .= "Reply-To: Nom de votre site <".$_POST['mail'].">\r\n";

          $mail=htmlentities($_POST['mail'],ENT_QUOTES,"ISO-8859-1"); //ENT_QUOTES Convertit les guillemets doubles et les guillemets simples, en entitès HTML, ISO-8859-1 est la norme pour les langues occidentales
          $objet=htmlentities($_POST['objet'],ENT_QUOTES,"ISO-8859-1");
          $message='To :'.$mail.'\nFrom : '.htmlentities($_POST['mail'],ENT_QUOTES,"ISO-8859-1").'\nMessage: '.htmlentities($_POST['message'],ENT_QUOTES,"ISO-8859-1");

          if(mail($mail,utf8_encode($objet),nl2br($message),$entetes)) { //la fonction nl2br permet de conserver les sauts de ligne et la fonction urf8_encore de conserver les accents dans le titre
            header('Location: contact.php?n=Mail envoyé');
          } else {
            header('Location: contact.php?n=Mail non envoyé, contactez nous.');
          }
        }
      }
    }
  }
} else {
  header('Location: index.php');
}
?>
