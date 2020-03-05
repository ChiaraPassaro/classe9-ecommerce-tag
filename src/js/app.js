const $ = require('jquery');

$(document).ready(function(){
  //disabilitiamo invio
  $('#tags #name').keypress(function(event){
    if (event.which == 13) {
      event.preventDefault();
    }
  });

  //controlliamo se abbiamo inserito qualcosa per attivare il save
  $('#tags #name').keyup(function(){

    //nascondiamo errori
    $('#name-error').removeClass('alert alert-danger');
    $('#name-error').html('');
    
    var inputText = $(this).val();

    if (inputText.trim().length > 0) {
      $('#tags #submit').removeAttr('disabled');
    } else {
      $('#tags #submit').attr('disabled', 'disabled');
    }
  });

  $('#tags #submit').click(function(){
    event.preventDefault();
    var inputText = $(this).parents('#tags').find('#name').val();
    insertTag(inputText);
  });


  $('#products #tags').keyup(function () {
    $('#tag-list').html('');

    //nascondiamo errori
    $('#name-error').removeClass('alert alert-danger');
    $('#name-error').html('');

    var inputText = $(this).val();

    if (inputText.trim().length > 0) {
      searchTag(inputText);
    } 
  });

  $(document).on('click','#tag-list li', function(){
    var tag = $(this).text();
    $('#tags-added').append('<li class="btn btn-primary mr-1"><span class="tag">' + tag + '</span> <span class="delete">x</span></li>');
    var hidden = $('#tags-hidden').val();
    if(hidden.length == 0) {
      $('#tags-hidden').val(tag);
    } 
    else {
      $('#tags-hidden').val(hidden + ',' + tag);
    }
    
    $(this).remove();
  });

  $(document).on('click','#tags-added li .delete', function(){
    $(this).parent().remove();
    var tag = $(this).prev().text();
    var hidden = $('#tags-hidden').val();
    var newValue = hidden.replace(',' + tag, '');
    $('#tags-hidden').val(newValue);
  });

});

function searchTag(string) {
  $.ajax({
    url: 'http://localhost:8888/ecommerce/api/tags/search.php',
    method: 'POST',
    data: {
      'name': string
    },
    success: function (data) {
      if (data.error.length > 0) {
        $('#tags-error').addClass('alert alert-danger');
        $('#tags-error').html(data.error);
      } else {
        for (let i = 0; i < data.results.length; i++) {          
          var tag = data.results[i];
          
          var find = false;

          $('#tags-added li').each(function(){
            if($(this).find('.tag').text() == tag.name){
              find = true;
            }
          });
          
          if(!find) {
            $('#tag-list').append('<li class="list-group-item">' + tag.name + '</li>');
          }
        }
      }
    },
    error: function () {
      alert('error');
    }
  });
}

function insertTag(name){
  
  $.ajax({
    url: 'http://localhost:8888/ecommerce/api/tags/insert.php',
    method: 'POST',
    data: {
      'name': name
    },
    success: function(data){
      if(data.error.length > 0) {
        $('#name-error').addClass('alert alert-danger');
        $('#name-error').html(data.error);
      }
      else {
        alert('Tag inserito: ' + data.result.name);
        $('#tags #name').val('');
      }
    },
    error: function () {
      alert('error');
    }
  });
}