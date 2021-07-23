<?php

$option=$_POST['option'];

switch($option){

case "savepost":
save_post();
break;	

case "comments":
load_comments();
break;	

case "delete":
delete_comments();
break;	
}

function delete_comments(){
	$id=$_POST['id'];

	include '../../functions/connection.php';
	
	$query=mysqli_query($con,"DELETE FROM tblcomments WHERE id=$id");
	
	if($query){
	echo "success";	
	}
	mysqli_close($con);
	
}

function load_comments(){
	session_start();
	$ic=$_SESSION['user'];
	$id=$_POST['id'];

	include '../../functions/connection.php';
	
	$query=mysqli_query($con,"SELECT * FROM tblcomments WHERE postid=$id ORDER BY id desc");
	$count=mysqli_num_rows($query);
	echo "<p class='text-muted'>$count comments</p>";
	if($count > 0){
		
		while($row=mysqli_fetch_array($query,MYSQLI_NUM)){
			if($row[3]==$ic){
				echo "<div class='media text-success'>";
			}
			else{
			echo "<div class='media'>";
			}
			echo "<div class='media-body'>
             
                <p>From:<span class='reviewer-name'><strong>$row[3]</strong></span> on <span class='review-date'>$row[4]</span><p>
                <p><blockquote style='font-size:.9em;font-style:italic'>$row[2]</blockquote></p>
				
                <p></p>";
				if($row[3]==$ic){
		
			echo "<p style='font-size:.8em;cursor:pointer;' class='text-primary' onclick='delete_comment(\"$row[0]\",\"$row[1]\")' align='right'>Delete comment</p>";
			}
			echo"</div></div>";	
			
			
			

		
		}
		
	}
	else {
	echo "<p>No comments yet.</p>";	
	}
	
}

function save_post(){
	session_start();
	$ic=$_SESSION['user'];
	$id=$_POST['id'];
	$comment=$_POST['comment'];
	$date=date('Y-m-d');
	
	include '../../functions/connection.php';
	$query=mysqli_query($con,"INSERT INTO `tblcomments` (`postid`, `comment`, `commentsource`, `date`) VALUES ($id, '$comment', '$ic', '$date')");
	
	if($query){
	echo "success";	
	}
	else{
	echo (die(mysqli_error($con)));	
	}
	mysqli_close($con);
	
}
?>