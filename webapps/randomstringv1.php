<!DOCTYPE HTML>
<html>
    <head>
<?php include '../includefunctions.php'; $title = "Random String Generator"; echoHeadElements(); ?>
        <title><?php echo "$title | Ruben Dougall"; ?></title>
    </head>
    <body>
<?php echoNavbar($title); ?>
        <div class="container">
            <div class="page-header">
                <h1><?php echo $title; ?></h1>
            </div>
<?php
$length = "";
$chars = "";
$case = "";
$errors = array(
    "length" => "",
    "chars" => "",
    "case" => "",
);
$charNames = array(
    "09" => "0-9",
    "az" => "a-z",
    "09az" => "0-9, a-z",
);
// if (!isset($_GET["length"])) {
//     IncrementCounter('randomstring');
// }
if (isset($_GET["length"]) && isset($_GET["chars"]) && isset($_GET["case"]) && !empty($_GET["chars"]) && !empty($_GET["case"]) && is_numeric($_GET["length"])) {
    $length = $_GET["length"];
    $chars = $_GET["chars"];
    $case = $_GET["case"];
    echo '<h2>Your Random String:</h2>
<p><a href="'.htmlentities($_SERVER["PHP_SELF"]).'"><input type="button" value="Change options"></a> <a href="javascript:history.go(0)"><input type="button" value="New string"></a></p>
<p>Length of random string: <span class="bold">'.$length.'</span>; Characters: <span class="bold">'.$charNames[$chars].'</span>; Case: <span class="bold">'.ucfirst($case).'</span></p>
<p class="string"><code>'.GetRandomString($length,$chars).'</code></p>
';
} else {
    if (isset($_GET["length"]) && !is_numeric($_GET["length"])) {
        $errors["length"] = "Only integers are allowed";
    } else if ($_GET["length"] < 1 || $_GET["length"] > 9999) {
        $errors["length"] = "Only integers between 1 and 9999 (inclusive) are allowed";
    }
    if (isset($_GET["length"]) && empty($_GET["length"])) {
        $errors["length"] = "Cannot be left blank";
    }
    if (isset($_GET["length"]) && (!isset($_GET["chars"]) || empty($_GET["chars"]))) {
        $errors["chars"] = "Cannot be left blank";
    }
    if (isset($_GET["length"]) && (!isset($_GET["case"]) || empty($_GET["case"]))) {
        $errors["case"] = "Cannot be left blank";
    }
?>
<form method="get" action="<?php echo htmlentities($_SERVER["PHP_SELF"]); ?>">
<p><span class="bold">Length of random string:</span>
<input type="text" size="12" maxlength="4" name="length" value="<?php if (isset($_GET["length"])) echo htmlspecialchars($_GET["length"]); ?>">
<span class="error"><?php echo $errors["length"]; ?></span></p>
<p><span class="bold">Characters:</span>
<input type="radio" name="chars" value="09" <?php if (isset($_GET["chars"]) && $_GET["chars"] == "09") echo "checked"; ?>>0-9
<input type="radio" name="chars" value="az" <?php if (isset($_GET["chars"]) && $_GET["chars"] == "az") echo "checked"; ?>>a-z
<input type="radio" name="chars" value="09az" <?php if (isset($_GET["chars"]) && $_GET["chars"] == "09az") echo "checked"; ?>>0-9, a-z
<span class="error"><?php echo $errors["chars"]; ?></span></p>
<p><span class="bold">Convert case:</span>
<input type="radio" name="case" value="upper" <?php if (isset($_GET["case"]) && $_GET["case"] == "upper") echo "checked"; ?>>Upper
<input type="radio" name="case" value="lower" <?php if (isset($_GET["case"]) && $_GET["case"] == "lower") echo "checked"; ?>>Lower
<input type="radio" name="case" value="random" <?php if (isset($_GET["case"]) && $_GET["case"] == "random") echo "checked"; ?>>Random
<span class="error"><?php echo $errors["case"]; ?></span></p>
<input type="submit" value="Generate">
</form>
<?php
}

function GetRandomString($length,$chars) {
    global $case;
    $charsArray = array(
        "09" => "0123456789",
        "az" => "abcdefghijklmnopqrstuvwxyz",
        "09az" => "abcdefghijklmnopqrstuvwxyz0123456789",
    );
    $charstr = $charsArray[$chars];
    $charcount = strlen($charstr);
    $str = "";
    for ($i = 0; $i < $length; $i++) {
        $str .= $charstr[rand(0,$charcount - 1)];
    }
    if ($case == "upper") {
        $str = strtoupper($str);
    }
    elseif ($case == "random") {
        for ($i = 0; $i < $length; $i++) {
            if (rand(0,1) == 0) {
                $str = substr_replace($str,strtoupper(substr($str,$i,1)),$i,1);
            }
        }
    }
    return $str;
}
?>
        </div>
    </body>
</html>
