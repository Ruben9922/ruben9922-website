<!DOCTYPE HTML>
<html>
    <head>
<?php include '../includefunctions.php'; $title = "Unix Permissions Calculator"; echoHeadElements(); ?>
        <title><?php echo "$title | Ruben Dougall"; ?></title>
        <script src="/js/jquery-1.12.2.min.js" type="text/javascript" charset="utf-8"></script>
        <script src="/js/functions.js" type="text/javascript" charset="utf-8"></script>
        <script src="/js/permscalculator.js" type="text/javascript" charset="utf-8"></script>
    </head>
    <body>
<?php echoNavbar($title); ?>
        <div class="container">
            <div class="page-header">
                <h1><?php echo $title; ?></h1>
            </div>
            <p>Permissions in Unix and Linux can be represented in <em>symbolic</em> notation, as seen in output from the <code>ls -l</code> command, or in <em>numeric</em> (octal) notation, as often used with the <code>chmod</code> command.</p>
            <p>This Unix permissions calculator allows you to convert permissions to symbolic and octal notation.</p>
            <p>More information can be found in <a href="https://en.wikipedia.org/wiki/File_system_permissions#Traditional_Unix_permissions" target="_blank">this Wikipedia article</a>.</p>
            <br>
            <div>
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#convertfromsymbolic" aria-controls="convertfromsymbolic" role="tab" data-toggle="tab">Convert from Symbolic</a></li>
                    <li role="presentation"><a href="#convertfromoctal" aria-controls="convertfromoctal" role="tab" data-toggle="tab">Convert from Octal</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="convertfromsymbolic">
                        <br>
                        <p>Check the required permissions, then press Convert to display the permissions in symbolic and octal notation.</p>
                        <form id="convertfromsymbolicform">
                            <div class="row">
                                <div class="form-group col-sm-3">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">Special</div>
                                        <div class="panel-body">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" id="setuid">
                                                    setuid
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" id="setgid">
                                                    setgid
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" id="stickymode">
                                                    Sticky mode
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-sm-3">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">User</div>
                                        <div class="panel-body">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" id="userread">
                                                    Read
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" id="userwrite">
                                                    Write
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" id="userexecute">
                                                    Execute
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-sm-3">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">Group</div>
                                        <div class="panel-body">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" id="groupread">
                                                    Read
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" id="groupwrite">
                                                    Write
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" id="groupexecute">
                                                    Execute
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-sm-3">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">Other</div>
                                        <div class="panel-body">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" id="otherread">
                                                    Read
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" id="otherwrite">
                                                    Write
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" id="otherexecute">
                                                    Execute
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-default">Convert</button>
                            <button type="button" class="btn btn-default" id="convertfromsymbolicformclearbutton">Clear</button>
                        </form>
                        <hr>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h2 class="panel-title">Octal Notation</h2>
                            </div>
                            <div class="panel-body text-center">
                                <p class="bigger1" id="octalnotation">0000</p>
                                <p>Example: <code>chmod <b><span id="octalnotationexample">0000</span></b> /path/to/file</code></p>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h2 class="panel-title">Symbolic Notation</h2>
                            </div>
                            <div class="panel-body text-center">
                                <samp class="bigger1" id="symbolicnotation">---------</samp>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="convertfromoctal">
                        <p>Enter the permissions in octal notation then press Convert to display </p>
                        <form class="convertfromoctalform">
                            <input type="text" class="form-control" placeholder="Text input">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
