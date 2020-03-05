<?php
include __DIR__ . '/../../database.php';

if (empty($_POST['name'])) {
  $response = [
    "error" => 'No Name',
    "results" => []
  ];

  header('Content-Type: application/json');
  echo json_encode($response);
} else {
  $name = $_POST['name'];

  $response = [
    "error" => '',
    "results" => []
  ];

  $sql = "SELECT * FROM `tags` WHERE `name` LIKE '$name%'";
  $result = $conn->query($sql);

  if (!$result) {
    $response['error'] = 'Query error';
  } elseif ($result && $result->num_rows > 0) {
    $tags = [];
    while ($row = $result->fetch_assoc()) {
      $tags[] = $row;
    }

    $response['results'] = $tags;
  }

  $conn->close();

  header('Content-Type: application/json');
  echo json_encode($response);
}
