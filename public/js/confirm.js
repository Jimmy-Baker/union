confirmationModal();

function confirmationModal() {
	var confirmModal = document.getElementById('confirmModal');
	var confirmButton = document.getElementById('confirmButton');
	var noJSarray = document.querySelectorAll('.no-js');
	var yesJSarray = document.querySelectorAll('.no-js');

	if (noJS) {
		noJSarray.forEach(noJS, () => {
			noJS.style.display = 'none';
		});
	}
	if (noJS) {
		noJSarray.forEach(noJS, () => {
			noJS.style.display = 'none';
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
