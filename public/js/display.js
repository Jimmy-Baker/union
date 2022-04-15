window.addEventListener('scroll', topButton);
hideMessage();
modal();
resetForm();

function modal() {
	var uploadModal = document.getElementById('uploadModal');

	if (uploadModal) {
		var inputImage = document.getElementById('inputImage1');
		var closePrompts = document.querySelectorAll('[data-modal-cancel]');
		var savePrompts = document.querySelectorAll('[data-modal-save]');

		uploadModal.addEventListener('shown.bs.modal', function () {
			inputImage.focus();
		});

		closePrompts.forEach(prompt => {
			var num = prompt.dataset.modalCancel;
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
			var num = prompt.dataset.modalSave;
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
}

function hideMessage() {
	var alertNode = document.querySelector('.alert');
	if (alertNode) {
		var alert = new bootstrap.Alert(alertNode);
		setTimeout(() => {
			alert.close();
		}, 5000);
	}
}

function topButton() {
	const TOP_BUTTON = document.querySelector('#back-to-top');
	let vH = window.innerHeight;

	if (
		document.body.scrollTop > vH / 3 ||
		document.documentElement.scrollTop > vH / 3
	) {
		TOP_BUTTON.style.display = 'block';
		TOP_BUTTON.addEventListener('click', () => {
			document.body.scrollTop = 0;
			document.documentElement.scrollTop = 0;
			TOP_BUTTON.style.display = 'none';
		});
		TOP_BUTTON.addEventListener('keydown', e => {
			if (e.code === 'Space' || e.code === 'Enter') {
				button.click();
			}
		});
	} else {
		TOP_BUTTON.style.display = 'none';
	}
}

function resetForm() {
	const FORM = document.querySelector('.needs-validation');
	if (FORM) {
		FORM.addEventListener(
			'submit',
			function (event) {
				if (!FORM.checkValidity()) {
					event.preventDefault();
					event.stopPropagation();
					var firstFix = document.querySelector(
						'input:invalid, select:invalid'
					);
					firstFix.scrollIntoView({ block: 'center' });
				}
				FORM.classList.add('was-validated');
			},
			false
		);
	}

	const FIXES = document.querySelectorAll('.is-invalid');
	if (FIXES) {
		FIXES.forEach(fix => {
			fix.addEventListener('input', e => {
				fix.classList.remove('is-invalid');
			});
		});
	}
}
