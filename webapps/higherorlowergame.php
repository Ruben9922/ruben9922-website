<!DOCTYPE HTML>
<html>
    <head>
<?php include '../includefunctions.php'; $title = "Higher or Lower Game"; echoHeadElements(); ?>
        <title><?php echo "$title | Ruben Dougall"; ?></title>
        <script src='https://cdn.firebase.com/js/client/2.2.1/firebase.js'></script>
        <script src="/js/jquery-1.12.2.min.js" type="text/javascript" charset="utf-8"></script>
        <script src="/js/functions.js" type="text/javascript" charset="utf-8"></script>
        <script src="/js/higherorlowergame.js" type="text/javascript" charset="utf-8"></script>
    </head>
    <body>
<?php echoNavbar($title); ?>
        <div class="container-fluid">
            <div class="page-header">
                <h1 class="text-center"><?php echo $title; ?></h1>
            </div>
            <div class="row text-center">
                <div class="col-sm-2 col-lg-1">
                    <div class="hiddennormal" id="roundcontainer">
                        Round<br>
                        <span class="bigger1" id="round">1</span>
                    </div>
                </div>
                <div class="col-sm-2 col-lg-1 col-sm-push-8 col-lg-push-10">
                    <div class="hiddennormal" id="scorecontainer">
                        Score<br>
                        <span class="center bigger1" id="score">0</span>
                    </div>
                </div>
                <div class="col-sm-8 col-lg-10 col-sm-pull-2 col-lg-pull-1">
                    <div id="introcontainer">
                        <p class="hiddennormal"><b>Welcome to my higher or lower game!</b></p>
                        <p class="hiddennormal">A number will be shown. Simply guess whether the next number will be <b>higher</b>, <b>lower</b> or the <b>same</b>, and your score will increase if you're correct.</p>
                        <p class="hiddennormal">If you guess <b>higher or lower</b> and you're correct, you'll get <b>1 point</b>.</p>
                        <p class="hiddennormal">If you guess the next number is the <b>same</b> and you're correct, you'll get <b>20 points</b>.</p>
                        <button type="button" class="btn btn-default btn-lg hiddennormal" id="startbutton">Start!</button>
                    </div>
                    <div id="gamecontainer">
                        <p class="bigger1 hiddennormal" id="number">0</p>
                        <button type="button" class="btn btn-default btn-lg hiddennormal" id="lowerbutton"><span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span> Lower</button>
                        <button type="button" class="btn btn-default btn-lg hiddennormal" id="samebutton"><span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span> Same</button>
                        <button type="button" class="btn btn-default btn-lg hiddennormal" id="higherbutton"><span class="glyphicon glyphicon-menu-up" aria-hidden="true"></span> Higher</button>
                    </div>
                    <br>
                    <div class="alert text-left hiddennormal" id="resultmessage" role="alert"></div>
                </div>
            </div>
        </div>
    </body>
</html>
