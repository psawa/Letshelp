<?php 
	session_start();
	require_once('connexion_base_mamp.php'); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Let's Help - <?php if(isset($donnees['titre_page'])){echo $donnees['titre_page'];} else{echo "Page inconnue";} ?></title>
	<link rel="stylesheet" media="all" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" media="handheld and (max-width:800)" href="style_mobile.css">
	<!-- On importe des polices via google font -->
	<style>
		@import url('https://fonts.googleapis.com/css?family=Boogaloo|Indie+Flower');
	</style>
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
	<link rel="icon" href="images/favicon.ico" type="image/x-icon">
</head>
<body>
	<div class="tout">
		<header>
			<div class="haut_header">
				<a href="index.php"><img src="images/logo.png" class="logo" alt="logo"></a>
				<div class="titres_top">
					<p class="titre">Let's Help</p>
					<p class="sous_titre">N'est il pas temps de s'aider ?</p>
				</div>
				<div class="coin_utilisateur">
					<!-- Si l'utilisateur est connecté, on affiche les infos utilisateur -->
					<?php if(isset($_SESSION['membre_id']) AND $_SESSION['membre_id']>0):?>
						<ul id="pseudo_survol">
								<li><a href="mon_compte.php"><span class="pseudo"><?php echo $_SESSION['pseudo']; ?></span></a></li>
								<li>
									<ul id="actions_user">
											<?php // afficher les options administrateurs pour les admin
											if($_SESSION['admin']==1) {?>
											<a href="administration.php"><li>Administration</li></a>
											<?php } ?>
											<a href="mes_annonces.php"><li>Mes annonces</li></a>
											<a href="mes_excuses.php"><li>Mes excuses</li></a>
											<a href="deconnexion.php"><li>Deconnexion</li></a>
									</ul>
								</li>
							</ul>
					<!-- S'il n'est pas connecté, on affiche le bouton inscription et connexion -->
					<?php else: ?>
						
							<a href="inscription.php" class="bouton">Inscription</a> <br/>
							<a href="connexion.php" class="bouton">Connexion</a>
						
					<?php endif; ?>
				
				</div>
			</div>
		<!-- Menu de navigation, où lorsqu'on est sur une page, son onglet associé change de style -->
		<nav>
				<ul>
					<?php
						if(isset($donnees['menu']) AND $donnees['menu']=='accueil'){
							echo '<li class="selected"><a href="index.php">Accueil</a> </li>';
						}
						else{ echo "<a href='index.php'><li>Accueil</li></a>";
						}
						if(isset($donnees['menu']) AND $donnees['menu']=='poster_annonce'){
							echo '<li class="selected"><a href="poster_annonce1.php">Poster une annonce</a></li>'; 
						}
						else{ echo "<a href='poster_annonce1.php'><li>Poster une annonce</li></a>";
						}
						
						if(isset($donnees['menu']) AND $donnees['menu']=='voir_annonces'){
							echo '<li class="selected"><a href="voir_annonces.php">Voir les annonces</a></li>';
						}
						else{ echo "<a href='voir_annonces.php'><li>Voir les annonces</li></a>";
						}
						if(isset($donnees['menu']) AND $donnees['menu']=='cpasmafaute'){
							echo '<li class="selected"><a href="cpasmafaute.php">CpasMaFaute</a></li>';
						}
						else{ echo "<a href='cpasmafaute.php'><li>Cpasmafaute</li></a>";
						}
						if(isset($donnees['menu']) AND $donnees['menu']=='a_propos'){
							echo '<li class="selected"><a href="a_propos.php">A propos</a></li>';
						}
						else{ echo "<a href='a_propos.php'><li>A propos</li></a>";
						}
					?>
				</ul>
			</nav>
		</header>
		<div class="corps">
			
			<div class="contenu">
