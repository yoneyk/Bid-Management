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
<title>My Goods</title>
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
<?php
$bidder=$_SESSION['email'];
$sql = mysqli_query($con,"SELECT distinct tbl_items.item_name,tbl_bid.ins_date,tbl_bid.bid_price,tbl_bid.bidder FROM tbl_items,tbl_bid where tbl_items.item_id=tbl_bid.i_id and tbl_items.user_email='$bidder'");
if(!$sql )
{
  die('Could not get data: ' . mysqli_error($con));
}
echo "<table border='1'>
<caption><b>My Goods Transaction</b></caption>
<br>
<tr>
<th>Item Name</th>
<th>Insertion Date</th>
<th>Bid Amount</th>
<th>Bidder</th>
</tr>";

while($row = mysqli_fetch_array($sql)){
	echo "<tr>";
    echo "<td>".$row['item_name']."</td>" ;
    echo "<td>".$row['ins_date']."</td>";
    echo "<td>".$row['bid_price']."</td>";
    echo "<td>".$row['bidder']."</td>";
    echo "</tr>";
} 
echo "</table>";
mysqli_close($con);
?>
    		<form action="" method="post">
    		</form>
    		<br><br><br><br><br><br><br>
    	</div>
    </div>	
    </body>
</html>