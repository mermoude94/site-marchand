<?php

echo "<div class='UneAnnonce'>";
		foreach($uneAnnonce as $annonce)
		{
			echo "<table>";
				echo "<tr>";
					echo "<td>".$annonce['Id_annonce']."</td>";
				echo "</tr>";
				echo "<tr>";
					echo "<td>".$annonce['iduser']. $annonce['prenom_user']."</td>";
				echo "</tr>";
				echo "<tr>";
					echo "<td>".$annonce['nom_marque']."</td>";
				echo "</tr>";
				echo "<tr>";
					echo "<td>".$annonce['nom_ref']."</td>";
				echo "</tr>";
				echo "<tr>";
					echo "<td>".$annonce['Prix']."Є</td>";
				echo "</tr>";
				echo "<tr>";
					echo "<td>".$annonce['description']."</td>";
				echo "</tr>";
			echo "</table>";
			}	
echo "</div>";