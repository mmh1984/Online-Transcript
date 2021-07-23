<?php
session_start();
if(!isset($_SESSION['user']) && ($_SESSION['level']!=='administrator')){
	header('location:index.php');
	
}
else{
$user=$_SESSION['user'];	
}

?> 


<!doctype html>
<html>
<head>
<meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
<title>Class Scheduling</title>
<link href="css/custom.css" rel="stylesheet" type="text/css"/>
<link href="https://fonts.googleapis.com/css?family=Lato|Slabo+27px" rel="stylesheet">
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<script src="script/jquery.min.js" type="text/javascript"></script>
<script src="script/bootstrap.min.js" type="text/javascript"></script>
<script src="script/index.js" type="text/javascript"></script>


<script >
$(document).ready(function(e) {
    
//initial load for intake
var target=$("#intake");
//load_selected("intake",0,target);
$("#bodyloader").hide();

	var lecturer=$("#lecturerspan");
	var campus="BSB";
	load_lecturer(campus,lecturer);


//initial load for studentlist


//main menu selection//


//class details selection//
$("#campus").change(function(e) {
	var option="students"
    var value="campus";
	var target=$("#studentlist");
	load_student(option,value,target);
	
	var lecturer=$("#lecturerspan");
	var campus=$(this).val();
	load_lecturer(campus,lecturer);
});

$("#intake").change(function(){
	var option="students"
    var value="intake";
	var target=$("#studentlist");
	load_student(option,value,target);
});

$("#type").change(function(){
	var option="students"
    var value="type";
	var target=$("#studentlist");
	load_student(option,value,target);
});

$("#course").change(function(){
	var option="students"
    var value="course";
	var target=$("#studentlist");
	load_student(option,value,target);
});

$("#level").change(function(){
	var option="students"
    var value="level";
	var target=$("#studentlist");
	load_student(option,value,target);
});

$("#btnselect").click(function(e) {
    load_subjects();
});

$("#btnselect").click(function(e) {
	var course=$("#course").val();
	var level=$("#level").val();
    var courselevel=course +"(" + level + ")";
	$("#courselevel").html(courselevel);
});

$("#group").change(function(){
	update_code();
})


//toggle parameter

$("#toggleparameter").click(function(e) {
   $("#divlist").toggleClass('col-md-9 col-md-12');
   $("divparameter").addClass('col-md-3');
   $("#divparameter").fadeToggle();
   
  
});

$("#btnsave").click(function(e) {
    save_class();
});
});


</script>
</head>

<body>
<div class="container-fluid">
<div class="row"  style="background-color:#003;">
<!--navigation -->
<div class='col-md-1'>
<a href="#">
<img src="images/logo.png" width="100%">
</a>
</div>
<div class='col-md-4'>

<H1 style="color:#fff;">KEMUDA<small> Admin Page</small></H1>
</div>
 <div class='col-md-7'><!--navigation-->
  <ul class="nav navbar-nav">
      <li class="active"><a href="../admin.php">Home</a></li>
        <li><a href="../students.php">Students</a></li>
      <li><a href="../lecturers.php">Lecturers</a></li>
      <li class='dropdown'>
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Classes
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="index.php">Add Classes</a></li>
          <li><a href="search.php">Search</a></li>
        
        </ul>
      </li>
      
    <li class='dropdown'>
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Profile
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="../profile.php">Change Password</a></li>
          <li><a href="../logout.php">Logout</a></li>
        
        </ul>
      </li>
      </li>
    </ul>
    
 <p class='pull-right'><kbd>Logged in as: <?php echo $user; ?></kbd></p>
 </div>
 
 </div>

<!--contents -->
<div class="row">

<div class="col-md-3" style="border-right:1px double #036;" id="divparameter">

<div class="select1">
<h5 ><span id="code" style='font-size:.9em;font-weight:bold;color:#F00;'></span></h5>
<table class="table table-condensed form-group-sm" id="parameter">
<tr>
<th>Campus</th>
<td><select id="campus" class='smallselect'>
<option value="BSB">BSB</option>
<option value="KB">KB</option>
</select>
</tr>

<th>Type</th>
<td><select id="type" class='smallselect'>
<option value="FT">FULL-TIME</option>
<option value="PT">PART-TIME</option>
</select>
</tr>

<th>Intake</th>
<td><select id="intake" class='smallselect'>
<option value='MAR 16'>MAR 16</option>
<option value='JUL 16'>JUL 16</option>
<option value='SEP 16'>SEP 16</option>
<option value='MAR 17'>MAR 17</option>
<option value='JUL 17'>JUL 17</option>
<option value='SEP 17'>SEP 17</option>
<option value='MAR 18'>MAR 18</option>
<option value='JUL 18'>JUL 18</option>
<option value='SEP 18'>SEP 18</option>
</select>
</tr>



<th>Course</th>
<td><select id="course" class='smallselect'>
<option value="NCC">NCC</option>
<option value="BTEC" selected>BTEC</option>
<option value="LCCI">LCCI</option>
<option value="OUM">OUM</option>
</select>
</tr>

<th>Level</th>
<td><select id="level" class='smallselect'>
<option value="L1">LEVEL 1</option>
<option value="L2">LEVEL 2</option>
<option value="L3" selected>LEVEL 3</option>
<option value="L4">LEVEL 4</option>
<option value="L5">LEVEL 5</option>
<option value="BACHELOR">DEGREE</option>
</select>
</tr>

</tr>
</table>


<table class="table table-condensed" id="parameter">

<th>Select Subject:</th>
<td><input type='text' id="subjectcode" class='mediumselect'><input type='hidden' id="subjectcode1" class='mediumselect'><button class="btn btn-default btn-sm" id="btnselect" data-toggle="modal" data-target="#subjectmodal"><img src="images/icons/search.png" width="15px"></button></td>
</tr>
<tr>
<th>Group</th>
<td><select id="group" class="smallselect">
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
</select></td>
</tr>
<tr>
<th>Lecturer</th>
<td><span id='lecturerspan'></span></td>
</tr>
<tr>
<td colspan="2"><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#schedulemodal">Select Day and Venue</button></td>
</tr>
<tr>
<td colspan="2"><textarea id="finalschedule" class="form-control"  rows="3" readonly></textarea>
</tr>
<tr>
<td colspan="2"><button class="btn-group-justified btn btn-primary" id="btnsave">Save</button></td>
</tr>
</table>
</div>
</div>
<div class="col-md-9" id="divlist">
<div class="spacersmall"></div>

<div class="table table-responsive" id="studentlist">

<img src="images/ajax-loader1.gif" id="bodyloader">
<div class='well well-sm text-center' id="bodyloader">
<h3>To load students, select from the parameters on the list</h3>
</div>
</div>
</div>



</div>

</div>

<!--modal -->
<div id="subjectmodal" class="modal fade" role="dialog">
<!--modal content-->
<div class="modal-dialog">
<!--modal content -->
<div class="modal-content">
<div class="modal-header"><h3><span id="courselevel">Test</span><button class="close pull-right" data-dismiss="modal">
&otimes;</button></h3>
</div>
<div class="modal-body" id="subjectlist">
Subject LIST
</div>
<div class="modal-footer"></div>
</div>

</div>
</div>


<!--schedule modal-->
<div id="schedulemodal" class="modal fade" role="dialog">
<!--modal content-->
<div class="modal-dialog">
<!--modal content -->
<div class="modal-content">
<div class="modal-header"><h3>Details<button class="close pull-right" data-dismiss="modal">
&otimes;</button></h3>
</div>
<div class="modal-body">
<table class="table">
<tr>
<th>Days</th>
<td><select id="days" class="mediumselect">
<option value="Monday">Monday</option>
<option value="Tueday">Tueday</option>
<option value="Wednesday">Wednesday</option>
<option value="Thursday">Thursday</option>
<option value="Friday">Friday</option>
</select></td>
</tr>

<tr>
<th>Venue</th>
<td><select id="venue" class="mediumselect">
<option value="Classroom 1">Classroom 1</option>
<option value="Classroom 2">Classroom 2</option>
<option value="Classroom 3">Classroom 3</option>
<option value="Classroom 4">Classroom 4</option>
<option value="Classroom 5">Classroom 5</option>
<option value="Classroom 6">Classroom 6</option>
<option value="Classroom 7">Classroom 7</option>
<option value="LAB 1">LAB 1</option>
<option value="LAB 2">LAB 2</option>
<option value="LAB 3">LAB 3</option>
<option value="LAB 4">LAB 4</option>
<option value="LAB 5">LAB 5</option>
</select></td>
</tr>

<tr>
<th>Time(Start):</th>
<td><input type="text" id="timefrom" class="smallselect" placeholder="hh:mm"><span id="error1" class="text-warning"></span></td>
</tr>
<th>Time(Finish):</th>
<td><input type="text" id="timeto" class="smallselect" placeholder="hh:mm"> <span id="error2" class="text-warning"></span></td>
</tr>
<tr>
<td></td>
<td><button class="btn btn-primary" id="addschedule" onClick="add_schedule()">Add</button>

<button class="btn btn-default" id="resetchedule">Reset</button>
</tr>
<tr>
<td colspan="2"><textarea id="schedule" class="form-control" rows="3" readonly></textarea>
</tr>

</table>
</div>
<div class="modal-footer">

<div class="modal-footer">
<button class="btn btn-danger btn-sm" id="finishschedule" data-dismiss="modal">
Done</button></div>
</div>

</div>
</div>

</div>

</body>
</html>
<script>
function add_schedule() {
var content=$("#schedule");
var days=$("#days").val();
var venue=$("#venue").val();
var time1=$("#timefrom").val();
var time2=$("#timeto").val();
if(time1=='') {
	$("#error1").html("Enter the start time");
}
else if(time2=='') {
	$("#error2").html("Enter the end time");
}
else {

var existing=content.val();
var combined=existing + "<li>"+days + "(" +time1 +"-" +time2 +")" + venue +"</li>\n";
content.val(combined);
$("#error1").html("");
$("#error2").html("");
$("#timefrom").val("");
$("#timeto").val("");
}
}

$("#finishschedule").click(function(e) {

    $("#finalschedule").val($("#schedule").val());
});

$("#resetchedule").click(function(e) {

    $("#finalschedule").val("");
	$("#schedule").val("")
});
</script>