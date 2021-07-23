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
	$("#campusfilter").show();
	load_lecturer("");
	
	$("#campus").change(function(e) {
        load_lecturer($(this).val());
    });
	
	$("#closeloader").click(function(e) {
        $("#loader").hide();
    });
	
	$("#addlecturer").click(function(e) {
		
		$("#campusfilter").hide();
        add_lecturer();
		
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
        <li><a href="students.php">Students</a></li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Lecturers
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li id='addlecturer'><a href="#">Add Lecturer</a></li>
          <li><a href="lecturers.php">Search</a></li>
        
        </ul>
      
      </li>
      <li><a href="classes/index.php">Classes</a></li>
      
    <li class='dropdown'>
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Profile
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="profile.php">Change Password</a></li>
          <li><a href="logout.php">Logout</a></li>
        
        </ul>
      </li>
      </li>
    </ul>
 <p class='pull-right'><kbd>Logged in as: <?php echo $user; ?></kbd></p>
 </div>
 
 </div> 
 <!--end of navigation -->
 
 <!--start of content-->
 <!--dynamic content --> 
 <div style='height:30px;'></div>
 <div class='row'>
 <div class='col-md-1'></div>
 <div class='col-md-10 well'>
 <h3 class='text-center'>Lecturers</h3>
 <p class='alert alert-info' id='campusfilter'>
 Campus:<select id='campus' class='inputshortest'>
 <option value='BSB'>BSB</option>
  <option value='KB'>KB</option>
 </select>
 </p>
 <div class='row well'  id='content' style='height:500px;overflow:auto;'>
 

 
 </div>
 </div>
 <div class='col-md-1'></div>
 </div>
 </div>

  

</body>
</html>


<div id='loader'>
<div>
	<h5 align="center"><small>Loading messsage</small></h5>
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
<div class="modal-header"><h3>Message<button class="close pull-right" data-dismiss="modal">
&otimes;</button></h3>
</div>
<div class="modal-body text-center">

<p>Delete <span id="selectedic">Message</span>?</p>

<button class="btn btn-danger btn-sm" onClick="remove_lecturer()" data-dismiss="modal">Confirm</button>
<button class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
</div>
<div class="modal-footer"></div>
</div>

</div>
</div>


<!--end of modals-->



</body>
</html>