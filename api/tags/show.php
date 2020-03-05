<?php
  include __DIR__ . '/../../database.php';

  if (empty($_POST['id'])) {
    $response = [
      "error" => 'No id',
      "result" => []
    ];

    header('Content-Type: application/json');
    echo json_encode($response);
  } else {
    $tagId = $_POST['id'];

    $sql = "SELECT * FROM `tags` WHERE `id`= $tagId";
    $result = $conn->query($sql);

    $response = [
      "error" => '',
      "results" => []
    ];

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