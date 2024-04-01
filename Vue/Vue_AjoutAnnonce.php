<center>

<h2>Ajouter une annonce</h2>
    
<form method="post" enctype="multipart/form-data">
<table>
    <label for="Marque">Marque:</label><br>

    <select id="Id_marque" name="Id_marque" required>
        <option value="Id_marque">Sélectionnez une marque</option>
        <?php
            foreach ($lesMarques as $UneMarque) 
            {
                echo "<option value=".$UneMarque['Id_marque'].">".$UneMarque['Nom']."</option>";
            }
        ?>
    </select><br><br>

    <label for="Ref">Modèle:</label><br>

    <select id="Id_ref" name="Id_ref" required>
        <option value="Id_ref">Sélectionnez un modèle</option>
        <?php
            foreach ($lesRefs as $uneRef)
            {
                echo "<option value=".$uneRef['Id_ref'].">".$uneRef['Nom']."</option>";
            }
        ?>
    </select><br><br>

    <label>Photo de la montre</label><br>
    <input type="file" name="Photo" accept="image/*"><br><br>

    <label for="Prix">Prix:</label><br>
    <input type="number" id="Prix" name="Prix" required><br><br>

    <label for="description">Description :</label><br>
    <input type="text" id="description" name="description"><br><br>

    <input type="submit" value="Valider">
</table>
</form>


</center>