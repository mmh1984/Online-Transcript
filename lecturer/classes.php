<?php

session_start();
include '../functions/functions.php';
if(!isset($_SESSION['user'])&&($_SESSION['level']!='lecturer')) {
	header('location:../index.php');
}
else {
	$user=$_SESSION['user'];
	if(isset($_GET['code'])){
		$code=$_GET['code'];	
	}

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

<script src="scripts/operations.js" type="text/javascript"></script>
<script>

$(document).ready(function(e) {
    
	var classcode=$("#classcode").val();
	load_class(classcode);
	
	
$("#logoutlink").click(function(){
	
	window.location.href='../logout.php';
	});
	
	$("#changepasslink").click(function(e) {
        $(".changepass").css("display","block");
    });
	
	$(".close").click(function(e) {
        $(".changepass").css("display","none");
    });
	
	
	//save btec marks
	$("#btnsavebtec").click(function(e) {
		
		$("#asstitle").next().remove("span");
		$("#assmarks").next().remove("span");
        var title=$("#asstitle").val();
		var marks="";
		
		$("input[name='assmarks']:checked").each(function(index, element) {
            marks+=$(this).val()+",";
        });
		
	
		
		if(title==''){
			$("#asstitle").after("<span class='alert-danger'>Enter Assignment Title</span>");
		}
		else if(marks.length==0){
			alert("Enter Assignment Marks");
		}
		else {
			$("#btecmodal #sidebar").html("<img src='../images/loader.gif' width='30px' class='center-block'>");
			var bteccode=$("#bteccode").html();
			var ic=$("#btecic").html();
			var no=$("#assno").val();
			var achieved=$("#assfinal").val();
			var comment=$("#asscomment").val();
			
			$.ajax({
				type:"POST",
				url:"scripts/classfunction.php",
				cache:false,
				data:{
					operation:"savebtec",
					code:bteccode,
					ic:ic,
					no:no,
					title:title,
					marks:marks,
					achieved:achieved,
					comment:comment
				},
				success:function(result){
					$("#btecmodal #sidebar").html("Successfully saved this assessment");
				}
				
			});
			
			
		}
    });
	
	
	$("#btnsavencc").click(function(e) {
		$("#nccmarks").next().remove("span");
        var marks=$("#nccmarks").val();
		if(marks=='') {
				$("#nccmarks").after("<span class='alert-danger'>Enter marks</span>");
		}
		else if($.isNumeric(marks)==false){
			$("#nccmarks").after("<span class='alert-danger'>Marks must be a number</span>");
		}
		else {
			$("#nccmodal #sidebar").html("<img src='../images/loader.gif' width='30px' class='center-block'>");
			var code=$("#ncccode").html();
			var ic=$("#nccic").html();
			var type=$("#ncctype").val();
			//marks
			var final=$("#nccfinal").val();
			var comments=$("#ncccomment").val();
			$.ajax({
				type:"POST",
				url:"scripts/classfunction.php",
				cache:false,
				data:{
					operation:"savencc",
					code:code,
					ic:ic,
					type:type,
					marks:marks,
					final:final,
					comment:comments
				},
				success:function(result){
					$("#nccmodal #sidebar").html("Successfully saved this assessment");
				}
				
			});
			
		}
    });
	
});

function clear_btec(){
		$("#asstitle").val("");
		
		$("#asscomment").val("");
		$("#btecmodal #sidebar").html("");
		$("input[name='assmarks']").each(function(index, element) {
            $(this).prop("checked",false);
        });
}

function clear_ncc(){
		$("#nccmarks").val("");
		$("#ncccomment").val("");
		
		$("#nccmodal #sidebar").html("");
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
<div class="col-md-1"><img src="../images/logo.png" width="50px"></div>
<div class="col-md-9">
<h1>Lecturer Portal Page</h1>
<h6>Logged as:<?php  echo "<kbd>".$user."</kbd>"; ?>
</h6>

</div>

<div class="row">
<div class="col-md-12" style="height:2px;background:#FC0;"></div>
</div>
<div class="row">

<div class="col-md-6" style="padding:10px;">
<ul class="btn-group">
	<li class="btn btn-default"><a href='lecturerpage.php'>Back</a></li>
 	

</ul>
</div>


</div>
</div>

<div class='row'  style='padding:15px;'>
<input type='hidden' id='classcode' value='<?php echo $code ?>'>
<p class='alert alert-info'>Select Student IC to enter marks</p>
<div id='content' class='col-md-12'>

</div>
<button data-toggle='modal' data-target='#btecmodal' id='btnbtec' hidden="" ></button>
<button data-toggle='modal' data-target='#nccmodal' id='btnncc' hidden="" ></button>
</div>

<div class="panel-footer">
</div>
</div>


</div>
<!-- 
 
 <div class='message'>
 	<div class='well'>
     Hello
 
 	</div>
 </div>
 -->
</body>

<!--modal for NCC marking-->

<div id='nccmodal' class='modal fade' role='dialog'>
	<div class='modal-dialog modal-lg'>
    	<div class='modal-content'>
    		<div class='modal-header'>
            <h3><img src='../images/NCC logo.png' width="10%"> STUDENT Marking Form </h3>
                        </div>
        	<div class='modal-body'>
           <div class='row'>
           	<div class='col-md-8'>
           <span id='sidebar'></span>
            <table class='table table-condensed'>
            <tr>
            <th>Subject Code</th>
            <td><span id='ncccode'><?php echo $code;?></span>
            </tr>
            
             <tr>
            <th>Subject</th>
            <td><span id='nccsubject'><?php echo $code;?></span>
            </tr>
            
              <th>Student IC</th>
            <td><span id='nccic'></span>
            </tr>
            <tr>
            <th>Assessment Type</th>
            <td>
            <select id='ncctype' class='inputshort'>
            	<option value='Assignment'>Assignment</option>
                <option value='Examination'>Examination</option>
               
            </select>
            </td>
            </tr>
            
            
            <tr>
            <th>Marks (0-100)</th>
            <td>
            <input type='text' id='nccmarks' class='inputsmall form-control'>
            </td>
            </tr>
            
            <tr>
            <th>Final Marks (F,P,M or D)</th>
            <td>
             <select id='nccfinal' class='inputshortest'>
            	<option value='FAIL'>FAIL</option>
                <option value='PASS'>PASS</option>
                <option value='MERIT'>MERIT</option>
                
                <option value='DISTINCTION'>DISTINCTION</option>
               
            </select>
            </td>
            </tr>
             <tr>
            <th>Comment (Optional)</th>
            <td><textarea id='ncccomment' col='50' rows='5' class='form-control'></textarea>
         
            </td>
            </tr>
            <tr>
            <td></td>
            <td><button id='btnsavencc' class='btn btn-primary'>Save</button>
            <button class='btn btn-default' data-dismiss='modal'>Close</button>
            </tr>
            </table>
            
            </div>
           <div class='col-md-4 well'>
           <h4>Instructions</h4>
           <p>BTEC Assesments consists of Assignments and Examinations</p>
           <p class='alert alert-info'>
           Pass=40-60
           </p>
           
            <p class='alert alert-success'>
           Merit=61-70
           </p>
          
           <p class='alert alert-warning'>
           Distinction=70-100
           </p>
           </div>
           </div>
            
            </div>
            <div class='modal-footer'></div>
        </div>
    </div>
</div>



<!--modal for BTEC marking -->

<div id='btecmodal' class='modal fade' role='dialog'>
	<div class='modal-dialog modal-lg'>
    	<div class='modal-content'>
    		<div class='modal-header'>
            <h3><img src='../images/BTEC logo.png' width="10%"> STUDENT Marking Form </h3>
                        </div>
        	<div class='modal-body'>
           <div class='row'>
           	<div class='col-md-8'>
           <span id='sidebar'></span>
            <table class='table table-condensed'>
            <tr>
            <th>Subject Code</th>
            <td><span id='bteccode'><?php echo $code;?></span>
            </tr>
            
             <tr>
            <th>Subject</th>
            <td><span id='btecsubject'><?php echo $code;?></span>
            </tr>
            
              <th>Student IC</th>
            <td><span id='btecic'></span>
            </tr>
            <tr>
            <th>Assessment Number</th>
            <td>
            <select id='assno' class='inputshortest'>
            	<option value='1'>1</option>
                <option value='2'>2</option>
                <option value='3'>3</option>
            </select>
            </td>
            </tr>
            
            <tr>
            <th>Assessment Title</th>
            <td>
            <input type='text' id='asstitle' class='inputsmall form-control'>
            </td>
            </tr>
            
            <tr>
            <th>Marks</th>
            <td>
            <input type='checkbox' name='assmarks'  value='P1'>P1
            <input type='checkbox' name='assmarks' value='P2'>P2
            <input type='checkbox' name='assmarks'  value='P3'>P3
            <input type='checkbox' name='assmarks' value='P4'>P4
            <input type='checkbox' name='assmarks' value='P5'>P5
            <input type='checkbox' name='assmarks' value='P6'>P6
            <br/>
            <input type='checkbox' name='assmarks' value='M1'>M1
            <input type='checkbox' name='assmarks'  value='M2'>M2
            <input type='checkbox' name='assmarks' value='M3'>M3
            <input type='checkbox' name='assmarks'  value='M4'>M4
            <input type='checkbox' name='assmarks' value='M5'>M5
            <br/>
            <input type='checkbox' name='assmarks' value='D1'>D1
             <input type='checkbox' name='assmarks' value='D2'>D2
              <input type='checkbox' name='assmarks' value='D3'>D3
            </td>
            </tr>
            
            <tr>
            <th>Achieved Marks (F,P,M or D)</th>
            <td>
             <select id='assfinal' class='inputshortest'>
            	<option value='P'>P</option>
                <option value='M'>M</option>
                <option value='D'>D</option>
                 <option value='F'>F</option>
            </select>
            </td>
            </tr>
             <tr>
            <th>Comment (Optional)</th>
            <td><textarea id='asscomment' col='50' rows='5' class='form-control'></textarea>
         
            </td>
            </tr>
            <tr>
            <td></td>
            <td><button id='btnsavebtec' class='btn btn-primary'>Save</button>
            <button class='btn btn-default' data-dismiss='modal'>Close</button>
            </tr>
            </table>
            
            </div>
           <div class='col-md-4 well'>
           <h4>Instructions</h4>
           <p>BTEC Assesments consists of 100% assignment</p>
           <p class='alert alert-info'>
           Pass=P1,P2,P3...PN (Where N is number of P criteria)
           </p>
           
            <p class='alert alert-success'>
           Merit=M1,M2,M3...MN (Where N is number of P criteria)
           </p>
          
           <p class='alert alert-warning'>
           Distinction=D1,D2,D3...DN (Where N is number of P criteria)
           </p>
           </div>
           </div>
            
            </div>
            <div class='modal-footer'></div>
        </div>
    </div>
</div>

<!--ncc modal-->
<div id='nccmodal' class='modal fade' role='dialog'>
	<div class='modal-dialog'>
    	<div class='modal-content'>
    		<div class='modal-header'></div>
        	<div class='modal-body'>
           
            
            </div>
            <div class='modal-footer'></div>
        </div>
    </div>
</div>
</html>
<?php
}
?>
