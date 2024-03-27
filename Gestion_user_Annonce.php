<?php

$idUtilisateur = $_SESSION['iduser'];
$lesAnnonces = $unControleur->selectIdAnnonces($idUtilisateur);

require_once ("Vue/Vue_user_Annonce.php");