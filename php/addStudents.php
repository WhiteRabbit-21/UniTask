<?php

$data = [
    "rName" => $_POST['name'],
    "lastName" => $_POST['lastName'],
    "secondName" => $_POST['secondName'],
    "gender" => $_POST['gender'],
    "birth" => $_POST['birth'],
    "faculty" => $_POST['faculty'],
    "groupe" => $_POST['groupe'],
    "phone" => $_POST['phone'],
    "parentsPhone" => $_POST['parentsPhone'],
    "room" => $_POST['room'],
    "dateReg" => $_POST['reg'],
    "dorm" => $_POST['selectDorm']
];

$pdo = new PDO('mysql:host=localhost; dbname=university', 'mysql', 'mysql');
$sql = 'INSERT INTO students (firstName, lastName, secondName, gender, dateOfBirth, phoneNumber, parentsPhoneNumber, faculty, groupe, room, dateOfReg, dormitory) VALUES (:rName, :lastName, :secondName, :gender, :birth, :phone, :parentsPhone, :faculty, :groupe, :room, :dateReg, :dorm)';
$statement = $pdo->prepare($sql);
$result = $statement->execute($data);
var_dump($result);
?>