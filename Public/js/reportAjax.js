
function report(url) {
	// console.log(url);

	// let url = this.dataset.url;

	const xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function () {
		if (this.readyState == XMLHttpRequest.DONE && this.status == 200) {
			if (this.response === null) {
				console.log('impossible de signaler le commentaire.');
			} else {
				console.log(this.response);
				
			}
		}
	};
	xhr.open("POST", url, true);
	xhr.responseType = "json";
	xhr.send();
	
}