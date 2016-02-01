//api key : f7b8a452-ec7b-48d0-9681-fcd97a0a4321

$(document).ready(function(){ //quand le document se charge

    var timeCC=[], nameChamp=[];
    $.getJSON("matches1.json", function (data){
        $.each(data.matches,function(i, match){
            $.each(match.participants,function(i, player){
                $.getJSON("https://global.api.pvp.net/api/lol/static-data/euw/v1.2/champion/"+player.championId+"?champData=info&api_key=f7b8a452-ec7b-48d0-9681-fcd97a0a4321", function (data){
                    nameChamp.push(data.name);
                    $("#table1").append("<p>"+nameChamp+"</p>");
                });
                timeCC.push(player.stats.totalTimeCrowdControlDealt);

                $("#table2").append("<p>"+timeCC+"</p>");
            });
        });


    });
    document.getElementById("table2").innerHTML = nameChamp;
    document.getElementById("table1").innerHTML = timeCC;

});


