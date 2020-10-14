<?php
SESSION_START();

$db_host='';//host name 
$db_user='';
$db_passwd='';//add your password if it exist
$db_name='';
$dbh = mysqli_connect($db_host,$db_user,$db_passwd,$db_name) or include("createdb.php");

If ($dbh==false) echo "connection
error".mysqli_connect_error($dbh);
If($_SERVER["REQUEST_METHOD"]=="POST")
{
$username=$_POST['uname'];
$pass=$_POST['pwd'];
$_SESSION['user']=$username;
$sql = "SELECT password FROM logindat where uid='$username'";
if ($res = mysqli_query($dbh, $sql))
{
if (mysqli_num_rows($res) > 0)
{

while ($row = mysqli_fetch_array($res))
{
if($row['password']!=$pass)
{
echo"password is not matching";
}
}





$sql = "SELECT * FROM table2";
if ($res = mysqli_query($dbh, $sql))
{
if (mysqli_num_rows($res) > 0)
{

while ($row = mysqli_fetch_array($res))
{
echo $row["ttext"];
}




}else {echo"wrong user name";
}
} else echo"query can't execute";
mysqli_free_result($res);
}
?>

<html>
<form action="Tinsert.php" method="post">
<center><table>

<tr><td>enter text</td><td>
<input type="text" name="ttext" required></td></tr>

<tr><td align="center" valign="middle">
<input type="submit" name="enter" value="enter"></td>

</html>

