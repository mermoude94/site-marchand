<?php
require_once("Model/Model.class.php"); // Inclure la classe modèle
require_once("Vue/Vue_add_Client.php");

if (isset($_POST['Valider'])) 
{
    // Appeler la méthode insertuser avec les données du formulaire
    $unControleur->insertuser($_POST);
}

