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
<script src="script/search.js" type="text/javascript"></script>


<script >
$(document).ready(function(e) {
	
	$("#btnsearch").click(function(e) {
        var campus=$("#campus").val();
		var intake=$("#intake").val();
		var course=$("#course").val();
		
		search_classes(campus,intake,course);
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
<div class='row spacersmall'></div>
<div class='row'>
<div class='col-md-3 well'>
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

include 'assets/connection.php';

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
<th><button class='btn btn-primary' id='btnsearch'>Search</button></th>
</tr>

</table>
</div>

<div class='col-md-9'>
<div id='classes' class='row paddingsmall'>
<div class='well well-sm text-center' id="bodyloader">
<h3>To load classes, select from the parameters on the list</h3>
</div>
</div>
<div id='classSelected' class='row'></div>
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
