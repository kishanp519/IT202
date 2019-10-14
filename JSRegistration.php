<html>
<head>
<script>
function myValidation(inputEle, checkValue) {
	let name = inputEle.name;
	let vid = "validation." + name;
        let vele = document.getElementById(vid);
	let value = inputEle.value;

	if (inputEle.type == "email") {
		if (name == "email" || name == "confirmemail") {
			if (value == "" || !value.includes("@") || !value.includes(".")) {
				vele.document.createElement("span");
				vele.id = vid;
				vele.innerText = name + " has an invalid email value.";
				document.body.appendChild(vele);
			}
		}
		if (name == "confirmemail" && value != checkValue.value) {
			vele.document.createElement("span");
                        vele.id = vid;
			vele.innerText = name + " has an invalid email value.";
                        document.body.appendChild(vele);	
		}
	}

	if (inputEle.type == "password") {
 		if (name == "password" || name == "passwordconfirm") {
			if (value == "") {
				vele.document.createElement("span");
				vele.id = vid;
				vele.innterText = name + " has an invalid password value.";
				document.body.appendChild(vele);
			}		
		}	 
		if (name == "passwordconfirm" && value != checkValue.value) {
                        vele.document.createElement("span");
                        vele.id = vid;
                        document.body.appendChild(vele);
        	}
	}

	if (name == "username") {
		if (value == "") {
			if (value == "") {
				vele.document.createElement("span");
				vele.id = vid;
				vele.innerText = name + " has an invalid username value."
				document.body.appendChild(vele);
			}
		}
	}

	return false;
}
</script>
</head>

<body>
<form onsubmit="return false;">
<input name="email" type="email" onchange="myValidation(this, this);"/>
<input name="emailconfirm" type="email" onchange="myValidation(this, email);"/>
<input name="password" type="password" onchange="myValidation(this, this);"/>
<input name="passwordconfirm" type="password" onchange="myValidation(this, this);"/>
<input name="username" onchange="myValidation(this, this);"/>

<input type="submit" value "Submit"/>
</form>
</body>
</html>
