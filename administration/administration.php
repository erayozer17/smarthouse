<?php 
include '../dbconnection/connection.php';
if(empty($_SESSION)) // if the session not yet started 
session_start();?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Administration</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../css/mystyle.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel='stylesheet prefetch' href='http://storage.googleapis.com/code.getmdl.io/1.0.1/material.teal-red.min.css'>
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="https://code.getmdl.io/1.1.3/material.min.js"></script>
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/icon?family=Material+Icons'>
</script>
<script type="text/javascript">
$(document).ready(function(){
  $('input[name="toggle"]').on("change", function() {
    if($(this).is(":checked")){
       // alert("Checkbox is checked." + $(this).val() );
     $.ajax({
      type: "POST",
      url: "../dbconnection/ajax.php",
      data: {value: "1", id: $(this).val()},
      success: function(html){
        $("#display").html(html).show();
      } 
    });
   }
   else {
       // alert("Checkbox is unchecked." + $(this).val() );
       $.ajax({
        type: "POST",
        url: "../dbconnection/ajax.php",
        data: {value: "0", id: $(this).val()},
        success: function(html){
          $("#display").html(html).show();
        } 
      });

     }
   });
});
</script>

</head>
<body style="background-color:#4d94ff">

  <?php
  require '../menu/menu2.php';
  ?>
  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <form method="post" action="">
    <input type="number" name="number" value="20">
    <input type="submit" name="submit" value="ok">  
  </form>
  
    <div class="panel panel-default">         <!-- Garage-->
      <div class="panel-heading" role="tab" id="headingOne" >
        <h4  class="panel-title" style="font-size:1.8em;margin-bottom:15px;">
          <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            Garage
          </a>
        </h4>
		<?php
        $i = 1;
         $result = mysqli_query($connection, "SELECT D.NAME, K.STATUS, J.ID, S.NAME AS ROOM, J.ID_ROOM FROM DEVICES D, DEVICE_LOCATOR J, ROOMS S, (SELECT L.* FROM DEVICE_STATUS L LEFT JOIN DEVICE_STATUS R ON
L.id = R.id AND
L.EVENT_TIMER < R.EVENT_TIMER
WHERE isnull (R.ID)) K WHERE J.ID_ROOM = $i AND J.ID_DEVICE = D.ID_DEVICE AND J.ID = K.ID AND J.ID_ROOM = S.ID_ROOM GROUP BY D.ID_DEVICE");
          while($row = mysqli_fetch_array($result)){
              // echo $row["NAME"]," ", $row["ID"], ": ", $row["STATUS"], ". ";
              if ($row["NAME"] == "Temperature"){
                ?><div style="float:left;"> Temperature:  <input type="number" name="number" value="<?php echo $row["STATUS"]; ?>"> <span class="badge">
                &#8451;</span>&nbsp;&nbsp;&nbsp;&nbsp; </div><?php
              }
              else if ($row["NAME"] == "Humidity"){
                ?><div style="float:left;">Humidity: <input type="number" name="number" value="<?php echo $row["STATUS"]; ?>"><span class="badge">
                &#37;</span>&nbsp;&nbsp;&nbsp;&nbsp;</div><?php
              }
              else if ($row["NAME"] == "Pressure"){
                ?><div style="float:left;">Pressure: <input type="number" name="number" value="<?php echo $row["STATUS"]; ?>"><span class="badge">
                bar</span>&nbsp;&nbsp;&nbsp;&nbsp;</div><?php
              }
              else if ($row["NAME"] == "Car"){
                ?><div style="float:left;"><?php echo $row["NAME"];?>&nbsp;</div><?php 
                if($row["STATUS"] == "1"){
                  ?><div id="circle-green2" ></div><?php
                } else {
                  ?><div id="circle-red2" ></div><?php
                }
              }
              else if ($row["NAME"] == "Fire Alarm"){
                ?><div style="float:left;"><?php echo $row["NAME"];?>&nbsp;</div><?php 
                if($row["STATUS"] == "1"){
                  ?><div id="circle-green2"></div><?php
                } else {
                  ?><div id="circle-red2"></div><?php
                }
              }
              else if ($row["NAME"] == "Motion"){
                ?><div style="float:left;"><?php echo $row["NAME"];?>&nbsp;</div><?php 
                if($row["STATUS"] == "1"){
                  ?><div id="circle-green2"></div><?php
                } else {
                  ?><div id="circle-red2"></div><?php
                }
              }
              else {
              }
          }
          ?>
		  <br>
		  <br>
		  <br>
      </div>
      <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
        <div class="panel-body">
      <?php
         $i = 1;
         $result = mysqli_query($connection, "SELECT D.NAME, K.STATUS, J.ID, S.NAME AS ROOM, J.ID_ROOM FROM DEVICES D, DEVICE_LOCATOR J, ROOMS S, (SELECT L.* FROM DEVICE_STATUS L LEFT JOIN DEVICE_STATUS R ON
L.id = R.id AND
L.EVENT_TIMER < R.EVENT_TIMER
WHERE isnull (R.ID)) K WHERE J.ID_ROOM = $i AND J.ID_DEVICE = D.ID_DEVICE AND J.ID = K.ID AND J.ID_ROOM = S.ID_ROOM GROUP BY D.ID_DEVICE");
          while($row = mysqli_fetch_array($result)){
              // echo $row["NAME"]," ", $row["ID"], ": ", $row["STATUS"], ". ";
               if ($row["NAME"] !== "Temperature" && $row["NAME"] !== "Humidity" && $row["NAME"] !== "Motion" && $row["NAME"] !== "Fire Alarm" && $row["NAME"] !== "Car" && $row["NAME"] !== "Pressure" ){
                ?>
                <input type="checkbox" data-toggle="toggle" name="toggle" <?php if($row["STATUS"]==1){ echo "checked";} ?> value="<?php echo $row["ID"];?>">
                <span class="mdl-switch__label"><?php echo $row["NAME"]; ?></span></br>
                <?php
              }
            }
          ?>
			
			
        </div>
      </div>
    </div>
	
    <div class="panel panel-default">  <!--Living Room-->
      <div class="panel-heading" role="tab" id="headingTwo">
        <h4  class="panel-title" style="font-size:1.8em;margin-bottom:15px;">
          <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            Living Room
          </a>
        </h4>
	<?php
        $i = 3;
         $result = mysqli_query($connection, "SELECT D.NAME, K.STATUS, J.ID, S.NAME AS ROOM, J.ID_ROOM FROM DEVICES D, DEVICE_LOCATOR J, ROOMS S, (SELECT L.* FROM DEVICE_STATUS L LEFT JOIN DEVICE_STATUS R ON
L.id = R.id AND
L.EVENT_TIMER < R.EVENT_TIMER
WHERE isnull (R.ID)) K WHERE J.ID_ROOM = $i AND J.ID_DEVICE = D.ID_DEVICE AND J.ID = K.ID AND J.ID_ROOM = S.ID_ROOM GROUP BY D.ID_DEVICE");
          while($row = mysqli_fetch_array($result)){
              // echo $row["NAME"]," ", $row["ID"], ": ", $row["STATUS"], ". ";
              if ($row["NAME"] == "Temperature"){
                ?><div style="float:left;">Temperature: <input type="number" name="number" value="<?php echo $row["STATUS"]; ?>"><span class="badge">
                &#8451;</span>&nbsp;&nbsp;&nbsp;&nbsp;</div><?php
              }
              else if ($row["NAME"] == "Humidity"){
                ?><div style="float:left;">Humidity: <input type="number" name="number" value="<?php echo $row["STATUS"]; ?>"><span class="badge">
                &#37;</span>&nbsp;&nbsp;&nbsp;&nbsp;</div><?php
              }
              else if ($row["NAME"] == "Pressure"){
                ?><div style="float:left;">Pressure: <input type="number" name="number" value="<?php echo $row["STATUS"]; ?>"><span class="badge">
                bar</span>&nbsp;&nbsp;&nbsp;&nbsp;</div><?php
              }
              else if ($row["NAME"] == "Car"){
                ?><div style="float:left;"><?php echo $row["NAME"];?>&nbsp;</div><?php 
                if($row["STATUS"] == "1"){
                  ?><div id="circle-green2" ></div><?php
                } else {
                  ?><div id="circle-red2" ></div><?php
                }
              }

              else if ($row["NAME"] == "Fire Alarm"){
                ?><div style="float:left;"><?php echo $row["NAME"];?>&nbsp;</div><?php 
                if($row["STATUS"] == "1"){
                  ?><div id="circle-green2"></div><?php
                } else {
                  ?><div id="circle-red2"></div><?php
                }
              }
              else if ($row["NAME"] == "Motion"){
                ?><div style="float:left;"><?php echo $row["NAME"];?>&nbsp;</div><?php 
                if($row["STATUS"] == "1"){
                  ?><div id="circle-green2"></div><?php
                } else {
                  ?><div id="circle-red2"></div><?php
                }
              }
              else {
              }
          }
          ?>
		  <br>
		  <br>
		  <br>
      </div>
      <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
        <div class="panel-body">
	  <?php
         $i = 3;
         $result = mysqli_query($connection, "SELECT D.NAME, K.STATUS, J.ID, S.NAME AS ROOM, J.ID_ROOM FROM DEVICES D, DEVICE_LOCATOR J, ROOMS S, (SELECT L.* FROM DEVICE_STATUS L LEFT JOIN DEVICE_STATUS R ON
L.id = R.id AND
L.EVENT_TIMER < R.EVENT_TIMER
WHERE isnull (R.ID)) K WHERE J.ID_ROOM = $i AND J.ID_DEVICE = D.ID_DEVICE AND J.ID = K.ID AND J.ID_ROOM = S.ID_ROOM GROUP BY D.ID_DEVICE");
          while($row = mysqli_fetch_array($result)){
              // echo $row["NAME"]," ", $row["ID"], ": ", $row["STATUS"], ". ";
               if ($row["NAME"] !== "Temperature" && $row["NAME"] !== "Humidity" && $row["NAME"] !== "Motion" && $row["NAME"] !== "Fire Alarm" && $row["NAME"] !== "Car" && $row["NAME"] !== "Pressure" ){
                ?>
                <input type="checkbox" data-toggle="toggle" name="toggle" <?php if($row["STATUS"]==1){ echo "checked";} ?> value="<?php echo $row["ID"];?>">
                <span class="mdl-switch__label"><?php echo $row["NAME"]; ?></span></br>
                <?php
              }
            }
          ?>
          
        </div>
      </div>
    </div>
    <div class="panel panel-default"> 	 <!-- Playroom -->
      <div class="panel-heading" role="tab" id="headingThree">
        <h4  class="panel-title" style="font-size:1.8em;margin-bottom:15px;">
          <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
            Playroom
          </a>
        </h4>
	 <?php
        $i = 6;
         $result = mysqli_query($connection, "SELECT D.NAME, K.STATUS, J.ID, S.NAME AS ROOM, J.ID_ROOM FROM DEVICES D, DEVICE_LOCATOR J, ROOMS S, (SELECT L.* FROM DEVICE_STATUS L LEFT JOIN DEVICE_STATUS R ON
L.id = R.id AND
L.EVENT_TIMER < R.EVENT_TIMER
WHERE isnull (R.ID)) K WHERE J.ID_ROOM = $i AND J.ID_DEVICE = D.ID_DEVICE AND J.ID = K.ID AND J.ID_ROOM = S.ID_ROOM GROUP BY D.ID_DEVICE");
          while($row = mysqli_fetch_array($result)){
              // echo $row["NAME"]," ", $row["ID"], ": ", $row["STATUS"], ". ";
              if ($row["NAME"] == "Temperature"){
                ?><div style="float:left;">Temperature: <input type="number" name="number" value="<?php echo $row["STATUS"]; ?>"><span class="badge">
                &#8451;</span>&nbsp;&nbsp;&nbsp;&nbsp;</div><?php
              }
              else if ($row["NAME"] == "Humidity"){
                ?><div style="float:left;">Humidity: <input type="number" name="number" value="<?php echo $row["STATUS"]; ?>"><span class="badge">
                &#37;</span>&nbsp;&nbsp;&nbsp;&nbsp;</div><?php
              }
              else if ($row["NAME"] == "Pressure"){
                ?><div style="float:left;">Pressure: <input type="number" name="number" value="<?php echo $row["STATUS"]; ?>"><span class="badge">
                bar</span>&nbsp;&nbsp;&nbsp;&nbsp;</div><?php
              }
              else if ($row["NAME"] == "Car"){
                ?><div style="float:left;"><?php echo $row["NAME"];?>&nbsp;</div><?php 
                if($row["STATUS"] == "1"){
                  ?><div id="circle-green2" ></div><?php
                } else {
                  ?><div id="circle-red2" ></div><?php
                }
              }

              else if ($row["NAME"] == "Fire Alarm"){
                ?><div style="float:left;"><?php echo $row["NAME"];?>&nbsp;</div><?php 
                if($row["STATUS"] == "1"){
                  ?><div id="circle-green2"></div><?php
                } else {
                  ?><div id="circle-red2"></div><?php
                }
              }
              else if ($row["NAME"] == "Motion"){
                ?><div style="float:left;"><?php echo $row["NAME"];?>&nbsp;</div><?php 
                if($row["STATUS"] == "1"){
                  ?><div id="circle-green2"></div><?php
                } else {
                  ?><div id="circle-red2"></div><?php
                }
              }
              else {
              }
          }
          ?>
		  <br>
		  <br>
		  <br>
		
      </div>
      <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
        <div class="panel-body">
          <?php
         $i = 6;
         $result = mysqli_query($connection, "SELECT D.NAME, K.STATUS, J.ID, S.NAME AS ROOM, J.ID_ROOM FROM DEVICES D, DEVICE_LOCATOR J, ROOMS S, (SELECT L.* FROM DEVICE_STATUS L LEFT JOIN DEVICE_STATUS R ON
L.id = R.id AND
L.EVENT_TIMER < R.EVENT_TIMER
WHERE isnull (R.ID)) K WHERE J.ID_ROOM = $i AND J.ID_DEVICE = D.ID_DEVICE AND J.ID = K.ID AND J.ID_ROOM = S.ID_ROOM GROUP BY D.ID_DEVICE");
          while($row = mysqli_fetch_array($result)){
              // echo $row["NAME"]," ", $row["ID"], ": ", $row["STATUS"], ". ";
               if ($row["NAME"] !== "Temperature" && $row["NAME"] !== "Humidity" && $row["NAME"] !== "Motion" && $row["NAME"] !== "Fire Alarm" && $row["NAME"] !== "Car" && $row["NAME"] !== "Pressure" ){
                ?>
                <input type="checkbox" data-toggle="toggle" name="toggle" <?php if($row["STATUS"]==1){ echo "checked";} ?> value="<?php echo $row["ID"];?>">
                <span class="mdl-switch__label"><?php echo $row["NAME"]; ?></span></br>
                <?php
              }
            }
          ?>  

        </div>
      </div>
    </div>

    <div class="panel panel-default"> <!-- Kitchen -->
      <div class="panel-heading" role="tab" id="headingFour">
        <h4  class="panel-title" style="font-size:1.8em;margin-bottom:15px;">
          <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
            Kitchen
          </a>
        </h4>
		
		 <?php
        $i = 2;
         $result = mysqli_query($connection, "SELECT D.NAME, K.STATUS, J.ID, S.NAME AS ROOM, J.ID_ROOM FROM DEVICES D, DEVICE_LOCATOR J, ROOMS S, (SELECT L.* FROM DEVICE_STATUS L LEFT JOIN DEVICE_STATUS R ON
L.id = R.id AND
L.EVENT_TIMER < R.EVENT_TIMER
WHERE isnull (R.ID)) K WHERE J.ID_ROOM = $i AND J.ID_DEVICE = D.ID_DEVICE AND J.ID = K.ID AND J.ID_ROOM = S.ID_ROOM GROUP BY D.ID_DEVICE");
          while($row = mysqli_fetch_array($result)){
              // echo $row["NAME"]," ", $row["ID"], ": ", $row["STATUS"], ". ";
              if ($row["NAME"] == "Temperature"){
                ?><div style="float:left;">Temperature: <input type="number" name="number" value="<?php echo $row["STATUS"]; ?>"><span class="badge">
                &#8451;</span>&nbsp;&nbsp;&nbsp;&nbsp;</div><?php
              }
              else if ($row["NAME"] == "Humidity"){
                ?><div style="float:left;">Humidity: <input type="number" name="number" value="<?php echo $row["STATUS"]; ?>"><span class="badge">
                &#37;</span>&nbsp;&nbsp;&nbsp;&nbsp;</div><?php
              }
              else if ($row["NAME"] == "Pressure"){
                ?><div style="float:left;">Pressure: <input type="number" name="number" value="<?php echo $row["STATUS"]; ?>"><span class="badge">
                bar</span>&nbsp;&nbsp;&nbsp;&nbsp;</div><?php
              }
              else if ($row["NAME"] == "Car"){
                ?><div style="float:left;"><?php echo $row["NAME"];?>&nbsp;</div><?php 
                if($row["STATUS"] == "1"){
                  ?><div id="circle-green2" ></div><?php
                } else {
                  ?><div id="circle-red2" ></div><?php
                }
              }

              else if ($row["NAME"] == "Fire Alarm"){
                ?><div style="float:left;"><?php echo $row["NAME"];?>&nbsp;</div><?php 
                if($row["STATUS"] == "1"){
                  ?><div id="circle-green2"></div><?php
                } else {
                  ?><div id="circle-red2"></div><?php
                }
              }
              else if ($row["NAME"] == "Motion"){
                ?><div style="float:left;"><?php echo $row["NAME"];?>&nbsp;</div><?php 
                if($row["STATUS"] == "1"){
                  ?><div id="circle-green2"></div><?php
                } else {
                  ?><div id="circle-red2"></div><?php
                }
              }
              else {
              }
          }
          ?>
		  <br>
		  <br>
		  <br>
		

      </div>
      <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
        <div class="panel-body">
          <?php
         $i = 2;
         $result = mysqli_query($connection, "SELECT D.NAME, K.STATUS, J.ID, S.NAME AS ROOM, J.ID_ROOM FROM DEVICES D, DEVICE_LOCATOR J, ROOMS S, (SELECT L.* FROM DEVICE_STATUS L LEFT JOIN DEVICE_STATUS R ON
L.id = R.id AND
L.EVENT_TIMER < R.EVENT_TIMER
WHERE isnull (R.ID)) K WHERE J.ID_ROOM = $i AND J.ID_DEVICE = D.ID_DEVICE AND J.ID = K.ID AND J.ID_ROOM = S.ID_ROOM GROUP BY D.ID_DEVICE");
          while($row = mysqli_fetch_array($result)){
              // echo $row["NAME"]," ", $row["ID"], ": ", $row["STATUS"], ". ";
               if ($row["NAME"] !== "Temperature" && $row["NAME"] !== "Humidity" && $row["NAME"] !== "Motion" && $row["NAME"] !== "Fire Alarm" && $row["NAME"] !== "Car" && $row["NAME"] !== "Pressure" ){
                ?>
                <input type="checkbox" data-toggle="toggle" name="toggle" <?php if($row["STATUS"]==1){ echo "checked";} ?> value="<?php echo $row["ID"];?>">
                <span class="mdl-switch__label"><?php echo $row["NAME"]; ?></span></br>
                <?php
              }
            }
          ?>  
        </div>
      </div>
    </div>

    <div class="panel panel-default">  <!-- Hall -->
      <div class="panel-heading" role="tab" id="headingFive">
        <h4  class="panel-title" style="font-size:1.8em;margin-bottom:15px;">
          <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
            Hall
          </a>
        </h4>
		
 <?php
        $i = 4;
         $result = mysqli_query($connection, "SELECT D.NAME, K.STATUS, J.ID, S.NAME AS ROOM, J.ID_ROOM FROM DEVICES D, DEVICE_LOCATOR J, ROOMS S, (SELECT L.* FROM DEVICE_STATUS L LEFT JOIN DEVICE_STATUS R ON
L.id = R.id AND
L.EVENT_TIMER < R.EVENT_TIMER
WHERE isnull (R.ID)) K WHERE J.ID_ROOM = $i AND J.ID_DEVICE = D.ID_DEVICE AND J.ID = K.ID AND J.ID_ROOM = S.ID_ROOM GROUP BY D.ID_DEVICE");
          while($row = mysqli_fetch_array($result)){
              // echo $row["NAME"]," ", $row["ID"], ": ", $row["STATUS"], ". ";
              if ($row["NAME"] == "Temperature"){
                ?><div style="float:left;">Temperature: <input type="number" name="number" value="<?php echo $row["STATUS"]; ?>"><span class="badge">
                &#8451;</span>&nbsp;&nbsp;&nbsp;&nbsp;</div><?php
              }
              else if ($row["NAME"] == "Humidity"){
                ?><div style="float:left;">Humidity: <input type="number" name="number" value="<?php echo $row["STATUS"]; ?>"><span class="badge">
                &#37;</span>&nbsp;&nbsp;&nbsp;&nbsp;</div><?php
              }
              else if ($row["NAME"] == "Pressure"){
                ?><div style="float:left;">Pressure: <input type="number" name="number" value="<?php echo $row["STATUS"]; ?>"><span class="badge">
                bar</span>&nbsp;&nbsp;&nbsp;&nbsp;</div><?php
              }
              else if ($row["NAME"] == "Car"){
                ?><div style="float:left;"><?php echo $row["NAME"];?>&nbsp;</div><?php 
                if($row["STATUS"] == "1"){
                  ?><div id="circle-green2" ></div><?php
                } else {
                  ?><div id="circle-red2" ></div><?php
                }
              }

              else if ($row["NAME"] == "Fire Alarm"){
                ?><div style="float:left;"><?php echo $row["NAME"];?>&nbsp;</div><?php 
                if($row["STATUS"] == "1"){
                  ?><div id="circle-green2"></div><?php
                } else {
                  ?><div id="circle-red2"></div><?php
                }
              }
              else if ($row["NAME"] == "Motion"){
                ?><div style="float:left;"><?php echo $row["NAME"];?>&nbsp;</div><?php 
                if($row["STATUS"] == "1"){
                  ?><div id="circle-green2"></div><?php
                } else {
                  ?><div id="circle-red2"></div><?php
                }
              }
              else {
              }
          }
          ?>
		  <br>
		  <br>
		  <br>
		
      </div>
      <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
        <div class="panel-body">
         <?php
         $i = 4;
         $result = mysqli_query($connection, "SELECT D.NAME, K.STATUS, J.ID, S.NAME AS ROOM, J.ID_ROOM FROM DEVICES D, DEVICE_LOCATOR J, ROOMS S, (SELECT L.* FROM DEVICE_STATUS L LEFT JOIN DEVICE_STATUS R ON
L.id = R.id AND
L.EVENT_TIMER < R.EVENT_TIMER
WHERE isnull (R.ID)) K WHERE J.ID_ROOM = $i AND J.ID_DEVICE = D.ID_DEVICE AND J.ID = K.ID AND J.ID_ROOM = S.ID_ROOM GROUP BY D.ID_DEVICE");
          while($row = mysqli_fetch_array($result)){
              // echo $row["NAME"]," ", $row["ID"], ": ", $row["STATUS"], ". ";
               if ($row["NAME"] !== "Temperature" && $row["NAME"] !== "Humidity" && $row["NAME"] !== "Motion" && $row["NAME"] !== "Fire Alarm" && $row["NAME"] !== "Car" && $row["NAME"] !== "Pressure" ){
                ?>
                <input type="checkbox" data-toggle="toggle" name="toggle" <?php if($row["STATUS"]==1){ echo "checked";} ?> value="<?php echo $row["ID"];?>">
                <span class="mdl-switch__label"><?php echo $row["NAME"]; ?></span></br>
                <?php
              }
            }
          ?> 
        </div>
      </div>
    </div>

    <div class="panel panel-default">  <!-- Bedroom -->
      <div class="panel-heading" role="tab" id="headingSix">
        <h4  class="panel-title" style="font-size:1.8em;margin-bottom:15px;">
          <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
            Bedroom
          </a>
        </h4>
<?php
        $i = 5;
         $result = mysqli_query($connection, "SELECT D.NAME, K.STATUS, J.ID, S.NAME AS ROOM, J.ID_ROOM FROM DEVICES D, DEVICE_LOCATOR J, ROOMS S, (SELECT L.* FROM DEVICE_STATUS L LEFT JOIN DEVICE_STATUS R ON
L.id = R.id AND
L.EVENT_TIMER < R.EVENT_TIMER
WHERE isnull (R.ID)) K WHERE J.ID_ROOM = $i AND J.ID_DEVICE = D.ID_DEVICE AND J.ID = K.ID AND J.ID_ROOM = S.ID_ROOM GROUP BY D.ID_DEVICE");
          while($row = mysqli_fetch_array($result)){
              // echo $row["NAME"]," ", $row["ID"], ": ", $row["STATUS"], ". ";
              if ($row["NAME"] == "Temperature"){
                ?><div style="float:left;">Temperature: <input type="number" name="number" value="<?php echo $row["STATUS"]; ?>"><span class="badge">
                &#8451;</span>&nbsp;&nbsp;&nbsp;&nbsp;</div><?php
              }
              else if ($row["NAME"] == "Humidity"){
                ?><div style="float:left;">Humidity: <input type="number" name="number" value="<?php echo $row["STATUS"]; ?>"><span class="badge">
                &#37;</span>&nbsp;&nbsp;&nbsp;&nbsp;</div><?php
              }
              else if ($row["NAME"] == "Pressure"){
                ?><div style="float:left;">Pressure: <input type="number" name="number" value="<?php echo $row["STATUS"]; ?>"><span class="badge">
                bar</span>&nbsp;&nbsp;&nbsp;&nbsp;</div><?php
              }
              else if ($row["NAME"] == "Car"){
                ?><div style="float:left;"><?php echo $row["NAME"];?>&nbsp;</div><?php 
                if($row["STATUS"] == "1"){
                  ?><div id="circle-green2" ></div><?php
                } else {
                  ?><div id="circle-red2" ></div><?php
                }
              }

              else if ($row["NAME"] == "Fire Alarm"){
                ?><div style="float:left;"><?php echo $row["NAME"];?>&nbsp;</div><?php 
                if($row["STATUS"] == "1"){
                  ?><div id="circle-green2"></div><?php
                } else {
                  ?><div id="circle-red2"></div><?php
                }
              }
              else if ($row["NAME"] == "Motion"){
                ?><div style="float:left;"><?php echo $row["NAME"];?>&nbsp;</div><?php 
                if($row["STATUS"] == "1"){
                  ?><div id="circle-green2"></div><?php
                } else {
                  ?><div id="circle-red2"></div><?php
                }
              }
              else {
              }
          }
          ?>
		  <br>
		  <br>
		  <br>
		
      </div>
      <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
        <div class="panel-body">
         <?php
         $i = 5;
         $result = mysqli_query($connection, "SELECT D.NAME, K.STATUS, J.ID, S.NAME AS ROOM, J.ID_ROOM FROM DEVICES D, DEVICE_LOCATOR J, ROOMS S, (SELECT L.* FROM DEVICE_STATUS L LEFT JOIN DEVICE_STATUS R ON
L.id = R.id AND
L.EVENT_TIMER < R.EVENT_TIMER
WHERE isnull (R.ID)) K WHERE J.ID_ROOM = $i AND J.ID_DEVICE = D.ID_DEVICE AND J.ID = K.ID AND J.ID_ROOM = S.ID_ROOM GROUP BY D.ID_DEVICE");
          while($row = mysqli_fetch_array($result)){
              // echo $row["NAME"]," ", $row["ID"], ": ", $row["STATUS"], ". ";
               if ($row["NAME"] !== "Temperature" && $row["NAME"] !== "Humidity" && $row["NAME"] !== "Motion" && $row["NAME"] !== "Fire Alarm" && $row["NAME"] !== "Car" && $row["NAME"] !== "Pressure" ){
                ?>
                <input type="checkbox" data-toggle="toggle" name="toggle" <?php if($row["STATUS"]==1){ echo "checked";} ?> value="<?php echo $row["ID"];?>">
                <span class="mdl-switch__label"><?php echo $row["NAME"]; ?></span></br>
                <?php
              }
            }
          ?> 

        </div>
      </div>
    </div>

    <div class="panel panel-default">  <!-- Bathroom -->
      <div class="panel-heading" role="tab" id="headingSeven">
        <h4  class="panel-title" style="font-size:1.8em;margin-bottom:15px;">
          <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
            Bathroom
          </a>
        </h4>
		
	<?php
        $i = 7;
         $result = mysqli_query($connection, "SELECT D.NAME, K.STATUS, J.ID, S.NAME AS ROOM, J.ID_ROOM FROM DEVICES D, DEVICE_LOCATOR J, ROOMS S, (SELECT L.* FROM DEVICE_STATUS L LEFT JOIN DEVICE_STATUS R ON
L.id = R.id AND
L.EVENT_TIMER < R.EVENT_TIMER
WHERE isnull (R.ID)) K WHERE J.ID_ROOM = $i AND J.ID_DEVICE = D.ID_DEVICE AND J.ID = K.ID AND J.ID_ROOM = S.ID_ROOM GROUP BY D.ID_DEVICE");
          while($row = mysqli_fetch_array($result)){
              // echo $row["NAME"]," ", $row["ID"], ": ", $row["STATUS"], ". ";
              if ($row["NAME"] == "Temperature"){
                ?><div style="float:left;">Temperature: <input type="number" name="number" value="<?php echo $row["STATUS"]; ?>"><span class="badge">
                &#8451;</span>&nbsp;&nbsp;&nbsp;&nbsp;</div><?php
              }
              else if ($row["NAME"] == "Humidity"){
                ?><div style="float:left;">Humidity: <input type="number" name="number" value="<?php echo $row["STATUS"]; ?>"><span class="badge">
                &#37;</span>&nbsp;&nbsp;&nbsp;&nbsp;</div><?php
              }
              else if ($row["NAME"] == "Pressure"){
                ?><div style="float:left;">Pressure: <input type="number" name="number" value="<?php echo $row["STATUS"]; ?>"><span class="badge">
                bar</span>&nbsp;&nbsp;&nbsp;&nbsp;</div><?php
              }
              else if ($row["NAME"] == "Car"){
                ?><div style="float:left;"><?php echo $row["NAME"];?>&nbsp;</div><?php 
                if($row["STATUS"] == "1"){
                  ?><div id="circle-green2" ></div><?php
                } else {
                  ?><div id="circle-red2" ></div><?php
                }
              }

              else if ($row["NAME"] == "Fire Alarm"){
                ?><div style="float:left;"><?php echo $row["NAME"];?>&nbsp;</div><?php 
                if($row["STATUS"] == "1"){
                  ?><div id="circle-green2"></div><?php
                } else {
                  ?><div id="circle-red2"></div><?php
                }
              }
              else if ($row["NAME"] == "Motion"){
                ?><div style="float:left;"><?php echo $row["NAME"];?>&nbsp;</div><?php 
                if($row["STATUS"] == "1"){
                  ?><div id="circle-green2"></div><?php
                } else {
                  ?><div id="circle-red2"></div><?php
                }
              }
              else {
              }
          }
          ?>
		  <br>
		  <br>
		  <br>
		
      </div>
      <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSeven">
        <div class="panel-body">

        <?php
         $i = 7;
         $result = mysqli_query($connection, "SELECT D.NAME, K.STATUS, J.ID, S.NAME AS ROOM, J.ID_ROOM FROM DEVICES D, DEVICE_LOCATOR J, ROOMS S, (SELECT L.* FROM DEVICE_STATUS L LEFT JOIN DEVICE_STATUS R ON
L.id = R.id AND
L.EVENT_TIMER < R.EVENT_TIMER
WHERE isnull (R.ID)) K WHERE J.ID_ROOM = $i AND J.ID_DEVICE = D.ID_DEVICE AND J.ID = K.ID AND J.ID_ROOM = S.ID_ROOM GROUP BY D.ID_DEVICE");
          while($row = mysqli_fetch_array($result)){
              // echo $row["NAME"]," ", $row["ID"], ": ", $row["STATUS"], ". ";
               if ($row["NAME"] !== "Temperature" && $row["NAME"] !== "Humidity" && $row["NAME"] !== "Motion" && $row["NAME"] !== "Fire Alarm" && $row["NAME"] !== "Car" && $row["NAME"] !== "Pressure" ){
                ?>
                <input type="checkbox" data-toggle="toggle" name="toggle" <?php if($row["STATUS"]==1){ echo "checked";} ?> value="<?php echo $row["ID"];?>">
                <span class="mdl-switch__label"><?php echo $row["NAME"]; ?></span></br>
                <?php
              }
            }
          ?> 
        </div>
      </div>
    </div>


  </div>
  <?php
  require "../controlpanel/floatmenu.php";
  ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script defer src="https://code.getmdl.io/1.1.3/material.min.js"></script>
  <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
</body>
</html>