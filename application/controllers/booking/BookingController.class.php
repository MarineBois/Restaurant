<?php

class BookingController {
	public function httpGetMethod(Http $http, array $queryFields)
    {
    	/*
    	 * Méthode appelée en cas de requête HTTP GET
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $queryFields contient l'équivalent de $_GET en PHP natif.
    	 */
        $this->Redirection($http);

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
            $this->Redirection($http);

            // on créér le nouvel objet order
            $order = new BookingModel();

            $order->SaveBooking(
                $formFields['BookingDate'], 
                $formFields['BookingTime'], 
                $formFields['NumberOfSeats']
                );

            //message de confirmation :
            $flash = new FlashBag();
            $flash->add("Votre commande a bien été enregistrée");            
            // Redirection vers la page d'accueil.
            $http->redirectTo('/');
        } catch (Exception $e) {
            $error = $e->getMessage();
            return [
                'error' => $error,
            ];   
        } 

    }

    public function Redirection (Http $http)  {
        // on réouvre la session
        $log = new UserSession;
        if (!$log->isAuthenticated()) {
            $http->redirectTo('/');
        }
        
    }
}