<?php 
session_start();
date_default_timezone_set( "America/Los_Angeles" );

$today = mktime(0,0,0,date("n"), date("d") , date("Y"));
$Y = date("Y");
$Y1 = $Y+1;$Y2 = $Y1+1;$Y3= $Y2+1; 
$leapyears = array( mktime(0,0,0,3,0, $Y), mktime(0,0,0,3,0,$Y1),mktime(0,0,0,3,0,$Y2), mktime(0,0,0,3,0,$Y3) );
$jscript = 'var leapyears = [';
foreach($leapyears as $year){
    
    if(date('d', $year) == 28){ $jscript.="'false',"; }else{  $jscript.="'true',"; }
}
$jscript.="'false'];";
$n = date('n');
$jscript2 = "var months = (''";
for($i = $n; $i<$n+12; $i++){
    

    $jscript2.= ",'".date('F', mktime(0,0,0, $i, date('d') , date('Y')))."'=>'".date('d', mktime(0,0,0, $n, 0 , date('Y')))."'";
}
$jscript2.=");";



?>
<!DOCTYPE html>
<html>
<head>
<style>
@font-face {
font-family: "digital";
src: url("digital.ttf");
}
* {
font-size: 18px;
line-height: 20px;
box-sizing: border-box;
overflow: hidden;
}

html,
body {
counter-reset: section -1;
max-width: 390px;
outline: none;
border: black solid 1px;
margin-left: auto;
margin-right: auto;
top: 0px;
bottom: 0px;
}
html {
overflow-y: scroll;
padding-top:0px;
}
body {
width: auto;
margin: auto 0px auto 0px;
padding: 1px 1px 1px 1px;
}
section{
position:static;
width:390px;
height:Calc(550px);
bottom:0px;
background-color: lightgrey;
box-sizing:content-box;
color:green;
}
div.clock, div#digital{
    background-color: grey;
    border-top:1px solid black;
    
    width:auto;
    text-align:center;
    font-family: "digital";
    line-height:70px;
    font-size:40px;
}
div.clock>article, div#digital>article{
 width:auto;
 height:0px;
 display:inline-block;
 font-size:.6em;
 margin: auto 0px auto 0px;
padding: 0px 0px 0px 0px;
color:inherit;
}
article.active{
    height:100% !important;
    
}

section#calendarContainer{
    box-sizing:content-box;
    width:auto;


}
aside{
    
    background-color:teal;
    margin: 0px 0px 0px 0px;
padding: 0px 0px 0px 0px;
    height:100px;
    box-sizing:border-box;
    display:inline-block;
    width:Calc(10%);
}


table{
    box-sizing:border-box;
    display:block;
    margin: 0px 0px 0px 0px;
padding: 0px 0px 0px 0px;

}
 td, th{
    margin: 0px 0px 0px 0px;
    padding: 0px 0px 0px 0px;
    font-size:1.1em;
    text-align:center;
        box-sizing:border-box;
    min-width:53px;
    height:50px;
    border:solid black 1px;
 }
 td{
font-size:2em;
  
 }
  
</style>
</head>
<body>
<section>
<canvas id="canvas" width="386" height="386" style="background-color:#333">
</canvas>
<div id="digital" style="color:inherit"> 88:88:88 </div>
<div class="clock"><article class="active">Clock In</article><article>Clock Out</article></div>
</section>

<section>

<aside></aside>
 
<table id="calendar">
<thead>
 <tr data-row='0'>
        <th colspan="7" id="month" width="100%" data-offset="" data-length=""> Month </th>
 </tr>
  <tr data-row='0'>
        <th id="Sunday">Sun </th>
        <th id="Monday">Mon </th>
        <th id="Tuesday">Tues </th>
        <th id="Wednesday">Wed </th>
        <th id="Thurday"> Thur</th>
        <th id="Friday">Fri </th>
        <th id="Saturday">Sat </th>
     </tr>
    </thead>
    <tbody id="calendarBody">
    
<script>
var h=0;
var d=0;
    function cellNum(int)
    { 
        switch(int){
          case "d":  return d++;
          break;
          case "h": retrun h++; d=0;
          break;

        }

    }


var calRow= `
<tr data-row='${celNum(h++)}'>
        <td data-row='${celNum("d")}'></td>
        <td data-row='${celNum("d")}'></td>
        <td data-row='${celNum("d")}'></td>
        <td data-row='${celNum("d")}'></td>
        <td data-row='${celNum("d")}'></td>
        <td data-row='${celNum("d")}'></td>
        <td data-row='${celNum("d")}'></td>
        </tr>`; 

for(let i = 0; i < 5;i++)
{

document.writeln(calRow);

}
</script>

    </tbody>
    <tfoot>
    <tr>
    <th colspan="7" data-leapyear="" > YEAR </th>
</tr>
</table> 
<aside></aside>


</section>

<script>
<?php //echo $jscript; ?>
<?php //echo $jscript2; ?>








   function $(id){
  let element = document.getElementById(id);
  if (!element){
    return false;
  } else {
    return element;
  }
}
var color = "green";
function getColor()
{
return color;
}
var canvas = document.getElementById("canvas");
var ctx = canvas.getContext("2d");
var radius = canvas.height / 2;
ctx.translate(radius, radius);
radius = radius * 0.90
setInterval(drawClock, 500);
function drawClock() {
  drawFace(ctx, radius);
  drawNumbers(ctx, radius);
  drawTime(ctx, radius);
}
function drawFace(ctx, radius) {
  var grad;
  ctx.beginPath();
  ctx.arc(0, 0, radius, 0, 2*Math.PI);
  ctx.fillStyle = 'black';
  ctx.fill();
  grad = ctx.createRadialGradient(0,0,radius*0.95, 0,0,radius*1.05);
  grad.addColorStop(0, '#333');
  grad.addColorStop(0.5, 'black');
  grad.addColorStop(1, '#333');
  ctx.strokeStyle = grad;
  ctx.lineWidth = radius*0.1;
  ctx.stroke();
  ctx.beginPath();
  ctx.arc(0, 0, radius*0.1, 0, 2*Math.PI);
  ctx.fillStyle = getColor();
  ctx.fill();
}
function drawNumbers(ctx, radius) {
  var ang;
  var num;
  ctx.lineWidth = 8;
  ctx.font = radius*0.15 + "px bold arial";
  ctx.textBaseline="middle";
  ctx.textAlign="center";
  for(num = 1; num < 13; num++){
    ang = num * Math.PI / 6;
    ctx.rotate(ang);
    ctx.translate(0, -radius*0.85);
    ctx.rotate(-ang);
    ctx.fillText(num.toString(), 0, 0);
    ctx.rotate(ang);
    ctx.translate(0, radius*0.85);
    ctx.rotate(-ang);
  }
}
function drawTime(ctx, radius){
    var now = new Date();
    var hour = now.getHours();
    var minute = now.getMinutes();
    var second = now.getSeconds();
    let h = hour.toString().padStart(2, '0');
    let str = h+":"+minute.toString().padStart(2, '0')+":"+second.toString().padStart(2, '0');
    //let str = hour.substr(hour.length-2)+":"+minute.substr(minute.length-2)+":"+second.substr(second.length-2);
    $("digital").innerText = str;
    //hour
    hour=hour%12;
    hour=(hour*Math.PI/6)+
    (minute*Math.PI/(6*60))+
    (second*Math.PI/(360*60));
    drawHand(ctx, hour, radius*0.5, radius*0.07);
    //minute
    minute=(minute*Math.PI/30)+(second*Math.PI/(30*60));
    drawHand(ctx, minute, radius*0.8, radius*0.07);
    // second
    second=(second*Math.PI/30);
    drawHand(ctx, second, radius*0.9, radius*0.02);
}
function drawHand(ctx, pos, length, width) {
    ctx.beginPath();
    ctx.strokeStyle = getColor();
    ctx.lineWidth = width;
    ctx.lineCap = "round";
    ctx.moveTo(0,0);
    ctx.rotate(pos);
    ctx.lineTo(0, -length);
    ctx.stroke();
    ctx.rotate(-pos);

}
window.addEventListener("DOMContentloaded", function(){
  var tbdy = document.getElementById("calendarBody");

tbdy.innerHTML += calrow; 
tbdy.innerHTML += calrow; 
tbdy.innerHTML += calrow; 
tbdy.innerHTML += calrow; 


});




</script>




</body>
</html>
