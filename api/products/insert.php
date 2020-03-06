<?php
include __DIR__ . '/../../database.php';

if (empty($_POST['name'])) {
  $response = [
    "error" => 'No Name',
    "result" => []
  ];

  header('Content-Type: application/json');
  echo json_encode($response);
} elseif (empty($_POST['description'])) {
  $response = [
    "error" => 'No Description',
    "result" => []
  ];

  header('Content-Type: application/json');
  echo json_encode($response);
} elseif (empty($_POST['price'])) {
  $response = [
    "error" => 'No Price',
    "result" => []
  ];

  header('Content-Type: application/json');
  echo json_encode($response);
} 
else {
  $name = $_POST['name'];
  $description = $_POST['description'];
  $price = $_POST['price'];
  $tags = $_POST['tags'];

  $stmt = $conn->prepare("INSERT INTO `products` (name, description, price) VALUES (?,?,?)");
  $stmt->bind_param("ssd", $name, $description, $price);

  $stmt->execute();

  if (!empty($stmt->error)) {
    $response = [
      "error" => $stmt->error,
      "result" => []
    ];

    header('Content-Type: application/json');
    echo json_encode($response);
  } else {
    $idProduct = $stmt->insert_id;

    if(!empty($tags)){
      
      $listTags = explode(',', $tags) ;
      $tagsId = [];
      
      foreach($listTags as $thisTag) {
        $sql = "SELECT * FROM `tags` WHERE `name`= '$thisTag'";
        $result = $conn->query($sql);

        if($result) {
          $row = $result->fetch_assoc();

          $stmt = $conn->prepare("INSERT INTO `products_tags` (tag_id, product_id) VALUES (?,?)");
          $stmt->bind_param("ii",  $row['id'], $idProduct);

          $stmt->execute();
          if (!empty($stmt->error)) {
            $response = [
              "error" => $stmt->error,
              "result" => []
            ];

            header('Content-Type: application/json');
            echo json_encode($response); die();
          } else {

            $tagsId[] = [
              'id' => $stmt->insert_id,
              'name' => $thisTag,
            ];
          }
        }
       
      }
    }

   
    $response = [
      "error" => '',
      "result" => [
        "id" => $idProduct,
        "name" => $name,
        "description" => $description,
        "tags" => $tagsId,
      ]
    ];

    header('Content-Type: application/json');
    echo json_encode($response);
  }
}
