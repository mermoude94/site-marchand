<?php


// Vérifiez si les données POST sont présentes dans la session
if(isset($_SESSION['post_data'])) 
{
    $uneAnnonce = $unControleur->selectUneAnnonce($_SESSION['post_data']);
    require_once("Vue/Vue_UneAnnonce.php");   
} 
else 
{
    echo "Session post_data n'existe pas";
}




