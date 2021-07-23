// JavaScript Document

function load_posts(){
		$('.postcontainer').html("<img src='../images/loader.gif' width='30%' class='center-block'>");
	$.ajax({
	
		type:"POST",
		url:"scripts/postoperation.php",
		cache:false,
		data:{
		operation:'loadpost'	
		},
		success:function(result){
			$('.postcontainer').html(result);
				
		}
			
		});	
	
}

function save_post(){
	//clear span
	$("#postitle").next().remove("span");
	$("#postcontents").next().remove("span");
	$("#postattachment").next().remove("span");
	
	var title=$("#postitle").val();
	var contents=$("#postcontents").val();
	var access=$("#postaccess").val();
	var attachment=$("#postattachment").val();
	var type=$("#posttype").val();
	
	if(title==''){
		$("#postitle").after("<span class='alert-danger'>Please enter the title</span>");
	}
	else if(contents==''){
		$("#postcontents").after("<span class='alert-danger'>Please enter contents</span>");
	}
	
	else if(attachment==''){
		$("#postattachment").after("<span class='alert-danger'>Please enter contents</span>");
	}
	else {
		$("#modalpost img").show();
		$.ajax({
		type:"POST",
		url:"scripts/postoperation.php",
		cache:false,
		data:{
		title:title,
		contents:contents,
		privacy:access,
		attachmentlink:attachment,
		filetype:type,
		operation:'savepost'	
		},
		success:function(result){
			if(result=='success'){
				$("#modalpost img").hide();
				alert('Your post has been saved');
				clearpostinputs();
				load_posts();
			}
			else {
				$("#modalpost img").hide();
				alert(result);
				clearpostinputs();
				
			}
				
		}
			
		});	
	}
		
	
}
function clearpostinputs(){
$("#postitle").val("");
$("#postcontents").val("");
$("#postaccess").val("");
$("#postattachment").val("");
$("#posttype").val("");
	
}



function delete_post(id){
	
	var c=confirm("Delete this post? It will also delete all comments on this post");
	
	if(c==true){
	$.ajax({
	
		type:"POST",
		url:"scripts/postoperation.php",
		cache:false,
		data:{
		operation:'deletepost',
		id:id
		},
		success:function(result){
			load_posts();
				
		}
			
		});	
	}
}

//posts
function view_post(id){
		
		$("#btnclasspost").click();	
			$("#modalclasspost #postdetails").html("<img src='../images/loader.gif' class='center-block' width='5%'>");
		$.ajax({
			type:"POST",
			url:'scripts/profile.php',
			cache:false,
			data:{
				option:"classpostdetails",
				id:id
				
				
			},
			success:function(result){
				$("#modalclasspost #postdetails").html(result);
					
			}
			
		});
		
		load_comments(id);
		
	}
	
	function load_comments(id){
		$("#allcomments").html("<img src='../images/loader.gif' class='center-block' width='15%'>");
		$.ajax({
			type:"POST",
			url:'scripts/posts.php',
			cache:false,
			data:{
				option:"comments",
				id:id
				
				
			},
			success:function(result){
				$("#allcomments").html(result);
					
			}
		});
	}
	
	function save_comment(id){

	var comment=$("#postcomment").val();
	
	if(comment==''){
		$("#postcomment").after("<p class='text-danger'>Please enter your comment</p>");;
	}
	else {
		$("#postcomment").after("<img src='../images/loader.gif' width='5%'>");
		$.ajax({
			type:"POST",
			url:'scripts/posts.php',
			cache:false,
			data:{
				option:"savepost",
				comment:comment,
				id:id
				
				
			},
			success:function(result){
				if(result=='success'){
					$("#postcomment").next().remove("img");
					alert("Comment saved");
					$("#postcomment").val("");
						load_comments(id);	
				}
				else{
					alert(result);
				}
					
			},
			complete:function(result){
			
			}
			
		});
	}
		
	}
	
	function delete_comment(id,id2){
		$.ajax({
			type:"POST",
			url:'scripts/functions/posts.php',
			cache:false,
			data:{
				option:"delete",
				id:id
				
				
			},
			success:function(result){
				if(result=='success'){
				
					alert("Comment deleted");
					
						load_comments(id2);	
				}
				
					
			}
			
		});
	}