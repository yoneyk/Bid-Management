<?php
$con=mysqli_connect("localhost","root","");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
// Create database
$sql="CREATE DATABASE auction_db";
if (mysqli_query($con,$sql)) {
  echo "Database auction database created successfully";
} else {
  echo "Error creating database: " . mysqli_error($con);
}
$con=mysqli_connect("localhost","root","","auction_db");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// Create table
$sql="CREATE TABLE tbl_user(email CHAR(20),PRIMARY KEY(email),fname CHAR(20),pswd CHAR(20))";
if (mysqli_query($con,$sql)) {
  echo "Table tbl_user created successfully";
} else {
  echo "Error creating table: " . mysqli_error($con);
}

$sql1="CREATE TABLE tbl_items(item_id INT NOT NULL AUTO_INCREMENT,PRIMARY KEY(item_id),user_email CHAR(20)NOT NULL, FOREIGN KEY(user_email)REFERENCES tbl_user(email),item_name CHAR(20),ins_date DATETIME,start_price FLOAT)";
if (mysqli_query($con,$sql1)) {
  echo "Table tbl_items created successfully";
} else {
  echo "Error creating table: " . mysqli_error($con);
}

$sql2="CREATE TABLE tbl_bid(bid_id INT NOT NULL AUTO_INCREMENT,PRIMARY KEY(bid_id),i_id INT NOT NULL,
FOREIGN KEY(i_id)REFERENCES tbl_items(item_id),ins_date DATETIME,bid_price FLOAT,bidder CHAR(20))";
// Execute query
//junk table many to many relations between good and user, 
//so bid table will hold two PKs
if (mysqli_query($con,$sql2)) {
  echo "Table tbl_bid created successfully";
} else {
  echo "Error creating table: " . mysqli_error($con);
}
?>