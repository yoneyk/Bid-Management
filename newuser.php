<?php 
include_once 'allfunctions.php';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>New User Page</title>
<link rel="stylesheet" type="text/css" href="BidCSS.css">
<script type="text/javascript" language="javascript">
function validateUser(){
var fname=document.newuser.fname.value;
if(fname==""){
	document.getElementById("errorfnameMissing").style.visibility="visible";
	document.newuser.fname.focus();
	return false;
}
else{
	document.getElementById("errorfnameMissing").style.visibility="hidden";
}
var email=document.newuser.email.value;
atpos = email.indexOf("@");
dotpos = email.lastIndexOf(".");
if (atpos < 1 || ( dotpos - atpos < 2 )) {
	document.getElementById("erroremailMissing").style.visibility="visible";
	document.newuser.email.focus() ;
	return false;
}
else{
	document.getElementById("erroremailMissing").style.visibility="hidden";
}
var pswd=document.newuser.pswd.value;
if(pswd==""){
	document.getElementById("errorpswdMissing").style.visibility="visible";
	document.newuser.pswd.focus() ;
	return false;
}
else{
	document.getElementById("errorpswdMissing").style.visibility="hidden";
}
var conf_pswd=document.newuser.conf_pswd.value;
if(conf_pswd=="" ||conf_pswd != pswd ){
	document.getElementById("errorconfpswdMissing").style.visibility="visible";
	document.newuser.conf_pswd.focus() ;
	return false;
}
else{
	document.getElementById("errorconfpswdMissing").style.visibility="hidden";
}
return true;
}
</script>
</head>
<?php
if((isset($_POST['fname'])) && (isset($_POST['email']))&&(isset($_POST['pswd']))!="") {
	$fname=sanitizeString($con,$_POST['fname']);
	$email=sanitizeString($con,$_POST['email']);
	$pswd=sanitizeString($con,$_POST['pswd']);
	$sql = "INSERT INTO tbl_user(email,fname,pswd)
	VALUES ('".$email."','".$fname."','".$pswd."')";
	$result=mysqli_query($con,$sql);
	if (!$result) {
  		die('Error:can not insert to table user ' . mysqli_error($con));
	}
	else{
		echo "1 user is added correctly";
		echo '<script>window.location="newuser.php"</script>';
	}
}
mysqli_close($con);
?>
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
    	<form name= "newuser" method="post" action="" onsubmit="return validateUser();">
    	<table align = "center" class="bidtable">
    	<caption><b>User Registration</b></caption>
		<tr><td colspan=3 align="center"></tr>
		<tr><td align="center">First Name:<td align="center"><input type="text" name="fname" id="fname1" size="20" placeholder="your first name here"><td align="left"><span id="errorfnameMissing" style="visibility:hidden;color:red;font-style:italic;">*please provide firstname</span></tr>
		<tr><td align="center">Email:<td align="center"><input type="text" name="email" id="email1" size="20" placeholder="your email here"><td align="left"><span id="erroremailMissing" style="visibility:hidden;color:red;font-style:italic;">*please provide email</span></tr>
		<tr><td align="center">Password:<td align="center"><input type="password" name="pswd" id="pswd1" size="20" placeholder="your password here"><td align="left"><span id="errorpswdMissing" style="visibility:hidden;color:red;font-style:italic;">*please provide password</span></tr>
		<tr><td align="center">Confirm Password:<td align="center"><input type="password" name="conf_pswd" id="conf_pswd1" size="20" placeholder="confirm password here"><td align="left"><span id="errorconfpswdMissing" style="visibility:hidden;color:red;font-style:italic;">*please confirm same password</span></tr>
		<tr></tr><tr></tr>
		<tr><td align="right"><input type="submit" value="Create User"><td align="left"><input type="reset" value="Cancel"></tr>
		<tr></tr><tr></tr>
		</table>
		</form>   		
    </div>
</div>
</body>    
</html>