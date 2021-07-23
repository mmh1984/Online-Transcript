// JavaScript Document



function load_lecturer(campus,target){
	
	$.ajax({
	type:"POST",
	url:"script/options.php",
	data:{
	option:"lecturer",
	value:"empty",
	campus:campus	
	},
	cache:false,
	success:function(result){
		target.html(result);
	},
	complete: function(result){
		
	}
	
		
	});
	
}
//function to load selection
function load_selected(option,value,target){
var str="value="+value +"&"
	str+="option="+option;
	
	$.ajax({
	type:"POST",
	url:"script/options.php",
	data:str,
	cache:false,
	success:function(result){
		target.append(result);
	},
	complete: function(result){
		
	}
	
		
	});
	

}

//load student list

function save_class(){
	

//save to schedule

    var selectedic=[];

$.each($("input[name='studentic']:checked"),function(){
	selectedic.push($(this).val());	
});


if((selectedic.length)==0){
alert("No student selected!");
	
}
else {
	if($("#subjectcode").val()==""){
		alert("Please select a subject");
	}
	else if($("#finalschedule").val()==""){
		alert("Please select the schedule time and venue");
	}
	else if($("#code").html()==''){
		alert("Code cannot be empty");
	}
	
else {	
	$("#studentlist").html("<img src='images/ajax-loader1.gif' id='bodyloader'>");
	var code=$("#code").val();
	var campus=$("#campus").val();
	var type=$("#type").val();
	var intake=$("#intake").val();
	var course=$("#course").val();
	var level=$("#level").val();
	var subject=$("#subjectcode").val();
	var group=$("#group").val();
	var lecturer=$("#Lecturer").val();
	var schedule=$("#finalschedule").val();
	
	
	$.ajax({
		type:"POST",
		url:"script/classes.php",
		data:{
			code:$("#code").html(),
			campus:$("#campus").val(),
			type:$("#type").val(),
			intake:$("#intake").val(),
			course:$("#course").val(),
			level:$("#level").val(),
			subject:$("#subjectcode").val(),
			group:$("#group").val(),
			lecturer:$("#Lecturer").val(),
			schedule:$("#finalschedule").val(),
			operation:"save",
			studentic:selectedic
			
		},
		cache:false,
		success:function(result){
			
		if(result=='success'){
				
			var content="<div class='jumbotron' id='bodyloader'>";
			content+="<h2 class='page-header'>Successfully added this class</h1>";
			content+="<button class='btn btn-primary' onclick='refresh_page()'>Close</button>";
			content+="</div>";
			$("#studentlist").html(content);
			
			}
			else {
				
			var content="<div class='jumbotron' id='bodyloader'>";
			content+="<h2 class='page-header'>Error! This code is already assigned to another class</h1>";
			content+="<button class='btn btn-primary' onclick='refresh_page()'>Close</button>";
			content+="</div>";
			$("#studentlist").html(content);
			
			
			}
			
			
		},
		complete: function(result){
			
		}
		
		
	});
	
}
}


	
}

function refresh_page(){
window.location.href='index.php';	
}

function update_code(){
	var campus=$("#campus").val();
	var type=$("#type").val();
	var intake=$("#intake").val();
	var course=$("#course").val();
	var level=$("#level").val();
	var group=$("#group").val();
	var subject=$("#subjectcode1").val();
	var msg=" <table><tr><th>Campus</th><td><strong>"+ campus + "</strong></td></tr>";
		msg+="<tr><th>Intake</th><td><strong> "+ intake + "</strong></td></tr>";
		msg+="<tr><th>Type</th><td><strong> "+ type + "</strong></td></tr>";
		msg+="<tr><th>Course</th><td><strong> "+ course + "</strong></td></tr>";
		msg+="<tr><th>Level</th><td><strong> "+ level + "</strong></td></tr>";
		msg+="<tr><th>Subject</th><td><strong> "+ subject + "</strong></td></tr>";
		msg+="<tr><th>Group</th><td><strong> "+ group + "</strong></td></tr></table>";
	var code=campus + course + intake + level + type + subject + group
	code=code.split(' ').join('');
	$("#code").html(code);
}

function load_student(option,value,target){
	target.html("<img src='images/ajax-loader1.gif' id='bodyloader'>");
	
	$("#bodyloader").show();
	
	switch(value){
		
	case "campus":
	var campus=$("#campus").val();
	var type=$("#type").val();
	var intake=$("#intake").val();
	var course=$("#course").val();
	var level=$("#level").val();


	break;
	
	
	case "intake":
	var campus=$("#campus").val();
	var type=$("#type").val();
	var intake=$("#intake").val();
	var course=$("#course").val();
	var level=$("#level").val();

	
	break;	
	
	case "type":
	var campus=$("#campus").val();
	var type=$("#type").val();
	var intake=$("#intake").val();
	var course=$("#course").val();
	var level=$("#level").val();

	
	break;	
	
	case "course":
	var campus=$("#campus").val();
	var type=$("#type").val();
	var intake=$("#intake").val();
	var course=$("#course").val();
	var level=$("#level").val();


	break;	
	
	case "level":
	var campus=$("#campus").val();
	var type=$("#type").val();
	var intake=$("#intake").val();
	var course=$("#course").val();
	var level=$("#level").val();
	
	break;	
	}
	
	
	
update_code();
	var str="value="+ value +"&"
	str+="option="+option +"&"
	str+="campus="+ campus +"&"
	str+="type="+ type +"&"
	str+="intake="+ intake +"&"
	str+="course="+ course +"&"
	str+="level="+ level
	
	$.ajax({
	type:"POST",
	url:"script/options.php",
	data:str,
	cache:false,
	success:function(result){
		target.html(result);
		
	},
	complete: function(result){
		
		$("#bodyloader").hide();
		$("#detailstitle").html(result);
		//$("#code").html(code);
		
		
	}
		
		
	});
	

}

function load_subjects(){
	$('#subjectlist').html("<img src='images/loader.gif' width='50px' id='bodyloader'>")
	var course=$("#course").val();
	var level=$("#level").val();
	var str="option=subjects&";
	    str+="course="+ course + "&";
		str+="level="+ level + "&";
		str+="value=''";
	$.ajax({
		type:"POST",
		url:"script/options.php",
		data:str,
		cache:false,
		success:function(result){
			$("#subjectlist").html(result);
		},
		complete:function(result) {
		
		}
		
	});
	
}


