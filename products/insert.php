<?php
include __DIR__ . '/../layouts/partials/header.php';
?>

<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <h2>Inserisci un nuovo prodotto</h2>
      <form action="" id="products">
        <div class="form-group">
          <input class="form-control" id="name" type="text" value="" placeholder="Name">
        </div>
        <div class="form-group">
          <div id="name-error">
          </div>
        </div>

        <div class="form-group">
          <textarea class="form-control" placeholder="Description" name="desciption" id="" cols="30" rows="10"></textarea>
        </div>
        <div class="form-group">
          <div id="description-error">
          </div>
        </div>

        <div class="form-group">
          <input class="form-control" id="tags" type="text" value="" placeholder="Tags">
        </div>
        <div class="form-group">
          <ul class="list-inline" id="tags-added">
            <li></li>
          </ul>
        </div>
        <div class="form-group">
          <ul id="tag-list" class="list-group">

          </ul>
        </div>


        <input type="hidden" id="tags-hidden" name="tags">

        <div class="form-group">
          <div id="tags-error">
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