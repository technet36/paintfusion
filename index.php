<!DOCTYPE html>
<html lang="fr" xmlns="http://www.w3.org/1999/html">
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

                <label for="login">Login :</label>
            <div id="summoner">
                <input type="text" name="login" id="login" class="login" placeholder="Summoner name" title="your in game name, not your lol username"/>
                <select class="server" id="server-log">
                    <option value="euw">euw</option>
                    <option value="na">na</option>
                    <option value="kr">kr</option>
                    <option value="eune">eune</option>
                    <option value="br">br</option>
                    <option value="lan">lan</option>
                    <option value="las">las</option>
                    <option value="tr">tr</option>
                    <option value="oce">oce</option>
                </select>
            </div>
                <label for="pass">Password :</label>
                <input type="password" name="pass" id="pass" placeholder="Password" title="minimum 6 caracteres including letters and numbers"/>
                <p id="passwordTool" class="+"> Password forgotten ?</p>
                <div id="toggle" class="less">
                    <label for="mail">Mail :</label>
                    <input type="email" name="mail" id="mail1" placeholder="riven@lol.com" title="email used when registering"/>
                </div>
                <input type="submit" id="log_in" value="log in"/><span id="tool" class="nul"></span>
        </div>
        <div id="tabs-2">
                <label for="full-name" >Full name :</label>
                <input type="text" name="name" id="name" placeholder="Name" />
                <input type="text" name="last-name" id="last-name" placeholder="Last name"/>
                <label for="mail">Mail :</label>
                <input type="email" name="mail" id="mail" placeholder="riven@lol.com" title="email only used for password recovery"/>
                <label for="login">Login :</label>
                <input type="text" name="login" class="login_2" placeholder="Summoner name" title="your in game name, not your lol username"/>
                <div id="check" class="check" > Uncheck</div>
                <label for="server">server :</label>
                <select class="server_2" id="server" name="server">
                    <option value="euw">euw</option>
                    <option value="na">na</option>
                    <option value="kr">kr</option>
                    <option value="eune">eune</option>
                    <option value="br">br</option>
                    <option value="lan">lan</option>
                    <option value="las">las</option>
                    <option value="tr">tr</option>
                    <option value="oce">oce</option>
                </select>
                <label for="pass-1">Password :</label>
                <input type="password" name="pass1" class="pass" id="pass-1" placeholder="Password" title="minimum 6 caracteres including letters and numbers"/>
                <label for="pass-2">Password again :</label>
            <input type="password" name="pass2" class="pass" id="pass-2" placeholder="Password" title="minimum 6 caracteres including letters and numbers"/>

            <div id="runesPage">
                <img src="images/warning.png" id="imgWarning"/>
                <div id="textWarning"><p >in order to check you are the owner of the account please rename one of your runes page as paintfusion</p> </div>
            </div>
            <div id="div_submit">
                <input type="submit" id="submit" value="Sign up"/>
                <span id="alert"></span>
            </div>
        </div>
    </div>
</section>

</body>
</html>