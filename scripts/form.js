// Dominic Reen

function writeTy(person) {
	alert("Thanks for contacting us, "+person+" !");
}

function checkReqFields() {
	var name=document.getElementById('nameinput').value;
	writeTy(name);
	document.forms('contact').reset();
}