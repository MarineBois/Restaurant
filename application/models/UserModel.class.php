<?php

class UserModel {

	private function HashPassword ($Password) {
        $salt = '$2y$11$'.substr(bin2hex(openssl_random_pseudo_bytes(32, $cstrong)),0 , 22);
        return crypt($Password,$salt);
	}

	public function SaveUser($lastName, $firstName, $BirthDate, $Address, $City, $PostalCode, $tel, $Mail, $Password) {


		// instancier la classe Database du FW
		$Database = new Database();

		//Requete de vérification si mail déjà enregistré (petite requete donc on la passe directement dans la fonction):
		$ControlMail = $Database->queryOne("SELECT Email FROM User WHERE Email = ?",[$Mail]);

		//si mail déjà enregistré :
		if (!empty($ControlMail)) {
			//message erreur
			throw new Exception("Il existe déjà un compte utilisateur avec cette adresse e-mail");
			
		// sinon enregistrement de l'user	
		}else {
			// hashage du Mot de passe :
			$PasswordHash = $this->HashPassword($Password);
			// créer la requete sous forme de string
			$Requete = "INSERT INTO User (LastName, FirstName, BirthDate,  Address, City, ZipCode, Phone, Email, Password) VALUES (?,?,?,?,?,?,?,?,?)" ;

			//Récupération de tous les produits alimentaires.
			$Database->executeSql($Requete,[
				$lastName,
				$firstName,
				$BirthDate,
				$Address,
				$City,
				$PostalCode,
				$tel,
				$Mail,
				$PasswordHash
			]);
		}
	}

	public function findWithEmailPassword($email, $password) {


        // Récupération de l'utilisateur ayant l'email spécifié en argument.
		$Database = new Database();
		$user = $Database->queryOne("SELECT * FROM User WHERE Email = ?",[$email]);

        // Est-ce qu'on a bien trouvé un utilisateur ?
        if (empty($user)) {
        	throw new Exception('Il n\'y a pas de compte utilisateur associé à cette adresse email ');
        }

        if($this->verifyPassword($password, $user['Password']) == false) {
        	throw new Exception('Le mot de passe spécifié est incorrect');
        	
        }

		return $user;

    }

    private function verifyPassword($password, $hashedPassword) {
        // Si le mot de passe en clair est le même que la version hachée alors renvoie true.
        return crypt($password, $hashedPassword) == $hashedPassword;
    }
}