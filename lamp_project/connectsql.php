<html>
<head>
<title>All in one - Shopping Express </title>
<link rel="icon" type="image/jpg" href="shopping-cart.jpg" >
</head>
<body>
	<?php
  session_start();
  require_once('header.php');
  do_html_header();
  
	/*echo "<pre>";
	print_r($GLOBALS);
	echo "</pre>";
	echo "<hr/>";*/

	$conn = new mysqli("localhost","lamp","1","lamp_final_project");
	if($conn->connect_errno)
	{
	die("MYSQL connection failed:" + $conn->connect_error);
	}
   
   function getPostedValue($name)
   {
    	if(isset($_POST[$name]))
         {
            return $_POST[$name]; 
         }
	    else
         {
	    return "value not inserted by user";
         }
  }

    $title = getPostedValue('title');
    $description = getPostedValue('description');
    $category = getPostedValue('category');
    $sub_category = getPostedValue('subcategory');
    $country = getPostedValue('country');
    $city = getPostedValue('city');
    $cost = getPostedValue('cost');
    $email = getPostedValue('email');
    $confirmemail = getPostedValue('confirmemail');
    
    $query_str = "INSERT INTO posts VALUE(NULL,'$title','$description','$category', '$sub_category', '$country','$city',$cost,'$email',NULL,NULL,NULL,NULL)";
   // echo $query_str;
    //echo "<br><hr/><br>";

    if (TRUE !== $conn->query($query_str))
    {
	    printf("Error running query (errno= %d): %s\n", $conn->errno, $conn->error);
    }else{
        echo("data inserted in DB");
	  }
    $conn->close()
  	?>
    <a href="homepg.php">Back to Home Page"</a>
</body>
</html>
