<?php
  include __DIR__ . '/../../database.php';
 
  if(empty($_POST['name'])) {
    $response = [
      "error" => 'No Name',
      "result" => []
    ];

    header('Content-Type: application/json');
    echo json_encode($response);
  } 
  else {
    $name = $_POST['name'];

    $stmt = $conn->prepare("INSERT INTO `tags` (name) VALUES (?)");
    $stmt->bind_param("s", $name);

    $stmt->execute();
    if (!empty($stmt->error)) {
      $response = [
        "error" => $stmt->error,
        "result" => []
      ];

      header('Content-Type: application/json');
      echo json_encode($response);
    } else {
      $response = [
        "error" => '',
        "result" => [
          "id" => $stmt->insert_id,
          "name" => $name
        ]
      ];

      header('Content-Type: application/json');
      echo json_encode($response);
    }
  }


