<?php
include 'functions.php';

ini_set('display_errors', 1);
$username = "Lolrox";
$startDate = 0;
$startDate2 = "2019-12-25";
$result = json_encode( getUserAnalysisLast($username));
echo "ULTIME ANALISI";
echo "<br />";
echo($result);
echo "<br />";
echo "<br />";
echo "<br />";
echo "TUTTE LE ANALISI";
echo "<br />";
$result = json_encode( getUserAnalysisAll($username));
echo "<br />";
echo ($result);
echo "<br />";
echo "<br />";
echo "<br />";
echo "ANALISI DA UNA CERTA DATA";
echo "<br />";
$result = json_encode(getUserAnalysisSince ($username, $startDate));
echo($result);
echo "<br />";
echo "<br />";
echo "<br />";
echo "DIAGNOSI (SENZA URL E SENZA -)";
echo "<br />";
$result = json_encode(getUserDiagnosis($username));
echo($result);
echo "<br />";
echo "<br />";
echo "<br />";
echo "AREA MEDICA RICERCATA";
echo "<br />";
$result = json_encode(getUserMedicalArea($username));
echo($result);
echo "<br />";
echo "<br />";
echo "<br />";
echo "TUTTE LE TERAPIE";
echo "<br />";
$result = json_encode( getUserTherapy($username));
echo($result);
echo "<br />";
echo "<br />";
echo "<br />";
echo "TUTTE LE TERAPIE DA UNA CERTA DATA (NATALE 2019)";
echo "<br />";
$result = json_encode( getUserTherapySince($username, $startDate2));
echo($result);
echo "<br />";
echo "<br />";
echo "<br />";
echo "INFORMAZIONI DELL'UTENTE";
$result = json_encode( getUserInfo($username));
echo($result);
echo "<br />";
echo "<br />";
echo "<br />";
echo "ANALISI DA";
echo "<br />";
$startDate= 1580267552;
$result = json_encode( getUserDiagnosisSince($username,$startDate));
echo($result);

?>

