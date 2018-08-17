<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <h1 align="center">Exercise d'évaluation technique – GAC Technology</h1>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
    <div id="wrap">
        <div class="container">
            <div class="row">
                <form class="form-horizontal" action="importCsv.php" method="post" enctype="multipart/form-data">
                    <fieldset style="box-shadow:0 0 10px #999; border-radius:8px; border:1px solid #999; padding-top:10px;">
 
                        <div class="form-group">
                            <label class="col-md-6 control-label" for="singlebutton">Charger le CSV</label>
                                <button type="submit" id="submit" value="Import" name="Import" class="btn btn-primary button-loading">Import des données</button>
                        </div>

                        <div class="form-group">
                            <label class="col-md-6 control-label" for="singlebutton">Quest 1</label>
                                <button type="submit" id="submit" value="query1" name="query1" class="btn btn-primary button-loading">Question 1</button>
                        </div>

                        <div class="form-group">
                            <label class="col-md-6 control-label" for="singlebutton">Quest 2</label>
                                <button type="submit" id="submit" value="query2" name="query2" class="btn btn-primary button-loading">Question 2</button>
                        </div>

                       <div class="form-group">
                            <label class="col-md-6 control-label" for="singlebutton">Quest 3</label>
                                <button type="submit" id="submit" value="query3" name="query3" class="btn btn-primary button-loading">Question 3</button>
                        </div>

                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</body>

</html>




