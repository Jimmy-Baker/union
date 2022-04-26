confirmationModal();

function confirmationModal() {
	var confirmModal = document.getElementById('confirmModal');

	confirmModal.addEventListener('shown.bs.modal', function () {
		inputImage.focus();
	});
}
