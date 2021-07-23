<?php

$option=$_POST["option"];

switch($option){

case "search":
load_classes();
break;	

case "class":
load_class_details();
break;

case "removestudent":
delete_student();
break;

case "deleteclass":
delete_class();
break;
	
}

function delete_student(){
$ic=$_POST["ic"];
$code=$_POST["code"];

include '../assets/connection.php';

$query=mysqli_query($con,"DELETE FROM tblclasses WHERE code='$code' and icnumber='$ic'");

mysqli_close();
}

function delete_class(){

$code=$_POST["code"];

include '../assets/connection.php';

$query=mysqli_query($con,"DELETE FROM tblclasses WHERE code='$code'");

mysqli_close();
}

function load_classes() {

$campus=$_POST["campus"];
$intake=$_POST["intake"];
$course=$_POST["course"];

include '../assets/connection.php';

$query=mysqli_query($con,"SELECT DISTINCT
tblclasses.campus,
tblclasses.`code`,
tblclasses.course,
tblclasses.`level`,
tblclasses.subject,
tblclasses.addedby,
tblclasses.dateadded 
FROM
tblclasses
INNER JOIN tblstudents ON tblclasses.icnumber = tblstudents.icnumber
WHERE
tblclasses.campus='$campus' AND
tblclasses.intake='$intake' AND
tblclasses.course LIKE '%$course%'");
	
if(mysqli_num_rows($query)>0){
	echo "<p class='alert alert-info'>Click on subject code to view details</p>";
	echo "<table class='table table-striped'>
		  <tr>
		  	<th>Campus</th>
			<th>Code</th>
			<th>Course</th>
			<th>Level</th>
			<th>Subject</th>	
			<th>Added by</th>
			<th>Date Added</th>
		  </tr>	
	";
	while($row=mysqli_fetch_array($query,MYSQLI_NUM)){
		echo "<tr>
		  	<td>$row[0]</td>
			<td><button onclick='select_class(\"$row[1]\")'><code>$row[1]</code></button></td>
			<td>$row[2]</td>
			<td>$row[3]</td>
			<td>$row[4]</td>
			<td>$row[5]</td>
			<td>$row[6]</td>
		  </tr>	
	";
	}
	echo "</table>";
	mysqli_close($con);
}
else {
	echo "<h3 id='bodyloader'>No classes found</h3>";
}
}
//function 2
function load_class_details(){
	include '../assets/connection.php';

$code=$_POST["code"];
$query=mysqli_query($con,"SELECT
tblclasses.campus,
tblclasses.icnumber,
tblstudents.fullname,
tblclasses.lecturer,
tblclasses.`schedule`
FROM
tblclasses
INNER JOIN tblstudents ON tblclasses.icnumber = tblstudents.icnumber
WHERE
tblclasses.`code` = '$code'
");
	
if(mysqli_num_rows($query)>0){
$schedule="";
$lecturer="";
	echo "<div class='col-md-8'>";
	echo "<table class='table table-striped'>
			<tr>
			<th>IC Number</th>
			<th>Full Name</th>
			<th>Option</th>
			</tr>
	";
	while($row=mysqli_fetch_array($query,MYSQLI_NUM)){
		$schedule=$row[4];
		$lecturer=$row[3];
		
		echo"<tr>
			<td>$row[1]</td>
			<td>$row[2]</td>
			<td><button class='btn btn-success btn-sm' onclick='delete_student(\"$row[1]\",\"$code\")'>Delete</button></td>
			</tr>";
	}
echo "</table>";
echo "<input type='hidden' id='classcode' value='$code'>";
echo "</div>";
echo "<div class='col-md-4'>
		<div class='panel panel-primary'>
		  
			<div class='panel-heading'>$code</div>	
			<div class='panel-body'>
				<table class='table table-condensed'>
					<tr>
					  <th>Lecturer</th><td>$lecturer</td>
					</tr>
					<tr>
					  <th>Schedule</th><td><ul>$schedule</li></td>
					</tr>
				</table>
				<button class='btn btn-danger center-block' data-toggle='modal' data-target='#confirmmodal'>Delete this class</button>
			</div>
		
		</div>
	  </div>";
	mysqli_close($con);
}
else {
	echo "<h3 id='bodyloader'>No classes found</h3>";
}

}

?>