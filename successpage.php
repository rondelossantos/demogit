<?php //this is a comment
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
    echo "Connection Success<br />";
}

$sql="SELECT TOP(1) STUDENTID FROM STUDENT ORDER BY STUDENTID DESC;";
$answer=sqlsrv_query($conn,$sql);

$result=sqlsrv_fetch_array($answer);
$user=$result['STUDENTID'];

$sqlanother="SELECT TOP(1) STUDENT_NAME 
FROM STUDENT ORDER BY STUDENTID DESC;";

$answer2=sqlsrv_query($conn,$sqlanother);

$studentadd=sqlsrv_fetch_array($answer2);
$studentpangalanwhoyou=$studentadd['STUDENT_NAME'];




?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration Success<title>
</head>

<body>
    <h1 align="center">Registration Successful</h1?>
    <h3 align="center">Your USERID is:<?php echo $user; ?> <h3>

    <form align="center">
    <label> Your Registered Name</label>
    <input type="text" value="<?php echo $studentpangalanwhoyou; ?>">



<body>


</html>