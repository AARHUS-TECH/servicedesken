<?php
require_once('../../core/init.php');

$user = new User();
$ticket = new Tickets();

if(!Session::exists('userID')) {
    Session::flash('index_error', 'Du skal være logget ind for at kunne tilgå denne side!');
    Redirect::to('/');
}/* else if (Session::exists('userID') && !$user->isAdmin(Session::get('userID'))) {
    Session::flash('dashboard_error', 'Du skal være admin for at kunne tilgå denne side!');
    Redirect::to('/elev/');
}*/

$userdata = $user->getInfo(Session::get('userID'));

include_once "../../assets/tpl/cases_header.php";
$ticket->getAllAdminTickets();
include_once "../../assets/tpl/cases_footer.php";

?>