photoModal();

function photoModal() {
	var uploadModalArray = document.querySelectorAll('.upload-modal');

	uploadModalArray.forEach((element, key) => {
		num = key + 1;
		element.addEventListener('shown.bs.modal', function () {
			var inputImage = document.getElementById(`inputImage${num}`);
			inputImage.focus();
		});
	});

	var closePrompts = document.querySelectorAll('.modal-cancel');
	var savePrompts = document.querySelectorAll('.modal-save');

	closePrompts.forEach(prompt => {
		var num = prompt.dataset.modalNum;
		prompt.addEventListener('click', () => {
			var input = document.getElementById(`inputImage${num}`);
			input.value = '';
		});
		prompt.addEventListener('keydown', e => {
			if (e.code === 'Space' || e.code === 'Enter') {
				button.click();
			}
		});
	});

	savePrompts.forEach(prompt => {
		var num = prompt.dataset.modalNum;
		prompt.addEventListener('click', () => {
			var input = document.getElementById(`inputImage${num}`);
			var saved = document.getElementById(`inputSavedImage${num}`);
			saved.value = input.value;
		});
		prompt.addEventListener('keydown', e => {
			if (e.code === 'Space' || e.code === 'Enter') {
				button.click();
			}
		});
	});
}
