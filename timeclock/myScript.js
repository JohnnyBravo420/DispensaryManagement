alert();


   
function $(id){
  let element = document.getElementById(id);
  if (!element){
    return false;
  } else {
    return element;
  }
}



 

  const canvas = document.getElementById("myTimeClock");
  var ctx = canvas.getContext("2d");
  var radius = canvas.height / 2;
  ctx.translate(radius, radius);
  radius = radius * 0.9;




 

 
   

    










  


  function drawFace(ctx, radius) {
    var grad;
    ctx.beginPath();
    ctx.arc(0, 0, radius, 0, 2 * Math.PI);
    ctx.fillStyle = "black";
    ctx.fill();
    grad = ctx.createRadialGradient(0, 0, radius * 0.95, 0, 0, radius * 1.05);
    grad.addColorStop(0, "#333");
    grad.addColorStop(0.5, "black");
    grad.addColorStop(1, "#333");
    ctx.strokeStyle = grad;
    ctx.lineWidth = radius * 0.1;
    ctx.stroke();
    ctx.beginPath();
    ctx.arc(0, 0, radius * 0.1, 0, 2 * Math.PI);
    ctx.fill();
  }

  function drawNumbers(ctx, radius) {
    var ang;
    var num;
    ctx.lineWidth = 8;
    ctx.font = radius * 0.15 + "px bold arial";
    ctx.textBaseline = "middle";
    ctx.textAlign = "center";
    for(num = 1; num < 13; num++) {
      ang = (num * Math.PI) / 6;
      ctx.rotate(ang);
      ctx.translate(0, -radius * 0.85);
      ctx.rotate(-ang);
      ctx.fillText(num.toString(), 0, 0);
      ctx.rotate(ang);
      ctx.translate(0, radius * 0.85);
      ctx.rotate(-ang);
    }
  }

  function drawTime(ctx, radius, setDT) {
    var now = new Date();
    now.toLocaleTimeString();
    var hour = now.getHours();
    var minute = now.getMinutes();
    var second = now.getSeconds();
    hour = hour % 12;
    hour =
      (hour * Math.PI) / 6 +
      (minute * Math.PI) / (6 * 60) +
      (second * Math.PI) / (360 * 60);
    drawHand(ctx, hour, radius * 0.4, radius * 0.04);
    //minute
    minute = (minute * Math.PI) / 30 + (second * Math.PI) / (30 * 60);
    drawHand(ctx, minute, radius * 0.6, radius * 0.07);
    // second
    second = (second * Math.PI) / 30;
    drawHand(ctx, second, radius * 0.7, radius * 0.01);
  }

  function drawHand(ctx, pos, length, width) {
    ctx.beginPath();
    ctx.strokeStyle = color;
    ctx.lineWidth = width;
    ctx.lineCap = "round";
    ctx.moveTo(0, 0);
    ctx.rotate(pos);
    ctx.lineTo(0, -length);
    ctx.stroke();
    ctx.rotate(-pos);
  }

  function drawClock() {
    drawFace(ctx, radius);
    drawNumbers(ctx, radius);
    drawTime(ctx, radius);
  }

  drawClock();


let analog = setInterval(function(){ drawClock(); }, 1000);










