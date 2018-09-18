<?php 
class LogoutController {
	public function httpGetMethod(Http $http, array $queryFields)
    {
		$log = new UserSession;
		$log->destroy();
		//message de déconnextion :
		$flash = new FlashBag();
		$flash->add("Vous êtes bien déconnecté");

		// Redirection vers la page d'accueil.
		$http->redirectTo('/');
	}
}		
