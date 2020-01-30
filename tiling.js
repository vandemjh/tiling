canvas = document.querySelector("canvas");
context = canvas.getContext("2d");
canvas.width = document.body.clientWidth;
canvas.height = document.body.clientHeight;
const width = canvas.width;
const height = canvas.height;

if (canvas.getContext) {
  setInterval(loop, 500);
}

function rand(top) {
  return Math.floor(Math.random() * top);
}

function drawRect(x, y, r, g, b, size) {
  context.fillStyle = "rgb(" + r + "," + g + "," + b + ")";
  context.fillRect(x, y, size, size);
}

function drawCircle(x, y, r, g, b, size) {
  context.fillStyle = "rgb(" + r + "," + g + "," + b + ")";
  context.beginPath();
  context.arc(x, y, size, 0, 2 * Math.PI);
  context.fill();
}

var newWidth = rgbArray.length;
var newHeight = rgbArray[0].length;
var placementScale = height / newHeight;
var placementWidth = width / newWidth;
var horizontalScale = width / 2 - (newWidth * placementScale) / 2;
var pixelSize = 20;
var scale = 0.1;
var multiplier = 1;

var sliderSize = document.querySelector("#size");

function loop() {
  sliderSize = document.querySelector("#size").value;
  let x = rand(newWidth);
  let y = rand(newHeight);
  let r = rgbArray[x][y][0];
  let g = rgbArray[x][y][1];
  let b = rgbArray[x][y][2];
  drawCircle(
    x * placementScale + horizontalScale + rand(placementWidth),
    y * placementScale + rand(placementScale),
    r,
    g,
    b,
    rand(sliderSize)
  );
  //pixelSize = pixelSize - scale;
  requestAnimationFrame(loop);
}

//console.log(rgbArray[0].length);

//pixelSize += (Math.random() > .5 ? -1 : 1) * Math.random() * multiplier;
//if (multiplier > 10) multiplier*=-1;
//if (multiplier < 2) multiplier*=-1;

//for (let x = 0; x < newWidth; x++) {
//  for (let y = 0; y < newHeight; y++) {
//    let r = rgbArray[x][y][0];
//    let g = rgbArray[x][y][1];
//    let b = rgbArray[x][y][2];
//console.log(r, g, b);
//drawRect(x * 10, y * 10, r, g, b, 10);
//  }
//}

loop();
