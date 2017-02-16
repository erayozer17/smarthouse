  
    <script type="text/javascript">

    $(document).ready(function(){

      $('input[name="switch"]').on("click", function() {
        if($(this).is(":checked")){

                     //alert("Checkbox is checked." + $(this).val() );

                     $.ajax({
                      type: "POST",
                      url: "../dbconnection/ajax.php",
                      data: {value: "1", id: $(this).val()},
                      success: function(html){
                        $("#display").html(html).show();
                      }

                    });

                   }
                   /*below else block is not required but if user uncheck any checkbox & you want to update the description in db you can call ajax & update DB from this else part */
                   else if($(this).is(":not(:checked)")){
                     //alert("Checkbox is unchecked."+ $(this).val());

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
    <?php

    $query = "SELECT * FROM DEVICE_LOCATOR";
    $query2 = "SELECT * FROM DEVICES";
    $query3 = "SELECT * FROM ROOMS";
    // $query4 = "SELECT * FROM DEVICE_STATUS ORDER BY EVENT_TIMER DESC, ID DESC";
    $query4 = "SELECT * FROM DEVICE_STATUS ORDER BY EVENT_TIMER DESC, ID DESC";
    $res = $connection->query($query);
    $devices = $connection->query($query2);
    $rooms = $connection->query($query3);
    $status_all = $connection->query($query4);
    $i = 0;
    for($j=0; $j< $devices->num_rows;$j++){
      $row2 = $devices->fetch_array();
      $device_name_all[$j] = $row2['NAME'];
      $device_id_all[$j] = $row2['ID_DEVICE'];    
    }
    while($row3 = $status_all->fetch_object()){
      $status_status[$i] = $row3->STATUS;
      $status_id[$i] = $row3->ID;

      $i++;
    }
    $i = 0;
    if ($res->num_rows > 0){

      while ($row = $res->fetch_object())  {
        $id[$i] = $row->ID;
        $device = $row->ID_DEVICE;
        $room = $row->ID_ROOM;    
        for ($k=0;$k <$devices->num_rows; $k++){
          if ($device == $device_id_all[$k]){
            $device_name[$i] = $device_name_all[$k];
          }
        }
        $device_id[$i] = $device;
        $room_id[$i] = $row->ID_ROOM;
        $i ++;
      }
    }
    ?>
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
      <header class="mdl-layout__header">
        <div class="mdl-layout__header-row" >
          <!-- Title -->
          <span class="mdl-layout-title">House Control Panel</span>
          <!-- Add spacer, to align navigation to the right -->
          <div class="mdl-layout-spacer"></div>
          <!-- Navigation. We hide it in small screens. -->
          <nav class="mdl-navigation mdl-layout--large-screen-only">
            <a class="mdl-navigation__link" href="../login/logout.php"> Log Out </a>
          </nav>
        </div>
      </header>
      <div class="mdl-layout__drawer collapse">
        <span class="mdl-layout-title">Menu</span>
        <nav class="mdl-navigation">
          <a class="mdl-navigation__link" href="../controlpanel/controlpanel.php">Control Panel</a>
          <li  data-toggle="collapse" data-target="#garage" class="collapsed active">
            <a class="mdl-navigation__link" href="#"><i class="fa fa-gift fa-lg"></i> Garage <span class="arrow"></span></a>
          </li>
          <ul class="sub-menu collapse" id="garage">
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
                <li>
                    <p><?php  echo $row["NAME"]; ?><p>
                      <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="garage-<?php echo $row["NAME"]; ?>" >
                        <input type="checkbox" id="garage-<?php echo $row["NAME"];?>" name="switch" class="mdl-switch__input"<?php if($row["STATUS"]==1){ echo "checked";} ?> value="<?php echo $row["ID"];?>">
                        <span class="mdl-switch__label"></span>
                </li>
                <?php
              }
            }
          ?>
              </ul>
              <li  data-toggle="collapse" data-target="#kitchen" class="collapsed active">
                <a class="mdl-navigation__link" href="#"><i class="fa fa-gift fa-lg"></i> Kitchen <span class="arrow"></span></a>
              </li>
              <ul class="sub-menu collapse" id="kitchen">
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
                <li>
                    <p><?php  echo $row["NAME"]; ?><p>
                      <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="kitchen-<?php echo $row["NAME"]; ?>" >
                        <input type="checkbox" id="kitchen-<?php echo $row["NAME"];?>" name="switch" class="mdl-switch__input"<?php if($row["STATUS"]==1){ echo "checked";} ?> value="<?php echo $row["ID"];?>">
                        <span class="mdl-switch__label"></span>
                </li>
                <?php
              }
            }
          ?>
                  </ul>
                  <li  data-toggle="collapse" data-target="#livingroom" class="collapsed active">
                    <a class="mdl-navigation__link" href="#"><i class="fa fa-gift fa-lg"></i> Living Room <span class="arrow"></span></a>
                  </li>
                  <ul class="sub-menu collapse" id="livingroom">
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
                <li>
                    <p><?php  echo $row["NAME"]; ?><p>
                      <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="livingroom-<?php echo $row["NAME"]; ?>" >
                        <input type="checkbox" id="livingroom-<?php echo $row["NAME"];?>" name="switch" class="mdl-switch__input"<?php if($row["STATUS"]==1){ echo "checked";} ?> value="<?php echo $row["ID"];?>">
                        <span class="mdl-switch__label"></span>
                </li>
                <?php
              }
            }
          ?>
                      </ul>
                      <li  data-toggle="collapse" data-target="#hall" class="collapsed active">
                        <a class="mdl-navigation__link" href="#"><i class="fa fa-gift fa-lg"></i> Hall <span class="arrow"></span></a>
                      </li>
                      <ul class="sub-menu collapse" id="hall">
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
                <li>
                    <p><?php  echo $row["NAME"]; ?><p>
                      <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="hall-<?php echo $row["NAME"]; ?>" >
                        <input type="checkbox" id="hall-<?php echo $row["NAME"];?>" name="switch" class="mdl-switch__input"<?php if($row["STATUS"]==1){ echo "checked";} ?> value="<?php echo $row["ID"];?>">
                        <span class="mdl-switch__label"></span>
                </li>
                <?php
              }
            }
          ?>
                          </ul>
                          <li  data-toggle="collapse" data-target="#bedroom" class="collapsed active">
                            <a class="mdl-navigation__link" href="#"><i class="fa fa-gift fa-lg"></i> Bedroom <span class="arrow"></span></a>
                          </li>
                          <ul class="sub-menu collapse" id="bedroom">
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
                <li>
                    <p><?php  echo $row["NAME"]; ?><p>
                      <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="bedroom-<?php echo $row["NAME"]; ?>" >
                        <input type="checkbox" id="bedroom-<?php echo $row["NAME"];?>" name="switch" class="mdl-switch__input"<?php if($row["STATUS"]==1){ echo "checked";} ?> value="<?php echo $row["ID"];?>">
                        <span class="mdl-switch__label"></span>
                </li>
                <?php
              }
            }
          ?>
                              </ul>
                              <li  data-toggle="collapse" data-target="#playroom" class="collapsed active">
                                <a class="mdl-navigation__link" href="#"><i class="fa fa-gift fa-lg"></i> Playroom <span class="arrow"></span></a>
                              </li>
                              <ul class="sub-menu collapse" id="playroom">
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
                <li>
                    <p><?php  echo $row["NAME"]; ?><p>
                      <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="playroom-<?php echo $row["NAME"]; ?>" >
                        <input type="checkbox" id="playroom-<?php echo $row["NAME"];?>" name="switch" class="mdl-switch__input"<?php if($row["STATUS"]==1){ echo "checked";} ?> value="<?php echo $row["ID"];?>">
                        <span class="mdl-switch__label"></span>
                </li>
                <?php
              }
            }
          ?>
                </ul> 
                <li  data-toggle="collapse" data-target="#bathroom" class="collapsed active">
                  <a class="mdl-navigation__link" href="#"><i class="fa fa-gift fa-lg"></i> Bathroom <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="bathroom">
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
                <li>
                    <p><?php  echo $row["NAME"]; ?><p>
                      <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="bathroom-<?php echo $row["NAME"]; ?>" >
                        <input type="checkbox" id="bathroom-<?php echo $row["NAME"];?>" name="switch" class="mdl-switch__input"<?php if($row["STATUS"]==1){ echo "checked";} ?> value="<?php echo $row["ID"];?>">
                        <span class="mdl-switch__label"></span>
                </li>
                <?php
              }
            }
          ?>
                                      </ul>         
                                    </nav>
                                  </div>