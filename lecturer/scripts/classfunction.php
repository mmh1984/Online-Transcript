<?php
$operation=$_POST['operation'];

switch($operation){
case "load":
load_students();
break;	

case "savebtec":
save_btec();
break;

case "savencc":
save_ncc();
break;
}


function save_ncc(){
	$code=$_POST['code'];
	$ic=$_POST['ic'];
	$type=$_POST['type'];
	$marks=$_POST['marks'];
	$final=$_POST['final'];
	$comment=$_POST['comment'];
	$date=date('Y-m-d');
	
	include '../../functions/connection.php';
	$comment=mysqli_real_escape_string($con,$comment);
	
	$delete=mysqli_query($con,"DELETE FROM tblnccmarks WHERE assessmenttype='$type' AND subjectcode='$code' AND
icnumber='$ic'");
	

	$query="INSERT INTO `tblnccmarks` (`subjectcode`, `icnumber`, `assessmenttype`, `assessmentmark`, `finalmark`, `comments`, `datemarked`) VALUES ('$code', '$ic', '$type', $marks, '$final','$comment', '$date');";
	

	if(mysqli_query($con,$query)){
		echo "success";
	}
	else {
		echo(die(mysqli_error($con)));
	}
	
	mysqli_close($con);
	
}

function save_btec(){
	$code=$_POST['code'];
	$ic=$_POST['ic'];
	$no=$_POST['no'];
	$title=$_POST['title'];
	$marks=$_POST['marks'];
	$achieved=$_POST['achieved'];
	$comment=$_POST['comment'];
	$date=date('Y-m-d');
	
	include '../../functions/connection.php';
	$comment=mysqli_real_escape_string($con,$comment);
	$delete=mysqli_query($con,"DELETE FROM tblbtecmarks WHERE assessmentno=$no AND subjectcode='$code'
	and icnumber='$ic'");
	

	$query="INSERT INTO `tblbtecmarks` (`subjectcode`, `icnumber`, `assessmentno`, `assessmenttitle`, `assessmentmarks`, `achievedmarks`, `comments`, `datemarked`) VALUES ('$code', '$ic',$no , '$title', '$marks', '$achieved', '$comment', '$date')";
	

	if(mysqli_query($con,$query)){
		echo "success";
	}
	else {
		echo(die(mysqli_error($con)));
	}
	
	mysqli_close($con);
	
}

function load_students(){

	include '../../functions/connection.php';
	$code=$_POST['code'];
	$query=mysqli_query($con,"SELECT
tblclasses.icnumber,
tblstudents.fullname,
tblstudents.type,
tblclasses.course,
tblclasses.subject
FROM
tblclasses
INNER JOIN tblstudents ON tblclasses.icnumber = tblstudents.icnumber
AND 
code='$code';
");


echo "<table class='table table-condensed table-striped table-bordered'>
	   <tr>
	   <th>IC Number</th>
	   <th>Full Name</th>
	   <th>type</th>
	    <th>Option</th>
	   </tr>	

";
while($row=mysqli_fetch_array($query,MYSQLI_NUM)){
	   echo "<tr>
	   <td>$row[0]</td>
	   <td>$row[1]</td>
	   <td>$row[2]</td>
	   <td><button class='btn btn-primary btn-sm center-block' onclick='submit_marks(\"$row[0]\",\"$row[3]\",\"$row[4]\")'>Enter Marks</button></td>
	   </tr>";
	
}

echo "</table>";

	mysqli_close($con);
}

?>