$(function() {
    $( "#tabs" ).tabs();
});
var loginTot;
function checkName (server, name){
    $.getJSON("./utils/api.php?action=getName&server="+server+"&name="+name,function (data){

        if (!data.status){
            $("#check").css("background-color", "#6adf5e");
            $("#check").css("border", "#177d14 solid 1px");
            $("#check").html("Valid");
            console.log(data);
            loginTot = data;
            return 1;
        }
        else {
            $("#check").css("background-color", "#DF231A");
            $("#check").css("border", "#7d1e1a solid 1px");
            $("#check").html("Invalid");
            console.log(data.status.message);
            loginTot = 0;
            return 0;
        }
    });
}

$(document).ready(function(){ //quand le document se charge


    $("#passwordTool").on("click",function(){
    $("#toggle").toggleClass("more", "easeOutSine");
        if ($("#log_in").val()=="log in") $("#log_in").val("reset");
        else $("#log_in").val("log in");
 });//affiche/cache le formulaire pour l'envoie du mail avec password


    var anu ;
    var i = 0;
    $(".login_2").on("keyup",function (){
     i = $(".login_2").val().length;
     clearTimeout(anu);
     if (i>=3){
         anu = setTimeout(function(){
         if(i == $(".login_2").val().length){
             var name = $(".login_2").val();
             checkName ($(".server_2").val(),name );
         }
     },700);
     }
 });// check a validié du summoner

    $("select").change(function() {checkName ($(".server_2").val(),$(".login_2").val() );}).trigger( "change" );// check a validié du summoner

    $("#log_in").on("click",function(){
        var password= $("#pass").val();
        //TODO: encryption du password (faire la même pour le case mail de sql.php
        var dest= $("#mail1").val();
        var login = $(".login").val();
        var server = $("#server-log").val();
        if ($("#log_in").val()=="log in"){
            $.post("./utils/sql.php?action=login", {"server":server, "login":login, "pass":password}, function (data){
            if (data == 10)
            {
                document.location.href="./home";
            }
            else if (data == 11){///wrong
                $("#tool").css("background-color", "#DF231A");
                $("#tool").css("border", "#7d1e1a solid 1px");
                $("#tool").html("wrong login, server or password");
            }
            });
        }
        else if ($("#log_in").val()=="reset"){

            $.post("./utils/sql.php?action=mail", {"dest":dest, "server":server, "login":login}, function (data){
                console.log(data);
                if (data==12){ ///OK
                    $("#toggle").toggleClass("more", "easeOutSine");
                    $("#tool").css("background-color", "#6adf5e");
                    $("#tool").css("border", "#177d14 solid 1px");
                    $("#log_in").val("log in");
                    $("#tool").html("Check your email");
                }
                else if (data==10){///not registered
                    $("#tool").css("background-color", "#DF231A");
                    $("#tool").css("border", "#7d1e1a solid 1px");
                    $("#tool").html("not registered");
                }
                else if (data == 11){///wrong email
                    $("#tool").css("background-color", "#DF231A");
                    $("#tool").css("border", "#7d1e1a solid 1px");
                    $("#tool").html("wrong email");
                }

            });
        }
});//pour se logger ou reset le password


    $("#submit").on("click",function(){

    $("#submit").after("<img src='images/ajax-loader.gif' id='gif'/>");
    var ok = 1;
    var name = $("#name").val();
    var lastName = $("#last-name").val();
    var mail = $("#mail").val();
    var login = $(".login_2").val();
    var server = $("#server").val();
    var pass1 = $("#pass-1").val();
    var pass2 = $("#pass-2").val();
    var summonerId;

    var regexMail = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    var regexPassA = /(.)*([a-zA-Z])+(.)*/
    var regexPass1 = /(.)*([0-9])+(.)*/

    if(!regexMail.test(mail)) {         //// test du mail
        $("#mail").css("border", "#DD0E11 solid 3px");
        ok = 0;
    }
    else $("#mail").css("border", "#9f9ba8 solid 1px");

var test=0;
    if (loginTot== 0) ok=0;

    else {
        summonerId = loginTot[""+login+""].id;
        var request = new XMLHttpRequest();
        request.open('GET', "./utils/api.php?action=runesPages&server="+server+"&id="+summonerId, false);  // `false` makes the request synchronous
        request.send(null);
        var myJson = $.parseJSON(request.responseText);
        $.each(myJson[""+summonerId+""].pages,function(i, data){
            if (data.name.toLowerCase()=="paintfusion")test =1;
        });
        if (!test){
            ok=0;
            $("#runesPage").css("background-color", "#DF231A");
            $("#runesPage").css("border", "#7d1e1a solid 1px");
        }
    }
    if (pass1!=pass2 || (pass1.length)<6 || !regexPassA.test(pass1) || !regexPass1.test(pass1)){
        $(".pass").css("border", "#DD0E11 solid 3px");
        ok=0;
    }
    else $(".pass").css("border", "#9f9ba8 solid 1px");

console.log("ok : "+ok);
    if (ok){
        $.post("./utils/sql.php?action=auth", {"name":name, "lastName":lastName, "mail":mail, "login":login, "server":server, "pass":pass1, "summonerId":summonerId}, function (data){
            console.log(data);
            if (data==1){
                document.location.href="./home";
            }
            else if (data==0){
                $("#alert").html("already registered");
                $("#alert").css("background-color", "#DF231A");
                $("#alert").css("border", "#7d1e1a solid 1px");
            } 
        });

    }


        $("#gif").remove();
});//pour créer un compte


});
