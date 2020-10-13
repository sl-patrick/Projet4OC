function report(url, id) {
	const xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function () {
		if (this.readyState == XMLHttpRequest.DONE && this.status == 200) {
			if (this.response === 0) {
				console.log(id);
				document.getElementById(id).classList.remove("bg-danger");
				
				console.log('commentaire non signaler');
			} else if (this.response === 1) {
				console.log('commentaire signaler');
				document.getElementById(id).classList.add("bg-danger");

			} else {
				console.log('un problème est survenu');
			}
		}
	};
	xhr.open("POST", url, true);
	xhr.responseType = "json";
	xhr.send();
	
}