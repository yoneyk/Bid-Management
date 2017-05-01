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
<?php
if((isset($_POST["item_name"])) && (isset($_POST["u_price"]))!="") {
	$item_name=sanitizeString($con,$_POST["item_name"]);
	$unit_price=sanitizeString($con,$_POST["u_price"]);
	$uemail=$_SESSION['email'];
	//echo $item_name;
	$sql = "INSERT INTO tbl_items(user_email,item_name,ins_date,start_price)
	VALUES ('".$uemail."','".$item_name."',now(),'".$unit_price."')";
	$result=mysqli_query($con,$sql);
	if (!$result) {
  		die('Error:can not insert to table Item' . mysqli_error($con));
	}
	else{
		echo "1 Item is added correctly";
	}
	echo '<script>window.location="items.php"</script>';
}
	mysqli_close($con);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Items Form</title>
<link rel="stylesheet" type="text/css" href="BidCSS.css">
<link rel="stylesheet" type="text/css" media="all" href="jsDatePick_ltr.min.css" />
<script type="text/javascript" src="jsDatePick.min.1.3.js"></script>
<script type="text/javascript">
	window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"selectedDate",
			dateFormat:"%Y-%M-%d"
		});
	};
</script>
<script type="text/javascript" language="javascript">
function validateItems(){
var iname=document.items.item_name.value;
if(iname==""){
	document.getElementById("goodsItemMissing").style.visibility="visible";
	document.items.item_name.focus();
	return false;
}
else{
	document.getElementById("goodsItemMissing").style.visibility="hidden";
}
var date1=document.items.ins_date.value;
if(date1==""){
	document.getElementById("goodsDateMissing").style.visibility="visible";
	document.items.ins_date.focus();
	return false;
}
else{
	document.getElementById("goodsDateMissing").style.visibility="hidden";
}
var unit_price=document.items.u_price.value;
if (unit_price=="" || isNaN(unit_price)) {
	document.getElementById("goodsPriceMissing").style.visibility="visible";
	document.items.u_price.focus() ;
	return false;
}
else{
	document.getElementById("goodsPriceMissing").style.visibility="hidden";
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
    		<li><a href="mybids.php">My Bids</a>
    		<li><a href="mygoods.php">My Goods</a>
    		<li><a href="items.php">Register Items</a>
    		<li><a href="makebids.php">Make Bid</a>
    		<li><a href="logout.php">Log Out</a>
    	</ul>
    </div>
    <br><br><br>
    <div id="main">
    	<form name= "items" method="post" action="" onsubmit="return validateItems();">
    	<table align = "center" class="bidtable">
    	<caption><b>Item Registration</b></caption>
		<tr><td colspan=3 align="center"></tr>
		<tr><td align="center">Item Name:<td align="center"><input type="text" name="item_name" id="item" size="20" placeholder="provide Item name here"><td align="left"><span id="goodsItemMissing" style="visibility:hidden;color:red;font-style:italic;">*please provide itemname</span></tr>
		<tr></tr>
		<tr><td align="center">Date:<td align="center"><input type="text" name="ins_date" id="selectedDate" size="20" placeholder="provide Date here(yyyy/mm/dd)"><td align="left"><span id="goodsDateMissing" style="visibility:hidden;color:red;font-style:italic;">*please provide insertion date</span></tr>
		<tr></tr>
		<tr><td align="center">Start Price:<td align="center"><input type="text" name="u_price" id="price" size="20" placeholder="0.0 EURO"><td align="left"><span id="goodsPriceMissing" style="visibility:hidden;color:red;font-style:italic;">*please provide start price numbers only(0.0)</span></tr>
		<tr></tr>
		<tr><td align="right"><input type="submit" value="Register Items"><td align="left"><input type="reset" value="Cancel"></tr>
		<tr></tr><tr></tr>
		</table>
		</form>   		
    	<br><br><br><br><br><br><br>
    </div>
</div>	
</body>
</html>