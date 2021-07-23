<?php

$option=$_POST["option"];
$val=$_POST["value"];

switch ($option){
	
case "intake":
load_intake();
break;

case "students":
load_students();
break;

case "subjects":
load_subjects();
break;

case "lecturer":
load_lecturers();
break;
	
}
//load lecturer
function load_lecturers(){
	$campus=$_POST['campus'];
include '../assets/connection.php';
$query=mysqli_query($con,"SELECT * FROM tbllecturers WHERE campus LIKE '%$campus%'");
echo "<select id='Lecturer' class='smallselect'>";
while($row=mysqli_fetch_array($query,MYSQLI_NUM)){
echo "<option value='$row[0]'>$row[1]</option>";	
}
mysqli_close($con);
echo "</select>";
}



//load subjects
function load_subjects() {
include '../assets/connection.php';	
$course=$_POST["course"];
$level=$_POST["level"];
$levelcode="";
switch($level){
	case "L1":
	$levelcode="LEVEL 1";
	break;
	
	case "L2":
	$levelcode="LEVEL 2";
	break;
	
	case "L3":
	$levelcode="LEVEL 3";
	break;
	
	case "L4":
	$levelcode="LEVEL 4";
	break;
	
	case "L5":
	$levelcode="LEVEL 5";
	break;
	
	case "BACHELOR":
	$levelcode="BACHELOR";
	break;
}


$query=mysqli_query($con,"SELECT * FROM tblsubjects WHERE provider='$course' AND level LIKE '%$levelcode%'");

echo "<table class='table table-condensed'>
	  <tr>
	  	<th>Select</th>
	  	<th>Subject Code</th>
		<th>Subject Name</th>
	  </tr>";

while($row=mysqli_fetch_array($query,MYSQLI_NUM)) {
	echo "<tr>
			<td><button type='button' data-dismiss='modal' class='btn btn-primary' data-dismiss-'modal' onclick='select_subject(\"$row[1]\",\"$row[2]\")'>Select</button></td>
			<td>$row[2]</td>
			<td>$row[1]</td>
		  </tr>";
	
}
echo "<table>";

mysqli_close($con);
}

//function to load intake
function load_intake() {
include '../assets/connection.php';

$query=mysqli_query($con,"SELECT distinct intake from tblstudents ORDER BY intake ASC");
$returnval="";
while($r=mysqli_fetch_array($query)) {
	$returnval.= "<option value='$r[0]'>$r[0]</option>";
}
mysqli_close($con);	
echo $returnval;
}

function load_students() {
include '../assets/connection.php';
$campus=$_POST["campus"];
$type=$_POST["type"];
$intake=$_POST["intake"];
$course=$_POST["course"];
$level=$_POST["level"];

$query=mysqli_query($con,"SELECT icnumber,fullname,course,level,intake,type,campus FROM tblstudents WHERE 
campus='$campus' AND
intake LIKE '%$intake%' AND
type LIKE '%$type%' AND
course LIKE '%$course%' AND
level LIKE '%$level%'
ORDER BY fullname ASC
");
$returnval="";
$count=mysqli_num_rows($query);
echo "<h5 class='text-info'>No of Students:$count</h5>

<button class='btn btn-primary btn-sm pull-right' id='toggleparameter'>View/Hide Parameter</button><br/>";
if($count >0) {
	
	echo "<table class='table table-striped' id='results'>
		<tr>
		<th>Select <br/><input type='checkbox' id='toggleselect'></th>
		<th>Campus</th>
		<th>IC Number</th>
		<th>Full Name</th>
		<th>Course</th>
		<th>Level</th>
		<th>Intake</th>
		<th>Type</th>
		
		</tr>";
while($row=mysqli_fetch_array($query)) {
	echo "<tr>
			<td><input type='checkbox' name='studentic' value='$row[0]'></td>
			<td>$row[6]</td>
		    <td>$row[0]</td>
			<td>$row[1]</td>
			<td>$row[2]</td>
			<td>$row[3]</td>
			<td>$row[4]</td>
			<td>$row[5]</td>
			
		  </tr>";
	
}
echo "</table>";

}
else {
return "<h2>No Students</h2>";	
}

mysqli_close($con);	
echo $returnval;
}


?>
<script src="index.js" type="text/javascript"></script>
<script>
$("#toggleparameter").click(function(e) {
   $("#divlist").toggleClass('col-md-9 col-md-12');
   $("divparameter").addClass('col-md-3');
   $("#divparameter").fadeToggle();
   
  
});

$("#toggleselect").click(function(e) {

  var table=$("#results");
  var tdchecked=table.find('td input:checkbox');
  tdchecked.prop('checked',this.checked);
  
});

function select_subject(name,code) {
	$("#subjectcode").val(name);
	$("#subjectcode1").val(code);
	/*
	var currentcode=$("#code").html();
	currentcode+=code;
	$("#code").html(currentcode);
	*/
	update_code();
}

</script>