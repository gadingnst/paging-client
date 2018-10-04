<?php
$pagesPagination = null;
function pagination($tableName, $perPage, $key){
  $link = mysqli_connect('localhost', 'root', 'mysql', 'ElogDB');
  $page = isset($_GET[$key]) ? (int)$_GET[$key] : 1;
  $start = ($page > 1) ? ($page * $perPage) - $perPage : 0;
  $total = mysqli_num_rows(mysqli_query($link, "SELECT COUNT(*) FROM $tableName"));
  $queryLimit = "SELECT * FROM `$tableName` LIMIT $start, $perPage";
  $resultLimit = mysqli_query($link, $queryLimit);
  $GLOBALS['pagesPagination'] += ceil($total/$perPage);
  $data = mysqli_fetch_all($resultLimit, MYSQLI_ASSOC);
  if (!empty($data)) {
    return [
      'data' => $data,
      'page' => $GLOBALS['pagesPagination']
    ];
  }
  return false;
}
$data = pagination('logins', 3, $_GET['page']);
foreach ($data['data'] as $value) {
  echo $value['LoginID'].'<br />';
}

echo "<br><br>";

print_r($data['page']);
?>
