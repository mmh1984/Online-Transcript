<?php

$option=$_POST['option'];

switch($option){
case "adminlogin":
login_admin();
break;

case "lecturerlogin":
login_lecturer();
break;

case "studentlogin":
login_student();
break;
}

function login_student(){

include 'connection.php';

$username=$_POST['username'];
$password=$_POST['password'];

$query=mysqli_query($con,"SELECT * FROM tblstudents WHERE icnumber='$username' AND password='$password'");

if(mysqli_num_rows($query)>0){
	echo "student";	
	session_start();
	$_SESSION['user']=$username;
	$_SESSION['level']='student';
}
else{
	echo "error";	
}

	mysqli_close($con);
	
}

function login_lecturer(){

include 'connection.php';

$username=$_POST['username'];
$password=$_POST['password'];

$query=mysqli_query($con,"SELECT * FROM tbllecturers WHERE email='$username' AND password='$password'");

if(mysqli_num_rows($query)>0){
	echo "lecturer";	
	session_start();
	$_SESSION['user']=$username;
	$_SESSION['level']='lecturer';
}
else{
	echo "error";	
}

	mysqli_close($con);
	
}





//admin login
function login_admin(){

include 'connection.php';

$username=$_POST['username'];
$password=$_POST['password'];

$query=mysqli_query($con,"SELECT * FROM tblusers WHERE username='$username' AND userpass='$password'");

if(mysqli_num_rows($query)>0){
	echo "admin";	
	session_start();
	$_SESSION['user']=$username;
	$_SESSION['level']='administrator';
}
else{
	echo "error";	
}

	mysqli_close($con);
	
}



?>