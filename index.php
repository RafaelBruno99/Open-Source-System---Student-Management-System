<html>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>
<?php

   include("_includes/config.inc");
   include("_includes/dbconnect.inc");
   include("_includes/functions.inc");

   echo template("templates/partials/header.php");

   if (isset($_GET['return'])) {
      $msg = "";
      if ($_GET['return'] == "fail") {$msg = "Login Failed. Please try again.";}
      $data['message'] = "<p>$msg</p>";
   }

   if (isset($_SESSION['id'])) {
      echo template("templates/partials/navedit.php");
   } else {
      echo template("templates/login.php", $data);
   }

   echo template("templates/partials/footer.php");

   // another test edit

?>
