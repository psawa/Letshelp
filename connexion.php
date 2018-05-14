<?php
	$donnees['menu']='connexion';
	$donnees['titre_page']='Connexion';
include 'entete.php'; ?>


<!-- On vérifie que l'utilisateur n'est pas déjà connecté (s'il possède un lien) -->
<?php if(isset($_SESSION['membre_id']) AND $_SESSION['membre_id']>0): ?>

<p>Tu es déjà connecté, que fais tu voyons ?</p>

<?php elseif(isset($_GET['forget']) AND $_GET['forget']==1):?>
<h2>Mot de passe oublié... Rolala !</h2>
<form action="recuperer_mdp.php" method="POST">
	<input type="mail" name="mail" placeholder="Ton email">
	<input type="submit">
</form>


<?php else: ?>
<div class="form">
	<form action="authentification.php" method="post">
		<input type="text" name="pseudo" id="pseudo" placeholder="Pseudo" required> <br>
		<input type="password" name="motdepasse" id="motdepasse" placeholder="Mot de passe" required> <br>
		<input type="submit" name="connexion" value="Se connecter">
	</form>
</div>

<p>Pas encore inscrit ? inscris toi <a href="inscription.php">ici</a></p>

<p>Mot de passe oublié ? clique <a href="connexion.php?forget=1">ici</a></p>

<?php endif; ?>


<?php include 'pied.php'; ?>