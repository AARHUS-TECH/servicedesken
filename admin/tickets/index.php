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

if(!Session::exists('userID')) {
    Session::flash('index_error', 'Du skal være logget ind for at kunne tilgå denne side!');
    Redirect::to('/');
}/* else if (Session::exists('userID') && !$user->isAdmin(Session::get('userID'))) {
    Session::flash('dashboard_error', 'Du skal være admin for at kunne tilgå denne side!');
    Redirect::to('/elev/');
}*/

// Getting sorting by field and sorting direction
if ($_REQUEST['sorting']) # change currency on user request
{
    $sorting = $_REQUEST['sorting']; # use it
    setcookie('sorting', $_REQUEST['sorting'], 0, 'http://servicedesken.skp/admin/tickets/'); # store it

    if($_REQUEST['direction'])
        $direction = $_REQUEST['direction'];
    else
        $direction = "ASC";


    if($sorting == "modtager_dato")
    {
        $sql = "ORDER BY servicedesk_sager.modtager_dato $direction, servicedesk_sager.status ASC, servicedesk_sager.sags_kategori ASC";
    }
    elseif ($sorting == "priortet") 
    {
        $sql = "ORDER BY servicedesk_sager.priortet $direction, servicedesk_sager.status ASC, servicedesk_sager.sags_kategori ASC, servicedesk_sager.sagsID DESC";
    }    
    elseif ($sorting == "status") 
    {
        $sql = "ORDER BY servicedesk_sager.status $direction, servicedesk_sager.priortet DESC";
    }
    elseif ($sorting == "sags_kategori") 
    {
        $sql = "ORDER BY servicedesk_sager.sags_kategori $direction, servicedesk_sager.priortet ASC, servicedesk_sager.status ASC, servicedesk_sager.sags_kategori ASC";
    }
    elseif ($sorting == "produkt_fejlbeskrivelse") 
    {
        $sql = "ORDER BY servicedesk_sager.produkt_fejlbeskrivelse $direction, servicedesk_sager.priortet DESC, servicedesk_sager.status ASC, servicedesk_sager.sags_kategori ASC";
    }
    elseif ($sorting == "kontakt_navn") 
    {
        $sql = "ORDER BY servicedesk_sager.kontakt_navn $direction, servicedesk_sager.priortet DESC, servicedesk_sager.status ASC, servicedesk_sager.sags_kategori ASC";
    }
}
else # use default
{
    $sql = "ORDER BY servicedesk_sager.priortet DESC, servicedesk_sager.status ASC, servicedesk_sager.sags_kategori ASC";
}

$userdata = $user->getInfo(Session::get('userID'));

include_once "../../assets/tpl/cases_header.php";
$ticket->getAllAdminTickets($sql);
include_once "../../assets/tpl/cases_footer.php";

?>