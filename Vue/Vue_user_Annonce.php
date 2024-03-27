<center>
    <h2> Mes annonce en cours</h2>

<table border="1">
	<tr>
		<td>Numero de l'annonce</td>
		<td>Vendeur</td>
		<td>Marque</td>
		<td>Modele</td>
		<td>Prix</td>

	</tr>
	<?php
		foreach ($lesAnnonce as $uneAnnonce) 
        {
			echo "<tr>";
			echo "<td>".$uneAnnonce['Id_annonce']."</td>";
			echo "<td>".$uneAnnonce['nom_user']. $uneAnnonce['prenom_user']."</td>";
			echo "<td>".$uneAnnonce['nom_marque']."</td>";
			echo "<td>".$uneAnnonce['nom_ref']."</td>";
			echo "<td>".$uneAnnonce['Prix']."</td>";

		}
	?>
</table>

<div class="Annonce">
	<div class="Marque">
	</div>
	<div class="Modele">
	</div>
	<div class="Numero-annonce">
	</div>
</div>