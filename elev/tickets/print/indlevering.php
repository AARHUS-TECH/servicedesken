<?php
require_once('../../../core/init.php');
$ticket = new Tickets();

$currentTicket = $ticket->getTicket(Input::get('ticketID'));

$indlevDato = date('d-m-Y', strtotime($currentTicket['modtagerDato'])); 

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Service Seddel</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="/assets/css/service.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/assets/css/AdminLTE.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->


    <style>
        @media print {
            .wrapper {
                display: inline;
            }
        }
    </style>
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body onload="">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          SKP Service Seddel | Indlevering
          <small class="pull-right">Dato: <?php echo $indlevDato; ?></small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        <address>
          <strong>Indleveret af</strong><br>
          <?php echo $currentTicket['kontaktNavn']; ?><br>
          Tlf. <?php echo $currentTicket['kontaktTlf']; ?><br>
          E-mail: <?php echo $currentTicket['kontaktEmail']; ?>
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <address>
          <strong>Modtaget af</strong><br>
          <?php echo $currentTicket['modtagerNavn']; ?><br>
          Tlf. <?php echo Config::get('servicedesk/telefon'); ?><br>
          E-mail: <?php echo Config::get('servicedesk/email'); ?>
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <b>Oplysninger</b><br>
        <br>
        <b>Sags ID:</b> <?php echo $currentTicket['sagsID']; ?><br>
        <b>Prioritet:</b> <?php echo $currentTicket['priortet']; ?><br>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <p class="lead">Følgende er indleveret:</p>
          <tr>
            <th>Antal</th>
            <th>Produkt</th>
            <th>Model</th>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td><?php echo $currentTicket['produktAntal']; ?></td>
            <td><?php echo $currentTicket['produktNavn']; ?></td>
            <td><?php echo $currentTicket['produktModel']; ?></td>
          </tr>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row" style="page-break-after: auto;">
      <div class="col-xs-12 table-responsive">
        <p class="lead">Fejlbeskrivelse:</p>
        <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
          <?php echo nl2br($currentTicket['produktFejlbeskrivelse']); ?>
        </p>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <p class="lead">Betingelser for indlevering:</p>
        <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
            <?php 
                $betingelser = file_get_contents('../../../betingelser.html');
                echo $betingelser;
            ?>
        </p>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
        <div class="col-xs-12 table-responsive">
        <p class="lead">Underskrift</p>
        <table class="table">
        <tbody>
        <tr>
          <td style="border: none; width: 48%;"><b>Kunde:</b></td>
          <td style="border: none; width: 4%;">&nbsp;</td>
          <td style="border: none; width: 48%;"><b>Godkendt af:</b></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td style="border: none;">&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        </tbody>
      </table>

      <table class="table">
        <tbody>
        <tr>
          <td style="border: none; width: 48%;">Dato:</td>
          <td style="border: none; width: 4%;">&nbsp;</td>
          <td style="border: none; width: 48%;">Dato:</td>
        </tr>
        </tbody>
      </table>
      </div>
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->

<script src="/assets/js/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () { window.print(); });
</script>
</body>
</html>
