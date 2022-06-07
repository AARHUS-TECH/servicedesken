<?php
/**
 * This file is part of the ATS DataIT Servicedesk Ticketsystem package.
 *
 * @file        admin/bruger/opdaterBruger.php
 * @author      Benjamin Jørgensen <bj@dunkstormen.dk>
 * @author      Karsten Reitan Sørensen <krs@aarhustech.dk>
 * @copyright   AARHUS TECH DataIT Skoleoplæring 2017-2022
 * @license     MIT, please view the LICENSE file
 * 
 * @brief       User administration for system incl. roles
 */



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

if ($_GET['action'] === "delete")
{
    $deluserid = $_GET['id'];
    if($deluserid != NULL && $deluserid != "" && $deluserid != 0)
    {
        echo "Brugeren med id=" . $deluserid . " slettes!!!";
        $user->delete($deluserid);
        Redirect::to('/admin/bruger/');
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userID         = $_POST['userID'];
    $navn           = $_POST['navn'];
    $brugernavn     = $_POST['brugernavn'];

    if(!empty($_POST['password'])) {
        $adgangskode    = $_POST['password'];
        $gadgangskode   = $_POST['gpassword'];

        if($gadgangskode != $adgangskode) {
            Session::flash('bruger_error', 'Adgangskode og gentag adgangskode matcher ikke hinanden!');
            Redirect::to('/admin/bruger/opdaterBruger.php?id=' . $userID);
        }
    } else {
        $adgangskode = NULL;
    }

    $user_level     = $_POST['user_level'];

    $user->update($userID, $navn, $brugernavn, $adgangskode, $user_level);
}

$userdata = $user->getInfo(Session::get('userID'));
$updatedata = $user->getInfo(Input::get('id'));
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Rediger bruger | Aarhus Tech SKP</title>

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
                        <h3 class="text-center">SERVICEDESKEN - REDIGER BRUGER</h3>
                        <blockquote class="card-blockquote">
                        <p class="text-center"><b>Logget ind som:</b> <?php echo $userdata['navn']; ?></p>

                        <form method="post" action="/admin/bruger/opdaterBruger.php">
                            <fieldset>
                                <input type="hidden" name="userID" value="<?php echo Input::get('id'); ?>">
                                <div class="form-group">
                                    <label for="inputNavn">Navn</label>
                                    <input class="form-control" type="text" id="inputNavn" name="navn" value="<?php echo $updatedata['navn']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="inputBrugernavn">Brugernavn</label>
                                    <input class="form-control" type="text" id="inputBrugernavn" name="brugernavn" value="<?php echo $updatedata['brugernavn']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="inputAdgangskode">Adgangskode</label>
                                    <input class="form-control" type="password" id="inputAdgangskode" name="password">
                                </div>
                                <div class="form-group">
                                    <label for="inputGentagAdgangskode">Gentag adgangskode</label>
                                    <input class="form-control" type="password" id="inputGentagAdgangskode" name="gpassword">
                                </div>
                                <div class="form-group">
                                    <label for="inputAdgangskode">Rettighedsniveau</label>
                                    <select class="form-control" id="inputUserLevel" name="user_level">
                                        <?php $user->getSelectedUserLevel($updatedata['user_level']); ?>
                                    </select>
                                </div>
                                <div class="form-group form-row text-center">
                                    <div class="col">
                                        <button type="submit" class="btn btn-outline-success full-width">Opdater bruger</button>
                                    </div>
                                    <script type="javascript">

                                    </script>
                                    <div class="col">
                                        <a class="btn btn-outline-danger full-width" onclick="if (confirm('Er du sikker på at du vil slette brugeren!') == true){document.location='/admin/bruger/opdaterBruger.php?action=delete&id=<?php echo $updatedata['userID']; ?>'}">Slet bruger</a>
                                    </div>
                                    <div class="col">
                                        <a class="btn btn-outline-warning full-width" href="/admin/bruger/">Tilbage</a>
                                    </div>
                                </div>
                            </fieldset>
                        </form>

                        <footer class="text-center" style="color: white;">© Aarhus Tech SKP 2018</footer>
                        <footer class="text-center" style="color: white;">Udviklet af elever og instruktører SKP Data IT</footer>
                        <footer class="text-center" style="color: white;">Version <?php echo Config::get('system_info/version'); ?></footer>

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
