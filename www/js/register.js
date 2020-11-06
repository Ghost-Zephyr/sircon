
$(document).ready(function() {
  $('#color').on('input', function(){
    let hex = '#'+$('#color')[0].value.replace('#','') // A bit ugly, but lets user omit or have the inital # in input
    $('#color-box').css('background-color', hex)
  })
  $('#register-btn').click(function(event){
    event.preventDefault()
    $.ajax({
      type: 'POST',
      enctype: 'application/json',
      url: '/api/register.php',
      data: JSON.stringify({
        'nick': $('#nick')[0].value,
        'color': '#'+$('#color')[0].value,
        'pass': $('#pass')[0].value
      }),
      success: function() {
        location.replace('/')
      },
      error: function(data) {
        $('#error').html('<p>'+JSON.parse(data.responseText).error+'</p>')
      }
    })
  })
})
