<?php
$jsonAsString = file_get_contents('php://input');
$jsonAsArray = json_decode($jsonAsString);
var_dump($jsonAsArray);
?>