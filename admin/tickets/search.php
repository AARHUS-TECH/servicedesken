<?php
/**
 * This file is part of the ATS DataIT Servicedesk Ticketsystem package.
 *
 * @file        Config.php
 * @author      Karsten Reitan Sørensen <krs@aarhustech.dk>
 * @copyright   AARHUS TECH DataIT Skoleoplæring 2017-2022
 * @license     MIT, please view the LICENSE file
 * 
 * @brief       Class handling config setting into globals
 */



require_once('../../core/init.php');

$ticket = new Tickets();

$searchtext = ($_REQUEST['searchtext'])?$_REQUEST['searchtext']:"";
$scope = ($_REQUEST['scope'])?$_REQUEST['scope']:"";


$sql = "SELECT * FROM servicedesk_sager 
            WHERE produkt_navn LIKE '%$searchtext%' 
            OR produkt_model LIKE '%$searchtext%' 
            OR kontakt_navn LIKE '%$searchtext%' 
            OR produkt_fejlbeskrivelse LIKE '%$searchtext%' 
            ORDER BY modtager_dato DESC
        ";

include_once "../../assets/tpl/cases_header.php";
$ticket->getSortingResult($sql);
echo "<script>document.getElementById('searchtext').value='$searchtext'</script>";

include_once("../../assets/tpl/cases_footer.php");

?>