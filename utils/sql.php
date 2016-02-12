<?php
//TODO
//conect to bdd


switch ($_GET["action"]){
    case "auth": // $_GET["server"] , $_GET["name"]
        $name=$_POST["name"];
        $lastName=$_POST["lastName"];
        $mail=$_POST["mail"];
        $login=$_POST["login"];
        $server=$_POST["server"];

        $password=$_POST["pass"];
        $password = hash("sha256",$password);

        break;
}
