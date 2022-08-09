<?php
/**
 * This file is part of the ATS DataIT Servicedesk Ticketsystem package.
 *
 * @file        opretSag.php
 * @author      Benjamin Jørgensen <bj@dunkstormen.dk>
 * @copyright   AARHUS TECH DataIT Skoleoplæring 2017-2022
 * @license     MIT, please view the LICENSE file
 * 
 * @brief       Page for making new ticket
 */



require_once('../../core/init.php');

$user   = new User();
$ticket = new Tickets();

if(!Session::exists('userID')) {
    Session::flash('index_error', 'Du skal være logget ind for at kunne tilgå denne side!');
    Redirect::to('/');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $modtagerID             = Input::get('modtagerID');
    $kategori               = Input::get('kategori');
    $priortet               = Input::get('priortet');
    $produktNavn            = Input::get('produktNavn');
    $produktModel           = Input::get('produktModel');
    $produktFejlbeskrivelse = Input::get('produktFejlbeskrivelse');

    $kontaktNavn            = Input::get('kontaktNavn');
    $kontaktTelefon         = Input::get('kontaktTelefon');
    $kontaktEmail           = Input::get('kontaktEmail');

    $ticket->create($modtagerID, $kategori, $priortet, $produktNavn, $produktModel, $produktFejlbeskrivelse, $kontaktNavn, $kontaktEmail, $kontaktTelefon);
}

$userdata = $user->getInfo(Session::get('userID'));

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Servicedesken | AARHUS TECH Skoleoplæring</title>

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
                            <h3 class="text-center">SERVICEDESKEN - TICKET SYSTEM</h3>
                            <blockquote class="card-blockquote">
                            <p class="text-center"><b>Logget ind som:</b> <?php echo $userdata['navn']; ?></p>

                            <div class="row">
                                <div class="col-md-12">
                                    <form method="POST" action="/admin/tickets/opretSag.php">
                                        <fieldset>
                                            <div class="form-group form-row">
                                                <label for="inputOprettetAf">Oprettet af (Auto)</label>
                                                <input type="text" class="form-control" id="eksempelInputOprettetAf" placeholder="Oprettet af" value="<?php echo $userdata['navn']; ?>" readonly="">
                                                <input type="hidden" name="modtagerID" value="<?php echo Session::get('userID') ?>">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label" for="inputKategori">Kategori</label>
                                                <select class="form-control" id="inputKategori" name="kategori" required>
                                                    <?php $ticket->getAllKategorier(); ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label" for="inputPriortet">Prioritet</label>
                                                <select class="form-control" id="inputPriortet" name="priortet" required>
                                                    <option selected disabled value="">Vælg</option>
                                                    <option value="Lav">Lav 10+ hverdage</option>
                                                    <option value="Middel">Middel 5-10 hverdage</option>
                                                    <option value="Høj">Høj 0-5 hverdage</option>
                                                    <option value="Haster">Haster</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputProduktNavn">Navn på produkt</label>
                                                <input type="text" class="form-control" id="eksempelProduktNavn" name="produktNavn" placeholder="Produkt navn" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputProduktModel">Model-navn/nr. på produkt</label>
                                                <input type="text" class="form-control" id="eksempelProduktModel" name="produktModel" placeholder="Produkt model" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputProduktFejlbeskrivelse">Fejlbeskrivelse</label>
                                                <textarea type="text" class="form-control" id="eksempelProduktFejlbeskrivelse" rows="6" name="produktFejlbeskrivelse" placeholder="Fejlbeskrivelse"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputKontakNavn">Kontaktpersonens navn</label>
                                                <input type="text" class="form-control" id="eksempelKontakNavn" name="kontaktNavn" placeholder="Kontaktpersonenens navn" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputKontakEmail">Kontaktpersonens e-mail</label>
                                                <input type="email" class="form-control" id="eksempelKontakEmail" name="kontaktEmail" placeholder="Kontaktpersonenens e-mail" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputKontakTelefon">Kontaktpersonens tlf. nr.</label>
                                                <input type="text" class="form-control" id="eksempelKontakTelefon" name="kontaktTelefon" placeholder="Kontaktpersonenens telefon nr." required>
                                            </div>
                                            <div class="form-group form-row">    
                                                <div class="col">
                                                    <button class="btn btn-outline-success full-width" type="submit">Opret ny sag</button>
                                                </div>
                                                <div class="col">
                                                    <a class="btn btn-outline-danger full-width" href="/admin/tickets/">Tilbage</a>
                                                </div>
                                            </div>
                                            
                                        </fieldset>
                                    </form>
                                </div>
                            </div>

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
