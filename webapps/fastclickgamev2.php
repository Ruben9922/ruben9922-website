<!DOCTYPE HTML>
<html>
    <head>
<?php include '../includefunctions.php'; $title = "Fast Click Game"; echoHeadElements(); ?>
        <title><?php echo "$title | Ruben Dougall"; ?></title>
        <script src='https://cdn.firebase.com/js/client/2.2.1/firebase.js'></script>
        <script src="/js/jquery-1.12.2.min.js" type="text/javascript" charset="utf-8"></script>
        <script src="/js/fastclickgamev2.js" type="text/javascript" charset="utf-8"></script>
    </head>
    <body>
<?php echoNavbar($title); ?>
        <div class="container-fluid">
            <div class="page-header">
                <h1 class="text-center"><?php echo $title; ?></h1>
            </div>
            <div class="row">
                <div class="text-center col-sm-2 col-lg-1">
                    Time left<br>
                    <span class="bigger1" id="timeleft">10</span>
                </div>
                <div class="text-center col-sm-2 col-lg-1 col-sm-push-8 col-lg-push-10">
                    Clicks<br>
                    <span class="bigger1" id="clicks">0</span>
                </div>
                <div class="text-center col-sm-8 col-lg-10 col-sm-pull-2 col-lg-pull-1">
                    <div class="row">
                        <div class="col-xs-12">
                            <button type="button" class="btn btn-default btn-lg" id="clickbutton">Click here!</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8 col-lg-4 col-sm-offset-2 col-lg-offset-4" id="container">
                            <div class="well well-sm" id="welcomemessage">Simply start clicking the button to begin.</div>
                            <div class="alert alert-error" id="clickerror" role="alert"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
