function report(url, id) {
	const xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function () {
		if (this.readyState == XMLHttpRequest.DONE && this.status == 200) {
			if (this.response === "commentaire signalé") {
				document.getElementById(id).classList.add("bg-danger");

			} else if (this.response === "commentaire non signalé") {
				document.getElementById(id).classList.remove("bg-danger");

			}
		}
	};
	xhr.open("POST", url, true);
	xhr.responseType = "json";
	xhr.send();
}