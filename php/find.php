<?php 
$name = $_POST['name'];
$lastName = $_POST['lastName'];

$pdo = new PDO('mysql:host=localhost;dbname=university', 'mysql', 'mysql');
$sql = "SELECT * FROM students WHERE firstName = '$name' lastName = '$lastName'";
$sth = $pdo->prepare("SELECT * FROM students WHERE firstName = '$name' AND lastName = '$lastName'");
$sth->execute();

$row = $sth->fetch(PDO::FETCH_ASSOC);

printf("
<table cellspacing='10'>
    <caption><b>Особиста справа:</b></caption>
    <tr><td>Ім'я:</td><td id='pInfo'>" .$row['firstName'] . "</td></tr>
    <tr><td>Призвіще:</td><td id='pInfo'>" .$row['lastName'] . "</td></tr>
    <tr><td>По батькові:</td><td id='pInfo'>" .$row['secondName'] ."</td></tr>
    <tr><td>Номер телефон:</td><td id='pInfo'>" .$row['phoneNumber'] . "</td></tr>
    <tr><td>Дата народження:</td><td id='pInfo'>" .$row['dateOfBirth'] . "</td></tr>
    <tr><td>Номер телефону батьків:</td><td id='pInfo'>" .$row['parentsPhoneNumber'] . "</td></tr>
    <tr><td>Гуртожиток:</td><td id='pInfo'>" .$row['dormitory'] . "</td></tr>
    <tr><td>Кімната:</td><td id='pInfo'>" .$row['room'] . "</td></tr>
    <tr><td>Дата заселелення:</td><td id='pInfo'>" .$row['dateOfReg'] . "</td></tr>
    <tr><td>Факультет:</td><td id='pInfo'>" .$row['faculty'] . "</td></tr>
</table>
");
?>