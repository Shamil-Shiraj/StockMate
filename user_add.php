<?php 
   // Includes the connect file to establish database connection
   require_once('connect.php');
?>

<!DOCTYPE html>
<html>
   <head>
      <link rel="stylesheet" type="text/css" href="main.css">
      <title>Add User</title>
   </head>
   <body>
      <!--Main content of the page-->
      <h3>User Log In Page</h3>
      <table>
         <form action='' method ='POST'>
            <tr>
               <td>User Name</td>
               <td><input type = 'text' name='username' required></td>
            </tr>
            <tr>
               <td>Password</td>
               <td><input type = 'password' name='password' required></td>
            </tr>
            <tr>
               <td colspan = 3><input type='submit' value="Log In" name='login'></td>
            </tr>
         </form>
      </table>
   </body>
</html>

<?php

   if(isset($_POST['login']))
   {
      // SQL query to insert new user
      $sql = "INSERT INTO user_login (username,password) VALUES ('".$_POST['username']."','".$_POST['password']."')";
      
      // Execute the SQL query
      $result = mysqli_query($connection,$sql);

      if($result)
         echo"<script> alert('Registered Sucessfully') </script>";
      else
         echo"failed";
   }
?>