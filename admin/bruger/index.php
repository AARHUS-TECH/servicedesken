<?php
require_once('../../core/init.php');

$user = new User();
$ticket = new Tickets();

if(!Session::exists('userID')) {
    Session::flash('index_error', 'Du skal være logget ind for at kunne tilgå denne side!');
    Redirect::to('/');
} else if (Session::exists('userID') && !$user->isAdmin(Session::get('userID'))) {
    Session::flash('dashboard_error', 'Du skal være admin for at kunne tilgå denne side!');
    Redirect::to('/elev/');
}

$userdata = $user->getInfo(Session::get('userID'));

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Servicedesken | Aarhus Tech SKP</title>

        <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="/assets/css/custom.css">
    </head>
    <body>
        <div class="container">
            <div class="col-md-12" style="margin-top: 50px;">
                <?php echo Errors::getErrorMessage('dashboard_error'); ?>
                <?php echo Errors::getSuccessMessage('dashboard_success'); ?>

                <div class="row">
                    <div class="card border-success col-md-12">
                        <div class="card-body">
                            <h3 class="text-center">SERVICEDESKEN - BRUGER SYSTEM</h3>
                            <blockquote class="card-blockquote">
                            <p class="text-center"><b>Logget ind som:</b> <?php echo $userdata['navn']; ?></p>
                            <form method="post" action="/">
                                <fieldset>
                                    <div class="form-group form-row text-center">
                                        <div class="col">
                                            <a class="btn btn-outline-success full-width" href="/admin/bruger/opretBruger.php">Opret bruger</a>
                                        </div>
                                        <div class="col">
                                            <a class="btn btn-outline-danger full-width" href="/admin/">Tilbage</a>
                                        </div>
                                        <div class="col">
                                            <a class="btn btn-outline-warning full-width" href="logout.php">Log ud</a>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>

                            <table class="table table-hover table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Navn</th>
                                    <th>Brugernavn</th>
                                    <th>Rolle</th>
                                    <th>Handlinger</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $user->getAllUsers(); ?>
                            </tbody>
                            </table> 

                            <footer class="text-center">&copy; Aarhus Tech SKP <?php echo date('Y'); ?> - Udviklet af Benjamin Jørgensen</footer>
                            <footer class="text-center">Version <?php echo Config::get('system_info/version'); ?></footer>
                            </blockquote>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="/assets/js/jquery.min.js"></script>
        <script src="/assets/js/popper.js"></script>
        <script src="/assets/js/bootstrap.min.js"></script>
        <script src="/assets/js/dismiss-alerts.js"></script>
    </body>
</html>
