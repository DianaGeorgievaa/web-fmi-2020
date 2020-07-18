<?php

$configs = include('database_properties.php');

define("FIRST_NAME_FIELD", "firstname", true);
define("LAST_NAME_FIELD", "lastname", true);
define("COURSE_FIELD", "course", true);
define("SPECIALTY_FIELD", "specialty", true);
define("FACULTY_NUMBER_FIELD", "faculty_number", true);
define("GROUP_FIELD", "group", true);
define("BIRTH_DATE_FIELD", "birth_date", true);
define("ZODIAC_SIGN_FIELD", "zodiac_sign", true);
define("HYPERLINK_FIELD", "hyperlink", true);
define("MOTIVATION_FIELD", "motivation", true);
define("PHOTO_FIELD", "photo", true);

$invalidFieldMessages = array(
    FIRST_NAME_FIELD => "Please insert correct firstname without any special signs.",
    LAST_NAME_FIELD => "Please insert correct lastname without any special signs.",
    COURSE_FIELD => "Please insert a number which represents your academic year.",
    SPECIALTY_FIELD => "Please insert correct specialty name without any special signs.",
    FACULTY_NUMBER_FIELD => "Please insert correct faculty number.",
    GROUP_FIELD => "Please insert a number which represents your course group.",
    BIRTH_DATE_FIELD => "Please insert a correct birth date in format yyyy-mm-dd.",
    MOTIVATION_FIELD => "Please write your motivation with length between 30 and 1024 symbols."
);

if ($_POST) {
    validateFormFields();

    $firstname = $_POST[FIRST_NAME_FIELD];
    $lastname = $_POST[LAST_NAME_FIELD];
    $course = $_POST[COURSE_FIELD];
    $speciality = $_POST[SPECIALTY_FIELD];
    $facultyNumber = $_POST[FACULTY_NUMBER_FIELD];
    $group = $_POST[GROUP_FIELD];
    $birthDate = date('Y-m-d', strtotime($_POST[BIRTH_DATE_FIELD]));
    $zodiacSign = $_POST[ZODIAC_SIGN_FIELD];
    $hyperlink = $_POST[HYPERLINK_FIELD];
    $motivation = $_POST[MOTIVATION_FIELD];
    $photo = getUploadedPhoto();

    insertCandidate($firstname, $lastname, $course, $speciality, $facultyNumber, $group, $birthDate, $zodiacSign, $hyperlink, $photo, $motivation);
}

function validateFormFields()
{
    $errors = array();
    validateFormField(FIRST_NAME_FIELD, '/^[A-Z][a-z]{1,20}/', $errors);
    validateFormField(LAST_NAME_FIELD, '/^[A-Z][a-z-]{3,25}/', $errors);
    validateFormField(COURSE_FIELD, '/^[1-6]$/', $errors);
    validateFormField(SPECIALTY_FIELD, '/^[A-Z][a-z-]{2,50}/', $errors);
    validateFormField(FACULTY_NUMBER_FIELD, '/^[1-9][0-9]{4,10}/', $errors);
    validateFormField(GROUP_FIELD, '/^([1-9]|10)$/', $errors);
    validateFormField(BIRTH_DATE_FIELD, '/^(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])-[0-9]{4}$/', $errors);
    validateFormField(MOTIVATION_FIELD, '/.{30,1024}/', $errors);

    if (count($errors) !== 0) {
        foreach ($errors as $value) {
            echo "$value <br>";
        }
        die();
    }
}

function validateFormField($formField, $fieldPattern, $errors)
{
    $inputValue = $_POST["$formField"];
    if (!$inputValue) {
        $errors[$formField] = "The field $formField is required!";
    } elseif (!preg_match($fieldPattern, $inputValue)) {
        global $invalidFieldMessages;
        $errors[$formField] = $invalidFieldMessages[$formField];
    }
}

function getDatabaseConnection()
{
    global $configs;
    $host = $configs['host'];
    $dbname = $configs['database_name'];
    $username = $configs['username'];
    $password = $configs['password'];

    $connection = new PDO("mysql:host=$host;dbname=$dbname", $username, $password) or die("The connection with the database was not  established!");
    return $connection;
}

function insertCandidate($firstname, $lastname, $course, $speciality, $facultyNumber, $group, $birthDate, $zodiacSign, $hyperlink, $photo, $motivation)
{
    global $configs;
    $table = $configs['table_name'];
    $connection = getDatabaseConnection();

    $insertCandidateQuery = "INSERT INTO $table (firstname, lastname, course, speciality, faculty_number, course_group, date_of_birth, zodiac_sign, social_link, photo, motivation)
                    VALUES 
                    (:firstname, :lastname, :course, :speciality, :facultyNumber, :group, :dateOfBirth, :zodiacSign, :hyperlink, :photo, :motivation)";

    $preparedSql = $connection->prepare($insertCandidateQuery) or die("");
    $preparedSql->bindParam(':firstname', $firstname);
    $preparedSql->bindParam(':lastname', $lastname);
    $preparedSql->bindParam(':course', $course);
    $preparedSql->bindParam(':speciality', $speciality);
    $preparedSql->bindParam(':facultyNumber', $facultyNumber);
    $preparedSql->bindParam(':group', $group);
    $preparedSql->bindParam(':dateOfBirth', $birthDate);
    $preparedSql->bindParam(':zodiacSign', $zodiacSign);
    $preparedSql->bindParam(':hyperlink', $hyperlink);
    $preparedSql->bindParam(':photo', $photo);
    $preparedSql->bindParam(':motivation', $motivation);

    $preparedSql->execute() or die("An error ocurred! The candidate was not saved!");

    echo ("You candidate succesfully!");
}

function getUploadedPhoto()
{
    $photosDirectory = "candidatesPhotos/";
    if (!is_dir($photosDirectory)) {
        mkdir($photosDirectory, 0755);
    }

    $photoName = basename($_FILES[PHOTO_FIELD]['name']);
    $photoTarget = $photosDirectory . $photoName;
    $photoType = strtolower(pathinfo($photoTarget, PATHINFO_EXTENSION));;
    $photoUploadErrors = $_FILES[PHOTO_FIELD]["error"];

    checkUploadedPhoto($photoUploadErrors, $photoType);
    savePhoto($photoUploadErrors, $photoTarget);

    return basename($photoTarget);
}

function checkUploadedPhoto($photoUploadErrors, $photoType)
{
    $photoFormats = array("png", "jpeg", "jpg");

    if ($photoUploadErrors == UPLOAD_ERR_NO_FILE) {
        die("The photo is required!");
    }
    if ($photoUploadErrors == UPLOAD_ERR_NO_TMP_DIR || $photoUploadErrors == UPLOAD_ERR_CANT_WRITE) {
        die("Error occured while uploading the image! Please try again later!");
    }
    if (!in_array($photoType, $photoFormats)) {
        die("The image is in wrong format! The allowed formats are: png, jpg and jpeg!");
    }
}

function savePhoto($photoUploadErrors, &$photoTarget)
{
    if ($photoUploadErrors == UPLOAD_ERR_OK) {
        if (!move_uploaded_file($_FILES[PHOTO_FIELD]["tmp_name"], $photoTarget)) {
            die("Error occured while uploading the image! Please try again!");
        }
    }
}
