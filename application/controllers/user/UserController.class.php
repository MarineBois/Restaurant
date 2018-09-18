<?php

class UserController
{
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

            $NewUser = new UserModel();

            $user = $NewUser->SaveUser(
                $formFields['LastName'],
                $formFields['FirstName'],
                $formFields['BirthDate'],
                $formFields['address'],
                $formFields['city'],
                $formFields['PostalCode'],
                $formFields['tel'],
                $formFields['Mail'],
                $formFields['Password']
            );
            $http->redirectTo('/');
            //message de confirmation :
            $flash = new FlashBag();
            $flash->add("Vous etes bien inscrit");            
        } catch (Exeption $e) {
            $error = $e->getMessage();
            return [
                'error' => $error,
            ];   
        } 
    }
}