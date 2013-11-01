/**
 * Created with JetBrains PhpStorm.
 * User: Anis
 * Date: 26/10/13
 * Time: 00:26
 * To change this template use File | Settings | File Templates.
 */

function deleteUser(url , sender_)
{
    new Anis('Voulez-vous vraiment supprimer', {
            title: 'Supprimer',
            buttons: [	{id: 0, label: 'Oui', val: 'Y'},
                {id: 1, label: 'Non', val: 'N'}
            ],
            callback: function(val) {
                switch (val){
                    case 'Y' :
                        $.ajax({
                                type: "POST",
                                url: url,
                                data: { _method : "DELETE"}
                            }
                        )
                            .done(function(msg){
                                var vsender = $(sender_).parent().parent().parent().parent().parent().parent();
                                vsender.next().remove();
                                vsender.remove();
                            })
                            .fail(function() { alert('erreur'); })
                        ;
                        break;
                    case 'N' :break;
                }
            }
        }
    );
}

function search(url, metaField, options){

    options = jQuery.extend({}, search.prototype.options, options || {});

    var values = {} ;
    var target = $($(".entity:first")[0]);
    var delim = $(target).next();
    var footer = $('.entitiesfooter');

    $(".search").each(function(index, field){
        if(field.value){
            values[metaField[index]] = field.value.trim();
            console.log(metaField[index] + " " + field.value.trim());
        }
    });


    $.ajax(url,
        {
            type: "POST",
            data : values,
            success : function(resp){
                console.log(resp);

                //var data = JSON.parse(resp);
                var data =  resp; // le retour est de type JSON
                $(".entity").next().remove();
                $(".entity").remove();

                data.forEach(function(client, i){


                    var show_ = target.find(".art-button.show")[0];
                    var edit_ = target.find(".art-button.edit")[0];
                    var delete_ = target.find(".art-button.delete")[0];

                    var t;

                    metaField.forEach(function(value, index){
                        t=  target.find("."+value)[0];

                        if(value == "path")
                        {
                            t.innerHTML = "<img src='"+options.path+"' />";
                            if(client[value] != "path")
                                t.innerHTML = "<img width='50px' height='50px' src='../../../" + client[value] + "' />";
                        }else if(client[value] ){
                            t.innerHTML = client[value];
                        }
                    });


                    show_.href = client["showURL"];
                    edit_.href = client["editURL"];
                    delete_.href = client["deleteURL"];


                    target.clone().insertBefore(footer);
                    delim.clone().insertBefore(footer);
                });
            }
        });
}
search.prototype = {

    options: {
        path : ""
    }
}