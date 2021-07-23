<?php




function initialize_session_admin(){


	
	if(!isset($_SESSION['site']) || ($_SESSION['level']!="pageadmin") || ($_SESSION['site']!='scheduling')){
		
	
		  echo "<script>alert('You dont have access to this page')</script>";
		  echo "<script>window.location.href='../../index.html'</script>";
		 
	}
	else {
		return $_SESSION['user'];
		
	}
	
	
}

function terminate_session_admin(){
	
	
		 session_destroy();	
		 
		  echo "<script>alert('Logging out...')</script>";
		  echo "<script>window.location.href='../../index.html'</script>";
	
	
}


?>