<?php
require('connection.php');

if($_POST['formSubmit'] == "Save") 
{
	$errorMessage = "";
	
	if(empty($_POST['devicename'])) 
	{
		$errorMessage = "No Name for the Devices entered";
		echo '<script type="text/javascript">alert("' . $errorMessage . '");window.location.href = "../controlpanel/controlpanel.php"</script>';
	}
	elseif(empty($_POST['deviceroom'])) 
	{
		$errorMessage = "No Room for the Devices entered";
		echo '<script type="text/javascript">alert("' . $errorMessage . '");window.location.href = "../controlpanel/controlpanel.php"</script>';
	}
	
	$varName = $_POST['devicename'];
	$varRoom = $_POST['deviceroom'];
	
	if (empty($errorMessage)) 
	{
		$result1 = mysqli_query($connection, "SELECT ID_ROOM FROM ROOMS WHERE NAME = '$varRoom'");

		if (mysqli_num_rows($result1)==0) { 
			$errorMessage = "The Room entered does not exist.";
			echo '<script type="text/javascript">alert("' . $errorMessage . '");window.location.href = "../controlpanel/controlpanel.php"</script>';
			exit();
		}
		$result1 = mysqli_query($connection, "SELECT ID_ROOM FROM ROOMS WHERE NAME = '$varRoom'");
		while ($row = mysqli_fetch_array($result1))
		{
			$varIDR = (int)$row["ID_ROOM"];
			echo $varIDR;
		}
		$result2 = mysqli_query($connection, "SELECT ID_DEVICE FROM DEVICES WHERE NAME = '$varName'");
		while ($row = mysqli_fetch_array($result2))
		{
			$varIDD = (int)$row["ID_DEVICE"];
			echo $varIDD;
		}
		
		$query2 = "DELETE FROM DEVICE_LOCATOR WHERE ID_ROOM='$varIDR' AND ID_DEVICE='$varIDD'"; 

		$stmt2 = mysqli_prepare($connection, $query2) or die(mysqli_error($connection));
		
		mysqli_execute($stmt2);
		mysqli_stmt_close($stmt2);
		
		header("Location: ../controlpanel/controlpanel.php");
		exit();					
	}
}
?>