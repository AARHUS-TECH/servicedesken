<?php
require_once('../core/init.php');

$user = new User();

if(Session::exists('userID')) {
    if(!$user->isAdmin(Session::get('userID'))) {
        Session::delete('userID');
        Redirect::to('/');
    }
} else {
    Redirect::to('/');
}

$userdata       = $user->getInfo(Session::get('userID'));
$updatedata     = $user->getInfo($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userID         = $_GET['id'];
    $fornavn        = $_POST['fornavn'];
    $efternavn      = $_POST['efternavn'];
    $brugernavn     = $_POST['brugernavn'];
    if(!empty($_POST['adgangskode'])) {
        $adgangskode    = $_POST['adgangskode'];
    } else {
        $adgangskode    = null;
    }
    $magnetstribe   = $_POST['magnetstribe'];
    
    $user->update($userID, $fornavn, $efternavn, $brugernavn, $adgangskode, $magnetstribe);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Tjek ind | Aarhus Tech SKP</title>

        <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="/assets/css/custom.css">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1" style="margin-top: 50px;">
                    <div class="panel panel-default">

                        <div id="splash" class="panel-body">
                            <h3 class="text-center">REDIGER INSTRUKTØR</h3>
                            <h5 class="text-center"><strong>Logget ind som:</strong> <?php echo $userdata['fulde_navn']; ?></h5>
                            <br />
                            <div class="row">
                                <div class="col-md-6">
                                    <form class="form-horizontal" method="post" style="padding-top: 21px;">
                                        <fieldset>
                                            <div class="form-group">
                                            <label for="inputFornavn" class="col-lg-2 control-label">Fornavn</label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control" id="inputFornavn" name="fornavn" placeholder="Steffen" value="<?php echo $updatedata['fornavn']; ?>">
                                            </div>
                                            </div>
                                            <div class="form-group">
                                            <label for="inputEfternavn" class="col-lg-2 control-label">Efternavn</label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control" id="inputEfternavn" name="efternavn" placeholder="Sørensen" value="<?php echo $updatedata['efternavn']; ?>">
                                            </div>
                                            </div>
                                            <div class="form-group">
                                            <label for="inputBrugernavn" class="col-lg-2 control-label">Brugernavn</label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control" id="inputBrugernavn" name="brugernavn" placeholder="stef1932" value="<?php echo $updatedata['brugernavn']; ?>">
                                            </div>
                                            </div>
                                            <div class="form-group">
                                            <label for="inputAdgangskode" class="col-lg-2 control-label">Adgangskode</label>
                                            <div class="col-lg-10">
                                                <input type="password" class="form-control" id="inputAdgangskode" name="adgangskode" placeholder="">
                                            </div>
                                            </div>
                                            <div class="form-group">
                                            <label for="inputGentagAdgangskode" class="col-lg-2 control-label">Gentag Adgangskode</label>
                                            <div class="col-lg-10">
                                                <input type="password" class="form-control" id="inputGentagAdgangskode" placeholder="">
                                            </div>
                                            </div>
                                            <div class="form-group">
                                            <label for="inputMagnetstribe" class="col-lg-2 control-label">Magnetstribe</label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control" id="inputMagnetstribe" name="magnetstribe" placeholder="æ123_" value="<?php echo $updatedata['magnetstribe']; ?>">
                                            </div>
                                            </div>
                                            <div class="form-group">
                                            <div class="col-lg-10 col-lg-offset-2">
                                                <button type="submit" class="btn btn-success">Rediger instruktør</button>
                                                <button type="reset" class="btn btn-danger">Nulstil</button>
                                                <a class="btn btn-danger" href="/admin">Tilbage</a>
                                            </div>
                                            </div>
                                        </fieldset>
                                        </form>
                                    </div>
                                    <div class="col-md-6">
                                        <h3>Hjælp</h3>
                                        <p><b>Fornavn:</b> Instruktørens fornavn og mellemnavn(e).</p>
                                        <p><b>Efternavn:</b> Instruktørens efternavn.</p>
                                        <p><b>Brugernavn:</b> Instruktørens ønskede brugernavn.</p>
                                        <p><b>Adgangskode:</b> Instruktørens ønskede adgangskode.</p>
                                        <p><b>Magnetstribe:</b> Instruktørens studiekort (Magnetstribens data).</p>
                                    </div>
                                </div>
                            <br />
                            <center><p class="text-center">&copy; Aarhus Tech SKP <?php echo date('Y'); ?> - Udviklet af Benjamin Jørgensen</p></center>
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
