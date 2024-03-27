<?php
	require_once("Model/Model.class.php");
	
	class Controleur
	{
		private $unModele;
		public function __construct()
		{
			$this->unModele= new Modele();
		}

		public function insertuser ($tab)
		{
			require_once("../Model/Model.class.php");
			$this->unModele->insertuser ($tab);
		}
		public function verifConnexion ($email, $mdp)
		{
			return $this->unModele->verifConnexion($email, $mdp);
		}
		public function supprimeruser($email)
		{
			$this->unModele->supprimeruser($email);
		}
		public function supprimercompte($email)
		{
			$this->unModele->supprimercompte($email);
		}
		public function selectAllAnnonce()
		{
			return $this->unModele->selectAllAnnonce();
		}
		public function selectAllMarque()
		{
			return $this->unModele->selectAllMarque();
		}
		public function selectAllRef()
		{
			return $this->unModele->selectAllRef();
		}
		public function insertAnnonce($tab)
		{
			$this->unModele->insertAnnonce($tab);
		}
		public function idsession()
		{
			$this->unModele->idsession();
		}
		public function telechargerPhoto($nomDuChampFichier)
		{
			$this->unModele->telechargerPhoto($nomDuChampFichier);
		}
		public function selectIdAnnonces($iduser)
		{
			$this->unModele->selectIdAnnonces($iduser);
		}

	}
?>