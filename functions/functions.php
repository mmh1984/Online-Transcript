<?php


function login_user() {
		
	
}

function update_password($table,$column1,$column2,$user,$newpass) {
	include 'connection.php';
	$query=mysqli_query($con,"UPDATE $table set $column2='$newpass' WHERE $column1='$user'");
	
	if($query) {
		
		session_destroy();
		session_unset();
	echo "<script> alert('Password Updated. You need to login to continue');</script>";
	echo "<script> window.location.href='../index.php'</script>";	
		
	}
	else {
	
	echo mysqli_error();	
	}
	
}

function get_id($email) {
	include 'connection.php';
	$id="";
	$query=mysqli_query($con,"SELECT accountid FROM tbllecturers WHERE email='$email'");
	
	while($row=mysqli_fetch_array($query,MYSQLI_NUM)) {
		$id=$row[0];
	}
	return $id;
	
	mysqli_close($con);
	
}

function load_news($id) {
	include 'connection.php';

	$qrystr="SELECT * FROM tblnews WHERE groupcode=(SELECT code from tblgroups WHERE studentid='$id') or groupcode='public'";
$query=mysqli_query($con,$qrystr);
	echo "<ol class='list-group' style='margin:40px;padding-left:20px;'>";

	while ($row=mysqli_fetch_array($query,MYSQLI_NUM)){
		
		echo "<li><strong><a href='viewnews.php?newsid=$row[0]'>$row[2]</a></strong> <code>(posted by lecturer: $row[7])</code>
			<ul>
			
			<li class='badge'>Date posted:$row[1]</li>	
		
			</ul>
		</li>";
	}
	echo "</ol>";
	
	mysqli_close($con);
	
	
}


function load_comments($id) {
	include 'connection.php';

	$qrystr="SELECT * FROM tblcomments WHERE newsid=$id order by id DESC";
$query=mysqli_query($con,$qrystr);
	

	while ($row=mysqli_fetch_array($query,MYSQLI_NUM)){
		list($y,$m,$d)=explode("-",$row[4]);
		$date="$d-$m-$y";
		echo "
			<p class='well well-sm'>$row[3]<br/>
			<kbd>Posted by: $row[2]</kbd><br>Posted on:<code>$date</code></p>
		
		";
	}

	
	mysqli_close($con);
	
	
}

function load_comments2($id) {
	include 'connection.php';

	$qrystr="SELECT * FROM tblcomments WHERE newsid=$id order by id DESC";
$query=mysqli_query($con,$qrystr);
	
$var="";
if((mysqli_num_rows($query))>0){
	$count=0;
	while ($row=mysqli_fetch_array($query,MYSQLI_NUM)){
		list($y,$m,$d)=explode("-",$row[4]);
		$count++;
		$id="btndelete".$count;
		$date="$d-$m-$y";
		$var.= "
			<p class='alert alert-success' align='right'>
			<span style='font-size:18px;margin:10px;'><kbd>\"$row[3]\"</kbd></span><br/>
			Posted by: $row[2] on: $date
			<br/>
			<br/>
			<button class='btn btn-danger btn-sm' id='$id' onclick='delete_comment($row[0],this)'>Delete</button>
			</p>
			
			";
			
	
	}
}
else {
	
	$var="<p class='alert alert-danger'>No comments</p>";
	}

	return $var;
	mysqli_close($con);
	
	
}


function load_courses() {
	
include 'connection.php';

$query=mysqli_query($con,"SELECT DISTINCT courseProvider FROM tblCourses");

	while ($row=mysqli_fetch_array($query,MYSQLI_NUM)){
		
		echo "<option value='$row[0]'>$row[0]</option>";
	}
	
	
	mysqli_close($con);
	
}

function create_marks($values) {
	include 'connection.php';

	$qrystring="INSERT INTO tblmarks(code,studentid,assignment,exam,total,status,comments,date) VALUES ($values)";
	
	$query=mysqli_query($con,$qrystring);
	
	if($query) {
		
		
	}
	else {
		echo mysqli_error($con);
		/*display_message("error","error.php?message=inda dapat");*/
	}
	
	mysqli_close($con);
	
}

function save_student($values) {
	include 'connection.php';

	$qrystring="INSERT INTO tblstudents(studentid,studentname,studenttype,courseprovider,courselevel,studentpass) VALUES ($values)";
	
	$query=mysqli_query($con,$qrystring);
	
	if($query) {
		
		
	}
	else {
		echo mysqli_error($con);
		/*display_message("error","error.php?message=inda dapat");*/
	}
	
	mysqli_close($con);
}

function save_group($values) {
	include 'connection.php';

	$qrystring="INSERT INTO tblgroups(code,course,classchedule,classtime,subject,lecturer,studentid,semester,schoolyear) VALUES ($values)";
	
	$query=mysqli_query($con,$qrystring);
	
	if($query) {
		
		
	}
	else {
		echo mysqli_error($con);
		/*display_message("error","error.php?message=inda dapat");*/
	}
	
	mysqli_close($con);
}

function save_class($values) {
	include 'connection.php';

	$qrystring="INSERT INTO tblclasses(code,course,schedule,time,subject,lecturer,semester,schoolyear) VALUES ($values)";
	
	$query=mysqli_query($con,$qrystring);
	
	if($query) {
		
		
	}
	else {
		echo mysqli_error($con);
		/*display_message("error","error.php?message=inda dapat");*/
	}
	
	mysqli_close($con);
}

function check_student_id($id) {
	$status=false;
	
	include 'connection.php';
	$query=mysqli_query($con,"SELECT * FROM tblstudents WHERE studentid='$id'");
	
	if(mysqli_num_rows($query) > 0) {
		
	$status=true;
	}
	mysqli_close($con);
	return $status;
	
}

function display_message($message,$redirectto) {
	echo "<script>alert('$message')</script>";
	echo "<script>window.location.href='$redirectto'</script>";
}

function load_all_students($querystring){
	include 'connection.php';
	$query=mysqli_query($con,$querystring);
	
	while($row=mysqli_fetch_array($query,MYSQLI_NUM)){
	echo "<tr>";
	 echo "<td>$row[0]</td>";
	 echo "<td>$row[1]</td>";
	 echo "<td>$row[2]</td>";
	 echo "<td>$row[3]</td>";
	 echo "<td>$row[4]</td>";
	 echo "<td><input type='checkbox' name='selected[]' id='ticked' value='$row[0]'/></td>";
	
	echo "</tr>";
	}
	
	mysqli_close($con);
	
}

function load_all_lecturer($querystring){
	include 'connection.php';
	$query=mysqli_query($con,$querystring);
	
	while($row=mysqli_fetch_array($query,MYSQLI_NUM)){
	echo "<tr>";
	 echo "<td>$row[1]</td>";
	 echo "<td>$row[2]</td>";
	 echo "<td>$row[3]</td>";
	 echo "<td>$row[5]</td>";
	 echo "<td>$row[6]</td>";
	 echo "<td><input type='checkbox' name='selected[]' id='ticked' value='$row[0]'/></td>";
	
	echo "</tr>";
	}
	
	mysqli_close($con);
	
}

function load_all_groups($querystring){
	include 'connection.php';
	$query=mysqli_query($con,$querystring);
	
	while($row=mysqli_fetch_array($query,MYSQLI_NUM)){
	echo "<tr>";
	 echo "<td>$row[0]</td>";
	  echo "<td>$row[1]</td>";
	 echo "<td>$row[2]</td>";
	 echo "<td>$row[3]</td>";
	  echo "<td>$row[4]</td>";
	 echo "<td>$row[5]</td>";
	 echo "<td>$row[6]</td>";
	  echo "<td>$row[7]</td>";
	 echo "<td><input type='checkbox' name='selected[]' id='ticked' value='$row[0]'/></td>";
	
	echo "</tr>";
	}
	
	mysqli_close($con);
	
}


function delete_student($x) {
	include 'connection.php';
	$query=mysqli_query($con,"DELETE FROM tblstudents WHERE studentid='$x'");
	
	if(!$query) {
	  echo mysqli_error($con);	
	}
	mysqli_close($con);
}

function delete_classes($x) {
	include 'connection.php';
	$query=mysqli_query($con,"DELETE FROM tblclasses WHERE code='$x'");
	
	if(!$query) {
	  echo mysqli_error($con);	
	}
	
	mysqli_close($con);
}

function delete_group($x) {
	include 'connection.php';
	$query=mysqli_query($con,"DELETE FROM tblgroups WHERE code='$x'");
	
	if(!$query) {
	  echo mysqli_error($con);	
	}
	
	mysqli_close($con);
}

function delete_lecturer($x) {
	include 'connection.php';
	$query=mysqli_query($con,"DELETE FROM tbllecturers WHERE accountid='$x'");
	
	if(!$query) {
	  echo mysqli_error($con);	
	}
	mysqli_close($con);
}
?>