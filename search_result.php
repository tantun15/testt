<?php
  require_once "connect.php" ;
    
    $data = json_decode($_POST["json"], true);
    $keyword = $data["keyword"];

if(!empty($keyword)){
    $sql = "SELECT * FROM invoice WHERE invoice_number LIKE '%$keyword%' OR name LIKE '%$keyword%' 
    OR address LIKE '%$keyword%' OR telephone LIKE '%$keyword%' OR email LIKE '%$keyword%'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    exit(json_encode($data));

}else{
    $sql = "SELECT * FROM invoice LIMIT 10 ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    exit(json_encode($data));
}

    ## Total number of records with filtering
    // $stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM invoice WHERE invoice_number LIKE '%$keyword%' OR name LIKE '%$keyword%' 
    // OR address LIKE '%$keyword%' OR telephone LIKE '%$keyword%' OR email LIKE '%$keyword%' ");
    // $stmt->execute();
    // $records = $stmt->fetch();
    // $totalRecordwithFilter = $records['allcount'];
    // print_r($totalRecordwithFilter);
?> 
