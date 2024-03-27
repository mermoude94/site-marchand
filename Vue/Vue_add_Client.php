<?php
 require_once ("../Gestion_Inscription.php");
?>
<img src="image/" height="200" width="200">
<h1>Inscription</h1>
<form method="post">
	<table>
        <tr>
			<td>Nom</td>
			<td> <input type="text" name="nom"></td>
		</tr>
		<tr>
			<td>Prenom</td>
			<td> <input type="text" name="prenom"></td>
		</tr>
		<tr>
			<td>Email:</td>
			<td> <input type="text" name="email"></td>
		</tr>
		<tr>
		<td>Adresse</td>
			<td> <input type="text" name="adresse"></td>
		</tr>
		<tr>
			<td>Mot de passe:</td>
			<td> <input type="password" name="mdp"></td>
		</tr>
		<tr>
			<td></td>
			<td> <input type="submit" name="Valider" value="Valider"></td>
		</tr>
    </table>
</form>
    <a href="../index.php?page=1">Retour</a>
