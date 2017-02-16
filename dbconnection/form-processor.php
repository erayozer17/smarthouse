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
else if(empty($_POST['devicedesc'])) 
{
  $errorMessage = "No Description for the Devices entered";
  echo '<script type="text/javascript">alert("' . $errorMessage . '");window.location.href = "../controlpanel/controlpanel.php"</script>';
}

$varName = $_POST['devicename'];
$varRoom = $_POST['deviceroom'];
$varDesc = $_POST['devicedesc'];

if (empty($errorMessage)) 
{

  $result1 = mysqli_query($connection, "SELECT ID_ROOM FROM ROOMS WHERE NAME = '$varRoom'");

  if (mysqli_num_rows($result1)==0) { 
    $errorMessage = "The Room entered does not exist.";
    echo '<script type="text/javascript">alert("' . $errorMessage . '");window.location.href = "../controlpanel/controlpanel.php"</script>';
    exit();
  }

  $query1 = "INSERT INTO DEVICES (NAME) VALUES (?)";

  $stmt1 = mysqli_prepare($connection, $query1) or die(mysqli_error($connection));

  mysqli_stmt_bind_param($stmt1, 's', $varName);
  mysqli_execute($stmt1);
  mysqli_stmt_close($stmt1);

  while ($row = mysqli_fetch_array($result1)){
    $varIDR = (int)$row["ID_ROOM"];
    echo $varIDR;
  }

  $result2 = mysqli_query($connection, "SELECT ID_DEVICE FROM DEVICES WHERE NAME = '$varName'");
  while ($row = mysqli_fetch_array($result2)){
    $varIDD = (int)$row["ID_DEVICE"];
    echo $varIDD;
  }

  $query2 = "INSERT INTO DEVICE_LOCATOR (ID_DEVICE, ID_ROOM, DESCRIPTION) VALUES (?, ?, ?)";

  $stmt2 = mysqli_prepare($connection, $query2) or die(mysqli_error($connection));

  mysqli_stmt_bind_param($stmt2, 'iis', $varIDD, $varIDR, $varDesc);
  mysqli_execute($stmt2);
  mysqli_stmt_close($stmt2);

  $result3 = mysqli_query($connection, "SELECT ID FROM DEVICE_LOCATOR WHERE DESCRIPTION = '$varDesc'");
  while ($row = mysqli_fetch_array($result3)){
    $varIDL = (int)$row["ID"];
    echo $varIDL;
  }
  $query3 = "INSERT INTO DEVICE_STATUS (ID, STATUS) VALUES ($varIDL, 0)";
  
  $stmt3 = mysqli_prepare($connection, $query3) or die(mysqli_error($connection));

  mysqli_execute($stmt3);
  mysqli_stmt_close($stmt3);
  header("Location: ../controlpanel/controlpanel.php");
  exit();
}
}
?>