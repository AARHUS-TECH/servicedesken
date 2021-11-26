<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Servicedesken | Aarhus Tech SKP</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

    <!-- link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css" -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
                            <input type="hidden" id="sorting" name="sorting" value="<?php echo htmlspecialchars($_POST["sorting"]); ?>">
                            <input type="hidden" id="direction" name="direction" value="<?php echo htmlspecialchars($_POST["direction"]); ?>">
                        </form>

                        <div class="input-group" style="margin-bottom: 10px;">
                            <input id="searchtext" type="search" class="form-control rounded" placeholder="Søgetekst" aria-label="Søgetekst"
                            aria-describedby="search-addon" />
                            <button onclick="document.location=('search.php?searchtext=' + document.getElementById('searchtext').value ) + '&scope=all';" type="button" class="btn btn-outline-primary" style="margin-left: 10px;">s&oslash;g</button>
                        </div>

                        <script>
                        function setFilters(sorting) 
                        {
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
                                // If the field is empty
                                document.getElementById('sorting').value = sorting;
                                document.getElementById('direction').value = "ASC";
                            }
                    
                            document.getElementById('form1').submit();
                        }
                        </script>

                        <table class="table table-hover" style="color: white;">
                            <thead style="background-color: #444;">
                            <tr>
                                <th scope="col" style="white-space: nowrap;">Oprettet d. <a style="text-decoration: none;" href="#" onClick="setFilters('modtager_dato')">&udarr;</a></th>
                                <th scope="col" style="white-space: nowrap;">Prioritet <a style="text-decoration: none;" href="#"   onClick="setFilters('priortet')">&udarr;</a></th>
                                <th scope="col" style="width: 150px;">Status <a style="text-decoration: none;" href="#"             onClick="setFilters('status')">&udarr;</a></th>
                                <th scope="col" style="white-space: nowrap;">Kategori <a style="text-decoration: none;" href="#"                                 onClick="setFilters('sags_kategori')">&udarr;</a></th>
                                <th scope="col" style="width: 400px;">Fejlbeskrivelse <a style="text-decoration: none;" href="#"    onClick="setFilters('produkt_fejlbeskrivelse')">&udarr;</a></th>
                                <th scope="col" style="white-space: nowrap;">Kundenavn <a style="text-decoration: none;" href="#"                                onClick="setFilters('kontakt_navn')">&udarr;</a></th>
                            </tr>
                            </thead>
                            <tbody>
