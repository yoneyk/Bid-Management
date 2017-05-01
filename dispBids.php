<?php 
session_start();
include_once 'allfunctions.php';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Display Bids</title>
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
<?php
$sql = mysqli_query($con,'SELECT distinct tbl_items.item_name,tbl_bid.ins_date,bid_price FROM tbl_items,tbl_bid where tbl_items.item_id=tbl_bid.i_id and tbl_items.start_price >= 0 ORDER BY tbl_bid.ins_date DESC');
if(! $sql ){
  die('Could not get data: ' . mysqli_error());
}
echo "<table border='1' class='bidtable'>
<caption><b>All Bid Transaction</b></caption>
<br>
<tr>
<th>Item Name</th>
<th>Insertion Date</th>
<th>Bid Amount</th>
</tr>";
while($row = mysqli_fetch_array($sql)){
	echo "<tr>";
    echo "<td>".$row['item_name']."</td>";
    echo "<td>".$row['ins_date']."</td>"; 
    echo "<td>".$row['bid_price']."</td>";
    echo "</tr>";
} 
echo "</table>";
mysqli_close($con);
?>
<form action="" method="post">
</form>
<br><br><br><br><br><br><br>
    <p>to go back to the previous page, please <a href="index.php">Click here</a>
    </div>
</div>	
</body>
</html>