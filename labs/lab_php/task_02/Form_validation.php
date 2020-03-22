<?php
define("MAX_TITLE_LENGTH", 150, true);
define("MAX_TEACHER_LENGTH", 200, true);
define("MIN_DESCRIPTION_LENGTH", 10, true);
define("MIN_CREDITS", 0, true);
define("MAX_CREDITS", 20, true);

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

function validateGroup($group, &$errors)
{
  if (!$group) {
    $errors['group'] = "Трябва да изберете група.";
    echo $errors['group'];
  } else {
    $valid['group'] = $group;
  }
}

function validateCredits($credits, &$errors)
{
  if (!$credits) {
    $errors['credits'] = "Кредит е задължително поле.";
    echo $errors['credits'];
  } elseif ($credits < MIN_CREDITS) {
    $errors['credits'] = "Кредитите трябва да бъдат положително число.";
    echo $errors['credits'];
  } elseif ($credits > MAX_CREDITS) {
    $errors['credits'] = "Кредитите не може да бъде повече от 20.";
    echo $errors['credits'];
  } else {
    $valid['credits'] = $credits;
  }
}

if ($_POST) {
  $valid = array();
  $errors = array();

  $description = $_POST['description'];
  $teacher = $_POST['teacher'];
  $title = $_POST['title'];
  $group = $_POST['group'];
  $credits = $_POST['credits'];

  validateTitle($title, $errors);
  validateTeacher($teacher, $errors);
  validateDescription($description, $errors);
  validateGroup($group, $errors);
  validateCredits($credits, $errors);

  if (count($errors) === 0) {
    echo "The form was successfully submitted!";

    $filename = 'data.txt';
    file_put_contents($filename, "Име на предмет: ", FILE_APPEND | LOCK_EX);
    file_put_contents($filename, $title, FILE_APPEND | LOCK_EX);
    file_put_contents($filename, "\n", FILE_APPEND | LOCK_EX);
    file_put_contents($filename, "Име на преподавател: ", FILE_APPEND | LOCK_EX);
    file_put_contents($filename, $teacher, FILE_APPEND | LOCK_EX);
    file_put_contents($filename, "\n", FILE_APPEND | LOCK_EX);
    file_put_contents($filename, "Описание на предмет: ", FILE_APPEND | LOCK_EX);
    file_put_contents($filename, $description, FILE_APPEND | LOCK_EX);
    file_put_contents($filename, "\n", FILE_APPEND | LOCK_EX);
    file_put_contents($filename, "Група: ", FILE_APPEND | LOCK_EX);
    file_put_contents($filename, $group, FILE_APPEND | LOCK_EX);
    file_put_contents($filename, "\n", FILE_APPEND | LOCK_EX);
    file_put_contents($filename, "Кредити: ", FILE_APPEND | LOCK_EX);
    file_put_contents($filename, $credits, FILE_APPEND | LOCK_EX);
    file_put_contents($filename, "\n", FILE_APPEND | LOCK_EX);
    file_put_contents($filename, "=====================================================", FILE_APPEND | LOCK_EX);
    file_put_contents($filename, "\n", FILE_APPEND | LOCK_EX);
  }
}
