<?php
include 'db_connect.php';
include 'config.php';

define("GET_USER_INFORMATION_QUERY", "SELECT * FROM user WHERE username = :userName ");

define("GET_USER_DIAGNOSIS_SINCE_QUERY", "SELECT DISTINCT D.diagnosis_name AS diagnosis_name, D.diagnosis_accuracy AS diagnosis_accuracy, D.timestamp AS timestamp 
FROM user JOIN SymptomChecker JOIN SymptomChecker_Results AS D
WHERE user.id = SymptomChecker.userid AND D.diagnosis_accuracy > 0.7 AND user.username = :userName AND timestamp > :startDate  AND D.symptomChecker = SymptomChecker.id ");


define("GET_USER_THERAPY_QUERY","SELECT T.name AS therapyName, T.dosage AS dosage , T.start_date AS start_date, T.end_date AS end_date, T.type AS type, T.drug_name AS drug_name, T.interval_days AS interval_days, TD.day, TH.hour
FROM user JOIN Therapy AS T LEFT JOIN Therapy_Day AS TD ON T.id = TD.therapy LEFT JOIN Therapy_Hour AS TH ON T.id = TH.therapy
WHERE user.id = T.userid AND T.done = 1 AND T.visible = 1 AND user.username = :userName ");

define("GET_USER_ANALYSIS_LAST_QUERY", "SELECT T.result AS result, T.min AS min, T.max AS max, T.unit AS unit, T.name as analysisName, Tracking.last_update as timestamp
FROM user JOIN Tracking JOIN Tracking_ExamsOCR AS T
WHERE user.id = Tracking.userid AND Tracking.id = T.tracking_id AND user.username =  :userName
AND Tracking.date = (SELECT MAX(Tracking.date) FROM user JOIN Tracking WHERE user.id = Tracking.userid AND user.username =  :userName AND Tracking.visible = 1 ) AND Tracking.visible = 1");

define("GET_USER_MEDICAL_AREA_QUERY", "SELECT DISTINCT M.medicalArea 
FROM user JOIN SuggestDoctor JOIN SuggestDoctor_ClassifierResultSearch AS M 
WHERE user.id = SuggestDoctor.userid AND M.suggestDoctor = SuggestDoctor.id AND user.username = :userName ");

define("GET_USER_ANALYSIS_ALL_QUERY", "SELECT T.result AS result, T.min AS min, T.max AS max, T.unit AS unit, T.name as analysisName, Tracking.last_update as timestamp
FROM user JOIN Tracking JOIN Tracking_ExamsOCR AS T
WHERE user.id = Tracking.userid AND Tracking.id = T.tracking_id AND user.username =  :userName AND Tracking.visible = 1 ");

define("GET_USER_THERAPY_SINCE_QUERY", "SELECT T.name AS therapyName, T.dosage AS dosage , T.start_date AS start_date, T.end_date AS end_date, T.type AS type, T.drug_name AS drug_name, T.interval_days AS interval_days, TD.day, TH.hour
FROM user JOIN Therapy AS T LEFT JOIN Therapy_Day AS TD ON T.id = TD.therapy LEFT JOIN Therapy_Hour AS TH ON T.id = TH.therapy
WHERE user.id = T.userid AND T.done = 1 AND T.visible = 1 AND user.username = :userName AND T.start_date >= :startDate ");

define("GET_USER_ANALYSIS_SINCE_QUERY", "SELECT T.result AS result, T.min AS min, T.max AS max, T.unit AS unit, T.name as 
analysisName, Tracking.last_update as timestamp
FROM user JOIN Tracking JOIN Tracking_ExamsOCR AS T
WHERE user.id = Tracking.userid AND Tracking.id = T.tracking_id AND user.username = :userName
AND Tracking.last_update >= :startDate AND Tracking.visible = 1 ");

define("GET_USER_DIAGNOSIS_QUERY", "SELECT DISTINCT D.diagnosis_name AS diagnosis_name, D.diagnosis_accuracy AS diagnosis_accuracy, D.timestamp AS timestamp 
FROM user JOIN SymptomChecker JOIN SymptomChecker_Results AS D
WHERE user.id = SymptomChecker.userid AND D.diagnosis_accuracy > 0.7 AND user.username = :userName AND D.symptomChecker = SymptomChecker.id ");

class Response {

    var $message;
    var $code;

    function __construct( $message, $code) {
        $this->message = $message;
        $this->code = $code;
    }
}
function getUserTherapy( $userName)
{
    global $connection;
    $stmt = $connection->prepare(GET_USER_THERAPY_QUERY);
    $stmt->bindValue(':userName', $userName);
    $stmt->execute();
    $response = $stmt->fetchAll(PDO::FETCH_ASSOC );
    return $response;
}

function getUserInfo( $userName)
{
    global $connection;
    $stmt = $connection->prepare(GET_USER_INFORMATION_QUERY);
    $stmt->bindValue(':userName', $userName);
    $stmt->execute();
    $response = $stmt->fetchAll(PDO::FETCH_ASSOC );
    return $response;
}

function getUserTherapySince( $userName, $startDate)
{
    global $connection;
    $stmt = $connection->prepare(GET_USER_THERAPY_SINCE_QUERY);
    $stmt->bindValue(':userName', $userName);
    $stmt->bindValue(':startDate', $startDate);
    $stmt->execute();
    $response = $stmt->fetchAll(PDO::FETCH_ASSOC );
    return $response;
}

function getUserMedicalArea( $userName)
{
    global $connection;
    $stmt = $connection->prepare(GET_USER_MEDICAL_AREA_QUERY);
    $stmt->bindValue(':userName', $userName);
    $stmt->execute();
    $response = $stmt->fetchAll(PDO::FETCH_ASSOC );
    return $response;
}

function getUserAnalysisAll( $userName)
{
    global $connection;
    $stmt = $connection->prepare(GET_USER_ANALYSIS_ALL_QUERY);
    $stmt->bindValue(':userName', $userName);
    $stmt->execute();
    $response = $stmt->fetchAll(PDO::FETCH_ASSOC );
    $array = array(); 
    foreach ($response as $row) {
        $name = explode('(', $row['analysisName']);
        if (isset($name[1])){
            $name[1] = str_replace(")", "", $name[1]);
            $row['acronym'] = $name[1];

        }
        else {
            $row['acronym'] = "null";
        }
        $row['analysisName'] = $name[0];
        $array[] = $row;
    }
    return $array;
}

function getUserAnalysisLast( $userName)
{
    global $connection;
    $stmt = $connection->prepare(GET_USER_ANALYSIS_LAST_QUERY);
    $stmt->bindValue(':userName', $userName);
    $stmt->execute();
    $response = $stmt->fetchAll(PDO::FETCH_ASSOC );
     $array = array(); 
    foreach ($response as $row) {
        $name = explode('(', $row['analysisName']);
        if (isset($name[1])){
            $name[1] = str_replace(")", "", $name[1]);
            $row['acronym'] = $name[1];

        }
        else {
            $row['acronym'] = "null";
        }
        $row['analysisName'] = $name[0];
        $array[] = $row;
    }
    return $array;
}

function getUserAnalysisSince( $userName, $startDate)
{
    global $connection;
    $stmt = $connection->prepare(GET_USER_ANALYSIS_SINCE_QUERY);
    $stmt->bindValue(':userName', $userName);
    $stmt->bindValue(':startDate', $startDate);
    $stmt->execute();
    $response = $stmt->fetchAll(PDO::FETCH_ASSOC );
     $array = array(); 
    foreach ($response as $row) {
        $name = explode('(', $row['analysisName']);
        if (isset($name[1])){
            $name[1] = str_replace(")", "", $name[1]);
            $row['acronym'] = $name[1];

        }
        else {
            $row['acronym'] = "null";
        }
        $row['analysisName'] = $name[0];
        $array[] = $row;
    }
    return $array;
}

function getUserDiagnosis( $userName)
{
    global $connection;
    $stmt = $connection->prepare(GET_USER_DIAGNOSIS_QUERY);
    $stmt->bindValue(':userName', $userName);
    $stmt->execute();
    $response = $stmt->fetchAll(PDO::FETCH_ASSOC );
    $array = array(); 
    foreach ($response as $row) {

        $diag_name = explode("/", $row['diagnosis_name']);
        $row['diagnosis_name']= str_replace("-", " ", $diag_name[4]);

        $array[] = $row;
    }
     return $array;
}

function getUserDiagnosisSince( $userName, $startDate)
{
    global $connection;
    $stmt = $connection->prepare(GET_USER_DIAGNOSIS_SINCE_QUERY);
    $stmt->bindValue(':userName', $userName);
    $stmt->bindValue(':startDate', $startDate);
    $stmt->execute();
    $response = $stmt->fetchAll(PDO::FETCH_ASSOC );
    $array = array(); 
    foreach ($response as $row) {

        $diag_name = explode("/", $row['diagnosis_name']);
        $row['diagnosis_name']= str_replace("-", " ", $diag_name[4]);

        $array[] = $row;
    }
     return $array;
}


?>





