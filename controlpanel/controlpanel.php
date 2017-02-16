<?php

include '../dbconnection/connection.php';

      if(empty($_SESSION)) // if the session not yet started 
      session_start();

if(!isset($_SESSION['login_user'])) { //if not yet logged in
   header("Location: ../index.html");// send to login page
   exit;
 }
 ?>

 <!DOCTYPE html>
 <html>
 <head>
  <meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
  <title>Control Panel</title>
  <link rel="stylesheet" type="text/css" href="../css/mystyle.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="https://code.getmdl.io/1.1.3/material.min.js"></script>
  <link rel='stylesheet prefetch' href='http://storage.googleapis.com/code.getmdl.io/1.0.1/material.teal-red.min.css'>
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/icon?family=Material+Icons'>
</head>

<div class="fader"><h1>Welcome</h1></div>

<script>
    $(".fader").delay(1300).fadeOut(3000);
</script>

<div id="container">
  
  <body>

    <?php
    require '../menu/menu.php';
    ?>

    <div>
      <img class="img-bluep" id="img_bluep" src="../img/blueprint.png" alt="" usemap="#map" >

      <map id="blueprint" name="map">
        <area id="Garage" shape="rect" coords="239,421,566,867"
        alt="Garage" title="Garage">
        <area id="Kitchen" shape="rect" coords="566,631,1060,867"
        alt="Kitchen" title="Kitchen">
        <area id="Livingroom" shape="rect" coords="566,194,1210,631"
        alt="Livingroom" title="Living Room">
        <area id="Hall" shape="rect" coords="1060,631,1210,867"
        alt="Hall" title="Hall">
        <area id="Bedroom" shape="rect" coords="1210,193,1641,476"
        alt="Bedroom" title="Bedroom">
        <area id="Playroom" shape="rect" coords="1210,476,1641,668"
        alt="Playroom" title="Playroom">
        <area id="Bathroom" shape="rect" coords="1210,669,1641,867"
        alt="Bathroom" title="Bathroom">
      </map>
    </div>

    <div id="showsensor"></div>

    <script type="text/javascript">
    window.onload = function () {
      var ImageMap = function (map) {
        var n,
        areas = map.getElementsByTagName('area'),
        len = areas.length,
        coords = [],
        previousWidth = 1920;
        for (n = 0; n < len; n++) {
          coords[n] = areas[n].coords.split(',');
        }
        this.resize = function () {
          var n, m, clen,
          x = document.body.clientWidth / previousWidth;
          for (n = 0; n < len; n++) {
            clen = coords[n].length;
            for (m = 0; m < clen; m++) {
              coords[n][m] *= x;
            }
            areas[n].coords = coords[n].join(',');
          }
          previousWidth = document.body.clientWidth;
          return true;
        };
        window.onresize = this.resize;
      },
      imageMap = new ImageMap(document.getElementById('blueprint'));
      imageMap.resize();
    };
    </script>

    <script>
    function showSensor(str) {
      if (str == "") {
        document.getElementById("showsensor").innerHTML = "";
        return;
      } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
          } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
          }
          xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
              document.getElementById("showsensor").innerHTML = xmlhttp.responseText;
            }
          };
          xmlhttp.open("GET","../dbconnection/dialog.php?q="+str,true);
          xmlhttp.send();
        }
      }
      </script>       
<?php
require "floatmenu.php";
?>
  </body>
  </html>
