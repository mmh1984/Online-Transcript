// JavaScript Document
function search_classes(campus,intake,course){
	$("#classes").fadeIn();
	$("#classSelected").hide();
	$("#classes").html("<img src='images/loader.gif' id='bodyloader' width='100px' height='100px'>");
	$.ajax({
		type:"POST",
		url:"script/searchoption.php",
		data:{
			option:"search",
			campus:campus,
			intake:intake,	
			course:course
		},
		cache:false,
		success:function(result){
			$("#classes").html(result);
		},
		complete:function(result){
			
		}
		
	});
	
}

function select_class(code) {

       $("#classes").hide();
	    $("#classSelected").fadeIn();
	   $("#classSelected").html("<img src='images/loader.gif' id='bodyloader' width='100px' height='100px'>");
	$.ajax({
		type:"POST",
		url:"script/searchoption.php",
		data:{
			option:"class",
			code:code
		},
		cache:false,
		success:function(result){
			$("#classSelected").html(result);
		},
		complete:function(result){
			
		}
		
	});
	
}

function delete_student(ic,code) {
	
	$.ajax({
	type:"POST",
	url:'script/searchoption.php',
	data:{
		option:"removestudent",
		ic:ic,
		code:code,	
	},
	success:function(){
		alert('Student '+ ic + ' deleted from the class');
			
		select_class(code);
		
		
	},
	completed:function(){
	
		
	}
		
	});
	
	
}
function delete_class(){
var code=$("#classcode").val();


	$.ajax({
	type:"POST",
	url:'script/searchoption.php',
	data:{
		option:"deleteclass",
		code:code,	
	},
	success:function(){
		alert('Class '+ code + ' deleted');
		window.location.href='search.php'
		
		
	},
	completed:function(){
	
		
	}
		
	});
	
	
}