
var OrderForm = function() {
  
    // instance de la classe BasketSession dans une prop
    this.basketSession = new BasketSession();
};

// STEP 1 : quand on change le select
OrderForm.prototype.onChangeMeal = function() {
  
    // Récupération de l'id de l'aliment sélectionné dans la liste déroulante.
    $mealId = $("select option:selected").attr('value');
    console.log('onChangeMeal', $mealId);

    /*
     * Exécution d'une requête HTTP GET AJAJ (Asynchronous JavaScript And JSON) : index.php/meal?id=***ID_DU_PLAT***
     * pour récupérer les informations de l'aliment sélectionné dans la liste déroulante.
     */
    $.getJSON(
            // URL vers un contrôleur PHP
        getRequestUrl() + "/meal?id="+$mealId,
        function(data){
        console.log(data);
            // Construction de l'URL absolue vers la photo du produit alimentaire.
            $('#meal-details img').attr('src',getWwwUrl()+"/images/meals/"+data['Photo']);
            // Mise à jour de l'affichage en jQuery : .text() / .attr()
            $('#meal-details p').text(data['Description']);
            // Enregistrement du prix dans un champ de formulaire caché.
            $('#meal-details span strong').text(formatMoneyAmount(data['SalePrice']));

        }
    );
};

OrderForm.prototype.run = function() {
  
    /* Installation d'un gestionnaire d'évènement sur la sélection d'un aliment
     * dans la liste déroulante des aliments. */
    $("#meals").on('change', this.onChangeMeal.bind(this));
};
