<?php
/**
 * This file is part of the ATS DataIT Servicedesk Ticketsystem package.
 *
 * @file        Config.php
 * @author      Benjamin Jørgensen <bj@dunkstormen.dk>
 * @copyright   AARHUS TECH DataIT Skoleoplæring 2017-2022
 * @license     MIT, please view the LICENSE file
 * 
 * @brief       Class handling config setting into globals
 */



require_once('../../core/init.php');

$user   = new User();
$ticket = new Tickets();

if(empty(Input::get('id'))) {
    Session::flash('dashboard_error', 'Kunne ikke finde den ønskede ticket');
    Redirect::to('/admin/tickets/');
}

$currentTicket = $ticket->getTicket(Input::get('id'));

if(!Session::exists('userID')) {
    Session::flash('index_error', 'Du skal være logget ind for at kunne tilgå denne side!');
    Redirect::to('/');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kategori               = Input::get('kategori');
    $priortet               = Input::get('priortet');
    $produktNavn            = Input::get('produktNavn');
    $produktModel           = Input::get('produktModel');
    $produktFejlbeskrivelse = Input::get('produktFejlbeskrivelse');

    $kontaktNavn            = Input::get('kontaktNavn');
    $kontaktTelefon         = Input::get('kontaktTelefon');
    $kontaktEmail           = Input::get('kontaktEmail');

    $repareretID            = Input::get('repareretID');
    $repareretDato          = str_replace('T', ' ', Input::get('repareretDato'));
    $repareretBeskrivelse   = Input::get('repareretBeskrivelse');

    $status                 = Input::get('status');
    $sagsID                 = Input::get('sagsID');

    $ticket->update($kategori, $priortet, $produktNavn, $produktModel, $produktFejlbeskrivelse, $kontaktNavn, $kontaktEmail, $kontaktTelefon, $repareretID, $repareretDato, $repareretBeskrivelse, $status, $sagsID);
    Redirect::to('/admin/tickets/');
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
                            <h3 class="text-center">SERVICEDESKEN - TICKET SYSTEM</h3>
                            <blockquote class="card-blockquote">
                            <p class="text-center"><b>Logget ind som:</b> <?php echo $userdata['navn']; ?></p>

                            <div class="row">
                                <div class="col-md-12">
                                    <form method="POST" action="/admin/tickets/opdaterSag.php">
                                        <fieldset>
                                            <input type="hidden" name="sagsID" value="<?php echo Input::get('id'); ?>">
                                            <div class="form-group form-row">
                                                <label for="inputOprettetAf">Oprettet af (Auto)</label>
                                                <input type="text" class="form-control" id="eksempelInputOprettetAf" placeholder="Oprettet af" value="<?php echo $currentTicket['modtagerNavn']; ?>" readonly="">
                                                <input type="hidden"name="id" value="<?php echo $currentTicket['modtagerID']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label" for="inputKategori">Kategori</label>
                                                <select class="form-control" id="inputKategori" name="kategori" required>
                                                    <?php $ticket->getAllSelectedKategorier(Input::get('id')); ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label" for="inputStatus">Status</label>
                                                <select class="form-control" id="inputStatus" name="status" required>
                                                    <?php echo $ticket->getAllSelectedStatus(Input::get('id')); ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label" for="inputPriortet">Prioritet</label>
                                                <select class="form-control" id="inputPriortet" name="priortet" required>
                                                    <?php echo $ticket->getAllSelectedPriortet(Input::get('id')); ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputProduktNavn">Navn på produkt</label>
                                                <input type="text" class="form-control" id="eksempelProduktNavn" name="produktNavn" placeholder="Produkt navn" value="<?php echo $currentTicket['produktNavn']; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputProduktModel">Model-navn/nr. på produkt</label>
                                                <input type="text" class="form-control" id="eksempelProduktModel" name="produktModel" placeholder="Produkt model" value="<?php echo $currentTicket['produktModel']; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputProduktFejlbeskrivelse">Fejlbeskrivelse</label>
                                                <textarea type="text" class="form-control" id="eksempelProduktFejlbeskrivelse" rows="6" name="produktFejlbeskrivelse" placeholder="Fejlbeskrivelse"><?php echo $currentTicket['produktFejlbeskrivelse']; ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputKontakNavn">Kontaktpersonens navn</label>
                                                <input type="text" class="form-control" id="eksempelKontakNavn" name="kontaktNavn" placeholder="Kontaktpersonenens navn" value="<?php echo $currentTicket['kontaktNavn']; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputKontakEmail">Kontaktpersonens e-mail</label>
                                                <input type="email" class="form-control" id="eksempelKontakEmail" name="kontaktEmail" placeholder="Kontaktpersonenens e-mail" value="<?php echo $currentTicket['kontaktEmail']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="inputKontakTelefon">Kontaktpersonens tlf. nr.</label>
                                                <input type="text" class="form-control" id="eksempelKontakTelefon" name="kontaktTelefon" placeholder="Kontaktpersonenens telefon nr." value="<?php echo $currentTicket['kontaktTlf']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="inputRepareretID">Udført af</label>
                                                <select class="form-control" id="inputRepareretID" name="repareretID" required>
                                                    <?php echo $ticket->getSelectedUsers(Input::get('id')); ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputRepareretDato">Udførelses dato</label>
                                                <br />
                                                <input type="datetime-local" id="inputRepareretDato" name="repareretDato" value="<?php echo $currentTicket['repareretDato2']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="inputRepareretBeskrivelse">Beskrivelse af udført arbejde</label>
                                                <textarea rows="6" type="text" class="form-control" id="eksempelRepareretBeskrivelse" name="repareretBeskrivelse" placeholder="Reparations beskrivelse"><?php echo $currentTicket['repareretBeskrivelse']; ?></textarea>
                                            </div>
                                            <div class="form-group form-row">    
                                                <div class="col">
                                                    <button class="btn btn-outline-success full-width" type="submit">Opdater sag</button>
                                                </div>
                                                <div class="col">
                                                    <a class="btn btn-outline-danger full-width" href="/admin/tickets/">Tilbage</a>
                                                </div>
                                                <div class="col">
                                                    <a class="btn btn-outline-info full-width" rel="noopener noreferrer" target="_blank" href="/admin/tickets/print/indlevering.php?ticketID=<?php echo Input::get('id'); ?>">Service Seddel (Indlevering)</a>
                                                </div>
                                                <div class="col">
                                                    <a class="btn btn-outline-info full-width" rel="noopener noreferrer" target="_blank" href="/admin/tickets/print/afhent.php?ticketID=<?php echo Input::get('id'); ?>">Service Seddel (Afhentning)</a>
                                                </div>
                                            </div>
                                            
                                        </fieldset>
                                    </form>
                                </div>
                            </div>

<?php include_once "../../assets/tpl/cases_footer.php"; ?>