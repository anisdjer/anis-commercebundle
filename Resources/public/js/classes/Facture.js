/**
 * Created with JetBrains PhpStorm.
 * User: Anis
 * Date: 06/11/13
 * Time: 18:05
 * To change this template use File | Settings | File Templates.
 */



function InvalidTypeException(msg) {
    this.name = "InvalidTypeError";
    this.getMessage = function(){
        return msg;
    }
}


function Facture(client, dateFacturation,datePaiement, methodPaiement, total, paid){

    this.dateFacturation = dateFacturation || '';
    this.datePaiement = datePaiement || '';
    this.methodPaiement= methodPaiement || '';
    this.total = total || 0;
    this.paid = paid || false;
    this.client = client || null;
    this.lines = new Array();

    this.initialize = function(){

    }
    this.addLine = function(line){

        if(line instanceof LigneFacture)
        {
            var exisit = false;
            var i = 0;
            console.log(line);
            while( i < this.lines.length && !exisit )
            {
                console.log(this.lines[i]);
                if(this.lines[i].product === line.product)
                    exisit = true;
                i++;
            }


            if(exisit)
            {
                i--;
                this.lines[i].quantite += line.quantite;
            }
            else
                this.lines.push(line);
        }
        else throw new InvalidTypeException("Parametre doit etre de type LigneFacture");
    }
    this.serialize = function(){

        return {
            "dateFacturation" : this.dateFacturation,
            "datePaiement" :this.datePaiement,
            "methodPaiement" : this.methodPaiement ,
            "total" : this.total ,
            "paid" : this.paid ,
            "client" : this.client ,
            "lines": this.lines.map(function(line){
                return line.serialize();
            })
        };


    }
}
