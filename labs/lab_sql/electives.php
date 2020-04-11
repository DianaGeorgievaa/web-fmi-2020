<?php
define("MAX_TITLE_LENGTH", 150, true);
define("MAX_TEACHER_LENGTH", 200, true);
define("MIN_DESCRIPTION_LENGTH", 10, true);
define("MIN_CREDITS", 0, true);
define("MAX_CREDITS", 20, true);

$host = "localhost";
$username = "root";
$pass = "";
$dbname = "test";

function validateTitle($title, &$errors)
{
  if (!$title) {
    $errors['title'] = "Името е задължително поле.";
    echo $errors['title'];
  } elseif (strlen($title) > MAX_TITLE_LENGTH) {
    $errors['title'] = "Името има максимална дължина 150 символа.";
    echo $errors['title'];
  } else {
    $valid['title'] = $title;
  }
}

function validateTeacher($teacher, &$errors)
{
  if (!$teacher) {
    $errors['teacher'] = "Името на преподавател е задължително поле.";
    echo $errors['teacher'];
  } elseif (strlen($teacher) > MAX_TEACHER_LENGTH) {
    $errors['teacher'] = "Името на преподавател има максимална дължина 200 символа.";
    echo $errors['teacher'];
  } else {
    $valid['teacher'] = $teacher;
  }
}

function validateDescription($description, &$errors)
{
  if (!$description) {
    $errors['description'] = "Описанието на дисциплината е задължително поле.";
    echo $errors['description'];
  } elseif (strlen($description) < MIN_DESCRIPTION_LENGTH) {
    $errors['description'] = "Описанието на дисциплината има минимална дължина 10 символа.";
    echo $errors['description'];
  } else {
    $valid['description'] = $description;
  }
}

if ($_POST) {
  $valid = array();
  $errors = array();

  $description = $_POST['description'];
  $teacher = $_POST['teacher'];
  $title = $_POST['title'];

  validateTitle($title, $errors);
  validateTeacher($teacher, $errors);
  validateDescription($description, $errors);

  if (count($errors) === 0) {
    echo "The form was successfully submitted!";

    $connection = new PDO("mysql:host=$host;dbname=$dbname", $username, $pass);
    $courseTitle = $_POST['title'];
    $teacherName = $_POST['teacher'];
    $courseDescription = $_POST['description'];
    $statement = $connection->prepare("INSERT INTO electives (title, description, lecturer) VALUES (:courseTitle, :teacherName, :courseDescription);");
    $statement->bindParam(':courseTitle', $courseTitle);
    $statement->bindParam(':teacherName', $teacherName);
    $statement->bindParam(':courseDescription', $courseDescription);
    $statement->execute();
    echo "Successfully inserted to the database!";
  }
}
