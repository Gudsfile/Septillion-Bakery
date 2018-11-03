<?php session_start() ?>
<?php if(!isset($_SESSION['mail']) && !isset($_SESSION['password'])){
	header("Location: index.php");
	exit();
}
?>


<!-- Ajout du message dans la table des message avec id du employee concerné -->
<?php
echo "<script>
alert('Message envoyé ! le retour par mail');
window.location.href='order_track.php';
</script>";
?>