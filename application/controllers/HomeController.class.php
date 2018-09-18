<?php

class HomeController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
    	/*
    	 * Méthode appelée en cas de requête HTTP GET
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $queryFields contient l'équivalent de $_GET en PHP natif.
    	 */


        //récupération de tous les produits alimentaires.
        $mealModel = new MealModel();
        // Les controller passent les données à nos vus via des "return" en tableau associatifs
        $meals = $mealModel->listAll();
        // dans ce cas precis, mon controller retourne du contenu référencé par une clé "meals" et qui contient le retour de la métode listAll
        return [
            'meals' => $meals,
        ]; 
    }

    public function httpPostMethod(Http $http, array $formFields)
    {
    	/*
    	 * Méthode appelée en cas de requête HTTP POST
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $formFields contient l'équivalent de $_POST en PHP natif.
    	 */
        $log = new UserSession;

        if (isset($_SESSION['message']['Booking'])) {
            $BookingMessage = $_SESSION['message']['Booking'];
            return $BookingMessage ;
        }
    }
}