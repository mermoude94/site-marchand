<?php
require_once("Vue/Vue_add_Client.php");

if (isset($_POST['Valider'])) 
{
    // Appeler la méthode insertuser avec les données du formulaire
    $unControleur->insertuser($_POST);
}

