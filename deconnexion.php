<?php 
$donnees['menu'] ='deconnexion';
$donnees['titre_page']="deconnexion";
include 'entete.php';
 ?>

<?php
$_SESSION = array(); // vide le tableau des sessions
session_destroy(); // détruit la session
header("location:index.php"); // redirige vers l'accueil
?>

<?php include 'pied.php'; ?>