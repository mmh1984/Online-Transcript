// JavaScript Document

function load_class(code){

$("#content").html("<img src='../images/loader.gif' id='bodyloader' width='50px'>");
$.ajax({
	
	type:"POST",
	url:"scripts/classfunction.php",
	data:{
		operation:"load",
		code:code,
	},
	success:function(result){
		$("#content").html(result);
	}
	
});	
	
	
}

function submit_marks(ic,course,subj){
	
 if(course=='BTEC'){
	 clear_btec();
$("#btnbtec").click();
 $("#btecic").html(ic);	 
  $("#btecsubject").html(subj);	 
 }
 else if(course=='NCC'){
	 	 clear_ncc();
$("#btnncc").click();
 $("#nccic").html(ic);	 
  $("#nccsubject").html(subj);	 
	 
}
 
}