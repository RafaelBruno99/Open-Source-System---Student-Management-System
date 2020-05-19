<?php

  include("_includes/config.inc");
  include("_includes/dbconnect.inc");
  include("_includes/functions.inc");

  //if checkbox is ticked
  if (isset($_POST['delete'])) {
    $checkbox = $_POST['checkbox1'];
    foreach ($checkbox as $id) {
      mysqli_query($conn, "Delete from student where studentid =".$id);
    }
    echo "<h2 textalign='center'>Delete was complete</h2>";
    header('refresh:2; url=students.php');
  }
  mysqli_close($conn);


 ?>
