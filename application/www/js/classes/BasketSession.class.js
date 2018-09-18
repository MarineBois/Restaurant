'use strict';

// Classe de gestion de Panier AJAX
var BasketSession = function() {
    // Contenu du panier.
    this.items = null;
              /*[
                  {
                      "mealId":1,
                      "name":"Coca-Cola",
                      "quantity":21,
                      "salePrice":3
                  },
                  {
                      "mealId":3,
                      "name":"Bacon Cheeseburger",
                      "quantity":2,
                      "salePrice":12.5
                  }
                ] */

    this.load();
};

BasketSession.prototype.load = function()
{
    // Chargement du panier depuis le DOM storage.
    this.items = loadDataFromDomStorage('panier');

    if(this.items == null)
    {
        this.items = new Array();
    }
};

BasketSession.prototype.save = function()
{
    // Enregistrement du panier dans le DOM storage.
    saveDataToDomStorage('panier', this.items);
};

BasketSession.prototype.clear = function()
{
    // Destruction du panier dans le DOM storage.
    saveDataToDomStorage('panier', null);
};

BasketSession.prototype.isEmpty = function()
{
    return this.items.length == 0;
};

BasketSession.prototype.remove = function(mealId){
    // Recherche de l'aliment spécifié.
    for(var index = 0; index < this.items.length; index++){
        if(this.items[index].mealId == mealId){
            // L'aliment spécifié a été trouvé, suppression.
            this.items.splice(index, 1);
            this.save();
            return true;
        }
    }

    return false;
};

BasketSession.prototype.add = function(mealId, name, quantity, salePrice){

    // Conversion explicite des valeurs spécifiées en nombres.
    mealId    = parseInt(mealId);
    quantity  = parseInt(quantity);
    salePrice = parseFloat(salePrice);
    
/*  [
      {
          "mealId":1,
          "name":"Coca-Cola",
          "quantity":21,
          "salePrice":3
      },
      {
          "mealId":3,
          "name":"Bacon Cheeseburger",
          "quantity":2,
          "salePrice":12.5
      }
    ]   */

    // MODE 1 : Recherche de l'aliment spécifié.
    for(var index = 0; index < this.items.length; index++){
        if(this.items[index].mealId == mealId){
            // L'aliment spécifié a été trouvé, mise à jour de la quantité commandée.
            this.items[index].quantity += quantity;
            this.save();
            return;
        }
    }



    // MODE 2 : L'aliment spécifié n'a pas été trouvé, ajout au panier.
    this.items.push(
        /*{
            mealId    : mealId,
            name      : name,
            quantity  : quantity,
            salePrice : salePrice
        }*/
        {
            mealId,
            name,
            quantity,
            salePrice
        }
    );
    this.save();
};