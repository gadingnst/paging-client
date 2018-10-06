<?php
  /**
   *
   */
  class Pagination{


    static function paging($table='', $perPage, $page, $fieldId , $pageElCount){
      $link = mysqli_connect('paging-db', 'root', 'root123', 'sample_db');
      $total = mysqli_query($link, "SELECT COUNT({$fieldId}) FROM $table");
      $total = $total->fetch_row()[0];
    
      

      $actualPage = ($page * $perPage) - $perPage;
      $qtbl = "SELECT * FROM $table LIMIT $actualPage, $perPage";
      $qQuery = mysqli_query($link, $qtbl);
      $data = mysqli_fetch_all($qQuery, MYSQLI_ASSOC);

      while ($page % $pageElCount != 0) {
        $page++;
      }
      $startPageEl = $page - ($pageElCount - 1);
      $arrPageEl =  [];
      $isLast = false;

      for($i = 0; $i<$pageElCount; $i++){
        $a = $startPageEl * $perPage;
        $b = $a - ($perPage - 1);

        
        $newArr = range($b , $a);
        $rIsInclude = Pagination::isInclude($newArr , $total);

        if($rIsInclude){
          array_push($arrPageEl , $startPageEl);
          $isLast= true;
          break;
        }
        array_push($arrPageEl , $startPageEl);

        $startPageEl++;
      }

      if(count($data) <= 0) {
        $arrPageEl = array();
        $isLast = false;
      }

      return [
        'data'=>$data,
        'pageEl'=>$arrPageEl,
        'isLast'=>$isLast
      ];
    }

    private static function isInclude($array, $searchVal){
      $b = gettype(array_search($searchVal, $array));
      if ($b != 'boolean') return true;
      return false;
    }

  }

?>
