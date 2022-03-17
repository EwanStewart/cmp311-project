<?php
session_start();
include("../controller/connection.php");
$conn = getDatabaseConnection();
$uid = $_SESSION['uID'];
$email = $_POST['email'];
$data = array();


$sql = "SELECT id, forename, email, created FROM cmp311user WHERE email = '".$email."'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$sid = $row['id'];
if($sid == $uid)
{
    $data['result'] = '';
    $data['status'] = 'err';
}
else{
    $sqlS = "SELECT fUserID, sUserID, status FROM friends WHERE (fUserID='".$uid."' OR sUserID='".$uid."') 
    AND (fUserID='".$sid."' OR sUserID='".$sid."')";
    $result = mysqli_query($conn, $sqlS);
    if($row1 = mysqli_fetch_array($result)){
        if($row1['status'] == 1){
            $data['result'] = '';
            $data['status'] = 'requested';
        }
        else if($row1['status'] == 2){
            $data['result'] = '';
            $data['status'] = 'friends';
        }        
        
    }else{
        $data['result'] = $row;
        $data['status'] = 'ok';
        $data['friendStatus'] = $row1;
    }
}
mysqli_close($conn);
echo json_encode($data);
?>