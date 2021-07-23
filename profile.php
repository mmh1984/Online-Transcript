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
<link href="classes/css/custom.css" rel="stylesheet" type="text/css"/>
<link href="https://fonts.googleapis.com/css?family=Lato|Slabo+27px" rel="stylesheet">
<link href="classes/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<script src="classes/script/jquery.min.js" type="text/javascript"></script>
<script src="classes/script/bootstrap.min.js" type="text/javascript"></script>
<script src="classes/script/search.js" type="text/javascript"></script>


<script >
$(document).ready(function(e) {
	
	
	
	$("#btnsave").click(function(e) {
		
        var oldpassvalue='';
		var oldpass='';
		var newpass='';
		
		oldpassvalue=$("#oldpassvalue").val();
		
		oldpass=$("#oldpass").val();
		newpass=$("#newpass").val();
		
		if(oldpass==''){
			$("#message").html("enter your old password");	
		}
		else if(newpass==''){
			$("#message").html("enter your new password");	
		}
		else{
			if(oldpass != oldpassvalue){
			$("#message").html("Your old password is incorrect");	
			}
			else {
				$("#message").html("<img src='classes/images/ajax-loader.gif'>");	
				$.ajax({
					type:"POST",
					url:"classes/script/functions.php",
					data:{
						option:"change",
						newpass:newpass	
					},
					success: function(result){
						
						if(result=='success'){
							alert('Your password has been updated.You need to login again');
							window.location.href='logout.php';	
						}
						else {
							$("#message").html("Password update failed");	
						}
					
						alert(result);
						
					}
					
				});
				
			}
		}
		
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
<div class='row' style='margin-top:30px;'>
<div class='col-md-3'></div>
<div class='col-md-6'>
<div class='panel panel-primary'>
	<div class='panel-heading' style='background-color:#003;'><h4>Change Password</h4></div>
    <div class='panel-body'>
    <?php
	include 'functions/connection.php';
	$query=mysqli_query($con,"SELECT * FROM tblusers WHERE username='$user'");
	
	while($row=mysqli_fetch_array($query)){
		
		$password=$row[2];
    
    ?>
 
  
        	
        
        <table class='table table-striped' id='passwordspan'>
        <tr>
        	<th>Old Password
            <input type='hidden' id='oldpassvalue' value="<?php echo $password ?>">
            </th>
            <td><input type='password' id='oldpass' placeholder='*******'></td>
        </tr>
         <tr>
        	<th>New Password</th>
            <td><input type='password' id='newpass' placeholder='*******'></td>
        </tr>
         <tr>
        	<th></th>
            <td><span id='message' class='text-danger'></span>
            </td>
      
       
       
    </table>
    <button class='btn btn-primary center-block' id='btnsave'>Change Password</button>
    <?php
	
	}
	?>
    </div>
    <div class='panel-footer'></div>
</div>
</div>
<div class='col-md-3'></div>
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
