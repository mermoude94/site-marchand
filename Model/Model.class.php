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
					echo "L'utilisateur a été ajouté avec succès.";
				}
			} 
			catch (PDOException $e) 
			{
				// Afficher l'erreur PDO
				echo "Erreur lors de l'insertion dans la base de données : " . $e->getMessage();
			}
		}
		public function signaler($tab)
		{
			try
			{
				$requete_insertion = "INSERT INTO signalement (motif, Id_annonce, idsignaler , idplaignant) VALUES (:motif, :Id_annonce, :idsignaler, :idplaignant)";
				$donnees_insertion = array(":motif" => $tab['description'], ":Id_annonce" => $tab['Id_annonce'], ":idsignaler" => $tab['idsignaler'], ":idplaignant" => $tab['idplaignant']);
				$insertion = $this->unPDO->prepare($requete_insertion);
				$insertion->execute($donnees_insertion);
				echo "Signalement pris en compte."; 
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
            	return $_SESSION['iduser'];
        	}
    	}

		public function supprimeruser($email)
		{
    		try 
    		{
       			$requete = "DELETE FROM user WHERE email = :email";
        		$donnees = array(":email" => $email);
        		$suppression = $this->unPDO->prepare($requete);
       			$suppression->execute($donnees);

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
		public function supprimerannonce($Post)
		{
			try
			{		
				$Id_annonce = $Post;
				$requete = "SELECT p.nom_fichier FROM annonce a JOIN photo p ON a.Id_Photo = p.Id_Photo WHERE a.Id_annonce = :Id_annonce;";
        		$donnees = array(":Id_annonce" => $Id_annonce);
        		$nom_fichier = $this->unPDO->prepare($requete);
				$nom_fichier->execute($donnees);
				$nom_fichier = $nom_fichier->fetch(PDO::FETCH_ASSOC);
				$cheminImage = 'Vue/Asset/Photo/' . $nom_fichier["nom_fichier"];

				if (file_exists($cheminImage)) 
				{
					if (unlink($cheminImage))
					{
						$requete = "DELETE annonce, photo FROM annonce JOIN photo ON annonce.Id_Photo = photo.Id_Photo WHERE annonce.Id_annonce = :Id_annonce AND photo.nom_fichier = :nom_fichier;";
						$donnees = array(":Id_annonce" => $Id_annonce , ":nom_fichier" => $nom_fichier["nom_fichier"]);
						$nom_fichier = $this->unPDO->prepare($requete);
						$nom_fichier->execute($donnees);
						echo 'Annonce suprimé completement avec succer.';
					} 
					else 
					{
						echo 'Erreur lors de la suppression de l\'image.';
					}
				}
					$requete = "DELETE annonce FROM annonce JOIN photo ON annonce.Id_Photo = photo.Id_Photo WHERE annonce.Id_annonce = :Id_annonce";
					$donnees = array(":Id_annonce" => $Id_annonce);
					$nom_fichier = $this->unPDO->prepare($requete);
					$nom_fichier->execute($donnees);
					echo 'Annonce suprimer avec succer.';
			}
			catch (PDOException $e) 
			{
				return false;
			}
		}

		public function supprimercompte($email)
		{
    		if(isset($_SESSION['email'])) 
			{
        		$this->supprimeruser($_SESSION['email']);
        
        		$_SESSION = array();

        		session_destroy();
        
        		header("Location: index.php?page=1");
        		exit();
    		} 
		}
		public function selectAllAnnonce()
		{
			$requete="SELECT DISTINCT annonce.*, 
			marque.nom AS nom_marque, 
			ref.nom AS nom_ref, 
			user.nom AS nom_user, 
			user.prenom AS prenom_user, 
			photo.nom_fichier AS nom_fichier 
			FROM annonce 
			LEFT JOIN marque ON annonce.Id_marque = marque.Id_marque 
			LEFT JOIN ref ON annonce.Id_ref = ref.Id_ref 
			LEFT JOIN user ON annonce.iduser = user.iduser 
			LEFT JOIN photo ON annonce.Id_Photo = photo.Id_Photo 
			WHERE annonce.iduser = user.iduser;";
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
			try {
				$requete = "SELECT annonce.*,
				 marque.nom AS nom_marque, 
				 ref.nom AS nom_ref, 
				 user.nom AS nom_user,
				 user.prenom AS prenom_user,
				 photo.Id_Photo AS Id_Photo FROM annonce 
				 LEFT JOIN marque ON annonce.Id_marque = marque.Id_marque
				  LEFT JOIN ref ON annonce.Id_ref = ref.Id_ref
				   LEFT JOIN user ON annonce.iduser = user.iduser
				    LEFT JOIN photo ON annonce.Id_annonce = photo.Id_Photo 
					WHERE annonce.iduser = :idUtilisateur;";
		
				$select = $this->unPDO->prepare($requete);
				$select->bindParam(":idUtilisateur", $idUtilisateur, PDO::PARAM_INT);
				$select->execute();
		
				if ($select === false) 
				{
					return false;
				}
		
				// Retourner le résultat
				return $select->fetchAll(PDO::FETCH_ASSOC);
			} 
			catch (PDOException $e) 
			{

				return false;
			}
		}
		public function selectUneAnnonce($Post)
		{

			$idAnnonce = $Post['idAnnonce'];


			try 
			{
				$requete = "SELECT annonce.*,
							marque.nom AS nom_marque, 
							ref.nom AS nom_ref, 
							user.nom AS nom_user,
							user.prenom AS prenom_user
							FROM annonce
							LEFT JOIN marque ON annonce.Id_marque = marque.Id_marque
							LEFT JOIN ref ON annonce.Id_ref = ref.Id_ref
							LEFT JOIN user ON annonce.iduser = user.iduser
							WHERE Id_Annonce = :idAnnonce;";
		
				$select = $this->unPDO->prepare($requete);
				$select->bindParam(":idAnnonce", $idAnnonce, PDO::PARAM_INT);
				$select->execute();

				if ($select === false) 
				{
					return false;
				}
				return $select->fetchAll(PDO::FETCH_ASSOC);
			} 
			catch (PDOException $e) 
			{
				return false;
			}
		}


		function telechargerPhoto($nomDuChampFichier) 
		{
			$id_photo = null; 
			$target_dir = "Vue/Asset/Photo/";
			$target_file = $target_dir . basename($_FILES["Photo"]["name"]);
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			
			if ($uploadOk == 0) 
			{
				echo "Désolé, votre fichier n'a pas été téléchargé.";
			} 
			else
			{
				if(move_uploaded_file($_FILES[$nomDuChampFichier]["tmp_name"], $target_file)) 
				{					
					try
					{
						$requete_insertion = "INSERT INTO Photo (nom_fichier) VALUES (:nom_photo);";
						$donnees_insertion = array(":nom_photo" => basename($_FILES[$nomDuChampFichier]["name"]));	
						$insertion = $this->unPDO->prepare($requete_insertion);
						$insertion->execute($donnees_insertion);
						$id_photo = $this->unPDO->lastInsertId();
						return $id_photo;	
					}
					catch (PDOException $e) 
					{
						echo "Erreur lors de l'insertion dans la base de données : " . $e->getMessage();
					}
					
				} 
				else 
				{
					echo "Erreur lors du téléchargement du fichier.";
				}		
			}

		}
		public function insertAnnonce($tab, $id_photo)
		{

			try 
			{
				$verification_ref = "SELECT COUNT(*) FROM ref WHERE Id_ref = :Id_ref AND Id_marque = :Id_marque";
				$donnees_verification = array(":Id_ref" => $tab['Id_ref'],":Id_marque" => $tab['Id_marque']);
				$requete_verification = $this->unPDO->prepare($verification_ref);
				$requete_verification->execute($donnees_verification);
				$resultat_verification = $requete_verification->fetchColumn();
				
				if($resultat_verification == 0)
					{
						echo "Le modele ne correspond pas à la marque spécifiée.";
						return; // Arrêter l'exécution de la fonction
					}

				$requete_insertion = "INSERT INTO annonce (iduser, Id_marque, Id_ref, Prix, description ,Id_Photo) VALUES (:iduser, :Id_marque, :Id_ref, :Prix, :description, :Id_Photo);";
				$donnees_insertion = array(
				":iduser" => $tab['iduser'],
				":Id_marque" => $tab['Id_marque'],
				":Id_ref" => $tab['Id_ref'],
				":Prix" => $tab['Prix'],
				":Id_Photo" => $id_photo,
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