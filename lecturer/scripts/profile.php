<?php
$option=$_POST['option'];

switch($option){

case 'profile':
load_profile();
break;	

case 'classes':
load_classes();
break;

case 'classpost':
load_class_post();
break;

case 'classpostdetails':
load_class_post_details();
break;

case 'publicpost':
load_public_posts();
break;
	
}


function load_class_post_details(){
session_start();
	$id=$_POST['id'];
	
	include '../../functions/connection.php';
	$query=mysqli_query($con,"SELECT * FROM tblposts WHERE id='$id'");
	
	if(mysqli_num_rows($query)>0){
	
	
	while($row=mysqli_fetch_array($query,MYSQLI_NUM)){
	echo "
	
	<div class='media'>
            <div class='media-body'>
                <h4 class='media-heading'>$row[1]</h4>
                
                <p>$row[2]</p>
				 <p>Attachment:<a href='$row[5]' download>Download attachment</a></p>
                <p><span class='reviewer-name'><strong>$row[7]</strong></span> on <span class='review-date'>$row[6]</span></p>
            </div>
			<hr/>
			<textarea id='postcomment' cols='50' rows='4' placeholder='write a comment(200 chars)' maxlength='200'></textarea><br/>
			<button class='btn btn-primary btn-sm' onclick='save_comment(\"$row[0]\")'>Post</button>
        </div>

	";
		
	}
	
	}
	else {
	echo "<p>No posts</p>";	
	}
	mysqli_close($con);
	
	
}


function load_public_posts(){
	
session_start();
	$ic=$_SESSION['user'];
	
	include '../../functions/connection.php';
	$query=mysqli_query($con,"SELECT * FROM tblposts WHERE privacy='public'");
	
	if(mysqli_num_rows($query)>0){
		while($row=mysqli_fetch_array($query,MYSQLI_NUM)){
	echo "
	
	<div class='media'>
            <div class='media-body'>
                <h4 class='media-heading'>$row[1]</h4>
                
                <p>$row[2]</p>
                <p><span class='reviewer-name'><strong>$row[7]</strong></span><span class='review-date'>$row[6]</span></p>
            </div>
			
			<button class='btn btn-primary btn-sm' onclick='view_post(\"$row[0]\")'>Comments</button>
        </div>

	";
		}
	}
	else {
		
	echo "<p>No public posts</p>";	
	}
	mysqli_close($con);


	
}

function load_class_post(){
session_start();
	$ic=$_SESSION['user'];
	
	include '../../functions/connection.php';
	$query=mysqli_query($con,"SELECT
tblposts.id,
tblposts.title,
tblposts.contents,
tblposts.privacy,
tblclasses.`subject`,
tblposts.dateposted,
tblposts.postedby

FROM
tblposts ,
tblclasses ,
tblstudents
WHERE
tblposts.privacy = tblclasses.`code` AND
tblclasses.icnumber = tblstudents.icnumber
AND tblstudents.icnumber='$ic'");
	
	if(mysqli_num_rows($query)>0){
	
	echo "<h4>Post from your classes</h4>
	<ul>
	";
	
	while($row=mysqli_fetch_array($query,MYSQLI_NUM)){
		echo "<li><button class='btn-info' onclick='view_post(\"$row[0]\")'>$row[1]</button> <br/><em>Posted by: <strong>$row[6]</strong></em> <br/>
		<span class='text-muted'>Date Posted:$row[5]</span>)</li>
		<li class='divider'></li>
		";
		
	}
	echo "</ul>";
	}
	else {
	echo "<p>No posts</p>";	
	}
	mysqli_close($con);
	
	
}


function load_classes(){
session_start();
	$ic=$_SESSION['user'];
	
	include '../../functions/connection.php';
	$query=mysqli_query($con,"SELECT code,subject,schedule,lecturer FROM tblclasses WHERE icnumber='$ic'");
	
	if(mysqli_num_rows($query)>0){
	
	echo "<h4>My Classes<button class='btn-default	 btn-sm pull-right' align='right'><a href='transcript.php'>View Transcript</button></h4>
	<table class='table table-responsive '>
	<tr>
		
		<th>Subject</th>
		<th>Schedule</th>
		<th>Lecturer</th>
	</tr>
	";
	
	while($row=mysqli_fetch_array($query,MYSQLI_NUM)){
		echo" <tr>
		
		<td class='text-primary'>$row[1]</td>
		<td>$row[2]</td>
		<td>$row[3]</td
	</tr>";
	
	}
	echo "</table>";
	}
	else {
	echo "<p>You dont have classes yet</p>";	
	}
	mysqli_close($con);
	
	
}
function load_profile(){
	session_start();
	$ic=$_SESSION['user'];
	
	include '../../functions/connection.php';
	$query=mysqli_query($con,"SELECT * FROM tblstudents WHERE icnumber='$ic'");
	
	
	
	while($row=mysqli_fetch_array($query,MYSQLI_NUM)){
		if($row[4]=='NCC'){
			$img='assets/img/ncc.png';
		}
		else if($row[4]=='BTEC'){
			$img='assets/img/btec.png';
		}
		
	 
 echo "
            <div class='col-md-3 col-md-offset-0'><img src='$img' width='225' height='225' class='img-responsive img-thumbnail'></div>
            <div class='col-md-7'>
                <h3>$row[3]</h3>
                <div class='table-responsive'>
                    <table class='table'>
                       
                            <tr>
                                <th>IC-Number</th>
                                <td>$row[2]</td>
                            </tr>
                      
                       
                            <tr>
                                <th>Course</th>
                                <td>$row[4]</td>
                            </tr>
                            <tr>
                                <th>Level</th>
                                <td>$row[5]</td>
                            </tr>
                            
                             <tr>
                                <th>Intake</th>
                                <td>$row[6]</td>
                            </tr>
                    
                    </table>
                </div>
            </div>
      ";
	}
	mysqli_close($con);
}


?>