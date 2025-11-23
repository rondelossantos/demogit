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

$sql="SELECT * FROM STUDENT";
$result=sqlsrv_query($conn,$sql);

$sql2="SELECT COUNT(STUDENTID) AS COUNT FROM STUDENT";
$result2=sqlsrv_query($conn,$sql2);
$resultarray=sqlsrv_fetch_array($result2);
$count=$resultarray['COUNT'];

?>

<!DOCTYPE html>
<html>
    <head>
        <title>All Students</title>
    </head>

        <body>
            <h1>Student List</h1>
            
            <table>
                <thead>
                    <tr>
                        <th>STUDENT ID</th>
                        <th>STUDENT NAME</th>
                        <th>STUDENT EMAIL</th>
                        <th>YEAR LEVEL</th>
                        <th>CONTACT NUMBER</th>
                    </tr>
                </thead>
                <?php
                    while($rows=sqlsrv_fetch_array($result);){
                            $data1=$rows['STUDENTID'];
                            $data2=$rows['STUDENT_NAME'];
                            $data3=$rows['EMAIL'];
                            $data4=$rows['YEAR_LEVEL'];
                            $data5=$rows['MOBILE_NUMBER'];
                        echo '<tr>
                                <td>'.$data1.'</td>
                                <td>'.$data2.'</td>
                                <td>'.$data3.'</td>
                                <td>'.$data4.'</td>
                                <td>'.$data5.'</td>
                            </tr>';



                    }
            
                ?>
                <h4>The total number of records: <?php echo $count; ?></h4>
            </table>


        </body>










</html>