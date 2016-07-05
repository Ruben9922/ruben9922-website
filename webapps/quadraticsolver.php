<!DOCTYPE HTML>
<html>
    <head>
<?php include '../includefunctions.php'; $title = "Quadratic Equation Solver"; echoHeadElements(); ?>
        <title><?php echo "$title | Ruben Dougall"; ?></title>
        <script src="/js/jquery-1.12.2.min.js" type="text/javascript" charset="utf-8"></script>
        <script src="/js/functions.js" type="text/javascript" charset="utf-8"></script>
        <script src="/js/quadraticsolver.js" type="text/javascript" charset="utf-8"></script>
    </head>
    <body>
<?php echoNavbar($title); ?>
        <div class="container">
            <div class="page-header">
                <h1><?php echo $title; ?></h1>
            </div>
            <p>This page finds the solution of a quadratic equation.</p>
            <p>Equation must be a quadratic equation in the form <var>a</var><var>x</var><sup>2</sup> + <var>b</var><var>x</var> + <var>c</var> = 0 where <var>a</var> is not equal to 0.</p>
            <form id="mainform">
                <div class="form-group">
                    <label class="control-label" for="a">Coefficient of <span class="italic">x<sup>2</sup></span> (<span class="italic">a</span>)</label>
                    <input type="text" class="form-control" id="a" name="a" maxlength="5" min="-9999" max="9999" aria-describedby="ahelp">
                    <span class="help-block" id="ahelp">Must be non-zero.</span>
                </div>
                <div class="form-group">
                    <label class="control-label" for="b">Coefficient of <span class="italic">x<sup>1</sup></span> (<span class="italic">b</span>)</label>
                    <input type="text" class="form-control" id="b" name="b" maxlength="4" min="-9999" max="9999">
                </div>
                <div class="form-group">
                    <label class="control-label" for="c">Coefficient of <span class="italic">x<sup>0</sup></span> (<span class="italic">c</span>)</label>
                    <input type="text" class="form-control" id="c" maxlength="4" name="c" min="-9999" max="9999">
                </div>
                <button type="submit" class="btn btn-default">Generate</button>
            </form>
        </div>
    </body>
</html>
