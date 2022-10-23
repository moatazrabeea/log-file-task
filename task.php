<?php

$per_page = 10;
$file = $_POST["fileName"];
$lines = file($file);//file in to an array
$lines_array =[];



  $current_page = $_POST["page_number"];

  if ($current_page == -1){
      $offset = (count($lines)) - $per_page;
      $limit = count($lines);

  }
 else{
  $offset = ($current_page * $per_page);
  $limit=(($current_page + 1) * $per_page);
 }



while ($offset <= $limit){
    if ($lines[$offset] == null){
       break;
    }
    else{
        $lines_array[$offset]= $lines[$offset];
    }

    $offset++;
}

  if(count($lines_array)){
    echo json_encode($lines_array);
  }

  else{
      echo false;
  }



  // if(isset($_SESSION['current_line']) && $_SESSION['current_line'] < $total_lines){

  //   $lines = shell_exec('tail -n' . ($total_lines - $_SESSION['current_line']) . ' ' . escapeshellarg($file));

  // } else if(!isset($_SESSION['current_line'])){

  //   $lines = shell_exec('tail -n100 ' . escapeshellarg($file));

  // }

  // $_SESSION['current_line'] = $total_lines;

  // $lines_array = array_filter(preg_split('#[\r\n]+#', trim($lines)));

  // if(count($lines_array)){
  //   echo json_encode($lines_array);
  // }