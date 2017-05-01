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
<title>Make Bids</title>
<link rel="stylesheet" type="text/css" href="BidCSS.css">
<link rel="stylesheet" type="text/css" media="all" href="jsDatePick_ltr.min.css" />
<script type="text/javascript" src="jsDatePick.min.1.3.js"></script>
<script type="text/javascript">
function validateBids(){
var iname=document.makebids.item_name.value;
if(iname==""){
	document.getElementById("goodsItemMissing").style.visibility="visible";
	document.makebids.item_name.focus();
	return false;
}
else{
	document.getElementById("goodsItemMissing").style.visibility="hidden";
}
var date1=document.makebids.ins_date.value;
if(date1==""){
	document.getElementById("goodsDateMissing").style.visibility="visible";
	document.makebids.ins_date.focus();
	return false;
}
else{
	document.getElementById("goodsDateMissing").style.visibility="hidden";
}
var unit_price=document.makebids.u_price.value;
if (unit_price=="" || isNaN(unit_price)) {
	document.getElementById("goodsPriceMissing").style.visibility="visible";
	document.makebids.u_price.focus() ;
	return false;
}
else{
	document.getElementById("goodsPriceMissing").style.visibility="hidden";
}
return true;
}
</script>
<script type="text/javascript">
	window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"datepicker",
			dateFormat:"%Y-%M-%d"
		});
	};
</script>
</head>
<?php
if((isset($_POST['iname']))&& (isset($_POST['u_price']))!=""){
	$item_name=sanitizeString($con,$_POST['iname']);
	$uprice=sanitizeString($con,$_POST['u_price']);
	$email1=$_SESSION['email'];		
	$sql1 = mysqli_query($con,"SELECT * FROM tbl_items where user_email!='".$_SESSION['email']."' and item_id='".$_POST['iname']."'");
	//item_name='".$item_name."' and 
	if(!$sql1 ){
  		die('Could not get item data: ' . mysqli_error($con));
	}
	$sql_bid1= mysqli_query($con,"select * from tbl_bid where  i_id='".$_POST['iname']."'");
	//bidder='".$_SESSION['email']."'and
	if(!$sql_bid1){
		die('Could not select item id data: ' . mysqli_error());
	}
	$sql2=mysqli_num_rows($sql_bid1);
	//echo $sql2;
	if($sql2==0){
		$sql = "INSERT INTO tbl_bid(i_id,ins_date,bid_price,bidder)VALUES('".$_POST['iname']."',now(),'".$uprice."','".$_SESSION['email']."')";
		$result=mysqli_query($con,$sql);
		if (!$result) {
  			die('Error:can not insert to table bid ' . mysqli_error($con));
		}
		else{
			echo "1 bid is added correctly";
		}
		echo '<script>window.location="makebids.php"</script>';
	}
	while(($row1 = mysqli_fetch_array($sql_bid1)) && ($row = mysqli_fetch_array($sql1))){
		$itemID=$row['item_id'];
		if($row1['bid_price'] < $_POST['u_price']){
			$sql_update="update tbl_bid set bid_price='".$uprice."',bidder='".$_SESSION['email']."',ins_date=now() where i_id='$itemID'";
			$result1=mysqli_query($con,$sql_update);
			if (!$result1) {
  				die('Error:can not insert to table bid ' . mysqli_error());
			}
			else{
				echo "1 bid is updated correctly";
				echo '<script>window.location="makebids.php"</script>';
			}
		}//if end
		else{
			echo "not allowed, too small amount to bid";
		}	
	}//while
}//if isset
?>
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
    		<form name= "makebids" method="post" action="" onsubmit="return validateBids();">
    		<table align = "center" class="bidtable" border="1">
    		<caption><b>Bid Transaction</b></caption>
			<tr><td colspan=3 align="center"></tr>
			<tr><th>Item Name</th><th>Bid Date</th><th>Price</th></tr>
			<tr><td>
<?php
$em=$_SESSION['email'];
$sqla = mysqli_query($con,"SELECT item_id,item_name FROM tbl_items where user_email !='".$_SESSION['email']."'");
if(!$sqla ){
	die('Could not get select data: ' .mysqli_error($con));
}
echo '<select name="iname" size="1" style= "width: 150px">';
while($rowa = mysqli_fetch_array($sqla)) { 
	echo '<option value="'.$rowa['item_id'].'"."'.$rowa['item_name'].'">'. $rowa['item_id'].'.'. $rowa['item_name'].'</option>';
}
echo '</select>';
mysqli_close($con);
?>
			<td align="center"><input type="text" name="ins_date" id="datepicker" size="10" placeholder="provide Date here(yyyy/mm/dd)">
			<td align="center"><input type="text" name="u_price" id="price" size="10" placeholder="provide Item price here">
			</tr>
			<tr><td>
			<td align="left"><span id="goodsDateMissing" style="visibility:hidden;color:red;font-style:italic;">*please provide insertion date</span>
			<td align="left"><span id="goodsPriceMissing" style="visibility:hidden;color:red;font-style:italic;">*please provide bid price(0.0)</span>
			</tr>
			<tr><td align="center"><input type="submit" value="Bid"><td align="center"><input type="reset" value="Cancel"></tr>
			</table>
			</form>   		
    		<br><br><br><br><br><br><br>
    	</div>
    </div>	
</body>
</html>