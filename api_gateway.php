<?php
include 'functions.php';

error_reporting(E_ALL);

//Get the input request parameters
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE); //convert JSON into array

if(isset($input[ACTION])){  
    switch($input[ACTION]) {
        case ACTION_GET_THERAPY: 
            $response = getUserTherapy($input[USER_NAME]);
            break;
        case ACTION_GET_THERAPY_SINCE:
            $response = getUserTherapySince($input[USER_NAME], $input[START_DATE]);
            break;
        case ACTION_GET_ANALYSIS_LAST:
            $response = getUserAnalysisLast($input[USER_NAME]);
            break;
        case ACTION_GET_ANALYSIS_ALL:
            $response = getUserAnalysisAll($input[USER_NAME]);
            break;
        case ACTION_GET_ANALYSIS_SINCE:
             $response = getUserAnalysisSince($input[USER_NAME],$input[START_DATE]);
             break;
        case ACTION_GET_MEDICAL_AREA:
            $response = getUserMedicalArea($input[USER_NAME]);
            break;
        case ACTION_GET_DIAGNOSIS:
            $response = getUserDiagnosis($input[USER_NAME]);
            break;
        case ACTION_GET_USER_INFO:
            $response = getUserInfo($input[USER_NAME]);
            break;
        case ACTION_GET_DIAGNOSIS_SINCE:
            $response = getUserDiagnosisSince($input[USER_NAME],$input[START_DATE]);
            break;
        default:
            $response = new Response(ACTION_NOT_DEFINED_TEXT, ACTION_NOT_DEFINED_CODE); 
            break;
    }
} else {
    $message = $input[ACTION] + " - " + ACTION_NOT_DEFINED_TEXT;
    $response = new Response($message, ACTION_NOT_DEFINED_CODE); 
}
echo json_encode($response);

?>
