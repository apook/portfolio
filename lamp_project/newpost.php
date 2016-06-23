<html>
  <head>
  <style>
  .inputerror {
  	color: red;
	font-style: italic;
	font-size: 12;
  }
  </style>
    <link rel="icon" type="image/jpg" href="shopping-cart.jpg" >
      <title>
      All in one - Shopping Express 
      </title>
  </head>
  
  <body bgcolor="#FFFFF5">
    <?php
    session_start();
    require_once('header.php');
    do_html_header();
    ?>

    <?php
    if(!isset($_SESSION['username']))
    {
    ?>
      <center>
      <br/>Please Login To Create a New Post<br/><br/>
      <a href="homepg.php">Back to Home Page</a>
      </center>
    </body>
  </html>
    <?php
      exit();
    }
    ?>


    <?php
    function getPostedValue($name) {
      if (isset($_POST[$name])) {
	return $_POST[$name];
      } else {
        return "";
      }
    }
    

    function isSelected($name, $value) {
      if (isset($_POST[$name]) and $_POST[$name] == $value) {
        return "selected";
      } else {
        return "";
      }
    }

    function isChecked($name) {
      if (isset($_POST[$name]) and $_POST[$name] == $name) {
        return "checked";
      } else {
        return "";
      }
    }

    function getFileName($picNo) {
      if (isset($_FILES[$picNo]) and isset($_FILES[$picNo]['name'])) {
        return $_FILES[$picNo]['name'];
      } else {
        return "";
      }
    }
     
    $sub_categories = array("Books",
                            "Electronics",
	                          "Household",
	                          "Computer",
	                          "Finance",
		                        "Medical",
		           	            "FULL_TIME",
		                        "PART_TIME",
		                        "VOLUNTEERING",
				);
    function addSub_CategoryOption()
    {
    	global $sub_categories;
        foreach($sub_categories as &$subcat)
        {
            echo "<option name=\"$subcat\"";
            echo isSelected('subcategory',$subcat);
            echo ">$subcat</option>\n";
        }
    }


    $categories = array("sale",
                        "service",
                        "jobs",
                       );
      function addCategoryOption()
      {
	global $categories; 
	 foreach($categories as &$category)      
	  {   
	      echo "<option name=\"$category\"";
	      echo isSelected('category',$category);                   
	      echo ">$category</option>\n";
	  }
      }

    function addCountryOptions()
    {
        $countries = array("India",
                           "USA",
                           "UK",
                        );
        foreach($countries as &$country)
        { 
            echo "<option name=\"$country\"";
            echo isSelected('country',$country);
            echo ">$country</option>\n";
        }
    }


	function addCityOptions() {
		$cities = array("Delhi",
                    "Mumbai",
		                "Hydrabad",
				            "San francisco",
		                "Sacramento",
				            "New York",
                    "London",
			             	"Edinburgh",
			             	"Bristol",
		);
		foreach ($cities as &$city) {
			echo "<option name=\"$city\" ";
			echo isSelected('city', $city);
 			echo ">$city</option>\n";
		}
	}

    $validated=false;
    $errors = array();

    function getError($name) {
      global $errors;
      if (isset($errors[$name])) {
	return $errors[$name];
      } else {
        return "";
      }
    }

    function validate_cats($main_cat, $sub_cat) {
      // Check if a ROW with $category and $subcategory exist in 'categories' SQL Table.
      $link=mysql_connect('localhost','lamp','1');
      if (!$link) {
        die('Could not connect: ' . mysql_error());
      }
      if (!mysql_select_db("lamp_final_project", $link)) {
        die("failed to select db:".mysql_error());
      }
      $cat_query="SELECT category_id FROM categories WHERE main_category='$main_cat' AND sub_category='$sub_cat'";
      $result=mysql_query( $cat_query);
      if (!$result) {
        die("sql query error: ".mysql_error());
      }
      if (mysql_num_rows($result) == 0) {
        mysql_close($link);
        return false;
      }
      mysql_close($link);
      return true;
    }


    function validate_locations($country, $city) {
      // Check if a ROW with $category and $subcategory exist in 'categories' SQL Table.
      $link=mysql_connect('localhost','lamp','1');
      if (!$link) {
        die('Could not connect: ' . mysql_error());
      }
      if (!mysql_select_db("lamp_final_project", $link)) {
        die("failed to select db:".mysql_error());
      }
      $location_query="SELECT location_id FROM locations WHERE city='$city' AND country='$country'";
      $result=mysql_query($location_query);
      if (!$result) {
        die("sql query error: ".mysql_error());
      }
      if (mysql_num_rows($result) == 0) {
        mysql_close($link);
        return false;
      }
      mysql_close($link);
      return true;
    }



    $title = getPostedValue('title');
    $description = getPostedValue('description');
    $category = getPostedValue('category');
    $subcategory = getPostedValue('subcategory');
    $country = getPostedValue('country');
    $city = getPostedValue('city');
    $cost = getPostedValue('cost');
    $email = getPostedValue('email');
    $confirmemail = getPostedValue('confirmemail');
    $iagree = isChecked('iagree');
    // returns true: when there are no errors
    // returns false: when there is atleast 1 error
    function validate_all() {
	    global $errors;
	    global $title, $description,$category, $subcategory, $country, $city, $cost;
	    global $email, $confirmemail, $iagree;
            
	    $founderror=false;
    
            // 'title'
	    if ((strlen($title) < 1) or (strlen($title) > 99)) 
	    {
		    $errors['title'] = "Title must be between 1 to 100 chars";
		    $founderror=true;
	    } 
	    //'Discription
	    if ((strlen($description) < 1) or (strlen($description) > 500))
	    {
		    $errors['description'] = "Description must be between 1 to 500 chars";
		    $founderror=true;
	    }
            //added 'category'
	    if(!isset($category)) 
	    {
		    $errors['category']="You didn't select any category";
		    $founderror=true;
	    }	    
	    //'Sub-category'
	    if(!isset($subcategory))
	    {
		    $errors['subcategory']="You didn't select any subcategory";
		    $founderror=true;
	    }
      if(!validate_cats($category, $subcategory))
      {
		    $errors['subcategory']="Category and Sub-Category mismatch.";
		    $founderror=true;
      }

	    //'contry'
	    if(!isset($country)) 
	    {
		    $errors['contry']="You didn't select any country";
		    $founderror=true;
	    } 
	    //'city'
	    if(!isset($city))
	    {
		    $errors['city']="You didn't select any city";
		    $founderror=true;
	    }
      
      // Check if a ROW with $country and $city exists in locations table.
      if(!validate_locations($country,$city))
      {
        $errors['city']="city and country mismatch.";
        $founderror=true;
      }

	    //'cost'
	    if (!is_numeric($cost))
	    { 
		    $errors['cost']="Enter Numeric value";
		    $founderror=true;
	    } 
	    //'email'
	    if(0 === preg_match("/.+@.+\..+/",$email))
	    {
		    $errors['email']="Please enter a valid email address";
		    $founderror=true;
	    }
	    //'confirm email'
	    if(0!== strcmp($email,$confirmemail))
	    {
		    $errors['confirmemail']="Email dosenot match";
		    $founderror=true;
	    }
      //ckeckbox iagree
	    if (0 !== strcmp($iagree, "checked")) {
		    $errors['iagree']="Must agree to terms and conditions";
		    $founderror=true;
	    }
            
	    if($founderror==true)
	    {
		    return false; 
	    }
	    else
	    {
		    return true;
	    }
    }
    
    $validated = validate_all();


  ?>

           <center><h1><u>New Post</u></h1></center>
    <hr>
	<?php
	if ($validated) {
	?>
		<center><h2><br><u><b>PREVIEW</b></u></h2></center>
	<?php
	}
	?>


    <?php
    if (!$validated) {
    ?>
      <form action="newpost.php" method="POST" enctype="multipart/form-data">
    <?php
    } else {
    ?>
      <form action="connectsql.php" method="POST" enctype="multipart/form-data">
    <?php
    }
    ?>


    <table border="0" cellpadding="5" cellspacing="5"  align="center"> 
      <tr >
        <td align="right">Title
        </td>
        <td>
	<?php
		if (!$validated) {
	?>
			<input name="title" type="text" value="<?php echo $title; ?>">
			<div class="inputerror"><?php echo getError('title');?></div>

	<?php
		} else {
			echo $title;
 	?>
			<input name="title" type="hidden" value="<?php echo $title; ?>">
	<?php
		}
	?>
          
        </td>
      </tr>


      <tr>
        <td align="right">DESCRIPTION:
        </td>
        <td>
	<?php
		if (!$validated) {
	?>
			<textarea name="description"><?php echo getPostedValue('description') ?></textarea>
			<div class="inputerror"><?php echo getError('description');?></div>
	<?php
		} else {
			echo getPostedValue('description');
	?>
			<input name="description" type="hidden" value="<?php echo getPostedValue('description') ?>"/>
	<?php
		}
	?>

        </td>
      </tr>

        
      <tr>
          <td align="right">
          CATEGORY:
          </td>

        <td>

         <?php
                if (!$validated) {
         ?>
		 <select name="category">
                 	<?php addCategoryOption(); ?>       
                 </select>
		 <div class="inputerror"><?php echo getError('category');?></div>
	<?php
                } else {
		
                echo getPostedValue('category');
	?>
                <input type="hidden" name="category" value="<?php echo getPostedValue('category') ?>" >
        <?php
                }
        ?>
        </td>
 
      </tr>
      <tr>
        <td align="right"> 
          SUB-CATEGORY:
        </td>
        <td>

         <?php
              if (!$validated) {
         ?>
                 <select name="subcategory">
                 	<?php addSub_CategoryOption(); ?>       
                 </select>
                 <div class="inputerror"><?php echo getError('subcategory');?></div>
     	  <?php
              } else {
                echo $subcategory;
      	?>
                <input type="hidden" name="subcategory" value="<?php echo getPostedValue('subcategory') ?>" >
        <?php
              }
        ?>
        </td>
      </tr>
         


         
      <tr>
        <td align="right">
          COUNTRY:
        </td>
        <td>
      
       <?php
                if (!$validated) {
        ?>  
                <select name="country">
                <?php addCountryOptions(); ?>
                </select>
	    	<div class="inputerror"><?php echo getError('country');?></div>
        <?php
                } else {
                
			echo getPostedValue('country');
        ?>
			<input type="hidden" name="country" value="<?php echo getPostedValue('country') ?>">
        <?php
                }
        ?>
        </td>
      </tr>



      
      <tr>
        <td align="right"> 
          CITY:
        </td>
        <td>
        <?php
                if (!$validated) {
        ?>
	    	<select name="city">
	    	<?php addCityOptions();	?>
	    	</select>
		    <div class="inputerror"><?php echo getError('city');?></div>
      	<?php
	        	} else {        
                echo getPostedValue('city');
       	?>
	        <input type="hidden" name="city" value="<?php echo getPostedValue('city') ?>">
      	<?php
      		}
        	?>
         </td>
       </tr>

   
      <tr>
        <td align="right"> COST:
        </td>
        <td>
        <?php
                if (!$validated) {
        ?>
          	<input type="text" name="cost" value="<?php echo getPostedValue('cost') ?>">
	        	<div class="inputerror"><?php echo getError('cost');?></div>
      	<?php
	      	} else {
                   echo getPostedValue('cost');
        	?>
	        <input type="hidden" name="cost" value="<?php echo getPostedValue('cost'); ?>">
        	<?php
      	        	}
        	?>
        </td>
      </tr>


      <tr>
        <td align="right">EMAIL: </td>
        <td>
        <?php
      		if (!$validated) { 
       	?>
			    <input type="text" name="email" size="60%" maxlength="35" value="<?php echo getPostedValue('email')?>">
			    <div class="inputerror"><?php echo getError('email');?></div>
      	<?php
          } else {
			        echo getPostedValue('email')
         	?>
		    	<input name="email" type="hidden" size="60%" maxlength="35" value="<?php echo getPostedValue('email')?>">
       	<?php
	              	}
       	?>
      	</td>
      </tr>




      <tr>
         <td align="right">CONFERM EMAIL: </td>
	       <td>
         <?php
                if (!$validated) { 
          ?>
        	<input type="text" name="confirmemail" size="60%" maxlength="35" value="<?php echo getPostedValue('confirmemail')?>">
		        <div class="inputerror"><?php echo getError('confirmemail');?></div>
          <?php
                } else {
         		echo getPostedValue('confirmemail');
          ?>
	  	    <input name="confirmemail" type="hidden" size="60%" maxlength="35" value="<?php echo getPostedValue('confirmemail')?>">
          <?php
                }
            ?>
         </td>
      </tr>
     

 
      <tr>
      	<td align="right">
         <?php
                if (!$validated) { 
          ?>
                <input name="iagree" type="checkbox" size="10" value="iagree" <?php echo isChecked('iagree') ?>>
             		<div class="inputerror"><?php echo getError('iagree');?></div>
           
        <?php
              } else {
        ?>
	            	<input name="iagreechkbox" type="checkbox" value="yes" checked disabled>
	            	<input name="iagree" type="hidden" value="iagree">
         <?php
                }
         ?>
  	     </td>
	       <td> I agree with all the terms and conditions</td>
       </tr>
   
       <tr>
          <td colspan="2">Upload Images (optional)<td>
       </tr>
        <tr>
            <td align="right">IMAGE 1:</td>
        <td>
        <?php
        if (!$validated) {
        ?>
           <input type="file" name="pic1" accept="image/*">
        <?php
        } else {
	    	//$savedPath = saveImage('pic1');
                echo getFileName('pic1');
        ?>
         
       <input type="hidden" name="pic1" value="<?php ;?>">
      <?php
        }
        ?>
        </td>
       </tr>



       <tr>
          <td align="right">IMAGE 2:</td>
        <td>
         <?php
        if (!$validated) {
        ?>
                <input type="file" name="pic2" accept="image/*">
        <?php
        } else {
                echo getFileName('pic2');
        ?>
          <input type="hidden" name="pic2" value="<?php echo getFileName('pic2')?>">

       <?php
        }
        ?>
        </td>
      </tr>



      <tr>
          <td align="right">IMAGE 3:</td>
         <td>
         <?php
        if (!$validated) {
        ?>
                <input type="file" name="pic3" accept="image/*">
        <?php
        } else {
                echo getFileName('pic3');
        ?>
          <input type="hidden" name="pic3" value="<?php echo getFileName('pic3');?>">
        <?php
        }
        ?>
        </td>
      </tr>



      <tr>
          <td align="right">IMAGE 4:</td>
    	<td>
    	<?php
    	if (!$validated) {
     	?>
	  	<input type="file" name="pic4" accept="image/*">
     	<?php
    	} else {
	    	echo getFileName('pic4');
     	?>
	     	<input type="hidden" name="pic4" value="<?php echo getFileName('pic4'); ?>">
	    <?php
    	}
     	?>
	
     	</td>
    </tr>
     <tr align="center">
          <td colspan="2">
          
	    <?php
	          if (!$validated) {
     	?>
              <input type="submit" value="Preview" />
              <input type="reset" value="Clear"/>
	    <?php
	     }  else {
	    ?>
              <input type="submit" value="Submit" />
              <input type="button" value="Back" onclick="history.back(-1)" />
	     <?php
	      }
	      ?>

          </td>
      </tr>
    </table>
    
    </form>
    
        <!-- Created by: Apoorva Khandwekar
                  Email ID:apoorvakhandwekar39@gmail.com
        -->
  </body>
</html>

