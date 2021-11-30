<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Servicedesken | Aarhus Tech SKP</title>

        <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="/assets/css/custom.css">
        <script src="https://kit.fontawesome.com/6933752704.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="container">
            <div class="col-md-12" style="margin-top: 50px;">
                <?php echo Errors::getErrorMessage('dashboard_error'); ?>
                <?php echo Errors::getSuccessMessage('dashboard_success'); ?>

                <div class="row">
                    <div class="card border-success col-md-12">
                        <div class="card-body">
                            <h3 class="text-center">SERVICEDESKEN - BRUGER SYSTEM</h3>
                            <blockquote class="card-blockquote">
                            <p class="text-center"><b>Logget ind som:</b> <?php echo $userdata['navn']; ?></p>
                            <form method="post" action="/">
                                <fieldset>
                                    <div class="form-group form-row text-center">
                                        <div class="col">
                                            <a class="btn btn-outline-success full-width" href="/admin/bruger/opretBruger.php">Opret bruger</a>
                                        </div>
                                        <div class="col">
                                            <a class="btn btn-outline-danger full-width" href="/admin/">Tilbage</a>
                                        </div>
                                        <div class="col">
                                            <a class="btn btn-outline-warning full-width" href="logout.php">Log ud</a>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>

                            <table class="table table-hover table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Navn</th>
                                    <th>Brugernavn</th>
                                    <th>Rolle</th>
                                    <th>Handlinger</th>
                                </tr>
                            </thead>
                            <tbody>