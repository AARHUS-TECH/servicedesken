<?php
require_once('core/init.php');

$user = new User();

$user->auth();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Servicedesk | Aarhus Tech SKP</title>

        <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="/assets/css/custom.css">
        <script>
            function startTime() {
                var today = new Date();
                var h = today.getHours();
                var m = today.getMinutes();
                var s = today.getSeconds();
                m = checkTime(m);
                s = checkTime(s);
                document.getElementById('clock').innerHTML =
                "~ " + h + ":" + m + ":" + s + " ~";
                var t = setTimeout(startTime, 500);
            }
            function checkTime(i) {
                if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
                return i;
            }
        </script>
    </head>
    <body onload="startTime()">
        <div class="container">
            <div class="vcenter">
                <div class="col-md-6">

                    <?php echo Errors::getErrorMessage('index_error'); ?>
                    <?php echo Errors::getSuccessMessage('index_success'); ?>

                    <div class="row">
                        <div class="card border-success col-md-12">
                            <div class="card-body">
                                <h3 class="text-center">VELKOMMEN TIL SERVICEDESKEN</h3>
                                <blockquote class="card-blockquote">
                                <p class="text-center">Log ind ved at indtaste dit brugernavn og adgangskode</p>
                                <form method="post" action="/">
                                    <fieldset>
                                        <div class="form-group">
                                            <input type="username" class="form-control" id="inputBrugernavn" name="brugernavn" placeholder="Brugernavn" autofocus="true" autocomplete="off" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" id="inputAdgangskode" name="adgangskode" placeholder="Adgangskode" required>
                                        </div>
                                        <div class="form-group text-center">
                                            <button type="submit" class="btn btn-outline-success">Log ind</button>
                                        </div>
                                    </fieldset>
                                </form>
                                <footer class="text-center">&copy; Aarhus Tech SKP <?php echo date('Y'); ?> - Udviklet af Benjamin Jørgensen</footer>
                                <footer class="text-center">Version <?php echo Config::get('system_info/version'); ?></footer>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="/assets/js/jquery.min.js"></script>
        <script src="/assets/js/popper.js"></script>
        <script src="/assets/js/bootstrap.min.js"></script>
        <script src="/assets/js/dismiss-alerts.js"></script>
        <script src="/assets/js/login-page.js"></script>
    </body>
</html>
