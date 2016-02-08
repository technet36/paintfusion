$(function() {
    $( "#tabs" ).tabs();
});

$(document).ready(function(){//quand le document se charge
    $("#passwordTool").on("click",function(){
        $(this).after('<label for="mail">Mail :</label> <input type="email" name="mail" id="mail" placeholder="riven@lol.com" title="email used when registering"/>')
    })
});
