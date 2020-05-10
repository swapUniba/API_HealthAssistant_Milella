<?php

// Actions

define("ACTION","action");
define("ACTION_GET_THERAPY", "actionGetTherapy");
define("ACTION_GET_THERAPY_SINCE", "actionGetTherapySince");
define("ACTION_GET_ANALYSIS_LAST", "actionGetAnalysisLast");
define("ACTION_GET_ANALYSIS_SINCE", "actionGetAnalysisSince");
define("ACTION_GET_ANALYSIS_ALL", "actionGetAnalysisAll");
define("ACTION_GET_MEDICAL_AREA", "actionGetMedicalArea");
define("ACTION_GET_DIAGNOSIS","actionGetDiagnosis" );
define("ACTION_GET_USER_INFO", "actionGetUserInfo");
define("ACTION_GET_DIAGNOSIS_SINCE","actionGetDiagnosisSince" );


define("ACTION_NOT_DEFINED_TEXT", "Action not defined");
define("ACTION_NOT_DEFINED_CODE", 101);

// DB keys

define("USER_NAME", "username");
define("START_DATE", "startdate");

define("KEY_USER_ID", "userID");
define("KEY_USER_NAME", "name");
define("KEY_USER_SURNAME", "surname");
define("KEY_USER_SERIAL_NUMBER", "serialNumber");
define("KEY_DEGREECOURSE", "degreecourse");
define("KEY_USER_PASSWORD", "password");
define("KEY_USER_REGISTRATION_DATE", "registrationDate");
define("KEY_USER_ROLE_NAME", "roleName");
define("KEY_USER_EMAIL", "email");
define("KEY_TIME", "time");
define("KEY_CLASS_ID", "classID");
define("KEY_QUESTION", "question");
define("KEY_QUESTION_ID", "questionID");
define("KEY_QUESTION_RATE", "rate");
define("KEY_CLASS_LESSON_ID", "lessonID");
define("KEY_CLASS_LESSON_ATTENDANCE", "attendance");
define("KEY_CLASS_LESSON_REVIEW_SUMMARY", "reviewSummary");
define("KEY_CLASS_LESSON_REVIEW_TEXT", "reviewText");
define("KEY_CLASS_LESSON_REVIEW_RATING", "reviewRating");
define("KEY_LESSON_DATE", "lessonDate");
define("KEY_CURRENT_TIME", "currentTime");

// Response

define("QUERY_OK_TEXT", "Query ok");
define("QUERY_OK_CODE", 100);
define("QUERY_NOT_OK_TEXT", "Query not ok");
define("QUERY_NOT_OK_CODE", 101);

define("USER_CREATED_TEXT", "User has been created.");
define("USER_CREATED_CODE", 202);

define("USER_NOT_CREATED_CODE", 204);
define("USER_NOT_CREATED_TEXT", "User has not been created.");

define("INVALID_PASSWORD_TEXT", "Invalid password.");
define("INVALID_PASSWORD_CODE", 301);

define("INVALID_EMAIL_TEXT", "Email not registered.");
define("INVALID_EMAIL_CODE", 303);

define("MISSING_MANDATORY_PARAMETERS_TEXT", "Missing mandatory parameters.");
define("MISSING_MANDATORY_PARAMETERS_CODE", 304);

define("USER_ALREADY_EXISTS_TEXT", "Email already in use");
define("USER_ALREADY_EXISTS_CODE", 305);







?>
