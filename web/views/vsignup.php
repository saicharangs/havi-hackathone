<?php
$db_host='';//host name 
$db_user='';
$db_passwd='';//add your password if it exist
$db_name='';
$dbh = mysqli_connect($db_host,$db_user,$db_passwd,$db_name) or include("createdb.php");

If($_SERVER["REQUEST_METHOD"]==="POST")
{

$uid=$_POST["uname"];
$pwd=$_POST["cpsd"];
$date=$_POST["date"];
$email=$_POST["email"];
$phno=$_POST["number "];


$ins = "INSERT INTO table11(name,password,date,email,phoneNo) VALUES ('$uid','$pwd','$date','$email','&phno')";

$result = mysqli_query($dbh,$ins) or
die("Error querying the database");
echo "operation success, pls refresh your database";
}
?>

