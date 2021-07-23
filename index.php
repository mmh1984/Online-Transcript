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
	

	$("#studentid").prop("placeholder","ic or passport");
	
	$("#loginas").change(function(e){
	
		switch($(this).val()){
		case "admin":
		$("#studentid").prop("value","admin");
		$("#studentid").prop("disabled",true);
		break;
		
		case "lecturer":
		$("#studentid").prop("value","email@kemudainstitute.com");
		$("#studentid").prop("disabled",false);
		break;
		
		case "student":
		$("#studentid").val("");
		$("#studentid").prop("placeholder","ic or passport");
		$("#studentid").prop("disabled",false);
		break;
			
		}
		
	});
	
	
	
		

	
	$(".warning").css("display","none");
	
    $(".contactlink").click(function(e) {
		$("#contactpop").css("display","block");
		
	})
	$(".close").click(function(e) {
		$("#contactpop").css("display","none");
		
	})
	
	//close loader
	$("#closeloader").click(function(e) {
        $("#loader").hide();
    });
	
	
	function validate_email(email){
		var length=email.length;
		var domain=email.substring(length-20);	
		if(domain!='@kemudainstitute.com'){
			alert("This is not a valid kemuda email");
			return false;	
		}
		else{
			return true;	
		}
	}
	
	//submit the form
	$("#btnlogin").click(function(e) {
        var username=$("#studentid").val();
		var password=$("#studentpass").val();
		
		if(username==''){
			$("#userwarning").slideDown();
			
		}
		else if(password==''){
			$("#passwarning").slideDown();
		}
		else {
			//loading
			$("#loader").show();
			$("#loader h3").html("Logging in");
			$("#closeloader").hide()
			$("#loader img").show();
			//
			var logintype=$("#loginas").val();
			var option='';
			if(logintype=='admin'){
				option='adminlogin';
			}
			else if(logintype=='student'){
				option='studentlogin';
			}
			else if(logintype=='lecturer' && validate_email(username)){
				option='lecturerlogin';
				
			}
		
			
			$.ajax({
				type:"POST",
				url:"functions/login.php",
				cache:false,
				data:{
					option:option,
					username:username,
					password:password	
				},
				success:function(result){
					switch(result){
						case "admin":
						$("#loader").hide();
						alert("Login Successful");
						window.location.href='admin.php';
						break;
						
						case "lecturer":
						$("#loader").hide();
						alert("Login Successful");
						window.location.href='lecturer/lecturerpage.php';
						break;
						
						case "student":
						$("#loader").hide();
						alert("Login Successful");
						window.location.href='students/studentpage.php';
						break;
						
						default:
					
						$("#loader h3").html("Login error");
						$("#loader img").hide();
						$("#closeloader").show();
					}
				},
				complete:function(result){
					
				}
			});
			
		}
		
    });	
			

	
$("input[type='text'],input[type='password']").keydown(function(){
	$(".warning").css("display","none");
	});
	

	
});
function initMap() {
        var uluru = {lat: 4.879038, lng: 114.888105};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
		
      }

</script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDxmoZCPCx6UinTH3CEaGuryipo9ynxv5Q&callback=initMap">
    </script>
<title>Kemuda Student Portal</title>
</head>

<body>
<div class="container-fluid">
<!--main container-->
<div class="row headerbg">
<!--header row -->
<div class="col-md-1">

  <img src="images/logo.png" alt="logo" width="120px">
  </div>
  <div class="col-md-9">
  <br/>
  <h2>KEMUDA<small> Transcript and Grading</small></h2>
 </div>
 
 <div class="col-md-2 headerlink">
 <br/>
 <br/>
 <ul class="nav nav-justified">
 <li class="btn btn-primary" data-toggle="modal" data-target="#contact">Contact Us</li>
 
 </ul>

 </div>
 </div>
 <!--end of row1-->
 
 <!--row for body-->
 <div class="row rowbodymain" style="padding:5px;">

 <div class="col-md-8" style="margin-top:20px;">
<div class="jumbotron small" style="background-color:#fff;opacity:1;">
    <h2 style="color:#fff;">STUDENT PORTAL</h2>
    
   <p class="well well-sm"> This student portal is an all access page to all students of Kemuda Institute. All students who access this page can:</p>
   
    <ul>
    <li>View their marks for the whole course</li>
    <li>View an online copy of their transcript</li>
    <li>Request for an official copy of the transcript</li>
    <li>Send message or inquiry to your lecturers.</li>
    </ul>
    </p>
   </div> 
</div>
  <div class="col-md-4">

   
   <div class="panel panel-primary" >
      <div class="panel-heading text-center " style="background-color:#003;">
      
      <h4 style='margin:0;'>Login</h4>
      </div>
      <div class="panel-body">
   
   
    <table class="table table-condensed" style="color:#333;">
       <tr>
    <td>  <select id="loginas" class="form-control inputshort text-center">
   <option value="student" selected="selected">student</option>
   <option value="lecturer">lecturer</option>
   <option value="admin">administrator</option>
   </select></td>
    </tr>
    <tr>
      <td><span class="warning text-warning" id='userwarning'>Please enter your username</span></td>
    </tr>
    <tr>
    <td> <input type="text" name="studentid" id="studentid" placeholder="icnumber/passport" class="form-control inputshort text-center"/></td>
    </tr>
   
    <tr>
      <td><span class="warning text-warning" id='passwarning'>Please enter your password</span></td>
    </tr>
    <tr>
    <td>  <input type="password" name="studentpass" id="studentpass" placeholder="password" class="form-control inputshort text-center"/></td>
    </tr>
   
 
   </table>

    <hr/>	
    <button id='btnlogin' class="btn btn-primary center-block">  Login</button>
        
        
   
    <br/>
    <div class="alert alert-info text-left">
    <p>Trouble logging in?</p>
    
    <ul class="small">
    <li>Only students enrolled can access the portal</li>
    <li>The admin will notify the student's list who are active</li>
    <li>Double check your ID and password</li>
     <li>Check your status or request a new password<a href="resetpassword.php"> <kbd>here</kbd></a></li>
    </ul>

    </div>
   
    </div>
   
   </div>
 </div>
 
 </div>
 <div class="row headerbg" style="height:50px;">
 <div class="col-md-12">
    <p class='text-center'>copyright &reg;KEMUDA 2017</p>
   </div>
 </div>
 </div>
 <!--end of main-->
</div>
</div>
</div>


</body>
</html>

<div class="modal fade" id="contact" role="dialog">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header bg-primary"><h3>Contact Us<button class="close text-right" data-dismiss="modal">&otimes;</button></h3></div>
<div class="row" style="padding:10px;">

<div class="col-md-12" >
<table class="table-condensed">
       	<tr>
        	<td><img src="images/location.png" alt="address"></td>
            <td>
            <p class='well'>
          <kbd>Main Campus</kbd><br/>

Unit 25, Ground Floor, Spg 633,
Jln Beribi, Mukim Gadong, BE1118
Negara Brunei Darussalam
            
            </p>
            
             <p class='well'>
          <kbd>Kuala Belait Campus</kbd><br/>



3rd floor, Sekolah Tunas Jaya PGGMB,
Lot 6227 (Jalan Pandan 6) Kuala Belait,
Kuala Belait KA1931
            
            </p>
            
            
            </td>
        </tr>
        
        	<tr>
        	<td><img src="images/phone.png" alt="address"></td>
            <td>
           
            <p class='well'>
            <kbd>BSB</kbd>:+673-2655614/2448679<br/>
            </p>
            <p class='well'>
            <kbd>KB</kbd>:+673 333 7761<br/>
            </p>
         
            </td>
        </tr>
    
       </table>
</div>


</div>
<div class="row">
<div class="col-md-12" style="padding:50px;">
<div id='map' style='height:350px;'>

</div>
</div>
</div>

<div class="modal-footer text-center">
<button class="btn btn-default" data-dismiss="modal">Dismiss</button>

</div>
</div>
</div>

</div>
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