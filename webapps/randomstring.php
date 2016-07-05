<!DOCTYPE HTML>
<html>
    <head>
<?php include '../includefunctions.php'; $title = "Random String Generator"; echoHeadElements(); ?>
        <title><?php echo "$title | Ruben Dougall"; ?></title>
        <script src="/js/jquery-1.12.2.min.js" type="text/javascript" charset="utf-8"></script>
        <script src="/js/functions.js" type="text/javascript" charset="utf-8"></script>
        <script src="/js/randomstring.js" type="text/javascript" charset="utf-8"></script>
    </head>
    <body>
<?php echoNavbar($title); ?>
        <div class="container">
            <div class="page-header">
                <h1><?php echo $title; ?></h1>
            </div>
            <p>This page lets you generate a random string. Simply enter the length of the string, which characters to use and which case to convert to.</p>
            <div class="row">
                <form class="col-md-6" id="mainform">
                    <div class="form-group">
                        <label class="control-label" for="length">Length</label>
                        <input type="number" class="form-control" id="length" name="length" min="1" max="9999" aria-describedby="lengthhelp">
                        <span class="help-block" id="lengthhelp">Length must be a whole number between 1 and 9999 inclusive.</span>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Characters</label><br>
                        <label class="radio-inline"><input type="radio" id="chars0-9" name="chars" checked>0-9</label>
                        <label class="radio-inline"><input type="radio" id="charsa-z" name="chars">a-z</label>
                        <label class="radio-inline"><input type="radio" id="chars0-9a-z" name="chars">0-9, a-z</label>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Case</label><br>
                        <label class="radio-inline"><input type="radio" id="caselower" name="case" checked aria-describedby="casehelp">Lower</label>
                        <label class="radio-inline"><input type="radio" id="caseupper" name="case" aria-describedby="casehelp">Upper</label>
                        <label class="radio-inline"><input type="radio" id="caserandom" name="case" aria-describedby="casehelp">Random</label>
                        <span class="help-block" id="casehelp">Convert all characters in the random string to either upper or lower case, or randomly convert characters to upper and lower case.</span>
                    </div>
                    <button type="submit" class="btn btn-default">Generate</button>
                </form>
            </div>
            <hr>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title">Generated String</h2>
                </div>
                <div class="panel-body pre-scrollable">
                    <samp id="string"></samp>
                </div>
            </div>
        </div>
    </body>
</html>
