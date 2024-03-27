<center>
    <h2>Annonce en cours</h2>
<div class='LesAnnonce'>
	<?php
		foreach ($lesAnnonce as $uneAnnonce) 
        {
			echo "<div class='UneAnnonce'>";
				echo "<table>";
					echo "<tr>";
					echo "<td>".$uneAnnonce['Id_annonce']."</td>";
					echo "</tr>";
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
				echo "</table>";
			echo "</div>";
		}
	?>
</div>