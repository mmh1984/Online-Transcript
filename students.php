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
<link href="css/style1.css" rel="stylesheet" type="text/css"/>
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<script src="scripts/jquery-3.2.1.js" type="text/javascript"></script>
<script src="scripts/bootstrap.min.js" type="text/javascript">
</script>
<script src="scripts/registration.js" type="text/javascript"></script>


<script >
$(document).ready(function(e) {
	//add students//
	$("#btnsearch").click(function(e) {
      if($("#level").val()=='Others' && $("#others").val()==''){
		alert("Please enter the course level");
	  }
	  else {
		load_inputs();
		
	  }
    });
	//if change level
	$("#level").change(function(e){
	if($(this).val()=='Others'){
		$("#others").prop("disabled",false);
	}
	else {
		$("#others").prop("disabled",true);
		$("#others").val("");
	}
		
	})
	
	$("#closeloader").click(function(e) {
        $(".loading").hide();
		var campus=$("#campus").val();
	
	var course=$("#course").val();
	var level=$("#level").val();
	var month=$("#intakemonth").val();
	var year=$("#intakeyear").val();
	var intake=month + " " + year.substring(4,2);
		
		load_students(campus,course,level,intake);
    });
	
	
	$("#closeloader").click(function(e) {
        $("#loader").hide();
    });
	
});
	
	
	
 

	
	


</script>
<title>Admin</title>
</head>

<body>
<div class="container-fluid">
<!--main container-->
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
      <li class="active"><a href="admin.php">Home</a></li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="students.php">Students
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
 <div class='row' id='content' style="background-color:#fff;">
<div class='row'>
<div class='col-md-3 well'>
<table class='table table-striped smallfont'>
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
<td><select id="intakemonth" class='smallselect'>
 <option value='MAR'>March</option>
 <option value='JUL'>July</option>
 <option value='SEP'>September</option>
 <option value='DEC'>December</option>
</select>
<select id="intakeyear" class="smallselect">
<?php
$year=date('Y');
?>
<option value='<?php echo $year-1; ?>'><?php echo $year-1; ?></option>
<option value='<?php echo $year; ?>'><?php echo $year; ?></option>
<option value='<?php echo $year+1; ?>'><?php echo $year+1; ?></option>
</select>
</td>
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
<option value="Others">Others</option>


</select>
<input type='text' id='others' class='form-control' placeholder='applies to OTHERS	' disabled>
</td>
</tr>


<tr>
<th>No of Students</th>
</tr>
<tr>
<td><select id='noofstudents' class='smallestselect'>
<?php
for($x=1;$x<50;$x++){
	echo "<option value='$x'>$x</option>";	
}

?>
</select>
</td>
</tr>
<tr>
<th><button class='btn btn-primary' id='btnsearch'>Proceed</button></th>
</tr>
</table>
</div>

<div class='col-md-9'>
<div class='row'>
<div id='intro' class='col-md-12'>
<h3>To register students:</h3>
<ol class='well pagination-lg'>
	<li>Select Campus</li>
    <li>Select Intake (month/year)</li>
    <li>Select Course</li>
    <li>Select Level</li>
    <li>No of Students to add</li>
    <li>Proceed</li>
</ol>
</div>
</div>
<div class="row">

<div id='studentdetails' class='col-md-12'></div>

</div>
</div>

</div>
 </div>
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