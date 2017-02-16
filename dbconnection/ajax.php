<?php
$query=mysql_connect("localhost","root","");
mysql_select_db("hecgal15_db",$query);
if(isset($_POST['value']))
{
$value=$_POST['value'];
$id = $_POST['id'];
mysql_query("INSERT INTO DEVICE_STATUS(ID, STATUS) VALUES ('$id','$value')");
}
?>