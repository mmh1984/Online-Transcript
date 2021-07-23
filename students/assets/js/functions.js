function show_profile(){
	$("#profile").html("<img src='assets/img/loader.gif' class='center-block' width='5%'>");
		$.ajax({
			type:"POST",
			url:'assets/functions/profile.php',
			cache:false,
			data:{
				option:"profile"
				
			},
			success:function(result){
				$("#profile").html(result);
					
			}
			
		});
		
	}
	
	function show_classes(){
	$("#myclasses").html("<img src='assets/img/loader.gif' class='center-block' width='5%'>");
		$.ajax({
			type:"POST",
			url:'assets/functions/profile.php',
			cache:false,
			data:{
				option:"classes",
			
				
			},
			success:function(result){
				$("#myclasses").html(result);
					
			}
			
		});
		
	}
	
	function class_post(code){
	
	$("#classpost").html("<img src='assets/img/loader.gif' class='center-block' width='5%'>");
		$.ajax({
			type:"POST",
			url:'assets/functions/profile.php',
			cache:false,
			data:{
				option:"classpost",
				code:code
				
			},
			success:function(result){
				$("#classpost").html(result);
					
			}
			
		});
		
	}
	
	function public_post(){
	$("#publicpost").html("<img src='assets/img/loader.gif' class='center-block' width='5%'>");
		$.ajax({
			type:"POST",
			url:'assets/functions/profile.php',
			cache:false,
			data:{
				option:"publicpost"
				
			},
			success:function(result){
				$("#publicpost").html(result);
					
			}
			
		});
		
	}
	
	
	function logout(){
		var r=confirm("Confirm logout?");
		if (r==true){
		window.location.href='logout.php';	
		}	
	}
	
	
	//post section//
	function view_post(id){
	
		$("#btnclasspost").click();	
			$("#modalclasspost #postdetails").html("<img src='assets/img/loader.gif' class='center-block' width='5%'>");
		$.ajax({
			type:"POST",
			url:'assets/functions/profile.php',
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
		$("#allcomments").html("<img src='assets/img/loader.gif' class='center-block' width='15%'>");
		$.ajax({
			type:"POST",
			url:'assets/functions/posts.php',
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
		$("#postcomment").after("<img src='assets/img/loader.gif' width='5%'>");
		$.ajax({
			type:"POST",
			url:'assets/functions/posts.php',
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
			url:'assets/functions/posts.php',
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