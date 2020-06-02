<?php 
    session_start();
?>
<? ob_start();?>
<?php require_once("connection.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/style.css" media="screen" rel="stylesheet">
</head>
<body>
<?php
	if(isset($_SESSION["session_email"])){
	// вывод "Session is set"; // в целях проверки
	header('Location: ../index.php');
	}
	if(isset($_POST["login"])){
	if(!empty($_POST['email']) && !empty($_POST['password'])) {
	$email=htmlspecialchars($_POST['email']);
	$password=htmlspecialchars($_POST['password']);
	$query =mysqli_query($con, "SELECT * FROM user WHERE email='".$email."' AND password='".$password."'");
	$numrows=mysqli_num_rows($query);
	if($numrows!=0)
 {
while($row=mysqli_fetch_assoc($query))
 {
	$dbemail=$row['email'];
  $dbpassword=$row['password'];
 }
  if($email == $dbemail && $password == $dbpassword)
 {
	// старое место расположения
	//  session_start();
	 $_SESSION['session_email']=$email;	 
 /* Перенаправление браузера */
   header("Location: ../index.php");
	}
	} else {
	//  $message = "Invalid username or password!";
	
	echo  "Invalid username or password!";
 }
	} else {
    $message = "All fields are required!";
	}
	}
	ob_end_flush();
?>
<?php require_once("connection.php"); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/style.css" media="screen" rel="stylesheet">
    <style>
	div.mlogin {
    	text-align:center;
	margin-top:10%;
	}
	body{background-color:PowderBlue;	}
	h1{font-size:40px;}
	p{font-size:25px;}
	input{width:250px;}
	</style>
	
    
</head>
<body>
<div class="container mlogin picture">
<div id="login">
<h1>Вхід до бази даних</h1>
<form action="" id="loginform" method="post"name="loginform">
<p><label for="email">Email<br>
<input class="input" id="email" name="email"size="20"
type="text" value=""></label></p>
<p><label for="password">Password<br>
 <input class="input" id="password" name="password"size="20"
  type="password" value=""></label></p> 
	<p class="submit"><input class="button" name="login" type= "submit" value="Log In"></p>
   </form>
   </form>
 </div>
  </div>
</body>
</html>