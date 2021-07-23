<?php



$operation=$_POST['operation'];;
switch($operation){
	
	case "save":
	save_class();
	break;
	
}


function save_class() {
include '../assets/connection.php';
include '../assets/sessions.php';
$code=$_POST['code']; 
$campus=$_POST['campus']; 
$type=$_POST['type']; 
$intake=$_POST['intake']; 
$course=$_POST['course']; 
$level=$_POST['level']; 
$subject =$_POST['subject']; 
$group=$_POST['group']; 
$lecturer=$_POST['lecturer']; 
$schedule=mysqli_real_escape_string($con,$_POST['schedule']); 
$studentic=$_POST['studentic'];
$date=date('Y-m-d');
session_start();
$addedby=$_SESSION['user'];
$message="";
if(code_exists($code)==false){

$count=count($studentic);
$message="success";
for($x=0;$x<$count;$x++){
	$student=mysqli_real_escape_string($con,$studentic[$x]); 
$qrystr="INSERT INTO tblclasses (`code`, `campus`, `icnumber`, `type`, `intake`, `course`, `level`, `subject`, `group`, `lecturer`, `schedule`,`addedby`,`dateadded`) VALUES ('$code','$campus','$student', '$type', '$intake', '$course', '$level', '$subject', $group, '$lecturer', '$schedule','$addedby', '$date')";	

if(mysqli_query($con,$qrystr)){
	
	
	
}
else {
	$message="error";	
}

}
echo $message;
mysqli_close($con);

}
else {
	
  echo "error";
}

}

//function to check if code is already user

function code_exists($code) {
	include '../assets/connection.php';
	
	$query=mysqli_query($con,"SELECT * FROM tblclasses WHERE code='$code'");
	
	if(mysqli_num_rows($query)>0) {
	
		return true;	
	}
	else {
		return false;	
	}
	mysqli_close($con);
	
}

?>