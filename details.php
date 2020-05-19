<html>
  <link rel="stylesheet" type="text/css" href="css/main2.css">
  <link rel="stylesheet" type="text/css" href="css/main.css">
</html>
<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");


// check logged in
if (isset($_SESSION['id'])) {

   echo template("templates/partials/header.php");
   echo template("templates/partials/nav.php");

   // if the form has been submitted
   if (isset($_POST['submit'])) {

     $firstname = $conn -> real_escape_string($_POST['txtfirstname']);
     $lastname = $conn -> real_escape_string($_POST['txtlastname']);
     $house = $conn -> real_escape_string($_POST['txthouse']);
     $town = $conn -> real_escape_string($_POST['txttown']);
     $county = $conn -> real_escape_string($_POST['txtcounty']);
     $country = $conn -> real_escape_string($_POST['txtcountry']);
     $postcode = $conn -> real_escape_string($_POST['txtpostcode']);


      // build an sql statment to update the student details
      $sql = "update student set firstname ='" . $irstname . "',";
      $sql .= "lastname ='" . $lastname  . "',";
      $sql .= "house ='" . $house  . "',";
      $sql .= "town ='" . $town . "',";
      $sql .= "county ='" . $county  . "',";
      $sql .= "country ='" . $country  . "',";
      $sql .= "postcode ='" . $postcode  . "' ";
      $sql .= "where studentid = '" . $_SESSION['id'] . "';";
      $result = mysqli_query($conn,$sql);

      $data['content'] = "<p>Your details have been updated</p>";
      $url1 = $_SERVER["REQUEST_URI"];
      header("Refresh:2;URL=$url1");

   }
   else {
      // Build a SQL statment to return the student record with the id that
      // matches that of the session variable.
      $sql = "select * from student where studentid='". $_SESSION['id'] . "';";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result);

      // using <<<EOD notation to allow building of a multi-line string
      // see http://stackoverflow.com/questions/6924193/what-is-the-use-of-eod-in-php for info
      // also http://stackoverflow.com/questions/8280360/formatting-an-array-value-inside-a-heredoc
      $data['content'] = <<<EOD

      </br>
   <div class="form-style-6">
   <h2>My Details</h2>
   <form name="frmdetails" action="" method="post">
   First Name :
   <input name="txtfirstname" type="text" value="{$row['firstname']}" /><br/>
   Surname :
   <input name="txtlastname" type="text"  value="{$row['lastname']}" /><br/>
   Number and Street :
   <input name="txthouse" type="text"  value="{$row['house']}" /><br/>
   Town :
   <input name="txttown" type="text"  value="{$row['town']}" /><br/>
   County :
   <input name="txtcounty" type="text"  value="{$row['county']}" /><br/>
   Country :
   <input name="txtcountry" type="text"  value="{$row['country']}" /><br/>
   Postcode :
   <input name="txtpostcode" type="text"  value="{$row['postcode']}" /><br/>
   <input type="submit" value="Save" name="submit"/>
   </form>
   </div>

EOD;

   }

   // render the template
   echo template("templates/default.php", $data);

} else {
   header("Location: index.php");
}

echo template("templates/partials/footer.php");

?>
