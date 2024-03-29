<?php

if(isset($_SESSION['post_data']))
{
    $uneAnnonce = $unControleur->selectUneAnnonce($_SESSION['post_data']);
    require_once("Vue/Vue_UneAnnonce.php");
        if($annonce['iduser'] == $_SESSION['iduser'])
        { 
            echo "<form method='post'>";
                echo "<td><input type='hidden' name='Id_annonce' value=".$annonce['Id_annonce']."></td>";
                echo "<td><input type='submit' name='Suppression' value='Suprimer'></td>";
            echo "</form>";

            if(isset($_POST['Suppression']))
                {
                    $unControleur->supprimerannonce($_POST['Id_annonce']);
                    header("refresh:3;url=?page=3");
                    echo "Annonce suprimer nous allons vous rediriger.";
                }
        }
        else
        {
            require_once("Vue/Vue_Signalement.php");
            if(isset($_POST['Signaler'])) 
                {
                    echo "<form method='post'>";
                    echo "<input type='hidden' name='idplaignant' value=".$_SESSION['iduser'].">";
                    echo "<input type='hidden' name='idsignaler' value=".$annonce['iduser'].">";
                    echo "<input type='hidden' name='Id_annonce' value=".$annonce['Id_annonce'].">";
                    echo "<input type='text' name='description'>";
                    echo "<input type='submit' _name='Valider' value='Valider'>";
                    echo "</form>";
                }
            if(isset($_POST['Valider']))
                {
                    $unControleur->signaler($_POST); 
                    echo "Signalement pris en compte merci de votre aide.";       
                }
        }   
} 
else 
{
    echo "Session post_data n'existe pas";
}




