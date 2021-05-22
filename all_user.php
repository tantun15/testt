<?php
    require_once "connect.php";

    $limit = 10;
    $page = 0;
    if (isset($_POST['page'])) { 
        $page  = $_POST['page']; 
    } else { 
        $page=1; 
    };  
    $startFrom = ($page-1) * $limit;

    $sql = "SELECT invoice_number, name, address, telephone, email
        FROM invoice ORDER BY invoice_id ASC LIMIT $startFrom, $limit";  
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    exit(json_encode($data));
   
    ## Total number of records without filtering
    $stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM invoice WHERE 1 ");
    $stmt->execute();
    $records = $stmt->fetch();
    $totalRecords = $records['allcount'];
?>  