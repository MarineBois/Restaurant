<?php

class MealController {
	public function httpGetMethod(Http $http, array $queryFields)
    {

    	//récupération de tous les produits alimentaires.
        $mealModel = new MealModel();
        // Les controller passent les données à nos vus via des "return" en tableau associatifs
        $meal = $mealModel->find($queryFields['id']);
        // dans ce cas precis, mon controller retourne du contenu référencé par une clé "meals" et qui contient le retour de la métode listAll

        $json = json_encode($meal);
        echo($json); exit;
    }
}    