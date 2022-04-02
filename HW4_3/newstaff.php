<?php
session_start();
if(!isset($_SESSION['loggined'])){
    header('Location: login.php');
}
require_once("dbconfig.php");

// ตรวจสอบว่ามีการ post มาจากฟอร์ม ถึงจะเพิ่ม
if ($_POST){
    $stf_code = $_POST['stf_code'];
    $stf_name = $_POST['stf_name'];
    

    // insert a record by prepare and bind
    // The argument may be one of four types:
    //  i - integer
    //  d - double
    //  s - string
    //  b - BLOB

    // ในส่วนของ INTO ให้กำหนดให้ตรงกับชื่อคอลัมน์ในตาราง actor
    // ต้องแน่ใจว่าคำสั่ง INSERT ทำงานใด้ถูกต้อง - ให้ทดสอบก่อน
    $sql = "INSERT 
            INTO staff ( stf_code,stf_name) 
            VALUES (?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ss", $stf_code, $stf_name);
    $stmt->execute();

    
    header("location: staff.php");
}
else{
    echo "<div align = center><h1> Welcome ".$_SESSION['stf_name'] . "</h1></div>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>php db demo</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body style = "background-color:#FFF0F5">
    <div class="container">
        <h1>Add Employee</h1>
        <form action="newstaff.php" method="post">
            <div class="form-group">
                <label for="stf_code">รหัสพนักงาน</label>
                <input type="text" class="form-control" name="stf_code" id="stf_code">
            </div>
            <div class="form-group">
                <label for="stf_name">ชื่อพนักงาน</label>
                <input type="text" class="form-control" name="stf_name" id="stf_name">
            </div>
            <button type="button" class="btn btn-warning" onclick="history.back();" style = "background-color:#FF99CC">Back</button>
            <button type="submit" class="btn btn-success"style = "background-color:#6699FF">Upload</button>
        </form>
</body>

</html>