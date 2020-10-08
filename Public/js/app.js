document.getElementById("commentForm").addEventListener("submit", function (event) {
	event.preventDefault();
	let dataForm = new FormData(this);
	document.getElementById("author").value = null;
	document.getElementById("contents").value = null;

	const xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function () {
		if (this.readyState == XMLHttpRequest.DONE && this.status == 200) {
			let result = this.response;
			let allComments = document.querySelector('.allComments');
			let createDiv = document.createElement('div');
			createDiv.innerHTML = result;
			allComments.prepend(createDiv);	
		}
	};
	xhr.open("POST", this.action, true);
	xhr.responseType = "json";
	xhr.send(dataForm);
});



