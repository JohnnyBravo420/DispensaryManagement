<?php
session_start();
date_default_timezone_set( "America/Los_Angeles" );
header('Access-Control-Allow-Origin: https://tgtpos.com');
$_SESSION['username'] = 'GUEST';
$_SESSION['privilege'] = 1;
?>

<!doctype html>
<html lang="en">
<head>
<link rel="icon" type="svg" href="favicon.svg">
<link rel="stylesheet" type="text/css" href="loginstyle.css" media="all">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<title>login</title>
</head>
<body>
<form action="loginparser.php" method="post" name="loginForm" data-text="Please Wait" enctype="multipart/form-data" id="loginForm" onSubmit="authorize(this); return false;" method="post">
<fieldset>
<legend>Log In</legend>
<label for="username">Username</label>
<input type="text" autocomplete=false id="username" name="username" placeholder="Username" required maxlength="20" form="loginForm" value="" >
<label for="password">Password</label>
<input type="password" id="password" name="password" placeholder="Password" required maxlength="20" form="loginForm" value="">
<label for="remember-me" style="background-color:transparent; ">Remember Me<input type="checkbox" id="remember-me"   onClick=""></label>
<input type="button" value="Submit" onclick="authorize(this)">
</fieldset>
<p id="feedback" data-text=""> </p>
</form>
<script src="loginscript.js" type="text/javascript"></script>
</body>
</html>
