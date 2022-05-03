confirmationModal();

function confirmationModal() {
	const confirmModal = document.getElementById('confirmModal');
	const confirmButton = document.getElementById('confirmButton');
	const noJSarray = document.querySelectorAll('.no-js');
	const yesJSarray = document.querySelectorAll('.yes-js');

	if (noJSarray) {
		noJSarray.forEach(noJS => {
			noJS.style.display = 'none';
		});
	}
	if (yesJSarray) {
		yesJSarray.forEach(yesJS => {
			yesJS.style.display = 'block';
		});
	}

	confirmModal.addEventListener('shown.bs.modal', function () {
		confirmButton.focus();
	});

	confirmModal.addEventListener('show.bs.modal', e => {
		var button = e.relatedTarget;
		var id = button.getAttribute('data-bs-id');
		var form = document.getElementById('confirmForm');
		if (form) {
			var url = form.action;
			form.action = url.concat(id);
		}
		var input = document.getElementById('confirmInput');
		if (input) {
			input.setAttribute('value', id);
		}
	});
}
