<html>
<head>

  <link rel="icon"type="image/jpg" href="shopping-cart.jpg">
  <title>All in one - Shopping Express</title>
</head>

<body>
<?php
session_start();
require_once('header.php');
do_html_header();
?>

<?php
$host="localhost";
$user="lamp";
$password="1";
$database='lamp_final_project';

$link=mysql_connect('localhost','lamp','1');
if (!$link) {
  die('Could not connect: ' . mysql_error());
}
if (!mysql_select_db($database, $link)) {
die("failed to select db:".mysql_error());
}

if(isset($_POST['username']))
{ 
  $username = $_POST['username'];
  $password = $_POST['password']; 
  $sql = "SELECT * FROM login  WHERE username='".$username."' AND password='".$password."' LIMIT 1 ";
  $result = mysql_query($sql);
  if (!$result) {
    die('Invalid query: ' . mysql_error());
  }
  $result_array=mysql_fetch_array($result );
  if(!$result_array)
  {
   echo "Login unsuccessful";
   
  }
  else
  {
    echo "User '$username' successfully logged in.";
    $_SESSION["username"] = "$username";
  }
}
mysql_close($link);
?>

<?php
  if (!isset($_SESSION['username']))
  {
?>

  <center><h1>Login</h1></center>
 <form method="post">
   <table align="center" cellpadding="7" cellspacing="7">
     <tr>
     <td>Username:</td>
     <td><input type="text" name="username" /></td>
     </tr>

     <tr>
     <td>Password:</td>
     <td><input type="password" name="password" /></td>
     </tr>
  
     <tr>
     <td align="center" colspan=2>
        <input type="submit" value="Login" name="login" />
        <input type="reset" value="clear" name="clear" />
     </td>
     </tr>
   </table>
 </form>

<?php
  }
?>

<center>
<a href="homepg.php">Back to Home Page</a>
</center>

</body>
</html>
