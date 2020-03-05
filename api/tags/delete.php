<?php
include __DIR__ . '/../../database.php';

if (empty($_POST['id'])) {
  $response = [
    "error" => 'ID non inserito',
    "results" => []
  ];

  header('Content-Type: application/json');
  echo json_encode($response);
} else {

  $tagId = $_POST['id'];
  $sql = "SELECT * FROM `tags` WHERE `id` = $tagId";
  
  $result = $conn->query($sql);

  $response = [
    "error" => '',
    "results" => []
  ];

  if ($result && $result->num_rows == 0) {
    $response['error'] = 'Id non esistente';
    
    header('Content-Type: application/json');
    echo json_encode($response);
  } else {

    $sql = "DELETE FROM `tags` WHERE `id` = $tagId";

    $result = $conn->query($sql);

    if (!$result) {
      $response['error'] = 'Query error';
    } 
    else {
      $response['results'] = [
        "id" => $tagId
      ];
    }

    $conn->close();

    header('Content-Type: application/json');
    echo json_encode($response);
  }
}
