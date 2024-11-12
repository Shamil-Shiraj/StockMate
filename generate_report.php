<?php
   // Includes the connect file to establish database connection 
   require_once('connect.php'); 
?>

<?php
   // Check if the form has been submitted
   if ($_SERVER['REQUEST_METHOD'] == 'POST') 
   {
      $dateGenerated = date('Y-m-d'); // Get the current date
      
      // SQL query to insert the report details into the database
      $sql = "INSERT INTO reports (date_generated) VALUES ('$dateGenerated')";
      
      if ($connection->query($sql) === TRUE) 
      {
         echo "Report generated successfully.";
         // Redirect back to reports page
         header("Location: admin_reports.php"); 
      } 
      else 
      {
         echo "Error: " . $sql . "<br>" . $conn->error;
      }
   }

$conn->close();
?>

