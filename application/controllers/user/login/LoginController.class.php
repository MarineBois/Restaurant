<?php

class LoginController {
	public function httpGetMethod(Http $http, array $queryFields)
    {
    	/*
    	 * Méthode appelée en cas de requête HTTP GET
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $queryFields contient l'équivalent de $_GET en PHP natif.
    	 */


    }

    public function httpPostMethod(Http $http, array $formFields)
    {
    	/*
    	 * Méthode appelée en cas de requête HTTP POST
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $formFields contient l'équivalent de $_POST en PHP natif.
    	 */
        try {
        	// 1) Récupération de l'utilisateur en fonction de ses identifiants.
            // instancier le UserModel
            $Connexion = new UserModel();
            // utiliser la methode findWithEmailPassword pour recup l'utilistateur
            $user = $Connexion->findWithEmailPassword($formFields['Mail'], $formFields['Password']);

            // 2) Construction de la session utilisateur.
            // instancier la UserSession
            $Session = new UserSession();
            // utiliser la methode create pour remplire la session
            $Session->create($user['Id'], $user['FirstName'], $user['LastName'], $user['Email']);

            //message de confirmation :
            $flash = new FlashBag();
            $flash->add("Vous etes connecté");            
            // Redirection vers la page d'accueil.
            $http->redirectTo('/');

        } catch (Exception $e) {
            $error = $e->getMessage();
            return [
                'error' => $error
            ];   
        } 

            
    }	
}