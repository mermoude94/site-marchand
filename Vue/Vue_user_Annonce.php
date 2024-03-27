<center>
    <h2> Mes annonce en cours</h2>

	<div class='LesAnnonce'>
	<?php
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
				echo "</table>";
			echo "</div>";
		}
	?>
</div>