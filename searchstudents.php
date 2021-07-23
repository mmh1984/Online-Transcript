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
<meta name="viewport" content="width=device-width">
<meta name="description" content="Empowering your world of learning">
<meta name="keywords" content="webdesign,kemuda,brunei,it education,responsive">
<meta name="author" content="Wan Amirah">
<title>Admin</title>

<link href="css/style1.css" rel="stylesheet" type="text/css"/>
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<script src="scripts/jquery-3.2.1.js" type="text/javascript"></script>
<script src="scripts/bootstrap.min.js" type="text/javascript">
</script>
<script src="scripts/registration.js" type="text/javascript"></script>


<script>
$(document).ready(function(e) {
	
	$("#btnsearch").click(function(e) {
		$("#intro").hide();
        var campus=$("#campus").val();
		var intake=$("#intake").val();
		var course=$("#course").val();
		var level=$("#level").val();
		
		search_students(campus,intake,course,level);
    });
	
	$("#btncloseloading").click(function(e) {
    $(".loading").hide();
		var campus=$("#campus").val();
		var intake=$("#intake").val();
		var course=$("#course").val();
		
		search_students(campus,intake,course,level);
	
});
$("#btncloseloading2").click(function(e) {
      $(".loading").hide();
});
	
 });



</script>
</head>

<body>
<div class="container-fluid">
<!--main container-->
<div class="row" style="background-color:#003;">
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
      <li><a href="admin.php">Home</a></li>
      <li class="dropdown">
        <a class="dropdown-toggle  active" data-toggle="dropdown" href="students.php">Students
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="students.php">Add Students</a></li>
          <li><a href="searchstudents.php">Search</a></li>
        
        </ul>
      </li>
     <li><a href="lecturers.php">Lecturers</a></li>
      <li><a href="classes/index.php">Classes</a></li>
      
     <li class='dropdown'>
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Profile
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="profile.php">Change Password</a></li>
          <li><a href="logout.php">Logout</a></li>
        
        </ul>
      </li>
    </ul>
 
<p class='pull-right'><kbd>Logged in as: <?php echo $user; ?></kbd></p>
 </div>
 
 </div>
 <!--end of navigation -->
 
 <!--start of content-->
 <!--dynamic content -->
 <div class='row'>
<div class='col-md-2 well'>
<table class='table table-striped'>
<tr>
<th>Select Campus</th>
</tr>
<tr>
<td><select id="campus" class='smallselect'>
<option value="BSB">BSB</option>
<option value="KB">KB</option>
</select></td>
</tr>

<tr>
<th>Select Intake</th>
</tr>
<tr>
<td><select id="intake" class='smallselect'>
<?php

include 'functions/connection.php';

$query=mysqli_query($con,"SELECT distinct intake from tblstudents");

while($r=mysqli_fetch_array($query)) {
	echo "<option value='$r[0]'>$r[0]</option>";
}
mysqli_close($con);	
?>
</select></td>
</tr>
<tr>
<th>Select Course</th>
</tr>
<tr>
<td><select id="course" class='smallselect'>
<option value="NCC">NCC</option>
<option value="BTEC" selected>BTEC</option>
<option value="LCCI">LCCI</option>
<option value="OUM">OUM</option>
</select></td>
</tr>

<tr>
<th>Select Level</th>
</tr>
<tr>
<td><select id="level" class='smallselect'>
<option value="L2">Level 2</option>
<option value="L3">Level 3</option>
<option value="L4">Level 4</option>
<option value="L5">Level 5</option>
<option value="">Others</option>


</select>

</td>
</tr>
<tr>
<th><button class='btn btn-primary' id='btnsearch'>Search</button></th>
</tr>
</table>
</div>

<div class='col-md-10'>
<div id='intro' class='row paddingsmall'>
<div class='well well-sm text-center' id="bodyloader">
<h3>To load students, select from the parameters on the list</h3>
</div>
</div>
<div class='row'>
<div class='col-md-12'  id='studentdetails'>

</div>
</div>
</div>
</div>

<!--end of contents-->
</div>

<!--modals -->
<!--modal -->
<div id="confirmmodal" class="modal fade" role="dialog">
<!--modal content-->
<div class="modal-dialog modal-sm">
<!--modal content -->
<div class="modal-content">
<div class="modal-header"><h3><span id="selectedic">Message</span><button class="close pull-right" data-dismiss="modal">
&otimes;</button></h3>
</div>
<div class="modal-body text-center">

<p>Deleting this student will also remove him from all related records</p>

<button class="btn btn-danger btn-sm" onClick="remove_student()" data-dismiss="modal">Confirm</button>
<button class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
</div>
<div class="modal-footer"></div>
</div>

</div>
</div>


<div class='loading'>
    <div class='shadow text-center'>
    <h4 align="center" id='loadingmessage'>Saving Attendance</h4>
    <img src='images/loader.gif' id="bodyloader">
    <button class='btn btn-primary center-block' id='btncloseloading'>Close</button>
    <button class='btn btn-primary center-block' id='btncloseloading2'>Close</button>
   </div>

</div>

<!--end of modals-->


</body>
</html>

 </div>

  

</body>
</html>


<div id='loader'>
<div>
	<h3 align="center">Loading messsage</h3>
    <img src='images/loader.gif' width='100px' class='center-block'>
    <br/>
    <button id='closeloader' class='btn btn-primary center-block'>Close</button>
</div>

</div>

<!--end of contents-->
</div>

<!--modals -->
<!--modal -->
<div id="confirmmodal" class="modal fade" role="dialog">
<!--modal content-->
<div class="modal-dialog modal-sm">
<!--modal content -->
<div class="modal-content">
<div class="modal-header"><h3><span id="courselevel">Message</span><button class="close pull-right" data-dismiss="modal">
&otimes;</button></h3>
</div>
<div class="modal-body text-center">

<p>Deleting this subject will also remove the students from this class</p>

<button class="btn btn-danger btn-sm" onClick="delete_class()" data-dismiss="modal">Confirm</button>
<button class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
</div>
<div class="modal-footer"></div>
</div>

</div>
</div>


<!--end of modals-->



</body>
</html>