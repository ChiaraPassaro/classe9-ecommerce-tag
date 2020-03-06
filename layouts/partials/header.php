<?php include __DIR__ . '/../../env.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?php echo $basePath ?>dist/app.css">
  <title>Document</title>
</head>

<body>
  <header>
    <nav class="navbar navbar-dark bg-dark navbar-expand-lg">
      <a class="navbar-brand" href="">Boolcommerce</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item"><a class="nav-link" href="<?php echo $basePath ?>tags/insert.php">Add Tag</a></li>
          
          <li class="nav-item"><a class="nav-link" href="<?php echo $basePath ?>products/insert.php">Add Product</a></li>
        </ul>
      </div>
    </nav>
  </header>

  <main class="mt-5">