
$(document).ready(function() {
  $('#login-btn').click(function(event){
    event.preventDefault()
    $.ajax({
      type: 'POST',
      enctype: 'application/json',
      url: '/api/login.php',
      data: JSON.stringify({
        'nick': $('#nick')[0].value,
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
