<?php


class UserSession {
    
	public function __construct() {
		//fonction native de PHP a écrire obligatoirement avant chaque session_start()
  		if(session_status() == PHP_SESSION_NONE) {
          // Démarrage du module PHP de gestion des sessions.
    			session_start();
  		}
	}

    public function create($userId, $firstName, $lastName, $email) {
        // Construction de la session utilisateur.
        $_SESSION['user'] = [
        	'UserId' => $userId,
        	'FirstName' => $firstName,
        	'LastName' => $lastName,
        	'Email' => $email
        ];
    }

    public function isAuthenticated() {
    	if(array_key_exists('user', $_SESSION) && !empty($_SESSION['user'])) {
        // return true, si l'user est log
        	return true;
        } else {	
        // return false, si il ne l'est pas
        	return false;

    	}	
    }

    public function destroy() {
        // Destruction de l'ensemble de la session.
        $_SESSION= [];
    	session_destroy();
    }

    public function getEmail() {
        if($this->isAuthenticated() == false) {
            return null;
        }
        return $_SESSION['user']['Email'];
    }

    public function getFirstName() {
        if($this->isAuthenticated() == false) {
            return null;
        }
        return $_SESSION['user']['FirstName'];
    }

    public function getFullName() {
        if($this->isAuthenticated() == false) {
            return null;
        }
        return $_SESSION['user']['FirstName'].' '.$_SESSION['user']['LastName'];
    }

    public function getLastName() {
        if($this->isAuthenticated() == false) { 
            return null; 
        }

        return $_SESSION['user']['LastName'];
    }

    public function getUserId() {
        if($this->isAuthenticated() == false) { 
            return null; 
        }

        return $_SESSION['user']['UserId'];
    }

}
