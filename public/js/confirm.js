confirmationModal();

function confirmationModal() {
	var confirmModal = document.getElementById('confirmModal');
	var confirmButton = document.getElementById('confirmButton');

	confirmModal.addEventListener('shown.bs.modal', function () {
		confirmButton.focus();
	});

	confirmModal.addEventListener('show.bs.modal', e => {
		var button = e.relatedTarget;
		var id = button.getAttribute('data-bs-id');
		console.log(id);
		var form = document.getElementById('confirmForm');
		console.log(form);
		var url = form.action;
		console.log(url);
		form.action = url.concat(id);
	});
}
