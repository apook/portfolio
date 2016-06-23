<html>
<head>

</head>
<body>
  
  <?php
  require_once('header.php');
  do_html_header();
  ?>

  <?php
  session_start();
  if (isset($_SESSION['username'])) {
  $old_user=$_SESSION['username'];
  unset($_SESSION['username']);
  if (session_destroy()) {
    echo "User '$old_user' successfully logged out.";
  }
}

?>

<a href="homepg.php">Back to Home Page</a>

</body>
</html>
