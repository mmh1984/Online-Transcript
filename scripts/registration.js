// JavaScript Document
function load_inputs(){

var no=$("#noofstudents").val();
		var content="<h3>Enter Student Details</h3>";
		content+="<table class='table table-striped table-condensed'>";  
		content+="<tr><th>No</th>";
		content+="<th>IC Number</th>";	
		content+="<th>Full Name</th>";
		content+="<th>Type</th></tr>";
		var i=0;
		for(i=0;i<no;i++){
			content+="<tr><td>"+ (i+1) + "</td>";
			content+="<td><input type='text' class='form-control' style='width:150px;' name='icnumber'></td>";
			content+="<td><input type='text' class='form-control' name='fullname'></td>";
			content+="<td><select name='studenttype' class='form-control smallselect'>";
			content+="<option value='FT'>Full-Time</option>";
			content+="<option value='PT'>Part-Time</option>";
			content+="</select></td></tr>";
		}
		content+="</table>";
		content+="<button class='btn btn-primary pull-right' id='btnsave' onclick='save_students()'>Save</button>";
		$("#intro").hide();
		$("#studentdetails").fadeIn();
		$("#studentdetails").html(content);
	  	
	
}

function save_students(){

var icnumber=[];
var name=[];
var type=[];

$("input[name='icnumber']").each(function(index, element) {
    icnumber.push($(this).val());
	
});


$("input[name='fullname']").each(function(index, element) {
    name.push($(this).val());
});

$("select[name='studenttype']").each(function(index, element) {
    type.push($(this).val());
});

var count=name.length;

var i=0;
var error=true;
for(i=0;i<count;i++){
	if(name[i]=='' || icnumber[i]==''){
	 error=false;
	}	
	
}
if(error==false){

	  alert('Please enter ALL student details');	
}	
else {
	var campus=$("#campus").val();
	
	var course=$("#course").val();
	var level=$("#level").val();
	var month=$("#intakemonth").val();
	var year=$("#intakeyear").val();
	var intake=month + " " + year.substring(4,2);

	
	var x;
	

	//loading
			$("#loader").show();
			$("#loader h3").html("Saving students");
			$("#closeloader").hide()
			$("#loader img").show();
		
	  $.ajax({
		  
		  
		type:"POST",
		url:'functions/registration.php',
		cache:false,
		data:{
		option:"save",
		campus:campus,
		icnumber:icnumber,
		name:name,
		course:course,
		level:level,
		intake:intake,
		type:type
		},
		success:function(result){
		 
		
		 
		$("#loader").show();
			$("#loader h3").html(result);
			$("#closeloader").show();
			$("#loader img").hide();
			
	
		},
		completed:function(result){
		
		}  
		
		  
	   });
	
	
	
}
	
}	

function load_students(campus,course,level,intake){
	$("#studentdetails").html("<img src='images/loader.gif' width='50px' id='bodyloader'>");
	
	$.ajax({
	type:"POST",
	url:"functions/registration.php",
	cache:false,
	data:{
	option:"load",
	campus:campus,
	course:course,
	level:level,
	intake:intake	
		
	}	,
	success:function(result){
		$("#studentdetails").html(result);
		
	}
		
	});
	
}

function save_lecturer(){
var email=$("#newemail").val();	
var fullname=$("#newname").val();		
var campus=$("#newcampus").val();

$("#loader").show();
	$("#loader h5").html("Saving lecturer");
	$("#loader img").show();
	$("#closeloader").hide();
	var ic=$("#selectedic").html();
		$.ajax({
	type:"POST",
	url:"functions/registration.php",
	cache:false,
	data:{
	option:"savelecturer",
	email:email,
	name:fullname,
	campus:campus
	},
	success:function(result){
	
			$("#loader h5").html(result);
	
		if(result=="success"){
			
			$("#loader h5").append("<br/><button class='btn btn-default' onclick='refresh_page(\"lecturers.php\")'>Close</button>")
			$("#loader img").hide()
		}
		else {
			$("#loader img").hide()
	$("#closeloader").show();
		}
		/*
		 var campus=$("#campus").val();
		var intake=$("#intake").val();
		var course=$("#course").val();
		var level=$("#level").val();
		
		search_students(campus,intake,course,level);
		*/
	},
	complete:function(result){
	
	}
		
	});


}

function refresh_page(url){
	window.location.href=url;	
}
function edit_student(id){

	$(".loading").show();
	$("#loadingmessage").html("Resetting password");
	$(".loading #bodyloader").show();
	$("#btncloseloading").hide();
	var ic=$("#selectedic").html();
		$.ajax({
	type:"POST",
	url:"functions/registration.php",
	cache:false,
	data:{
	option:"edit",
	icnumber:id,
		
	},
	success:function(result){
	
			$("#loadingmessage").html(result);
	
		/*
		 var campus=$("#campus").val();
		var intake=$("#intake").val();
		var course=$("#course").val();
		var level=$("#level").val();
		
		search_students(campus,intake,course,level);
		*/
	},
	complete:function(result){
		$(".loading #bodyloader").hide();
	$("#btncloseloading2").show();	
	}
		
	});

	
}


function edit_lecturer(id){

	$("#loader").show();
	$("#loader h5").html("Resetting password");
	$("#loader img").show();
	$("#closeloader").hide();
	var ic=$("#selectedic").html();
		$.ajax({
	type:"POST",
	url:"functions/registration.php",
	cache:false,
	data:{
	option:"editlecturer",
	icnumber:id,
		
	},
	success:function(result){
	
			$("#loader h5").html(result);
	
		/*
		 var campus=$("#campus").val();
		var intake=$("#intake").val();
		var course=$("#course").val();
		var level=$("#level").val();
		
		search_students(campus,intake,course,level);
		*/
	},
	complete:function(result){
	$("#loader img").hide()
	$("#closeloader").show();
	}
		
	});

	
}


function delete_student(id){
	$("#selectedic").html(id);
	$("#btnshowmodal").click();
}


function delete_lecturer(id){
	$("#selectedic").html(id);
	$("#btnshowmodal").click();
}

function remove_student(){
	var ic=$("#selectedic").html();
		$.ajax({
	type:"POST",
	url:"functions/registration.php",
	cache:false,
	data:{
	option:"delete",
	icnumber:ic,
		
	},
	success:function(result){
		alert(result);
		 var campus=$("#campus").val();
		var intake=$("#intake").val();
		var course=$("#course").val();
		var level=$("#level").val();
		
		search_students(campus,intake,course,level);
		
	}
		
	});
	
}

function remove_lecturer(){
	var ic=$("#selectedic").html();
		$.ajax({
	type:"POST",
	url:"functions/registration.php",
	cache:false,
	data:{
	option:"deletelecturer",
	email:ic,
		
	},
	success:function(result){
		alert(result);
		load_lecturer("");
		
	}
		
	});
	
}

function add_lecturer(){
$("#content").css("height","300px");
	$.ajax({
		type:"POST",
		url:"functions/registration.php",
		cache:false,
		data:{
		option:"newlecturer"
		},
		success:function(result){
			$("#content").html(result);
		}
		
	});	
	
}


function search_students(campus,intake,course,level){
	$("#studentdetails").html("<img src='images/loader.gif' width='50px' id='bodyloader'>");
	$.ajax({
	type:"POST",
	url:"functions/registration.php",
	cache:false,
	data:{
	option:"search",
	campus:campus,
	course:course,
	level:level,
	intake:intake	
		
	}	,
	success:function(result){
		$("#studentdetails").html(result);
		
	}
		
	});
	
	
}

function load_lecturer(campus){
	$("#content").html("<img src='images/loader.gif' width='10%' id='bodyloader'>");
		$.ajax({
	type:"POST",
	url:"functions/lectureroptions.php",
	cache:false,
	data:{
	option:"search",
	campus:campus
		
	}	,
	success:function(result){
		$("#content").html(result);
		
	}
		
	});
		
}


