<?php
require_once ("Vue/Vue_MonCompte.php");

if (isset($_POST['Suppression'])) 
{
    $unControleur = new Controleur();
    $unControleur->supprimercompte($_POST);
}