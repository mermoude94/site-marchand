<?php

$lesMarques = $unControleur->selectAllMarque();
$lesRefs = $unControleur->selectAllRef();

require_once ("Vue/Vue_AjoutAnnonce.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    

    $idUser = $_SESSION['iduser'] ?? null;
    if($idUser !== null) 
    {
        $_POST['iduser'] = $idUser;
        $unControleur->telechargerPhoto('Photo');
        $unControleur->insertAnnonce($_POST);
    }
    else 
    {
        header("refresh:3;url=Index.php");
        echo "Probleme de connexion nous allons vous rediriger vers la page de connexion: ";
    }
}
