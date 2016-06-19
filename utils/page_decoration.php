<html>
<head>
    <link rel="stylesheet" href="../style/page_decoratioin.css">
</head>
<body>
<!-- ############ HEADER ###############-->
<div class="decoration" id="header">
    <a href="../home/"> <img id="logo" src="../images/favicon.png"> </a>
    <?php
    if (!isset($_SESSION['pseudo'])) {?>
        <a href="../"> <input id="connexion" class="navButton" type="button" value="Connexion"/> </a>
        <a href="../"> <input id="inscription" class="navButton" type="button" value="Inscription "/> </a>
    <?php}//non inscrit
    else {
        echo ('<span id="pseudo">Bonjour '.$_SESSION["pseudo"].'</span>');
        echo ('<input id="deconnexion" class="navButton" type="submit" value="Deconnexion" />');
    }//inscrit
    ?>
</div>
<?php
/// ###################################
/// #############  NAV  ###############
?>
<nav class="decoration" id="nav">



</nav>
<?php
/// ###################################

/// ############ FOOTER ###############
?>
<div class="decoration" id="footer">



</div>
<?php
/// ###################################
?>
</body>
</html>