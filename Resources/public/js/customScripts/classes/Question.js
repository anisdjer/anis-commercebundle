/**
 * Created with JetBrains PhpStorm.
 * User: Anis
 * Date: 24/02/13
 * Time: 23:21
 * To change this template use File | Settings | File Templates.
 */
/*
Definition des Exceptions
 */
function InvalidTypeException(msg) {
    this.name = "InvalidTypeError";
    this.getMessage = function(){
        return msg;
    }
}


function Question (id,titre, type, obligatoire ){


    // ajouter un id pour aider a identifier les questions
    this.id = id;
    this.titre = titre;
	this.type = type;
	this.obligatoire = obligatoire;

    this.suivant = null;

    this.questionsAvant = 0;

    this.choix = new Array();

    this.ajouterChoix = function(choix){

        if(choix instanceof Choix)
        {
            this.choix.reverse();
            this.choix.push(choix);
            this.choix.reverse();
        }
        else throw new InvalidTypeException("Parametre doit etre de type choix");
    };
    this.serialize = function(){
//        return {"id" : this.id, "texte":this.titre, "suivant":((this.suivant==null)?{}:this.suivant.serialize())};

        return {"id" : this.id, "texte":this.titre,"obligatoire" : this.obligatoire ,"type" : this.type, "suivant":((this.suivant==null)?{}:this.suivant.serialize()),"choix" :this.choix.map(function(choi){
            return choi.serialize();
        })};
    };

};


//function Question1 (){
//
//    Question.call(this);
//};