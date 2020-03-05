<?php
include __DIR__ . '/../layouts/partials/header.php';
?>

<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <h2>Inserisci un nuovo tag</h2>
      <form action="" id="tags">
        <div class="form-group">
          <input class="form-control" id="name" type="text" value="">
        </div>
        <div class="form-group">
          <div id="name-error">
          </div>
        </div>
        <div class="form-group">
          <input class="btn btn-primary" disabled id="submit" type="submit" value="Salva">
        </div>

      </form>
    </div>
  </div>
</div>

<?php
include __DIR__ . '/../layouts/partials/footer.php';
?>