

var fileAddress = document.getElementById('fileAddress');
var fileInput = document.getElementById('fileInput');
fileInput.addEventListener("change", uploaded);


function uploaded() {
	fileAddress.value= fileInput.value;
}
