<?php
require_once('../../core/init.php');

$ticket = new Tickets();

$searchtext = ($_REQUEST['searchtext'])?$_REQUEST['searchtext']:"";
$scope = ($_REQUEST['scope'])?$_REQUEST['scope']:"";


echo "searchtext: $searchtext<br/>";
echo "scope: $scope<br/>";
echo "Søgeresultat<br />";

$sql = "SELECT * FROM servicedesk_sager 
            WHERE produkt_navn LIKE '%$searchtext%' 
            OR produkt_model LIKE '%$searchtext%' 
            OR kontakt_navn LIKE '%$searchtext%' 
            OR produkt_fejlbeskrivelse LIKE '%$searchtext%'";

echo $sql;

include_once "../../assets/tpl/cases_header.php";
$ticket->getSortingResult($sql);
echo "<script>document.getElementById('searchtext').value='$searchtext'</script>";

include_once("../../assets/tpl/cases_footer.php");

?>