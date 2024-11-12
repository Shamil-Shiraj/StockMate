<?php 
   // Includes the connect file to establish database connection
   require_once('connect.php'); 
   
   if(isset($_GET['user_id']))
   {
      // SQL query to select the desired user from the users table
      $sql1 = "SELECT * FROM users WHERE user_id =".$_GET['user_id'];
      
      // Execute the SQL query      
      $result = mysqli_query($connection,$sql1);

      // Fetch the single row of the desired item
      $row=mysqli_fetch_assoc($result);
      
      if($result)
      {
         //echo "Sucessful";
      }
      else
      {
         echo"failed";	
      }
   }
   
   if(isset($_POST['update_user']))
   {
      // SQL query to update the selected user
      $sql2 = "UPDATE users SET username = '".$_POST['username']."',password = '".$_POST['password']."' WHERE user_id ='".$_POST['user_id']."'";

      // Execute the SQL query
      $result2 = mysqli_query($connection,$sql2);
      
      // SLQ query to display the user with updated details
      $sql3 = "SELECT * FROM users WHERE user_id =".$_POST['user_id'];

      // Execute the SQL query
      $result3 = mysqli_query($connection,$sql3);

      $row=mysqli_fetch_assoc($result3);
      echo"<script> alert('Updated Sucessfully') </script>";
      echo "<script> window.location.href='user_manage.php';</script>";
   
   }
   
   if (!isset($_GET['user_id'])&&!isset($_POST['update_user']))
   {
      header("Location: user_manage.php");
   }
?>

<!DOCTYPE html>
<html>
   <head>
      <link rel="stylesheet" type="text/css" href="css/styles.css">
      <title>Edit User</title>
   </head>
   <body>
      <!--Main content of the page-->
      <div class="container">
         <h1>Edit User</h1>
         <table>
            <tr>
               <th>User ID</th>
               <th>User Name</th>
               <th>Password</th>
            </tr>
            <form action='user_edit.php' method ='POST'>
               <tr>
                  <td><input type="text" name="user_id" required value="<?php echo ($row['user_id']); ?>" readonly></td>
                  <td><input type="text" name="username" required value="<?php echo ($row['username']); ?>"></td>
                  <td><input type="text" name="password" required value="<?php echo ($row['password']); ?>"></td>
               </tr>
               <tr>
                  <td colspan =3><input type='submit' value="Update" name='update_user'></td>
               </tr>
            </form>
         </table>	
      </div>
   </body>
</html>
