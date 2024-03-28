<?php

if (isset($_POST['selectUneAnnonce'])) 
{
    $_SESSION['post_data'] = $_POST; 
    header("Location: index.php?page=6");
    exit();
}

?>