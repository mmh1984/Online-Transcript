<?php
$option=$_POST["option"];
switch($option){

case "login":
login();
break;	

case "change":
update_password();
break;

case "changename":
update_name();
break;
	
}

function login(){
$email=$_POST['email'];
$password=$_POST['password'];
include '../assets/connection.php';
$query=mysqli_query($con,"SELECT * FROM tbladminusers WHERE email='$email' and password='$password'");

if(mysqli_num_rows($query)>0){
  while($row=mysqli_fetch_array($query)){
	session_start();
	$_SESSION['user']=$row[1];  
	$_SESSION['site']=$row[5];
	$_SESSION['level']=$row[6];
	 
	}
  	
	echo "success";
}
else {
	echo "failed";
}
mysqli_close($con);
}

function update_password(){

$newpass=$_POST['newpass'];
include '../assets/connection.php';

session_start();
$email=$_SESSION['user'];
$query=mysqli_query($con,"UPDATE tblusers SET userpass='$newpass' WHERE username='$email'");

if($query){
echo "success";	
}
else{
echo "failed";	
}
mysqli_close($con);
}

function update_name(){

$newname=$_POST['newname'];
include '../assets/connection.php';
include '../assets/sessions.php';
session_start();
$email=$_SESSION['user'];
$query=mysqli_query($con,"UPDATE tbladminusers SET fullname='$newname' WHERE email='$email'");

if($query){
echo "success";	
}
else{
echo "failed";	
}
mysqli_close($con);
}

?>