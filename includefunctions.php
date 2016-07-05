<?php
function TestInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlentities($data);
    return $data;
}

function isEmpty(&$var) {
    return empty($var) && $var !== '0';
}

function echoNavbar($title) {
    $leftLinks = array(
        "Store Apps" => "/storeapps/index.php"
    );
    $rightLinks = array(
        "About" => "/about.php"
    );
    $webAppsLinks = array(
        "Web Apps Home" => "/webapps/index.php",
        "<separator1>" => "<separator>",
        "Click Collector Game" => "/webapps/clickcollectorgame.php",
        "Fast Click Game" => "/webapps/fastclickgamev2.php",
        "Higher or Lower Game" => "/webapps/higherorlowergame.php",
        "Unix Permissions Calculator" => "/webapps/permscalculator.php",
        "Quadratic Equation Solver" => "/webapps/quadraticsolver.php",
        "Random String Generator" => "/webapps/randomstring.php",
        "<separator2>" => "<separator>",
        "About Web Apps" => "/webapps/about.php"
    );
?>
        <nav class="navbar navbar-inverse navbar-static-top">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a id="sitetitle" href="/">Ruben Dougall</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-collapse">
                    <ul class="nav navbar-nav">
<?php
echoNavbarLinks($leftLinks, $title);
echoNavbarDropdownLinks($webAppsLinks, $title, "Web Apps");
?>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
<?php echoNavbarLinks($rightLinks, $title); ?>
                    </ul>
                </div>
            </div>
        </nav>
<?php
}

function echoHeadElements() {
    echo '        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn\'t work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="/css/styles.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans|Pacifico" rel="stylesheet" type="text/css">
        <link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/apple-touch-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon-180x180.png">
        <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="/android-chrome-192x192.png" sizes="192x192">
        <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96">
        <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
        <link rel="manifest" href="/manifest.json">
        <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#fafafa">
        <meta name="msapplication-TileImage" content="/mstile-144x144.png">
        <meta name="theme-color" content="#007ee5">

        <script src="/js/jquery-1.12.2.min.js" type="text/javascript" charset="utf-8"></script>
        <script src="/js/bootstrap.min.js"></script>

'; // Might change so bootstrap.min.js not included into every page
}

function echoNavbarLinks($links, $title) {
    foreach ($links as $key => $value) {
        if ($title === $key) {
            echo "                        <li class=\"active\"><a href=\"$value\">$key<span class=\"sr-only\"> (current)</span></a></li>
";
        } else {
            echo "                        <li><a href=\"$value\">$key</a></li>
";
        }
    }
}

function echoNavbarDropdownLinks($links, $title, $dropdownName) {
    $linksString = '';
    $dropdownActive = false;
    foreach ($links as $key => $value) {
        if ($title === $key) {
            $linksString .= "                                <li class=\"active\"><a href=\"$value\">$key<span class=\"sr-only\"> (current)</span></a></li>
";
            $dropdownActive = true;
        } else if ($value === '<separator>') { // For separators in dropdowns
            $linksString .= "                                <li role=\"separator\" class=\"divider\"></li>
";
        } else {
            $linksString .= "                                <li><a href=\"$value\">$key</a></li>
";
        }
    }
?>
                        <li class="dropdown<?php if ($dropdownActive) { echo ' active'; } ?>">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $dropdownName; if ($dropdownActive) { echo '<span class="sr-only"> (current)</span>'; } ?> <span class="caret"></span></a>
                            <ul class="dropdown-menu">
<? echo $linksString; ?>
                            </ul>
                        </li>
<?php
}
?>
