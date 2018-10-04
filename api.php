<?php   
require_once './paging.php';
$pageParam = $_GET['page'];
$result = Pagination::paging('emp',4,$pageParam,'id',3);

echo json_encode($result);

