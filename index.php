<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>PAINTFUSION</title>
    <script src="jquery-ui-1.11.4.custom/external/jquery/jquery.js"></script>
    <script src="jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="jquery-ui-1.11.4.custom/jquery-ui.min.css"/>
    <link rel="stylesheet" href="./style/index.css">    </link>
    <script src="index.js"></script>
</head>
<body>
<section>
    <div id="tabs">
        <ul>
            <li><a href="#tabs-1">Log in</a></li>
            <li><a href="#tabs-2">Sign up</a></li>
        </ul>
        <div id="tabs-1">
            <form id="formulaire">
                <label for="login">Login :</label>
                <input type="text" name="login" id="login" placeholder="In game name" title="your in game name, not your lol username"/>
                <select id="server-log">
                    <option value="euw">euw</option>
                    <option value="na">na</option>
                    <option value="kr">kr</option>
                    <option value="eune">eune</option>
                    <option value="br">br</option>
                </select>
                <label for="pass">Password :</label>
                <input type="password" name="pass" id="pass" placeholder="Password" title="minimum 6 caracteres including letters and numbers"/>
                <p id="passwordTool"> Password forgotten ?</p>
                <input type="submit" id="submit" value="log in"/>
            </form>
        </div>
        <div id="tabs-2">
            <form id="formulaire">
                <label for="full-name" >Full name :</label>
                <input type="text" name="name" id="name" placeholder="Name" />
                <input type="text" name="last-name" id="last-name" placeholder="Last name"/>
                <label for="mail">Mail :</label>
                <input type="email" name="mail" id="mail" placeholder="riven@lol.com" title="email only used for password recovery"/>
                <label for="login">Login :</label>
                <input type="text" name="login" id="login" placeholder="Summoner name" title="your in game name, not your lol username"/>
                <div id="check" > Invalid</div>
                <label for="server">server :</label>
                <select id="server" name="server">
                    <option value="euw">euw</option>
                    <option value="na">na</option>
                    <option value="kr">kr</option>
                    <option value="eune">eune</option>
                    <option value="br">br</option>
                </select>
                <label for="pass-1">Password :</label>
                <input type="password" name="pass-1" id="pass-1" placeholder="Password" title="minimum 6 caracteres including letters and numbers"/>
                <label for="pass-2">Password again :</label>
                <input type="password" name="pass-2" id="pass-2" placeholder="Password" title="minimum 6 caracteres including letters and numbers"/>
                <input type="submit" id="submit" value="Sign up"/>
            </form>
        </div>
    </div>
</section>

</body>
</html>