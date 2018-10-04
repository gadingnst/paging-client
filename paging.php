<?php
  /**
   *
   */
  class Pagination{

    function __construct(){
      // code...
    }

    function paging($table='', $perPage, $page, $fieldId){
      $link = mysqli_connect('localhost', 'root', 'mysql', 'ElogDB');
      $total = mysqli_num_rows(mysqli_query($link, "SELECT COUNT({$fieldId}) FROM $table"));
      $actualPage = ($page * $perPage) - $perPage;
      $qtbl = "SELECT * FROM $table LIMIT $actualPage, $perPage";
      $qtbl = mysqli_query($link, $qtbl);
      $data = mysqli_fetch_all($qtbl, MYSQLI_ASSOC);
    }

    function isInclude($array, $searchVal){
      $b = gettype(array_search($searchVal, $array));
      if ($b != 'boolean') return true;
      return false;
    }

  }

?>
