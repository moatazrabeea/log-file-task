<?php

$per_page = 10; //number presented fo ervery page
$file = $_POST["fileName"]; //getting file name we want to read
$current_page = $_POST["page_number"]; //what is the page number  we want to view

$lines = file($file);//file in to an array
$lines_array =[];

$numOfPages = ceil((count($lines)) / $per_page); // to avoid float numbers we use ceil to approximate to the higher number


  $current_page -= 1;  // we subtract 1 from the view we want becaue the file array start from zero



  $offset = ($current_page * $per_page); // the start number of lines
  $limit=(($current_page + 1) * $per_page) -1; // the end number of lines

while ($offset <= $limit){
    if (!isset($lines[$offset]) || $lines[$offset] == null){
       break;
    }
    else{
        $lines_array[$offset]= $lines[$offset];
    }

    $offset++;
}


    $result = array();
  if(count($lines_array)){
      $result = [
          'success' => true,
          'num_of_pages' =>$numOfPages,
          'lines_array' => $lines_array
      ];

  }

  else{
      $result = [
          'success' => false,
      ];
  }

echo json_encode($result);

