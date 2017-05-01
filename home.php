<?php 
session_start();
include_once 'allfunctions.php';
if(!(isset($_SESSION['email']) && ($_SESSION['email']!=""))){
	header("location:login.php");
}
if( isset( $_SESSION['time'] ) && time() - $_SESSION['time'] > 120)
{
	header("Location:login.php");
}
$_SESSION['time']=time();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Bid/Auction System</title>
<link rel="stylesheet" type="text/css" href="BidCSS.css">
</head>
<body  class="page">
<div id="mainpage">
    <div id="header">
    	<h1>Auction Management System</h1>
    </div>
    <div id="links" class="sidebarmenu">
    	<ul id="link1">
    		<li><a href="mybids.php">My Bids</a>
    		<li><a href="mygoods.php">My Goods</a>
    		<li><a href="items.php">Register Items</a>
    		<li><a href="makebids.php">Make Bid</a>
    		<li><a href="logout.php">Log Out</a>
    	</ul>
    </div>
    <br><br><br>
    <div id="main">
    	<form action="" method="post">
    		<?php 
    			echo "<b>you have successfully logged in: </b>"." " .$_SESSION['email'];
    		?>
    	<p>to access the pages, go to the links on the left
    	</form>
    	<br><br><br><br><br><br><br>
    </div>
</div>	
</body>
</html>