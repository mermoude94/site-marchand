<?php
	session_start();
	require_once("Controleur/Controleur.class.php");
	$unControleur= new Controleur; 
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="Vue/Asset/css/Vue.css">
</head>
<body>
	<center>
		<?php
		if(!isset($_SESSION['email']))
		{
			require_once ("Vue/Vue_connexion.php");
		}

		if (isset($_POST['seConnecter']))
		{
			$email = $_POST['email'];
			$mdp = $_POST['mdp'];
			$unUser = $unControleur->verifConnexion($email, $mdp);
			if ($unUser !=null)
			{
				$_SESSION['iduser'] = $unUser['iduser'];
				$_SESSION['nom'] = $unUser['nom'];
				$_SESSION['prenom'] = $unUser['prenom'];
				$_SESSION['email'] = $unUser['email'];
				$_SESSION['adresse'] = $unUser['adresse'];
				header("Location: index.php?page=1");

			}
			else 
			{
				echo "<br>Votre identifiant ou mot de passe est incorrect";
			}
		}

		if  (isset($_SESSION['email']))
		{
			echo '
				<a href="index.php?page=2">
					<img src="Vue/Asset/Image/accueil.png" height="100" width="100" alt="Page d accueil">
				</a>
				<a href="index.php?page=3">
					<img src="Vue/Asset/Image/montre.png" height="100" width="100" alt="Annonce">
				</a>
				<a href="index.php?page=4">
					<img src="Vue/Asset/Image/MontreClient.png" height="100" width="100" alt="Mes annonce">
				</a>
				<a href="index.php?page=5">
					<img src="Vue/Asset/Image/AjouterMontre.png" height="100" width="100" alt="Ajouter une annoce">
				</a>
				<a href="index.php?page=6">
					<img src="Vue/Asset/Image/utilisateur.png" height="100" width="100" alt="Mon Compte">
				</a>
				<a href="index.php?page=8">
					<img src="Vue/Asset/Image/se-deconnecter.png" height="100" width="100" alt="Déconnexion">
				</a>
				</center>';		
		}
		if(isset($_GET['page']))
		{
			$page= $_GET['page'];
		} 
		else 
		{
			$page = 1;
		}
		switch ($page)
		{
			case 1 : require_once ("index.php"); break;
			case 2 : require_once ("Gestion_acceuil.php"); break;
			case 3 : require_once ("Gestion_Annonce.php"); break;
			case 4 : require_once ("Gestion_user_Annonce.php"); break;
			case 5 : require_once ("Gestion_AjoutAnnonce.php"); break;
			case 6 : require_once ("Gestion_MonCompte.php"); break;
			case 7 : require_once ("Gestion_UneAnnonce.php"); break;
			case 8 : session_destroy();

			unset($_SESSION['email']);
			header("Location: index.php?page=1");
			break;
		}
	?>
</body>
</html>