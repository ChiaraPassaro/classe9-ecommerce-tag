<?php
include __DIR__ . '/../layouts/partials/header.php';
?>

<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <h2>Inserisci un nuovo prodotto</h2>
      <!-- form -->
      <form action="" id="products">

        <!-- name -->
        <div class="form-group">
          <input class="form-control" id="name" type="text" value="" placeholder="Name">
        </div>
        <div class="form-group">
          <div id="name-error">
          </div>
        </div>
        <!-- /name -->

        <!-- description -->
        <div class="form-group">
          <textarea class="form-control" placeholder="Description" name="desciption" id="" cols="30" rows="10"></textarea>
        </div>
        <div class="form-group">
          <div id="description-error">
          </div>
        </div>
        <!-- /description -->

        <!-- price -->
        <div class="form-group">
          <input class="form-control" type="text" name="price" placeholder="Insert price in € es: 10.00">
        </div>
        <div class="form-group">
          <div id="description-error">
          </div>
        </div>
        <!-- /price -->

        <!-- tags -->
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

        <!-- input hidden for tags -->
        <input type="hidden" id="tags-hidden" name="tags">

        <div class="form-group">
          <div id="tags-error">
          </div>
        </div>

        <!-- /tags -->

        <!-- button -->
        <div class="form-group">
          <input class="btn btn-primary" disabled id="submit" type="submit" value="Salva">
        </div>
        <!-- button -->

      </form>
      <!-- form -->

    </div>
  </div>
</div>


<!-- handlebars template -->
<script id="tags-added-template" type="text/x-handlebars-template">
  <li class="btn btn-primary mr-1"><span class="tag">{{tag}}</span> <span class="delete">x</span></li>
</script>
<script id="tags-list-template" type="text/x-handlebars-template">
  <li class="list-group-item">{{tag}}</li>
</script>

<?php
include __DIR__ . '/../layouts/partials/footer.php';
?>