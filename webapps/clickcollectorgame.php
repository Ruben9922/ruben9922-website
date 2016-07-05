<!DOCTYPE HTML>
<html>
    <head>
<?php include '../includefunctions.php'; $title = "Click Collector Game"; echoHeadElements(); ?>
        <title><?php echo "$title | Ruben Dougall"; ?></title>
        <script src='https://cdn.firebase.com/js/client/2.2.1/firebase.js'></script>
        <script src="/js/clickcollectorgame.js" type="text/javascript" charset="utf-8"></script>
    </head>
    <body>
<?php echoNavbar($title); ?>
        <div class="container-fluid">
            <div class="page-header">
                <h1 class="text-center"><?php echo $title; ?></h1>
            </div>
            <div class="alert alert-success" id="message" hidden></div>
            <div class="absright right">
                <span id="loginstatus"></span><br>
                <input type="button" id="loginbutton" value="Log in with Facebook">
                <input type="button" id="savebutton" value="Save">
                <input type="button" id="logoutbutton" value="Save &amp; log out">
            </div>
            <div class="text-center extravmargin" id="maincontainer">
                <br><br><span class="text-center bigger2">Clicks</span><br>
                <span class="text-center bigger1 bold" id="clicks">0</span>
                <p>Clicks per sec: <span class="bold" id="clickspersec">0</span></p><br>
                <button type="button" class="btn btn-default btn-lg" id="clickbutton">
                    Click here!
                </button>
                <p class="error" id="clickerror"></p>
            </div>
            <hr>
            <h2>Shop</h2>
            <p>To begin with, you have to click manually to increase your score. Purchase items and upgrades to automatically boost your score!</p>
            <h3>Items</h3>
            <p>Each item automatically increases your score by a certain amount every second.</p>
            <div class="container">
                <div class="text-center row" id="items"></div>
            </div>
            <h3>Upgrades</h3>
            <p>Upgrades increase the number of clicks items give you each second.</p>
            <div id="upgrades"></div>
            <div class="text-center">
                <p class="error">Currently unfinished!</p>
            </div>
        </div>
    </body>
</html>
