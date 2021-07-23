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
<script>
$(document).ready(function(e) {
	
	
	//close loader
	$("#closeloader").click(function(e) {
        $("#loader").hide();
    });
	
	//submit the 
});
</script>
<title>Admin</title>
</head>

<body >
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
      <li class="active"><a href="#">Home</a></li>
      <li><a c href="students.php">Students</a>
        
      </li>
        <li><a href="lecturers.php">Lecturers</a>
         <li><a href="classes/index.php">Classes</a>
      
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
 
 <!--start of content--><div style='height:30px'></div>
 <div class='row' id='intro'>
	<div class='col-md-1'></div>
    <div class='col-md-10 jumbotron' style='padding:2%'>
   <h2>Welcome</h2>
	<hr/>
   <p>This page is exclusively designed for KEMUDA Institute's users only. Any unauthorized use of this system is subject to legal sanctions</p>
   <p>The admin can perform the following tasks</p>
   <ul class='well alert alert-info'>
   <li>Add and edit lecturer's details</li>
   <li>Add and edit student's details</li>
   <li>Create classes and groups</li>
   </ul>
   <p class='alert alert-warning'>All information used in this system is proprietarily owned by KEMUDA Institute. Distribution of its contents are copyright violation and punishable by law under Brunei Penal Code</p>
    </div>
    <div class='col-md-1'></div>
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
</body>
</html>