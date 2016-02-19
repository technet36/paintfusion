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
        break;
    case "mail":
        $server=$_POST["server"];
        $login=$_POST["login"];
        $dest=$_POST["dest"];




        $sql = "SELECT email, COUNT(*) as 'check' FROM `user_t` WHERE `pseudo`='$login' AND `server`= '$server'";
        $res = $bdd->query($sql);
        $test= $res-> fetch();
        if ($test['check'] == 1 && $dest==$test['email'] ){
            require '../PHPMailer-master/PHPMailerAutoload.php';

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
            $mail->Body    = 'Password recovery system <b>here he is !</b>';
            $mail->AltBody = 'Password recovery system';

            if(!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo '12';
            }
            }
        elseif ($test['check']==0) echo ("10");//not registered
        elseif ( $dest!=$test['email']) echo ("11");//wrong email
        break;

}
