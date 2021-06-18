<?php

/* get slider values from interface */
$motor1=$_POST['motor1_angle'];
$motor2=$_POST['motor2_angle'];
$motor3=$_POST['motor3_angle'];
$motor4=$_POST['motor4_angle'];
$motor5=$_POST['motor5_angle'];
$motor6=$_POST['motor6_angle'];

/*convert information to integer*/
$m1=(int)"$motor1";
$m2=(int)"$motor2";
$m3=(int)"$motor3";
$m4=(int)"$motor4";
$m5=(int)"$motor5";
$m6=(int)"$motor6";


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

/* Enter Query to update status from ON'1' to OFF'0' */
$sqlStat = "UPDATE Motors SET Motor_Status='0' Where Motor_Status='1'";

/* Enter Query to update Motors Angles depend on slider */
$sqlM1 = "UPDATE Motors SET Angle='$m1' WHERE Motor_Number=1";
$sqlM2 = "UPDATE Motors SET Angle='$m2' WHERE Motor_Number=2";
$sqlM3 = "UPDATE Motors SET Angle='$m3' WHERE Motor_Number=3";
$sqlM4 = "UPDATE Motors SET Angle='$m4' WHERE Motor_Number=4";
$sqlM5 = "UPDATE Motors SET Angle='$m5' WHERE Motor_Number=5";
$sqlM6 = "UPDATE Motors SET Angle='$m6' WHERE Motor_Number=6";

echo"   ";

/* create array and enter all query for angles*/
$sqls = array($sqlM1,$sqlM2,$sqlM3,$sqlM4,$sqlM5,$sqlM6);

$status;

/* for loop to check each query and update angles value in table */
for($i=0;$i<6;$i++){
  if (mysqli_query($connection, $sqls[$i])) {
    $status = 1;
    mysqli_query($connection,$sqlStat);
  }  
}

/* if angles updated then print "Motors Angles updated", if not print erro */
if ($status==1) {
 echo "Motors Angles updated";
} else {
echo "Error updating Angles: " . mysqli_error($connection);
}

/* close connection  to SQL database server */
mysqli_close($connection);

?>
