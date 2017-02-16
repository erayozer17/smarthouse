<?php
   include("../dbconnection/connection.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form
      $myusername = mysqli_real_escape_string($connection,$_POST['username']);
      $mypassword = mysqli_real_escape_string($connection,$_POST['password']); 
      $sql = "SELECT id_user 
	  FROM users 
	  WHERE username = '$myusername' 
	  and 
	  password = '$mypassword'";
      $result = mysqli_query($connection,$sql);
	  if (!$result) {
		printf("Error: %s\n", mysqli_error($connection));
		exit();
		}
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      $count = mysqli_num_rows($result);		
      if($count == 1) {
         $_SESSION['login_user'] = $myusername;
         header("location: ../controlpanel/controlpanel.php");
      }else {
            $errorMessage = "Sorry. Your username or password is invalid. Try again.";
echo '<script type="text/javascript">alert("' . $errorMessage . '");window.location.href = "../index.html"</script>';
      }
   }
?>