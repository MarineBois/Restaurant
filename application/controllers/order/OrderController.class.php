<?php

class OrderController {
	public function httpGetMethod(Http $http, array $queryFields)
    {
    	/*
    	 * Méthode appelée en cas de requête HTTP GET
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $queryFields contient l'équivalent de $_GET en PHP natif.
    	 */
        $this->Redirection($http);

        $meals = new MealModel();
        $AllMeals = $meals->listAll();

        return [
            'meals' => $AllMeals,
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
        $this->Redirection($http);



    }	

    public function Redirection (Http $http)  {
    // on réouvre la session
        $log = new UserSession;
        if (!$log->isAuthenticated()) {
            $http->redirectTo('/');
        }
    }    
        
}