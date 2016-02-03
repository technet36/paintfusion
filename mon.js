//api key : f7b8a452-ec7b-48d0-9681-fcd97a0a4321

$(document).ready(function(){ //quand le document se charge
    var timeCC=[];
    var nameChamp=[];
    var idChamp = [];
    var index;
    var compteur = [];
    var y = [];
    $.getJSON("matches1.json", function (data){
        $.each(data.matches,function(i, match){
            $.each(match.participants,function(i, player){
                index=$.inArray(player.championId,idChamp);
            if ( index != -1 ) {
              //  console.log(nameChamp);
                //  console.log("length "+idChamp.length);
                console.log(compteur);
                compteur[index] = compteur[index]+1;
                timeCC[index] =(compteur[index]-1)*timeCC[index]+player.stats.totalTimeCrowdControlDealt;
                //console.log(compteur[index]+"-1*"+timeCC[index]+"+"+player.stats.totalTimeCrowdControlDealt);
            }
            else {
                idChamp.push(player.championId);
                timeCC.push(player.stats.totalTimeCrowdControlDealt);
                compteur[compteur.length-1] = 1;
                $.getJSON("https://global.api.pvp.net/api/lol/static-data/euw/v1.2/champion/"+player.championId+"?champData=info&api_key=f7b8a452-ec7b-48d0-9681-fcd97a0a4321", function (data){
                    nameChamp.push(data.name);
                    y.push("1");
                    y.push("2");
                    y.push("3");
                });
            }
            });
        });
        console.log(nameChamp);
        console.log(y);
        console.log(nameChamp[2]);
        console.log(y[2]);
        console.log(timeCC);
        $("#table2").append("<p>"+nameChamp+"</p>");
        $("#table1").append("<p>"+timeCC+"</p>");
    });


});