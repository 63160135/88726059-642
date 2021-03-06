<?php
session_start();

if (!isset($_SESSION['loggined'])){
    header('Location: login.php');
}
require_once("dbconfig.php");
if ($_POST){
    $doc_num = $_POST['doc_num'];
    $doc_title = $_POST['doc_title'];
    $doc_start_date = $_POST['doc_start_date'];
    $doc_to_date = $_POST['doc_to_date'];
    $doc_status = $_POST['doc_status'];
    $doc_file_name = $_FILES["doc_file_name"]["name"];

    $sql ="INSERT  
            INTO documents (doc_num, doc_title, doc_start_date, doc_to_date, doc_status, doc_file_name) 
            VALUES (?, ?, ? , ?, ?, ?);";       
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssssss",$doc_num,$doc_title,$doc_start_date,$doc_to_date,$doc_status,$doc_file_name);
    $stmt->execute();

    //uploadpart
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["doc_file_name"]["name"]);
    $fileType="pdf";
    $realname="a.pdf";
    if (move_uploaded_file($_FILES["doc_file_name"]["tmp_name"], $target_file)) {
      //echo "The file ". htmlspecialchars( basename( $_FILES["doc_file_name"]["name"])). " has been uploaded.";
    } else {
      //echo "Sorry, there was an error uploading your file.";
    }
    //

 
    header("location: documents.php");
}
else{
    echo "<div align = center><h1><span class='glyphicon glyphicon-globe'> Welcome ".$_SESSION['stf_name'] . "</span></h1></div>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>NewDocuments</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body style = "background-color:#FFF0F5">
    <div class="container">
        <h1>Add Documents</h1>
        <form action="newactor.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="doc_num">????????????????????????????????????</label>
                <input type="text" class="form-control" name="doc_num" id="doc_num" style = "background-color:#FFFFFF">
            </div>
            <div class="form-group">
                <label for="doc_title">????????????</label>
                <input type="text" class="form-control" name="doc_title" id="doc_title" style = "background-color:#FFFFFF">
            </div>
            <div class="form-group">
                <label for="doc_start_date">?????????????????????????????????</label>
                <input type="date" class="form-control" name="doc_start_date" id="doc_start_date" style = "background-color:#FFFFFF">
            </div>
            <div class="form-group">
                <label for="doc_to_date">???????????????????????????????????????</label>
                <input type="date" class="form-control" name="doc_to_date" id="doc_to_date" style = "background-color:#FFFFFF">
            </div>
            <div class="form-group">
                <label for="doc_status">???????????????</label>
                <input type="radio"  name="doc_status" id="doc_status" value="Active"> Active
                <input type="radio"  name="doc_status" id="doc_status" value="Expire"> Expire
            </div>
            <div class="form-group">
                <label for="doc_file_name">????????????????????????</label>
                <input type="file" class="form-control" name="doc_file_name" id="doc_file_name"  style = "background-color:#FFFFFF">
            </div>
            <br>
            
            <button type="button" class="btn btn-warning" onclick="history.back();" style = "background-color:#FF99CC">Back</button>
            <button type="submit" class="btn btn-success" style = "background-color:#6699FF">Upload</button>
        </form>
</body>

</html>