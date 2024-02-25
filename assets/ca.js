
//////////////////////////////////////////////////////
//                     VARIABLEN                    //
//////////////////////////////////////////////////////

var fps = 30; // Frames per Second
var msFrame = 1000 / fps; // Milliseconds per Frame

var dimension = 2; // Dimension

var T = new Array();

var color = new Array(
  new Array(0,0,0),
  new Array(255,0,0),
  new Array(255,255,0),
  new Array(0,0,255)
);

var param = new Array(0, 0, 0); // Parameter Variablen
var param_idx = 0; // Parameter Index
var param_number = 3; // Parameter Anzahl

var param_default = new Array(1, 1, 5); // Parameter Defaultwerte
var param_min = new Array(1, 1, 1); // Parameter Minimalwerte
var param_max = new Array(40, 40, 40); // Parameter Maximalwerte
var param_step = new Array(1, 1, 1); // Parameter Inkrement und Dekrement
var param_point = new Array(0, 0, 0); // Parameter Nachkommastellen
var param_name = new Array("mu", "sigma", "epsilon"); // Parameter Namen






//////////////////////////////////////////////////////
//                       INIT                       //
//////////////////////////////////////////////////////



function init_param () {
  for (var i = 0; i < param_number; i++) param[i] = param_default[i];
}


function init () {
  init_param();
  for (var i = 0; i < m; i++) T[i] = new Array(n);

  for (var i = 0; i < m; i++) for (var j = 0; j < n; j++) T[i][j] = Math.floor(4*Math.random());
}





//////////////////////////////////////////////////////
//                     DYNAMIK                      //
//////////////////////////////////////////////////////


function fortpflanzung (x1, y1, x2, y2) {
  if ((T[x1][y1] == 0) && (T[x2][y2] != 0)) {
    T[x1][y1] = T[x2][y2];
  } else
  if ((T[x1][y1] != 0) && (T[x2][y2] == 0)) {
    T[x2][y2] = T[x1][y1];
  };
}


function selektion (x1, y1, x2, y2) {
  if ((T[x1][y1] != 0) && (T[x2][y2] != 0) && (T[x1][y1] != T[x2][y2])) {
    if ((T[x1][y1] == 1) && (T[x2][y2] == 2)) T[x2][y2] = 0; else
    if ((T[x1][y1] == 1) && (T[x2][y2] == 3)) T[x1][y1] = 0; else
    if ((T[x1][y1] == 2) && (T[x2][y2] == 1)) T[x1][y1] = 0; else
    if ((T[x1][y1] == 2) && (T[x2][y2] == 3)) T[x2][y2] = 0; else
    if ((T[x1][y1] == 3) && (T[x2][y2] == 1)) T[x2][y2] = 0; else
    if ((T[x1][y1] == 3) && (T[x2][y2] == 2)) T[x1][y1] = 0;
  }
}


function bewegung (x1, y1, x2, y2) {
  var h = T[x1][y1];
  T[x1][y1] = T[x2][y2];
  T[x2][y2] = h;
}


function generation () {
  var t;
  var x1, y1, x2, y2;
  var s = param[0] + param[1] + param[2];
  var mu = param[0] / s;
  var sigma = param[1] / s;
  var epsilon = param[2] / s;

  for (var i = 0; i < n*m; i++) {
    // Zufaellig Punkt waehlen
    x1 = Math.floor(m*Math.random());
    y1 = Math.floor(n*Math.random());

    // Zufaellig Nachbar waehlen mit periodischen Randbedingungen
    t = Math.floor(4*Math.random());
    if (t == 0) { x2 = x1-1; y2 = y1; } else
    if (t == 1) { x2 = x1+1; y2 = y1; } else
    if (t == 2) { x2 = x1; y2 = y1+1; } else
                { x2 = x1; y2 = y1-1; };
    if (x2 == -1) x2 = m-1;
    if (y2 == -1) y2 = n-1;
    if (x2 ==  m) x2 = 0;
    if (y2 ==  n) y2 = 0;

    // Zufaellig Interaktion waehlen und durchfuehren
    t = Math.random();
    if (t < epsilon) bewegung(x1, y1, x2, y2); else
    if (t < epsilon+mu) fortpflanzung(x1, y1, x2, y2); else
    selektion(x1, y1, x2, y2);
  }
}


function calculate () {
  generation();
}

