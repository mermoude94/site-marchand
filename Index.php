<?php
	session_start();
	require_once("Controleur/Controleur.class.php");
	$unControleur= new Controleur; 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Les Bon PLans</title>
	<meta charset="utf-8">
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
				<h1>Les bon plans</h1>
				<a href="index.php?page=1">
					<img src="image/home.png" height="100" width="100" alt="Page d accueil">
				</a>
				<a href="index.php?page=2">
					<img src="image/client.png" height="100" width="100" alt="Annonce">
				</a>
				<a href="index.php?page=3">
					<img src="image/produit.png" height="100" width="100" alt="Mes annonce">
				</a>
				<a href="index.php?page=4">
					<img src="image/technicien.png" height="100" width="100" alt="Ajouter une annoce">
				</a>
				<a href="index.php?page=5">
					<img src="image/intervention.png" height="100" width="100" alt="Mon Compte">
				</a>
				<a href="index.php?page=6">
					<img src="image/deconnexion.png" height="100" width="100" alt="Déconnexion">
				</a>
				</center>';
				
		}
		if(isset($_GET['page']))
		{
			$page= $_GET['page'];
		} 
		else 
		{
			$page = 1; //Page par défaut= index.php
		}
		switch ($page)
		{
			case 1 : require_once ("index.php"); break;
			case 2 : require_once ("Gestion_Annonce.php"); break;
			case 3 : require_once ("Gestion_user_Annonce.php"); break;
			case 4 : require_once ("Gestion_AjoutAnnonce.php"); break;
			case 5 : require_once ("Gestion_MonCompte.php"); break;
			case 6 : require_once ("Gestion_UneAnnonce.php"); break;
			case 7 : session_destroy();
			unset($_SESSION['email']);
			header("Location: index.php?page=1");
			break;
		}	
	?>
</body>
</html>