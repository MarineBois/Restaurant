<?php

class BookingModel {
	public function SaveBooking($BookingDate, $BookingTime, $NumberOfSeats) {

		// vérification que l'user à bien compléter toutes les infos :
	    if (empty($BookingDate) || empty($BookingTime) || empty($NumberOfSeats))  {
	    	throw new Exception("Merci de compléter toutes les informations");
	    }	  
	        
        // on réouvre la session
        $log = new UserSession;

        // on récupère l ID de l'user avec la méthode GET
        $UserId = $log->getUserId();
        if (empty($UserId)) {
        	throw new Exception("Vous devez être connecté pour réserver");
        	
        }
        // on créer la date du jour :
        $CreationTimestamp = date("Y-m-d H:i:s");

		// instancier la classe Database du FW
		$Database = new Database();
		// créer la requete sous forme de string
		$Requete = "INSERT INTO Booking (BookingDate, BookingTime,  NumberOfSeats, User_iD, CreationTimestamp) VALUES (?,?,?,?,?)" ;

		//Récupération de tous les produits alimentaires.
		$Database->executeSql($Requete,[
			$BookingDate,
			$BookingTime,
			$NumberOfSeats,
			$UserId,
			$CreationTimestamp
		]);

		$_SESSION['message']['Booking'] = "Votre réservation a bien été enregistrée";
			
	}
}