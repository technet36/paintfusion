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
            loginTot = 1;
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
 });


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
 });

$( "select" ).change(function() {checkName ($(".server_2").val(),$(".login_2").val() );}).trigger( "change" );

$("#log_in").on("click",function(){
        console.log("log_in");
});


$("#submit").on("click",function(){
        console.log("sign_up");
    var ok = 1;
    var name = $("#name").val();
    var lastName = $("#last-name").val();
    var mail = $("#mail").val();
    var login = $(".login_2").val();
    var server = $("#server").val();
    var pass1 = $("#pass-1").val();
    var pass2 = $("#pass-2").val();

    var regexMail = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    var regexPassA = /(.)*([a-zA-Z])+(.)*/
    var regexPass1 = /(.)*([0-9])+(.)*/

    console.log("full name : "+name+" "+lastName);
    console.log("mail "+regexMail.test(mail)+": "+mail);
    console.log("login : "+login+" server : "+server);
    console.log("password : "+pass1);
    console.log("password : "+pass2);
    if(!regexMail.test(mail)) {         //// test du mail
        $("#mail").css("border", "#DD0E11 solid 3px");
        ok = 0;
    }
    else $("#mail").css("border", "#9f9ba8 solid 1px");

    if (!loginTot) ok=0;


    if (pass1!=pass2 || (pass1.length)<6 || !regexPassA.test(pass1) || !regexPass1.test(pass1)){
        $(".pass").css("border", "#DD0E11 solid 3px");
        ok=0;
    }
    else $(".pass").css("border", "#9f9ba8 solid 1px");

    if (ok){
        $.post("./utils/sql.php?action=auth", {"name":name, "lastName":lastName, "mail":mail, "login":login, "server":server, "pass":pass1})
    }

});


});
