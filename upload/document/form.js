const numericChars = [8,32,9,20,16,37,38,39,48,49,50,51,52,53,54,55,56,57,96,97,98,99,100,101,102,103,104,105];
const alphaNumericChars = [8,32,9,20,16,37,38,39,48,49,50,51,52,53,54,55,56,57,96,97,98,99,100,101,102,103,104,105,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90];
const emailsChars = [8,32,9,20,16,37,38,39,48,49,50,51,52,53,54,55,56,57,96,97,98,99,100,101,102,103,104,105,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,50,190];
const passwordsChars = [8,32,9,20,16,37,38,39,48,49,50,51,52,53,54,55,56,57,96,97,98,99,100,101,102,103,104,105,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,50,190];
const alphaChars = [8,32,9,20,16,37,38,39,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90];
function setAttrs(node,attributes,values)
{
	if(typeof values == "undefined"){
		values = Array();
		let newAttributes = Array();
		for(let i = 0;i<attributes.length;i++)
		{
			switch(i%2)
			{
				case 0: newAttributes.push(attributes[i]);
					break;
				case 1: values.push(attributes[i]);
					break;   
			}
		}
		attributes = "";
		attributes = newAttributes;
	}
	for(let i = 0; i < attributes.length; i++)
		{
			node.setAttribute(attributes[i],values[i]);			
		}
}
function makeElement(tagName,parent,attributes,values){
	let node = document.createElement(tagName);
	if(typeof attributes == "object")
	{
		if(typeof values == "string")
			{
				let textNode = document.createTextNode(values);
				node.appendChild(textNode);
				setAttrs(node,attributes);
			}else{
				setAttrs(node,attributes,values);
			}
	}
	else if(typeof attributes == "string")
	{
		let textNode = document.createTextNode(attributes);
		node.appendChild(textNode);
	}
	if(typeof parent == "object")
	{
		parent.appendChild(node);
	}
	return node;
}
function makeInputs(types,parent,form){
	for(let i = 0; i < types.length; i++)
		{
			switch(types[i])
			{
				case "username":
					let usernameGroup = makeElement("div",parent,Array("class","input-group"));
					makeElement("label",usernameGroup,Array("for","username"),"Username");
					makeElement("input",usernameGroup,Array("id","name","type","required","placeholder","form","data-validate"),Array("username","username","text","true","Username",form.id,"alphaNumerical"));
					makeElement("span",usernameGroup,Array("id"),Array("username-help"));
					break;
				case "password":
					let passwordGroup = makeElement("div",parent,Array("class","input-group"));
					makeElement("label",passwordGroup,Array("for","password"),"Password");
					makeElement("input",passwordGroup,Array("id","name","type","required","placeholder","form","data-validate"),Array("password","password","password","true","Password",form.id,"password"))
					makeElement("span",passwordGroup,Array("id"),Array("password-help"));
					break;
				case "rememberme":
					let remembermeGroup = makeElement("div",parent,Array("class","input-group"));
					makeElement("label",remembermeGroup,Array("for","remember-me"),"Remember Me");
					makeElement("input",remembermeGroup,Array("id","type"),Array("remember-me","checkbox"));
					break;
				case "login":
					let loginGroup = makeElement("div",parent,Array("class","input-group"));
					makeElement("input",loginGroup,Array("type","disabled","value"),Array("submit","true","Login"));
					break;
			}
		}
	
}
function createLoginForm(form)
{
	setAttrs(form,Array("id","action","onsubmit","method","enctype","autocomplete"),Array("loginForm","parser.php","submitForm()","post","multipart/form-data","true"))		
	let fieldset = makeElement("fieldset",form,Array("form",form.id));
	makeElement("legend",fieldset,"Login");
	makeInputs(Array("username","password","rememberme","login"),fieldset,form);
	
	
}
window.addEventListener("DOMContentLoaded", loaded);
function loaded()
{
	let forms= document.forms;
	for(let i = 0; i < forms.length; i++)
		{
			switch(forms[i].dataset.formType)
				{
					case "login": createLoginForm(forms[i]);
						break;
				}
		}
	
let validations = document.querySelectorAll("[data-validate]");
validations.forEach(function(value){ value.addEventListener("keydown",keyDownHandler,true); });				  
	
}

function submitForm()
{
	event.preventDefault();
}


function keyDownHandler(event){
const numericChars = [8,32,9,20,16,37,38,39,48,49,50,51,52,53,54,55,56,57,96,97,98,99,100,101,102,103,104,105];
const alphaNumericChars = [8,32,9,20,16,37,38,39,48,49,50,51,52,53,54,55,56,57,96,97,98,99,100,101,102,103,104,105,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90];
const emailsChars = [8,32,9,20,16,37,38,39,48,49,50,51,52,53,54,55,56,57,96,97,98,99,100,101,102,103,104,105,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,50,190];
const passwordsChars = [8,32,9,20,16,37,38,39,48,49,50,51,52,53,54,55,56,57,96,97,98,99,100,101,102,103,104,105,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,50,190];
const alphaChars = [8,32,9,20,16,37,38,39,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90];
if(event.target.name){
let char = event.which || event.keyCode;
//alert(char+""+alphaNumericChars.indexOf(char));
switch(event.target.name)
{
case "password": if(0>passwordsChars.indexOf(char)){ event.preventDefault(); } 
break;
case "username": if(0>alphaNumericChars.indexOf(char)){ alert();event.preventDefault(); }
break;
case "numerical": if(0>numericChars.indexOf(char)){ event.preventDefault(); }
break;         
case "alphabetical": if(0>alphaChars.indexOf(char)){ event.preventDefault(); }
break;
case "email": if(0>emailsChars.indexOf(char)){ event.preventDefault(); }
break;  
}

}   
}



function validateInput(target)
{
	let str = target.value;
	let length = str.length;
	let pattern;
	let min;
	let max;
	let errorsArray;
	switch(target.name)
	{
		case "username": pattern = new RegExp(/[^\w\d]/); min = 6; max = 20; errorsArray = Array(document.getElementById("username-help"),"Username", 2);
			break;
		case "password": pattern = new RegExp(/[^\w\d]/); min = 6; max = 20; errorsArray = Array(document.getElementById("password-help"),"Password", 2);
			break;
	}
	target.classList.remove("invalid");
	target.classList.remove("valid");
	if(length < min){ errorsArray[0].innerHTML = errorsArray[1]+" is too short"; target.classList.add('invalid'); }
	if(length > max){ errorsArray[0].innerHTML = errorsArray[1]+" is too long"; target.classList.add('invalid'); }
	if(pattern.test(str)){ errorsArray[0].innerHTML = errorsArray[1]+" contains invalid characters"; target.classList.add('invalid');}
	if(length > min && length < max && pattern.test(str)==false){ target.classList.add('valid'); errorsArray[0].innerHTML = ""; }
	if(document.getElementsByClassName('valid').length == document.querySelectorAll("[data-validate]").length){ document.querySelector("input[type='submit']").disabled = false; }else{ document.querySelector("input[type='submit']").disabled = true;}
	
	
	
	
}
