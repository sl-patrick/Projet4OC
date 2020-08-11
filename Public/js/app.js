document.getElementById("commentForm").addEventListener("submit", function (event) {

	event.preventDefault(); //annuler le comportement par défaut.

	let dataForm = new FormData(this);

	const xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function () {
		if (this.readyState == XMLHttpRequest.DONE && this.status == 200) {
			let result = this.response;
			console.log(result);
		}
	};

	xhr.open("POST", this.action, true);
	xhr.responseType = "json";
	xhr.send(dataForm);
});




