<?php
/* Enter Server Details and database name */
$servername = "localhost";
$username = "root";
$password = '';
$dbname = "SmartMethods";


/* create connection to access to SQL database server */
$connection = new mysqli($servername, $username,$password,$dbname);

/*if there is error return the error with "connection failed */
if ($connection->connect_error) {
  die("Connection failed: " . $connection->connect_error);
} 

/* Enter Query to update status from OFF'0' to ON'1' */
$sqlUpdate = "UPDATE Motors SET Motor_Status='1' Where Motor_Status='0' ";

/* Enter Query to Show all details in Motors table */
$sqlSelect = "SELECT * FROM Motors";



/* if query is true to sql server then don't do anything, if not the print meassage */
if ($connection->query($sqlUpdate) && $connection->query($sqlSelect) == TRUE) {

} else {
echo "Error in Running Motors: " . mysqli_error($connection);
}


$output=$connection->query($sqlSelect);

/* if output variable have more then one rows do this or print 'No Data found' */
if ($output->num_rows > 0) {
    $i=1;
    /* print data of each row */
    while($row = $output->fetch_assoc()) {
      echo "Angle of Motor $i: [<b>" .$row["Angle"]. "</b>] - ONN/OFF: [<b>" . $row["Motor_Status"]. "</b>]<br>";
      $i++;
    }
  } else {
    echo "No Data found";
  }

/* close connection  to SQL database server */
mysqli_close($connection);
?>
