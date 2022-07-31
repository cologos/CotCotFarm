<!DOCTYPE html>
<html>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="src/site/style/Design.css" />
        <title><?= $t ?></title>
    </head>

    <body>
        <div class="container">
            <div id="headerContainer">
                <?= $contentHeader ?>
            </div>
            <div id="allBodyContainer">
                <div id="menuContainer">
                    <div class="menu">
                        <?= $contentMenu ?>
                    </div>
                </div>
                <div id="bodyContainer">
                    <?= $contentBody ?>
                </div>
            </div>
            <div id="footerContainer">
                <?= $contentFooter ?>
            </div>
        </div>
    </body>

</html>