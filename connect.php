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



$studentname=$_POST['studentname'];
$email=$_POST['email'];
$yearlevel=$_POST['year'];
$mobile=$_POST['mobile'];


$sql="INSERT INTO STUDENT (STUDENT_NAME,EMAIL,YEAR_LEVEL,MOBILE_NUMBER) VALUES ('$studentname','$email','$yearlevel','$mobile')";
$result=sqlsrv_query($conn,$sql);


//upload file


//declare destination
$destination="uploads/";

//get the file details
$filename=basename($_FILES['idcard']['name']);

//target path
$targetfilepath=$destination.$filename;

//allowed files
$allowfile=array('jpg','png','jpeg','pdf');

//checking the file type
$filetype=pathinfo($targetfilepath, PATHINFO_EXTENSION);

//if the file is correct
if(in_array(strtolower($filetype),$allowfile)){
    $finalfolder=move_uploaded_file($_FILES['idcard']['tmp_name'],$targetfilepath);
    if($finalfolder){
        //get the studentid primary key
        $sql3="SELECT MAX(STUDENTID) AS STUDENTID FROM STUDENT";
        $result2=sqlsrv_query($conn,$sql3);
        $studentarray=sqlsrv_fetch_array($result2);
        $studentid=$studentarray['STUDENTID'];


        $sql2="INSERT INTO UPLOADS (FILENAME, FILEPATH, DATE_UPLOADED, STUDENTID) VALUES ('$filename','$targetfilepath', GETDATE(), '$studentid')";
        $answer=sqlsrv_query($conn,$sql2);
        
        if($answer){
            header("Location:success.php");
            exit();

        }else{
             die(print_r(sqlsrv_errors(), true));
        }
    }
}

