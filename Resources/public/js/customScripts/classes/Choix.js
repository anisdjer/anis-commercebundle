/**
 * Created with JetBrains PhpStorm.
 * User: Anonyme
 * Date: 24/02/13
 * Time: 23:29
 * To change this template use File | Settings | File Templates.
 */


function Choix ( valeur ,  QuestionParent){

    this.valeur = valeur;
	
	//this.type = type;

    this.questionParent = QuestionParent;

    this.questionAttache = null;

    this.serialize = function(){
        return {"valeur" : this.valeur,"attache" : (this.questionAttache== null)? {}:this.questionAttache.serialize()};
    };

};
