<?php
require_once('../../core/init.php');

$user = new User();

if(Session::exists('userID')) {
    if(!$user->isAdmin(Session::get('userID'))) {
        Session::delete('userID');
        Redirect::to('/');
    }
} else {
    Redirect::to('/');
}

$userdata = $user->getInfo(Session::get('userID'));

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $navn           = $_POST['navn'];
    $brugernavn     = $_POST['brugernavn'];
    $adgangskode    = $_POST['password'];
    $gadgangskode   = $_POST['gpassword'];
    $user_level     = $_POST['user_level'];

    if($adgangskode != $gadgangskode) {
        Session::flash('bruger_error', 'Adgangskode og gentag adgangskode matcher ikke hinanden!');
        Redirect::to('/admin/bruger/opretBruger.php');
    }

    $user->opretBruger($navn, $brugernavn, $adgangskode, $user_level);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Opret bruger | Aarhus Tech SKP</title>

        <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="/assets/css/custom.css">
    </head>
    <body>
    <div class="container">
        <div class="col-md-12" style="margin-top: 50px;">
            <?php echo Errors::getErrorMessage('bruger_error'); ?>
            <?php echo Errors::getSuccessMessage('bruger_success'); ?>

            <div class="row">
                <div class="card border-success col-md-12">
                    <div class="card-body">
                        <h3 class="text-center">SERVICEDESKEN - OPRET BRUGER</h3>
                        <blockquote class="card-blockquote">
                        <p class="text-center"><b>Logget ind som:</b> <?php echo $userdata['navn']; ?></p>

                        <form method="post" action="/admin/bruger/opretBruger.php">
                            <fieldset>
                                <div class="form-group">
                                    <label for="inputNavn">Navn</label>
                                    <input class="form-control" type="text" id="inputNavn" name="navn" required>
                                </div>
                                <div class="form-group">
                                    <label for="inputBrugernavn">Brugernavn</label>
                                    <input class="form-control" type="text" id="inputBrugernavn" name="brugernavn" required>
                                </div>
                                <div class="form-group">
                                    <label for="inputAdgangskode">Adgangskode</label>
                                    <input class="form-control" type="password" id="inputAdgangskode" name="password" required>
                                </div>
                                <div class="form-group">
                                    <label for="inputGentagAdgangskode">Gentag adgangskode</label>
                                    <input class="form-control" type="password" id="inputGentagAdgangskode" name="gpassword" required>
                                </div>
                                <div class="form-group">
                                    <label for="inputAdgangskode">Rettighedsniveau</label>
                                    <select class="form-control" id="inputUserLevel" name="user_level">
                                        <option value="" selected disabled>Vælg</option>
                                        <option value="1">Instruktør</option>
                                        <option value="0">Elev</option>
                                    </select>
                                </div>
                                <div class="form-group form-row text-center">
                                    <div class="col">
                                    <button type="submit" class="btn btn-outline-success full-width">Opret bruger</button>
                                    </div>
                                    <div class="col">
                                        <a class="btn btn-outline-danger full-width" href="/admin/bruger/">Tilbage</a>
                                    </div>
                                </div>
                            </fieldset>
                        </form>

<?php require_once("../../assets/tpl/cases_footer.php");  ?>