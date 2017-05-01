<?php 
session_start(); 
include_once 'allfunctions.php';
if(isset($_POST["login"])){	
	$email=sanitizeString($con,$_POST["uname"]);
	$pswd=sanitizeString($con,$_POST["pswd"]);
	//$hash=md5($pswd);
	$sql ="SELECT email,pswd FROM tbl_user where email='$email' and pswd='$pswd' LIMIT 1";
	$result= mysqli_query($con,$sql);
	if(!$result){
		die('Could not get data: ' . mysqli_error());
	}
	else{
		if (mysqli_num_rows($result) != 0){
			$_SESSION["email"]=$email;
			$_SESSION["time"]=time();
			header('location:home.php');
			exit();
		}
		else{
			echo "<i><font color=red>invalid username or password</font></i>";
		}
	}
} 			
mysqli_close($con);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Login Page</title>
<link rel="stylesheet" type="text/css" href="BidCSS.css">
<noscript>
	<div class="noscriptmsg">
		<h2>You don't have javascript enabled. Access to the site blocked!</h2>
	</div>
</noscript>
<script type="text/javascript">
function checkCookie(){
var cookieEnabled=(navigator.cookieEnabled)? true : false   
if (typeof navigator.cookieEnabled=="undefined" && !cookieEnabled){ 
	document.cookie="testcookie";
	cookieEnabled=(document.cookie.indexOf("testcookie")!=-1)? true : false;
}
	return (cookieEnabled)?true:showCookieFail();
}
function showCookieFail(){
 document.write("<style type='text/css'> .container {display:none;}</style><div class='noscriptmsg'><h3>You don't have cookies enabled. Access to the site blocked!</h3></div>");;
}
checkCookie();
</script>
<script type="text/javascript">
function validateLogin(){
var uname=document.loginform.uname.value;
if(uname==""){
	document.getElementById("loginunameMissing").style.visibility="visible";
	document.loginform.uname.focus();
	return false;
}
else{
	document.getElementById("loginunameMissing").style.visibility="hidden";
}
var lname=document.loginform.pswd.value;
if(lname==""){
	document.getElementById("loginpswdMissing").style.visibility="visible";
	document.loginform.pswd.focus();
	return false;
}
else{
	document.getElementById("loginpswdMissing").style.visibility="hidden";
}
return true;
}
</script>
</head>
<body  class="page">
	<div id="mainpage">
    	<div id="header">
    		<h1>Auction Management System</h1>
    	</div>
    	<div id="links" class="sidebarmenu">
    		<ul id="link1">
    			<li><a href="index.php">Home</a>
    			<li><a href="newuser.php">Create User</a>
    			<li><a href="login.php">Login</a>
    		</ul>
    	</div>
    	<br><br><br>
    	<div id="main">
		<form method="post" name="loginform" onsubmit="return validateLogin();">
		<table align = "center" class="bidtable">
		<caption><b>Login</b></caption>
		<tr><td colspan=3 align="center"></tr>
		<tr><td align="center">User Name:<td align="center"><input type="text" name="uname" size="20" placeholder="your user name here(its your email)"><td align="left"><span id="loginunameMissing" style="visibility:hidden;color:red;font-style:italic;">*please provide user name</span></tr>
		<tr></tr>
		<tr><td align="center">Password:<td align="center"><input type="password" name="pswd" size="20" placeholder="your password here"><td align="left"><span id="loginpswdMissing" style="visibility:hidden;color:red;font-style:italic;">*please provide password</span></tr>
		<tr></tr>
		<tr><td align="right"><input name="login" type="submit" value="Login"><td align="left"><input type="reset" value="Cancel"></tr>
		<tr></tr><tr></tr><tr></tr><tr></tr>
		</table>
		<p> Do you want to register, go here <a href="newuser.php">Click me</a></p><br> 
		</form>
		<br><br><br>
		</div>
	</div>
</body>
</html>