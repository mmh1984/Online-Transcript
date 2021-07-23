<?php
session_start();
if(!$_SESSION['user'] && $_SESSION['level']!='student'){
header("location:../index.php");
		
	
}

else {
		$user=$_SESSION['user'];
		include '../functions/connection.php';
		$query=mysqli_query($con,"SELECT * FROM tblstudents WHERE icnumber='$user'");
		
		while($row=mysqli_fetch_array($query,MYSQLI_NUM)){
			
		


?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Student ID <?php echo $user; ?></title>
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/user.css">
     <script src="assets/js/jquery.min.js" type='text/javascript'></script>
      <script src="assets/js/jquery.min.js" type='text/javascript'></script>
        <script src="assets/js/jspdf.js" type='text/javascript'></script>
          <script src="assets/js/pdfFromHTML.js" type='text/javascript'></script>
    <script>
	$(document).ready(function(e) {
          $("#gradesdiv").html("<img src='assets/img/loader.gif' width='50px' class='center-block'>");
		$.ajax({
			type:"POST",
			url:'assets/functions/profile.php',
			cache:false,
			data:{
				option:"grades"			
			},
			success:function(result){
				$("#gradesdiv").html(result);
					
			}
			
		});
	
    });
	function print_div(){
		window.print();
	}
	
	function redirect_page(url){
		window.location.href=url;
	}
	</script>
</head>

<body>

	<nav class='navbar' style='background:#003;border:none;'>
   <div class='container'>
   <div class='col-md-1'>
   <img src='assets/img/logo.png' width='50px'>
   </div>
   <div class='col-md-7'>
   
   </div>
   <div class='col-md-4' align="right">
  <button class='btn btn-default' onClick="HTMLtoPDF()">Download <span class='glyphicon glyphicon-download'></span></button>
   <button class='btn btn-default' onClick="print_div()">Print <span class='glyphicon glyphicon-print'></span></button>
   <button class='btn btn-primary' onClick="redirect_page('studentpage.php')">Back <span class='glyphicon glyphicon-backward'></span></button>
   </div>
   </div>
    </nav>
    <div class='row' style='width:20px;'></div>
    <div class='container'>
    	<div class='col-md-1'></div>
        <div class='col-md-10 transcriptdiv' id="HTMLtoPDF">
        <div class='row'>
        	<div class='col-md-2'>
             <img src='assets/img/logo.png' width='100px'>
            </div>
            <div class='col-md-4' style='padding-top:30px;'>
            <p>
            Unit 25, Ground Floor, Spg 633
Jln Beribi, Mukim Gadong,
Negara Brunei Darussalam<br/>
Tel : +673 - 2655614</br>
Fax : +673 - 2448675
</p>
            </div>
        </div>
        <hr/>
        <h4>Student Details</h4>
        <div class='row'>
        <div class='col-md-12'>
          <table class='table table-bordered' width="100%">
          <tr>
          <th>IC Number:</th><td><?php echo $row[2]; ?></td><th>Full Name:</th><td><?php echo $row[3]; ?></td>
          </tr>
           <tr>
          <th>Intake:</th><td><?php echo $row[6]; ?></td><th>Student Type:</th><td><?php echo $row[7]; ?></td>
          </tr>
          </table>
        </div>
        </div>
       
        <!---->
        <h4>Course Details</h4>
        <div class='row'>
        <div class='col-md-12'>
          <table class='table table-bordered table-condensed' width="100%">
          <tr>
          <th>Course:</th><td><?php echo "$row[4] $row[5]"; ?></td>
          </tr>
         
          </table>
        </div>
        </div>
         <?php
		}
		?>
        <!--Grades -->
        <h2 align='center'>Transcript</h2>
        <div class='row' style='padding:10px;'>
        <div class='col-md-12' id='gradesdiv'>
      
        </div>
        </div>
        <!--Disclaimer -->
        <div class='row'  style='padding:10px;'>
        <p>*This is an online copy only</p>
        <p>*This copy must be signed by the registrar in order to use as an unofficial credential</p>
        </div>
        </div>
        <div class='col-md-1'></div>
    </div>

</body>
</html>

<?php
}
?>