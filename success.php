<?php
$serverName = "LTGAZGCF5R34\\SQLEXPRESS";
$connectionOptions = [
    "Database" => "DLSU",
    "TrustServerCertificate" => true,
    "Authentication" => "ActiveDirectoryIntegrated"  // for domain auth
];

$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn===false) { ///true
    die(print_r(sqlsrv_errors(), true));
} else { //false
    echo "";
}

$sql = "SELECT STUDENTID FROM STUDENT WHERE STUDENTID=(SELECT IDENT_CURRENT('STUDENT'))";
    $result=sqlsrv_query($conn,$sql);

    $row=sqlsrv_fetch_array($result);
    $userid=$row['STUDENTID'];

$sql2="SELECT STUDENT_NAME FROM STUDENT WHERE STUDENTID=(SELECT IDENT_CURRENT('STUDENT'))";
     $result2=sqlsrv_query($conn,$sql2);
     $row2=sqlsrv_fetch_array($result2);
     $username=$row2['STUDENT_NAME'];

$sql3="SELECT TOP(1) FILEPATH FROM UPLOADS ORDER BY STUDENTID DESC";
    $result3=sqlsrv_query($conn,$sql3);
    $row3=sqlsrv_fetch_array($result3);
    $filepath=s$row3['FILEPATH'];

?>

<DOCTYPE html>

    <html>
    <head>
        <title>Registration Successful</title>
    </head>
    
    <body>
        <h1 align="center">Registration Successful</h1>
        <h2 align="center">Your USERID is: <?php echo $userid; ?> </h2><br>
    
        <form align="center">
            <label>Your Registered Name</label><br>
            <input type="text" value="<?php echo $username; ?>">
        
        </form>
        <img src="<?php echo $filepath; ?>" width="300" height="300">

        <button onClick="window.location.href='allrecords.php'">All Records</button>
     

    </body>
    </html>