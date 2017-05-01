<?php 
session_start();
include_once 'allfunctions.php';
unset($_SESSION['email']); 
session_destroy();
header('location:index.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Log out Page</title>
<link rel="stylesheet" type="text/css" href="BidCSS.css">
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
	<form method="post" name="logoutform"></form>
	<br><br><br><br><br><br><br>
	</div>
</div>
</body>
</html>