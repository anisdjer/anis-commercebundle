/**
 * Created with JetBrains PhpStorm.
 * User: Anis
 * Date: 06/11/13
 * Time: 18:15
 * To change this template use File | Settings | File Templates.
 */


function LigneFacture(product, unityPrice, quantite, discount){

    this.product = product;
    this.unityPrice = unityPrice;
    this.discount = discount;
    this.quantite = quantite;


    this.serialize = function(){
        return {
            "product" : this.product,
            "unityPrice" : this.unityPrice,
            "discount" : this.discount,
            "quantity" : this.quantite
        }
    };


}