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
                        <form method="post" action="" name="form1" id="form1">
                            <fieldset>
                                <div class="form-group form-row text-center">
                                    <div class="col">
                                        <a class="btn btn-outline-success full-width" href="/admin/tickets/opretSag.php">Opret ny sag</a>
                                    </div>
                                    <div class="col" id="closed-cases">
                                        <a id="closed-cases-link" class="btn btn-outline-success full-width" href="/admin/tickets/lukkedeSager.php">Lukkede sager</a>
                                    </div>
                                    <div class="col">
                                        <a class="btn btn-outline-danger full-width" href="/admin/">Tilbage</a>
                                    </div>
                                    <div class="col">
                                        <a class="btn btn-outline-warning full-width" href="logout.php">Log ud</a>
                                    </div>
                                </div>
                            </fieldset>
                            <input type="text" id="sorting" name="sorting" value="<?php echo htmlspecialchars($_POST["sorting"]); ?>">
                            <input type="text" id="direction" name="direction" value="<?php echo htmlspecialchars($_POST["direction"]); ?>">
                        </form>

                        <script>
                        function setFilters(sorting) {
                            // Hvis de er samme "kolonne" toogler den imellem asc og desc
                            // ellers nulstilles retningen til asc
                            if(document.getElementById('sorting').value == sorting)
                            {
                                //Toogle sorting direction
                                if(document.getElementById('direction').value == "ASC")
                                    document.getElementById('direction').value = "DESC";
                                else
                                    document.getElementById('direction').value = "ASC";
                            }
                            else
                            {
                                document.getElementById('sorting').value = sorting;
                                document.getElementById('direction').value = "ASC";
                            }
                    

                            document.getElementById('form1').submit();
                        }
                        </script>

                        <table class="table table-hover table-bordered">
                            <thead class="thead-dark">
                            <tr>
                                <th style="white-space: nowrap;">Oprettet d. <a style="text-decoration: none;" href="#" onClick="setFilters('modtager_dato')">&udarr;</a></th>
                                <th style="white-space: nowrap;">Prioritet <a style="text-decoration: none;" href="#"   onClick="setFilters('priortet')">&udarr;</a></th>
                                <th style="width: 150px;">Status <a style="text-decoration: none;" href="#"             onClick="setFilters('status')">&udarr;</a></th>
                                <th>Kategori <a style="text-decoration: none;" href="#"                                 onClick="setFilters('sags_kategori')">&udarr;</a></th>
                                <th style="width: 400px;">Fejlbeskrivelse <a style="text-decoration: none;" href="#"    onClick="setFilters('produkt_fejlbeskrivelse')">&udarr;</a></th>
                                <th>Kundenavn <a style="text-decoration: none;" href="#"                                onClick="setFilters('kontakt_navn')">&udarr;</a></th>
                            </tr>
                            </thead>
                            <tbody>
