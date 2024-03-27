<?php
	class Modele 
	{
		private $unPDO;
		public function __construct()
		{
			try 
			{
				$url="mysql:host=localhost;dbname=e5";
				$user="root";
				$mdp="";
				$this->unPDO= new PDO ($url, $user, $mdp );
			}
			catch(PDOException $exp)
			{
				echo "Erreur de connexion: ".$exp->getMessage();
			}
		}
		public function insertuser($tab)
		{
			try 
			{
				// Vérifier si l'email existe déjà
				$requete_verification = "SELECT COUNT(*) FROM user WHERE email = :email";
				$donnees_verification = array(":email" => $tab['email']);
				$verification = $this->unPDO->prepare($requete_verification);
				$verification->execute($donnees_verification);
				$count = $verification->fetchColumn();
		
				if ($count > 0) 
				{
					// L'email existe déjà, afficher un message d'erreur
					echo "Erreur : L'email est déjà associé a un compte.";
				} 
				else 
				{
					// L'email n'existe pas encore, procéder à l'insertion
					$requete_insertion = "INSERT INTO user (nom, prenom, email, adresse, mdp) VALUES (:nom, :prenom, :email, :adresse, :mdp)";
					$donnees_insertion = array(
						":nom" => $tab['nom'],
						":prenom" => $tab['prenom'],
						":adresse" => $tab['adresse'],
						":email" => $tab['email'],
						":mdp" => $tab['mdp']
					);
			
					$insertion = $this->unPDO->prepare($requete_insertion);
					$insertion->execute($donnees_insertion);
			
					// Confirmer l'insertion
					echo "L'utilisateur a été ajouté avec succès.";
				}
			} 
			catch (PDOException $e) 
			{
				// Afficher l'erreur PDO
				echo "Erreur lors de l'insertion dans la base de données : " . $e->getMessage();
			}
		}

		public function verifConnexion($email, $mdp)
		{
			$requete="select * from user where email=:email and mdp=:mdp ";
			$donnees=array(":email"=>$email, ":mdp"=>$mdp);
			$select=$this->unPDO->prepare($requete);
			$select->execute($donnees);
			return $select->fetch();
		}

		public function idsession()
    	{

        if(isset($_SESSION['iduser'])) 
			{
            	// Retournez l'ID de l'utilisateur
            	return $_SESSION['iduser'];
        	}
    	}

		public function supprimeruser($email)
		{
    		try 
    		{
        		// Préparer la requête de suppression
       			$requete = "DELETE FROM user WHERE email = :email";
        		$donnees = array(":email" => $email);
        
        		// Exécuter la requête de suppression
        		$suppression = $this->unPDO->prepare($requete);
       			$suppression->execute($donnees);
        
        		// Vérifier si des lignes ont été affectées (c'est-à-dire si un utilisateur a été supprimé)
        		if ($suppression->rowCount() > 0) 
				{
            		echo "Utilisateur supprimé avec succès de la base de données.";
        		} 
				else 
				{
            		echo "Aucun utilisateur trouvé avec cet email.";
        		}
    		} 
    		catch (PDOException $e) 
    		{
        		echo "Erreur lors de la suppression de l'utilisateur : " . $e->getMessage();
    		}
		}

		public function supprimercompte($email)
		{
    		// Assurez-vous que l'utilisateur est connecté en vérifiant s'il existe dans la session
    		if(isset($_SESSION['email'])) 
			{
        		// Supprimer l'utilisateur de la base de données
        		$this->supprimeruser($_SESSION['email']);
        
        		// Détruire toutes les variables de session
        		$_SESSION = array();

        		// Finalement, détruire la session
        		session_destroy();
        
        		// Rediriger l'utilisateur vers une page de déconnexion ou une autre page par exemple
        		header("Location: index.php?page=1");
        		exit(); // Assurez-vous de terminer le script après la redirection
    		} 
		}
		public function selectAllAnnonce()
		{
			$requete="SELECT annonce.*, 
			marque.nom AS nom_marque, 
			ref.nom AS nom_ref, 
			user.nom AS nom_user,
			user.prenom AS prenom_user
	 		FROM annonce
	 		LEFT JOIN marque ON annonce.Id_marque = marque.Id_marque
	 		LEFT JOIN ref ON annonce.Id_ref = ref.Id_ref
	 		LEFT JOIN user ON annonce.iduser = user.iduser;
			";
			$select=$this->unPDO->prepare($requete);
			$select->execute();
			return $select->fetchAll();
		}

		public function selectAllMarque()
		{
			$requete="SELECT * FROM marque;";
			$select=$this->unPDO->prepare($requete);
			$select->execute();
			return $select->fetchAll();
		}
		public function selectAllRef()
		{
			$requete="SELECT * FROM ref;";
			$select=$this->unPDO->prepare($requete);
			$select->execute();
			return $select->fetchAll();
		}
		
		public function selectIdAnnonces($idUtilisateur)
{
    // Requête pour sélectionner les annonces de l'utilisateur spécifié par son ID
    $requete = "SELECT annonce.*, 
                marque.nom AS nom_marque, 
                ref.nom AS nom_ref, 
                user.nom AS nom_user,
                user.prenom AS prenom_user
                FROM annonce
                LEFT JOIN marque ON annonce.Id_marque = marque.Id_marque
                LEFT JOIN ref ON annonce.Id_ref = ref.Id_ref
                LEFT JOIN user ON annonce.iduser = user.iduser
                WHERE annonce.iduser = :idUtilisateur;";

    // Préparer et exécuter la requête
    $select = $this->unPDO->prepare($requete);
    $select->bindParam(":idUtilisateur", $idUtilisateur, PDO::PARAM_INT);
    $select->execute();

    // Retourner le résultat
    return $select->fetchAll();
}



		function telechargerPhoto($nomDuChampFichier) 
		{
			$target_dir = "Photo/"; // Répertoire où vous souhaitez enregistrer les fichiers
			$target_file = $target_dir . basename($_FILES["Photo"]["name"]); // Chemin complet du fichier téléchargé
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); // Extension du fichier
			
			if ($uploadOk == 0) 
			{
				echo "Désolé, votre fichier n'a pas été téléchargé.";
			// Si tout est correct, essayez de télécharger le fichier
			} 
			else 
			{
				if (move_uploaded_file($_FILES["Photo"]["tmp_name"], $target_file)) 
				{
					echo "Le fichier ". htmlspecialchars( basename( $_FILES["Photo"]["name"])). " a été téléchargé.";
				} 
				else 
				{
					echo "Désolé, une erreur s'est produite lors du téléchargement de votre fichier.";
				}
			}
		}
		

		public function insertAnnonce($tab)
		{

			try 
			{
				// Vérifier que la référence correspond à la marque
				$verification_ref = "SELECT COUNT(*) FROM ref WHERE Id_ref = :Id_ref AND Id_marque = :Id_marque";
				$donnees_verification = array(
					":Id_ref" => $tab['Id_ref'],
					":Id_marque" => $tab['Id_marque']
				);
				
				$requete_verification = $this->unPDO->prepare($verification_ref);
				$requete_verification->execute($donnees_verification);
				$resultat_verification = $requete_verification->fetchColumn();
				
				if($resultat_verification == 0)
				{
					echo "Le modele ne correspond pas à la marque spécifiée.";
					return; // Arrêter l'exécution de la fonction
				}

				$requete_insertion = "INSERT INTO annonce (iduser, Id_marque, Id_ref, Prix, description) VALUES (:iduser, :Id_marque, :Id_ref, :Prix, :description);
				";
				$donnees_insertion = array(
				":iduser" => $tab['iduser'],
				":Id_marque" => $tab['Id_marque'],
				":Id_ref" => $tab['Id_ref'],
				":Prix" => $tab['Prix'],
				":description" => $tab['description']
				);
			
				$insertion = $this->unPDO->prepare($requete_insertion);
				$insertion->execute($donnees_insertion);
			
					// Confirmer l'insertion
				echo "Annonce Publier avec succée.";
			} 
			catch (PDOException $e) 
			{
				// Afficher l'erreur PDO
				echo "Erreur lors de l'insertion dans la base de données : " . $e->getMessage();
			}
		}

}
?>