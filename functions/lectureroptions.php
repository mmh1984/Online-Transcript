<?php

$option=$_POST['option'];

switch($option){
case "search":
	load_lecturer();
break;	
	
}

function load_lecturer(){
$campus=$_POST['campus'];

 include 'connection.php';
 $query=mysqli_query($con,"SELECT campus,fullname,email FROM tbllecturers WHERE 
 campus LIKE '%$campus%' 
 ORDER by campus ASC");


echo "<table class='table table-condensed table-striped' style='background:#fff;'>
 <tr>
 <th>Campus</th>
 <th>Full Name</th>
 <th>Email</th>
 <th>Option</th>
 </tr>
";
 
 while($row=mysqli_fetch_array($query)){
	echo "<tr>
		  <td>$row[0]</td>
		  <td>$row[1]</td>
		  <td>$row[2]</td>
		  <td>
		    <button class='btn btn-default' style='display:none' data-toggle='modal' data-target='#confirmmodal' id='btnshowmodal'>check</button>
		  <button class='btn btn-primary btn-sm' onclick='edit_lecturer(\"$row[2]\")'>Reset Password</button>
		  <button class='btn btn-danger btn-sm' onclick='delete_lecturer(\"$row[2]\")'>Delete</button></td> 
	 	  </tr>";	
	}
 	echo "</table>";
	mysqli_close($con);
	
}

?>