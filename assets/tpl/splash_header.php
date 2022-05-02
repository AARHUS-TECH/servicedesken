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
        <div class="vcenter">
            <div class="col-md-6">
                <?php echo Errors::getErrorMessage('dashboard_error'); ?>
                <?php echo Errors::getSuccessMessage('dashboard_success'); ?>
                <div class="row">
                    <div class="card border-success col-md-12">
                        <div class="card-body">
                            <h3 class="text-center">SERVICEDESKEN</h3>
                            <blockquote class="card-blockquote">
                            <p class="text-center"><b>Logget ind som:</b> <?php echo $userdata['navn']; ?></p>
                            <form method="post" action="/">
                                <fieldset>
                                    <div class="form-group form-row text-center" style="padding-bottom: 0px; margin-bottom: 0px;">
                                        <div class="col" style="margin-bottom: 16px;">
                                            <a class="btn btn-outline-success full-width" href="/admin/tickets/">Ticket systemet</a>
                                        </div>
                                        <div class="col" style="margin-bottom: 16px;">
                                            <a class="btn btn-outline-success full-width" href="http://inventar.ats-skpdatait.dk/" target="_inventar_window" title="Dette åbner et nyt vindue.">Inventar systemet</a>
                                        </div>
                                    </div>
