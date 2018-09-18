<?php

class MealModel {
	public function listAll() {
		// instancier la classe Database du FW
		$Database = new Database();
		// créer la requete sous forme de string
		$Requete = "SELECT * FROM Meal";
		//Récupération de tous les produits alimentaires.
		return $Database->query($Requete);
		
	}

	public function find($id) {
		$Database = new Database();
		// créer la requete sous forme de string
		$Requete = "SELECT * FROM Meal WHERE Id=?";
		//Récupération de tous les produits alimentaires.
		return $Database->queryOne($Requete,[$id]);

	}
}