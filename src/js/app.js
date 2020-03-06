const $ = require('jquery');
const Handlebars = require('handlebars');

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
    var source = $("#tags-added-template").html();
    var template = Handlebars.compile(source);
    var tag = $(this).text();

    var context = {
      tag: tag
    }

    var html = template(context);
    $('#tags-added').append(html);

    var hidden = $('#tags-hidden').val();
    
    $('#tags-hidden').val(hidden + ',' + tag);
    
    
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
        var source = $("#tags-list-template").html();
        var template = Handlebars.compile(source);
        
        for (let i = 0; i < data.results.length; i++) {          
          var tag = data.results[i];
          
          var find = false;

          $('#tags-added li').each(function(){
            if($(this).find('.tag').text() == tag.name){
              find = true;
            }
          });
          
          if(!find) {
            var context = {
              tag: tag.name
            }

            var html = template(context);
            $('#tag-list').append(html);
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