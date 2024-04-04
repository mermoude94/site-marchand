<center>
    <h2>Annonce en cours</h2>
<div class='LesAnnonce'>
	<?php
	require_once("Gestion_LocationUneAnnonce.php");
		foreach ($lesAnnonce as $uneAnnonce) 
        {
			$UneImage = 'Vue/Asset/Photo/' . $uneAnnonce["nom_fichier"];
			echo "<div class='UneAnnonce'>";
						echo "<table>";
						echo "<tr>";
						echo "<img src=".$UneImage." alt='Annonce'>";
						echo "</tr>";
						echo "<tr>";
						echo "<td>Nom: ".$uneAnnonce['nom_user']."</td>";
						echo "</tr>";
						echo "<tr>";
						echo "<td>Prenom: ".$uneAnnonce['prenom_user']."</td>";
						echo "</tr>";
						echo "<tr>";
						echo "<td>Marque: ".$uneAnnonce['nom_marque']."</td>";
						echo "</tr>";
						echo "<tr>";
						echo "<td>Modele: ".$uneAnnonce['nom_ref']."</td>";
						echo "</tr>";
						echo "<tr>";
						echo "<td>Prix: ".$uneAnnonce['Prix']."Є</td>";
						echo "</tr>";
						echo "<tr>";
						echo "<td>Description: ".$uneAnnonce['description']."</td>";
						echo "</tr>";
						echo "<form method='post'>";
							echo "<tr>";
							echo "<td><input type='hidden' name='idAnnonce' value=".$uneAnnonce['Id_annonce']."></td>";
							echo "<td><input type='submit' name='selectUneAnnonce' value='Voir'></td>";
							echo "</tr>";
						echo "</form>";
				echo "</table>";
			echo "</div>";
		}
	?>
</div>