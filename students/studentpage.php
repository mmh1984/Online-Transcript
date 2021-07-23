<?php
session_start();
if(!$_SESSION['user'] && $_SESSION['level']!='student'){
header("location:../index.php");
		
	
}

else {
		$user=$_SESSION['user'];
		


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/user.css">
    <link rel="stylesheet" href="assets/bootstrap/fonts/font-awesome.min.css">
    <script src="assets/js/jquery.min.js" type='text/javascript'></script>
     <script src="assets/js/functions.js" type='text/javascript'></script>
    <script>
	$(document).ready(function(e) {
		
		
        show_profile();
		show_classes();
		class_post("ALL");
		public_post();
		
    });
	
	
	</script>
</head>

<body>
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
            <input type='hidden' value='<?php echo $user; ?>' id='ic'>;
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button><a class="navbar-brand navbar-link" href="#">KEMUDA <small>Student Portal</small></a></div>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav navbar-right">
                    <li role="presentation"></li>
                    <li role="presentation"></li>
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#">Profile <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li data-target='#changepassword' data-toggle='modal'><a href="#">Change Password</a></li>
                            <li><a href="#" onClick="logout()">Logout</a></li>
                            
                        </ul>
                    </li>
                   
                </ul>
            </div>
        </div>
    </nav>

    <div class="container" id='mainbody' >
        <hr/>
        <!--profile-->
        <div class='row' id='profile'>
        </div>
        
        
        
        <!--end of profile-->
        <hr/>
        <div class="row">
            <div class="col-md-7" id='myclasses'>
               
                
                </div>
            <div class="col-md-5" id='classpost'>
                
                
                </div>
        </div>
        <hr/>
        <div class="row">
        <h4 class='page-header' style='margin-left:10px;'>Public Posts</h4>
        
        <div id='publicpost'>
        
        </div>
        </div>
        
        <footer class="site-footer">
        <div class="container">
            <hr>
            <div class="row">
                <div class="col-sm-6">
                <button id='btnclasspost' data-toggle='modal' data-target='#modalclasspost' hidden="true"></button>
                    <h5>KEMUDA INSTITUTE</h5></div>
            </div>
        </div>
        <div></div>
    </footer>
        
    </div>
    
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    
    <!--modal section -->
    <div class='modal fade' role='dialog' id='modalclasspost'>
    	<div class='modal-dialog modal-lg'>
        <div class='modal-content'>
        	<div class='modal-header'>
            <h3>Post Details<span class='close' align='right' data-dismiss='modal'>&otimes;</span></h3>
            </div>
            <div class='modal-body'>
            <div class='row'>
            <div class='col-md-7' id='postdetails'>
            </div>
            <div class='col-md-5' style='border-left:1px dotted #666'>
            <h4>Comments</h4>
            <div id='allcomments'>
            </div>
            </div>
            </div>
            </div>
            <div class='modal-footer'></div>
        
        </div>
    </div>
    </div>
    
    
    <!--change password-->
    
    <div class="modal fade" id="changepassword" role="dialog">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header bg-primary"><h3>Change Password<button class="close text-right" data-dismiss="modal">&otimes;</button></h1></div>
<div class="modal-body">
<?php

if(isset($_POST['change'])) {
	$user=$_SESSION['user'];
	$oldpass=$_POST['oldpass'];
	$newpass=$_POST['newpass'];
	include '../functions/functions.php';
	include 'assets/functions/connection.php';
	$query=mysqli_query($con,"SELECT password FROM tblstudents WHERE icnumber='$user'");
	while($x=mysqli_fetch_array($query,MYSQLI_NUM)) {
	$op=$x[0];
	}
	
	mysqli_close($con);
	
	if($oldpass!=$op) {
	echo "<script> alert('Your old password is incorrect');</script>";	
	}
	else {
	update_password('tblstudents','icnumber','password',$user,$newpass);	
	}
	
}
?>


<form action="#" method="POST">
	
<table class="table-condensed">
<tr>
<td>Old Password</td>
<td><input type="password" name="oldpass" class="form-control"></td>

</tr>
<tr>
<td>New Password</td>
<td><input type="password" name="newpass" class="form-control"></td>
</tr>
<tr>
<td></td>
<td><input type="submit" name="change" value="change" class="btn btn-primary">

</td>
</tr>
</table>
</form>




<div class="modal-footer text-center">
<button class="btn btn-default" data-dismiss="modal">Dismiss</button>

</div>
</div>
</div>

</div>
</div>
</body>

</html>

<?php
}
?>