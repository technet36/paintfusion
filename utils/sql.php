<?php

$BDD_host="localhost";
$BDD_user="root";
$BDD_password="";
$BDD_base="paintfusion";
try {
    $bdd = new PDO('mysql:host='.$BDD_host.';dbname='.$BDD_base,$BDD_user,$BDD_password,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));


} catch (PDOException $e) {
    header("location: ../error.php?error=".$e->getMessage());
    die("<font color=\"red\">SQLInsert: Erreur de connexion : " . $e->getMessage() . "</font>");
}



switch ($_GET["action"]){
    case "auth": // $_GET["server"] , $_GET["name"]
        $name=$_POST["name"];
        $lastName=$_POST["lastName"];
        $mail=$_POST["mail"];
        $login=$_POST["login"];
        $server=$_POST["server"];
        $summonerId=$_POST["summonerId"];
        $password=$_POST["pass"];
        $pass.="é(-è_%ù*µ^schbjoui¨?bgv,:!RTDJtf§1996";
        $password = hash("sha256",$password);


        $sql = "SELECT COUNT(*) as 'check' FROM `user_t` WHERE `summonerId`='$summonerId' AND `server`= '$server'";
        $res = $bdd->query($sql);
        $test= $res-> fetch();
        $test = $test['check'];

        if ($test == 0){
            $sql =  "INSERT INTO user_t (`pseudo`,`password`,`nom`,`prenom`,`email`,`server`,`summonerId`) VALUES ('$login','$password','$name','$lastName','$mail','$server','$summonerId')";
            $res = $bdd->query($sql);
            echo (1);
        }
        else echo (0);
        break;//To sign up
    case "mail":
        $server=$_POST["server"];
        $login=$_POST["login"];
        $dest=$_POST["dest"];

        $sql = "SELECT email, COUNT(*) as 'check' FROM `user_t` WHERE `pseudo`='$login' AND `server`= '$server'";
        $res = $bdd->query($sql);
        $test= $res-> fetch();
        if ($test['check'] == 1 && $dest==$test['email'] ){
            require '../PHPMailer-master/PHPMailerAutoload.php';

            $passwd = md5(rand(1000,9999));
            $mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com;';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to
            $mail->Username = 'morandmaxence@gmail.com';                 // SMTP username
            $mail->Password = 'technet36';                           // SMTP password

            $mail->setFrom('morandmaxence@gmail.com', 'Paintfusion');
            $mail->addAddress($dest, $login);     // Add a recipient
            $mail->addReplyTo('morandmaxence@gmail.com', 'Paintfusion');

            $mail->isHTML(true);                                  // Set email format to HTML

            $mail->Subject = 'Paintfusion';
            $mail->Body    = 'Password recovery system <br/>Hi summoner,<br/>It seems you\'ve forget the password of the Paintfusion\'s '.$login.' account.<br/><b>Your new password : '.$passwd.'</b><br/>Try not to forget it :)<br/>GLHF';
            $mail->AltBody = 'Password recovery system new password : '.$passwd;

            if(!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
//TODO: faire le même encryption que pour le login de index.js
                $passwd.="é(-è_%ù*µ^schbjoui¨?bgv,:!RTDJtf§1996";
                $passwd = hash("sha256",$password);
                $sql = "UPDATE `user_t` SET  `password`=".$passwd." WHERE `pseudo`='$login' AND `server`= '$server'";
                $res = $bdd->query($sql);
                echo '12';
            }
            }
        elseif ($test['check']==0) echo ("10");//not registered
        elseif ( $dest!=$test['email']) echo ("11");//wrong email
        break;//To reset password
    case "login":
        $server=$_POST["server"];
        $login=$_POST["login"];
        $pass =$_POST["pass"];
        $pass.="é(-è_%ù*µ^schbjoui¨?bgv,:!RTDJtf§1996";
        $pass = hash("sha256",$password);


        $sql = "SELECT `id_user`,`nom`,`prenom`,`mat_gen`,`status`,`note`,`summonerId`,`privacy_lvl`,COUNT(*) as 'check' FROM `user_t` WHERE `pseudo`='$login' AND `server`= '$server' AND `password`='$pass'";
        $res = $bdd->query($sql);
        $user= $res-> fetch();
        if ($user['check']) {
            session_start();
            $_SESSION["pseudo"] = $login;
            $_SESSION["userId"] = $user['id_user'];
            $_SESSION["lastName"] = $user['nom'];
            $_SESSION["name"] = $user['prenom'];
            $_SESSION["matGen"] = $user['mat_gen'];
            $_SESSION["status"] = $user['status'];
            $_SESSION["note"] = $user['note'];
            $_SESSION["summonerId"] = $user['summonerId'];
            $_SESSION["privacyLvl"] = $user['privacy_lvl'];
            $_SESSION["server"] = $server;
            echo (10);
        }
        else echo (11);
        break;//To log in
    default:
        echo ("failed sql.php");
        break;

}

