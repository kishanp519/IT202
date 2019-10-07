<html>
<head>
	<script>
	function mySamples() {
	//var myVar = 10;
	//alert("My var is " + myVar);
	console.log("Hello World");

	//var name = prompt("What's your name?:");
	//alert("Hello, " + name);
	var number = 0;
	for(var i = 0; i < 10; i++) {
		number += 0.1;
	}
	console.log("Added float is " + number);
	
	var myParagraph = document.getElementById("myPara");
	myParagraph.innerText = "Changed It";
	let number1 = parseInt(prompt("Pick Number #1:"));
	let number2 = parseInt(prompt("Pick Number #2: "));
	myParagraph.innerText = number1 + " + " + number2 + " = ";
	myParagraph.innerText += number1 + number2;
	console.log(myParagraph);

	let myDiv = document.createElement('div');
        let text = document.createTextNode("I think it works");
	myDiv.appendChild(text);
	
//	let text = document.createTextNode("Created by JS");
//	myDiv.appendChild(text);

	document.body.appendChild(myDiv);
	}	
	</script>
</head>
<body onload="mySamples();">
	<p id="myPara">Just showing that we loaded something...</p>
</body>
</html>
