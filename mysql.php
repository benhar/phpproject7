<?php
$host = "localhost";
$user = 'root';
$pass = '';
$db = 'test';


$connection = mysql_connect($host, $user, $pass);
if($connection){
    echo 'Connected';
}
else {
    echo "Not connected";
}

$db = mysql_select_db($db);

if($db){echo "Selected";}
else{echo "Unable to select";}


//$query = "INSERT INTO student (name, roll, class) VALUES ('Rasel', 12, 'Class 9')";
//$mouse = "INSERT INTO student (name, roll, class) VALUES ('Daanish', 3, 'class10' )";
$keyboard = "SELECT * FROM student WHERE class='Class 10' AND roll=3";
$delete = mysql_query($keyboard,$connection);
$data = mysql_fetch_array($delete);

var_dump($data);
//$execute = mysql_query($query, $connection);
//$execute = mysql_query($mouse, $connection);
//if($delete){
//    echo "deleted";
//}
//else {
//    echo "Unable to delete";
//}








