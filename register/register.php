<?php
	include("../dbconnection/connection.php");
    session_start();
		
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$errorMessage = "Sorry!! An error occured. Please write a valid username(maybe your's is taken) or matching passwords";
	  $myusername = mysqli_real_escape_string($connection,$_POST['username']);
      $mypassword = mysqli_real_escape_string($connection,$_POST['password']);
	  $mypasswordagain = mysqli_real_escape_string($connection,$_POST['passwordagain']);
      $check = strcmp($mypassword,$mypasswordagain);
	  $count1 = strlen($myusername);
	  $count2 = strlen($mypassword);
	  $count3 = strlen($mypasswordagain);
	  $sqlcheck = "select username from users where username = '$myusername'";
	  $checkresult = mysqli_query($connection,$sqlcheck);
	  $count = mysqli_num_rows($checkresult);
	  if($check == 0 && $count1 != 0 && $count2 != 0 && $count3 != 0 && $count == 0){
		$sql = "INSERT INTO users (username, password)
				VALUES ('$myusername', '$mypassword')";
		mysqli_query($connection,$sql);
		  header("location: controlpanel.php");
	  } elseif($count1 == 0){
		  echo '<script type="text/javascript">alert("' . $errorMessage . '");window.location.href = "../register/register.html"</script>';
	  } elseif($count2 == 0){
		  echo '<script type="text/javascript">alert("' . $errorMessage . '");window.location.href = "../register/register.html"</script>';
	  } elseif($count3 == 0){
		  		  echo '<script type="text/javascript">alert("' . $errorMessage . '");window.location.href = "../register/register.html"</script>';
	  } elseif($check != 0){
		  echo '<script type="text/javascript">alert("' . $errorMessage . '");window.location.href = "../register/register.html"</script>';
	  }
	  else{
		  echo '<script type="text/javascript">alert("' . $errorMessage . '");window.location.href = "../register/register.html"</script>';
	  }
	}
?>