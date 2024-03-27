<img src="image/" height="200" width="200">
<center>
    <h1>Gestion de Mon Compte</h1>
</center>
<?php
echo "<p style='text-align:center;'>Bonjour ". $_SESSION['prenom'] ." et bien venue dans votre espace ici vous pourez gerer vos donnée et votre compte</p>";
?>

<center>
    <p>
        <?php
            echo "Vos données:    </br> Votre Nom: " .$_SESSION['nom']. "</br> Votre Prenom: " .$_SESSION['prenom']. "</br> Votre Adresse: " .$_SESSION['adresse']. "</br> Votre Email:   ".$_SESSION['prenom']. "</br>";
        ?>
    </p>
</center>

<form method="post">
    <input type="submit" name="Suppression" value="Supprimer Mon Compte"/></br>
</form>


<a href="index.php?page=1">Retour</a>