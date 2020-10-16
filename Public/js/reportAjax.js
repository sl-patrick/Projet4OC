function report(url, id) {
	const xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function () {
		if (this.readyState == XMLHttpRequest.DONE && this.status == 200) {
			if (this.response === 1) {
				document.getElementById(id).classList.add("bg-danger");

			} else if (this.response === 0) {
				document.getElementById(id).classList.remove("bg-danger");

			}
		}
	};
	xhr.open("POST", url, true);
	xhr.responseType = "json";
	xhr.send();
}