<?php
$db_host='';//host name 
$db_user='';
$db_passwd='';//add your password if it exist
$db_name='';
$dbh = mysqli_connect($db_host,$db_user,$db_passwd,$db_name) or include("createdb.php");

If($_SERVER["REQUEST_METHOD"]==="POST")
{

$text=$_POST["ttext"];


$ins = "INSERT INTO table2 VALUES('$text')";

$result = mysqli_query($dbh,$ins) or
die("Error querying the database");

}
?>

