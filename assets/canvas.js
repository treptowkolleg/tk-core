

var step = 0;
var run = 0;


var LastStepTime = (new Date()).getTime();
var TimeShift = 0;
var StepTime = 1000 / fps;




//////////////////////////////////////////////////////
//                    KEY EVENTS                    //
//////////////////////////////////////////////////////


window.addEventListener("keydown", keyEvent, false);


function start_stop () {
  run = (run + 1) % 2;
}


function keyEvent (e) {
  if (e.keyCode == 13) { init(); run = 0; step = 0; };
  if (e.keyCode == 32) start_stop();

  if (param_number > 0) {
    if ((e.keyCode == 37) && (param_idx > 0)) param_idx--;
    if ((e.keyCode == 39) && (param_idx < param_number-1)) param_idx++;

    if (e.keyCode == 38) {
     param[param_idx] += param_step[param_idx];
     if (param[param_idx] > param_max[param_idx]) param[param_idx] = param_max[param_idx];
    }

    if (e.keyCode == 40) {
     param[param_idx] -= param_step[param_idx];
     if (param[param_idx] < param_min[param_idx]) param[param_idx] = param_min[param_idx];
    }

    if (e.keyCode == 82) init_param();
  }
}



//////////////////////////////////////////////////////
//                       PLOT                       //
//////////////////////////////////////////////////////


function leading_zero (n) {
  if (n < 10) return "0000" + n; else
  if (n < 100) return "000" + n; else
  if (n < 1000) return "00" + n; else
  if (n < 10000) return "0" + n; else
  return "" + n;
}


function plot_arrow (context, x) {
  // arrow up
  context.beginPath();
  context.moveTo(x-4, 10);
  context.lineTo(x, 6);
  context.lineTo(x+4, 10);
  context.closePath();
  context.fill();

  // arrow down
  context.beginPath();
  context.moveTo(x-4, 30);
  context.lineTo(x, 34);
  context.lineTo(x+4, 30);
  context.closePath();
  context.fill();
}


function plot_param (context) {
  if (param_number > 0) {
    context.font = '12px sans-serif';
    context.textAlign = 'center';
    var param_width = (n-20) / param_number;
    for (var i = 0; i < param_number; i++) {
      context.fillStyle = (param_idx != i ? '#646464' : '#FFFFFF');
      context.fillText(param_name[i] + " = " + param[i].toFixed(param_point[i]), 10+(i+0.5)*param_width, 24);
      if (param_max[i]-param_min[i] > 0) plot_arrow(context, 10+(i+0.5)*param_width);
    }
  }
}


function plot_text (context) {
  context.font = '12px sans-serif';
  context.fillStyle = '#FFFFFF';
  context.textAlign = 'left';

  if (dimension > 1) {
    context.lineWidth = 4;
    context.lineJoin = 'round';
    context.strokeStyle = '#000000';
    context.strokeText(leading_zero(step), 10, 60);
    context.fillText(leading_zero(step), 10, 60);

    context.textAlign = 'right';
    context.fillText("space ", 80, m+56);
    context.fillText("enter ", 80, m+72);
    context.textAlign = 'left';
    context.fillText("= " + (run == 0 ? "start" : "stop"), 80, m+56);
    context.fillText("= reset", 80, m+72);
  } else {
    context.fillText("enter = new simulation", 30, m+72);
  }

  if (param_number > 0) {
    context.textAlign = 'right';
    context.fillText("arrow keys ",  n-160, m+56);
    context.fillText("key R ",  n-160, m+72);
    context.textAlign = 'left';
    context.fillText("= change parameter" + (param_number > 1 ? "s" : ""), n-160, m+56);
    context.fillText("= reset parameter" + (param_number > 1 ? "s" : ""), n-160, m+72);
  }

  if (document.getElementById('fps')) document.getElementById('fps').innerHTML = "fps = " + Math.floor(1000 / Math.max(1,StepTime));
}


function plot (canvas, context) {
  // clear canvas
  context.clearRect(0, 0, canvas.width, canvas.height);

  // draw background
  context.fillStyle = '#000000';
  context.rect(0, 0, canvas.width, canvas.height);
  context.fill();

  // draw pixel
  var pixel = context.createImageData(n, m);
  for (var k = 0; k < pixel.data.length; k+=4) {
    var h = Math.floor(k / 4);
    var i = Math.floor(h / n);
    var j = h % n;
    pixel.data[k+0] = color[T[i][j]][0]; // r
    pixel.data[k+1] = color[T[i][j]][1]; // g
    pixel.data[k+2] = color[T[i][j]][2]; // b
    pixel.data[k+3] = 255; // a
  }
  context.putImageData(pixel, 0, 40);
}



//////////////////////////////////////////////////////
//                     ANIMATE                      //
//////////////////////////////////////////////////////


function animate (canvas, context) {
  var CurrentTime = (new Date()).getTime();

  if (CurrentTime - LastStepTime + TimeShift >= msFrame) {
    StepTime += 0.02 * (CurrentTime - LastStepTime - StepTime);
    TimeShift = Math.min(CurrentTime - LastStepTime + TimeShift - msFrame, msFrame);
    LastStepTime = CurrentTime;

    plot(canvas, context);
    plot_text(context);
    plot_param(context);

    if ((run == 1) && (dimension > 1)) {
      calculate();
      step++;
    }
  }

  window.requestAnimFrame(function() {
    animate(canvas, context);
  });
}

