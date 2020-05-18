<html>
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</html>

<?php

   include("_includes/config.inc");
   include("_includes/dbconnect.inc");
   include("_includes/functions.inc");

      echo template("templates/partials/header.php");
      echo template("templates/partials/nav.php");

      // Build SQL statment select student info
      $sql = "select * from student student;";

      $result = mysqli_query($conn,$sql);

      // prepare page content
      $data['content'] .= "<div id='form'><form method='post' action='delete.php'><table class='content-table'>";
      $data['content'] .= "<tr><th colspan='11' align='center'> Students </th></tr>";
      $data['content'] .= "<tr><th>Student ID</th><th>Password</th><th>DOB</th><th>First Name</th><th>Last Name</th><th>House</th>
      <th>Town</th><th>County</th><th>Country</th><th>Post Code</th><th>Delete</th>
      </tr>";
      // Display the modules within the html table
      while($row = mysqli_fetch_array($result)) {
         $data['content'] .= "<tr><td> $row[studentid] </td><td>$row[password] </td>";
         $data['content'] .= "<td> $row[dob] </td>";
         $data['content'] .= "<td> $row[firstname] </td>";
         $data['content'] .= "<td> $row[lastname] </td>";
         $data['content'] .= "<td> $row[house] </td>";
         $data['content'] .= "<td> $row[town] </td>";
         $data['content'] .= "<td> $row[county] </td>";
         $data['content'] .= "<td> $row[country] </td>";
         $data['content'] .= "<td> $row[postcode] </td>";
         $data['content'] .= "<td><input type='checkbox' name='checkbox1[]' value='$row[studentid]'/> Delete</td></tr>";
      }
      $data['content'] .= "</table>";
      $data['content'] .= "<input type='submit' name='delete' class='w3-button w3-red' value='Delete Records'/></form></div>";

      // render the template
      echo template("templates/default.php", $data);

   echo template("templates/partials/footer.php");

?>
