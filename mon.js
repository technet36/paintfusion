//api key : f7b8a452-ec7b-48d0-9681-fcd97a0a4321

$(document).ready(function(){ //quand le document se charge

    var Champ = [];
    var idChamp = [];
    var id ;
    var compteur = 0;
    $.getJSON("matches1.json", function (data){
        $.each(data.matches,function(i, match){
             $.each(match.participants,function(i, player){
            id = player.championId;
               if ($.inArray(id,idChamp) == (-1) ){
                   idChamp.push(id);
                   Champ[compteur] = {id : id, timeCC : player.stats.totalTimeCrowdControlDealt, name : "Unknown",count:1};
                   compteur ++;
                }
            else   {
                   Champ[$.inArray(id,idChamp)].timeCC =((Champ[$.inArray(id,idChamp)].count)*Champ[$.inArray(id,idChamp)].timeCC+player.stats.totalTimeCrowdControlDealt)/((Champ[$.inArray(id,idChamp)].count)+1);
                   Champ[$.inArray(id,idChamp)].count ++;
               }
             });
        });
        getName(Champ);
    });

});

function getName( tabTotal )
{
    var test;
    //console.log(champId);
    $.each(tabTotal,function(i,champ){
        test = $.getJSON("https://global.api.pvp.net/api/lol/static-data/euw/v1.2/champion/"+champ.id+"?champData=info&api_key=f7b8a452-ec7b-48d0-9681-fcd97a0a4321", function (data){
                tabTotal[i].name = data.name;
                $("#table0").append("<p>"+tabTotal[i].id+"</p>");
                $("#table1").append("<p>"+tabTotal[i].name+"</p>");
                $("#table2").append("<p>"+tabTotal[i].timeCC+"</p>");
                i++;
            })
            .done(function() {
                console.log("succes getName");
            })
            .fail(function() {
                console.log( "error getName" );
            })
    });

//console.log(Champ.name);
    return tabTotal;
};
function printChamp (tabChamp){
    for (var i = 0 ; i<tabChamp.length ; i++){
    }
}