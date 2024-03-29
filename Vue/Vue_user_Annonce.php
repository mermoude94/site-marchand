<center>
    <h2> Mes annonce en cours</h2>

	<div class='LesAnnonce'>
	<?php
	require_once("Gestion_LocationUneAnnonce.php");
		foreach ($lesAnnonces as $uneAnnonce) 
        {
			echo "<div class='UneAnnonce'>";
				echo "<table>";
					echo "<tr>";
					echo "<td>".$uneAnnonce['nom_user']. $uneAnnonce['prenom_user']."</td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td>".$uneAnnonce['nom_marque']."</td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td>".$uneAnnonce['nom_ref']."</td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td>".$uneAnnonce['Prix']."Є</td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td>".$uneAnnonce['description']."Є</td>";
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