<?php
	$donnees['menu']='connexion';
	$donnees['titre_page']='Connexion';
include 'entete.php'; ?>

<!-- On vérifie que l'utilisateur n'est pas déjà connecté (s'il possède un lien) -->
<?php if(isset($_SESSION['membre_id']) AND $_SESSION['membre_id']>0): ?>

<p>Tu es déjà connecté, que fais tu voyons ?</p>

<?php else: ?>
<div class="form">
	<form action="authentification.php" method="post">
		<label for="pseudo">pseudo : </label>
		<input type="text" name="pseudo" id="pseudo"> <br>
		<label for="motdepasse">Mot de passe : </label>
		<input type="password" name="motdepasse" id="motdepasse"> <br>
		<input type="submit" name="connexion" value="Se connecter">
	</form>
</div>

<p>Pas encore inscrit ? inscris toi <a href="inscription.php">ici</a></p>

<?php endif; ?>


<?php include 'pied.php'; ?>