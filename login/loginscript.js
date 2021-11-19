"use strict";


let visitCount = lget('visitCount');
visitCount?visitCount++:visitCount=0;
lset('visitCount', visitCount);
let username = lget('username');
let password = lget('password');
if(username){ 
    $('username').value=username;
    $('password').value=password;
    $('remember-me').checked=true;
}

let myMessages = new Array();


function out(msg){
let feed = $('feedback');
if(typeof msg === "string"){
    let delay = 1000 * myMessages.length; 
    myMessages.push(msg);
    setTimeout(()=> { feed.dataset.text = myMessages.shift(); }, delay);
}
}



function $(id){
  let element = document.getElementById(id);
  if (!element){
    return false;
  } else {
    return element;
  }
}




    



function authorize(butn) {
if($('remember-me').checked)
{ 
    lset("username", $("username").value); 
    lset("password", $("password").value);  
}
let feed = $('feedback');
let $form = $('loginForm');
if (!$form.checkValidity || $form.checkValidity()) {
butn.value = "Sending";
butn.setAttribute('onclick', '');
$form.classList.add('sending');
out('Serializing data');
out('Confirming Credentials');
out('Recieving Response');
const fd = new FormData($form);
    let  xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function(){
    if (xmlhttp.readyState==4 && xmlhttp.status==200){ parseResponse(xmlhttp.responseText); } }
    xmlhttp.open('POST', 'loginparser.php', true);   // xmlhttp.setRequestHeader("Content-type", "multipart/form-data");
    xmlhttp.send(fd);
    }
    }
let i;
function parseResponse(response){
if(response.match("success")){ setTimeout(function(){ location.replace("https://tgtpos.com/");}, 1000); 
    }else{
let feed = $('feedback');setTimeout(function() {feed.value = response;}, 1000);
let butn = document.querySelector('button');
butn.value = "Submit";
let $form = $('loginForm');
$form.classList.remove('sending'); 
 let attempts = lget('failedLogins');
 if(!attempts | typeof attempts === "undefined"){ lset('failedLogins',1); attempts=1; }else{ attempts++; lset('failedLogins',attempts); }

if(attempts > 3){ alert('please Leave');  } 
feed.dataset.text = attempts+"/3";
    } 
}

function lset(key, value) {
    localStorage.setItem(key, value);
  }
  function lget(key) {
    return localStorage.getItem(key);
  }

