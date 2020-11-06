
let xytobox = (x,y) => {
  return {'x': Math.floor((x+10)/100)-4, 'y': Math.floor((y+20)/100)-1}
}

let drawGrid = (ctx) => {
  ctx.fillStyle = 'black'
  let boxsize = 100
  let width = 1000
  let height = 600
  for (h = 1; h < 10; h++) {
    ctx.moveTo(h*boxsize,0)
    ctx.lineTo(h*boxsize,height)
  }
  for (w = 1; w < 6; w++) {
    ctx.moveTo(0,w*boxsize)
    ctx.lineTo(width,w*boxsize)
  }
  ctx.stroke()
}

let drawBox = (box) => {
  ctx.fillStyle = box.color.replace('%23', '#')
  let x = ((box.x-1)*100)+2
  let y = ((box.y-1)*100)+2
  ctx.fillRect(x, y, 96, 96)
}

let drawBoxes = (boxes) => {
  for (i = 0; i < boxes.length; i++) {
    drawBox(boxes[i])
  }
}

let conn = new WebSocket('ws://localhost:6969')
conn.onmessage = function(e) {
  let box = JSON.parse(e.data)
  drawBox(box)
}

$(document).ready(function() {
  $('#logout-btn').click(function(event){
    event.preventDefault()
    $.ajax({
      type: 'GET',
      url: '/api/logout.php',
      success: function() {
        location.replace('/')
      },
      error: function() {
        $('#status').html('<p>Logout requset failed for some reason.</p>')
      }
    })
  })

  $('#colors').on('click', function(event) {
    let box = xytobox(event.originalEvent.clientX,event.originalEvent.clientY)
    $.ajax({
      type: 'POST',
      enctype: 'application/json',
      url: '/api/colors.php',
      data: JSON.stringify({
        'x': box.x,
        'y': box.y,
      }),
      success: function() {
        box.color = Cookies.get('color')
        conn.send(JSON.stringify(box))
        drawBox(box)
      },
      error: function() {
        $('#status').html('<p>Login or register to get in on the fun.</p>')
      }
    })
  })

  ctx = $('#colors')[0].getContext('2d')
  drawGrid(ctx)

  $.ajax({
    type: 'GET',
    url: '/api/colors.php',
    success: function(data) {
      let json = JSON.parse(data)
      drawBoxes(json.success)
    },
    error: function(data) {
      $('#status').html('<p>'+JSON.parse(data.responseText).error+'</p>')
    }
  })
})

