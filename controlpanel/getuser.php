<?php
include '../dbconnection/connection.php';
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<!--
<?php/*
$q = intval($_GET['q']);

$con = mysqli_connect('localhost','root','','hecgal15_db');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"ajax_demo");
$sql="SELECT NAME FROM ROOMS WHERE ID_ROOM = '".$q."'";
$result = mysqli_query($con,$sql);

echo "<table>
<tr>
<th>Name</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['NAME'] . "</td>";
    echo "</tr>";
}
echo "</table>";
mysqli_close($con);
*/?>
-->
  <div id="sensors" class="mdl-layout mdl-js-layout" role="dialog" aria-hidden="true">
    <main id="dialog" class="mdl-layout__content">
      <div class="mdl-card mdl-shadow--6dp">
        <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
          <h2 class="mdl-card__title-text">
 <?php
 
    $q = intval($_GET['q']);
    $result = mysqli_query($connection, "SELECT NAME FROM ROOMS WHERE ID_ROOM = '$q'");
    while ($row = mysqli_fetch_array($result)){
      echo $row["NAME"]." Sensors";
    }
  ?>
</h2>
        </div>
        <div class="mdl-card__supporting-text">
    <?php
$result = mysqli_query($connection, "SELECT D.NAME, K.STATUS FROM DEVICES D, DEVICE_LOCATOR J, (SELECT L.* FROM DEVICE_STATUS L
LEFT JOIN DEVICE_STATUS R ON
L.id = R.id AND
L.EVENT_TIMER < r.EVENT_TIMER
WHERE isnull (r.ID)) K WHERE J.ID_ROOM = '$q' AND J.ID_DEVICE = D.ID_DEVICE AND J.ID = K.ID GROUP BY D.ID_DEVICE");
while ($row = mysqli_fetch_array($result)){
echo $row["NAME"];
echo ": ";
if($row["STATUS"] == "0"){
  ?><div id="circle-red"></div><?php
}
elseif ($row["STATUS"] == "1") {
    ?><div id="circle-green"></div><?php
 } else {
 echo $row["STATUS"];
}
if($row["NAME"] == "Temperature"){
    echo "º";
}
else if ($row["NAME"] == "Humidity"){
    echo "%";
}
else if ($row["NAME"] == "Pressure"){
  echo "bar";
}
else {
    echo "";
}
?><br><?php
}
?></div>
      </div>
    </main>
  </div>
</html>