<?php

$option=$_POST['option'];

switch($option){
	
case "save":
save_student();
break;

case "load":
load_students();
break;

case "search":
load_students2();
break;

case "delete":
delete_student();
break;

case "deletelecturer":
delete_lecturer();
break;

case "edit":
edit_student();
break;

case "editlecturer":
edit_lecturer();
break;

case "newlecturer":
new_lecturer();
break;

case "savelecturer":
save_lecturer();
break;
}

function save_lecturer(){
	include 'connection.php';
	$email=$_POST['email'];
	$name=$_POST['name'];
	$campus=$_POST['campus'];
	
	$check=mysqli_query($con,"SELECT * FROM tbllecturers WHERE email='$email'");
	
	if(mysqli_num_rows($check)>0){
	echo "Error!, this email is already taken!";	
	}
	else
	{
	
	$query=mysqli_query($con,"INSERT INTO tbllecturers (`email`, `fullname`, `password`, `campus`) VALUES ('$email', '$name', 'kemuda123', '$campus');
");
	echo "success";
	}
	mysqli_close($con);
}

function new_lecturer(){
echo "<table class='table table-responsive'>
	   <tr>
	   <th>Email</th>
	   <td><input type='email' id='newemail' placeholder='email@kemudainstitute.com' class='form-control'>
	   </tr>
	   
	   <tr>
	    <th>Full Name</th>
	   <td><input type='text' id='newname' placeholder='fullname' class='form-control'>
	   </tr>
	   
	   <tr>
	     <th>Campus:</th>
	   <td><select id='newcampus' class='form-control'>
	   	   <option value='BSB'>BSB</option>
		   <option value='KB'>KB</option>
	   </select>
	   </tr>
		<tr>
		<td></td>
		<td>
		<button class='btn btn-default' onclick='save_lecturer()'>Save</button>
		<button class='btn btn-danger' onclick='refresh_page(\"lecturers.php\")'>Close</button>
		</td>
		</tr>


</table>";	
}

function edit_student(){
	include 'connection.php';
	
	$ic=$_POST['icnumber'];
	$query=mysqli_query($con,"UPDATE tblstudents set `password`='kemuda123' WHERE icnumber='$ic'");
	
	echo "Student $ic's password was reset to default (kemuda123)";
	echo(die(mysqli_error($con)));
	
}

function edit_lecturer(){
	include 'connection.php';
	
	$ic=$_POST['icnumber'];
	$query=mysqli_query($con,"UPDATE tbllecturers set `password`='kemuda123' WHERE email='$ic'");
	
	echo "$ic password was reset to default (kemuda123)";
	echo(die(mysqli_error($con)));
	
}

function delete_student(){
	include 'connection.php';
	
	$ic=$_POST['icnumber'];
	$query=mysqli_query($con,"DELETE FROM tblstudents WHERE icnumber='$ic'");
	mysqli_close($con);
	echo "Student $ic was removed from the list";
}

function delete_lecturer(){
	include 'connection.php';
	
	$ic=$_POST['email'];
	$query=mysqli_query($con,"DELETE FROM tbllecturers WHERE email='$ic'");
	mysqli_close($con);
	echo "$ic was removed from the list";
}

function save_student(){
	
	
	include 'connection.php';
	
	$campus=$_POST["campus"];
	$icnumber=$_POST["icnumber"];
	$name=$_POST["name"];
	$course=$_POST["course"];
	$level=$_POST["level"];
	$intake=$_POST["intake"];
	$type=$_POST["type"];
	$password='kemuda12345';
	$status='A';
	$date=date('Y-m-d');
	
	$rowcount=count($icnumber);
	$errorcount=0;
	$successcount=0;
	$erroric="";
	for($x=0;$x<$rowcount;$x++){
	if(check_ic($icnumber[$x],$course,$level)==false){
		$newname=mysqli_real_escape_string($con,$name[$x]);
	$query=mysqli_query($con,"INSERT INTO `tblstudents` ( `campus`, `icnumber`, `fullname`, `course`, `level`, `intake`, `type`, `password`, `status`, `dateadded`) VALUES ('$campus','$icnumber[$x]','$newname','$course','$level','$intake','$type[$x]','$password','$status','$date')");
	
	$successcount++;

	}
	else {

	$erroric=$icnumber[$x];
	$errorcount++;
	break 1;	
		
	}
	}//end of loop
	
	
	if($errorcount>0){
		echo "Saved records ($successcount). Error fields ($errorcount): $erroric is already in the system";
	}
	else {
		echo "All records are saved successfully";	
	}
	
	mysqli_close($con);
	
}

function check_ic($icnumber,$course,$level) {
	
	include 'connection.php';
	
	
	$query=mysqli_query($con,"SELECT * FROM tblstudents WHERE
	 icnumber='$icnumber' AND
	 course='$course' AND
	 `level`='$level'");
	 
	 if(mysqli_num_rows($query)>0){
		return true;
	 } 
	 else{
		return false; 
		}
	
	
}

function load_students(){

	
	include 'connection.php';
	$campus=$_POST["campus"];
	$course=$_POST["course"];
	$level=$_POST["level"];
	$intake=$_POST["intake"];	
	
	$query=mysqli_query($con,"SELECT * FROM
tblstudents
WHERE
tblstudents.campus='$campus' AND
tblstudents.course='$course' AND
tblstudents.`level`='$level' AND
tblstudents.intake='$intake'
");
	echo "<h3>Summary</h3>";
	echo "<table class='table table-striped table-condensed'>
		  <tr>
		  <th>Campus</th>
		  <th>IC/Passport</th>
		  <th>Name</th>
		  <th>Course and Level</th>
		  <th>Intake</th>
		  </tr>";
	while($row=mysqli_fetch_array($query,MYSQLI_NUM)){
		echo  "<tr>
		  <td>$row[1]</td>
		  <td>$row[2]</td>
		  <td>$row[3]</td>
		  <td>".$row[4]." ".$row[5]."</td>
		  <td>$row[6]</td>
		  </tr>";
		
	}
	echo "<table>";
	echo "<button class='btn btn-primary' id='btnfinish' onclick='refresh_page(\"students.php\")'>Close</button>";
	mysqli_close($con);
}
function load_students2(){

	
	include 'connection.php';
	$campus=$_POST["campus"];
	$course=$_POST["course"];
	$level=$_POST["level"];
	$intake=$_POST["intake"];	
	
	$query=mysqli_query($con,"SELECT * FROM
tblstudents
WHERE
tblstudents.campus='$campus' AND
tblstudents.course='$course' AND
tblstudents.`level`='$level' AND
tblstudents.intake='$intake'
");
	echo "<h3>Student Details</h3>";
	echo "<table class='table table-striped table-condensed'>
		  <tr>
		  <th>Campus</th>
		  <th>IC/Passport</th>
		  <th>Name</th>
		  <th>Course and Level</th>
		  <th>Intake</th>
		  <th>Option</th>
		  </tr>";
	while($row=mysqli_fetch_array($query,MYSQLI_NUM)){
		echo  "<tr>
		  <td>$row[1]</td>
		  <td>$row[2]</td>
		  <td>$row[3]</td>
		  <td>".$row[4]." ".$row[5]."</td>
		  <td>$row[6]</td>
		  <td>
		  <button class='btn btn-default' style='display:none' data-toggle='modal' data-target='#confirmmodal' id='btnshowmodal'>check</button>
		  <button class='btn btn-primary btn-sm' onclick='edit_student(\"$row[2]\")'>Reset Password</button>
		  <button class='btn btn-danger btn-sm' onclick='delete_student(\"$row[2]\")'>Delete</button>
		  </td>
		  </tr>";
		
	}
	echo "<table>";
	echo "<button class='btn btn-primary' id='btnfinish' onclick='refresh_page(\"students.php\")'>Close</button>";
	mysqli_close($con);
}
?>