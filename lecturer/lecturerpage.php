<?php

session_start();
include '../functions/functions.php';
if(!isset($_SESSION['user'])&&($_SESSION['level']!='lecturer')) {
	header('location:../index.php');
}
else {
	$user=$_SESSION['user'];
	

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">

<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<meta name="description" content="Empowering your world of learning">
<meta name="keywords" content="webdesign,kemuda,brunei,it education,responsive">
<meta name="author" content="Wan Amirah">
<link href="../css/style1.css" rel="stylesheet" type="text/css"/>
<link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<script src="../scripts/jquery-3.2.1.js" type="text/javascript"></script>
<script src="../scripts/bootstrap.min.js" type="text/javascript"></script>
<script src="scripts/posts.js" type="text/javascript">
</script>

<script>

$(document).ready(function(e) {
    
	
	load_posts();
	$(".profilemenu").css("display","none");
	
	$(".profileimg").click(function() {
	$(".profilemenu").slideToggle();	
		
	});
	
	$("#box1,#box2,#box3").css("display","none");
	$("#contentdetails #coursedetails").css("display","block");
	$("#contentdetails #coursedetails div").css("display","block");
	
	$("#classlink").click(function(){
		$("#box2,#box3,#coursedetails").css("display","none");
		$("#box1").slideDown();
	});
	
		$("#marklink").click(function(){
		$("#box1,#box3,#coursedetails").css("display","none");
		$("#box2").slideDown();
	});
	
		$("#courselink").click(function(){
		$("#box1,#box2,#coursedetails").css("display","none");
		$("#box3").show();
	});
	$("#box1 span").click(function() {
		$("#box1").slideUp();
		
		$("#contentdetails #coursedetails").slideDown();
		$("#contentdetails #coursedetails div").slideDown();
	});
	
	$("#box2 span").click(function() {
		$("#box2").slideUp();
		
		$("#contentdetails #coursedetails").slideDown();
		$("#contentdetails #coursedetails div").slideDown();
	});
	
	$("#box3 span").click(function() {
		$("#box3").slideUp();
		
		$("#contentdetails #coursedetails").slideDown();
		$("#contentdetails #coursedetails div").slideDown();
	});
	
$("#logoutlink").click(function(){
	
	window.location.href='../logout.php';
	});
	
	$("#changepasslink").click(function(e) {
        $(".changepass").css("display","block");
    });
	
	$(".close").click(function(e) {
        $(".changepass").css("display","none");
    });
	
});



function delete_comment(id,btn) {
var a=$(btn).parent("div").attr("id");
alert(a);
}
</script>

<title>PORTAL|Students</title>
</head>

<body style='background:url(../images/adminbg.jpg);'>
<div class="container">
<div class="row">
<div class="col-md-12" style="height:10px"></div>
</div>
<div class="panel panel-primary">
<div class="panel-heading row" style="border-top:2px groove #FC0;border-bottom:2px groove #FC0;">
<div class="col-md-1"><img src="../images/logo.png" width="100px"></div>
<div class="col-md-9">
<h1>Lecturer Portal Page</h1>
<h6>Logged as:<?php  echo "<kbd>".$user."</kbd>"; ?>
</h6>

<ul class="btn-group">
	
    <li class="btn btn-primary" id="classlink">Classes</li>
    <li class="btn btn-primary" id="courselink">Post a memo</li>
  

</ul>
</div>
<div class="col-md-2 text-center">
<span>
<br/>
<img src="../images/profile.png" alt="profile" class="profileimg btn btn-default btn-lg" width="50px">
<div class="profilemenu">
<ul class="btn btn-group-vertical">
	<li id="changepasslink" class="btn btn-default" data-toggle="modal" data-target="#changepassword">Change Password</li>
    <li id="logoutlink" class="btn btn-default">Logout</li>
</ul>

</div>
</span>

</div>

<div class="container">





</div>
</div>
<div class="panel-body">

<div class="row" id="contentdetails">
<div id="coursedetails">

<fieldset class="well">
<h2 class="box-title">Welcome to Lecturer Portal</h2>
<p class="alert alert-info">
Our Teachers’ Portal is meant to be used a simple guide for teachers to enter marks for their students

	
All the featured tips are simple ideas that you can try in your classes and that can work with students of any academic level. All our online tools are easy to use by teachers with any level of computer literacy. 
</p>
<p class="alert alert-info">
On this page, you will find a summary of the different areas featured in the portal.
</p>

</div>

</fieldset>

</div>

<!--marks -->
<div id="box1">

<h3>Your Classes</h3>
<span class="btn btn-default pull-right">&times;</span>

<hr/>
<p><em>Select your class to view students and their marks by clicking on the "code"</em></p>


<fieldset class="well well-sm">
<?php
	include '../functions/connection.php';
$query=mysqli_query($con,"SELECT DISTINCT
tblclasses.`code`,
tblclasses.course,
tblclasses.`schedule`,
tblclasses.`subject`,
tblclasses.intake
FROM
tblclasses
WHERE lecturer='$user'
");

if((mysqli_num_rows($query))==0) {
	echo "<p>You have no groups or classes</p>";
}
else {
	
?>
    
<table class="table table-condensed table-striped">
<tr>
<th>Class Code</th>
<th>Course</th>
<th>Schedule</th>

<th>Subject</th>
<th>Semester</th>


</tr>	
<?php	
while($row=mysqli_fetch_array($query,MYSQLI_NUM)) {
	echo "<tr>";
	echo "<td ><a href='classes.php?code=$row[0]' class='btn btn-default'>$row[0]</a></td>";
	echo "<td>$row[1]</td>";
	echo "<td><ul class='list-group'>$row[2]</ul></td>";

	echo "<td>$row[3]</td>";
	echo "<td>$row[4]</td>";
	
	echo "</tr>";
}

mysqli_close($con);
}

?>

</table>

</fieldset>



</div>


<!--box2-->
<div id="box2">
<span class="btn btn-default pull-right">&times;</span>


<hr/>

</div>

<!--box2 end-->

<!--box3 -->
<div id="box3">

<span class="btn btn-default pull-right">&times;</span>
<hr/>


<div>

<h3>Post News/Announcement</h3>
<button class='btn btn-primary btn-sm' data-toggle='modal' data-target='#modalpost'>Add post</button>
<div class='postcontainer'>
<!--post-->


<!--end of post-->
</div>

</div>


</div>
<!--box3end-->
</div>
<button id='btnclasspost' data-toggle='modal' data-target='#modalclasspost' hidden="true"></button>
<div class="panel-footer">
</div>
</div>


</div>
 
</body>

<!--comments-->
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

<!--changepass -->

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
	include '../functions/connection.php';
	
	$query=mysqli_query($con,"SELECT password FROM tbllecturers WHERE email='$user'");
	while($x=mysqli_fetch_array($query,MYSQLI_NUM)) {
	$op=$x[0];
	}
	
	mysqli_close($con);
	
	if($oldpass!=$op) {
	echo "<script> alert('Your old password is incorrect');</script>";	
	}
	else {
	update_password('tbllecturers','email','password',$user,$newpass);	
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

<!--post modal-->

<div class="modal fade" id="modalpost" role="dialog">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header bg-primary"><h3>Details<button class="close text-right" data-dismiss="modal">&otimes;</button></h1></div>
<div class='modal-body'>
<img src='../images/loader.gif' width='10%' class='center-block' style='display:none'>
<table class="table table-condensed">

<tr>
<td>Title*</td>
<td><input class="form-control inputshort" type="text" id="postitle" required></td>
</tr>
<tr>
<td>Contents*</td>
<td><textarea  class="form-control inputshort" id="postcontents" cols="50" rows="5" required></textarea></td>
</tr>
<tr>
<td>Privacy/Access *</td>
<td><select id="postaccess" class="form-control inputshort">

<option value="public">public</option>
<?php
include '../functions/connection.php';
$query=mysqli_query($con,"SELECT DISTINCT tblclasses.code,tblclasses.subject FROM tblclasses WHERE tblclasses.lecturer='$user'");

while($row=mysqli_fetch_array($query,MYSQLI_NUM)){
	echo"<option value='$row[0]'>$row[1]</option>";
}
mysqli_close($con);
?>
</select></td>
</tr>
<td>Attachments (link)</td>
<td><input class="form-control inputshort" type="text" id="postattachment"><p class='alert alert-info'>use link from any url (onedrive,googledrive, etc)</p></td>
</tr>

<td>File Type</td>
<td><select id="posttype" class="form-control inputshort">
	<option value="None">None</option>
	<option value="PDF">PDF</option>
    <option value="DOCX">Word Document</option>
    <option value="PPT">Powerpoint</option>
    <option value="XLSX">Excel</option>
    <option value="IMG">Image</option>
    <option value="COMPRESSED">Compressed File</option>
</select>
</td>
</tr>
<tr>
<td></td>
<td><button class='btn btn-primary' id='btnsavepost' onClick="save_post()">Save</button></td>
</tr>
</table>


</div>
</div>

</div>
</div>
</html>
<?php
}
?>