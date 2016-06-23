<?php
function do_html_header() {
?>
    <table align="center">
        <tr>
         <td rowspan=3><img src="shopping-cart.jpg" alt="cart" height="100" width="100" align="left"><td>
         <td colspan=2><h1> All In One - Shopping Express</h1>
        </tr>
        <tr colspan=3><td></td><td colspan=2><hr/></td><td></td></tr>
        <tr>
          <td></td>
          <td>
           <a href="newpost.php" >New Post |</a>
           <a href="help.php" > Help </a>
          </td>
          <td style="text-align:float-right">
          <?php
            if (isset($_SESSION['username'])) {
              echo $_SESSION['username'];
          ?>
              <a href ="logout.php"> Logout</a>

          <?php
            } else {
          ?>
              <a href="login.php"> Login</a>
          <?php
            }
          ?>
         </td>
        </tr>
      </table>
      <hr/>
<?php
}
?>
