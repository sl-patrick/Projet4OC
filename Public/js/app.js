const commentForm = document.getElementById("commentForm");
if (commentForm) {
	
	commentForm.addEventListener("submit", function (event) {
		event.preventDefault();
		let dataForm = new FormData(this);
	
		const xhr = new XMLHttpRequest();
		xhr.onreadystatechange = function () {
			if (this.readyState == XMLHttpRequest.DONE && this.status == 200) {
				let result = this.response;
				if (result === "Tous les champs ne sont pas remplis") {
					let message = document.getElementById("validationMessage");
					message.innerHTML = result;
					message.classList.add("d-block");
				} else {
					document.getElementById("author").value = null;
					document.getElementById("contents").value = null;
					document.getElementById("validationMessage").classList.remove("d-block");
					let allComments = document.querySelector('.allComments');
					let createDiv = document.createElement('div');
					createDiv.innerHTML = result;
					allComments.prepend(createDiv);
				}
			}
		};
		xhr.open("POST", this.action, true);
		xhr.responseType = "json";
		xhr.send(dataForm);
	});
}



