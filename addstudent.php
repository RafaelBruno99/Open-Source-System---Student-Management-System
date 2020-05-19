<html>
  <link rel="stylesheet" type="text/css" href="css/main2.css">
  <link rel="stylesheet" type="text/css" href="css/main.css">
</html>
<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");


   echo template("templates/partials/header.php");
   echo template("templates/partials/nav.php");

   // if the form has been submitted
   if (isset($_POST['submit'])) {

      $studentid = $conn -> real_escape_string($_POST['txtid']);
      $password = $conn -> real_escape_string($_POST['txtpassword']);
      $dob = $conn -> real_escape_string($_POST['txtbod']);
      $firstname = $conn -> real_escape_string($_POST['txtfirstname']);
      $lastname = $conn -> real_escape_string($_POST['txtlastname']);
      $house = $conn -> real_escape_string($_POST['txthouse']);
      $town = $conn -> real_escape_string($_POST['txttown']);
      $county = $conn -> real_escape_string($_POST['txtcounty']);
      $country = $conn -> real_escape_string($_POST['txtcountry']);
      $postcode = $conn -> real_escape_string($_POST['txtpostcode']);

      $hashed = hash('sha512', $password);


      // build an sql statment to update the student details
      $sql = "insert into student (studentid, password, dob , firstname, lastname, house, town , county, country, postcode) values ('$studentid', '$hashed','$dob', '$firstname', '$lastname', '$house', '$town', '$county', '$country', '$postcode');";
      $result = mysqli_query($conn,$sql);

      $data['content'] = "<p>A new student as been added</p>";
      $url1 = $_SERVER["REQUEST_URI"];
      header("Refresh:2;URL=$url1");

   }
   else {

      // using <<<EOD notation to allow building of a multi-line string
      // see http://stackoverflow.com/questions/6924193/what-is-the-use-of-eod-in-php for info
      // also http://stackoverflow.com/questions/8280360/formatting-an-array-value-inside-a-heredoc
      $data['content'] = <<<EOD
      </br>
   <div class="form-style-6">
     <h2>Add a student: </h2>

     <form class="contact-form" name="frmdetails" action="" method="post">
       <input name="txtid" type="text" placeholder="Student ID" /><br/>
       <input name="txtpassword" type="password" placeholder="Password" /><br/>
       <input name="txtbod" type="date" placeholder="Date of Birth"/><br/>
       <input name="txtfirstname" type="text" placeholder="First Name"/><br/>
       <input name="txtlastname" type="text" placeholder="Last Name"/><br/>
       <input name="txthouse" type="text" placeholder="Address"/><br/>
       <input name="txttown" type="text" placeholder="Town"/><br/>
       <input name="txtcounty" type="text" placeholder="County"/><br/>
       <input name="txtcountry" type="text" placeholder="Country"/><br/>
       <input name="txtpostcode" type="text" placeholder="Post Code"/><br/>
       <input type="submit" value="Save" name="submit"/>
     </form>
   </div>

EOD;

   }

   // render the template
   echo template("templates/default.php", $data);

echo template("templates/partials/footer.php");

?>
