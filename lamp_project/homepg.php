<html>
  <head>

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
  
    <table cellspacing="10" cellpadding="10" align="center">
      <tr>
         <td>
           <form action="browse_posts.php" method="POST">
           <input type="text" name="search">
           <input type="submit" value="Search">
           <input type="reset">
           </form>
         </td>
      </tr>
    </table>

    <table border="5" cellpadding="10" cellspacing="10" align="center">
      <tr name="head">
        <th>For Sale</th>
        <th>Services</th>
        <th>Jobs</th>
        <th>Country</th>
        <th>City</th>
      </tr>
      <tr name="R1">
        <td><a href="browse_posts.php?sub_category=Books">Books</a></td>
        <td><a href="browse_posts.php?sub_category=Computer">Computer</a></td>
        <td><a href="browse_posts.php?sub_category=FULL_TIME">FULL_TIME</a></td>
        <td><a href="browse_posts.php?country=India">India</a></td>
        <td><a href="browse_posts.php?city=Mumbai">Mumbai</a></td>
      </tr>
      <tr name="R2">
        <td><a href="browse_posts.php?sub_category=Electronics">Electronics</a></td>
        <td><a href="browse_posts.php?sub_category=Finance">Finance</a></td>
        <td><a href="browse_posts.php?sub_category=PART_TIME">PART_TIME</a></td>
        <td><a href="browse_posts.php?country=USA">USA</a></td>
        <td><a href="browse_posts.php?city=Sacramento">Sacramento</a></td>
      </tr>
      <tr name="R3">
        <td><a href="browse_posts.php?sub_category=Household">Household</a></td>
        <td><a href="browse_posts.php?sub_category=Medical">Medical</a></td>
        <td><a href="browse_posts.php?sub_category=Volunteering">Volunteering</a></td>
        <td><a href="browse_posts.php?country=UK">UK</a></td>
        <td><a href="browse_posts.php?city=London">London</a></td>
      </tr>
      
      <tr>
       <td align="center" colspan="5">
          <a href="browse_posts.php">ALL_POSTS </a>
       </td>
      </tr>
    </table>
  <br/>
  <hr/>  
    <table align="center">
        <tr>
          <td>
           <a href ="terms_condition.php">Terms and conditions | </a>
           <a href ="aboutus.php">About us</a>
         </td>
        </tr>
      </table>  
  <!-- Created by:Apoorva Khandwekar
       Email:apoorvakhandwekar39@gmail.com
  -->
  </body>
</html>
