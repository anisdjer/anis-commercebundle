/**
 * Created with JetBrains PhpStorm.
 * User: Anis
 * Date: 19/05/13
 * Time: 21:42
 * To change this template use File | Settings | File Templates.
 */

function affecterEnqueteEquiupes()
{
    dateDebut = $("#pfe_v3_mobsurveybundle_enquetetype_dateDebut").val();
    dateFin =   $("#pfe_v3_mobsurveybundle_enquetetype_dateFin").val();

    $("<div id='obscure' style='position: absolute;z-index: 100;width: 100%;height: 100%;background-color: #a9a9a9;opacity: 0.8;'></div> ").prependTo("body");
    new Anis("<img src='../../../../bundles/ms/images/loading_new.gif' style='margin-left: 40%;margin-top: 20%'/> ",
        {
            title: "Affecter les equipes a l'enquete",
            width: '900px',
            height : '500px',
            top : '20px',
            buttons: [	{id: 0, label: 'Oui', val: 'Y'},
                {id: 1, label: 'Non', val: 'N'}
            ],
            callback: function(val) {
                console.log(val);
                $("#obscure").remove();

            }
        });


    $(".anis").draggable();
    $(".anis-content").load(
        './equipes/'+dateDebut+'/'+dateFin+'#equipe_content', function(html_) {

        }
    );

}
