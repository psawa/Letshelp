 <?php 
$donnees['menu'] ='';
$donnees['titre_page']='Administration';
include 'entete.php'; ?>

<?php 
if(isset($_SESSION['admin']) AND $_SESSION['admin']==1):?>

	<ul>
		<li> <a href="administration.php?a=liste_membre">Gérer les membres</a></li>
	</ul>

	<?php if(isset($_GET['a'])):?>
		<?php if($_GET['a']=="liste_membre"){
			$requete = "SELECT membre.id, membre.pseudo, membre.email, membre.admin, COUNT(annonce.id_membre) as nb_annonce FROM membre LEFT JOIN annonce ON annonce.id_membre = membre.id GROUP BY membre.id;";
			$reponse = $pdo->prepare($requete);
			$reponse->execute();
			$enregistrements = $reponse->fetchall();
		?>
			<table>
				<tr>
					<th>Pseudo</th>
					<th>email</th>
					<th>Admin</th>
					<th>Nombre annonces</th>
				</tr>
				<?php
				for ($i=0; $i < count($enregistrements); $i++) { 
					echo '<tr>';
					echo '<td>'.$enregistrements[$i]['pseudo'].'</td>';
					echo '<td>'.$enregistrements[$i]['email'].'</td>';
					echo '<td>'.$enregistrements[$i]['admin'].'</td>';
					echo '<td>'.$enregistrements[$i]['nb_annonce'].'</td>';
					echo '</tr>';
				}
				?>

			</table>
		<?php 
		}
		?>
	<?php endif; ?>
		

		
<?php else: ?> 
	<p>Tu n'as pas les droits pour accéder à cette page.</p>

<?php endif; ?>

<?php include 'pied.php'; ?>