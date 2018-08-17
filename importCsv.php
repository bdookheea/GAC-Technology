<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
</html>

<?php
include "config.php";

// Button import
if (isset($_POST["Import"])) {
    $fieldseparator = ";"; 
    $lineseparator  = "\n";
    $csvfile        = "tickets_appels_201202.csv";

    // Calcul de tous les valeurs dans la table ticket_appel
    $rowsInTable = $pdo->query("SELECT count(*)
                                FROM ticket_appel")->fetchColumn();

    // Si le total est plus que zéro,effacer les données existants pour ré-insérer à nouveau les données du csv
    if ($rowsInTable > 0) {
        $deleteData = $pdo->prepare("DELETE
                                     FROM ticket_appel");
    	$deleteData->execute();
    }

    $affectedRows = $pdo->exec("LOAD DATA LOCAL INFILE ".$pdo->quote($csvfile)."
                                INTO TABLE `ticket_appel`
                                FIELDS TERMINATED BY ".$pdo->quote($fieldseparator)."
                                LINES TERMINATED BY ".$pdo->quote($lineseparator)."
                                IGNORE 3 LINES"."
                                (Compte_facture, No_facture, No_abonne, @Date_facturation, Heure_facturation, Duree_volume_reel, Duree_volume_facturee, Type_facturation)"."
                                SET Date_facturation = cast(concat(substring(@Date_facturation,7,4),'-',substring(@Date_facturation,4,2),'-',substring(@Date_facturation,1,2)) as date)");

    if (!isset($affectedRows)) {
        echo "<script type=\"text/javascript\">
              alert(\"Fichier Invalide\");
              window.location = \"index.php\"
              </script>";
    }

    $msg = $affectedRows." lignes ont été insérés avec succès";

    echo "<script type=\"text/javascript\">
          alert('".$msg."');
          window.location = \"index.php\"
          </script>";
}

// Question 1
if (isset($_POST["query1"])) {
    $sum = 0;
    $query1 = $pdo->prepare("SELECT TIME_TO_SEC(CAST(Duree_volume_reel AS TIME)) AS duration
                             FROM ticket_appel
                             WHERE Type_facturation 
                             LIKE '%appel%'
                             AND Date_facturation >= '2012-02-15'");
    $query1->execute();

    if ($query1->rowCount()>0) {
        while($row = $query1->fetch(PDO::FETCH_ASSOC)){
              $sum= $sum + $row['duration'];
        }

        $message = "La Durée Totale Réelle des appels effectués après le 15/02/2012(inclus) : " .ConvertsecToHour($sum);
        FileSuccessfulUpload($message);
    } else {
        // Erreur Fichier pas encore importer
        FileNotUploadedMessage();
    }
}

// Fonction pour la conversion de secondes à Heures:Minutes:Secondes
function ConvertsecToHour($seconds) {
    $hours   = floor($seconds / 3600);
    $minutes = floor(($seconds / 60) % 60);
    $seconds = $seconds % 60;
    return "$hours:$minutes:$seconds";
}

// Fonction pour alerter les résultats en cas de succès
function FileSuccessfulUpload($message) {
    echo "<div class='alert alert-success' role='alert'>";
    echo $message;
    echo "<div>";
}

// Fonction pour faire l'import pour avoir les résultats des questions
function FileNotUploadedMessage(){
    $msg = "Veuillez faire l\'import pour avoir la réponse au question";
    echo "<script type=\"text/javascript\">
          alert('$msg');
          window.location = \"index.php\"
          </script>";
}

// Question 2
if (isset($_POST["query2"])) {
    $query2 = $pdo->prepare("SELECT Compte_facture,No_abonne,Heure_facturation
                             FROM ticket_appel 
                             WHERE Heure_facturation NOT BETWEEN '08:00' AND '18:00'
                             GROUP BY No_abonne
                             ORDER BY No_abonne
                             LIMIT 10");

    $query2->execute();

    echo "<div style='padding:10px;font-weight:bold;'>";
    echo "Le TOP 10 des volumes data facturés en dehors de la tranche horaire 8h00-18h00, par abonné: ";
    echo "<div>";

    if ($query2->rowCount()>0) {
        echo "<div class='table-responsive'><table align='center' class='table table-striped'style='width:60%;'>";
        echo "<tr>";
        echo "<th>Compte_facturé</th>";
        echo "<th>No_abonné</th>";
        echo "<th>Heure_facturation</th>";
        echo "</tr>";

        foreach( $query2 as $row ){
            echo "<tr><td>";
            echo $row['Compte_facture'];
            echo "</td><td>";
            echo $row['No_abonne'];
            echo "</td><td>";
            echo $row['Heure_facturation'];
            echo "</td>";
            echo "</tr>";
        }
        echo "</table></div>";
    } else {
        // Erreur Fichier pas encore importer
        FileNotUploadedMessage();
    }
}

// Question 3
if (isset($_POST["query3"])) {
    $query3 = $pdo->query("SELECT COUNT(Type_facturation) AS sms
                           FROM ticket_appel
                           WHERE Type_facturation 
                           LIKE '%sms%'")->fetch();

    if ($query3['sms'] == 0) {
        // Erreur Fichier pas encore importer
         FileNotUploadedMessage();
    } else {
        $message = "Quantite Total de SMS envoyes par l'ensemble des abonnés: " . $query3['sms'];
        FileSuccessfulUpload($message);
    }
}

?>




