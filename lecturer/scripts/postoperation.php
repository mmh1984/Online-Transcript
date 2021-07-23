<?php

$operation=$_POST['operation'];
	
switch($operation){
	case "savepost":
	save_post();
	break;
	
	case "loadpost":
	load_post();
	break;
	
	case "deletepost":
	delete_post();
	break;
}

function delete_post(){
	
	include '../../functions/connection.php';
	$id=$_POST['id'];
	$query=mysqli_query($con,"DELETE FROM tblposts WHERE id=$id");
	//$query2=mysqli_query($con,"DELETE FROM tblcomments WHERE postid=$id");
	mysqli_close($con);
}

function load_post(){
	session_start();
	$user=$_SESSION['user'];
	include '../../functions/connection.php';
	$query=mysqli_query($con,"SELECT * FROM tblposts WHERE postedby='$user' ORDER BY id DESC");
	
	while($row=mysqli_fetch_array($query,MYSQLI_NUM)){
		echo "<div>
<h4>$row[1]<span class='pull-right' id='postedto'>Posted To:<strong>$row[3]</strong></h4>
<p class='alert alert-info'><em>$row[2]</em></p>
<p class='text-muted'>Posted on <strong>$row[6]</strong></p>

<button class='btn btn-primary btn-sm' onclick='view_post(\"$row[0]\")'>View Comments</button>
<button class='btn btn-danger btn-sm' onclick='delete_post(\"$row[0]\")'>Delete</button>

</div>
<br/>
";
	}
	
	mysqli_close($con);
}

function save_post(){
	session_start();
	$user=$_SESSION['user'];
	
	include '../../functions/connection.php';
	$title=mysqli_real_escape_string($con,$_POST['title']);
	$contents=mysqli_real_escape_string($con,$_POST['contents']);
	$privacy=$_POST['privacy'];
	$attachmentlink=mysqli_real_escape_string($con,$_POST['attachmentlink']);
	$filetype=$_POST['filetype'];
	$date=date('Y-m-d');

	
	$query=mysqli_query($con,"INSERT INTO `tblposts` (`title`, `contents`, `privacy`, `attachmentlink`, `filetype`, `dateposted`,`postedby`) VALUES ('$title','$contents','$privacy','$attachmentlink','$filetype','$date','$user')");
	if($query){
		echo "success";
	}
	else {
		echo(die(mysqli_error($con)));	
	}
	mysqli_close($con);
}

?>