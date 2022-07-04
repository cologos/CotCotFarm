<!DOCTYPE html>
<html>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="src/style/Design.css" />
        <title><?= $t ?></title>
    </head>

    <body>
        <div class="container">
            <div id="headerContainer">
                <div class="header">
                    <center><h1>HeaderBox</h1></center>
                </div>
                <div class="connexion">
                    <center><h1>ConnexionBox</h1></center>
                </div>
            </div>
            <div id="allBodyContainer">
                <div id="menuContainer">
                    <div class="menu">
                        <?= $content ?>
                    </div>
                </div>
                <div id="bodyContainer">
                    <div class="Presbody">
                        <center><h1>PresBodyBox</h1></center>
                    </div>
                    <div class="Newsbody">
                        <center><h1>NewsbodyBox</h1></center>
                    </div>
                    <div class="Eventsbody">
                        <center><h1>EventsbodyBox</h1></center>
                    </div>
                </div>
            </div>
            <div id="footerContainer">
                <div class="footer">
                    <center><h1>FooterBox</h1></center>
                </div>
            </div>
        </div>
    </body>

</html>